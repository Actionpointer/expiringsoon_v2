<?php
include("dbconnect.php");
$catid = $_POST['catid'];

if($catid == 'All'){
$sum = "SELECT count(id) as ttproducts FROM products WHERE userid='".$_POST['userid']."'";
} else{
$sum = "SELECT count(id) as ttproducts FROM products WHERE cat_id='$catid' AND userid='".$_POST['userid']."'";
}
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$ttl_products = $row['ttproducts'];
}
echo $ttl_products;
?>
