<?php
require_once("../../includes/db.php");
$query = "UPDATE updates SET user_update = '{$_POST['description']}' WHERE update_id = {$_POST['id']}"; 
$store_todo = mysqli_query($connection, $query);
    