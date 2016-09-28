<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php"); 
$n_msgs=count_messages($_SESSION['user_id']); 
if($n_msgs > 0){ 
    echo "<span class='badge badge-yellow'>{$n_msgs}</span>";
}
?>
<?php ob_end_flush()?>