<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); 
    global $connection;
    $query = "UPDATE personal_notifications SET seen = '1' WHERE padi_2 = {$_SESSION['user_id']} AND seen = '0' ";
    $set_seen = mysqli_query($connection, $query);
    confirm_query($set_seen);
?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Notifications</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Notifications</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">
                    <?php 
                        $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, N.notif_type, N.notif_time, N.user_id, N.notif_id, N.post_id FROM users U, notifications N, padi F WHERE N.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = N.user_id  WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = N.user_id END AND F.status = '1' ORDER BY N.notif_id DESC LIMIT 100";
                        $get_notifications = mysqli_query($connection, $query);
                        confirm_query($get_notifications);
                  while($notification = mysqli_fetch_assoc($get_notifications)){
        if($notification['notif_type']=="status"){
        $token = uniqid(mt_rand(),true);
            ?>
        <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php echo "{$notification['first_name']} {$notification['last_name']} made a {$notification['notif_type']} update"; ?>
                </span>
            </div>
       </a>
       <?php
        }elseif($notification['notif_type']=="like"){ ?>
                 <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php echo "{$notification['first_name']} {$notification['last_name']} liked a post. "; ?>
                </span>
            </div>
       </a>
        <?php 
        }elseif($notification['notif_type']=="comment"){ ?>
              <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php echo "{$notification['first_name']} {$notification['last_name']} commented on a post. "; ?>
                </span>
            </div>
       </a>
        <?php 
        }elseif($notification['notif_type']=="profile_picture"){ ?>
               <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php 
                                $type=str_replace("_"," ", $notification['notif_type']);
                                echo "{$notification['first_name']} {$notification['last_name']} made a {$type} update";?>
                </span>
            </div>
       </a>
      <?php
         }elseif($notification['notif_type']=="cover_photo"){ ?>
            <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php 
                                $type=str_replace("_"," ", $notification['notif_type']);
                                echo "{$notification['first_name']} {$notification['last_name']} made a {$type} update"; ?>
                </span>
            </div>
       </a>
       <?php
        }
        
    }
                        ?>    
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
 <?php require_once('../../includes/footer.php')?>