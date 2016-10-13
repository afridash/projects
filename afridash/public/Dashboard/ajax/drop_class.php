<?php ob_start(); ?>
<?php
require_once("../../../includes/session.php");
require_once("../../../includes/functions.php");
require_once("../../../includes/validation.php");
if(isset($_POST)) { 
    global $connection;
    if(!isset($_POST['pre'])){
        $query = "DELETE FROM course_reg WHERE course_id = {$_POST['course_id']} AND student_email = '{$_SESSION['email']}' "; 
     $drop = mysqli_query($connection, $query);
      confirm_query(drop);
    }else{
        $sql = "DELETE FROM course_prereg WHERE email='{$_SESSION['email']}' AND course_id={$_POST['course_id']}";
    $removeClass = mysqli_query($connection, $sql);
    confirm_query($removeClass);
    }
    
}
?>

<?php ob_end_flush(); ?>