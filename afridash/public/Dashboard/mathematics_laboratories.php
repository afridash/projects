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
                            Mathematics Laboratories</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Laboratories</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                
                <!--BEGIN SIMULATIONS-->
                <div class="page-content">
                    <div class="row">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                </div>
                    <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/area-builder_en.html"> <img class = "img-thumb" src ="../../Laboratories/Maths/MathImages/area-builder.png" alt = "Generic place holder image" width="200px" height="200px"><br/> AREA BUILDER </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/arithmetic_en.html"><img class = "img-thumb" src="../../Laboratories/Maths/MathImages/arithmetic.png" alt = "Generic place holder image" width="200px" height="200px"> <br> ARITHMETIC </a> 
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/balancing-act_en.html"><img class = "img-thumb" src="../../Laboratories/Maths/MathImages/balancing-act.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BALANCING ACT  </a> 
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/fraction-matcher_en.html"> <img class = "img-thumb" src ="../../Laboratories/Maths/MathImages/Fraction-Matcher.PNG" alt = "Generic place holder image" width="200px" height="200px"> <br> FRACTION MATCHER </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/graphing-lines_en.html"><img class = "img-thumb" src="../../Laboratories/Maths/MathImages/graphing-lines.png" alt = "Generic place holder image" width="200px" height="200px"> <br> GRAPHING LINES </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/hookes-law_en.html"><img class = "img-thumb" src="../../Laboratories/Maths/MathImages/Hooke's-Law.png" alt = "Generic place holder image" width="200px" height="200px"> <br> HOOKE'S LAW </a>
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/least-squares-regression_en.html"> <img class = "img-thumb" src ="../../Laboratories/Maths/MathImages/least-squares-regression.png" alt = "Generic place holder image" width="200px" height="200px"> <br>LEAST SQUARE REGRESSION</a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Maths/Html5/ohms-law_en.html"><img class = "img-thumb" src="../../Laboratories/Maths/MathImages/ohms-law.png" alt = "Generic place holder image" width="200px" height="200px"> <br> OHM'S LAW </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="../../Laboratories/Maths/Html5/resistance-in-a-wire_en.html"> <img class = "img-thumb" src ="../../Laboratories/Maths/MathImages/resistance-in-a-wire.png" alt = "Generic place holder image" width="200px" height="200px"> <br>RESISTANCE IN A WIRE</a>
                    </div>
                </div>
                </div>
 <?php require_once('../../includes/footer.php')?>