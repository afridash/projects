
<?php session_start();?>
<?php
function confirmation(){
	if(isset($_SESSION["confirmation"] )){
		$output = htmlentities(($_SESSION["confirmation"]));
		$_SESSION["confirmation"] = null;
		return $output;
	}
}
?>