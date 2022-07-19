<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
phpinfo();
exit;

include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}
if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
$user = $_SESSION['user'];
}
else{
$user = 'bruno.otas@gmail.com';
}

$user = mysqli_query($con, "SELECT * FROM users WHERE email='$user'");
$uqr = mysqli_fetch_assoc($user);
$rand = ''.$uqr['id'].''.substr(str_shuffle("0123456789"), 0, 4).'';
$con->autocommit(FALSE);
$con->query("UPDATE users set userid='$rand' WHERE id='".$uqr['id']."'");
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
$mail->Subject = "Please Verify Your Email Address";
$mail->Body = file_get_contents("https://ng.expiringsoon.shop/confirm.php?uid=".$uqr['id']."");
$mail->send();
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

    <style>
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

    .verify {
    width: 70%;
    margin: auto;
    margin-top: -30px;
    text-align: center;
    }

    .verify img{
    width: 70%;
    margin: auto;
    padding: 10px;
    }

    @media screen and (max-width: 480px){
    .notify, .error{
    margin-top: -30px;
    margin-bottom: 20px;
    padding: 10px;
    height: 45px;
    }

    .verify {
    width: 100%;
    margin: auto;
    padding: 10px;
    }

    .verify img{
    width: 100%;
    margin: auto;
    padding: 10px;
    }
    }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    // Accept Terms
    $(document).ready(function(){
    $(".form-check-input").click(function() {
    $(".btn-register").toggleClass('button--disable');
    });
    });
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
    if(empty($_GET)){
    echo'<div class="notify"><p style="color:#fff">Hi, '.$uqr['fname'].'... You\'re almost there!</p></div>';
    }
    if(isset($_GET['sent'])){
    echo'<div class="notify"><p style="color:#fff">Verification link sent</p></div>';
    }
    if(isset($_GET['token'])){
    echo'<div class="error"><p style="color:#fff">Token is invalid or expired</p></div>';
    }
    ?>

    <!-- create account-in Section Start  -->
    <section class="create-account section section--xl">
      <div class="container">
        <div class="verify">
          <h6 class="font-title--sm" style="font-size:16px">You're Almost There!</h6>
          <img src="img/img-verify.jpg">
          <p class="sub-title mb-3" style="font-weight:400">We've sent an email to <span style="color:#00b207"><?php echo $uqr['email']; ?></span> with a link to verify your email and complete your registration. The link will expire after 24 hours.</p>
          <p class="sub-title mb-3" style="font-weight:400"><a href="re-verify.php" style="color:#00b207">Click here</a> if you did not receive an email and we'll re-send it.</p>
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