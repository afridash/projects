<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php 
$errors= array();
global $connection;
$query = "SELECT * FROM department ORDER BY department_name ASC";
$departments = mysqli_query($connection, $query);
confirm_query($departments);
?>
<?php
global $connection;
if(isset($_POST['register'])){
    if(!empty($_POST['check_list'])){
    foreach($_POST['check_list'] as $class){
    if(registered($_SESSION['email'], $class)){
        $_SESSION['Registered'] = "That class has already been registered";
        redirect_to('class_registration.php');
    }
       
    if(!registered($_SESSION['user_id'], $class)){
    $query = "INSERT INTO course_reg(student_email, course_id) VALUES('{$_SESSION['email']}', {$class})";
    $registered = mysqli_query($connection, $query);
    confirm_query($registered);
        }
    }
        redirect_to('registered_classes.php');
    }
}
?>
<?php require_once("../../includes/header.php");?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Add Classes</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Add Classes</li>
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
    <p>Choose a Subject and a Level for all available courses:</p>
  <form role="form" action="class_registration.php" method="post">
    <div class="col-md-6">
    <div class="form-group">
      <label for="sel1">Subjects:</label>
      <select class="form-control" id="sel3" name="subject">
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
      <select class="form-control" id="sel4" name="level">
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
  </form>
     <?php echo form_errors($errors);?>
    <?php if(isset($_SESSION['Registered'])){echo $_SESSION['Registered'];}
    $_SESSION['Registered'] = "";
    ?>
<div class="SearchResult1"></div> 
                        <div class="row mbl">
                            <div class="col-md-8">
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                            </div>
                        </div>


                    </div>
                </div>
                            </div>
                    </div>


 <?php require_once('../../includes/footer.php')?>