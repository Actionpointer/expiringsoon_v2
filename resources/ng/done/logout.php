<?php
include("dbconnect.php");
session_start();
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$con->autocommit(FALSE);
$con->query("DELETE FROM cart WHERE orderid='".$_SESSION['orderid']."' AND status='Open'");
$con->query("DELETE FROM orders WHERE orderid='".$_SESSION['orderid']."' AND status='Open'");
$con->commit();
session_destroy();
}

setcookie ('email', null, time() -3600, '/');
header("Location: index.php");
?>
