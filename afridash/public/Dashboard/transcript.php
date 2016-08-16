<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in();
function get_earned_points($lg, $credits){
    $qp=0;
    if($lg = "A"){
        $qp = 5;
    }
    if($lg="B"){
        $qp = 4;
    }
    if($lg="C"){
        $qp = 3;
    }
    if($lg="D"){
        $qp = 2;
    }
    if($lg="E"){
        $qp = 1;
    }
    if($lg="F"){
      $qp = 0;  
    }
    return $credits * $qp;
}
?>
<?php 
global $connection;
$query="SELECT * FROM final_grades WHERE user_id = {$_SESSION['user_id']}";
$get_grades = mysqli_query($connection, $query);
confirm_query($get_grades);
?>
<?php require_once("../../includes/header.php");?>
           <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Transcript </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Transcript</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
               <div class="page-content">
                   <h5><?php echo $_SESSION['name']; ?></h5>
                 <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Course Code/Title</th>
                            <th>Letter Grade</th>
                            <td>Grade</td>
                            <th>Credits</th>
                            <th>Term</th>
                        </tr>
                    </thead>
                <tbody>
                <?php 
                    global $connection;
                    $total_credits = 0;
                    $total_earned_points = 0;
                    while($retrieved_grades = mysqli_fetch_assoc($get_grades)){ 
                    $total_credits +=$retrieved_grades['credits'];
                    $total_earned_points += get_earned_points($retrieved_grades['lg'], $retrieved_grades['credits']);
                    $query = "SELECT course_title FROM courses WHERE course_code = '{$retrieved_grades['course_code']}' LIMIT 1";
                    $get_course = mysqli_query($connection, $query);
                    confirm_query($get_course);
                    $returned_course = mysqli_fetch_assoc($get_course);
                    ?>
                    <tr class="info">
                        <td><?php echo "{$retrieved_grades['course_code']} {$returned_course['course_title']}"; ?></td>
                        <td><?php echo $retrieved_grades['lg']; ?></td>
                        <td><?php echo $retrieved_grades['grade']; ?></td>
                        <td><?php echo $retrieved_grades['credits']; ?></td>
                        <td><?php echo "{$retrieved_grades['academic_year']} {$retrieved_grades['semester']}"; ?></td>
                 </tr>
                           
                    <?php
                       } ?>
                       </tbody>
                        </table>
                   <h5>Total Earned Credits: <?php echo $total_credits; ?></h5>
                   <h5>Total Earned Points: <?php echo $total_earned_points; ?></h5>
                   <h5>CGPA: <?php if($total_credits !=0){ echo $total_earned_points/$total_credits; }?></h5>
               </div>
               
<div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
<?php require_once("../../includes/footer.php");?>
<?php ob_end_flush()?>