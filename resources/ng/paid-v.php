<?php
include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];

$oqq = mysqli_query($con, "SELECT * FROM orders WHERE orderid='$orderid'");
$oqr = mysqli_fetch_assoc($oqq);
}

if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

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
        $query = "SELECT * FROM cart WHERE orderid='$orderid' AND vendor='".$_GET['v']."'";
        $proddata = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($proddata)){

        $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$row['productid']."'");
        $pqr = mysqli_fetch_assoc($pqq);
        $newstock = $pqr['stock'] - $row['qty'];

        $con->autocommit(FALSE);
        $con->query("UPDATE products SET stock='$newstock' WHERE id='".$row['productid']."'");
        $con->commit();
        }

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
              "pickupAddress": "N/A",
              "address": "'.$uqr['address'].'",
              "receivingPhone": "'.$uqr['phone'].'",
              "weight": 5000,
              "email": "'.$uqr['email'].'",
              "city": "N/A",
              "state": "'.$uqr['state'].'",
              "items": [
              '.$j_pqr.'
            ]
          }',
            CURLOPT_HTTPHEADER => array(
              'Authorization: 1ad5861e14ab27faa153',
              'Content-Type: application/json'
            ),
          ));

          // $response = curl_exec($curl);
          // echo '<pre>'.$response.'<pre>';
          $response = json_decode(curl_exec($curl), true);
          curl_close($curl);
          $trackingcode = $response['data']['trackingCode'];

          // Create new order
          $rand = substr(str_shuffle("0123456789"), 0, 10);
          $con->autocommit(FALSE);
          $con->query("UPDATE cart SET orderid='$rand' WHERE orderid='$orderid' AND vendor='".$_GET['v']."'");
          $con->commit();
          $userid = $uqr['id'];
          $address = $uqr['address'];
          $contact = $uqr['phone'];
          $res = mysqli_query($con, "SELECT sum(total) as ttl FROM cart WHERE vendor='".$_GET['v']."'");
          while ($row = mysqli_fetch_array($res)){
          $cartttl = $row['ttl'];
          }
          $neworderttl = $oqr['total'] - $cartttl;
          $con->autocommit(FALSE);
          $con->query("UPDATE cart SET orderid='$rand' WHERE orderid='$orderid' AND vendor='".$_GET['v']."'");
          $con->commit();

          $sql = "INSERT INTO orders (userid, orderid, total, status, deliveryaddress, deliverycontact, recipient, schedule, deliverystatus, deliveryfee, trackingcode, paymentmethod, comments, photo, discount, rating, ratingnote, date, dateadded) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
          $conn->prepare($sql)->execute([$userid, $rand, $cartttl, 'Paid', $address, $contact, 'None', 'Today', 'Processing', '0', 'None', 'Wallet', 'None', 'img/img-shoppingbag.jpg', '0', 'None', 'None', $now, $today]);
          // end new order

          $con->autocommit(FALSE);
          $con->query("UPDATE orders SET total='$neworderttl' WHERE orderid='$orderid'");
          $con->query("UPDATE cart SET status='Closed' WHERE userid='".$uqr['id']."' AND orderid='$rand' AND vendor='".$_GET['v']."'");
          $con->query("UPDATE orders SET status='Paid', paymentmethod='Card', deliverystatus='Processing', trackingcode='$trackingcode' WHERE userid='".$uqr['id']."' AND orderid='$rand'");
          if($oqr['recipient'] == 'None'){
          $con->query("UPDATE orders SET recipient='".ucwords($uqr['fname'].' '.$uqr['lname'])."', deliverycontact='".$uqr['phone']."', deliveryfee='".$oqr['deliveryfee']."', discount='".$oqr['discount']."' WHERE userid='".$uqr['id']."' AND orderid='$rand'");
          }
          $con->commit();

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
        $mail->AddAddress("".$uqr['email']."");
        $mail->Subject = "Your order no. ".$rand." is on its way!";
        $mail->Body = file_get_contents("https://ng.expiringsoon.shop/receipt.php?ref=".$rand."");
        $mail->send();
        include("vendor-notify.php?v=".$_GET['v']."");
header("Location: invoice.php?ref=".$rand."&done");
}
}
else{
header("Location: checkout-v.php?v=".$_GET['v']."&pay=0");
}
?>
<pre>
<?php // print_r($resp); ?>
</pre>
