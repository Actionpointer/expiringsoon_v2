<?php
include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}
else{
header("Location: login.php?fail");
}

$vqq = mysqli_query($con, "SELECT * FROM users WHERE id='".$_GET['v']."'");
$vqr = mysqli_fetch_assoc($vqq);

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
$mail->AddAddress("".$vqr['email']."");
$mail->AddAddress("velkroadvertising@gmail.com");
$mail->Subject = "New order no. ".$orderid." from ".$uqr['fname']." ".$uqr['lname']."";
$mail->Body = file_get_contents("https://ng.expiringsoon.shop/vendor-receipt.php?ref=".$orderid."");
$mail->send();
?>
