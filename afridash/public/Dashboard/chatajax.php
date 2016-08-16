<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
global $connection;
$user=$_POST['userID'];
$msg=mysqli_real_escape_string($connection,$_POST['msg']);
$c_id = $_POST['c_id'];
$time = time();
$store_message=mysqli_query($connection, "INSERT INTO convoReply(reply,convoID, userID)VALUES('{$msg}',{$c_id},{$user})");
confirm_query($store_message);
?>

<li>
<div class="answer right">
<div class="avatar">
<?php set_profile_picture(30,30,$_SESSION['email']); ?>
 <div class="status offline"></div>
</div>
 <div class="name"><?php echo $_SESSION['name']; ?></div>
 <div class="text">
<?php echo $msg ?>
 </div>
<div class="time"><?php echo getdate(); ?></div>
</div>
</li>
<?php ob_end_flush()?>