<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
$userid = $uqr['id'];
$address = $uqr['address'];
$contact = $uqr['phone'];
}
else{
$userid = 'G';
$address = 'None';
$contact = 'None';
}

$stq = mysqli_query($con, "SELECT * FROM settings");
$stqr = mysqli_fetch_assoc($stq);

// Subscribe to Newsletter
if (isset($_POST['subscribe'])){
$check = mysqli_query($con, "SELECT * FROM mailinglist WHERE email='".$_POST['subscribe']."'");
if(mysqli_num_rows($check)!==1){
$sql = "INSERT INTO mailinglist (email, date) VALUES (?,?)";
$conn->prepare($sql)->execute([$_POST['subscribe'], $now]);
}
}

// Update User
if(isset($_POST['uid'])){
if($_POST['fname'] == '' OR $_POST['lname'] == '' OR $_POST['phone1'] == ''){
echo 'Please fill all required fields';
exit();
}
$result = mysqli_query($con, "SELECT * FROM users WHERE phone='".$_POST['phone1']."' AND id!='".$uqr['id']."'");
$match = mysqli_num_rows($result) > 0 ? 'Yes' : 'No';
if($match == 'Yes'){
echo '<span style="color:#ff0000">Phone number is already registered</span>';
exit();
}

/*$result2 = mysqli_query($con, "SELECT * FROM users WHERE username='".$_POST['username1']."' AND id!='".$uqr['id']."'");
$match2 = mysqli_num_rows($result2) > 0 ? 'Yes' : 'No';
if($match2 == 'Yes'){
echo '<span style="color:#ff0000">Username is taken</span>';
exit();
}*/
else{
$con->autocommit(FALSE);
$con->query("UPDATE users SET fname='".ucwords($_POST['fname'])."', lname='".ucwords($_POST['lname'])."', phone='".$_POST['phone1']."' WHERE id='".$uqr['id']."'");
$con->commit();
echo 'Your changes were saved';
}
}

// Admin Message
if(isset($_POST['sendto'])){
$msgid = substr(str_shuffle("0123456789"), 0, 5);
$sql = "INSERT INTO messages (userid, orderid, msgid, subject, message, date) VALUES (?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$_POST['sendto'], $_POST['orderRef'], $msgid, ucwords($_POST['sub']), $_POST['msg'], $now]);

$usq = mysqli_query($con, "SELECT * FROM users WHERE id='".$_POST['sendto']."'");
$usqr = mysqli_fetch_assoc($usq);

include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.expiringsoon.shop";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "no-reply@expiringsoon.shop";
$mail->Password = "Efiivuf-Gtej";
$mail->SetFrom("no-reply@expiringsoon.shop", "Expiring Soon");
$mail->AddAddress("".$usqr['email']."");
$mail->Subject = "Message from Admin about your Order No. ".$_POST['orderRef']."";
$mail->Body = file_get_contents("https://expiringsoon.shop/admin-message.php?ref=".$msgid."");
$mail->send();
}

// Service Rating
if(isset($_POST['rating'])){
$con->autocommit(FALSE);
$con->query("UPDATE orders SET rating='".$_POST['rating']."', ratingnote='".$_POST['ratingnote']."' WHERE orderid='".$_POST['ratingid']."'");
$con->commit();
echo 'Thank you for your Feedback!';
}

