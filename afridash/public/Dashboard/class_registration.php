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
$post = FALSE;
if(isset($_POST['submit'])){
    $department = isset($_POST['subject'])? $_POST['subject']:"";
    $level = isset($_POST['level'])? $_POST['level']:"";
    global $connection;
    if(empty($department)){
    $errors['department'] = "The subject field cannot be empty ";
    }
    if(!empty($department) && !empty($level)){
        $post = TRUE;
        $query = " SELECT department_id FROM department WHERE department_name = '{$department}' ";
        $dept_id = mysqli_query($connection, $query);
        confirm_query($dept_id);
        $dept = mysqli_fetch_assoc($dept_id);
        $get_courses = " SELECT * FROM courses WHERE course_department = {$dept['department_id']} AND course_level = '{$level}'";
        $classes = mysqli_query($connection, $get_courses);
        confirm_query($classes);
        
    }
    if(!empty($department) && empty($level)){
        $post = TRUE;
        $query = "SELECT department_id FROM department WHERE department_name = '{$department}'";
        $dept_id = mysqli_query($connection, $query);
        confirm_query($dept_id);
        $dept = mysqli_fetch_assoc($dept_id);
        $get_courses = "SELECT * FROM courses WHERE course_department ={$dept['department_id']} ";
        $classes = mysqli_query($connection, $get_courses);
        confirm_query($classes);
    }
}
?>
<?php
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
                            Class Registration</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Class Registration</li>
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
              <option><?php echo $dept['department_name']?></option>
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
      <select class="form-control" id="sel1" name="level">
        <option></option>
        <option>100</option>
        <option>200</option>
        <option>300</option>
        <option>400</option>
        <option>500</option>
      </select>
      <br>
    </div>
      </div>
      <div align="center">
      <input type="submit" class="btn btn-primary btn-md" value="Submit" name="submit">
      </div>
  </form>
     <?php echo form_errors($errors);?>
    <?php if(isset($_SESSION['Registered'])){echo $_SESSION['Registered'];}
    $_SESSION['Registered'] = "";
    ?>
    <form role="form" action="class_registration.php" method="post">
    <?php if($post){
              ?>
     <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                    <th>Select</th>
                     <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Description</th>
                    <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
    <?php
          while($course = mysqli_fetch_assoc($classes)){
              ?>
            <tr>
            <td><input type="checkbox" name="check_list[]" value="<?php echo $course['course_id']?>"></td>
            <td><?php echo $course['course_title'];?></td>
            <td><?php echo $course['course_code'];?></td>
            <td><?php echo $course['course_credit'];?></td>
            <td><?php echo $course['course_description'];?></td>
            <td><?php echo $course['course_semester'];?></td></tr>

    <?php
          }?>
            </tbody>
        </table>
                        <div align="center" style="margin-bottom:50px;" >
    <input type="submit" class="btn btn-danger" name="register" value="Register">
        </div>
        </div>        
    </div>

    <?php
          }?>
</form>   
   </div>

                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                           
                      

                           
                    </div>
                </div>
                    </div>


 <?php require_once('../../includes/footer.php')?>