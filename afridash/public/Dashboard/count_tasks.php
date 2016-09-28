<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php"); 
$n_tasks=count_tasks($_SESSION['user_id']);
if($n_tasks > 0){ 
    echo "<span class='badge badge-yellow'>{$n_tasks}</span>"; 
}
?>
<?php ob_end_flush()?>