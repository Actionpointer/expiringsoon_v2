<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if(isset($_SESSION['userid'])){
$query = "SELECT * FROM users WHERE id='".$_SESSION['userid']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
$userid = $uqr['id'];
$address = $uqr['address'];
}
else{
$userid = 'G';
$address = 'None';
}

if(isset($_POST['uid'])){
if($_POST['username1'] == '' OR $_POST['fname'] == '' OR $_POST['lname'] == '' OR $_POST['phone1'] == ''){
echo 'Please fill all required fields';
exit();
}
$result = mysqli_query($con, "SELECT * FROM users WHERE phone='".$_POST['phone1']."' AND id!='".$uqr['id']."'");
$match = mysqli_num_rows($result) > 0 ? 'Yes' : 'No';
if($match == 'Yes'){
echo '<span style="color:#ff0000">Phone number is already registered</span>';
exit();
}

$result2 = mysqli_query($con, "SELECT * FROM users WHERE username='".$_POST['username1']."' AND id!='".$uqr['id']."'");
$match2 = mysqli_num_rows($result2) > 0 ? 'Yes' : 'No';
if($match2 == 'Yes'){
echo '<span style="color:#ff0000">Username is taken</span>';
exit();
}
else{
$con->autocommit(FALSE);
$con->query("UPDATE users SET username='".strtolower($_POST['username1'])."', fname='".ucwords($_POST['fname'])."', lname='".ucwords($_POST['lname'])."', phone='".$_POST['phone1']."' WHERE id='".$uqr['id']."'");
$con->commit();
echo 'Your changes were saved';
}
}

if(isset($_POST['uid2'])){
$con->autocommit(FALSE);
$con->query("UPDATE users SET address='".ucwords($_POST['address'])."', state='".$_POST['state']."' WHERE id='".$uqr['id']."'");
$con->commit();
echo 'Delivery Address Updated';
}

if(isset($_POST['oid'])){
$con->autocommit(FALSE);
$con->query("UPDATE orders SET recipient='".ucwords($_POST['fname'].' '.$_POST['lname'])."', deliveryaddress='".ucwords($_POST['deliveryaddress'])."', deliverycontact='".$_POST['deliverycontact']."', comments='".$_POST['comments']."' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
$con->commit();
echo 'Shipping Info Updated';
}

if (isset($_POST['email'])){
$email_string = strtolower($_POST['email']);
$user_email = preg_replace('/\s+/', '', $email_string);
if (!filter_var($email_string, FILTER_VALIDATE_EMAIL)) {
echo 'Wrong email format';
exit();
}

$check = "SELECT * FROM users WHERE email='$user_email'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) == 1){
echo 'This email is already registered';
exit();
}
}
}

if (isset($_POST['phone'])){
$check = "SELECT * FROM users WHERE phone='".$_POST['phone']."'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) == 1){
echo 'This phone number is already assigned to another user';
exit();
}
}
}

if (isset($_POST['username'])){
$check = "SELECT * FROM users WHERE username='".$_POST['username']."'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) == 1){
echo '<span style="color:#ff0000;font-weight:500">Username is taken</span>';
}
else{
echo '<span style="color:#00b207;font-weight:500">'.$_POST['username'].'</span>';
}
}
}

if(isset($_POST['newaddress'])){
  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET deliveryaddress='".ucwords($_POST['newaddress'])."' WHERE orderid='$orderid'");
  $con->commit();
}

if(isset($_POST['pay-method'])){
  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET paymentmethod='".$_POST['pay-method']."' WHERE orderid='$orderid'");
  $con->commit();
}

if(isset($_POST['comments'])){
  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET comments='".$_POST['comments']."' WHERE orderid='$orderid'");
  $con->commit();
}

if(isset($_GET['date'])){
$schedule = date("l, M jS", strtotime($_GET['date']));
  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET schedule='$schedule' WHERE orderid='$orderid'");
  $con->commit();
  echo 'Delivery Date: '.$schedule.'';
}

