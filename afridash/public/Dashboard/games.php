<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
echo '<link rel="stylesheet" type="text/css" href="style.css">';
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php require_once("../../includes/header.php");?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                           Games </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Laboratories</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content">

                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;"></div>
                        <!--
                        Code Goes Here Add the code to the divs and makes as many more as needed. Four of them make one column!-->
                    
                        
                        <!--Start First Col!-->
                        <div class="col-md-3">
                            <div class = "panel">
                                <li class="dropdown topbar-user">
                                    <a href="#">
                                        <img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;
                                        <span class="hidden-xs">Perewari Pere</span>&nbsp;<span class="caret"></span>
                                    </a>
                                    <!--<ul class="dropdown-menu dropdown-user pull-right"></ul>!-->
                                </li>
                            </div>
                        </div>
                        <!--End First Col!-->
                        
                        <!--Start Second Col!-->
                        <div class="col-lg-6" id="wrap">
                                <div class="panel">
                                        <div class="panel-heading">
                                            <div class="caption">Timeline</div>
                                    </div>
                                    <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#UpdateStatus" data-toggle="tab">Update Status</a></li>
                <li><a data-toggle="tab" href="#AddPhoto">Add  Photo</a></li>
                                                </ul>
            <div class="tab-content">
                <div id="UpdateStatus" class="tab-pane fade in active">
                    <form action="?description=1" method="POST">
                <div class="form-group">
		          <textarea class="form-control" rows="3" id="comment"  placeholder="What's on your mind" name="status"></textarea>
		          </div>
		          <input type="submit" class="btn btn-primary" name="submit" value="Share">
		          </form>
                </div>
                   <div id="AddPhoto" class="tab-pane fade" >
                <p>hello</p>
                </div>
             </div>
                 </div>
                </div>
 <?php //Right now I am  just redisplaying the current status,later the recent activities will show  up here
		global $connection;
        $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, D.user_update, D.type,D.created, D.update_id FROM users U, updates D, padi F WHERE D.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = D.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = D.user_id END AND F.status > '0' ORDER BY D.update_id DESC LIMIT 30";
        $get_updates = mysqli_query($connection, $query);
        confirm_query($get_updates);
        while($updates = mysqli_fetch_assoc($get_updates)){ 
                            $msgID = $updates['update_id']   ?>
                               <div class="panel">
                    <div class="panel-heading">
                        <div class="caption"><?php set_profile_picture(35,35, $updates['email']); echo "&nbsp&nbsp";
                            echo "<a href='profile.php?f_name={$updates['first_name']}&l_name={$updates['last_name']}'>{$updates['first_name']} {$updates['last_name']}</a> made a {$updates['type']} update "; ?></div>
                         </div>
                    <div id="<?php echo $msgID; ?>" class="panel-body post_box">
                        <?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{$updates['user_update']}";?>
                    </div>
                    </div>
       <?php }
		
?>
                </div>
                        <!--End Second Col!-->
                        
                        <!--Start Third Col!-->
                        <div class="col-md-3">
                            <div class = "Panel">
                                <ul class="nav navbar navbar-top-links navbar-right mbn">
                                    <i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span></a>
                                    <i class="fa fa-envelope fa-fw"></i><span class="badge badge-orange">7</span></a>
                                    <i class="fa fa-tasks fa-fw"></i><span class="badge badge-yellow">8</span></a>
                                    <li id="topbar-chat" class="hidden-xs">
                                    <i class="fa fa-comments"></i><span class="badge badge-info">3</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--End Third Col!-->
                    </div>
 <?php require_once('../../includes/footer.php')?>