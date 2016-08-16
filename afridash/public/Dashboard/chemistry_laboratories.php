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
                            Chemistry Laboratories</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Laboratories</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="row">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                </div>
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/balancing-chemical-equations_en.html"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/Chemicalbalance.gif" alt = "Generic place holder image" width="200px" height="200px"><br/>BALANCING CHEMICAL EQUATIONS </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/acid-base-solutions_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/AcidSolution.png" alt = "Generic place holder image" width="200px" height="200px"> <br> ACID-BASE SOLUTIONS </a> 
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/BalloonsandStaticElectricity1.0.0.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/BallonElectric.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BALLOONS AND STATIC ELECTRICITY  </a> 
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/beers-law-lab_en.html"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/beer's_law.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BEER'S LAW </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/build-an-atom_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/atom.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BUILD ATOMS </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/concentration_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/concentration.png" alt = "Generic place holder image" width="200px" height="200px"> <br> CONCENTRATION OF SOLUTIONS </a>
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/molarity_en.html"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/Molarity.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MOLARITY </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/molecule-shapes-basics_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/MoleculeShapes.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MOLECULE SHAPES (BASICS)</a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/molecule-shapes_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/MoleculeAdvance.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MOLECULE SHAPES (ADVANCE)</a>
                    </div>
                    
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/molecules-and-light_en.html"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/Molecules&Light.gif" alt = "Generic place holder image" width="200px" height="200px"> <br> MOLECULE AND LIGHT </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/ph-scale-basics_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/PhScale.jpg" alt = "Generic place holder image" width="200px" height="200px"> <br> PH-SCALE (BASICS) </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/ph-scale_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/pH-ScaleAdvance.jpg" alt = "Generic place holder image" width="200px" height="200px"> <br> PH-SCALE (ADVANCED) </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/reactants-products-and-leftovers_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/ReactionReactants.png" alt = "Generic place holder image" width="200px" height="200px"> <br> REACTANTS AND PRODUCTS </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Html5/wave-on-a-string_en.html"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/WavesStrings.jpg" alt = "Generic place holder image" width="200px" height="200px"> <br> WAVES ON A STRING </a>
                    </div>
                      
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/alpha-decay_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/AlphaDecay.png" alt = "Generic place holder image" width="200px" height="200px"> <br> ALPHA DECAY </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/atomic-interactions_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/AtomicInteractions.png" alt = "Generic place holder image" width="200px" height="200px"> <br> ATOMIC INTERACTIONS </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/balloons-and-buoyancy_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/BalloonsBuoyancy.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BALLOONS AND BUOYANCY </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/beta-decay_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/BetaDecay.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BETA DECAY </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/build-a-molecule_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/BuildingMolecules.png" alt = "Generic place holder image" width="200px" height="200px"> <br> BUILD A MOLECULE </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/discharge-lamps_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/dischargeLamp.png" alt = "Generic place holder image" width="200px" height="200px"> <br> DISCHARGE LAMPS </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/gas-properties_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/gasProperties.png" alt = "Generic place holder image" width="200px" height="200px"> <br> GAS PROPERTIES </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/greenhouse_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/green-house-md.png" alt = "Generic place holder image" width="200px" height="200px"> <br> GREEN HOUSE </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/hydrogen-atom_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/HydrogenAtom.png" alt = "Generic place holder image" width="200px" height="200px"> <br> HYDROGEN ATOM </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/isotopes-and-atomic-mass_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/Isotopes12C.png" alt = "Generic place holder image" width="200px" height="200px"> <br> ISOTOPES AND ATOMIC MASS </a>
                    </div>
                        
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/microwaves_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/MicroWaves.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MICROWAVES </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/molecule-polarity_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/MoleculePolarity.png" alt = "Generic place holder image" width="200px" height="200px"> <br> MOLECULE POLARITY </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/nuclear-fission_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/NuclerFission.png" alt = "Generic place holder image" width="200px" height="200px"> <br> NUCLEAR FISSION </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/photoelectric_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/Photoelectric.png" alt = "Generic place holder image" width="200px" height="200px"> <br> PHOTOELECTRIC </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/radio-waves_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/RadioWaves.png" alt = "Generic place holder image" width="200px" height="200px"> <br> RADIO WAVES </a>
                    </div>
                      
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/radioactive-dating-game_en.jar"> <img class = "img-thumb" src ="../../Laboratories/Chemistry/chemistryImages/RadioactiveDating.png" alt = "Generic place holder image" width="200px" height="200px"> <br> RADIOACTIVE DATING </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/reactions-and-rates_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/ReactionRates.png" alt = "Generic place holder image" width="200px" height="200px"> <br> REACTIONS AND RATES </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/reversible-reactions_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/reversiblereactions.png" alt = "Generic place holder image" width="200px" height="200px"> <br> REVERSIBLE REACTIONS </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/rutherford-scattering_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/RutherfordScattering.png" alt = "Generic place holder image" width="200px" height="200px"> <br> RUTHERFORD SCATTERING </a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/soluble-salts_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/solubleSalts.png" alt = "Generic place holder image" width="200px" height="200px"> <br> SOLUBLE SALTS </a>
                    </div>
                            
                    <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/states-of-matter-basics_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/statesMatterB.png" alt = "Generic place holder image" width="200px" height="200px"> <br> STATES OF MATTER (BASIC) </a>
                    </div>
                    
                     <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/states-of-matter_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/StatesMatterAdvance.png" alt = "Generic place holder image" width="200px" height="200px"> <br> STATES OF MATTER (ADVANCED)</a>
                    </div>
                 
                   <div class="col-md-3">
                    <a href="../../Laboratories/Chemistry/Java/sugar-and-salt-solutions_en.jar"><img class = "img-thumb" src="../../Laboratories/Chemistry/chemistryImages/sugar&salt.png" alt = "Generic place holder image" width="200px" height="200px"> <br> SUGAR AND SALT SOLUTIONS </a>
                    </div>
                        
                    </div>
 <?php require_once('../../includes/footer.php')?>