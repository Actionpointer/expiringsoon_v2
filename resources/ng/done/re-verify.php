<?php
session_start();
include("dbconnect.php");
if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
$query = "SELECT * FROM users WHERE email='".$_SESSION['user']."'";
}
else{
$query = "SELECT * FROM users WHERE id='".$_GET['uid']."'";
}
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);

include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.expiringsoon.shop";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "no-reply@expiringsoon.shop";
$mail->Password = "Efiivuf-Gtej";
$mail->SetFrom("no-reply@expiringsoon.shop", "Expiring Soon");
$mail->AddAddress("".$uqr['email']."");
$mail->Subject = "Please Verify Your Email Address";
$mail->Body = file_get_contents("https://expiringsoon.shop/confirm.php?uid=".$uqr['id']."");
$mail->send();
header("Location: register-2.php?sent");
?>
