<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php"); 
$tot_frnds = count_friends($_SESSION['user_id']);
if($tot_frnds > 0){
    echo "<span class='badge badge-orange'>{$tot_frnds}</span>" ;
}
?>
<?php ob_end_flush()?>