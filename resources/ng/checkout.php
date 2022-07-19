<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}
else{
header("Location: index.php");
}

if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}
else{
header("Location: login.php?fail");
}

$cqq = mysqli_query($con, "SELECT vendor, count(*) AS groups FROM cart WHERE orderid='".$_SESSION['orderid']."' AND status='Open' group by vendor");
while ($vrow = mysqli_fetch_array($cqq)){
if($vrow['groups'] > 1){
header("Location: cart-v.php");
}
}

$stq = mysqli_query($con, "SELECT * FROM settings");
$stqr = mysqli_fetch_assoc($stq);

if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];

$oqq = mysqli_query($con, "SELECT * FROM orders WHERE orderid='$orderid'");
$oqr = mysqli_fetch_assoc($oqq);

/* $query = "SELECT productid, orderid, COUNT(*) FROM cart GROUP BY productid HAVING COUNT(*) > 1  ";
$qq = mysqli_query($con, $query);
while ($value = mysqli_fetch_array($qq)){
echo ''.$value['productid'].' <br />';
}
exit(); */

$check = "SELECT * FROM cart WHERE userid='".$uqr['id']."' AND status='Open' AND orderid!='$orderid'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) >= 1){

$sum = "SELECT sum(total) as ttl FROM cart WHERE userid='".$uqr['id']."' AND status='Open'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$neworderttl = $row['ttl'];
}

$con->autocommit(FALSE);
$con->query("DELETE FROM orders WHERE userid='".$uqr['id']."' AND status='Open' AND orderid!='$orderid'");
$con->query("UPDATE cart SET orderid='$orderid' WHERE userid='".$uqr['id']."' AND status='Open' AND orderid!='$orderid'");
$con->query("UPDATE orders SET total='$neworderttl' WHERE orderid='$orderid'");
$con->commit();
}
}

if($uqr['address']!=='None' || $uqr['state']!=='None'){
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

  $response = json_decode(curl_exec($curl), true);
  curl_close($curl);

  $con->autocommit(FALSE);
  $con->query("UPDATE orders SET deliveryfee='".$response['data']['deliveryPrice']."' WHERE orderid='$orderid'");
  $con->commit();
  // print_r($response);
}

$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='$orderid'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
}
$chk_vat = ($stqr['vat'] / 100) * ($orderttl + $oqr['deliveryfee']);
$deliveryfee = $oqr['deliveryfee'];
$finalttl = $orderttl + ($chk_vat + $deliveryfee);
}
else{
$chk_vat = '0';
$orderttl = '0';
$deliveryfee = '0';
$finalttl = '0';
}

