<?php ob_start()?>
<?php require_once("../includes/session.php");//Includes the session file?>
<?php require_once("../includes/functions.php");?>
<?php
require_once("../includes/db.php");//Includes the database connection file
//Includes the functions file
require_once("../includes/validation.php");//Includes the validation file
$errors = array();//Sets an empty array for errors where we will store all the form errors
$message = "";//Stores  the message for the user

//Check if the form was submitted as a $_POST
if(isset($_POST["submit"])){
	//form was submitted
	$email = htmlentities(isset($_POST["email"]) ? trim($_POST["email"]): "");
	$mat_no = htmlentities(isset($_POST["mat_no"]) ? trim($_POST["mat_no"]): "");
	//validations
	$fields_required = array("email", "mat_no");
	foreach($fields_required as $fields){
		$value = trim($_POST[$fields]);
		if(!has_presence($value)){
			$fields = str_replace("_", " ", $fields);
			$errors[$fields] = ucfirst($fields)." can't be blank";
		}	
	}
	//Try to verify if there is the @ symbol in the email
	$value = "@";
	$set = $email;
	//Call the function check_email to see if the symbol does exist
	if(!check_email($value,$set)){
		$errors["{$set}"] = ucfirst("{$set}"). " is not a valid email";
	}
	
	//check if the $errors array is empty
	if(empty($errors)){
		$user = change_password($email, $mat_no);//Connect to the database to check for the mat no and the email
		if($user){//If there is a match in the database
			$_SESSION["identifier"] = 0; //Variable to be used later to tell if it is user or faculty that logged in
			$_SESSION["user_id"] = $user["user_id"];//Set the student_id in the database to a session variable user_id
			$first_name = $user["first_name"];//Set the first_name field to the name in the database
			$last_name = $user["last_name"];//set the last_name to the name in the database
			$name = $first_name ." ".$last_name;//Concat both ot get the full name
			$_SESSION["name"] = $name; //Store the name as a variable in the session file
			redirect_to("set_password.php");//Finally, redirect the user to the set password page
		}else{
			$message = "Email/Matric No is incorrect ";
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
  top:-100%;
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
   </style>
  </head>
  <body>
    <div class="wrapper">
	<div class="container">
		<h1>NDU&#64;Afri-Dash</h1>
		
		<form id="myform" class="form" action="forgot_password.php" method="post">
		<div class="head">
		<img src="images/mem2.jpg" alt=""/>				
		</div>
		<?php echo $message ;//Print the message to the user?>
		<?php echo form_errors($errors);//Print all the errors that were found if any?>
        
        	<div class="styled-input">
			<input  type="text" required name="email" placeholder = "School Email" value="<?php echo htmlspecialchars($email);?>">
			<label > Use School Email</label>
            <span></span>
            </div>
            <div class="styled-input">
			<input type="password" required name="mat_no" placeholder="Matric Number"  />
			<label> Use School Matric #</label>
            <span></span>
            </div>
			<button type="submit" id="login-button" name="submit">Confirm Account</button>
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