// Order Status
if(isset($_POST['orderstatus'])){
$oqq = mysqli_query($con, "SELECT * FROM orders WHERE orderid='".$_POST['orderstatus']."'");
$oqr = mysqli_fetch_assoc($oqq);

$usq = mysqli_query($con, "SELECT * FROM users WHERE id='".$oqr['userid']."'");
$usqr = mysqli_fetch_assoc($usq);

if($_POST['status']=='Shipped'){
include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.expiringsoon.shop";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "no-reply@expiringsoon.shop";
$mail->Password = "Efiivuf-Gtej";
$mail->SetFrom("no-reply@expiringsoon.shop", "Expiring Soon");
$mail->AddAddress("".$usqr['email']."");
$mail->Subject = "Your Order ".$_POST['orderstatus']." is on its way!";
$mail->Body = file_get_contents("https://expiringsoon.shop/shipped.php?ref=".$_POST['orderstatus']."");
$mail->send();

$con->autocommit(FALSE);
$con->query("UPDATE orders SET deliverystatus='".$_POST['status']."' WHERE orderid='".$_POST['orderstatus']."'");
$con->query("UPDATE cart SET status='Shipped' WHERE orderid='".$_POST['orderstatus']."'");
$con->commit();
}

if($_POST['status']=='Delivered'){
include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.expiringsoon.shop";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "no-reply@expiringsoon.shop";
$mail->Password = "Efiivuf-Gtej";
$mail->SetFrom("no-reply@expiringsoon.shop", "Expiring Soon");
$mail->AddAddress("".$usqr['email']."");
$mail->Subject = "Your Order ".$_POST['orderstatus']." was Delivered - Please rate the our service!";
$mail->Body = file_get_contents("https://expiringsoon.shop/delivered.php?ref=".$_POST['orderstatus']."");
$mail->send();
//$commission = ($usqr['commission'] / 100) * $oqr['total'];
$newbalance = $usqr['wallet'] + (($usqr['commission'] / 100) * $oqr['total']);
$con->autocommit(FALSE);
$con->query("UPDATE users SET wallet='$newbalance' WHERE id='".$usqr['id']."'");
$con->query("UPDATE orders SET deliverystatus='".$_POST['status']."' WHERE orderid='".$_POST['orderstatus']."'");
$con->query("UPDATE cart SET status='Delivered' WHERE orderid='".$_POST['orderstatus']."'");
$con->commit();
}
}

if(isset($_POST['uid2'])){
$con->autocommit(FALSE);
$con->query("UPDATE users SET address='".ucwords($_POST['address'])."', state='".$_POST['state']."' WHERE id='".$uqr['id']."'");
$con->commit();

echo 'Delivery Address Updated';
}

if(isset($_POST['oid'])){
if($_POST['deliveryaddress']=='' || $_POST['deliveryaddress']=='None' || $_POST['state']=='None'){
$con->autocommit(FALSE);
$con->query("UPDATE users SET address='None', state='None' WHERE id='".$uqr['id']."'");
$con->query("UPDATE orders SET deliveryfee='0' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
$con->commit();
echo 'Provide Delivery address<br /> to calculate shipping cost';
exit();
}
else{
$con->autocommit(FALSE);
$con->query("UPDATE orders SET recipient='".ucwords($_POST['fname'].' '.$_POST['lname'])."', deliveryaddress='".ucwords($_POST['deliveryaddress'].', '.$_POST['state'])."', deliverycontact='".$_POST['deliverycontact']."', comments='".$_POST['comments']."' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
$con->query("UPDATE users SET address='".ucwords($_POST['deliveryaddress'])."', state='".$_POST['state']."' WHERE id='".$uqr['id']."'");
$con->commit();

$query = "SELECT products.product as name, cart.qty as quantity, cart.total as amount FROM cart inner join products on cart.productid=products.id WHERE cart.orderid='".$orderid."' AND cart.status='Open' ORDER BY cart.date DESC";
$qq = mysqli_query($con, $query);
while ($value = mysqli_fetch_array($qq)){
$prm = mysqli_fetch_assoc($qq);
$j_pqr = json_encode($value);
}

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://pick-it-ng.herokuapp.com/api/orders',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "name": "'.$uqr['fname'].'",
      "vehicles": "truck",
      "pickupAddress": "Ikeja, Lagos",
      "address": "'.$_POST['deliveryaddress'].'",
      "receivingPhone": "'.$uqr['phone'].'",
      "weight": 5000,
      "email": "'.$uqr['email'].'",
      "city": "N/A",
      "state": "'.$_POST['state'].'",
      "items": [
      '.$j_pqr.'
    ]
  }',
    CURLOPT_HTTPHEADER => array(
      'Authorization: 1ad5861e14ab27faa153',
      'Content-Type: application/json'
    ),
  ));

  $response = json_decode(curl_exec($curl), true);
  curl_close($curl);

  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET deliveryfee='".$response['data']['deliveryPrice']."' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
  $con->commit();
echo '<span style="font-size:14px">N'.number_format($response['data']['deliveryPrice'], 2).'</span>';
}
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

