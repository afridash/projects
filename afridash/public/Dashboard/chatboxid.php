<?php ob_start()?>
<?php
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/validation.php");
global $connection;

$chid = $_POST['convoID'];

<?php ob_end_flush()?>