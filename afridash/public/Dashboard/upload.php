<?php
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], "../../Users/{$_SESSION['first_name']}{$_SESSION['last_name']}/pictures/".$_FILES['upl']['name'])){
        $file_name = $_FILES['upl']['name'];
        $query = "INSERT INTO updates(user_id, type, picture) VALUES ({$_SESSION['user_id']}, 'picture','{$file_name}')";
        $update = mysqli_query($connection, $query);
        confirm_query($update);
        $query = "SELECT update_id FROM updates WHERE user_id = {$_SESSION['user_id']} ORDER BY update_id DESC LIMIT 1";
        $get_id = mysqli_query($connection, $query);
        confirm_query($get_id);
        $ret_id = mysqli_fetch_assoc($get_id);
        $query = "INSERT INTO notifications(user_id, notif_type, post_id) VALUES({$_SESSION['user_id']},'picture', {$ret_id['update_id']})";
        $insert_notif = mysqli_query($connection, $query);
        confirm_query($insert_notif);
        personal_notification($_SESSION['user_id'],$ret_id['update_id']);
        $query = "INSERT INTO pictures(user_id, picture) VALUES({$_SESSION['user_id']},'{$file_name}')";
        $store_picture = mysqli_query($connection, $query);
        confirm_query($store_picture);
		echo '{"status":"success"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;