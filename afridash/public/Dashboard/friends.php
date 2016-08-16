<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php 
global $connection;
    $query = "UPDATE accepted_requests SET seen = '1' WHERE padi_1 = {$_SESSION['user_id']} AND seen = '0' ";
    $update_acceptance = mysqli_query($connection, $query);
    confirm_query($update_acceptance);
    $query = "UPDATE friend_requests SET seen = '1' WHERE padi_2 = {$_SESSION['user_id']} AND seen = '0' ";
    $update_seen = mysqli_query($connection, $query);
    confirm_query($update_seen);
?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Friend Requests</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Friend Request</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                   <?php 
$query = "SELECT * FROM accepted_requests WHERE padi_1 = {$_SESSION['user_id']} ";
$acpt_frnd_notif = mysqli_query($connection, $query);
confirm_query($acpt_frnd_notif);
$num_acpt_frnds = mysqli_num_rows($acpt_frnd_notif);
$query = "SELECT * FROM friend_requests WHERE padi_2 = {$_SESSION['user_id']} ";
$m = mysqli_query($connection, $query);
confirm_query($m);
$num_friends = mysqli_num_rows($m);
?> <?php 
        global $connection;
        if($num_friends > 0 ){
             while($request = mysqli_fetch_assoc($m)){ 
            $query = "SELECT first_name,user_id, last_name, email FROM users WHERE user_id = {$request['padi_1']}";
            $u = mysqli_query($connection, $query);
            confirm_query($u);
            while($user = mysqli_fetch_assoc($u)){
            ?>
    <a href="<?php echo "profile.php?f_name={$user['first_name']}&l_name={$user['last_name']}&req={$request['request_id']}&id={$user['user_id']}"?>"><div class="display_pan">
            <?php set_profile_picture(30,30,$user['email']);?>
    <span class="user"><?php echo "{$user['first_name']} {$user['last_name']} sent you a friend request "; ?>
        <?php $date = new MyDateTime($request['request_time'], new DateTimeZone('PST'));
                echo time_stamp($date->getTimestamp());?>
        </span>
        </div>
    </a>
      <?php
            }
        }
        }
        if($num_acpt_frnds > 0){
             while($acceptance = mysqli_fetch_assoc($acpt_frnd_notif)){ 
            $query = "SELECT first_name, last_name,user_id, email FROM users WHERE user_id = {$acceptance['padi_2']}";
            $v = mysqli_query($connection, $query);
            confirm_query($v);
            while($udata = mysqli_fetch_assoc($v)){ ?>
               <a href="<?php echo "profile.php?f_name={$udata['first_name']}&l_name={$udata['last_name']}&id={$udata['user_id']}"?>&view=true"><div class="display_pan"><?php set_profile_picture(30,30,$udata['email']); ?><span class="user"><?php echo "{$udata['first_name']} {$udata['last_name']} accepted your friend request "; ?><?php $date = new MyDateTime($acceptance['accepted_time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?>
                    </span>
                    </div> </a>
    <?php
            }
        }
    }
    ?>
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
 <?php require_once('../../includes/footer.php')?>