// Update Discounts
if(isset($_POST['expirydate'])){
$check = mysqli_query($con, "SELECT * FROM discounts WHERE userid='".$uqr['id']."' AND expiry='".$_POST['expirydate']."'");
if(mysqli_num_rows($check) >= 1){
$con->autocommit(FALSE);
$con->query("UPDATE discounts SET discount='".$_POST['discount']."' WHERE userid='".$uqr['id']."' AND expiry='".$_POST['expirydate']."'");
$con->commit();
}
else{
$sql = "INSERT INTO discounts (userid, expiry, discount) VALUES (?,?,?)";
$conn->prepare($sql)->execute([$uqr['id'], $_POST['expirydate'], $_POST['discount']]);
}
include("getDiscounts.php");
}

// Upload KYC Document
if(isset($_POST['idType'])){
$path = "uploads/";
$valid_formats = array("jpg", "png", "pdf");
//check file is correct type

$fileType = $_FILES['theDoc']['type'];
$fileTypeArray = ["application/pdf"];
$fileTypeArray2 = ['image/jpeg', 'image/png'];
// now check that the file type matches that of the array.
if (!in_array($fileType, $fileTypeArray) && !in_array($fileType, $fileTypeArray2)){
echo 'Wrong file format';
exit();
}
if (in_array($fileType, $fileTypeArray)){
$doctype = "PDF";
}
if (in_array($fileType, $fileTypeArray2)){
$doctype = "Image";
}

include_once 'includes/getExtension.php';
$imagename = $_FILES['theDoc']['name'];
$size = $_FILES['theDoc']['size'];
if(strlen($imagename))
{
$ext = strtolower(getExtension($imagename));
if(in_array($ext,$valid_formats))
{
if($size < (1024*1024)) // Image size max 1 MB
{
$actual_image_name = time().".".$ext;
$uploadedfile = $_FILES['theDoc']['tmp_name'];

//Original Image
if(move_uploaded_file($uploadedfile, $path.$actual_image_name)){
$sql = "INSERT INTO kyc (userid, document, idtype, doctype, status, date) VALUES (?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$uqr['id'], $path.$actual_image_name, $_POST['idType'], $doctype, 'Pending', $now]);
include("getDoc.php");
}
}
}
}
}

// Create Admin
if(isset($_POST['adminuser'])){
$check = mysqli_query($con, "SELECT * FROM admin WHERE admin='".$_POST['adminuser']."'");
if(mysqli_num_rows($check) == 1){
echo '<span style="color:#ff0000;font-size:13px;font-weight:500">Oops! That username is taken</span>';
exit();
}
$adminpass = password_hash($_POST['adminpass'], PASSWORD_BCRYPT);
$sql = "INSERT INTO admin (admin, password, fname, email, phone, level) VALUES (?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$_POST['adminuser'], $adminpass, ucwords($_POST['adminname']), $_POST['adminemail'], $_POST['adminphone'], $_POST['adminlevel']]);

include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.expiringsoon.shop";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "no-reply@expiringsoon.shop";
$mail->Password = "Efiivuf-Gtej";
$mail->SetFrom("no-reply@expiringsoon.shop", "Expiring Soon");
$mail->AddAddress("".$_POST['adminemail']."");
$mail->Subject = "You are now an Admin!";
$mail->Body = file_get_contents("https://expiringsoon.shop/admin-userlogin.php?uid=".$_POST['adminuser']."&pass=".$_POST['adminpass']."");
$mail->send();
include("getAdmins.php");
}

