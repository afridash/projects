<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/db.php");
require_once("../../includes/validation.php");
require_once("../../includes/functions.php");
$query = "SELECT * FROM toDos WHERE user_id = {$_SESSION['user_id']}";
$dates = array();
$i = 0;
$dbdata = mysqli_query($connection, $query);
while($retData = mysqli_fetch_assoc($dbdata)){
            $dates[$i] = array(
            'date' => $retData['date'],
            'badge' => ($i & 1) ? true : false,
            'title' => $retData['title'],
            'body' => "<p class='lead'>{$retData['description']}</p>",
            'footer' => '<a class="btn btn-primary">Close</a>',
        );
    $i = $i + 1;
}
echo json_encode($dates);

