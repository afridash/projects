<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
   $comment= htmlentities(isset($_POST["comment"]) ? trim($_POST["comment"]): "");
   $safe_comment = mysqli_real_escape_string($connection, $comment);
   $query = "INSERT INTO friend_comments(user_id,post_id,comment) VALUES({$_SESSION['user_id']}, {$_POST['post_id']}, '{$safe_comment}')";
   $insert_comment = mysqli_query($connection, $query);
   confirm_query($insert_comment);
    $query = "INSERT INTO notifications(user_id, notif_type, post_id) VALUES({$_SESSION['user_id']},'comment', {$_POST['post_id']})";
        $insert_notif = mysqli_query($connection, $query);
        confirm_query($insert_notif);
        personal_notification($_SESSION['user_id'],$_POST['post_id']);
?>

<li><p><?php set_profile_picture(30,30,$_SESSION['email']); echo "&nbsp;&nbsp;&nbsp;<a href='#'>{$_SESSION['first_name']} {$_SESSION['last_name']}</a><br/>"; ?></p>
<p align="justify"><?php echo " {$comment}"?></p>
    <?php echo "just now" ?>
</li>