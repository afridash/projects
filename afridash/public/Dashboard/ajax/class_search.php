<?php ob_start(); ?>
<?php
require_once("../../../includes/session.php");
require_once("../../../includes/functions.php");
require_once("../../../includes/validation.php");
if(isset($_POST)){
    $department = isset($_POST['department'])? $_POST['department']:"";
    $level = isset($_POST['level'])? $_POST['level']:"";
    global $connection;
    if(!empty($department) && !empty($level)){
        $query = " SELECT department_id FROM department WHERE department_name = '{$department}' ";
        $dept_id = mysqli_query($connection, $query);
        confirm_query($dept_id);
        $dept = mysqli_fetch_assoc($dept_id);
        $get_courses = " SELECT * FROM courses WHERE course_department = {$dept['department_id']} AND course_level = '{$level}' ";
        $classes = mysqli_query($connection, $get_courses);
        confirm_query($classes);
        
    }
    if(!empty($department) && empty($level)){
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

<div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
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
            <td><?php echo $course['course_title'];?></td>
            <td><?php echo $course['course_code'];?></td>
            <td><?php echo $course['course_credit'];?></td>
            <td><?php echo $course['course_description'];?></td>
            <td><?php echo $course['course_semester'];?></td></tr>

    <?php
          }?>
            </tbody>
        </table>
        </div> 
        <div align="center" style="margin-bottom:50px;" >
            <a class="btn btn-danger" href="virtualadvisor.php">Close</a>
        </div>
    </div>