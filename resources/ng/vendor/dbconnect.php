<?php
// ini_set('session.cookie_domain', '.expiringsoon.shop');

$con = mysqli_connect("127.0.0.1","expiringsoon_admin","jC71hnoe7v9f","expiringsoon_maindb");
// Check connection
if (mysqli_connect_errno()){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli("127.0.0.1","expiringsoon_admin","jC71hnoe7v9f","expiringsoon_maindb");
  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}

try {
$conn = new PDO("mysql:host=127.0.0.1;dbname=expiringsoon_maindb","expiringsoon_admin","jC71hnoe7v9f");
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}

// My timezone $timezone = "Africa/Lagos"; // PHP 5 date_default_timezone_set ($timezone); // PHP 4 putenv ('TZ=' . $timezone);
// My timezone
$timezone = "Africa/Lagos";
// PHP 5
date_default_timezone_set ($timezone);
// PHP 4
putenv ('TZ=' . $timezone);

$currentyear = 2021;
$now = date('Y-m-d H:i:s');
$now2 = date('Y-m-d');
$hourdiff = "0"; // hours diff btwn server and local time
$mytime = date("l, d F Y h:i a",time() + ($hourdiff * 3600));
$posted = date("l, F d h:i a",time() + ($hourdiff * 3600));
$today = date("l, F d, Y",time() + ($hourdiff * 3600));
?>
