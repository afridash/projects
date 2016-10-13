<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php
global $connection;
$query = "SELECT * FROM course_prereg WHERE email = '{$_SESSION['email']}' ORDER BY id ASC";
$prereg_classes = mysqli_query($connection, $query);
$num_pre = mysqli_num_rows($prereg_classes);
confirm_query($prereg_classes);
?>
<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$student_classes = mysqli_query($connection, $query);
confirm_query($student_classes);
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
    $sql = "DELETE FROM course_prereg WHERE email='{$_SESSION['email']}' AND course_id={$class}";
    $removeClass = mysqli_query($connection, $sql);
    confirm_query($removeClass);
        }
    }
        redirect_to('class_registration.php');
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
     <?php echo form_errors($errors);?>
    <?php if(isset($_SESSION['Registered']))
{
    echo $_SESSION['Registered'];}
    $_SESSION['Registered'] = "";
    if($num_pre > 0){ ?>
    <input class="form-control" id="num_pre" type="hidden" value="<?php echo $num_pre?>">
    <form role="form" id="RegistrationForm" action="class_registration.php" method="post">
     <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                    <th>Registration</th>
                     <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Description</th>
                    <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
    <?php
          while($pre = mysqli_fetch_assoc($prereg_classes)){
              $query = "SELECT * FROM courses WHERE course_id= {$pre['course_id']}";
              $prereg = mysqli_query($connection, $query);
              confirm_query($prereg);
              $course = mysqli_fetch_assoc($prereg);
                  ?>
            <tr id="tr<?php echo "{$course['course_id']}"?>">
            <td><input type="checkbox" name="check_list[]" class="form-control" value="<?php echo "{$course['course_id']}"?>"> &nbsp;&nbsp;&nbsp;<a data-id="<?php echo "{$course['course_id']}"?>" href="#" id="dropClass"><i class="fa fa-times"></i></a></td>
            <td><?php echo $course['course_title'];?></td>
            <td><?php echo $course['course_code'];?></td>
            <td><?php echo $course['course_credit'];?></td>
            <td><?php echo $course['course_description'];?></td>
            <td><?php echo $course['course_semester'];?></td>
            </tr>
        <?php
          
          }?>
            </tbody>
        </table>
        </div>        
    </div>
<div align="center">
        <input type="submit" name="register" class="btn btn-primary" value="Submit"/>
        </div>
</form>  
<?php
    }?>
    <h1 class="text-center">Registered Classes</h1>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                    <th>Drop</th>
                     <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Description</th>
                    <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            while($student_data = mysqli_fetch_assoc($student_classes)){
            $query = "SELECT * FROM courses WHERE course_id = {$student_data['course_id']} ORDER BY course_id ASC ";
            $class = mysqli_query($connection, $query);
            confirm_query($class);
            while($courses = mysqli_fetch_assoc($class)){
            ?>
         <tr id="tr<?php echo "{$student_data['course_id']}"?>">
             <td><a data-id="<?php echo "{$student_data['course_id']}"?>" href="#" id="deleteClass"><i class="fa fa-times"></i></a></td>
            <td><?php echo $courses['course_title'];?></td>
            <td><?php echo $courses['course_code'];?></td>
            <td><?php echo $courses['course_credit'];?></td>
            <td><?php echo $courses['course_description'];?></td>
            <td><?php echo $courses['course_semester'];?></td></tr>
        <?php   
        }?>
    <?php }?>
            </tbody>
        </table>
        </div>
    </div>
        
   </div>

                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                           
                      

                           
                    </div>
                </div>
                    </div>


 <?php require_once('../../includes/footer.php')?>