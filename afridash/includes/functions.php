<?php ob_start()?>
<?php 
    function getExtension($str) 
{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
    function redirect_to($new_location){
	header("Location: {$new_location}");
	exit;
}?>
<?php

class MyDateTime extends DateTime
{
    public function setTimestamp( $timestamp )
    {
        $date = getdate( ( int ) $timestamp );
        $this->setDate( $date['year'] , $date['mon'] , $date['mday'] );
        $this->setTime( $date['hours'] , $date['minutes'] , $date['seconds'] );
    }

    public function getTimestamp()
    {
        return $this->format( 'U' );
    }
}

function LG($score){
    if($score>=92){
        echo "A";
    }elseif($score>=89){
        echo "A-";
    }elseif($score>=85){
        echo "B+";
    }elseif($score>=82){
        echo "B";
    }elseif($score>=78){
        echo "B-";
    }elseif($score>=75){
        echo "C+";
    }elseif($score>=72){
        echo "C";
    }elseif($score>=68){
        echo "C-";
    }elseif($score>=65){
        echo "D+";
    }elseif($score>=58){
        echo "D";
    }else{
        echo "F";
    }
    
}
function time_stamp($session_time) 
{ 
 
$time_difference = time() - $session_time ; 
$seconds = $time_difference ; 
$minutes = round($time_difference / 60 );
$hours = round($time_difference / 3600 ); 
$days = round($time_difference / 86400 ); 
$weeks = round($time_difference / 604800 ); 
$months = round($time_difference / 2419200 ); 
$years = round($time_difference / 29030400 ); 

if($seconds <= 60)
{
echo"a few seconds ago"; 
}
else if($minutes <=60)
{
   if($minutes==1)
   {
     echo"one minute ago"; 
    }
   else
   {
   echo"$minutes minutes ago"; 
   }
}
else if($hours <=24)
{
   if($hours==1)
   {
   echo"one hour ago";
   }
  else
  {
  echo"$hours hours ago";
  }
}
else if($days <=7)
{
  if($days==1)
   {
   echo"one day ago";
   }
  else
  {
  echo"$days days ago";
  }


  
}
else if($weeks <=4)
{
  if($weeks==1)
   {
   echo"one week ago";
   }
  else
  {
  echo"$weeks weeks ago";
  }
 }
else if($months <=12)
{
   if($months==1)
   {
   echo"one month ago";
   }
  else
  {
  echo"$months months ago";
  }
 
   
}

else
{
if($years==1)
   {
   echo"one year ago";
   }
  else
  {
  echo"$years years ago";
  }


}
 


} 

function confirm_query($result){
	if(!$result){
	return die("Database query failed.");
}
    
}

function confirm_if_user_logged_in(){
	if(!isset($_SESSION["user_id"])){
		redirect_to("../index.php");
	}
}

function find_access_value($email){
    global $connection;
    $query = "SELECT first_name FROM students WHERE email = '{$email}' LIMIT 1";
    $get_student = mysqli_query($connection, $query);
    confirm_query($get_student);
    $num_returned_student = mysqli_num_rows($get_student);
    if($num_returned_student > 0 ){
        return 1;
    }else{
    $query = "SELECT first_name FROM faculty WHERE email = '{$email}' LIMIT 1";
    $get_faculty = mysqli_query($connection, $query);
    confirm_query($get_faculty);
    $num_returned_faculty = mysqli_num_rows($get_faculty);
        if($num_returned_faculty > 0){
            return 2;
        }else{
            return 0;
        }
    }
}
/*function new_session_id(){
	if(time() - $_SESSION['created'] > 600) {
    // session started more than 10 min ago
    session_regenerate_id(true); // change session id and invalidate old session
    $_SESSION['created'] = time(); // update creation time
}
}*/
function set_profile_picture($one, $two, $email){
	           global $connection;
	            $query = "SELECT * FROM users WHERE email = '{$email}' ";
	            $user = mysqli_query($connection, $query);
	            while ($row = mysqli_fetch_assoc($user)) {
	                if(empty($row['profile_pictures'])){
	                    echo "<img style='width:{$one}px; height:{$two}px; border-radius:50%' src='../images/pictures/Default.jpg' alt='Default Profile Pic'>";
	                 }else{
	                    echo "<img style='width:{$one}px; height:{$two}px; border-radius:50%' src='../../Users/{$row['first_name']}{$row['last_name']}/pictures/".$row['profile_pictures']."' alt='Profile Pic'>";
	                 }   
	}	
}

function set_profile_picture_one($email, $my_name){
	           global $connection;
	            $query = "SELECT * FROM users WHERE email = '{$email}' ";
	            $user = mysqli_query($connection, $query);
	            while ($row = mysqli_fetch_assoc($user)) {
	                if($row['profile_pictures'] == ""){
	                    echo "<img style='height:100%; width:100%' src='../images/pictures/Default.jpg' alt='Default Profile Pic'>";
	                 }else{
	                    echo "<img style='height:100%; width:100%' src='../../Users/{$my_name}/pictures/".$row['profile_pictures']."' alt='Profile Pic'>";
	                 }   
	}	
}


function set_profile_picture_two($email){
	           global $connection;
	            $query = "SELECT * FROM users WHERE email = '{$email}' ";
	            $user = mysqli_query($connection, $query);
	            while ($row = mysqli_fetch_assoc($user)) {
	                if($row['profile_pictures'] == ""){
	                    echo "<img style=' width:50%' src='../images/pictures/Default.jpg' alt='Default Profile Pic'>";
	                 }else{
	                    echo "<img style='width:50%' src='../../Users/{$row['first_name']}{$row['last_name']}/pictures/".$row['profile_pictures']."' alt='Profile Pic'>";
	                 }   
	}	
}

function load_syllabus($course_code){
	global $connection;
	            $query = "SELECT syllabus FROM syllabuses WHERE course_code = '{$course_code}'";
	            $syllabus = mysqli_query($connection, $query);
                confirm_query($syllabus);
	            while ($class_syllabus = mysqli_fetch_assoc($syllabus) ){
	                if($class_syllabus['syllabus'] != ""){
	                    echo "../images//uploads/syllabuses/".$class_syllabus['syllabus'];
	                 }   
	}	
}

function load_assignment($course_code, $assignment_id){
	global $connection;
	            $query = "SELECT assignment_upload FROM assignment WHERE course_code = '{$course_code}' AND assignment_id = {$assignment_id}";
	            $assignment = mysqli_query($connection, $query);
                confirm_query($assignment);
	            while ($assignment_num = mysqli_fetch_assoc($assignment) ){
	                if($assignment_num['assignment_upload'] != ""){
	                    echo "../images/uploads/assignments/".$assignment_num['assignment_upload'];
	                 }   
	}	
}

function load_quiz($course_code, $quiz_id){
	global $connection;
	            $query = "SELECT quiz_upload FROM quiz_questions WHERE course_code = '{$course_code}' AND quiz_id = {$quiz_id}";
	            $assignment = mysqli_query($connection, $query);
                confirm_query($assignment);
	            while ($assignment_num = mysqli_fetch_assoc($assignment) ){
	                if($assignment_num['quiz_upload'] != ""){
	                    echo "../images/uploads/quizzes/".$assignment_num['quiz_upload'];
	                 }   
	}	
}

function load_test($course_code, $test_id){
	global $connection;
	            $query = "SELECT test_upload FROM test_questions WHERE course_code = '{$course_code}' AND test_id = {$test_id}";
	            $test = mysqli_query($connection, $query);
                confirm_query($test);
	            while ($test_num = mysqli_fetch_assoc($test) ){
	                if($test_num['test_upload'] != ""){
	                    echo "../images/uploads/tests/".$test_num['test_upload'];
	                 }   
	}	
}

function set_profile($email){
	global $connection;
	            $query = "SELECT * FROM users WHERE email = '{$email}'";
	            $photo = mysqli_query($connection, $query);
                confirm_query($photo);
	            while ($user_photo = mysqli_fetch_assoc($photo) ){
	                if($user_photo['cover_photos'] == ""){
	                    echo "../images/coverphotos/nvr.jpg";
	                 }else{
	                    echo "../../Users/{$user_photo['first_name']}{$user_photo['last_name']}/pictures/".$user_photo['cover_photos'];
	                 }   
	}	
}

function registered($student_email, $class){
    global $connection;
$query = "SELECT * FROM course_reg WHERE student_email = '{$student_email}' AND course_id = {$class}";
    $registered = mysqli_query($connection, $query);
    confirm_query($registered);
    $already_registered = mysqli_fetch_assoc($registered);
    if($already_registered){
    return true;
    }else
    {
    return false;
    }
}

function logged_in($user_id){
    global $connection;
    $query = "UPDATE users ";
    $query .= "SET logged_in = '1' WHERE user_id = {$user_id}";
    $online = mysqli_query($connection, $query);
    confirm_query($online);
}

function logged_out($user_id){
    global $connection;
    $query = "UPDATE users ";
    $query .= "SET logged_in = '0' WHERE user_id = {$user_id}";
    $offline = mysqli_query($connection, $query);
    confirm_query($offline);
}
function Send_Mail($to,$subject,$body)
{
$from       = "donotreply@afri-dash.com";
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
//$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = 'localhost'; // SMTP host
$mail->Port       = 25;                    // set the SMTP port
$mail->SetFrom($from, 'Afri-Dash');
$mail->AddReplyTo($from,'Afri-Dash');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send(); 
}
function get_comments($post_id){
    global $connection;
    $query = "SELECT * FROM friend_comments WHERE post_id = {$post_id} ORDER BY comment_id ASC";
    $previous_comments = mysqli_query($connection, $query);
    confirm_query($previous_comments);
     while($old_comment = mysqli_fetch_assoc($previous_comments)){
         $query = "SELECT email, first_name, last_name FROM users WHERE user_id = {$old_comment['user_id']} ";
        $user = mysqli_query($connection, $query);
        confirm_query($user);
          while($pupil = mysqli_fetch_assoc($user)){
         ?>
<li><p><?php set_profile_picture(30,30,$pupil['email']); echo "&nbsp;&nbsp;&nbsp;<a href='#'>{$pupil['first_name']} {$pupil['last_name']}</a><br/>"; ?></p>
<p align="justify"><?php echo " {$old_comment['comment']}"?></p>
    <?php $date = new MyDateTime($old_comment['time'], new DateTimeZone('PST'));
                echo time_stamp($date->getTimestamp());?>
</li>
<?php
         
     }
    }
}
function personal_notification($user_id, $post_id){
    global $connection;
    $sql = "SELECT padi_1 FROM padi WHERE padi_2 = {$user_id} AND padi_1 <> {$user_id}"
        . " UNION "
        . " SELECT padi_2 FROM padi WHERE padi_1 ={$user_id}  AND padi_2 <>{$user_id}";
    $get_friends = mysqli_query($connection, $sql);
    confirm_query($get_friends);
    while($friend = mysqli_fetch_assoc($get_friends)){
        $query = "INSERT INTO personal_notifications(post_id, padi_1,padi_2) VALUES({$post_id}, {$user_id}, {$friend['padi_1']})";
        $store_notification = mysqli_query($connection, $query);
        confirm_query($store_notification);
    }
}
function check_mobile(){
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

if ($iphone || $android || $palmpre || $ipod || $berry == true) 
{ 
redirect_to("http://mobile.lugreat.com");
}
}
function count_messages($user_id){
    echo "<i class='fa fa-envelope fa-fw'></i>";
    $messages = 0;
    global $connection;
    $query = "SELECT c_id FROM convo c WHERE c.user1 = {$user_id} OR c.user2 = {$user_id}";
    $get_my_convo = mysqli_query($connection, $query);
    confirm_query($get_my_convo);
    while($convo = mysqli_fetch_assoc($get_my_convo)){
        $query = "SELECT cr_id, userID, notification, reply FROM convoReply R WHERE R.userID <> {$user_id} AND R.status = 0 AND R.convoID = {$convo['c_id']}";
        $get_message = mysqli_query($connection,$query);
        confirm_query($get_message);
        $num_messages = mysqli_num_rows($get_message);
        $messages += $num_messages;
        while($msg = mysqli_fetch_assoc($get_message)){
            $query = "SELECT first_name, last_name, profile_pictures FROM users WHERE user_id = {$msg['userID']} LIMIT 1";
            $get_frnd = mysqli_query($connection, $query);
            confirm_query($get_frnd);
            $frnd_details = mysqli_fetch_assoc($get_frnd);
            if($msg['notification'] == '0'){
               echo "<script>notifyBrowser('{$frnd_details['first_name']} {$frnd_details['last_name']}','{$msg['reply']}', 'http://lugreat.com/afri-dash/public/Dashboard/messages.php?id={$msg['userID']}&user={$convo['c_id']}','http://lugreat.com/afri-dash/public/images/pictures/{$frnd_details['profile_pictures']}');</script>";
            echo "<script>x.play();</script>";
                //Send_Mail('user_phone','','user_message');
                $query = "UPDATE convoReply SET notification = '1' WHERE cr_id = {$msg['cr_id']}";
                $update_convoReply = mysqli_query($connection,$query);
                confirm_query($update_convoReply);
            }
            
        }
    }
  return $messages;
}
function count_friends($user_id){
global $connection;
echo "<i class='fa fa-users fa-4x'></i>";
$query = "SELECT * FROM accepted_requests WHERE padi_1 = {$user_id} AND seen = '0' ORDER BY accepted_id DESC";
$acpt_frnd_notif = mysqli_query($connection, $query);
confirm_query($acpt_frnd_notif);
$num_acpt_frnds = mysqli_num_rows($acpt_frnd_notif);
$query = "SELECT * FROM friend_requests WHERE padi_2 = {$user_id} AND seen ='0' ORDER BY request_id DESC";
$m = mysqli_query($connection, $query);
confirm_query($m);
$num_friends = mysqli_num_rows($m);
$tot_frnd_notif = $num_friends + $num_acpt_frnds;
return $tot_frnd_notif;
}
function count_notifications($user_id){
global $connection;
echo "<i class='fa fa-bell fa-fw'></i>";
$query = "SELECT post_id FROM personal_notifications WHERE padi_2={$_SESSION['user_id']} AND seen = '0' ";
$get_post_id = mysqli_query($connection, $query);
confirm_query($get_post_id);
$rows = mysqli_num_rows($get_post_id);
return $rows;
}
function count_tasks($user_id){
global $connection;
echo "<i class='fa fa-tasks fa-fw'></i>";
return $rows;
}
function delete_post($post_id, $page){
    global $connection;
    $query = "DELETE FROM updates WHERE update_id = {$post_id} ";
    $deleted_post = mysqli_query($connection, $query);
    confirm_query($deleted_post);
    $query = "DELETE FROM friend_comments WHERE post_id = {$post_id} ";
    $delete = mysqli_query($connection, $query);
    confirm_query($delete);
    $query = "DELETE FROM notifications WHERE post_id = {$post_id}";
    $del_noti = mysqli_query($connection, $query);
    confirm_query($del_noti);
    $query = "DELETE FROM personal_notifications WHERE post_id = {$post_id} ";
    $del_personal = mysqli_query($connection, $query);
    confirm_query($del_personal);
    redirect_to($page);
}
function delete_picture($post_id, $page){
    global $connection;
    $query = "SELECT picture FROM updates WHERE update_id = {$post_id} ";
    $my_pic = mysqli_query($connection, $query);
    confirm_query($my_pic);
    $pic = mysqli_fetch_assoc($my_pic);
    $query = "DELETE FROM pictures WHERE user_id = {$_SESSION['user_id']} AND picture = '{$pic['picture']}'";
    $delete_pc = mysqli_query($connection, $query);
    confirm_query($delete_pc);
    $query = "DELETE FROM updates WHERE update_id = {$post_id} ";
    $deleted_post = mysqli_query($connection, $query);
    confirm_query($deleted_post);
    $query = "DELETE FROM friend_comments WHERE post_id = {$post_id} ";
    $delete = mysqli_query($connection, $query);
    confirm_query($delete);
    $query = "DELETE FROM notifications WHERE post_id = {$post_id}";
    $del_noti = mysqli_query($connection, $query);
    confirm_query($del_noti);
    $query = "DELETE FROM personal_notifications WHERE post_id = {$post_id} ";
    $del_personal = mysqli_query($connection, $query);
    confirm_query($del_personal);
    $filename = "../../Users/{$_SESSION['first_name']}{$_SESSION['last_name']}/pictures/{$pic['picture']}";
    unlink($filename);
    redirect_to($page);
}
function delete_profile_picture($post_id, $page){
    global $connection;
    $query = "UPDATE users SET profile_pictures = ' ' WHERE user_id = {$_SESSION['user_id']}";
    $del_pic = mysqli_query($connection, $query);
    confirm_query($del_pic);
    $query = "SELECT profile_picture FROM updates WHERE update_id = {$post_id} ";
    $my_pic = mysqli_query($connection, $query);
    confirm_query($my_pic);
    $pic = mysqli_fetch_assoc($my_pic);
    $query = "DELETE FROM profile_pictures WHERE user_id = {$_SESSION['user_id']} AND picture = '{$pic['picture']}'";
    $delete_pc = mysqli_query($connection, $query);
    confirm_query($delete_pc);
    $query = "DELETE FROM updates WHERE update_id = {$post_id} ";
    $deleted_post = mysqli_query($connection, $query);
    confirm_query($deleted_post);
    $query = "DELETE FROM friend_comments WHERE post_id = {$post_id} ";
    $delete = mysqli_query($connection, $query);
    confirm_query($delete);
    $query = "DELETE FROM notifications WHERE post_id = {$post_id}";
    $del_noti = mysqli_query($connection, $query);
    confirm_query($del_noti);
    $query = "DELETE FROM personal_notifications WHERE post_id = {$post_id} ";
    $del_personal = mysqli_query($connection, $query);
    confirm_query($del_personal);
    $filename = "../../Users/{$_SESSION['first_name']}{$_SESSION['last_name']}/pictures/{$pic['picture']}";
    unlink($filename);
    redirect_to($page);
}
function delete_cover_photo($post_id, $page){
    global $connection;
    $query = "UPDATE users SET cover_photos = ' ' WHERE user_id = {$_SESSION['user_id']}";
    $del_cover = mysqli_query($connection, $query);
    confirm_query($del_cover);
    $query = "SELECT cover_photo FROM updates WHERE update_id = {$post_id} ";
    $my_pic = mysqli_query($connection, $query);
    confirm_query($my_pic);
    $pic = mysqli_fetch_assoc($my_pic);
    $query = "DELETE FROM cover_photos WHERE user_id = {$_SESSION['user_id']} AND picture = '{$pic['picture']}'";
    $delete_pc = mysqli_query($connection, $query);
    confirm_query($delete_pc);
    $query = "DELETE FROM updates WHERE update_id = {$post_id} ";
    $deleted_post = mysqli_query($connection, $query);
    confirm_query($deleted_post);
    $query = "DELETE FROM friend_comments WHERE post_id = {$post_id} ";
    $delete = mysqli_query($connection, $query);
    confirm_query($delete);
    $query = "DELETE FROM notifications WHERE post_id = {$post_id}";
    $del_noti = mysqli_query($connection, $query);
    confirm_query($del_noti);
    $query = "DELETE FROM personal_notifications WHERE post_id = {$post_id} ";
    $del_personal = mysqli_query($connection, $query);
    confirm_query($del_personal);
    $filename = "../../Users/{$_SESSION['first_name']}{$_SESSION['last_name']}/pictures/{$pic['picture']}";
    unlink($filename);
    redirect_to($page);
}
?>
<?php ob_end_flush();?>