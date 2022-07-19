<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

$res = mysqli_query($con, "SELECT * FROM bankinfo WHERE userid='".$uqr['id']."'");
while ($row = mysqli_fetch_array($res)){
echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-top:10px">'.$row['bank'].'<br />'.$row['acctname'].'<br />
<span style="color:#000;font-weight:500">'.$row['acctno'].'</span></br /></div>';
}
?>
