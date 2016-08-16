
<?php
require_once("../../includes/db.php");
$query = "DELETE FROM toDos WHERE id = {$_GET['id']}";
$del = mysqli_query($connection, $query);
redirect("calender.php");