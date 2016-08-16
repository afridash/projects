<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>

<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$clist = mysqli_query($connection, $query);
confirm_query($clist);
?>
<style>
li {
    list-style: none;
    text-align: left;
}</style>
<?php require_once("../../includes/header.php");?>
<div id="contentOneTwo"></div>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Class List </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Classes</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="row mbl">
                    <div class="col-lg-12 col-sm-12">
                        <?php
                        while($list = mysqli_fetch_assoc($clist)){
                            $query = "SELECT * FROM courses WHERE course_id = {$list['course_id']} ORDER BY course_id ASC ";
                            $classes = mysqli_query($connection, $query);
                            confirm_query($classes);
                            while($course = mysqli_fetch_assoc($classes)){ ?>
                              <ul class="list-group">
                                 <li class="list-group-item"><a href="courses.php?course=<?php echo $course['course_title']?>&course_code=<?php echo $course['course_code']?>"><?php echo $course['course_title']?></a></li>
                            </ul>
                                <?php
                            } 
                         }?>

    </div>  
                        
                        
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display:none;">
                                                </div>
                     </div>
                </div>
                                

                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>