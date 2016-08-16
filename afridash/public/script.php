<?php ob_start()?>
<?php 
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/validation.php");
//new_session_id();//This is to reset the user id every 10 mins
?>
<?php confirm_if_user_logged_in(); ?>
<?php require_once("../includes/header.php");?>
<?php 
global $connection;
$query = "SELECT * FROM students";
$id = mysqli_query($connection, $query);
confirm_query($id);
while($student_details = mysqli_fetch_assoc($id)){
global $connection;
$new_query = "INSERT INTO padi(padi_1, padi_2, status) VALUES({$student_details['student_id']}, {$student_details['student_id']}, '2' )";
$send_query = mysqli_query($connection, $new_query);
confirm_query($send_query);
echo "<pre>";
print_r($student_details['student_id']);
echo "<br/>";
echo "</pre>";
}
?>
 <?php require_once('../includes/footer.php')?>