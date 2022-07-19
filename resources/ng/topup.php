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

if (isset($_GET['tx_ref'])) {
        $ref = $_GET['tx_ref'];
        $amount = $_GET['amount']; //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK-8033c67d90e0c53c91ae99c16ac78da8-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);

        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
        $newttl = $uqr['wallet'] + $chargeAmount;
        $con->autocommit(FALSE);
        $con->query("UPDATE users SET wallet='$newttl' WHERE id='".$uqr['id']."'");
        $con->commit();
header("Location: account.php?top=1");
}
}
else{
header("Location: account.php?top=0");
}
}
?>
<pre>
<?php print_r($resp); ?>
</pre>
