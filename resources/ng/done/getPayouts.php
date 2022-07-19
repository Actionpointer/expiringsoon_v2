<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">Balance: <span style="color:#00b207;font-weight:500">N'.number_format($uqr['wallet'], 2).'</span></br /></div>';

if(isset($_GET['fail'])){
echo '<div style="font-size:12px;margin-bottom:10px;color:#ff0000">Insufficient Balance</div>';
}

$query = "SELECT * FROM payouts WHERE userid='".$uqr['id']."' ORDER BY date DESC LIMIT 5";
$res = mysqli_query($con, $query);
echo '<span style="font-size:11px;color:#888">PAYOUT HISTORY | <a href="payouts.php" style="color:#00b207">VIEW ALL</a></span>';
while ($row = mysqli_fetch_array($res)){
echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-top:10px;margin-bottom:10px">
<span style="color:#00b207;font-weight:500">N'.number_format($row['amount'], 0).'</span> on '.date('d M, Y', strtotime($row['date'])).'<br />';
if($row['status']=='Pending'){
echo '<span style="font-size:11px;text-transform:uppercase;font-weight:500;color:#d92e2e">'.$row['status'].'</span></div>';
}
else{
echo '<span style="font-size:11px;text-transform:uppercase;font-weight:500">'.$row['status'].'</span></div>';
}
}
?>
