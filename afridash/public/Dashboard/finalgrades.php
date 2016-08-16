<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in();
?>

<style>
li {
    list-style: none;
    text-align: left;
}</style>
<?php require_once("../../includes/header.php");?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Final Grades</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Finals</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                         <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Score</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php 
                            global $connection; 
                            $query = "SELECT * FROM exam_score WHERE course_code = '{$_GET['course_code']}' ";
                            $user_score = mysqli_query($connection, $query);
                            confirm_query($user_score);
                            while($user_info = mysqli_fetch_assoc($user_score)){
                                $query = "SELECT first_name, last_name, email FROM users WHERE user_id = {$user_info['user_id']}";
                                $user_data = mysqli_query($connection, $query);
                                confirm_query($user_data);
                                while($data_received = mysqli_fetch_assoc($user_data)){
                                    ?>
                                 <tr>
                                    <td><?php echo $data_received['first_name']; ?></td>
                                     <td><?php echo $data_received['last_name']; ?></td>
                                     <td><?php echo $data_received['email']; ?></td>
                                     <td><?php echo $user_info['grade'] ?></td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                            </tbody>
                            </table>
                <div id="area-chart-spline" style="width: 100%; height: 300px; display:none;">
                                                </div>
                     </div>
                </div>
                                

                <!--END CONTENT-->
 <?php require_once('../../includes/footer.php')?>