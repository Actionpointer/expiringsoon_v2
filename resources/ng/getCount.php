<?php
include("dbconnect.php");
$catid = $_POST['catid'];

if($catid == 'All'){
$sum = "SELECT count(id) as ttproducts FROM products";
} else{
$sum = "SELECT count(id) as ttproducts FROM products WHERE cat_id='$catid'";
}
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$ttl_products = $row['ttproducts'];
}
echo $ttl_products;
?>
