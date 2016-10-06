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
<?php
global $connection;
$query = "SELECT * FROM department ORDER BY department_name ASC";
$departments = mysqli_query($connection, $query);
confirm_query($departments);
?>
<?php require_once("../../includes/header.php");?>
          <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Search Classes</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Search Classes</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Search Classes</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                                <p>Choose a Subject and a Level for all available courses:</p>
  <form role="form" action="class_registration.php" method="post">
    <div class="col-md-6">
    <div class="form-group">
      <label for="sel1">Subjects:</label>
      <select class="form-control" id="sel1" name="subject">
          <option></option>
          <?php 
          while($dept = mysqli_fetch_assoc($departments)){
              ?>
              <option value="<?php echo $dept['department_name']?>"><?php echo $dept['department_name']?></option>
          <?php
          }
          ?>
      </select>
      <br>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
      <label for="sel1">Level</label>
      <select class="form-control" id="sel2" name="level">
        <option></option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="300">300</option>
        <option value="400">400</option>
        <option value="500">500</option>
      </select>
      <br>
    </div>
      </div>
    <br>
  </form>
            <div id="SearchResult"></div>                

                        </div>
        </div>
<div id="area-chart-spline" style="width: 100%; height: 300px; display:none;"></div>
 <?php require_once('../../includes/footer.php')?>
</script>