if(isset($_POST['btn-wallet'])) {
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

    $proddata = mysqli_query($con, "SELECT * FROM cart WHERE orderid='$orderid'");
    while($row = mysqli_fetch_array($proddata)){

    $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$row['productid']."'");
    $pqr = mysqli_fetch_assoc($pqq);
    $newstock = $pqr['stock'] - $row['qty'];

    $con->autocommit(FALSE);
    $con->query("UPDATE products SET stock='$newstock' WHERE id='".$row['productid']."'");
    $con->commit();
    }

    $newbalance = $uqr['wallet'] - $finalttl;
    $con->autocommit(FALSE);
    $con->query("UPDATE users SET wallet='$newbalance' WHERE id='".$uqr['id']."'");
    $con->query("UPDATE cart SET status='Closed' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
    $con->query("UPDATE orders SET status='Paid', paymentmethod='Wallet', deliverystatus='Processing', trackingcode='$trackingcode' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
    if($oqr['recipient'] == 'None'){
    $con->query("UPDATE orders SET recipient='".ucwords($uqr['fname'].' '.$uqr['lname'])."', deliverycontact='".$uqr['phone']."' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
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
    $mail->Subject = "Your order no. ".$orderid." is on its way!";
    $mail->Body = file_get_contents("https://ng.expiringsoon.shop/receipt.php?ref=".$orderid."");
    $mail->send();
    include("vendor-notify.php?v=".$_GET['v']."");
    session_destroy();
    header("Location: invoice.php?ref=".$oqr['orderid']."&done");
}

if(isset($_POST['btn-cash'])) {
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

    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);
    $trackingcode = $response['data']['trackingCode'];

  $query = "SELECT * FROM cart WHERE orderid='$orderid'";
  $proddata = mysqli_query($con,$query);
  while($row = mysqli_fetch_array($proddata)){

  $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$row['productid']."'");
  $pqr = mysqli_fetch_assoc($pqq);
  $newstock = $pqr['stock'] - $row['qty'];

  $con->autocommit(FALSE);
  $con->query("UPDATE products SET stock='$newstock' WHERE id='".$row['productid']."'");
  $con->commit();
  }

  $con->autocommit(FALSE);
  $con->query("UPDATE cart SET status='Closed' WHERE userid='".$uqr['id']."' AND orderid='".$orderid."'");
  $con->query("UPDATE orders SET status='Completed', paymentmethod='Cash', deliverystatus='Processing', trackingcode='$trackingcode' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
  if($oqr['recipient'] == 'None'){
  $con->query("UPDATE orders SET recipient='".ucwords($uqr['fname'].' '.$uqr['lname'])."', deliverycontact='".$uqr['phone']."' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
  }
  $con->commit();

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
  $mail->AddAddress("".$uqr['email']."");
  $mail->Subject = "Your order no. ".$orderid." is on its way!";
  $mail->Body = file_get_contents("https://ng.expiringsoon.shop/receipt.php?ref=".$orderid."");
  $mail->send();
  include("vendor-notify.php?v=".$_GET['v']."");
  session_destroy();
  header("Location: invoice.php?ref=".$oqr['orderid']."&done");
}

$trans_ref = substr(str_shuffle("0123456789"), 0, 10);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shopery.netlify.app/main/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Checkout | Expiring Soon</title>
    <link
      rel="icon"
      type="image/png"
      href="src/images/favicon/favicon-16x16.png"
    />
    <link rel="stylesheet" href="src/lib/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="src/lib/css/bvselect.css" />
    <link rel="stylesheet" href="src/lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/css/style.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

    <!-- Datepicker -->
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
    // Update Order Info
    $(document).ready(function(){
    // $("#editinfo").on("keyup change", function(e) {
    $("form#editinfo").change(function() {
    $("#process").html("Saving...");
    $.post('process.php', $(this).serialize(), function(data) {
    $('#process').html("Shipping Information Updated").css('color', '#00b207');
    $('#shippingFee').html(data);
    window.location = "checkout.php";
    });
    });

  $("input[id='cash']").click(function() {
    $("#btn-wallet").hide();
    $("#balance").hide();
    $("#btn-cash").show();
    $("#btn-card").hide();
  });

  $("input[id='card']").click(function() {
    $("#btn-wallet").hide();
    $("#balance").hide();
    $("#btn-cash").hide();
    $("#btn-card").show();
  });

  $("input[id='wallet']").click(function() {
    $("#btn-wallet").show();
    $("#balance").show();
    $("#btn-cash").hide();
    $("#btn-card").hide();
  });

  // Disable checkout if no address
  var address = $('#address');
  if(address.val() == "" || address.val() == "None"){
    $("#btn-wallet").addClass('button--disable');
    $("#btn-card").addClass('button--disable');
    $("#btn-cash").addClass('button--disable');
    $('#addresscheck').html("Delivery address is required").css('color', '#ff0000');
    $('#shippingFee').html("Provide Delivery address<br /> to calculate shipping cost").css('font-size', '12px');
} else {
    $("#btn-wallet").removeClass('button--disable');
    $("#btn-card").removeClass('button--disable');
    $("#btn-cash").removeClass('button--disable');
    $('#addresscheck').hide();
  }

      $('#address').on('keyup', function(){
      var address = $('#address');
      if(address.val() == ""){
      $('#addresscheck').show();
      $('#addresscheck').html("Delivery address is required").css('color', '#ff0000');
      $('#shippingFee').html("Provide Delivery address<br /> to calculate shipping cost").css('font-size', '12px');
      $("#btn-wallet").addClass('button--disable');
      $("#btn-card").addClass('button--disable');
      $("#btn-cash").addClass('button--disable');
      } else {
        $("#btn-wallet").removeClass('button--disable');
        $("#btn-card").removeClass('button--disable');
        $("#btn-cash").removeClass('button--disable');
        $('#addresscheck').hide();
    }
  });

  // Show New Date Field
  $("input[id='schedule']").click(function() {
  $("#newdate").show();
  // var test = $(this).val();
  // $("#Cars" + test).show();
  });
});

    // Delete item from Cart
    $(function() {
    $(".remove").click(function(){
    //Save the link in a variable called element
    var element = $(this);
    //Find the id of the link that was clicked
    var del_id = element.attr("id1");
    //Built a url to send
    var info = 'id1=' + del_id;
     $.ajax({
       type: "GET",
       url: "process.php",
       data: info,
       success: function(){
         var pp_price = element.attr("data-product-price");
    		 var cart_ttl = element.attr("data-cart-total");
    		 var qty = element.attr("data-qty");
         // $('#cart-ttl').text(parseInt($('#cart-ttl').text().replace(/,/g, '')) - parseInt(pp_price));
    		 $('#cart-ttl').text(parseInt($('#cart-ttl').text().replace(/,/g, '')) - (parseInt(pp_price) * parseInt(qty)));
       }
     });
    $(this).parents(".cartitem").animate({ backgroundColor: "#fff" }, "fast")
    .animate({ opacity: "hide" }, "slow");
    return false;
    });
    });

    $.noConflict();  // Not to conflict with other scripts
    jQuery(document).ready(function($) {
      $("#datepicker").datepicker({
        minDate: +1,
        dateFormat:"yy-mm-dd",
        maxDate: "+0M +10D",

        onSelect: function(date, instance) {
              $.ajax
              ({
                  type: "GET",
                  url: "process.php",
                  data: "date="+date,
                  success: function(data) {
                    $('#process').css({"color": "#000", "font-weight": "400"});
                    $('#process').html(data);
                     // $('#process2').html("Saved...");
                  }
             });
          }
      });
    });
    </script>

    <style>
    #btn-card,
    #newdate,
    #btn-cash {
    display: none;
    }

    .notify{
    margin-top: 0px;
    margin-bottom: 20px;
    text-align: center;
    background-color: #00b207;
    color: #fff;
    padding: 10px;
    width: 100%;
    height: 45px;
    }

    .error{
    margin-top: 0px;
    margin-bottom: 20px;
    text-align: center;
    background-color: #e84a4a;
    color: #fff;
    padding: 10px;
    width: 100%;
    }

    @media screen and (max-width: 480px){
    .notify, .error{
    margin-top: -30px;
    margin-bottom: 20px;
    padding: 10px;
    height: 45px;
    }
    }
    </style>
  </head>

  <body>
    <div class="loader">
      <div class="loader-icon">
        <img src="src/images/loader.gif" alt="loader" />
      </div>
    </div>
    <!-- Header start  -->
    <?php include("header.php"); ?>
    <!-- Header End  -->

    <!-- breedcrumb section start  -->
    <div class="section breedcrumb">
      <div class="breedcrumb__img-wrapper">
        <img src="src/images/banner/breedcrumb.jpg" alt="breedcrumb" />
        <div class="container">
          <ul class="breedcrumb__content">
            <li>
              <a href="index.php">
                <svg
                  width="18"
                  height="19"
                  viewBox="0 0 18 19"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                    stroke="#808080"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <span> > </span>
              </a>
            </li>
            <li class="active">
              <a href="checkout.php">Checkout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- breedcrumb section end   -->

    <?php
    if(isset($_GET['pay']) && $_GET['pay']=='0'){
      echo'
      <div class="error">
      <p style="color:#fff">There was an error processing your payment</p>
      </div>
      ';
    }
    ?>

    <!-- Billing Section Start  -->
    <section class="section billing section--xl pt-0">
      <div class="container">
        <div class="row billing__content">
          <div class="col-lg-8">
            <div class="billing__content-card">
              <div class="billing__content-card-header">
                <h2 class="font-body--xxxl-500">Shipping Information</h2>
              </div>
              <div class="billing__content-card-body">
                <form method="post" id="editinfo">
                  <input type="hidden" name="oid" value="<?php echo $orderid; ?>">
                  <div class="contact-form__content">
                    <div class="contact-form__content-group">
                      <div class="contact-form-input">
                        <label for="fname1">First Name </label>
                        <input
                          type="text"
                          id="fname"
                          name="fname"
                          placeholder="First Name"
                          value="<?php echo $uqr['fname']; ?>"
                        />
                      </div>
                      <div class="contact-form-input">
                        <label for="lname2">Last Name </label>
                        <input
                          type="text"
                          id="lname"
                          name="lname"
                          placeholder="Last Name"
                          value="<?php echo $uqr['lname']; ?>"
                        />
                      </div>
                    </div>

                    <div class="contact-form__content-group">
                      <!-- Country -->
                      <div class="contact-form-input">
                        <label for="country">State</label>
                        <select
                          id="states"
                          class="contact-form-input__dropdown"
                          name="state"
                        >
                        <option value="<?php echo $uqr['state']; ?>" selected><?php echo $uqr['state']; ?></option>
                        <option value="Abuja FCT">Abuja FCT</option>
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross River">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nassarawa">Nassarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
                        </select>
                      </div>
                      <div class="contact-form-input">
                        <label for="phone"> Phone </label>
                        <input
                          type="number"
                          id="phone"
                          placeholder="Phone Number"
                          name="deliverycontact"
                          value="<?php echo $uqr['phone']; ?>"
                          required
                        />
                      </div>
                    </div>

                    <div class="contact-form-input">
                      <label for="address">Street Address </label>
                      <input
                        type="text"
                        id="address"
                        name="deliveryaddress"
                        placeholder="Delivery Address"
                        value="<?php echo $uqr['address']; ?>"
                        required
                      />
                    </div>
                    <div style="font-size:13px;margin-top:-10px;margin-bottom:10px" id="addresscheck"></div>

                    <div class="contact-form-input contact-form-textarea">
                      <label for="note">Order Notes <span>(Optional)</span> </label>
                      <!-- <input type="text" id="fname1" placeholder="Your first name" /> -->
                      <textarea
                        name="comments"
                        id="note"
                        placeholder="Notes about your order, e.g. special notes for delivery"
                      ><?php echo $oqr['comments']; ?></textarea>
                    </div>
                    <div class="contact-form-input">
                      <label for="country">Preferred Delivery Date</label>

                    </div>
                    <div class="bill-card__payment-method-item">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="schedule"
                          id="today"
                          checked
                        />
                        <label
                          class="form-check-label font-body--400"
                          for="amazon"
                        >
                          Today
                        </label>
                      </div>
                    </div>
                    <div class="bill-card__payment-method-item">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="schedule"
                          id="schedule"
                        />
                        <label
                          class="form-check-label font-body--400"
                          for="amazon"
                        >
                          Choose Date
                        </label>
                      </div>
                    </div>
                    <div class="contact-form-input" id="newdate">
                      <label for="address">Pick a Delivery Date</label>
                      <input
                        type="text"
                        id="datepicker"
                        name="schedule"
                        placeholder="Click to Select"
                      />
                    </div>
                    <div style="font-size:13px;font-weight:500" id="process">
                        Edit Info to Ship to Different Recipient/Address
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="billing__content-card">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bill-card">
              <div class="bill-card__content">
                <div class="bill-card__header">
                  <h2 class="bill-card__header-title font-body--xxl-500">
                    Order Summary
                  </h2>
                </div>
                <div class="bill-card__body">
                  <!-- Product Info -->
                  <div class="bill-card__product">
                    <?php
                    $query = "SELECT * FROM cart WHERE userid='".$uqr['id']."' AND orderid='".$_SESSION['orderid']."' AND status='Open' ORDER BY date DESC";
                    $qq = mysqli_query($con, $query);
                    while ($value = mysqli_fetch_array($qq)){

                    $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$value['productid']."'");
                    $pqr = mysqli_fetch_assoc($pqq);
                    ?>
                    <div class="bill-card__product-item">
                      <div class="bill-card__product-item-content">
                        <div class="img-wrapper">
                          <img
                            src="<?php echo $pqr['photo']; ?>"
                            alt="<?php echo $pqr['product']; ?>"
                          />
                        </div>
                        <h5 class="font-body--md-400">
                          <?php echo $pqr['product']; ?> <span class="quantity"> <span style="font-weight:500">x <?php echo $value['qty']; ?></span></span>
                        </h5>
                      </div>

                      <p class="bill-card__product-price font-body--md-500">
                        N<?php echo number_format($value['total'], 0); ?>
                      </p>
                    </div>
                  <?php } ?>
                  </div>
                  <!-- memo  -->
                  <div class="bill-card__memo">
                    <!-- Subtotal  -->
                    <div class="bill-card__memo-item subtotal">
                      <p class="font-body--md-400">Subtotal:</p>
                      <span class="font-body--md-500">N<?php echo number_format($orderttl, 2); ?></span>
                    </div>
                    <!-- Shipping  -->
                    <div class="bill-card__memo-item shipping">
                      <p class="font-body--md-400">Shipping Fee:</p>
                      <?php if($uqr['address']=='None' || $uqr['state']=='None'){ ?>
                      <span class="font-body--md-500" style="font-size:12px" id="shippingFee">Provide Delivery address<br /> to calculate shipping cost</span>
                    <?php } else { ?>
                      <span class="font-body--md-500" id="shippingFee">N<?php echo number_format($deliveryfee, 2); ?></span>
                    <?php } ?>
                    </div>
                    <!-- VAT  -->
                    <div class="bill-card__memo-item shipping">
                      <p class="font-body--md-400">VAT <?php echo $stqr['vat']; ?>%:</p>
                      <span class="font-body--md-500">N<?php echo number_format($chk_vat, 2); ?></span>
                    </div>
                    <!-- total  -->
                    <div class="bill-card__memo-item total">
                      <p class="font-body--lg-400">Total:</p>
                      <span class="font-body--xl-500">N<?php echo number_format($finalttl, 2); ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bill-card__content">
                <div class="bill-card__header">
                  <div class="bill-card__header">
                    <h2 class="bill-card__header-title font-body--xxl-500">
                      Payment Method
                    </h2>
                  </div>
                </div>
                <div class="bill-card__body">
                  <form method="post">
                    <input type="hidden" name="placeorder" value="1">
                    <!-- Payment Methods  -->
                    <div class="bill-card__payment-method">
                      <div class="bill-card__payment-method-item">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="payment"
                            id="wallet"
                            checked
                          />
                          <label
                            class="form-check-label font-body--400"
                            for="cash"
                          >
                            Instantly from Wallet
                          </label>
                        </div>
                      </div>

                      <div class="bill-card__payment-method-item">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="payment"
                            id="card"
                          />
                          <label
                            class="form-check-label font-body--400"
                            for="amazon"
                          >
                            Pay with Debit/Credit Card
                          </label>
                        </div>
                      </div>

                      <div class="bill-card__payment-method-item">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="payment"
                            id="cash"
                          />
                          <label
                            class="form-check-label font-body--400"
                            for="amazon"
                          >
                            Cash on Delivery
                          </label>
                        </div>
                      </div>

                    </div>
                    <?php if($orderttl < $uqr['wallet']){ ?>
                    <div id="balance" style="margin-bottom:10px;font-size:12px">Wallet Balance<br /><span style="font-size:18px;color:#000;font-weight:450">N<?php echo number_format($uqr['wallet'], 2); ?></div>
                    <button class="button button--lg w-100" name="btn-wallet" id="btn-wallet" type="submit">
                      Pay with Balance
                    </button>
                  <?php } else{ ?>
                    <div id="balance" style="margin-bottom:10px;font-size:12px"><span style="color:#000;font-weight:500">Insufficient Balance</span><br /><a href="settings.php" style="color:#00b207">Top Up</a> to complete your order.<br />Or select a different payment method.<br /><span style="font-size:18px;color:#000;font-weight:450">N<?php echo number_format($uqr['wallet'], 2); ?></div>
                    <button type="button" class="button button--lg w-100" name="btn-wallet" id="btn-wallet" onclick="location.href='settings.php';">
                      Top Up Wallet
                    </button>
                    <?php } ?>
                    <form>
                      <script src="https://checkout.flutterwave.com/v3.js"></script>
                      <button type="button" class="button button--lg w-100" name="btn-card" id="btn-card" onClick="makePayment()">
                      Pay Securely Now
                    </button>
                  </form>

                  <script>
                  function makePayment() {
                    var ttlAmount = <?php echo $finalttl; ?>;
                    var addUrl = "/paid-v.php?v=<?php echo $_GET['v']; ?>&amount=";
                  FlutterwaveCheckout({
                    public_key: "FLWPUBK-153da6a84c95d9bcd40136d3390d0203-X",
                    tx_ref: <?php echo $trans_ref; ?>,
                    amount: <?php echo $finalttl; ?>,
                    currency: "NGN",
                    country: "NG",
                    payment_options: " ",
                    redirect_url: addUrl + ttlAmount,
                    meta: {
                      consumer_id: <?php echo $uqr['id']; ?>,
                      consumer_mac: "92a3-912ba-1192a",
                    },
                    customer: {
                      email: "<?php echo $uqr['email']; ?>",
                      phone_number: "<?php echo $uqr['phone']; ?>",
                      name: "<?php echo $uqr['fname']; ?> <?php echo $uqr['lname']; ?>",
                    },
                    callback: function (data) {
                      console.log(data);
                    },
                    onclose: function() {
                      // close modal
                    },
                    customizations: {
                    title: "Expiring Soon",
                    description: "Payment for Order #<?php echo $orderid; ?>",
                    logo: "https://expiringsoon.shop/src/images/favicon/favicon-16x16.png",
                    },
                  });
                }
              </script>

                    <form>
                    <button class="button button--lg w-100" name="btn-cash" id="btn-cash" type="submit">
                    Pay Cash on Delivery
                  </button>
                  </form>

                  <button style="margin-top:10px" class="button button--lg w-100" onclick="window.location.href='cart.php'">Return to Cart</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Billing Section  End  -->

    <!-- Footer Start -->
    <?php include("footer.php"); ?>
    <!-- Footer Area End -->

    <script src="src/lib/js/jquery.min.js"></script>
    <script src="src/lib/js/swiper-bundle.min.js"></script>
    <script src="src/lib/js/bvselect.js"></script>
    <script src="src/lib/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/main.js"></script>
    <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61f6f04e9bd1f31184da1815/1fqm9ldm5';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
  </body>

<!-- Mirrored from shopery.netlify.app/main/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
</html>
