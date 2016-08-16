<?php
$name = "Richard";
$email = "richard.igbiriki@afri-dash.com";
$message = "Verification Email";
$to = "dkrossroadz@gmail.com";
$subject= "Verification";
$from = ''.($name).' <noreply@afri-dash.com>';
$headers = "From: " .($from) . "\r\n";
$headers .= "Reply-To: ".($email) . "\r\n";
$headers .= "Return-Path: ".($from) . "\r\n";;
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
mail($to,$subject,$message,$headers, 'richard.igbiriki@afri-dash.com');
echo "Your message has been sent";
?>
