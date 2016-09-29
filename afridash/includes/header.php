<?php 
if(isset($_GET['changecoverphoto'])){
    global $connection;
        move_uploaded_file($_FILES['file']['tmp_name'],"../../Users/{$_SESSION['first_name']}{$_SESSION['last_name']}/pictures/".$_FILES['file']['name']);
        $query = "UPDATE users SET cover_photos = '".$_FILES['file']['name']. "'WHERE email = '".$_SESSION['email']."'";
        $file_name = $_FILES['file']['name'];
        $result = mysqli_query($connection, $query);
        confirm_query($result);
    $query = "INSERT INTO updates(user_id, type, cover_photo) VALUES ({$_SESSION['user_id']}, 'cover_photo','{$file_name}')";
        $update = mysqli_query($connection, $query);
        confirm_query($update);
        $query = "SELECT update_id FROM updates WHERE user_id = {$_SESSION['user_id']} ORDER BY update_id DESC LIMIT 1";
        $get_id = mysqli_query($connection, $query);
        confirm_query($get_id);
        $ret_id = mysqli_fetch_assoc($get_id);
        $query = "INSERT INTO notifications(user_id, notif_type, post_id) VALUES({$_SESSION['user_id']},'cover_photo', {$ret_id['update_id']})";
        $insert_notif = mysqli_query($connection, $query);
        confirm_query($insert_notif);
    $query = "INSERT INTO cover_photos(user_id, picture) VALUES({$_SESSION['user_id']},'{$file_name}')";
    $store_cover = mysqli_query($connection, $query);
    confirm_query($store_cover);
}?>
<?php 
if(isset($_GET['changeprofilepic']))
{
        global $connection;
        move_uploaded_file($_FILES['file']['tmp_name'],"../../Users/{$_SESSION['first_name']}{$_SESSION['last_name']}/pictures/".$_FILES['file']['name']);
        $query = "UPDATE users SET profile_pictures = '".$_FILES['file']['name']. "'WHERE email = '".$_SESSION['email']."'";
        $file_name = $_FILES['file']['name'];
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        $query = "INSERT INTO updates(user_id, type, profile_picture) VALUES ({$_SESSION['user_id']}, 'profile_picture','{$file_name}')";
        $update = mysqli_query($connection, $query);
        confirm_query($update);
        $query = "SELECT update_id FROM updates WHERE user_id = {$_SESSION['user_id']} ORDER BY update_id DESC LIMIT 1";
        $get_id = mysqli_query($connection, $query);
        confirm_query($get_id);
        $ret_id = mysqli_fetch_assoc($get_id);
        $query = "INSERT INTO notifications(user_id, notif_type, post_id) VALUES({$_SESSION['user_id']},'profile_picture', {$ret_id['update_id']})";
        $insert_notif = mysqli_query($connection, $query);
        confirm_query($insert_notif);
    $query = "INSERT INTO profile_pictures(user_id, picture) VALUES({$_SESSION['user_id']},'{$file_name}')";
    $store_picture = mysqli_query($connection, $query);
    confirm_query($store_picture);
}
?>
<?php 
    $count_tasks = 0;
    global $connection;
