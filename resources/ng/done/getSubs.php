<?php
include("dbconnect.php");

$catid = $_POST['catid'];
$query = "SELECT * FROM subcategories WHERE cat_id='$catid' ORDER BY subcategory ASC";
$catdata = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($catdata)){
$subcatid = $row['id'];
$subcatname = $row['subcategory'];
echo "<option value='".$subcatid."'>".$subcatname."</option>";
}
?>
