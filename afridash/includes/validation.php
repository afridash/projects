<?php
require_once("db.php");
function update_password($hashed_password, $user_id){
	global $connection;
	$query = "UPDATE users SET ";
	$query .= "password = '{$hashed_password}' ";
	$query .= "WHERE user_id = {$user_id} ";

$result = mysqli_query($connection,$query);
}
?>

<?php

function create_password($hashed_password, $email){
	global $connection;
	$query = "UPDATE users SET password = '{$hashed_password}' WHERE email = '{$email}' ";
    $result = mysqli_query($connection,$query);
}

function has_presence($value){
	return isset($value) && $value !=="";
}
function min_length($user_password, $min){
	return strlen($user_password) < $min;	
}
function form_errors($errors=array()){
	$output = "";
	if(!empty($errors)){
		$output .= "<div class =\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors as $key => $error){
			$output .= "<li>{$error}</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}
function has_inclusion_in($value, $set){
	return in_array($value, $set);
}
function check_email($value, $email)
{
	return preg_match("/@/", "{$email}");
}
//Checks to see if there is a symbol in the password
function check_symbols($str_password){
	$number_of_symbols = 0;
	$array_password = str_split($str_password, 1);
	$symbols = array("@","#","!","$","%","^","&","*","(",")","_","-");
	for($i = 0; $i!=strlen($str_password); $i++){
		if(in_array($array_password[$i], $symbols)){
			$number_of_symbols ++;
	}
	}
return $number_of_symbols;

}


//Checks to see if there is a number in the password
function check_number($str_password){
		$number_of_numbers = 0;
		$array_password = str_split($str_password,1);
		$numbers = array("1","2", "3", "4","5","6","7","8","9","0");
		for($i = 0; $i!=strlen($str_password); $i++){
			if(in_array($array_password[$i], $numbers)){
				$number_of_numbers ++;
			}
		}
		return $number_of_numbers;
	}


//Check to see if there is an uppercase letter
function check_uppercase($str_password){
	$number_of_upper = 0;
	$array_password = str_split($str_password,1);
	$uppercases = range("A","Z");
	for($i = 0; $i!=strlen($str_password); $i++){
		if(in_array($array_password[$i], $uppercases)){
			$number_of_upper ++;
		}
	}
return $number_of_upper;
	
}
//Checks if there is a lower case alphabet in the password inputed
function check_lower($str_password){
	$number_of_lower = 0;
	$array_password = str_split($str_password,1);
	$lowercases = range("a","z");
	for($i = 0; $i!=strlen($str_password); $i++){
		if(in_array($array_password[$i], $lowercases)){
			$number_of_lower ++;
		}
	}
return $number_of_lower;
	
}

//Verify the passwords inputed if they both match
function verify_password($first, $second){
	if($first === $second){
		return true;
	}else{
		return false;
	}
}
//This encrypts the entered using blowfish
function password_encrypt($password){
$hash_format = "$2y$10$";
$salt_length = 22;
$salt = generate_salt($salt_length);
$format_and_salt  = $hash_format . $salt;
$hash = crypt($password, $format_and_salt);
return $hash;
}
//This generates the extra salt that is added to the password given by the student
function generate_salt($length){
$unique_random_string = md5(uniqid(mt_rand(), true));
$base64_string = base64_encode($unique_random_string);
$modified_base64_string = str_replace('+', '.', $base64_string);
$salt = substr($modified_base64_string, 0, $length);
return $salt;
}

function password_check($password, $existing_hash){
$hash = crypt($password, $existing_hash);
if($hash === $existing_hash){
return true;
}else
{
return false;
}
}
//Find the current user by the enail they provided
	
function find_user_by_email($email){
	global $connection;
	$safe_email = mysqli_real_escape_string($connection, $email);
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE email =  '{$safe_email}' ";
	$user_set = mysqli_query($connection , $query);
	confirm_query($user_set);
	if($user = mysqli_fetch_assoc($user_set)){
		return $user;
	}else{
		return null;
	}

}

//Takes two argument, the provided mat no and the existing mat_no
function matric_check($mat_no, $student_mat_no){
	if($mat_no === $student_mat_no){
		return true;
	}else
	{
		return false;
	}

}
//Faculty processing starts here
//Find check if the id's match
function id_look_up($id_no, $faculty_school_id){
	if($id_no === $faculty_school_id){
		return true;
	}else
	{
		return false;
	}

}



//Change the password after confirming if the mat no and the email provided exist
function change_password($email, $mat_no){
	$user = find_user_by_email($email);
	if($user){
		if(matric_check($mat_no,$user["id_number"])){
			return $user;

		}else{
			return false;
		}

	}else{
		return false;
	}
}


function attempt_login($email, $password){
	$user = find_user_by_email($email);
	if($user){
		//found user, now check password
		if(password_check($password, $user["password"])){
			return $user;
		}
	else{
	return false;
	}
}else{
	return false;
}
}


?>