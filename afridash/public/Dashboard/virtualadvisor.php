<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
?>
<?php 
    confirm_if_user_logged_in();
check_mobile();
?>

<?php require_once("../../includes/header.php");?>
          <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            VIRTUAL ADVISOR</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Virtual Advisor</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Virtual Advisor</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-md-12 col-sm-12 col-lg-12 ">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 ">
                                        <div class="resources">
                                            <div class="resourcesContainer">
                                                <p class="lead">Registration</p>
                                            </div>
                                    
                                       <div class="list-group">
                                    <a href="search_classes.php" class="list-group-item list-group-item-action">Search For Classes</a>
                                    <a href="registration.php" class="list-group-item list-group-item-action">Add Classes</a>
                                    <a href="class_registration.php" class="list-group-item list-group-item-action">Register Classes</a>
                                    <a href="registered_classes.php" class="list-group-item list-group-item-action disabled">Class Schedule</a>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                     <div class="resources">
                                    <div class="resourcesContainer">
                                    <p class="lead">Academic Module</p>        
                                    </div>
                                    <div class="list-group">
                                    <a href="grade.php" class="list-group-item list-group-item-action">Grades</a>
                                    <a href="#" class="list-group-item list-group-item-action">Term GPA</a>
                                    <a href="transcript.php" class="list-group-item list-group-item-action disabled">Transcript</a>
                                    <a href="#" class="list-group-item list-group-item-action disabled">Program Evaluation</a>
                                    
                                    </div>
                                    </div>
                                    </div>
                                    
                                     <div class="col-sm-6 col-md-6 col-lg-6">
                                     <div class="resources">
                                            <div class="resourcesContainer">
                                                <p class="lead">Virtual Intelligence</p>
                                            
                                    </div>
                                    <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">Resume Generator</a>
                                    <a href="#" class="list-group-item list-group-item-action">Graduation Plan Generator</a>
                                    <a href="#" class="list-group-item list-group-item-action">Virtual Mentor</a>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                     <div class="resources">
                                            <div class="resourcesContainer">
                                                <p class="lead">My Documents</p>
                                            
                                    </div>
                                    <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">My Resume</a>
                                    <a href="#" class="list-group-item list-group-item-action">My Transcript</a>
                                    <a href="#" class="list-group-item list-group-item-action">My Cover Letter</a>
                                    </div>
                                    </div>
                                    </div>
                                 
                                </div>
                            </div>
                            
                            
                        </div>
        </div>
<div id="area-chart-spline" style="width: 100%; height: 300px; display:none;"></div>
 <?php require_once('../../includes/footer.php')?>