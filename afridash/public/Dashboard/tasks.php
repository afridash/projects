<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Tasks</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Tasks</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                        <?php
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$student = mysqli_query($connection, $query);
confirm_query($student);
?>
 <?php
                                    global $connection;
                                    while($student_course = mysqli_fetch_assoc($student)){
                            $query = "SELECT course_code, course_title FROM courses WHERE course_id = {$student_course['course_id']} ORDER BY course_id ASC ";
                            $course_ret = mysqli_query($connection, $query);
                            confirm_query($course_ret);
                            while($course_details = mysqli_fetch_assoc($course_ret)){
                                $query = "SELECT * FROM activity_notifications WHERE course_code = '{$course_details['course_code']}'";
                                $activities = mysqli_query($connection, $query);
                                confirm_query($activities);
                                while($activity = mysqli_fetch_assoc($activities)){
                                    if($activity['notif_type']== "Test"){
                                        $query = "SELECT score FROM test_scores WHERE test_id = {$activity['act_id']} AND user_id = {$_SESSION['user_id']} AND course_code = '{$activity['course_code']}' LIMIT 1";
                                        $student_score = mysqli_query($connection, $query);
                                        confirm_query($student_score);
                                        if(mysqli_num_rows($student_score) == 0){
                                ?>
<a href="courses.php?course=<?php echo $course_details['course_title']?>&course_code=<?php echo $course_details['course_code']?>"><div class="display_pan"><?php echo $course_details['course_code']?> -- A new test has been added <?php $ndate = new MyDateTime($activity['notif_time'], new DateTimeZone('PST'));
                echo time_stamp($ndate->getTimestamp());?></div></a>
                                       <?php
                                            }
                                    }elseif($activity['notif_type']== "Quiz"){
                            $query = "SELECT score FROM quiz_scores WHERE quiz_id = {$activity['act_id']} AND user_id = {$_SESSION['user_id']} AND course_code = '{$activity['course_code']}' LIMIT 1";
                                        $student_score = mysqli_query($connection, $query);
                                        confirm_query($student_score);
                                        if(mysqli_num_rows($student_score) == 0){
                                ?>
                                            <a href="courses.php?course=<?php echo $course_details['course_title']?>&course_code=<?php echo $course_details['course_code']?>"><div class="display_pan"><?php echo $course_details['course_code']?> -- A new quiz has been added <?php $ndate = new MyDateTime($activity['notif_time'], new DateTimeZone('PST')); echo time_stamp($ndate->getTimestamp());?></div></a>
                                <?php
                                    }
                                }elseif($activity['notif_type'] == "Assignment"){
                                        //Start from here. Get the assignment 
                                        $query = "SELECT due_date FROM assignment WHERE assignment_id = {$activity['act_id']} AND course_code = '{$activity['course_code']}' LIMIT 1";
                                        $student_assignment = mysqli_query($connection, $query);
                                        confirm_query($student_assignment);
                                        $due_time = mysqli_fetch_assoc($student_assignment);
                                        //if(time() < strtotime($due_time['due_date'])){
                                ?>
                                            <a href="courses.php?course=<?php echo $course_details['course_title']?>&course_code=<?php echo $course_details['course_code']?>"><div class="display_pan"><?php echo $course_details['course_code']?> -- A new assignment has been added <?php $ndate = new MyDateTime($activity['notif_time'], new DateTimeZone('PST'));
                echo time_stamp($ndate->getTimestamp());?></div></a>
                                <?php
                                   // }
                            }
                                    }
                                    }
                                }
                                ?>
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
 <?php require_once('../../includes/footer.php')?>