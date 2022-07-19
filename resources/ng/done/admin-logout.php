<?php
include("dbconnect.php");
setcookie ("admin", null, time() -3600, '/');
header("Location: admin.php");
?>