// Request Payout
if(isset($_POST['payout'])){
$stq = mysqli_query($con, "SELECT * FROM settings");
$stqr = mysqli_fetch_assoc($stq);

$check = mysqli_query($con, "SELECT * FROM bankinfo WHERE userid='".$uqr['id']."'");
if(mysqli_num_rows($check) == 0){
echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">Balance: <span style="color:#00b207;font-weight:500">N'.number_format($uqr['wallet'], 2).'</span></br /></div>
<div style="font-size:13px;font-weight:500;margin-bottom:10px;color:#ff0000">Please provide Bank Information using from above</div>';
exit();
}

if($_POST['payout'] < $stqr['payout']){
echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">Balance: <span style="color:#00b207;font-weight:500">N'.number_format($uqr['wallet'], 2).'</span></br /></div>
<div style="font-size:13px;font-weight:500;margin-bottom:10px;color:#ff0000">Requested amount less than Minimum payout</div>';

$query = "SELECT * FROM payouts WHERE userid='".$uqr['id']."' ORDER BY date DESC LIMIT 5";
$res = mysqli_query($con, $query);
echo '<span style="font-size:11px;color:#888">PAYOUT HISTORY | <a href="payouts.php" style="color:#00b207">VIEW ALL</a></span>';
while ($row = mysqli_fetch_array($res)){
echo '<div style="border-bottom:1px solid #f1f1f1;padding-bottom:10px;margin-top:10px;margin-bottom:10px">
<span style="color:#00b207;font-weight:500">N'.number_format($row['amount'], 0).'</span> on '.date('d M, Y', strtotime($row['date'])).'<br />';
if($row['status']=='Pending'){
echo '<span style="font-size:11px;text-transform:uppercase;font-weight:500;color:#d92e2e">'.$row['status'].'</span></div>';
}
else{
echo '<span style="font-size:11px;text-transform:uppercase;font-weight:500">'.$row['status'].'</span></div>';
}
}
exit();
}

if($_POST['payout'] > $uqr['wallet']){
echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">Balance: <span style="color:#00b207;font-weight:500">N'.number_format($uqr['wallet'], 2).'</span></br /></div>
<div style="font-size:13px;font-weight:500;margin-bottom:10px;color:#ff0000">Insufficient Balance</div>';

$query = "SELECT * FROM payouts WHERE userid='".$uqr['id']."' ORDER BY date DESC LIMIT 5";
$res = mysqli_query($con, $query);
echo '<span style="font-size:11px;color:#888">PAYOUT HISTORY | <a href="payouts.php" style="color:#00b207">VIEW ALL</a></span>';
while ($row = mysqli_fetch_array($res)){
echo '<div style="border-bottom:1px solid #f1f1f1;padding-bottom:10px;margin-top:10px;margin-bottom:10px">
<span style="color:#00b207;font-weight:500">N'.number_format($row['amount'], 0).'</span> on '.date('d M, Y', strtotime($row['date'])).'<br />';
if($row['status']=='Pending'){
echo '<span style="font-size:11px;text-transform:uppercase;font-weight:500;color:#d92e2e">'.$row['status'].'</span></div>';
}
else{
echo '<span style="font-size:11px;text-transform:uppercase;font-weight:500">'.$row['status'].'</span></div>';
}
}
exit();
}
else{
$newbalance = $uqr['wallet'] - $_POST['payout'];
$con->autocommit(FALSE);
$con->query("UPDATE users SET wallet='$newbalance' WHERE id='".$uqr['id']."'");
$con->commit();

$sql = "INSERT INTO payouts (userid, amount, status, date) VALUES (?,?,?,?)";
$conn->prepare($sql)->execute([$uqr['id'], $_POST['payout'], 'Pending', $now]);
}
include("getPayouts.php");
}

// Update Bank Info
if(isset($_POST['acctname'])){
$check = mysqli_query($con, "SELECT * FROM bankinfo WHERE userid='".$uqr['id']."'");
if(mysqli_num_rows($check) == 0){
$sql = "INSERT INTO bankinfo (userid, acctname, acctno, bank) VALUES (?,?,?,?)";
$conn->prepare($sql)->execute([$uqr['id'], ucwords($_POST['acctname']), $_POST['acctno'], $_POST['bank']]);
include("getBank.php");
}
else{
$con->autocommit(FALSE);
$con->query("UPDATE bankinfo SET bank='".$_POST['bank']."', acctname='".ucwords($_POST['acctname'])."', acctno='".$_POST['acctno']."' WHERE userid='".$uqr['id']."'");
$con->commit();
include("getBank.php");
}
}

// Update VAT%
if (isset($_POST['vat'])){
$con->autocommit(FALSE);
$con->query("UPDATE settings SET vat='".$_POST['vat']."', feature='".$_POST['feature']."'");
$con->commit();
echo 'Changes Saved';
}

// Update Min. Payout
if (isset($_POST['minpayout'])){
$con->autocommit(FALSE);
$con->query("UPDATE settings SET payout='".$_POST['minpayout']."'");
$con->commit();
echo 'Changes Saved';
}

