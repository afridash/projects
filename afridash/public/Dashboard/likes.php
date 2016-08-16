<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
    $update_like_query = "SELECT * FROM friend_likes WHERE user_id = {$_SESSION['user_id']} AND post_id = {$_POST['msg_id']}";
    $update_like = mysqli_query($connection, $update_like_query);
    $confirm_like = mysqli_fetch_assoc($update_like);
    if(empty($confirm_like)){
    $query = "INSERT INTO friend_likes(likes, user_id, post_id) VALUES('1',{$_SESSION['user_id']}, {$_POST['msg_id']})";
    $like = mysqli_query($connection, $query);
        $query = "INSERT INTO notifications(user_id, notif_type, post_id) VALUES({$_SESSION['user_id']},'like', {$_POST['msg_id']})";
        $insert_notif = mysqli_query($connection, $query);
        confirm_query($insert_notif);
        personal_notification($_SESSION['user_id'],$_POST['msg_id']);
    }elseif($confirm_like['likes']=='0'){
            $new_query = "UPDATE friend_likes ";
            $new_query .= "SET likes = '1' WHERE user_id = {$_SESSION['user_id']} AND post_id = {$_POST['msg_id']}";
            $like_post = mysqli_query($connection, $new_query);
    }
       