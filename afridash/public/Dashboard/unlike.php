<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/db.php");
            $new_query = "UPDATE friend_likes ";
            $new_query .= "SET likes = '0' WHERE user_id = {$_SESSION['user_id']} AND post_id = {$_POST['msg_id']}";
            $like_post = mysqli_query($connection, $new_query);
