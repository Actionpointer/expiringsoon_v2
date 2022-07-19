<?php
include("dbconnect.php");
session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}

if(!isset($_GET['uid'])){
header("Location: index.php");
}

if (isset($_POST['newPassword'])) {
$hash = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
$con->autocommit(FALSE);
$con->query("UPDATE users SET password='$hash' WHERE id='".$_POST['uid']."'");
$con->commit();

$user = mysqli_query($con, "SELECT * FROM users WHERE id='".$_POST['uid']."'");
$mqr = mysqli_fetch_assoc($user);

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
// $mail->AddCC("no-reply@blazingflix.com");
$mail->Subject = "Your password changed";
$mail->Body = file_get_contents("https://expiring.soon/password-notify.php?uid=".$mqr['id']."");
$mail->send();
header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shopery.netlify.app/main/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reset Password | Expiring Soon</title>
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
    <script type="text/javascript" src="src/js/ajaxupload.js"></script>
    <script>
  // Password check
  function passwordsMatch(){
  return $('#newPassword').val() == $('#confirmPassword').val();
  }

  $(document).ready(function() {
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
            <li class="active"><a href="#">Reset Password</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- breedcrumb section end   -->

    <?php
    if(isset($_GET['error']) && $_GET['error']=='1'){
    echo '<div class="error"><p style="color:#fff">We couldn\'t find that email address</p></div>';
    }
    if(isset($_GET['sent'])){
    echo '<div class="notify"><p style="color:#fff">Please check email for reset link</p></div>';
    }
    ?>

    <!-- Sign-in Section Start  -->
    <section class="sign-in section section--xl">
      <div class="container">
        <div class="form-wrapper">
          <h6 class="font-title--sm" style="font-size:16px">Enter New Password</h6>
          <form method="post">
            <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
            <div class="form-input">
              <input type="password" name="newPassword" id="newPassword" placeholder="Type Password" />
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
              <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Re-Type Password" />
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
            <div id="passmatch" style="font-size:13px;font-weight:450"></div>
            <div class="form-button">
              <button type="submit" class="button button--md w-100">Save</button>
            </div>
            <div class="form-register">
              Don't have account? <a href="register.php">Register</a>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- Sign-in Section end  -->

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

<!-- Mirrored from shopery.netlify.app/main/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
</html>
