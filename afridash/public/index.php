<?php ob_start()?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/validation.php");
$errors = array();
check_mobile();
$message = "";
if(isset($_POST["submit"])){
	//form was submitted
	$email = htmlentities(isset($_POST["email"]) ? trim($_POST["email"]): "");
	$password = htmlentities(isset($_POST["password"]) ? trim($_POST["password"]): "");
	//validations
	$fields_required = array("email", "password");
	foreach($fields_required as $fields){
		$value = trim($_POST[$fields]);
		if(!has_presence($value)){
			$errors[$fields] = ucfirst($fields)." can't be blank";
		}	
	}
	$value = "@";
	$set = $email;
	if(!check_email($value,$set)){
		$errors["{$set}"] = ucfirst("{$set}"). " is not a valid email";
	}
	
	//check if the $errors array is empty
	if(empty($errors)){
	$user = attempt_login($email, $password);
		if($user){
            logged_in($user["user_id"]);
            $_SESSION['email'] = $user['email'];//Set the email of the user
			$_SESSION["created"] = time();//Set the time that the user logged in
			$_SESSION["user_id"] = $user["user_id"];//Set the student that logged in
			$first_name = $user["first_name"];//Store the first_name
			$last_name = $user["last_name"];//Store the last name
			$_SESSION['last_name'] = $user['last_name'];//Set the first_name
			$_SESSION['first_name'] =$user['first_name']; //Set the last_name
			$name = $first_name ." ".$last_name;
            $_SESSION['access_level'] = $user['access_level'];//Set the access level for further usage when the user is logged in
			$_SESSION["name"] = $name; //Return a fullname variable
			redirect_to("Dashboard/index.php");//take the student to the homepage
		}else{
            $message="Email/Password Incorrect";
        }
	}	
}else{
	$email="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html >
  <head>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

        <script src="js/index.js"></script>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <title>NDU Afri-Dash</title>
        <link rel="stylesheet" href="css/style.css"> 
        
         
   <style type="text/css">
.error ul {
  list-style: none;
}
body{
	overflow: hidden;
}
   </style>
  </head>
  <body>
    <div class="wrapper">
	<div class="container">
		<h1><strong>WELCOME TO</strong></h1>
		<img width="200px"  src="images/logo.png" alt=""/>		
		<form class="form" action="index.php" method="post">
		<?php echo confirmation() ;?>
		<?php echo $message?>
		<?php echo form_errors($errors);
		?>
        <div class="styled-input">
           
			<input type="text" required name="email" placeholder = "Email" value="<?php echo htmlspecialchars($email);?>">
             
            </div>
            
             <div class="styled-input wide">
			<input type="password" required name="password" placeholder="Password" >
            </div>
            
			<button type="submit" id="login-button" name="submit">Login</button>
			<div><p class="password" align="left"><a href="forgot_password.php">Forgot Password?</a></p>
			</div>
            <div><p class="password" align="right"><a href="registration.php">New User</a></p></div>
			<br/>
			<br/>
			<p class="ptext">If this is your first time visiting, click on New User!</p>
		</form>
		<br/>
		
		<p>Copyrights &copy; Afri-Dash.com</p>
	</div>
	
	<ul class="bg-bubbles">
		<li><span class="glyphicon glyphicon-home" style='font-size: 70px'></span></li>

		<li><span class="glyphicon glyphicon-camera" style='font-size: 80px'></span></li>
		
		<li><span class="glyphicon glyphicon-file" style='font-size: 70px'></span></li>
        <li><span class="glyphicon glyphicon-calender" style='font-size: 80px'></span></li>

		<li><span class="glyphicon glyphicon-inbox" style='font-size: 70px'></span></li>
        
        <li><span class="glyphicon glyphicon-comment" style='font-size: 70px'></span></li>

		<li><span class="glyphicon glyphicon-picture" style='font-size: 80px'></span></li>
		
		<li><span class="glyphicon glyphicon-heart-empty" style='font-size: 70px'></span></li>
        
        <li><span class="glyphicon glyphicon-globe" style='font-size: 80px'></span></li>
        
        <li><span class="glyphicon glyphicon-grade" style='font-size: 80px'></span></li>
        

		<li><span class="glyphicon glyphicon-phone" style='font-size: 70px'></span></li>
        
		<!--
		<li><span class="glyphicon glyphicon-home"></span></li>
        <li><span class="glyphicon glyphicon-home"></span></li>

		<li><span class="glyphicon glyphicon-home"></span></li>
		
		<li><span class="glyphicon glyphicon-home"></span></li>
        <li><span class="glyphicon glyphicon-home"></span></li>

		<li><span class="glyphicon glyphicon-home"></span></li>
		
		<li><span class="glyphicon glyphicon-home"></span></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		-->
	</ul>
</div>

 </body>
</html>
<?php ob_end_flush()?>