if(isset($_POST['schedule_time'])){
  $oqq = mysqli_query($con, "SELECT * FROM orders WHERE orderid='$orderid'");
  $oqr = mysqli_fetch_assoc($oqq);

  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET schedule_time='".$_POST['schedule_time']."' WHERE orderid='$orderid'");
  $con->commit();
  echo 'Delivery Date: '.$oqr['schedule'].' at '.$_POST['schedule_time'].'';
}

if(isset($_POST['subs'])){
$sql = "INSERT INTO subcategories (cat_id, subcategory) VALUES (?,?)";
$conn->prepare($sql)->execute([$_POST['cat_id'], ucwords($_POST['subcat'])]);
echo 'Category was Created';
}

if(isset($_POST['prodcat'])){
$sql = "INSERT INTO productcategories (cat_id, subcat_id, productcategory) VALUES (?,?,?)";
$conn->prepare($sql)->execute([$_POST['cat_id'], $_POST['subcat_id'], ucwords($_POST['productcategory'])]);
echo 'Product Category Created';
}

// Update Cart Total
if (isset($_POST['cartid'])){
$ctqq = mysqli_query($con, "SELECT * FROM cart WHERE id='".$_POST['cartid']."'");
$ctqr = mysqli_fetch_assoc($ctqq);

$con->autocommit(FALSE);
$con->query("UPDATE cart SET qty='".$_POST['qty']."', total='".$_POST['ttl']."' WHERE id='".$_POST['cartid']."'");
$con->commit();

$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='".$ctqr['orderid']."'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
}
$con->autocommit(FALSE);
$con->query("UPDATE orders SET total='$orderttl' WHERE orderid='".$ctqr['orderid']."'");
$con->commit();
}

if (isset($_POST['coupon'])){
$check = "SELECT * FROM coupons WHERE coupon='".$_POST['coupon']."' AND status='Active'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) == 1){

$cpnqq = mysqli_query($con, "SELECT * FROM coupons WHERE coupon='".$_POST['coupon']."'");
$cpnqr = mysqli_fetch_assoc($cpnqq);

$con->autocommit(FALSE);
$con->query("UPDATE orders SET discount='".$cpnqr['discount']."' WHERE orderid='$orderid'");
$con->commit();
echo  'N'.number_format($_POST['ttl'] * ((100 - $cpnqr['discount']) / 100), 0).' <br /><div style="margin-top:-5px;font-size:12px;color:#cd6502">'.$cpnqr['discount'].'% Discount Applied</div>';
}
else{
echo 'N'.number_format($_POST['ttl'], 0).' <br /><div style="margin-top:-5px;font-size:12px;color:#cd6502">Invalid Coupon</div>';
}
}
}

// Update Product details
if (isset($_POST['prod_id'])){
$product = mysqli_real_escape_string($con, $_POST['product']);
$con->autocommit(FALSE);
$con->query("UPDATE products SET product='".ucwords($product)."', stock='".$_POST['stock']."', price='".$_POST['price']."' WHERE id='".$_POST['prod_id']."'");
$con->commit();
echo 'Product Changes Saved';
}

if (isset($_POST['prod_id2'])){
$info = htmlspecialchars_decode($_POST['info'], ENT_NOQUOTES);
$info2 = addslashes($info);
$con->autocommit(FALSE);
$con->query("UPDATE products SET info='$info2', cat_id='".$_POST['cat_id']."', subcat_id='".$_POST['subcat_id']."' WHERE id='".$_POST['prod_id2']."'");
$con->commit();
echo 'Product Changes Saved';
}

if (isset($_POST['prod_id3'])){
$pqq1 = mysqli_query($con, "SELECT * FROM products WHERE id='".$_POST['prod_id3']."'");
$pqr1 = mysqli_fetch_assoc($pqq1);

$path = "uploads/";
$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP", "pdf", "doc", "docx");
//check file is correct type

$fileType = $_FILES['theFile']['type'];
$fileTypeArray = ['image/jpeg', 'image/png'];
// now check that the file type matches that of the array.
if (!in_array($fileType, $fileTypeArray)){
echo 'Wrong file format';
exit();
}
include_once 'includes/getExtension.php';
$imagename = $_FILES['theFile']['name'];
$size = $_FILES['theFile']['size'];
if(strlen($imagename)){
$ext = strtolower(getExtension($imagename));
if(in_array($ext,$valid_formats)){
if($size<(1024*1024)){ // Image size max 1 MB
$actual_image_name = time().".".$ext;
$uploadedfile = $_FILES['theFile']['tmp_name'];

//Original Image
if(move_uploaded_file($uploadedfile, $path.$actual_image_name)){
if(!empty($pqr1['photo'])){
unlink ($pqr1['photo']);
}
$con->autocommit(FALSE);
$con->query("UPDATE products SET photo='$path$actual_image_name' WHERE id='".$_POST['prod_id3']."'");
$con->commit();
echo 'Product Photo Updated!';
}
}
}
}
}

