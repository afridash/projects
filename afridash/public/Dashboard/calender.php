<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php require_once("../../includes/header.php");?>
                <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                           My Calender </div>
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
                    <div class="tab-general">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
<!-- define the calendar element -->
                        <div class="col-lg-8" id="my-calendar"></div>
                        <div class="col-md-4">
                        <?php 
                            require("todo.php");
                            ?>
	                   </div><!-- End Container -->

                    </div>

<!-- JS ======================================================= --> 
<script type="application/javascript">
    $(document).ready(function () {
        $("#my-calendar").zabuto_calendar({
            ajax: {
          url: "show_data.php",
          modal: true
      },
      cell_border: true,
      today: true,
      show_days: true,
      weekstartson: 0,
      nav_icon: {
        prev: '<i class="fa fa-chevron-circle-left fa-lg"></i>',
        next: '<i class="fa fa-chevron-circle-right fa-lg"></i>'
      }
        });
    });
</script>
<script type="text/javascript" src="script/todo.js"></script>
 <?php require_once('../../includes/footer.php')?>