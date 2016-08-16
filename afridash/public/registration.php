<?php ob_start()?>
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/validation.php");
require_once("../includes/db.php");
$errors = array();
$message = "";
if(isset($_POST["register"])){
	//form was submitted
	$first_name = htmlentities(isset($_POST["first_name"]) ? trim($_POST["first_name"]): "");
    $last_name = htmlentities(isset($_POST["last_name"]) ? trim($_POST["last_name"]): "");
    $email = htmlentities(isset($_POST["email"]) ? trim($_POST["email"]): "");
    $mat_no = htmlentities(isset($_POST['mat_number']) ? trim($_POST['mat_number']): "");
    $password1 = htmlentities(isset($_POST["password1"]) ? trim($_POST["password1"]): "");
    $password2 = htmlentities(isset($_POST["password2"]) ? trim($_POST["password2"]): "");
	//validations
	$fields_required = array("email", "password1", "password2", "first_name","last_name", "mat_number");
	foreach($fields_required as $fields){
		$value = trim($_POST[$fields]);
		if(!has_presence($value)){
			$fields = str_replace("_", " ", $fields);
			$errors[$fields] = ucfirst($fields)." can't be blank";
		}	
	}
    $value = "@";
	$set = $email;
	//Call the function check_email to see if the symbol does exist
	if(!check_email($value,$set)){
		$errors["{$set}"] = ucfirst("{$set}"). " is not a valid email";
	}
		if(!verify_password($password1, $password2)){
		$errors["Password"] = "Passwords don't match";
	}
    if(min_length($password2, 8)){
			$errors["Length"] = "Password is too short";//Has to be more than 8 characters at first
		}else{
			$upper = check_uppercase($password2);
			if($upper == 0){
				$errors["Upper"] = "You must have an uppercase";//There has to be at least one uppercase
			}
			$num = check_number($password2);
				if($num == 0){
					$errors["number"] = "You must have a number";//There has to be at least a number
				}
			$symbol = check_symbols($password2);
			if($symbol == 0){
				$errors["symbols"] = "You must have a symbol";//There has to be a symbol
			}
			$lower = check_lower($password2);
				if($lower == 0){
				$errors["lower"] = "You must have a lowercase";//There has to be lowercase
			}
    }
            $access = find_access_value($email);
            if($access == 0){
            $errors['User'] = "Email not found, contact your administrator";
            }
	//check if the $errors array is empty
	if(empty($errors)){
        global $connection;
        $query = "INSERT INTO users(first_name, last_name, email, id_number, access_level) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$mat_no}', {$access})";
        mysqli_query($connection, $query);
        $hashed_password = password_encrypt($password2);//Encrypt the password given to us by the user 
		create_password($hashed_password, $email);//Update the password field in our tables to the one given to us
        $query = "SELECT user_id FROM users WHERE email = '{$email}' LIMIT 1";
        $get_mail = mysqli_query($connection, $query);
        confirm_query($get_mail);
        $usr_ret = mysqli_fetch_assoc($get_mail);
        $new_query = "INSERT INTO padi(padi_1, padi_2, status) VALUES({$usr_ret['user_id']}, {$usr_ret['user_id']}, '2' )";
        $send_query = mysqli_query($connection, $new_query);
        confirm_query($send_query);
        mkdir("../Users/{$first_name}{$last_name}",0777);
        mkdir("../Users/{$first_name}{$last_name}/pictures",0777);
        mkdir("../Users/{$first_name}{$last_name}/sent_files",0777);
		redirect_to("index.php");
		}else{
			$message = "Form Errors";
		}
}else{
	$email="";//Set email to be nothing if the user never pressed the button
    $username = "";
    $last_name="";
    $first_name="";
    $mat_no="";
        
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
body{
	overflow: hidden;
}
   </style>
  </head>
  <body>
    <div class="wrapper1">
	<div class="container1">
		<h1>REGISTRATION</h1>
		
		  <form method="post" action="registration.php">
        <?php echo $message ;//Print the message to the user?>
		<?php echo form_errors($errors);//Print all the errors that were found if any?>
        <div class="styled-input"> <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($first_name);?>"></div>
   <div class="styled-input"> <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($last_name);?>"></div>
    <div class="styled-input"><input type="text" name="email" placeholder=" School Email" value="<?php echo htmlspecialchars($email);?>"></div>
<div class="styled-input"><input type="text" name="mat_number" placeholder=" Matric/ID Number" value="<?php echo htmlspecialchars($mat_no);?>"></div>
      <div class="styled-input wide"><input type="password" name="password1" placeholder="Password"></div>
        <div class="styled-input wide"><input type="password" name="password2" placeholder="Confirm Password"></div>
      <button type="submit" id="login-button" name="register">Register</button>
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
<?php ob_end_flush()?>