$query = "SELECT U.user_id, U.email, U.first_name, U.last_name, N.notif_type, N.notif_time, N.user_id, N.notif_id, N.post_id FROM users U, notifications N, padi F WHERE N.user_id = U.user_id AND CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = N.user_id  WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = N.user_id END AND F.status = '1' ORDER BY N.notif_id DESC LIMIT 10";
$get_notifications = mysqli_query($connection, $query);
confirm_query($get_notifications);
$query = "SELECT post_id FROM personal_notifications WHERE padi_2={$_SESSION['user_id']} AND seen = '0' ";
$get_post_id = mysqli_query($connection, $query);
confirm_query($get_post_id);
$rows = mysqli_num_rows($get_post_id);
$query = "SELECT * FROM accepted_requests WHERE padi_1 = {$_SESSION['user_id']} ORDER BY accepted_id ASC ";
$acpt_frnd_notif = mysqli_query($connection, $query);
confirm_query($acpt_frnd_notif);
$num_acpt_frnds = mysqli_num_rows($acpt_frnd_notif);
$query = "SELECT * FROM friend_requests WHERE padi_2 = {$_SESSION['user_id']} ORDER BY request_id ASC ";
$m = mysqli_query($connection, $query);
confirm_query($m);
$num_friends = mysqli_num_rows($m);
?>
<?php 
if (isset($_GET['logout']))
{
    logged_out($_SESSION["user_id"]);
    $_SESSION = array();
    if ($_COOKIE[session_name()])
    {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    redirect_to('../index.php');
}
?>

<?php 
global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
$student = mysqli_query($connection, $query);
confirm_query($student);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Afri-Dash | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="styles/pace.css">
    <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">
    <link type="text/css" rel="stylesheet" href="styles/newStyles.css">
<link href='timeline.css' rel='stylesheet' type='text/css'/>
    <link href='styles/simplelightbox.min.css' rel='stylesheet' type='text/css'>
    <link href='styles/todo.css' rel='stylesheet' type='text/css'>
    <link href="styles/hopscotch.min.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="../source/jquery.syotimer.js"></script>
    <script type="text/javascript" src="script/mikes-modal.min.js"></script>
    <link type="text/css" rel="stylesheet" href="styles/mikes-modal.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" media="screen">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/emojione/1.5.2/assets/sprites/emojione.sprites.css" media="screen">
  <link rel="stylesheet" type="text/css" href="styles/stylesheet.css" media="screen">
  <link rel="stylesheet" type="text/css" href="styles/emojionearea.min.css" media="screen">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/emojione/1.5.2/lib/js/emojione.min.js"></script>
  <script type="text/javascript" src="http://mervick.github.io/lib/google-code-prettify/prettify.js"></script>
  <script type="text/javascript" src="script/emojionearea.js"></script>
    </head>
<body>
<script>
var auto_refresh = setInterval(
function ()
{
$('#messagesBody').load('message_notification.php').fadeIn("slow");
}, 5000);
    
var auto_refresh = setInterval(
function ()
{
$('#messagesLink').load('count_notif.php').fadeIn("slow");
}, 5000);
var auto_refresh = setInterval(function () {
$('#tasksBody').load('tasks_notification.php').fadeIn("slow");	
}, 5000);
var refresh = setInterval(function () {
$('#countTasks').load('count_tasks.php').fadeIn("slow");
}, 5000);
var refresh = setInterval(function(){
$('#notificationsBody').load('notifications_notification.php').fadeIn("slow");
}, 5000);
var auto_refresh = setInterval(function () {
$('#countNotifications').load('count_notifications.php').fadeIn("slow");
}, 5000);
var refresh = setInterval(function(){
$('#friendsBody').load('friends_notification.php').fadeIn("slow");
}, 5000);
var auto_refresh = setInterval(function () {
$('#friendsLink').load('count_friends.php').fadeIn("slow");
}, 5000);
</script>
    <div>
        <!--BEGIN THEME SETTING-->

        <!--END THEME SETTING-->
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div style="margin-bottom: 50px;"></div>
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 120px;" data-step="3" class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="index.php" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text"><img alt="Afri-dash Logo" src="../images/logo.png"></span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div id="TopToggleHead" class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                    <div id="SearchSite" class="input-icon right text-white"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="search form-control text-white" id="searchbox"/><div id="display">
</div></div>
                </form>
                <div id="NewsUpdateBox" class="news-update-box hidden-xs"><span class="text-uppercase mrm pull-left text-white">News:</span>
                    <ul id="news-update" class="ticker list-unstyled">
                        <li>Welcome to Afri-Dash - Providing you with the best education experience!</li>
                        <li>Meet Friends, Coursemates, and Faculty</li>
                        <li>Share files, knowledge and experience</li>
                    </ul>
                </div>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
    <li id = "friends_li" ><a href="#" id="friendsLink"><?php $tot_frnds = count_friends($_SESSION['user_id']); if($tot_frnds > 0 ){ echo "<span class='badge badge-orange'>{$tot_frnds}</span>" ;}?></a>
    <div id="friendsContainer">
<div id="friendsTitle">Friends Notifications</div>
<div id="friendsBody" class="notifications">
    <?php 
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
        <span class="user"><?php echo "{$user['first_name']} {$user['last_name']} sent you a friend request "; ?></span>
        <span class="time"> <?php $date = new MyDateTime($request['request_time'], new DateTimeZone('PST'));
                echo time_stamp($date->getTimestamp());?></span>
    
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
    <a href="<?php echo "profile.php?f_name={$udata['first_name']}&l_name={$udata['last_name']}&id={$udata['user_id']}"?>&view=true"><div class="display_pan"><?php set_profile_picture(30,30,$udata['email']); ?><span class="user"><?php echo "{$udata['first_name']} {$udata['last_name']} accepted your friend request "; ?></span>
       <span class="time"> <?php $date = new MyDateTime($request['request_time'], new DateTimeZone('PST'));
                echo time_stamp($date->getTimestamp());?></span>
                    </div> </a>
    <?php
            }
        }
    }
    ?>
