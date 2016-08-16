<?php ob_start()?>
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");  ?>
<?php confirm_if_user_logged_in(); ?>
<?php 
global $connection;
if(isset($_POST['submit'])){
    if(!empty($_POST['msg'])){
        echo $_POST['msg'];
        echo $_POST['userID'];
        $msg = mysqli_real_escape_string($connection, $_POST['msg']);
        $usr_id = $_POST['userID'];
        $query= "SELECT c.c_id FROM convo c WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = {$usr_id} WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = {$usr_id} END 
        AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) LIMIT 1";
        $get_list1 = mysqli_query($connection, $query);
        confirm_query($get_list1);
        $conversation = mysqli_num_rows($get_list1);
        if($conversation == 0 ){
            $query = "INSERT INTO convo(user1,user2,status)VALUES({$_SESSION['user_id']}, {$usr_id}, 1)";
            $start_convo = mysqli_query($connection, $query);
            confirm_query($start_convo);
            
            $query= "SELECT c.c_id FROM convo c WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = {$usr_id} WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = {$usr_id} END 
        AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) LIMIT 1";
        $get_list1 = mysqli_query($connection, $query);
            confirm_query($get_list1);
            $convo_id = mysqli_fetch_assoc($get_list1);
            $query = "INSERT INTO convoReply(reply, userID, convoID, status)VALUES('{$msg}', {$_SESSION['user_id']}, {$convo_id['c_id']}, 0)";
            $store_reply = mysqli_query($connection, $query);
            confirm_query($store_reply);
        }
    }
}           
 ?>
<?php ob_end_flush()?>