// Update Avatar
if (isset($_POST['avatar'])){
$path = "uploads/";
$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP", "pdf", "doc", "docx");
//check file is correct type

$fileType = $_FILES['theFile']['type'];
$fileTypeArray = ['image/jpeg', 'image/png'];
// now check that the file type matches that of the array.
if (!in_array($fileType, $fileTypeArray)){
echo 'Wrong file format';
exit();
}
include_once 'includes/getExtension.php';
$imagename = $_FILES['theFile']['name'];
$size = $_FILES['theFile']['size'];
if(strlen($imagename)){
$ext = strtolower(getExtension($imagename));
if(in_array($ext,$valid_formats)){
if($size<(1024*1024)){ // Image size max 1 MB
$actual_image_name = time().".".$ext;
$uploadedfile = $_FILES['theFile']['tmp_name'];

//Original Image
if(move_uploaded_file($uploadedfile, $path.$actual_image_name)){
if($uqr['pic']!=='img/avatar.png'){
unlink ($uqr['pic']);
}
$con->autocommit(FALSE);
$con->query("UPDATE users SET pic='$path$actual_image_name' WHERE id='".$uqr['id']."'");
$con->commit();
echo 'Avatar Updated';
}
}
}
}
}

// Update Product Image
if (isset($_POST['prod_id_2'])){
$pqq1 = mysqli_query($con, "SELECT * FROM products WHERE id='".$_POST['prod_id_2']."'");
$pqr1 = mysqli_fetch_assoc($pqq1);

$path = "uploads/";
$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP", "pdf", "doc", "docx");
//check file is correct type

$fileType = $_FILES['imageUpload']['type'];
$fileTypeArray = ['image/jpeg', 'image/png'];
// now check that the file type matches that of the array.
if (!in_array($fileType, $fileTypeArray)){
echo 'Wrong file format';
exit();
}
include_once 'includes/getExtension.php';
$imagename = $_FILES['imageUpload']['name'];
$size = $_FILES['imageUpload']['size'];
if(strlen($imagename)){
$ext = strtolower(getExtension($imagename));
if(in_array($ext,$valid_formats)){
if($size<(1024*1024)){ // Image size max 1 MB
$actual_image_name = time().".".$ext;
$uploadedfile = $_FILES['imageUpload']['tmp_name'];

//Original Image
if(move_uploaded_file($uploadedfile, $path.$actual_image_name)){
$con->autocommit(FALSE);
if($_POST['photo']=='1'){
  if(!empty($pqr1['photo'])){
  unlink($pqr1['photo']);
  }
$con->query("UPDATE products SET photo='$path$actual_image_name' WHERE id='".$_POST['prod_id_2']."'");
}
if($_POST['photo']=='2'){
  if(!empty($pqr1['photo2'])){
  unlink($pqr1['photo2']);
  }
$con->query("UPDATE products SET photo2='$path$actual_image_name' WHERE id='".$_POST['prod_id_2']."'");
}
$con->commit();
echo 'Product Image Updated';
}
}
}
}
}