</div>
<div id="friendsFooter"><a href="friends.php">See All</a></div>
    </div>
    </li>
        <li id="notification_li">
<a href="#" id="notificationLink"><?php $tot_notifications = count_notifications($_SESSION['user_id']); if($tot_notifications > 0 ){ echo "<span class='badge badge-orange'>{$tot_notifications}</span>" ;}?></a>
<div id="notificationContainer">
<div id="notificationTitle">Notifications</div>
<div id="notificationsBody" class="notifications">
    <?php 
    while($notification = mysqli_fetch_assoc($get_notifications)){
        if($notification['notif_type']=="status"){
        $token = uniqid(mt_rand(),true);
            ?>
        <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php echo "{$notification['first_name']} {$notification['last_name']} made a {$notification['notif_type']} update"; ?>
                </span><span class="my_reply"><?php $date = new MyDateTime($notification['notif_time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span>
            </div>
       </a>
       <?php
        }elseif($notification['notif_type']=="like"){ ?>
                 <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php echo "{$notification['first_name']} {$notification['last_name']} liked a post. "; ?>
                </span><span class="time"><?php $date = new MyDateTime($notification['notif_time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span>
            </div>
       </a>
        <?php 
        }elseif($notification['notif_type']=="comment"){ ?>
              <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php echo "{$notification['first_name']} {$notification['last_name']} commented on a post. "; ?>
                </span><span class="time"><?php $date = new MyDateTime($notification['notif_time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span>
            </div>
       </a>
        <?php 
        }elseif($notification['notif_type']=="profile_picture"){ ?>
               <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php
                                $type=str_replace("_"," ", $notification['notif_type']);
                                echo "{$notification['first_name']} {$notification['last_name']} made a {$type} update"; ?>
                </span><span class="time"><?php $date = new MyDateTime($notification['notif_time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span>
            </div>
       </a>
      <?php
         }elseif($notification['notif_type']=="cover_photo"){ ?>
            <a href="status.php?f_name=<?php echo $notification['first_name'] ?>&l_name=<?php echo $notification['last_name']?>&token=<?php echo $token ?>&post_id=<?php echo $notification['post_id']?>"><div class="display_pan"><?php set_profile_picture(30,30, $notification['email']);?>
            <span class="user"><?php $type=str_replace("_"," ", $notification['notif_type']);
                                echo "{$notification['first_name']} {$notification['last_name']} made a {$type} update"; ?>
                </span><span class="time"><?php $date = new MyDateTime($notification['notif_time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span>
            </div>
       </a>
       <?php
        }
        
    }
    ?>
</div>
<div id="notificationFooter"><a href="notifications.php">See All</a></div>
</div>
</li>
                    <li id="messages_link">
                        <a  href="#" id="messagesLink"><?php $n_msgs=count_messages($_SESSION['user_id']); if($n_msgs > 0){ echo "<span class='badge badge-yellow'>{$n_msgs}</span>"; } ?></a>
                        <div id="messagesContainer">
                            <div id="messagesTitle">Messages</div>
                            <div id="messagesBody" class="notifications">
                            <?php
global $connection;
$query= "SELECT u.user_id, c.c_id, u.email, u.last_name, u.first_name FROM convo c, users u WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = u.user_id WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = u.user_id END 
 AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) ORDER BY c.c_id DESC LIMIT 20";
 
 $get_list1 = mysqli_query($connection, $query);
 confirm_query($get_list1);
$first = 0;
 while($new_list1 = mysqli_fetch_assoc($get_list1)){ 
$c_id=$new_list1['c_id'];
$user_id=$new_list1['user_id'];
$email=$new_list1['email'];
     
$query="SELECT R.cr_id, R.time, R.reply,R.userID 
                            FROM convoReply R WHERE R.convoID={$c_id} 
                            ORDER BY R.cr_id DESC LIMIT 1";
$cReply = mysqli_query($connection, $query);
  confirm_query($cReply);                           
$crow=mysqli_fetch_assoc($cReply);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time=$crow['time'];
$ur_id=$crow['userID'];

//HTML Output. 
?>
                            <a  href="messages.php?id=<?php echo $user_id; ?>&user=<?php echo $c_id; ?>" ><div class="display_pan">
                                    <?php set_profile_picture(30,30, $new_list1['email']); ?><span class="user"><?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?></span><span
                                        class="time"><?php $date = new MyDateTime($time, new DateTimeZone('PST')); echo time_stamp($date->getTimestamp());?></span><br/>
                                    <?php if ($ur_id != $_SESSION['user_id']){ ?>
                                                <span class="reply"><?php echo $reply ?></span>
                                           <?php
                                        }else{ ?>
                                 <span class="my_reply"><?php echo $reply ?></span>
<?php    
} ?>
                           
                                 </div></a> 
                      <?php      
                            }
?>
                            </div>
                            <div id="messagesFooter"><a href="messages.php?id=<?php echo $user_id; ?>&user=<?php echo $c_id; ?>">See All</a></div>
                        </div>
                    </li>
                    <li id="tasks_li">
                    <a  href="#" id="tasksLink"><?php $n_tasks=count_tasks($_SESSION['user_id']); if($n_tasks > 0){ echo "<span class='badge badge-yellow'>{$n_tasks}</span>"; } ?></a>
                        <div id="tasksContainer">
                            <div id="tasksTitle">Tasks</div>
                            <div id="tasksBody" class="notifications">
 <?php
                                    global $connection;
                                    while($student_course = mysqli_fetch_assoc($student)){
                            $query = "SELECT course_code, course_title FROM courses WHERE course_id = {$student_course['course_id']} ORDER BY course_id ASC ";
                            $course_ret = mysqli_query($connection, $query);
                            confirm_query($course_ret);
                            while($course_details = mysqli_fetch_assoc($course_ret)){
                                $query = "SELECT * FROM activity_notifications WHERE course_code = '{$course_details['course_code']}'";
                                $activities = mysqli_query($connection, $query);
                                confirm_query($activities);
                                while($activity = mysqli_fetch_assoc($activities)){
                                    if($activity['notif_type']== "Test"){
                                        $query = "SELECT score FROM test_scores WHERE test_id = {$activity['act_id']} AND user_id = {$_SESSION['user_id']} AND course_code = '{$activity['course_code']}' LIMIT 1";
                                        $student_score = mysqli_query($connection, $query);
                                        confirm_query($student_score);
                                        if(mysqli_num_rows($student_score) == 0){
                                            $count_tasks +=1;
                                ?>
<a href="courses.php?course=<?php echo $course_details['course_title']?>&course_code=<?php echo $course_details['course_code']?>"><div class="display_pan"><?php echo $course_details['course_code']?> -- A new test has been added<span class="time"><?php $ndate = new MyDateTime($activity['notif_time'], new DateTimeZone('PST'));
                echo time_stamp($ndate->getTimestamp());?></span></div></a>
                                       <?php
                                            }
                                    }elseif($activity['notif_type']== "Quiz"){
                            $query = "SELECT score FROM quiz_scores WHERE quiz_id = {$activity['act_id']} AND user_id = {$_SESSION['user_id']} AND course_code = '{$activity['course_code']}' LIMIT 1";
                                        $student_score = mysqli_query($connection, $query);
                                        confirm_query($student_score);
                                        if(mysqli_num_rows($student_score) == 0){
                                            $count_tasks +=1;
                                ?>
                                            <a href="courses.php?course=<?php echo $course_details['course_title']?>&course_code=<?php echo $course_details['course_code']?>"><div class="display_pan"><?php echo $course_details['course_code']?> -- A new quiz has been added <span class="time"><?php $ndate = new MyDateTime($activity['notif_time'], new DateTimeZone('PST'));
                echo time_stamp($ndate->getTimestamp());?></span></div></a>
                                <?php
                                    }
                                }elseif($activity['notif_type'] == "Assignment"){
                                        //Start from here. Get the assignment 
                                        $query = "SELECT due_date FROM assignment WHERE assignment_id = {$activity['act_id']} AND course_code = '{$activity['course_code']}' LIMIT 1";
                                        $student_assignment = mysqli_query($connection, $query);
                                        confirm_query($student_assignment);
                                        $due_time = mysqli_fetch_assoc($student_assignment);
                                        if(time() < strtotime($due_time['due_date'])){
                                            $count_tasks +=1;
                                ?>
                                            <a href="courses.php?course=<?php echo $course_details['course_title']?>&course_code=<?php echo $course_details['course_code']?>"><div class="display_pan"><?php echo $course_details['course_code']?> -- A new assignment has been added <span class="time"><?php $ndate = new MyDateTime($activity['notif_time'], new DateTimeZone('PST'));
                echo time_stamp($ndate->getTimestamp());?></span></div></a>
                                <?php
                                    }
                            }
                                    }
                                    }
                                }
                                ?>
                            </div>
                            <div id="tasksFooter"><a href="tasks.php">See All</a></div>
                        </div>
                    </li>
                    <li id="adakaprofile" class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle">
                        <?php set_profile_picture(25,25, $_SESSION['email']); ?>&nbsp;<span class="hidden-xs"><?php echo " ".$_SESSION['name'];?></span>&nbsp;<span class="caret"></span></a> 
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="profile.php?f_name=<?php echo $_SESSION['first_name']?>&l_name=<?php echo $_SESSION['last_name']?>"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="tasks.php"><i class="fa fa-tasks"></i>My Tasks</a></li>
                            <li><a href="registered_classes.php"><i class="fa fa-book"></i>My Classes</a></li>
                            <li class="divider"></li>
                            <li><a href="?logout=true"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>
                    <li id ="panoramicview" class="active"><a href="index.php"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Dashboard</span></a></li>
                    
                    <?php if($_SESSION['access_level'] == '1'){ ?>
                            <li id="futureplan"><a href="transcript.php"><i class="fa fa-graduation-cap fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Transcript</span></a>
                    </li>
                    
                    <li id="classReg"><a href="class_registration.php"><i class="glyphicon-plus">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Class Registration</span></a> 
                    </li>
                    
                    <li id="okuberimail"><a href="grade.php"><i class="fa fa-university">
                        <div class="icon-bg bg-primary"></div>
                    </i><span class="menu-title">Grades</span></a>
                    </li>
                     <li id="ikulabs"><a target="_blank" href="http://resourcenet.afri-dash.com"><i class="fa fa-suitcase" aria-hidden="true"></i><span class="menu-title">ResourceNet</span></span></a> 
                    </li>
                    <li id="pereforums"><a href="#"><i class="fa fa-comments fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Forums</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <?php           
                                    global $connection;
                                    $query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
                                    $student_class = mysqli_query($connection, $query);
                                    confirm_query($student_class);
                        while($students = mysqli_fetch_assoc($student_class)){
                            $query = "SELECT * FROM courses WHERE course_id = {$students['course_id']} ORDER BY course_id ASC ";
                            $course = mysqli_query($connection, $query);
                            confirm_query($course);
                            while($courses = mysqli_fetch_assoc($course)){
                                $title = urlencode($courses['course_title']);
                                ?>
                                <li><a href="forums.php?course=<?php echo $title?>&coursecode=<?php echo $courses['course_code']?>&id=<?php echo uniqid(mt_rand(),true)?>"><?php echo $courses['course_title'];?></a></li>
                            <?php   
                                    }
                            }?>
                        </ul>
                    </li>
                    
                    <li id="yingifriends"><a href="#"><i class="fa fa-users fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Friends</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                                <?php 
                                $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, F.status FROM users U, padi F WHERE CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = U.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = U.user_id END AND F.status = '1' ";
                                $get_list = mysqli_query($connection, $query);
                                confirm_query($get_list);
                                while($list = mysqli_fetch_assoc($get_list)){ ?>
                                    <li><a href="<?php echo "profile.php?f_name={$list['first_name']}&l_name={$list['last_name']}"?>"><?php echo "{$list['first_name']} {$list['last_name']}"; ?></a></li>
                                <?php }
                                ?>
                            </ul>
                    </li>
                    <li id="uzomacalender"><a href="calender.php"><i class="fa fa-calendar fa-fw">
                        <div class="icon-bg bg-grey"></div>
                    </i><span class="menu-title">My Calender</span></a>
                      
                    </li>
                   <?php    }else { ?>
                                     <?php if($_SESSION['access_level'] == '2'){ ?>
                            <li id="bayelsagrade"><a href="grades.php"><i class="fa fa-graduation-cap fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Grades</span></a>
                    </li>
                    
                    <li id="yenagoapresent"><a href="classes.php"><i class="glyphicon-plus">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Class Roster</span></a> 
                    </li>
                    
                    <li id="bossmail"><a href="Email.php"><i class="fa fa-envelope-o">
                        <div class="icon-bg bg-primary"></div>
                    </i><span class="menu-title">Email</span></a>
                    </li>
                    <?php 
                    global $connection;
                    $query = "SELECT faculty_college FROM faculty WHERE email = '{$_SESSION['email']}' ";
                    $user_college = mysqli_query($connection, $query);
                    confirm_query($user_college);
                    while($college = mysqli_fetch_assoc($user_college)){
                        if($college['faculty_college']==1){ ?>
                     <li id="iguniweilab"><a href="#"><i class="fa fa-glass fa-fw"><div class="icon-bg bg-blue"></div></i><span class="menu-title">Laboratories</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <li><a href="physics_laboratories.php">Physics</a>          
                            </li>
                            <li><a href="chemistry_laboratories.php">Chemistry</a></li>
                            <li><a href="biology_laboratories.php">Biology</a></li>
                            <li><a href="mathematics_laboratories.php">Mathematics</a></li>
                            <li><a href="earthscience_laboratories.php">Earth Science</a></li>
                        </ul>
                    
                    <?php
                        
                        }
                    }
                    ?>
                        </li>
                    <li id="igbirikipadimen"><a href="#"><i class="fa fa-users fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Friends</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                                <?php 
                                $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, F.status FROM users U, padi F WHERE CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = U.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = U.user_id END AND F.status = '1' ";
                                $get_list = mysqli_query($connection, $query);
                                confirm_query($get_list);
                                while($list = mysqli_fetch_assoc($get_list)){ ?>
                                    <li><a href="<?php echo "profile.php?f_name={$list['first_name']}&l_name={$list['last_name']}"?>"><?php echo "{$list['first_name']} {$list['last_name']}"; ?></a></li>
                                <?php }
                                ?>
                            </ul>
                    </li>
                    
                    <li id="ogirikiforums"><a href="#"><i class="fa fa-comments fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Forums</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                                 
                     <?php
                                    global $connection;
                        $query = "SELECT * FROM course_reg WHERE student_email = '{$_SESSION['email']}' ";
                                    $student_class = mysqli_query($connection, $query);
                                    confirm_query($student_class);
                        while($students = mysqli_fetch_assoc($student_class)){
                            $query = "SELECT * FROM courses WHERE course_id = {$students['course_id']} ORDER BY course_id ASC ";
                            $course = mysqli_query($connection, $query);
                            confirm_query($course);
                            while($courses = mysqli_fetch_assoc($course)){
                                $title = urlencode($courses['course_title']);
                                ?>
                                <li><a href="forums.php?course=<?php echo $title?>&coursecode=<?php echo $courses['course_code']?>&id=<?php echo uniqid(mt_rand(),true)?>"><?php echo $courses['course_title'];?></a></li>
                            <?php   
                                    }?>
                            <?php }?>
                            </ul>
                    </li>
                    
                    <li id="perewarilendar"><a href="calender.php"><i class="fa fa-calendar fa-fw">
                        <div class="icon-bg bg-grey"></div>
                    </i><span class="menu-title">My Calender</span></a>
                      
                    </li>
                    <?php 
    } ?>

                    <?php }?>
                    
                </ul>
            </div>
        </nav>
    <script>
    //Add audio for notification
        var x = document.createElement("AUDIO");
        x.src="audio/Online.mp3";
    </script>