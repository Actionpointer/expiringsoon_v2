<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if(isset($_COOKIE['admin'])){
$query = "SELECT * FROM admin WHERE admin='".$_COOKIE['admin']."'";
$result = mysqli_query($con, $query);
$aqr = mysqli_fetch_assoc($result);
}
else{
header("Location: admin.php?fail");
}

if(isset($_POST['uid'])){
$usrq = mysqli_query($con, "SELECT * FROM users WHERE id='".$_POST['uid']."'");
$usrqr = mysqli_fetch_assoc($usrq);

if($_POST['username'] == '' OR $_POST['fname'] == '' OR $_POST['lname'] == '' OR $_POST['phone'] == ''){
echo 'Please fill all required fields';
exit();
}
$result = mysqli_query($con, "SELECT * FROM users WHERE phone='".$_POST['phone']."' AND id!='".$usrqr['id']."'");
$match = mysqli_num_rows($result) > 0 ? 'Yes' : 'No';
if($match == 'Yes'){
echo '<span style="color:#ff0000">Phone number is already registered</span>';
exit();
}

$result2 = mysqli_query($con, "SELECT * FROM users WHERE username='".$_POST['username']."' AND id!='".$usrqr['id']."'");
$match2 = mysqli_num_rows($result2) > 0 ? 'Yes' : 'No';
if($match2 == 'Yes'){
echo '<span style="color:#ff0000">Username is taken</span>';
exit();
}
else{
$con->autocommit(FALSE);
$con->query("UPDATE users SET username='".strtolower($_POST['username'])."', fname='".ucwords($_POST['fname'])."', lname='".ucwords($_POST['lname'])."', phone='".$_POST['phone']."', commission='".$_POST['commission']."' WHERE id='".$usrqr['id']."'");
$con->commit();
echo 'Your changes were saved';
}
}

if(isset($_POST['oid'])){
$con->autocommit(FALSE);
$con->query("UPDATE orders SET recipient='".ucwords($_POST['fname'].' '.$_POST['lname'])."', deliveryaddress='".ucwords($_POST['deliveryaddress'])."', deliverycontact='".$_POST['deliverycontact']."', comments='".$_POST['comments']."' WHERE userid='".$usrqr['id']."' AND orderid='$orderid'");
$con->commit();
echo 'Shipping Information Updated';
}

// Update Avatar
if (isset($_POST['avatar'])){
$usrq = mysqli_query($con, "SELECT * FROM users WHERE id='".$_POST['avatar']."'");
$usrqr = mysqli_fetch_assoc($usrq);

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
if($usrqr['pic']!=='img/avatar.png'){
unlink ($usrqr['pic']);
}
$con->autocommit(FALSE);
$con->query("UPDATE users SET pic='$path$actual_image_name' WHERE id='".$usrqr['id']."'");
$con->commit();
echo 'Avatar Updated';
}
}
}
}
}
?>
