<?php
include("dbconnect.php");
if(isset($_GET['uid'])){
  $query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
  $result = mysqli_query($con, $query);
  $uqr = mysqli_fetch_assoc($result);

setcookie('email', $uqr['email'], time() + (86400 * 30), '/');
header("Location: https://expiringsoon.shop");
}

if(isset($_GET['user'])){
setcookie ("email", null, time() -3600, "/", "expiringsoon.shop");
header("Location: https://expiringsoon.shop");
}
?>
