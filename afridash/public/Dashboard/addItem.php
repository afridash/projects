<?php ob_start(); ?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
if(isset($_POST)) { 
    global $connection;
    $query = "INSERT INTO toDos(user_id,title, description, date) VALUES ({$_SESSION['user_id']}, '{$_POST['title']}', '{$_POST['description']}', '{$_POST['date']}')"; 
     $store_todo = mysqli_query($connection, $query);
      confirm_query($store_todo);
}
?>
<?php ob_end_flush(); ?>