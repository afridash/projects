<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
$scores_assignment = array();
$scores_quiz = array();
$scores_test = array();
$scores_mid = array();
$scores_exam = array();
?>
<?php confirm_if_user_logged_in(); ?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Grading </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Grading</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">
                                <p style = "float:right">Curve</p>
                                <h3>Gradebook</h3>
                                <p>Course Name: <?php echo $_GET['course']; ?></p>
                                <p>Room: LT2</p>
                                <p>Time: 2:00PM - 4:00PM</p>
                            </div>
                        <br/>
        <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Assignments">Assignments</a></li>
        <li><a data-toggle="tab" href="#Quizzes">Quizzes</a></li>
        <li><a data-toggle="tab" href="#Tests">Tests</a></li>
        <li><a data-toggle="tab" href="#Mid">Mid-Term</a></li>
        <li><a data-toggle="tab" href="#Exam">Final Exams</a></li>
         <li><a data-toggle="tab" href="#Cum">Cummulative</a></li>
        </ul>
                        <div class="tab-content">
                            <div id="Assignments" class="tab-pane fade in active">
                                 <form role="form" action="save_assign.php" method="post">
                                <table class="table table-hover table-bordered">
                                    <thead class = "panel panel-blue">
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th colspan="2">Student</th>
                                    <?php 
                                        global $connection;
                                        $query = "SELECT * FROM assignment_collection WHERE course_code= '{$_GET['course_code']}'";
                                        $getCollection = mysqli_query($connection, $query);
                                        confirm_query($getCollection);
                                        $num_collection = mysqli_num_rows($getCollection);
                                        $ass=0;
                                        while($collection = mysqli_fetch_assoc($getCollection)){
                                            $ass++; ?>
                                            <th>HW <?php echo $ass;?></th>
                                        <?php
                                            
                                        }
                                        $_SESSION['assignment'] = $ass;
                                    ?>
                                        <th><span class="label label-sm label-success">Total</span></th>
                                        <th><span class="label label-sm label-success">%</span></th>
                                        <th><span class="label label-sm label-success">Grade</span></th>
                                    </tr>
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <?php 
                                            $query = "SELECT * FROM assignment_collection WHERE course_code= '{$_GET['course_code']}'";
                                        $new_collection = mysqli_query($connection, $query);
                                        confirm_query($new_collection);
                                            $total_scores_assignment=0;
                                        while($mcollection = mysqli_fetch_assoc($new_collection)){
                                            $total_scores_assignment = $total_scores_assignment + $mcollection['weight'];
                                            ?>
                                        <th><?php echo $mcollection['weight']; ?></th>
                                        <?php
                                        }
                                        ?>
                                        <th><?php echo $total_scores_assignment; ?></th>
                                        <th>100 %</th>
                                        <th>A</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                       
                                    
                <?php
                        global $connection;
                        $num_count = 0;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $num_count++;
                            ?>
                                    <tr>
                                    <td><?php echo $num_count; ?></td>
                                    <td><?php echo $member['first_name']; ?></td>
                                     <td><?php echo $member['last_name']; ?></td>
                                    <?php 
                                        $i=1;
                                        $total_assignment_weight=0;
                                     while($i<=$ass){
                                         $query = "SELECT score FROM assignment_scores WHERE assignment_id = {$i} AND user_id ={$member['user_id']} AND course_code = '{$_GET['course_code']}' ";
                                         $get_score = mysqli_query($connection, $query);
                                         confirm_query($get_score);
                                         $assignment_score = mysqli_fetch_assoc($get_score);
                                        echo "<td><input type='text' name='{$member['first_name']}{$i}' value='{$assignment_score['score']}'></td>";
                                         $total_assignment_weight = $total_assignment_weight + $assignment_score['score'];
                                        $i++;
                                            }
                                        ?>
                                         <th><?php echo $total_assignment_weight; ?></th>
                            <th><?php if($total_scores_assignment !=0 ){ echo round(($total_assignment_weight/$total_scores_assignment)*100, 3);}?></th>
                                        <th><?php if($total_scores_assignment !=0 ){LG(($total_assignment_weight/$total_scores_assignment) * 100);} ?></th>
                                        </tr>
                                        
                <?php
                                            $scores_assignment[] = $total_assignment_weight;
                            }

                        }
                        
                    ?>
 
                                    </tbody>                            
                                </table>
                <input type="hidden" value="<?php echo $_GET['course']; ?>" name="course">
                <input type="hidden" value="<?php echo $_GET['course_code']; ?>" name="course_code">
                <input type="hidden" value="<?php echo $_SESSION['assignment']; ?>" name="num_assignment">
                <input class="btn btn-default" type="submit" value="Save Scores" name="submit">
                 </form>
                            </div>
                            <div id="Quizzes" class="tab-pane fade">
                            <table class="table table-hover table-bordered">
                                    <thead class = "panel panel-blue">
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th colspan="2">Student</th>
                                    <?php 
                                        global $connection;
                                        $query = "SELECT * FROM quiz_collection WHERE course_code= '{$_GET['course_code']}'";
                                        $getCollection = mysqli_query($connection, $query);
                                        confirm_query($getCollection);
                                        $num_collection = mysqli_num_rows($getCollection);
                                        $quiz=0;
                                        while($collection = mysqli_fetch_assoc($getCollection)){
                                            $quiz++; ?>
                                            <th>Quiz <?php echo $quiz;?></th>
                                        <?php
                                            
                                        }
                                    ?>
                                        <th><span class="label label-sm label-success">Total</span></th>
                                        <th><span class="label label-sm label-success">%</span></th>
                                        <th><span class="label label-sm label-success">Grade</span></th>
                                    </tr>
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <?php 
                                            $query = "SELECT * FROM quiz_collection WHERE course_code= '{$_GET['course_code']}'";
                                        $new_collection = mysqli_query($connection, $query);
                                        confirm_query($new_collection);
                                            $total_scores_quiz=0;
                                        while($mcollection = mysqli_fetch_assoc($new_collection)){
                                            $total_scores_quiz = $total_scores_quiz + $mcollection['weight'];
                                            ?>
                                        <th><?php echo $mcollection['weight']; ?></th>
                                        <?php
                                        }
                                        ?>
                                        <th><?php echo $total_scores_quiz; ?></th>
                                        <th>100 %</th>
                                        <th>A</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                <?php
                        global $connection;
                        $num_count = 0;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $num_count++;
                            ?>
                                    <tr>
                                    <td><?php echo $num_count; ?></td>
                                    <td><?php echo $member['first_name']; ?></td>
                                     <td><?php echo $member['last_name']; ?></td>
                                    <?php 
                                        $i=1;
                                        $my_score=0;
                                     while($i<=$quiz){
                                $query = "SELECT score FROM quiz_scores WHERE quiz_id = {$i} AND user_id ={$member['user_id']} AND course_code = '{$_GET['course_code']}' ";
                                         $moodle_score = mysqli_query($connection, $query);
                                         confirm_query($moodle_score);
                                         $moodle=mysqli_fetch_assoc($moodle_score);
                                        echo "<td>{$moodle['score']}</td>";
                                         $my_score=$my_score + $moodle['score'];
                                        $i++;
                                            }
                                        ?>
                                         <th><?php echo $my_score; ?></th>
                                        <th><?php echo round(($my_score/$total_scores_quiz) * 100,3); ?>%</th>
                                        <th><?php LG(($my_score/$total_scores_quiz) * 100) ?></th>
                                        </tr>
                <?php
                                            $scores_quiz[] = $my_score;
                            }

                        }
                        
                    ?>
                                    </tbody>                            
                                </table>
                            </div>
                            <div id="Tests" class="tab-pane fade">
                                <table class="table table-hover table-bordered">
                                    <thead class = "panel panel-blue">
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th colspan="2">Student</th>
                                    <?php 
                                        global $connection;
                                        $query = "SELECT * FROM test_collection WHERE course_code= '{$_GET['course_code']}'";
                                        $getCollection = mysqli_query($connection, $query);
                                        confirm_query($getCollection);
                                        $num_collection = mysqli_num_rows($getCollection);
                                        $ass=0;
                                        while($collection = mysqli_fetch_assoc($getCollection)){
                                            $ass++; ?>
                                            <th>Test <?php echo $ass;?></th>
                                        <?php
                                            
                                        }
                                    ?>
                                        <th><span class="label label-sm label-success">Total</span></th>
                                        <th><span class="label label-sm label-success">%</span></th>
                                        <th><span class="label label-sm label-success">Grade</span></th>
                                    </tr>
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <?php 
                                            $query = "SELECT * FROM test_collection WHERE course_code= '{$_GET['course_code']}'";
                                        $new_collection = mysqli_query($connection, $query);
                                        confirm_query($new_collection);
                                            $total_scores_test=0;
                                        while($mcollection = mysqli_fetch_assoc($new_collection)){
                                            $total_scores_test = $total_scores_test + $mcollection['weight'];
                                            ?>
                                        <th><?php echo $mcollection['weight']; ?></th>
                                        <?php
                                        }
                                        ?>
                                        <th><?php echo $total_scores_test; ?></th>
                                        <th>100 %</th>
                                        <th>A</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                <?php
                        global $connection;
                        $num_count = 0;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $num_count++;
                            ?>
                                    <tr>
                                    <td><?php echo $num_count; ?></td>
                                    <td><?php echo $member['first_name']; ?></td>
                                     <td><?php echo $member['last_name']; ?></td>
                                    <?php 
                                        $i=1;
                                        $my_total=0;
                                     while($i<=$ass){
                                         $query = "SELECT score FROM test_scores WHERE test_id = {$i} AND user_id ={$member['user_id']} AND course_code = '{$_GET['course_code']}' ";
                                         $moodle_score = mysqli_query($connection, $query);
                                         confirm_query($moodle_score);
                                         $moodle=mysqli_fetch_assoc($moodle_score);
                                        echo "<td>{$moodle['score']}</td>";
                                         $my_total =$my_total + $moodle['score'];
                                        $i++;
                                            }
                                        ?>
                                         <th><?php echo $my_total; ?></th>
                                        <th><?php echo round(($my_total/$total_scores_test) * 100,3); ?>%</th>
                                        <th><?php LG(($my_total/$total_scores_test) * 100) ?></th>
                                        </tr>
                <?php
                                            $scores_test[]= $my_total;
                            }

                        }
                        
                    ?>
                                    </tbody>                            
                                </table>
                            </div>
                            <div id="Mid" class="tab-pane fade ">
                                <form role="form" action="save_mid.php" method="post">
                            <table class="table table-hover table-bordered">
                                    <thead class = "panel panel-blue">
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th colspan="2">Student</th>
                                            <th>Mid-Term</th>
                                        <th><span class="label label-sm label-success">Total</span></th>
                                        <th><span class="label label-sm label-success">%</span></th>
                                        <th><span class="label label-sm label-success">Grade</span></th>
                                    </tr>
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>100</th>
                                        <th>100</th>
                                        <th>100 %</th>
                                        <th>A</th>
                                    </tr>
                                    </thead>
                                 
                                    <tbody>
                               
                                    
                <?php
                        global $connection;
                        $num_count = 0;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $num_count++;
                            ?>
                                    <tr>
                                    <td><?php echo $num_count; ?></td>
                                    <td><?php echo $member['first_name']; ?></td>
                                     <td><?php echo $member['last_name']; ?></td>
                                        <?php 
                                        $total_mid_weight=0;
                                         $query = "SELECT grade FROM mid_term WHERE user_id ={$member['user_id']} AND course_code = '{$_GET['course_code']}' ";
                                         $get_score = mysqli_query($connection, $query);
                                         confirm_query($get_score);
                                         $mid_score = mysqli_fetch_assoc($get_score);
                                        echo "<td><input type='text' name='{$member['first_name']}' value='{$mid_score['grade']}'></td>";
                                         $total_mid_weight =  $mid_score['grade'];
                                        ?>
                                        
                                        <th><?php echo $total_mid_weight; ?></th>
                                        <th><?php echo ($total_mid_weight/100)*100 ?>%</th>
                                        <th><?php LG(($total_mid_weight/100) * 100) ?></th>
                                        </tr>
                <?php
                           
                            $scores_mid[]=$total_mid_weight;
                            }

                        }
                        
                    ?>
                                    </tbody>                            
                                </table>
                <input type="hidden" value="<?php echo $_GET['course']; ?>" name="course">
                <input type="hidden" value="<?php echo $_GET['course_code']; ?>" name="course_code">
    <input type="submit" class="btn btn-default" name="submit" value="Save"> 
    </form>
                            </div>
                            <div id="Exam" class="tab-pane fade ">
                                <form role="form" action="save_exam.php" method="post">
                                <table class="table table-hover table-bordered">
                                    <thead class = "panel panel-blue">
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th colspan="2">Student</th>
                                            <th>Final Exam</th>
                                        <th><span class="label label-sm label-success">Total</span></th>
                                        <th><span class="label label-sm label-success">%</span></th>
                                        <th><span class="label label-sm label-success">Grade</span></th>
                                    </tr>
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>100</th>
                                        <th>100</th>
                                        <th>100 %</th>
                                        <th>A</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                <?php
                        global $connection;
                        $num_count = 0;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                $num_count++;
                            ?>
                                    <tr>
                                    <td><?php echo $num_count; ?></td>
                                    <td><?php echo $member['first_name']; ?></td>
                                     <td><?php echo $member['last_name']; ?></td>
                                        <?php 
                                        $total_exam_weight=0;
                                         $query = "SELECT grade FROM exam_score WHERE user_id ={$member['user_id']} AND course_code = '{$_GET['course_code']}' ";
                                         $get_score = mysqli_query($connection, $query);
                                         confirm_query($get_score);
                                         $exam_score = mysqli_fetch_assoc($get_score);
                                        echo "<td><input type='text' name='{$member['first_name']}' value='{$exam_score['grade']}'></td>";
                                         $total_exam_weight +=  $exam_score['grade'];
                                        ?>
                                        
                                        <th><?php echo $total_exam_weight; ?></th>
                                        <th><?php echo ($total_exam_weight/100)*100 ?>%</th>
                                        <th><?php LG(($total_exam_weight/100) * 100) ?></th>
                                        </tr>
                <?php
                            $scores_exam[]=$total_exam_weight;
                            }

                        }
                        
                    ?>
                                    </tbody>                            
                                </table>
                <input type="hidden" value="<?php echo $_GET['course']; ?>" name="course">
                <input type="hidden" value="<?php echo $_GET['course_code']; ?>" name="course_code">
                <input type="submit" class="btn btn-default" name="submit" value="Save"> 
    </form>
                            </div>
                            <div id="Cum" class="tab-pane fade">
                                <form role="form" method="post" action="save_final.php">
                                    <table class="table table-hover table-bordered">
                                    <thead class = "panel panel-blue">
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th colspan="2">Student</th>
                                        <th><span class="label label-sm label-success">Assignments</span></th>
                                        <th><span class="label label-sm label-success">Quizzes</span></th>
                                        <th><span class="label label-sm label-success">Tests</span></th>
                                        <th><span class="label label-sm label-success">Mid Term</span></th>
                                        <th><span class="label label-sm label-success">Finals</span></th>
                                        <th><span class="label label-sm label-success">Total Weight</span></th>
                                        <th><span class="label label-sm label-success">%</span></th>
                                        <th><span class="label label-sm label-success">Grade</span></th>
                                    </tr>
                                    <tr style = "text-align:center">
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th><?php echo $total_scores_assignment;?></th>
                                        <th><?php echo $total_scores_quiz;?></th>
                                        <th><?php echo $total_scores_test;?></th>
                                        <th>100</th>
                                        <th>100</th>
                                        <th><?php $final_grade = $total_scores_assignment + $total_scores_quiz + $total_scores_test + 100 + 100; 
                                        echo $final_grade; ?></th>
                                        <th>100 %</th>
                                        <th>A</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                <?php
                        global $connection;
                        $num_count = 0;
                        $query = "SELECT course_id FROM courses WHERE course_code = '{$_GET['course_code']}' ";
                        $get_student_class = mysqli_query($connection, $query);
                        confirm_query($get_student_class);
                        $student_class = mysqli_fetch_assoc($get_student_class);
                        $query = "SELECT student_email FROM course_reg WHERE course_id = {$student_class['course_id']} AND faculty = 'No' ";
                        $get_forum_students = mysqli_query($connection, $query);
                        confirm_query($get_forum_students);
                        while($forum_students = mysqli_fetch_assoc($get_forum_students)){
                            $query = "SELECT user_id, first_name, last_name FROM users WHERE email = '{$forum_students['student_email']}' ";
                            $get_member = mysqli_query($connection, $query);
                            confirm_query($get_member);
                            while($member = mysqli_fetch_assoc($get_member)){
                                
                            ?>
                                    <tr>
                                    <td><?php echo $num_count; ?></td>
                                    <td><?php echo $member['first_name']; ?></td>
                                     <td><?php echo $member['last_name']; ?></td>
                                        <th><?php echo $scores_assignment[$num_count]; ?></th>
                                        <th><?php echo $scores_quiz[$num_count]; ?></th>
                                        <th><?php echo $scores_test[$num_count]; ?></th>
                                        <th><?php echo $scores_mid[$num_count]; ?></th>
                                        <th><?php echo $scores_exam[$num_count]; ?></th>
                                        <th><?php $new_total= $scores_assignment[$num_count] + $scores_quiz[$num_count] + $scores_test[$num_count]+$scores_mid[$num_count]+$scores_exam[$num_count]; echo $new_total?></th>
                                        <th><?php echo round(($new_total/$final_grade) * 100, 3); ?></th>
                                        <th><?php LG(($new_total/$final_grade) * 100); ?></th>
                                        </tr>
                <input type="hidden" name="<?php echo $member['first_name']; ?>mid" value="<?php LG($scores_mid[$num_count]); ?>">
                <input type="hidden" name="<?php echo $member['first_name']; ?>lg" value="<?php LG(($new_total/$final_grade) * 100); ?>">
                 <input type="hidden" name="<?php echo $member['first_name']; ?>grade" value="<?php echo round(($new_total/$final_grade) * 100, 3); ?>">
                <?php
                                $num_count++;
                            }

                        }
                        
                    ?>
                                    </tbody>                            
                                </table>
                                    <input type="hidden" name="course" value="<?php echo $_GET['course']; ?>">
                                    <input type="hidden" name="course_code" value="<?php echo $_GET['course_code']; ?>">
                                    <input list="birth_year" name="academic_year" placeholder="Academic Year">
                                        <datalist id="birth_year">
                                    <?php 
          $right_now = getdate();
          $this_year = $right_now['year'];
          $end_year = 2020;
          while ($this_year <= $end_year) {
              echo "<option>{$this_year}</option>";
              $this_year++;
          }
         ?>
     </datalist>
                                    <input class="btn btn-default" type="submit" name="submit" value="Save">
                                </form>
                            </div>
                        </div>
                        </div>
                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
 <?php require_once('../../includes/footer.php')?>