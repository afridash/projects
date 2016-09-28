<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php"); 
 $tot_notifications = count_notifications($_SESSION['user_id']); 
if($tot_notifications > 0 ){ 
    echo "<span class='badge badge-orange'>{$tot_notifications}</span>" ;
}
?>
<?php ob_end_flush()?>