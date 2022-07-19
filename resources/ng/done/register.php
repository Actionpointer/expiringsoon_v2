<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if (isset($_POST['btn-register'])){
$username = strtolower($_POST['username']);
$email_string = strtolower($_POST['email']);
$user_email = preg_replace('/\s+/', '', $email_string);
if (!filter_var($email_string, FILTER_VALIDATE_EMAIL)) {
header("Location: register.php?email");
exit();
}

/* if (preg_match("/[^A-Za-z0-9]/", $_POST['password'])) {
header("Location: register.php?password");
exit();
} */

$check = "SELECT * FROM users WHERE email='$user_email'";
if ($result=mysqli_query($con,$check)){
if (mysqli_num_rows($result) == 1){
header("Location: register.php?exists");
exit();
}
}

$check1 = "SELECT * FROM users WHERE phone='".$_POST['phone']."'";
if ($result=mysqli_query($con,$check1)){
if (mysqli_num_rows($result) == 1){
header("Location: register.php?phone");
exit();
}
}

$check2 = "SELECT * FROM users WHERE username='$username'";
if ($result=mysqli_query($con,$check1)){
if (mysqli_num_rows($result) == 1){
header("Location: register.php?user");
exit();
}
}

$vcode = md5(uniqid(rand(), true));
$hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
// $vcode = substr(str_shuffle("0123456789"), 0, 8);
$sql = "INSERT INTO users (username, fname, lname, email, password, phone, address, state, country, pic, banner, wallet, commission, status, usertype, registered) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$conn->prepare($sql)->execute([$username, ucwords($_POST['fname']), ucwords($_POST['lname']), $user_email, $hash, $_POST['phone'], 'None', 'None', $_POST['country'], 'img/avatar.png', 'assets/images/banner/8.jpg', '0', '90', 'Unverified', $_POST['usertype'], $now]);

$user = "SELECT * FROM users WHERE email='$user_email'";
$result = mysqli_query($con,$user);
$user = mysqli_fetch_assoc($result);
$_SESSION['user'] = $user_email;
$sql = "INSERT INTO verify (userid, token, registered) VALUES (?,?,?)";
$conn->prepare($sql)->execute([$user['id'], $vcode, $now]);

$members = "SELECT * FROM users WHERE email='$user_email'";
$result = mysqli_query($con,$members);
if (mysqli_num_rows($result) == 0) {
header("Location: register.php");
exit();
}
else{
$mqr = mysqli_fetch_assoc($result);

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
$mail->AddAddress("".$mqr['email']."");
$mail->Subject = "Please Verify Your Email Address";
$mail->Body = file_get_contents("https://ng.expiringsoon.shop/confirm.php?uid=".$mqr['id']."");
$mail->send();
header("Location: register-2.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shopery.netlify.app/main/create-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Create Account | Expiring Soon</title>
    <link
      rel="icon"
      type="image/png"
      href="src/images/favicon/favicon-16x16.png"
    />
    <link
      rel="icon"
      type="image/png"
      href="src/images/favicon/favicon-16x16.png"
    />
    <link rel="stylesheet" href="src/lib/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="src/lib/css/bvselect.css" />
    <link rel="stylesheet" href="src/lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/css/style.css" />

    <!-- Phone input -->
    <link rel="stylesheet" href="int-tel/build/css/intlTelInput.css">
    <link rel="stylesheet" href="int-tel/build/css/demo.css">
    <script src="int-tel/build/js/intlTelInput.js"></script>

    <style>
    .notify{
    margin-top: 0px;
    text-align: center;
    background-color: #1cc88a;
    color: #fff;
    padding: 10px;
    width: 100%;
    height: 40px;
    font-size: 14px;
    }

    .error{
    margin-top: 0px;
    text-align: center;
    background-color: #e84a4a;
    color: #fff;
    padding: 10px;
    width: 100%;
    height: 40px;
    font-size: 14px;
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    // Accept Terms
    $(document).ready(function(){
      // Phone select
    $("select[name=ext]").change(function() {
    var ext = '+' + $("#ext :selected").attr('value')
    $('input#phone').val(ext);
    $('input#selCountry').val($("#ext :selected").attr('data-countryCode'));
    // alert($("#country1 :selected").attr('value'))
    });

    $(".form-check-input").click(function() {
    $(".btn-register").toggleClass('button--disable');
    });

    // Validate email
    $("#email").change(function(){
    var email = document.getElementById('email').value;
    $.post("process.php",{email:email}, function(data){
    $('#emailcheck').html(data).css('color', '#ff0000');
    });
    });

    // Validate phone
    $("#phone").change(function(){
    var phone = document.getElementById('phone').value;
    $.post("process.php",{phone:phone}, function(data){
    $('#phonecheck').html(data).css('color', '#ff0000');
    });
    });

    // Validate username
    $("#username").change(function(){
    var username = document.getElementById('username').value;
    $.post("process.php",{username:username}, function(data){
    $('#usercheck').html(data);
    });
    });

    // Disable space in input
    $("input#username").on({
    keydown: function(e) {
    if (e.which === 32)
    return false;
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    }
    });

    $("input#email").on({
    keydown: function(e) {
    if (e.which === 32)
    return false;
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    }
    });
    });

    // Password check
    function passwordsMatch(){
    return $('#password').val() == $('#confirmPassword').val();
    }

    $(document).ready(function () {
    $("#confirmPassword").on("keyup change", function(e) {
    // $("#confirmPassword").change(function(){
        if(!passwordsMatch()){
          $('#passmatch').show();
          $("#passmatch").html("Passwords do not match").css('color', 'red');
        } else {
          $("#passmatch").html("").css('color', 'green');
          $("#passmatch").hide();
        }
    });

    $('#register').submit(function(evt) {
       if(!passwordsMatch()){
            evt.preventDefault();
        }
    });
    });

    // Numbers only
    function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
    </script>
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
              <a href="register.php">Create Account</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- breedcrumb section end   -->

    <?php
    if(isset($_GET['user'])){
    echo '<div class="error"><p style="color:#fff">That username is taken</p></div>';
    }
    if(isset($_GET['email'])){
    echo '<div class="error"><p style="color:#fff">Wrong email format</p></div>';
    }
    if(isset($_GET['password'])){
    echo '<div class="error"><p style="color:#fff">Invalid password format</p></div>';
    }
    if(isset($_GET['exists'])){
    echo '<div class="error"><p style="color:#fff">That email is already registered</p></div>';
    }
    if(isset($_GET['phone'])){
    echo '<div class="error"><p style="color:#fff">That phone number is already registered</p></div>';
    }
    ?>

    <!-- create account-in Section Start  -->
    <section class="create-account section section--xl">
      <div class="container">
        <div class="form-wrapper">
          <h6 class="font-title--sm" style="font-size:16px">create account</h6>
          <form method="post" id="register">
            <div class="form-input">
              <input type="text" name="username" id="username" placeholder="Choose username" required />
            </div>
            <div style="font-size:12px;margin-top:-5px;margin-bottom:10px">https://expiringsoon.com/<span id="usercheck"></span></div>
          <div class="form-input">
            <input type="text" name="fname" placeholder="First Name" required />
          </div>
          <div class="form-input">
            <input type="text" name="lname" placeholder="Last Name" required />
          </div>
          <div class="contact-form-input">
            <input type="hidden" name="country" id="selCountry" value="NG" required />
            <select
              id="ext"
              name="ext"
              class="contact-form-input__dropdown droplist"
              required
            >
              <option value="" selected>Select Country</option>
              <option data-countryCode="DZ" value="213">Algeria (+213)</option>
              <option data-countryCode="AD" value="376">Andorra (+376)</option>
              <option data-countryCode="AO" value="244">Angola (+244)</option>
              <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
              <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
              <option data-countryCode="AR" value="54">Argentina (+54)</option>
              <option data-countryCode="AM" value="374">Armenia (+374)</option>
              <option data-countryCode="AW" value="297">Aruba (+297)</option>
              <option data-countryCode="AU" value="61">Australia (+61)</option>
              <option data-countryCode="AT" value="43">Austria (+43)</option>
              <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
              <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
              <option data-countryCode="BH" value="973">Bahrain (+973)</option>
              <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
              <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
              <option data-countryCode="BY" value="375">Belarus (+375)</option>
              <option data-countryCode="BE" value="32">Belgium (+32)</option>
              <option data-countryCode="BZ" value="501">Belize (+501)</option>
              <option data-countryCode="BJ" value="229">Benin (+229)</option>
              <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
              <option data-countryCode="BT" value="975">Bhutan (+975)</option>
              <option data-countryCode="BO" value="591">Bolivia (+591)</option>
              <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
              <option data-countryCode="BW" value="267">Botswana (+267)</option>
              <option data-countryCode="BR" value="55">Brazil (+55)</option>
              <option data-countryCode="BN" value="673">Brunei (+673)</option>
              <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
              <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
              <option data-countryCode="BI" value="257">Burundi (+257)</option>
              <option data-countryCode="KH" value="855">Cambodia (+855)</option>
              <option data-countryCode="CM" value="237">Cameroon (+237)</option>
              <option data-countryCode="CA" value="1">Canada (+1)</option>
              <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
              <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
              <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
              <option data-countryCode="CL" value="56">Chile (+56)</option>
              <option data-countryCode="CN" value="86">China (+86)</option>
              <option data-countryCode="CO" value="57">Colombia (+57)</option>
              <option data-countryCode="KM" value="269">Comoros (+269)</option>
              <option data-countryCode="CG" value="242">Congo (+242)</option>
              <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
              <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
              <option data-countryCode="HR" value="385">Croatia (+385)</option>
              <!-- <option data-countryCode="CU" value="53">Cuba (+53)</option> -->
              <option data-countryCode="CY" value="90">Cyprus - North (+90)</option>
              <option data-countryCode="CY" value="357">Cyprus - South (+357)</option>
              <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
              <option data-countryCode="DK" value="45">Denmark (+45)</option>
              <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
              <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
              <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
              <option data-countryCode="EC" value="593">Ecuador (+593)</option>
              <option data-countryCode="EG" value="20">Egypt (+20)</option>
              <option data-countryCode="SV" value="503">El Salvador (+503)</option>
              <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
              <option data-countryCode="ER" value="291">Eritrea (+291)</option>
              <option data-countryCode="EE" value="372">Estonia (+372)</option>
              <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
              <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
              <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
              <option data-countryCode="FJ" value="679">Fiji (+679)</option>
              <option data-countryCode="FI" value="358">Finland (+358)</option>
              <option data-countryCode="FR" value="33">France (+33)</option>
              <option data-countryCode="GF" value="594">French Guiana (+594)</option>
              <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
              <option data-countryCode="GA" value="241">Gabon (+241)</option>
              <option data-countryCode="GM" value="220">Gambia (+220)</option>
              <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
              <option data-countryCode="DE" value="49">Germany (+49)</option>
              <option data-countryCode="GH" value="233">Ghana (+233)</option>
              <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
              <option data-countryCode="GR" value="30">Greece (+30)</option>
              <option data-countryCode="GL" value="299">Greenland (+299)</option>
              <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
              <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
              <option data-countryCode="GU" value="671">Guam (+671)</option>
              <option data-countryCode="GT" value="502">Guatemala (+502)</option>
              <option data-countryCode="GN" value="224">Guinea (+224)</option>
              <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
              <option data-countryCode="GY" value="592">Guyana (+592)</option>
              <option data-countryCode="HT" value="509">Haiti (+509)</option>
              <option data-countryCode="HN" value="504">Honduras (+504)</option>
              <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
              <option data-countryCode="HU" value="36">Hungary (+36)</option>
              <option data-countryCode="IS" value="354">Iceland (+354)</option>
              <option data-countryCode="IN" value="91">India (+91)</option>
              <option data-countryCode="ID" value="62">Indonesia (+62)</option>
              <option data-countryCode="IQ" value="964">Iraq (+964)</option>
              <!-- <option data-countryCode="IR" value="98">Iran (+98)</option> -->
              <option data-countryCode="IE" value="353">Ireland (+353)</option>
              <option data-countryCode="IL" value="972">Israel (+972)</option>
              <option data-countryCode="IT" value="39">Italy (+39)</option>
              <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
              <option data-countryCode="JP" value="81">Japan (+81)</option>
              <option data-countryCode="JO" value="962">Jordan (+962)</option>
              <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
              <option data-countryCode="KE" value="254">Kenya (+254)</option>
              <option data-countryCode="KI" value="686">Kiribati (+686)</option>
              <!-- <option data-countryCode="KP" value="850">Korea - North (+850)</option> -->
              <option data-countryCode="KR" value="82">Korea - South (+82)</option>
              <option data-countryCode="KW" value="965">Kuwait (+965)</option>
              <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
              <option data-countryCode="LA" value="856">Laos (+856)</option>
              <option data-countryCode="LV" value="371">Latvia (+371)</option>
              <option data-countryCode="LB" value="961">Lebanon (+961)</option>
              <option data-countryCode="LS" value="266">Lesotho (+266)</option>
              <option data-countryCode="LR" value="231">Liberia (+231)</option>
              <option data-countryCode="LY" value="218">Libya (+218)</option>
              <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
              <option data-countryCode="LT" value="370">Lithuania (+370)</option>
              <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
              <option data-countryCode="MO" value="853">Macao (+853)</option>
              <option data-countryCode="MK" value="389">Macedonia (+389)</option>
              <option data-countryCode="MG" value="261">Madagascar (+261)</option>
              <option data-countryCode="MW" value="265">Malawi (+265)</option>
              <option data-countryCode="MY" value="60">Malaysia (+60)</option>
              <option data-countryCode="MV" value="960">Maldives (+960)</option>
              <option data-countryCode="ML" value="223">Mali (+223)</option>
              <option data-countryCode="MT" value="356">Malta (+356)</option>
              <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
              <option data-countryCode="MQ" value="596">Martinique (+596)</option>
              <option data-countryCode="MR" value="222">Mauritania (+222)</option>
              <option data-countryCode="YT" value="269">Mayotte (+269)</option>
              <option data-countryCode="MX" value="52">Mexico (+52)</option>
              <option data-countryCode="FM" value="691">Micronesia (+691)</option>
              <option data-countryCode="MD" value="373">Moldova (+373)</option>
              <option data-countryCode="MC" value="377">Monaco (+377)</option>
              <option data-countryCode="MN" value="976">Mongolia (+976)</option>
              <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
              <option data-countryCode="MA" value="212">Morocco (+212)</option>
              <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
              <option data-countryCode="MN" value="95">Myanmar (+95)</option>
              <option data-countryCode="NA" value="264">Namibia (+264)</option>
              <option data-countryCode="NR" value="674">Nauru (+674)</option>
              <option data-countryCode="NP" value="977">Nepal (+977)</option>
              <option data-countryCode="NL" value="31">Netherlands (+31)</option>
              <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
              <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
              <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
              <option data-countryCode="NE" value="227">Niger (+227)</option>
              <option data-countryCode="NG" value="234">Nigeria (+234)</option>
              <option data-countryCode="NU" value="683">Niue (+683)</option>
              <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
              <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
              <option data-countryCode="NO" value="47">Norway (+47)</option>
              <option data-countryCode="OM" value="968">Oman (+968)</option>
              <option data-countryCode="PK" value="92">Pakistan (+92)</option>
              <option data-countryCode="PW" value="680">Palau (+680)</option>
              <option data-countryCode="PA" value="507">Panama (+507)</option>
              <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
              <option data-countryCode="PY" value="595">Paraguay (+595)</option>
              <option data-countryCode="PE" value="51">Peru (+51)</option>
              <option data-countryCode="PH" value="63">Philippines (+63)</option>
              <option data-countryCode="PL" value="48">Poland (+48)</option>
              <option data-countryCode="PT" value="351">Portugal (+351)</option>
              <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
              <option data-countryCode="QA" value="974">Qatar (+974)</option>
              <option data-countryCode="RE" value="262">Reunion (+262)</option>
              <option data-countryCode="RO" value="40">Romania (+40)</option>
              <option data-countryCode="RU" value="7">Russia (+7)</option>
              <option data-countryCode="RW" value="250">Rwanda (+250)</option>
              <option data-countryCode="SM" value="378">San Marino (+378)</option>
              <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
              <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
              <option data-countryCode="SN" value="221">Senegal (+221)</option>
              <option data-countryCode="CS" value="381">Serbia (+381)</option>
              <option data-countryCode="SC" value="248">Seychelles (+248)</option>
              <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
              <option data-countryCode="SG" value="65">Singapore (+65)</option>
              <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
              <option data-countryCode="SI" value="386">Slovenia (+386)</option>
              <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
              <option data-countryCode="SO" value="252">Somalia (+252)</option>
              <option data-countryCode="ZA" value="27">South Africa (+27)</option>
              <option data-countryCode="ES" value="34">Spain (+34)</option>
              <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
              <option data-countryCode="SH" value="290">St. Helena (+290)</option>
              <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
              <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
              <option data-countryCode="SR" value="597">Suriname (+597)</option>
              <option data-countryCode="SD" value="249">Sudan (+249)</option>
              <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
              <option data-countryCode="SE" value="46">Sweden (+46)</option>
              <option data-countryCode="CH" value="41">Switzerland (+41)</option>
              <!-- <option data-countryCode="SY" value="963">Syria (+963)</option> -->
              <option data-countryCode="TW" value="886">Taiwan (+886)</option>
              <option data-countryCode="TJ" value="992">Tajikistan (+992)</option>
              <option data-countryCode="TH" value="66">Thailand (+66)</option>
              <option data-countryCode="TG" value="228">Togo (+228)</option>
              <option data-countryCode="TO" value="676">Tonga (+676)</option>
              <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
              <option data-countryCode="TN" value="216">Tunisia (+216)</option>
              <option data-countryCode="TR" value="90">Turkey (+90)</option>
              <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
              <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
              <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
              <option data-countryCode="UG" value="256">Uganda (+256)</option>
              <option data-countryCode="UA" value="380">Ukraine (+380)</option>
              <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
              <option data-countryCode="UY" value="598">Uruguay (+598)</option>
              <option data-countryCode="GB" value="44">United Kingdom (+44)</option>
              <option data-countryCode="US" value="1">USA (+1)</option>
              <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option>
              <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
              <option data-countryCode="VA" value="379">Vatican City (+379)</option>
              <option data-countryCode="VE" value="58">Venezuela (+58)</option>
              <option data-countryCode="VN" value="84">Vietnam (+84)</option>
              <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option>
              <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option>
              <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
              <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
              <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
              <option data-countryCode="ZM" value="260">Zambia (+260)</option>
              <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
            </select>
          </div>

          <div class="form-input">
            <input type="tel" name="phone" id="phone" onkeypress="validate(event)" placeholder="Phone" required />
          </div>
          <div id="phonecheck" style="font-size:12px;margin-top:-5px;margin-bottom:10px"></div>
            <div class="form-input">
              <input type="email" name="email" id="email" placeholder="Email Address" required />
            </div>
            <div id="emailcheck" style="font-size:12px;margin-top:-5px;margin-bottom:10px"></div>
            <div class="form-input">
              <input type="password" name="password" placeholder="Password" id="password" required />
              <button
                type="button"
                class="icon icon-eye"
                onclick="showPassword('password',this)"
              >
                <svg
                  width="20"
                  height="21"
                  viewBox="0 0 20 21"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </button>
              <span class="icon icon-warning">
                <svg
                  width="20"
                  height="21"
                  viewBox="0 0 20 21"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10.0003 18.8333C14.6027 18.8333 18.3337 15.1024 18.3337 10.5C18.3337 5.89762 14.6027 2.16666 10.0003 2.16666C5.39795 2.16666 1.66699 5.89762 1.66699 10.5C1.66699 15.1024 5.39795 18.8333 10.0003 18.8333Z"
                    stroke="#FF8A00"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 7.16666V10.5"
                    stroke="#FF8A00"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 13.8333H10.0083"
                    stroke="#FF8A00"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </span>
              <span class="icon icon-error">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M8.57465 3.21667L1.51632 15C1.37079 15.252 1.29379 15.5378 1.29298 15.8288C1.29216 16.1198 1.36756 16.4059 1.51167 16.6588C1.65579 16.9116 1.86359 17.1223 2.11441 17.2699C2.36523 17.4175 2.65032 17.4968 2.94132 17.5H17.058C17.349 17.4968 17.6341 17.4175 17.8849 17.2699C18.1357 17.1223 18.3435 16.9116 18.4876 16.6588C18.6317 16.4059 18.7071 16.1198 18.7063 15.8288C18.7055 15.5378 18.6285 15.252 18.483 15L11.4247 3.21667C11.2761 2.97176 11.0669 2.76927 10.8173 2.62874C10.5677 2.48821 10.2861 2.41438 9.99965 2.41438C9.71321 2.41438 9.43159 2.48821 9.18199 2.62874C8.93238 2.76927 8.72321 2.97176 8.57465 3.21667V3.21667Z"
                    stroke="#EA4B48"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 7.5V10.8333"
                    stroke="#EA4B48"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 14.1667H10.0083"
                    stroke="#EA4B48"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </span>
              <span class="icon icon-success">
                <svg
                  width="20"
                  height="21"
                  viewBox="0 0 20 21"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M16.6663 5.5L7.49967 14.6667L3.33301 10.5"
                    stroke="#00B307"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </span>
            </div>
            <div class="form-input">
              <input
                type="password"
                name="password2"
                placeholder="Confirm Password"
                id="confirmPassword"
                required
              />
              <button
                type="button"
                class="icon icon-eye"
                onclick="showPassword('confirmPassword',this)"
              >
                <svg
                  width="20"
                  height="21"
                  viewBox="0 0 20 21"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </button>
              <span class="icon icon-warning">
                <svg
                  width="20"
                  height="21"
                  viewBox="0 0 20 21"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10.0003 18.8333C14.6027 18.8333 18.3337 15.1024 18.3337 10.5C18.3337 5.89762 14.6027 2.16666 10.0003 2.16666C5.39795 2.16666 1.66699 5.89762 1.66699 10.5C1.66699 15.1024 5.39795 18.8333 10.0003 18.8333Z"
                    stroke="#FF8A00"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 7.16666V10.5"
                    stroke="#FF8A00"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 13.8333H10.0083"
                    stroke="#FF8A00"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </span>
              <span class="icon icon-error">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M8.57465 3.21667L1.51632 15C1.37079 15.252 1.29379 15.5378 1.29298 15.8288C1.29216 16.1198 1.36756 16.4059 1.51167 16.6588C1.65579 16.9116 1.86359 17.1223 2.11441 17.2699C2.36523 17.4175 2.65032 17.4968 2.94132 17.5H17.058C17.349 17.4968 17.6341 17.4175 17.8849 17.2699C18.1357 17.1223 18.3435 16.9116 18.4876 16.6588C18.6317 16.4059 18.7071 16.1198 18.7063 15.8288C18.7055 15.5378 18.6285 15.252 18.483 15L11.4247 3.21667C11.2761 2.97176 11.0669 2.76927 10.8173 2.62874C10.5677 2.48821 10.2861 2.41438 9.99965 2.41438C9.71321 2.41438 9.43159 2.48821 9.18199 2.62874C8.93238 2.76927 8.72321 2.97176 8.57465 3.21667V3.21667Z"
                    stroke="#EA4B48"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 7.5V10.8333"
                    stroke="#EA4B48"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M10 14.1667H10.0083"
                    stroke="#EA4B48"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </span>
              <span class="icon icon-success">
                <svg
                  width="20"
                  height="21"
                  viewBox="0 0 20 21"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M16.6663 5.5L7.49967 14.6667L3.33301 10.5"
                    stroke="#00B307"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </span>
            </div>
            <div id="passmatch" style="font-size:12px;margin-bottom:10px"></div>
            <div class="contact-form-input">
              <label for="states">Account Type</label>
              <select
                id="states"
                name="usertype"
                class="contact-form-input__dropdown"
              >
              <option value="Shopper" selected>Shopper</option>
              <option value="Vendor">Vendor</option>
              </select>
            </div>
            <div class="form-wrapper__content">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="remember"
                />
                <label class="form-check-label" for="remember">
                  Accept all terms & Conditions
                </label>
              </div>
            </div>
            <div class="form-button">
              <button type="submit" name="btn-register" class="button button--md w-100 btn-register button--disable">Create Account</button>
            </div>
            <div class="form-register">
              Already have an account? <a href="login.php">Login</a>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- create account-in Section end  -->

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

<!-- Mirrored from shopery.netlify.app/main/create-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
</html>