// Add Item to Cart
if (isset($_POST['pid'])){
$pqq1 = mysqli_query($con, "SELECT * FROM products WHERE id='".$_POST['pid']."'");
$pqr1 = mysqli_fetch_assoc($pqq1);

if(!isset($_SESSION['orderid'])){
$rand = substr(str_shuffle("0123456789"), 0, 10);
$_SESSION['orderid'] = $rand;
$orderid = $_SESSION['orderid'];
}

$check1 = "SELECT * FROM cart WHERE productid='".$pqr1['id']."' AND orderid='$orderid'";
if ($result1=mysqli_query($con,$check1)){
if (mysqli_num_rows($result1) == 1){
$cqr = mysqli_fetch_assoc($result1);

$newqty = $_POST['qty'] + $cqr['qty'];
$ttlamount = $pqr1['price'] * $_POST['qty'];
$cartitemttl = $cqr['total'] + $ttlamount;
$con->autocommit(FALSE);
$con->query("UPDATE cart SET total='$cartitemttl', qty='$newqty' WHERE productid='".$pqr1['id']."' AND orderid='$orderid'");
$con->commit();
}
else{
$ttl = $pqr1['price'] * $_POST['qty'];
$sql = "INSERT INTO cart (userid, vendor, productid, orderid, qty, status, total, date) VALUES (?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $pqr1['userid'], $_POST['pid'], $orderid, $_POST['qty'], 'Open',  $ttl, $now]);
}
}

$check = "SELECT * FROM cart WHERE orderid='$orderid'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) >= 1){
$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='$orderid'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
}
}
}
$check2 = "SELECT * FROM orders WHERE orderid='$orderid'";
if ($result2=mysqli_query($con,$check2)){
if (mysqli_num_rows($result2) == 1){
$con->autocommit(FALSE);
$con->query("UPDATE orders SET total='$orderttl', deliveryaddress='$address', photo='".$pqr1['photo']."', date='$now', dateadded='$today' WHERE orderid='$orderid'");
$con->commit();
}
else{
$sql = "INSERT INTO orders (userid, orderid, total, status, deliveryaddress, deliverycontact, recipient, schedule, deliverystatus, trackingcode, paymentmethod, comments, photo, discount, date, dateadded) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $orderid, $orderttl, 'Open', $address, 'None', 'None', 'Today', 'Incomplete', 'None', 'Wallet', 'None', 'img/img-shoppingbag.jpg', '0', $now, $today]);
}
}
echo 'Item is in your Cart';
}

if(isset($_GET['id1'])){
$ctq = mysqli_query($con, "SELECT * FROM cart WHERE id='".$GET['id1']."'");
$ctr = mysqli_fetch_assoc($ctq);

$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='".$orderid."'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
}

$con->autocommit(FALSE);
$con->query("DELETE FROM cart WHERE id='".$_GET['id1']."'");
$con->query("UPDATE orders SET total='$orderttl' WHERE orderid='".$orderid."'");
$con->commit();
}

if(isset($_GET['id2'])){
$check = mysqli_query($con, "SELECT * FROM likes WHERE userid='".$uqr['id']."' AND prod_id='".$_GET['id2']."'");
if(mysqli_num_rows($check) == 1){
$con->autocommit(FALSE);
$con->query("DELETE FROM likes WHERE userid='".$uqr['id']."' AND prod_id='".$_GET['id2']."'");
$con->commit();
exit;
}
else{
$sql = "INSERT INTO likes (prod_id, userid, dateadded) VALUES (?,?,?)";
$conn->prepare($sql)->execute([$_GET['id2'], $uqr['id'], $now]);
}
}

