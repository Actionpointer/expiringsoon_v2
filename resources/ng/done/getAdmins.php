<?php
include("dbconnect.php");
$query = "SELECT * FROM admin WHERE admin='".$_COOKIE['admin']."'";
$result = mysqli_query($con, $query);
$aqr = mysqli_fetch_assoc($result);

$query = "SELECT * FROM admin ORDER BY level ASC";
$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($res)){
echo '<div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:14px" class="adminrow">

<div style="float:right">
    <a href="#" class="remove" id5="'.$row['id'].'">
        <span class="iconify" data-icon="eva:person-delete-fill" style="color: red;" data-width="25" data-height="25"></span>
    </a>
</div>
<span style="color:#000;font-weight:500">'.$row['admin'].'</span></br />
    '.$row['fname'].'<br />'.$row['email'].'<br />'.$row['phone'].'<br />
    <span style="color:#000;font-weight:500">'.$row['level'].'</span></br /></div>';
}
?>
