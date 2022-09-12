<?php
include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

$hash = password_hash('Exp2022', PASSWORD_BCRYPT);
$user = mysqli_query($con, "SELECT * FROM users");
while($row = mysqli_fetch_array($user)){
$rand = ''.$row['id'].''.substr(str_shuffle("0123456789"), 0, 4).'';
$con->autocommit(FALSE);
// $con->query("DELETE FROM users WHERE email='velkroadvertising@gmail.com'");
// $con->query("DELETE FROM cart WHERE orderid='$orderid'");
// $con->query("UPDATE admin set password='$hash' WHERE admin='admin'");
// $con->query("UPDATE payouts set status='Pending'");
$con->query("UPDATE users set userid='$rand' WHERE id='".$row['id']."'");
$con->commit();
}

/*$hash = password_hash('password', PASSWORD_BCRYPT);
$con->autocommit(FALSE);
$con->query("TRUNCATE table orders");
$con->query("TRUNCATE table cart");
$con->commit();
session_destroy();*/
echo 'Command Executed';
?>