// Add Item to Cart II
if(isset($_GET['id3'])){
$pqq1 = mysqli_query($con, "SELECT * FROM products WHERE id='".$_GET['id3']."'");
$pqr1 = mysqli_fetch_assoc($pqq1);

if(!isset($_SESSION['orderid'])){
$rand = substr(str_shuffle("0123456789"), 0, 10);
$_SESSION['orderid'] = $rand;
$orderid = $_SESSION['orderid'];
}

$check1 = "SELECT * FROM cart WHERE productid='".$pqr1['id']."' AND orderid='$orderid'";
if ($result1=mysqli_query($con,$check1)){
if (mysqli_num_rows($result1) == 1){
$cqr = mysqli_fetch_assoc($result1);

$newqty = $cqr['qty'] + 1;
$ttlamount = $_GET['price'];
$cartitemttl = $cqr['total'] + $ttlamount;
$con->autocommit(FALSE);
$con->query("UPDATE cart SET total='$cartitemttl', qty='$newqty' WHERE productid='".$pqr1['id']."' AND orderid='$orderid'");
$con->commit();
}
else{
$sql = "INSERT INTO cart (userid, vendor, productid, price, orderid, qty, status, total, date) VALUES (?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $pqr1['userid'], $_GET['id3'], $_GET['price'], $orderid, '1', 'Open', $_GET['price'], $now]);
}
}

$check = "SELECT * FROM cart WHERE orderid='$orderid'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) >= 1){
$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='$orderid'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
}
}
}
$check2 = "SELECT * FROM orders WHERE orderid='$orderid'";
if ($result2=mysqli_query($con,$check2)){
if (mysqli_num_rows($result2) == 1){
$con->autocommit(FALSE);
$con->query("UPDATE orders SET total='$orderttl', deliveryaddress='$address', photo='".$pqr1['photo']."', date='$now', dateadded='$today' WHERE orderid='$orderid'");
$con->commit();
}
else{
$sql = "INSERT INTO orders (userid, orderid, total, status, deliveryaddress, deliverycontact, recipient, schedule, deliverystatus, trackingcode, paymentmethod, comments, photo, discount, date, dateadded) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $orderid, $orderttl, 'Open', $address, 'None', 'None', 'Today', 'Incomplete', 'None', 'Wallet', 'None', 'img/img-shoppingbag.jpg', '0', $now, $today]);
}
}
}

