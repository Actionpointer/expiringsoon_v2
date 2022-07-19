<?php
include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if(isset($_COOKIE['email']) && !empty($_COOKIE['email'])) {
setcookie('email', $_COOKIE['email'], time() + (86400 * 30), '/');
// include("https://expiringsoon.shop/vendor/setcookie.php?email='.$email.'");
$user = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con,$user);
if (mysqli_num_rows($result) == 1){
$uqr = mysqli_fetch_assoc($result);
$_SESSION['userid'] = $uqr['id'];

$check = "SELECT * FROM cart WHERE userid='G' AND orderid='$orderid' AND status='Open'";
if ($result2 = mysqli_query($con,$check)){
if (mysqli_num_rows($result2) >= 1){
$con->autocommit(FALSE);
$con->query("UPDATE orders SET userid='".$uqr['id']."', deliveryaddress='".$uqr['address']."' WHERE orderid='$orderid'");
$con->query("UPDATE cart SET userid='".$uqr['id']."' WHERE orderid='$orderid'");
$con->commit();
}
}
header("Location: index.php");
}
}
else{
header("Location: login.php?fail");
}
?>
