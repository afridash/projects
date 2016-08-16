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
                            Physics Laboratories</div>
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
                    <a href="../../Laboratories/Physics/Html5/balancing-act_en.html"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Balancing-Act.png" alt = "Generic place holder image" width="200px" height="200px"><br/>BALANCING ACT</a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/bending-light_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Bending-Light.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BENDING LIGHT </a> 
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/build-an-atom_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Build-an-Atom.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BUILD AN ATOM  </a> 
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/color-vision_en.html"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Color-Vision.png" alt = "Generic place holder image" width="200px" height="200px"> <br> COLOR VISION </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/energy-skate-park-basics_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Energy-Skate-Park-Basics.png" alt = "Generic place holder image" width="200px" height="200px"> <br> ENERGY SKATE PARK - BASICS </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/forces-and-motion-basics_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Forces-and-Motion-Basics.png" alt = "Generic place holder image" width="200px" height="200px"> <br> FORCES AND MOTION - BASICS </a>
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/friction_en.html"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Friction.png" alt = "Generic place holder image" width="200px" height="200px"> <br> FRICTION </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/gravity-force-lab_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Gravity-Force-Lab.png" alt = "Generic place holder image" width="200px" height="200px"> <br> GRAVITY FORCE LAB </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/hookes-law_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Hooke's-Law.png" alt = "Generic place holder image" width="200px" height="200px"> <br> HOOKE'S LAW </a>
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/john-travoltage_en.html"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/John-Travoltage.jpg" alt = "Generic place holder image" width="200px" height="200px"> <br> JOHN TRAVOLTAGE </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/molecules-and-light_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Molecules-and-Light.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MOLECULES AND LIGHT </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/ph-scale_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/pH-ScaleAdvance.jpg" alt = "Generic place holder image" width="200px" height="200px"> <br> PH-SCALE (ADVANCED) </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/ohms-law_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Ohm's-Law.png" alt = "Generic place holder image" width="200px" height="200px"> <br> OHM'S LAW </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/resistance-in-a-wire_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Resistance-in-a-Wire.png" alt = "Generic place holder image" width="200px" height="200px"> <br> RESISTANCE IN A WIRE </a>
                    </div>
                      
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/under-pressure_en.html"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Under-Pressure.PNG" alt = "Generic place holder image" width="200px" height="200px"> <br> UNDER PRESSURE </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Physics/Html5/wave-on-a-string_en.html"><img class = "img-thumb" src="../../Laboratories/Physics/PhysicsImages/Wave-on-a-String.png" alt = "Generic place holder image" width="200px" height="200px"> <br> WAVE ON A STRING </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/blackbody-spectrum_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Blackbody-Spectrum.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BLACKBODY SPECTRUM </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/buoyancy_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Buoyancy.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BUOYANCY </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/calculus-grapher_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Calculus-Grapher.png" alt = "Generic place holder image" width="200px" height="200px"> <br> CALCULUS GRAPHER </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/charges-and-fields_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Charges-and-Fields.PNG" alt = "Generic place holder image" width="200px" height="200px"> <br> CHARGES AND FIELDS </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/collision-lab_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Collision-Lab.png" alt = "Generic place holder image" width="200px" height="200px"> <br> COLLISION LAB </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/density_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Density.png" alt = "Generic place holder image" width="200px" height="200px"> <br> DENSITY </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/geometric-optics_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Geometric-Optics.png" alt = "Generic place holder image" width="200px" height="200px"> <br> GEOMETRIC OPTICS </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/lunar-lander_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Lunar-Lander.png" alt = "Generic place holder image" width="200px" height="200px"> <br> LUNAR LANDER </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/mass-spring-lab_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Masses-&-Springs.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MASS SPRING LAB </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/my-solar-system_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/My-Solar-System.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MY SOLAR SYSTEM </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/normal-modes_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Normal-Modes.png" alt = "Generic place holder image" width="200px" height="200px"> <br> NORMAL MODES </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/pendulum-lab_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Pendulum-Lab.png" alt = "Generic place holder image" width="200px" height="200px"> <br> PENDULUM LAB </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/projectile-motion_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Projectile-Motion.png" alt = "Generic place holder image" width="200px" height="200px"> <br> PROJECTILE MOTION </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/radiating-charge_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Radiating-Charge.png" alt = "Generic place holder image" width="200px" height="200px"> <br> RADIATING CHARGE </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/resonance_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Resonance.png" alt = "Generic place holder image" width="200px" height="200px"> <br> RESONANCE </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Physics/flashplayer/stern-gerlach_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Physics/PhysicsImages/Stern-Gerlach-Experiment.png" alt = "Generic place holder image" width="200px" height="200px"> <br> STERN GERLACH </a>
                    </div>
                        
                </div>
                </div>
 <?php require_once('../../includes/footer.php')?>