/*
if(isset($_GET['id4'])){
$check = mysqli_query($con, "SELECT * FROM saves WHERE UserID='".$uqr['UserID']."' AND VideoID='".$_GET['id4']."'");
if(mysqli_num_rows($check) == 1){
$con->autocommit(FALSE);
$con->query("DELETE FROM saves WHERE UserID='".$uqr['UserID']."' AND VideoID='".$_GET['id4']."'");
$con->commit();
exit;
}
else{
$sql = "INSERT INTO saves (VideoID, UserID, DateAdded) VALUES (?,?,?)";
$conn->prepare($sql)->execute([$_GET['id4'], $uqr['UserID'], $now]);
}
}

if(isset($_POST['comment'])){
$sql = "INSERT INTO comments (UserID, VideoID, Comment, DateAdded) VALUES (?,?,?,?)";
$conn->prepare($sql)->execute([$uqr['UserID'], $_POST['VideoID'], $_POST['comment'], $now]);

$cqq = mysqli_query($con, "SELECT * FROM comments ORDER BY DateAdded DESC LIMIT 1");
$cqr = mysqli_fetch_assoc($cqq);

$uqq = mysqli_query($con, "SELECT * FROM users WHERE UserID='".$cqr['UserID']."'");
$usr = mysqli_fetch_assoc($uqq);
?>
<div class="vcp_inf">
<div class="vc_hd">
<div class="avatar3"><img src="<?php echo $usr['Avatar']; ?>" alt=""></div>
</div>
<div class="coments">
<h2><?php echo $usr['FirstName']; ?> <?php echo $usr['LastName']; ?> <small class="posted_dt"> . Just now</small></h2>
<p style="margin-top:-10px"><?php echo $cqr['Comment']; ?></p>
</div><!--coments end-->
</div><!--vcp_inf end-->
</li>
<li>
<?php
}
if(isset($_GET['id5'])){
$con->autocommit(FALSE);
$con->query("DELETE FROM comments WHERE ID='".$_GET['id5']."'");
$con->commit();
}

if(isset($_GET['id6'])){
$con->autocommit(FALSE);
$con->query("DELETE FROM likes WHERE ID='".$_GET['id6']."'");
$con->commit();
}

if(isset($_GET['id7'])){
$vqq = mysqli_query($con, "SELECT * FROM uploads WHERE VideoID='".$_GET['id7']."'");
$vqr = mysqli_fetch_assoc($vqq);
//Vimeo Video
$file_name = '/videos/'.$vqr['VideoCode'].'';

// vimeo command
$uri = $lib->request($file_name,array(),'DELETE');

if($vqr['Thumbnail']!=='images/video-default.jpg'){
unlink ($vqr['Thumbnail']);
unlink ($vqr['VideoURL']);
}
$con->autocommit(FALSE);
$con->query("DELETE FROM uploads WHERE VideoID='".$_GET['id7']."'");
$con->query("DELETE FROM likes WHERE VideoID='".$_GET['id7']."'");
$con->query("DELETE FROM saves WHERE VideoID='".$_GET['id7']."'");
$con->query("DELETE FROM comments WHERE VideoID='".$_GET['id7']."'");
$con->commit();
}

if(isset($_GET['id8'])){
$con->autocommit(FALSE);
$con->query("DELETE FROM saves WHERE ID='".$_GET['id8']."'");
$con->commit();
}

if(isset($_POST['videoid'])){
if(isset($_POST['feature'])){
$feature = $_POST['feature'];
}
else{
$feature = 'No';
}
$vqq = mysqli_query($con, "SELECT * FROM uploads WHERE VideoID='".$_POST['videoid']."'");
$vqr = mysqli_fetch_assoc($vqq);

$vidtitle = ucwords($_POST['title']);
$desc = $_POST['description'];
if(isset($_POST['category'])){
$categories = implode(", ", $_POST["category"]);
}
else{
echo 'Select at least one Category';
exit();
}
$videocode = $vqr['VideoCode'];
$response = $lib->request('/videos/'.$vqr['VideoCode'].'', array('name' => ''.$vidtitle.'', 'description' => ''.$desc.''), 'PATCH');
$con->autocommit(FALSE);
$con->query("UPDATE uploads SET Title='".htmlspecialchars($vidtitle, ENT_QUOTES)."', Description='".htmlspecialchars($_POST['description'], ENT_QUOTES)."', Category='$categories', Tags='".ucwords($_POST['tags'])."', Visibility='".$_POST['visibility']."', Monetize='".$_POST['monetize']."', Comments='".$_POST['comments']."', Featured='$feature', License='".$_POST['license']."' WHERE VideoID='".$_SESSION['VideoID']."'");
$con->commit();
echo 'Your changes were saved';
}

if(isset($_GET['id9'])){
$adqq = mysqli_query($con, "SELECT * FROM ads WHERE ID='".$_GET['id9']."'");
$aqr = mysqli_fetch_assoc($adqq);

$visits = $aqr['Visits'] + 1;
$con->autocommit(FALSE);
$con->query("UPDATE ads SET Visits='$visits' WHERE ID='".$_GET['id9']."'");
$con->commit();
}

if(isset($_GET['id10'])){
$adqq = mysqli_query($con, "SELECT * FROM ads WHERE ID='".$_GET['id10']."'");
$aqr = mysqli_fetch_assoc($adqq);
if($aqr['UserID']!==$uqr['UserID']){

if(isset($_COOKIE['email'])){
$tokens = $uqr['Tokens'] + 1;
$con->autocommit(FALSE);
$con->query("UPDATE users SET Tokens='$tokens' WHERE UserID='".$uqr['UserID']."'");
$con->commit();
}

$adviews = $aqr['Views'] + 1;
$con->autocommit(FALSE);
$con->query("UPDATE ads SET Views='$adviews' WHERE ID='".$_GET['id10']."'");
$con->commit();

if(isset($_COOKIE['email'])){
$userid = $uqr['UserID'];
}
else{
$userid = 'G';
}
$sql = "INSERT INTO adviews (AdID, VideoID, UserID, Viewed) VALUES (?,?,?,?)";
$conn->prepare($sql)->execute([$_GET['id10'], $_SESSION['VideoID'], $userid, $now]);
}
}

if(isset($_GET['id11'])){
$adqq = mysqli_query($con, "SELECT * FROM ads WHERE ID='".$_GET['id11']."'");
$aqr = mysqli_fetch_assoc($adqq);
$file_name = '/videos/'.$aqr['VideoCode'].'';

$con->autocommit(FALSE);
$con->query("DELETE FROM ads WHERE ID='".$_GET['id11']."'");
$con->query("DELETE FROM adviews WHERE AdID='".$_GET['id11']."'");
$con->commit();
}
*/
?>
