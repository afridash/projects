<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); 
$errors = array();
$post = FALSE;
?>
<?php 
global $connection;
    if(isset($_POST['submit'])){
        $academic_year = isset($_POST['year'])? $_POST['year']:"";
        $semester = isset($_POST['semester']) ? $_POST['semester']: "";
        if(empty($academic_year)){
             $errors['year'] = "The academic year field cannot be empty ";
        }
    if(empty($semester)){
        $errors['semester'] = "Semester cannot be empty ";
    }
        if(empty($errors)){
            $query = "SELECT * FROM final_grades WHERE user_id = {$_SESSION['user_id']} AND academic_year = '{$academic_year}' AND semester = '{$semester}' ";
            $get_grades = mysqli_query($connection, $query);
            confirm_query($get_grades);
            $post = TRUE;
        }
    }
?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Select Semester</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Grade</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <div class="col-lg-8">
    <form role="form" action="" method="post">
     <?php echo form_errors($errors);?>
    <div class="col-md-6">
    <div class="form-group">
      <label for="sel1">ACADEMIC YEAR</label>
      <select class="form-control" id="sel1" name="year">
          <option></option>
         <?php 
                        $query = "SELECT DISTINCT(academic_year) FROM final_grades WHERE user_id = {$_SESSION['user_id']}";
                        $get_years = mysqli_query($connection, $query);
                        confirm_query($get_years);
                    while($this_year = mysqli_fetch_assoc($get_years)){
                        ?>
							<option><?php echo $this_year['academic_year']; ?></option>
                    <?php
                    }
                    ?>>
      </select>
      <br>
    </div>
        </div>
      <div class="col-md-6">
    <div class="form-group">
      <label for="sel1">SEMESTER</label>
      <select class="form-control" id="sel1" name="semester">
        <option></option>
        <option>First Semester</option>
        <option>Second Semester</option>
      </select>
      <br>
    </div>
      </div>
      <div align="center">
      <input type="submit" class="btn btn-primary btn-md" value="Submit" name="submit">
      </div>
  </form>
        <?php if($post){
              ?>
     <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                    <th>Course Code </th>
                     <th>Mid Term</th>
                    <th>Final Grade</th>
                    <th>Letter Grade </th>
                    <th>Credit</th>
                    <th>Year</th>
                    </tr>
                </thead>
                <tbody>
    <?php
          while($grade = mysqli_fetch_assoc($get_grades)){
              ?>
            <tr>
            <td><?php echo $grade['course_code'];?></td>
            <td><?php echo $grade['mid'];?></td>
            <td><?php echo $grade['grade'];?></td>
            <td><?php echo $grade['lg'];?></td>
            <td><?php echo $grade['credits'];?></td>
            <td><?php echo "{$grade['academic_year']} {$grade['semester']}";?></td></tr>

    <?php
          }?>
            </tbody>
        </table>
        </div>
    </div>
    <?php
          }?>
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
                    </div>
                    <div class="col-lg-4">
 <?php require_once('../../includes/footer.php')?>