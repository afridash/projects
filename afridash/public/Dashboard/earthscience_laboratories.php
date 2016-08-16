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
                            Earth Science Laboratories</div>
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
                    <a href="../../Laboratories/EarthScience/Html5/molecules-and-light_en.html"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/Molecules&Light.png" alt = "Generic place holder image" width="200px" height="200px"><br/> MOLECULES AND LIGHT </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Html5/ph-scale_en.html"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/pHscale.png" alt = "Generic place holder image" width="200px" height="200px"><br/> pH SCALE </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Html5/under-pressure_en.html"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/UnderPressure.png" alt = "Generic place holder image" width="200px" height="200px"><br/> UNDER PRESSURE </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Html5/wave-on-a-string_en.html"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/wavesOnStrings.png" alt = "Generic place holder image" width="200px" height="200px"><br/> WAVES ON A STRING </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/balloons-and-buoyancy_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/BalloonsBuoyancy.png" alt = "Generic place holder image" width="200px" height="200px"><br/> BALLOONS AND BUOYANCY </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/fluid-pressure-and-flow_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/FluidPressure.png" alt = "Generic place holder image" width="200px" height="200px"><br/> FLUID PRESSURE AND FLOW </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/gas-properties_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/gasProperties.png" alt = "Generic place holder image" width="200px" height="200px"><br/> GAS PROPERTIES </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/glaciers_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/glacier.png" alt = "Generic place holder image" width="200px" height="200px"><br/> GLACIERS </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/gravity-and-orbits_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/gravityOrbits.png" alt = "Generic place holder image" width="200px" height="200px"><br/> GRAVITY AND ORBITS </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/greenhouse_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/green-house-md.png" alt = "Generic place holder image" width="200px" height="200px"><br/> GREENHOUSE </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/plate-tectonics_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/PlateTectonics.png" alt = "Generic place holder image" width="200px" height="200px"><br/> PLATE TECTONICS </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/radioactive-dating-game_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/RadioactiveDating.png" alt = "Generic place holder image" width="200px" height="200px"><br/> RADIOACTIVE DATING GAME </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/sound_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/Sound.png" alt = "Generic place holder image" width="200px" height="200px"><br/> SOUND </a>
                    </div>
                
                <div class="col-md-3">
                    <a href="../../Laboratories/EarthScience/Java/wave-interference_en.jar"> <img class = "img-thumb" src ="../../Laboratories/EarthScience/EarthSciencImages/WaveInterference.png" alt = "Generic place holder image" width="200px" height="200px"><br/> WAVE INTERFERENCE </a>
                    </div>
                
 <?php require_once('../../includes/footer.php')?>