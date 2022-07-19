<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM discounts WHERE userid='".$uqr['id']."' ORDER BY expiry ASC";
$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($res)){
echo '';
}
?>