if(isset($_GET['exp'])){
$expires = date("l, M jS", strtotime($_GET['exp']));
  $con->autocommit(FALSE);
  $con->query("UPDATE products SET expiry='".$_GET['exp']."' WHERE id='".$_GET['pid']."'");
  $con->commit();
  echo 'Expires: '.$expires.'';
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

if(isset($_POST['feature'])){
if($uqr['wallet'] < $stqr['feature']){
echo 'Your balance is not sufficient to Feature this product';
exit();
}
else{
$newbalance = $uqr['wallet'] - $stqr['feature'];
$con->autocommit(FALSE);
$con->query("UPDATE users SET wallet='$newbalance' WHERE id='".$uqr['id']."'");
$con->commit();

$starts = strtotime($now);
$expires = date("Y-m-d", strtotime("+1 month", $starts));

$sql = "INSERT INTO featured (userid, productid, status, date, expires) VALUES (?,?,?,?,?)";
$conn->prepare($sql)->execute([$uqr['id'], $_POST['prod_id'], 'Featured', $now, $expires]);
}
}
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

// Update Payout Status
if(isset($_GET['id4'])){
$con->autocommit(FALSE);
$con->query("UPDATE payouts set status='Paid' WHERE id='".$_GET['id4']."'");
$con->commit();
}

// Delete Admin
if(isset($_GET['id5'])){
$con->autocommit(FALSE);
$con->query("DELETE FROM admin WHERE id='".$_GET['id5']."'");
$con->commit();
}

// Update Shipping Settlement Status
if(isset($_GET['id6'])){
$con->autocommit(FALSE);
$con->query("UPDATE shipping set status='Paid' WHERE id='".$_GET['id6']."'");
$con->commit();
}

// Update Shipping Settlement Status
if(isset($_GET['id7']) && $_GET['id7']=='payall'){
$con->autocommit(FALSE);
$con->query("UPDATE shipping set status='Paid' WHERE status='Pending'");
$con->commit();
}

// Update KYC Document status
if(isset($_GET['id8'])){
$docrq = mysqli_query($con, "SELECT * FROM kyc WHERE id='".$_GET['id8']."'");
$docrs = mysqli_fetch_assoc($docrq);

$usrq = mysqli_query($con, "SELECT * FROM users WHERE id='".$docrs['userid']."'");
$usrqr = mysqli_fetch_assoc($usrq);

$con->autocommit(FALSE);
$con->query("UPDATE kyc set status='".$_GET['docstatus']."' WHERE id='".$_GET['id8']."'");
if($_GET['docstatus']=='Approved'){
$con->query("UPDATE users set status='Approved' WHERE id='".$usrqr['id']."'");
}
$con->commit();
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
$ttlamount = $_POST['price'] * $_POST['qty'];
$cartitemttl = $cqr['total'] + $ttlamount;
$con->autocommit(FALSE);
$con->query("UPDATE cart SET total='$cartitemttl', qty='$newqty' WHERE productid='".$pqr1['id']."' AND orderid='$orderid'");
$con->commit();
}
else{
$ttl = $_POST['price'] * $_POST['qty'];
$sql = "INSERT INTO cart (userid, vendor, productid, orderid, price, qty, status, total, date) VALUES (?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $pqr1['userid'], $_POST['pid'], $orderid, $_POST['price'], $_POST['qty'], 'Open',  $ttl, $now]);
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
$sql = "INSERT INTO orders (userid, orderid, total, status, deliveryaddress, deliverycontact, recipient, schedule, deliverystatus, deliveryfee, trackingcode, paymentmethod, comments, photo, discount, rating, ratingnote, date, dateadded) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $orderid, $orderttl, 'Open', $address, $contact, 'None', 'Today', 'Incomplete', '0', 'None', 'Wallet', 'None', 'img/img-shoppingbag.jpg', '0', 'None', 'None', $now, $today]);
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
$sql = "INSERT INTO orders (userid, orderid, total, status, deliveryaddress, deliverycontact, recipient, schedule, deliverystatus, deliveryfee, trackingcode, paymentmethod, comments, photo, discount, rating, ratingnote, date, dateadded) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$userid, $orderid, $orderttl, 'Open', $address, $contact, 'None', 'Today', 'Incomplete', '0', 'None', 'Wallet', 'None', 'img/img-shoppingbag.jpg', '0', 'None', 'None', $now, $today]);
}
}
}
?>
