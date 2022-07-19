<?php
include("dbconnect.php");
session_start();

if(isset($_COOKIE['admin']) && !empty($_COOKIE['admin'])) {
setcookie('email', $_COOKIE['email'], time() + (86400 * 30), '/');
$user = "SELECT * FROM admin WHERE admin='".$_COOKIE['admin']."'";
$result = mysqli_query($con,$user);
if (mysqli_num_rows($result) == 1){
$aqr = mysqli_fetch_assoc($result);
header("Location: admin-dashboard.php");
}
}
else{
header("Location: admin.php?fail");
}
?>
