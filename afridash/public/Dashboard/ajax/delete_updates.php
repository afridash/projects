<?php ob_start(); ?>
<?php
require_once("../../../includes/session.php");
require_once("../../../includes/functions.php");
require_once("../../../includes/validation.php");
if(isset($_POST)){
    if(isset($_POST['delete_post']) && isset($_POST['post_id'])){
        delete_post($_POST['post_id']);
    }
    if(isset($_POST['delete_picture']) && isset($_POST['post_id'])){
    delete_picture($_POST['post_id']);
}
if(isset($_POST['delete_profile_picture']) && isset($_POST['post_id'])){
    delete_profile_picture($_POST['post_id']);
}
if(isset($_POST['delete_cover_photo']) && isset($_POST['post_id'])){
    delete_cover_photo($_POST['post_id']);
}
}
?>
<?php ob_end_flush(); ?>