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
                        <div class="page-title">
                            Biology Laboratories</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Laboratories</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                    
                    
                    </div>
                    <div class="col-md-3">
                    <a href="../../Laboratories/Biology/Html5/ph-scale_en.html"> <img class = "img-thumb" src ="../../Laboratories/Biology/biologyimages/ph-scale-600.png" alt = "Generic place holder image" width="200px" height="200px"><br/>Ph Scale </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/Biology/Html5/color-vision_en.html"> <img class = "img-thumb" src ="../../Laboratories/Biology/biologyimages/color-vision-600.png" alt = "Generic place holder image" width="200px" height="200px"><br/>Color Vision </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/Biology/Html5/BalloonsandStaticElectricity1.0.0.html"><img class = "img-thumb" src="../../Laboratories/Biology/biologyimages/balloons-and-static-electricity-600.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BALLOONS AND STATIC ELECTRICITY  </a> 
                    </div>
                
                 <div class="col-md-3">
                    <a href="../../Laboratories/Biology/flashplayer/blackbody-spectrum_en"> <img class = "img-thumb" src ="../../Laboratories/Biology/biologyimages/blackbody-spectrum-600.png" alt = "Generic place holder image" width="200px" height="200px"><br/>Black body Spectrum</a>
                    </div>
                    
                </div>
 <?php require_once('../../includes/footer.php')?>