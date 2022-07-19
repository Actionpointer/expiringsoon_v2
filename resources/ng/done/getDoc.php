<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$result = mysqli_query($con, "SELECT * FROM users WHERE email='".$_COOKIE['email']."'");
$uqr = mysqli_fetch_assoc($result);
}
?>
<style>
    .docimg {
        width: 10%;
        margin-right: 5px;
        float: left;
    }
    .docimg img {
        width: 100%;
    }
    .docinfo {
        width: 70%;
    }
</style>
<?php
$query = mysqli_query($con, "SELECT * FROM kyc WHERE userid='".$uqr['id']."' ORDER BY date DESC");
while ($doc = mysqli_fetch_array($query)){
if($doc['status']=='Approved'){ $statuscolor = '#00b207'; } else{ $statuscolor = '#ff0000'; }
if($doc['doctype']=='PDF'){ $docimg = 'img/icon-pdf.jpg'; } else{ $docimg = 'img/icon-jpg.jpg'; }
?>
<div style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
    <div class="docimg">
        <a href="<?php echo $doc['document']; ?>" target="_blank"><img src="<?php echo $docimg; ?>"></a>
    </div>
    <div class="docinfo"><span style="font-size:14px"><?php echo $doc['idtype']; ?></span>
        <br /><span style="font-weight:500;font-size:12px;text-transform:uppercase;color:<?php echo $statuscolor; ?>"><?php echo $doc['status']; ?></span>
    </div>
</div>
<?php } ?>
