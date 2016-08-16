<?php ob_start()?>
<?php require_once("../includes/session.php");//Includes the session file?>
<?php require_once("../includes/functions.php");//Includes the functions file?>
<?php require_once("../includes/validation.php");//Includes the validation file?>
<?php confirm_if_user_logged_in(); ?>
<?php

$errors = array();//Sets an empty array for errors where we will store all the form errors
$message = "";//Stores  the message for the user

//Check if the form was submitted as a $_POST
if(isset($_POST["submit"])){
	//form was submitted
	$first_password = htmlentities(isset($_POST["first_password"]) ? trim($_POST["first_password"]): "");
	$second_password = htmlentities(isset($_POST["second_password"]) ? trim($_POST["second_password"]): "");
	//validations
	//Check if the password entered is not blank
	$fields_required = array("first_password", "second_password");
	foreach($fields_required as $fields){
		$value = trim($_POST[$fields]);
		if(!has_presence($value)){
			$fields = str_replace("_", " ", $fields);
			$errors[$fields] = "Password can't be blank";
			break;
		}	
	}
//Verify if the entered password meets all the criterias as defined by us!!!
	if(!verify_password($first_password, $second_password)){
		$errors["Password"] = "Passwords don't match";
	}else{
		if(min_length($second_password, 8)){
			$errors["Length"] = "Password is too short";//Has to be more than 8 characters at first
		}else{
			$upper = check_uppercase($second_password);
			if($upper == 0){
				$errors["Upper"] = "You must have an uppercase";//There has to be at least one uppercase
			}
			$num = check_number($second_password);
				if($num == 0){
					$errors["number"] = "You must have a number";//There has to be at least a number
				}
			$symbol = check_symbols($second_password);
			if($symbol == 0){
				$errors["symbols"] = "You must have a symbol";//There has to be a symbol
			}
			$lower = check_lower($second_password);
				if($lower == 0){
				$errors["lower"] = "You must have a lowercase";//There has to be lowercase
			}
		}
	}

	//check if the $errors array is empty
	if(empty($errors)){
		if($_SESSION["identifier"] == 0){
		$user_id = $_SESSION["user_id"];//Uses the session variable user_id sent by the forgot_password
		$hashed_password = password_encrypt($second_password);//Encrypt the password given to us by the user 
		update_password($hashed_password, $user_id);//Update the password field in our tables to the one given to us
		$_SESSION["confirmation"] = "Your password has been changed successfully!";//Send a message through the session to the log in page
		redirect_to("index.php");
		}		
	}
	
}else{
	$email="";//Set email to be nothing if the user never pressed the button
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html >
  <head>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
        
    <meta http-equiv="Content-Type" charset="UTF-8">
    <title>NDU Afri-Dash</title>
        <link rel="stylesheet" href="css/style.css"> 
<style type="text/css">
.error ul {
  list-style: none;
}
.head {
  position: absolute;
  top:-130%;
  left: 35%;
 /* margin-top: -150px;
  margin-left: -10px;*/
}
.head img {
  border-radius:50%;
  -webkit-border-radius:50%;
  -o-border-radius:50%;
  -moz-border-radius:50%;
  border:6px solid rgba(221, 218, 215, 0.23);
}
body{
	overflow: hidden;
}

.tooltip
{
	display: inline;
	position: relative;
	text-decoration: none;
	top: 0px;
	left: 0px;
}
.tooltip:hover:after
{
	background: #333;
	background: linear-gradient(to bottom right, #2196F3 50%,     #90CAF9 85%);;
	border-radius: 5px;
	top: -70px;
	color: #000;
	content: attr(alt);
	left: 400px;
	padding: 5px 15px;
	position: absolute;
	z-index: 98;
	width: 150px;
}
.tooltip:hover:before
{
	border: solid;
	border-color: transparent black;
	border-width: 6px 6px 6px 0;
	bottom: 20px;
	content: "";
	left: 400px;
	position: absolute;
	z-index: 99;
	top: 3px;
}


</style>
  </head>
  <body>
    <div class="wrapper">
	<div class="container">
		<h1>NDU&#64;Afri-Dash</h1>
		<p>Welcome, <?php if(isset($_SESSION["name"])){echo htmlentities($_SESSION["name"]);}  ?><br/>Please set a new password</p>
		<form class="form" action="set_password.php" method="post">
		<div class="head">
		<img src="images/mem2.jpg" alt=""/>				
		</div>

		<?php echo $message ;?>
		<?php echo form_errors($errors);
		?>
			<input type="password" name="first_password" placeholder = "New Password" value="">
            <a href="#" alt="Password must have ; up to 8 characters, &nbsp;&nbsp;&nbsp;
one uppercase letter,
one lowercase letter,
one symbol character,
one number
" class="tooltip">
			<input type="password" name="second_password" placeholder="Confirm Password"></a>
			<button type="submit" id="login-button" name="submit">Set Password</button>
			
			<br/>
			<br/>
		</form>
		<br/>
		<br/>
		<br/>
		<p>Copyrights &copy; Afri-Dash.com</p>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>

 </body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($connection);
?>
<?php ob_end_flush()?>
