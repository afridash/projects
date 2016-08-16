
<?php
require_once("../../includes/db.php");
$query = "UPDATE toDos SET description = '{$_POST['description']}' WHERE id = {$_POST['id']}"; 
$store_todo = mysqli_query($connection, $query);
    