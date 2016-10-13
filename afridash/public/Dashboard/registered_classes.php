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
$student_classes = mysqli_query($connection, $query);
confirm_query($student_classes);
?>
<?php confirm_if_user_logged_in(); ?> 
<?php require_once("../../includes/header.php");?>
<div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Registered Classes</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Registered Classes</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                     <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Description</th>
                    <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            while($student_data = mysqli_fetch_assoc($student_classes)){
            $query = "SELECT * FROM courses WHERE course_id = {$student_data['course_id']} ORDER BY course_id ASC ";
            $class = mysqli_query($connection, $query);
            confirm_query($class);
            while($courses = mysqli_fetch_assoc($class)){
            ?>
         <tr>
            <td><?php echo $courses['course_title'];?></td>
            <td><?php echo $courses['course_code'];?></td>
            <td><?php echo $courses['course_credit'];?></td>
            <td><?php echo $courses['course_description'];?></td>
            <td><?php echo $courses['course_semester'];?></td></tr>
        <?php   
        }?>
    <?php }?>
            </tbody>
        </table>
        </div>
    </div>
                            </div>               
    </div>
            
       
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                        
 </div>
    </div>
                


 <?php require_once('../../includes/footer.php')?>