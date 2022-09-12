<?php
session_start();
include("dbconnect.php");
$vqq = mysqli_query($con, "SELECT * FROM verify WHERE token='".$_GET['token']."'");
$vqr = mysqli_fetch_assoc($vqq);
if(mysqli_num_rows($vqq) > 0){

$query = "SELECT * FROM users WHERE id='".$vqr['userid']."'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

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
$mail->AddAddress("".$user['email']."");
$mail->Subject = "Welcome to Expiring Soon!";
$mail->Body = file_get_contents("https://expiringsoon.shop/welcome.php?uid=".$user['id']."");
$mail->send();

$con->autocommit(FALSE);
$con->query("UPDATE users set status='Verified' WHERE id='".$user['id']."'");
// $con->query("DELETE FROM verify WHERE token='".$_GET['token']."'");
$con->commit();
header("Location: login.php?new");
}
/*setcookie('email', $user['email'], time() + (86400 * 30), '/');
if(isset($_COOKIE['email']) && !empty($_COOKIE['email'])){
header("Location: index.php");
}
else{
header("Location: checklogin.php");
}
}
else{
header("Location: register-2.php?token");
}*/
?>
