<?php
//Conection to the database using mysqli as the plugin
$dbhost = "afritables.db.6471559.hostedresource.com";
$dbuser = "afritables";
$dbname = "afritables";
$dbpass = "afr!D4sh";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()){
	die("Database connection failed: ". mysqli_connect_error(). "(".mysqli_connect_errno().")");
}
?>