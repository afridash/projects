<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");  ?>
<?php confirm_if_user_logged_in(); ?>
<?php 
global $connection;
if(isset($_GET['q'])){
  get_comments($_GET['q']);   
}           
 ?>
<?php ob_end_flush()?>