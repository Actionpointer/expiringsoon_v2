<?php
include("dbconnect.php");
/*$a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
$countrycode= $a['geoplugin_countryCode'];
if ($countrycode=='NG'){
header('Location: https://ng.expiringsoon.shop');
}*/

if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];

$sum = "SELECT count(id) as ttcart FROM cart WHERE orderid='".$orderid."' AND status='Open'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$ttl_cart = $row['ttcart'];
}

$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='".$orderid."' AND status='Open'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
$vat = (5 / 100) * $orderttl;
}
}
else{
$vat = '0';
$orderttl = '0';
$ttl_cart = '0';
}
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Spend Less. Save More | Expiring Soon</title>
        <link rel="icon" type="image/png" href="src/images/favicon/favicon-16x16.png" />
        <link rel="stylesheet" href="src/lib/css/swiper-bundle.min.css" />
        <link rel="stylesheet" href="src/lib/css/bvselect.css" />
        <link rel="stylesheet" href="src/lib/css/venobox.css" />
        <link rel="stylesheet" href="src/lib/css/bootstrap.min.css" />
        <link rel="stylesheet" href="src/css/style.css" />
<style>
.ec-cart-float {
  display: none;
  position: fixed;
  width: 100px;
  height: 100px;
  bottom: 50%;
  right: 49%;
  border-radius: 50px;
  padding: 15px;
  -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
  z-index: 15;
  background: #00b207;
}
.ec-cart-float .ec-cart-count {
  position: absolute;
  top: 20px;
  right: 0;
  left: 0;
  bottom: 0;
  background: #000;
  color: #ffffff;
  height: 18px;
  width: 18px;
  border-radius: 50%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  margin: auto;
  font-size: 12px;
  line-height: 30px;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

@media (max-width: 550px) {
  .ec-cart-float {
    position: fixed;
    width: 100px;
    height: 100px;
    top: 30%;
    right: 40%;
    border-radius: 50px;
    padding: 15px;
    -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
    z-index: 15;
    background: #00b207;
  }
}

.product-title {
  text-decoration: none;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: block;
  font-size: 14px;
  line-height: 1.5;
  font-weight: 500;
  width: 180px;
}

.show-heart {
  opacity: 1;
  visibility: visible;
}

.liked {
  visibility: visible;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  color: #fff;
  background-color: #00b207;
  -webkit-transition: all 0.3s linear;
  transition: all 0.3s linear; }
  .liked:hover {
    color: #1a1a1a;
    background-color: #f2f2f2;
    border-color: transparent; }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
// Convert number format
function Commafy(yourNumber) {
//Seperates the components of the number
var n= yourNumber.toString().split(".");
// Comma-fies the first part
n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//Combines the two sections
return n.join(".");
}

// Add to Cart
$.noConflict();
$(function() {
$(".add-to-cart").click(function(){
// alert("Item was added to your Cart");
var element = $(this);
var pid = element.attr("id3");
var imgurl = element.attr("data-photo");
var product = element.attr("data-product");
var price = element.attr("data-price");
// alert(pid);
// alert(Commafy(price));

var info = 'id3=' + pid + '&price=' + price;
 $.ajax({
   type: "GET",
   url: "process.php",
   data: info,
   success: function(){
    $(".cart-counter").text(parseInt($(".cart-counter").text()) + 1);
    $(".ec-cart-count").text(parseInt($(".ec-cart-count").text()) + 1);
    $(".cart-ttl").text(parseInt($(".cart-counter").text()));
    $('#cart-ttl').text(Commafy(parseInt($('#cart-ttl').text().replace(/,/g, '')) + parseInt(price)));
    Commafy($('#cart-ttl-2').text(Commafy(parseInt($('#cart-ttl-2').text().replace(/,/g, '')) + parseInt(price))));

    var cartitem = '<div class="shopping-cart__product-content-item">'+
    '<div class="img-wrapper"><img src="'+ imgurl +'" alt="'+ product +'"></div>'+
    '<div class="text-content">'+
    '<h5 class="font-body--md-400 product-title">'+ product +'</h5>'+
    '<p class="font-body--md-400">1 x <span class="font-body--md-500">N'+ price +'</span></p>'+
    // '<a href="javascript:void(0)" class="remove" id1="'+ del_id +'">×</a>'+
    '</div>'+
    '</div>';

    // Show cart popup
    $(".ec-cart-float").fadeIn();

    // Remove Empty message
    $("#cart-empty").hide();

    // Update cart items
    $('#cartitems').append(cartitem);

    // Hide Cart Popup
    setTimeout(function(){
        $(".ec-cart-float").fadeOut();
    }, 3000);
   }
 });
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
var pp_price = element.attr("data-product-price");
var cart_ttl = element.attr("data-cart-total");
var qty = element.attr("data-qty");
 $.ajax({
   type: "GET",
   url: "process.php",
   data: info,
   success: function(){
     $('#cart-ttl').text(Commafy(parseInt($('#cart-ttl').text().replace(/,/g, '')) - (parseInt(pp_price) * parseInt(qty))));
     $('#cart-ttl-2').text(Commafy(parseInt($('#cart-ttl-2').text().replace(/,/g, '')) - (parseInt(pp_price) * parseInt(qty))));
     $(".cart-ttl").text(parseInt($(".cart-counter").text()) - 1);
     $(".cart-counter").text(parseInt($(".cart-counter").text()) - 1);
   }
 });
$(this).parents(".cartitem").animate({ backgroundColor: "#fff" }, "fast")
.animate({ opacity: "hide" }, "slow");
return false;
});
});

// Add to Wishlist
$(function() {
$(".addtowishlist").click(function(){
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var del_id = element.attr("id2");
//Built a url to send
var info = 'id2=' + del_id;
 $.ajax({
   type: "GET",
   url: "process.php",
   data: info,
   success: function(){
  alert("Your Wishlist was Updated");
   }
 });
return false;
});
});

$(document).ready(function(){
$('.user-icon').click(function() {
//  window.location = "www.example.com/index.php?id=" + this.id;
  window.location = "account.php";
});
});
</script>
    </head>
    <body style="background: url('src/images/banner/bg.png') center center/cover no-repeat; background-color: #e6e6e6; height: 100%;">
      <div class="ec-cart-float">
        <svg width="70" height="70" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
        <div class="ec-cart-count"><?php echo $ttl_cart; ?></div>
      </div>
        <div class="loader">
            <div class="loader-icon">
                <img src="src/images/loader.gif" alt="loader" />
            </div>
        </div>

        <main class="box-layout">
            <!-- Header Section start -->
            <header class="header header--two">
                <div class="header__top">
                    <div class="container">
                        <div class="header__top-content">
                            <div class="header__top-left">
                                <p class="font-body--sm">
                                    <span>
                                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8.36364C16 14.0909 8.5 19 8.5 19C8.5 19 1 14.0909 1 8.36364C1 6.41068 1.79018 4.53771 3.1967 3.15676C4.60322 1.77581 6.51088 1 8.5 1C10.4891 1 12.3968 1.77581 13.8033 3.15676C15.2098 4.53771 16 6.41068 16 8.36364Z"
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                            <path
                                                d="M8.5 10.8182C9.88071 10.8182 11 9.71925 11 8.36364C11 7.00803 9.88071 5.90909 8.5 5.90909C7.11929 5.90909 6 7.00803 6 8.36364C6 9.71925 7.11929 10.8182 8.5 10.8182Z"
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </span>
                                    Office: 5a Olu Holloway, Ikoyi, Lagos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header__center">
                    <div class="container">
                        <div class="header__center-content">
                            <div class="header__brand">
                                <button class="header__sidebar-btn">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 6H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <a href="index.php">
                                    <img src="src/images/logo.png" alt="brand-logo" />
                                </a>
                            </div>
                            <form action="#">
                                <div class="header__input-form">
                                    <input type="text" placeholder="Search" />
                                    <span class="search-icon">
                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.16667 16.3333C12.8486 16.3333 15.8333 13.3486 15.8333 9.66667C15.8333 5.98477 12.8486 3 9.16667 3C5.48477 3 2.5 5.98477 2.5 9.66667C2.5 13.3486 5.48477 16.3333 9.16667 16.3333Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                            <path d="M17.4999 18L13.8749 14.375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <button type="submit" class="search-btn button button--md">
                                        Search
                                    </button>
                                </div>
                            </form>
                            <a href="#" class="header__contact-info-number">
                                <span>
                                    <svg width="32" height="32" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.4359 2.375C15.9193 2.77396 17.2718 3.55567 18.358 4.64184C19.4441 5.72801 20.2258 7.08051 20.6248 8.56388"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M13.5306 5.75687C14.4205 5.99625 15.2318 6.46521 15.8833 7.11678C16.5349 7.76835 17.0039 8.57967 17.2433 9.46949"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M7.115 11.6517C8.02238 13.5074 9.5263 15.0049 11.3859 15.9042C11.522 15.9688 11.6727 15.9966 11.8229 15.9851C11.9731 15.9736 12.1178 15.9231 12.2425 15.8386L14.9812 14.0134C15.1022 13.9326 15.2414 13.8833 15.3862 13.8698C15.5311 13.8564 15.677 13.8793 15.8107 13.9364L20.9339 16.1326C21.1079 16.2065 21.2532 16.335 21.3479 16.4987C21.4426 16.6623 21.4815 16.8523 21.4589 17.04C21.2967 18.307 20.6784 19.4714 19.7196 20.3154C18.7608 21.1593 17.5273 21.6249 16.25 21.625C12.3049 21.625 8.52139 20.0578 5.73179 17.2682C2.94218 14.4786 1.375 10.6951 1.375 6.75C1.37512 5.47279 1.84074 4.23941 2.68471 3.28077C3.52867 2.32213 4.6931 1.70396 5.96 1.542C6.14771 1.51936 6.33769 1.55832 6.50134 1.653C6.66499 1.74769 6.79345 1.89298 6.86738 2.067L9.06537 7.1945C9.1219 7.32698 9.14485 7.47137 9.13218 7.61485C9.11951 7.75833 9.07162 7.89647 8.99275 8.017L7.17275 10.7977C7.09015 10.923 7.04141 11.0675 7.03129 11.2171C7.02117 11.3668 7.05001 11.5165 7.115 11.6517V11.6517Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </span>
                                <div class="header__contact-info-number--info">
                                    <h5 class="font-body--md">Call to Order</h5>
                                    <p>+234 811 123 4567</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header__bottom">
                    <div class="container">
                        <div class="header__bottom-content">
                            <div class="header__bottom-left">
                                <ul class="header__category-content dark">
                                    <li class="header__category-content-item">
                                        <a href="#">
                                            <button class="bar-content">
                                                <span class="bar"></span>
                                            </button>
                                            All Categories
                                            <span class="toggle-icon">
                                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.75 1.375L6 6.625L11.25 1.375" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                        <ul class="header__category-content-dropdown">
                                          <?php
                                          // Fetch Categories
                                          $query = "SELECT * FROM categories ORDER BY category ASC LIMIT 8";
                                          $catdata = mysqli_query($con,$query);
                                          while($row = mysqli_fetch_array($catdata)){
                                          ?>
                                            <li>
                                                <a href="shop.php?cat=<?php echo $row['id']; ?>"><?php echo $row['category']; ?></a>
                                            </li>
                                          <?php } ?>
                                            <li>
                                                <a href="shop.php">
                                                    <span class="icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.25 3.75V11.25H3.75V12.75H11.25V20.25H12.75V12.75H20.25V11.25H12.75V3.75H11.25Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    View All
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="header__navigation-menu">
                                <li class="header__navigation-menu-link">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="header__navigation-menu-link">
                                    <a href="shop.php">Shop</a>
                                </li>
                                <li class="header__navigation-menu-link">
                                  <?php if(!isset($_COOKIE['email'])){ ?>
                                    <a href="login.php">Login / Register</a>
                                  <?php } else {?>
                                    <a href="account.php">My Account</a>
                                  <?php } ?>
                                </li>
                                </ul>
                            </div>
                            <div class="header__bottom-right">
                                <div class="header__activity-icons">
                                    <div class="fav d-inline-block mx-sm-4">
                                        <a href="wishlist.php">
                                            <svg width="25" height="23" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="#fff" stroke-width="1.5" />
                                            </svg>
                                        </a>
                                    </div>

                                    <button class="cart-bag">
                                        <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        <span class="item-number cart-counter"><?php echo $ttl_cart; ?></span>
                                    </button>
                                    <button class="user-icon">
                                        <svg width="23" height="23" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.99993 7.66667C8.84088 7.66667 10.3333 6.17428 10.3333 4.33333C10.3333 2.49238 8.84088 1 6.99993 1C5.15898 1 3.6666 2.49238 3.6666 4.33333C3.6666 6.17428 5.15898 7.66667 6.99993 7.66667Z"
                                                stroke="currentColor"
                                                stroke-width="1.2"
                                            />
                                            <path
                                                d="M9.49995 10.1665H4.49995C2.19828 10.1665 0.137447 12.2915 1.65161 14.024C2.68161 15.2023 4.38495 15.9998 6.99995 15.9998C9.61495 15.9998 11.3174 15.2023 12.3474 14.024C13.8624 12.2907 11.8008 10.1665 9.49995 10.1665Z"
                                                stroke="currentColor"
                                                stroke-width="1.2"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header__sidebar">
                    <button class="header__cross">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="header__mobile-sidebar">
                        <div class="header__mobile-top">
                            <form action="#">
                                <div class="header__mobile-input">
                                    <input type="text" placeholder="Search" />
                                    <button class="search-btn">
                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.16667 16.3333C12.8486 16.3333 15.8333 13.3486 15.8333 9.66667C15.8333 5.98477 12.8486 3 9.16667 3C5.48477 3 2.5 5.98477 2.5 9.66667C2.5 13.3486 5.48477 16.3333 9.16667 16.3333Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                            <path d="M17.4999 18L13.8749 14.375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            <ul class="header__mobile-menu">
                                <li class="header__mobile-menu-item">
                                    <a href="index.php" class="header__mobile-menu-item-link">Home</a>
                                </li>
                                <li class="header__mobile-menu-item">
                                    <a href="shop.php" class="header__mobile-menu-item-link">Shop</a>
                                </li>
                                <li class="header__mobile-menu-item">
                                  <?php if(!isset($_COOKIE['email'])){ ?>
              											<a href="login.php" class="header__mobile-menu-item-link">Login / Register</a>
              										<?php } else {?>
              											<a href="account.php" class="header__mobile-menu-item-link">My Account</a>
              										<?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Header  Section start -->

            <!-- Banner  Section Start  -->
            <section class="banner banner--02">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 order-2 order-xl-0">
                            <ul class="card-category">
                              <?php
                              // Fetch Categories
                              $query = "SELECT * FROM categories ORDER BY category ASC LIMIT 10";
                              $catdata = mysqli_query($con,$query);
                              while($row = mysqli_fetch_array($catdata)){

                                $sum = "SELECT count(id) as ttl_products FROM products WHERE cat_id='".$row['id']."'";
                              	$res = mysqli_query($con, $sum);
                              	while ($value = mysqli_fetch_array($res)){
                              	$ttproducts = $value['ttl_products'];
                              	}
                              ?>
                              <li>
                                <a href="shop.php?cat=<?php echo $row['id']; ?>"><?php echo $row['category']; ?>  (<?php echo $ttproducts; ?>)</a>
                                </li>
                              <?php } ?>

                                <li class="card-category--view-all">
                                    <a href="shop.php">
                                        <span class="icon">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.25 0.75V8.25H0.75V9.75H8.25V17.25H9.75V9.75H17.25V8.25H9.75V0.75H8.25Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        View all Categories
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-9 order-1 order-xl-0">
                            <div class="swiper-container banner-slider--02">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="banner__wrapper-img banner__wrapper--img-01">
                                            <img src="src/images/banner/banner-lg-01.png" alt="banner" />

                                            <div class="banner__wrapper-text">
                                                <h2 class="font-title--xl">
                                                    Fresh & Healthy Organic Food
                                                </h2>
                                                <div class="sale-off">
                                                    <h5 class="font-body--xxxl-500">Sale up to <span>48% </span>off</h5>
                                                </div>
                                                <a href="shop.php?cat=1" class="button button--md">
                                                    Shop now
                                                    <span>
                                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="banner__wrapper-img banner__wrapper--img-02">
                                            <img src="src/images/banner/banner-lg-01.png" alt="banner" />

                                            <div class="banner__wrapper-text">
                                                <h2 class="font-title--xl">
                                                    Fresh & Healthy Organic Food
                                                </h2>
                                                <div class="sale-off">
                                                    <h5 class="font-body--xxxl-500">Sale up to <span>48% </span>off</h5>
                                                </div>
                                                <a href="shop.php?cat=1" class="button button--md">
                                                    Shop now
                                                    <span>
                                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="banner__wrapper-img banner__wrapper--img-03">
                                            <img src="src/images/banner/banner-lg-01.png" alt="banner" />

                                            <div class="banner__wrapper-text">
                                                <h2 class="font-title--xl">
                                                    Fresh & Healthy Organic Food
                                                </h2>
                                                <div class="sale-off">
                                                    <h5 class="font-body--xxxl-500">Sale up to <span>48% </span>off</h5>
                                                </div>
                                                <a href="shop.php?cat=1" class="button button--md">
                                                    Shop now
                                                    <span>
                                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Banner Section end  -->

            <!-- cyclone sale  Section Start  -->
            <section class="cyclone section section--lg pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="cards-ss cards-ss--lg">
                                <div class="cards-ss__img-wrapper">
                                    <img src="src/images/banner/banner-sm-03.png" alt="banner" />
                                    <div class="cards-ss__content text-center">
                                        <h6 class="font-body--md-500">BEST DEALS</h6>
                                        <h2 class="font-title--lg">Limited Offer</h2>

                                        <div id="countdownTwo" class="countdown-clock"></div>

                                        <a href="shop.php" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="cards-ss cards-ss--lg">
                                <div class="cards-ss__img-wrapper">
                                    <img src="src/images/banner/banner-sm-01.png" alt="banner" />
                                    <div class="cards-ss__content text-center">
                                        <h6 class="font-body--md-500">85% Fat Free</h6>
                                        <h2 class="font-title--lg">Low-Fat Meat</h2>
                                        <div class="cards-ss__startpackage">
                                            <p>
                                                Starting from
                                                <span class="font-body--xxl-600">N550</span>
                                            </p>
                                        </div>
                                        <a href="shop.php?cat=7" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="cards-ss cards-ss--lg cards-ss--darktext">
                                <div class="cards-ss__img-wrapper">
                                    <img src="src/images/banner/banner-sm-02.png" alt="banner" />
                                    <div class="cards-ss__content text-center">
                                        <h6 class="font-body--md-500">New Year Sale</h6>
                                        <h2 class="font-title--lg">Fresh Fruits</h2>

                                        <div class="cards-ss__saleoff">
                                            <p>Up to <span>40% off</span></p>
                                        </div>

                                        <a href="shop.php?cat=1" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- cyclone sale  Section end  -->

            <!-- featured  Start  -->
            <section class="section" style="margin-bottom:30px">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="cards-ss cards-ss--darktext cards-ss--small-one">
                                <div class="cards-ss__img-wrapper">
                                    <img src="src/images/banner/banner-sm-07.jpg" alt="banner" />
                                    <div class="cards-ss__content text-center">
                                        <h6 class="font-body--md-500">Visit our Baby Shop</h6>

                                        <div class="cards-ss__save">
                                            <p>Up to 45% off</p>
                                        </div>

                                        <a href="shop.php?cat=13" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12" style="margin-top:30px">
                          <div class="section__head justify-content-center">
                              <h3 style="font-size:20px" class="section--title-four font-title--sm">Featured Products</h3>
                          </div>
                            <div class="row">
                              <?php
                              // Fetch Products
                              $query = "SELECT * FROM featured WHERE status='Featured' ORDER BY rand() LIMIT 4";
                              $proddata = mysqli_query($con,$query);
                              while($val = mysqli_fetch_array($proddata)){
                                if(strtotime("today") > strtotime($val['expires'])){
                                $con->autocommit(FALSE);
                                $con->query("UPDATE featured SET status='Expired' WHERE id='".$val['id']."'");
                                $con->commit();
                                }

                                $prqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$val['productid']."' AND status='Listed'");
                                $row = mysqli_fetch_assoc($prqq);

                                $vqq = mysqli_query($con, "SELECT * FROM users WHERE id='".$row['userid']."'");
                                $vqr = mysqli_fetch_assoc($vqq);

                                $timeDiff = abs(strtotime($row['expiry']) - strtotime($now2));
                                $numberDays = $timeDiff/86400;  // 86400 seconds in one day
                                // and you might want to convert to integer
                                $numberDays = intval($numberDays);

                                if($numberDays < 30){
                                $disc = mysqli_query($con, "SELECT * FROM discounts WHERE userid='".$vqr['id']."' AND expiry='30'");
                                $discqr = mysqli_fetch_assoc($disc);
                                $discount = $discqr['discount'];
                                $sale = $row['price'] - ($row['price'] * ($discount / 100));
                                }
                                if($numberDays > 30 && $numberDays < 60){
                                $disc = mysqli_query($con, "SELECT * FROM discounts WHERE userid='".$vqr['id']."' AND expiry='60'");
                                $discqr = mysqli_fetch_assoc($disc);
                                $discount = $discqr['discount'];
                                $sale = $row['price'] - ($row['price'] * ($discount / 100));
                                }
                                if($numberDays > 60 && $numberDays < 90){
                                $disc = mysqli_query($con, "SELECT * FROM discounts WHERE userid='".$vqr['id']."' AND expiry='90'");
                                $discqr = mysqli_fetch_assoc($disc);
                                $discount = $discqr['discount'];
                                $sale = $row['price'] - ($row['price'] * ($discount / 100));
                                }
                                if($numberDays > 90){
                                $discount = 0;
                                $sale = $row['price'];
                                }
                              ?>
                              <div class="col-lg-3 col-md-6">
                                  <div class="cards-md cards-md--four w-100">
                                      <div class="cards-md__img-wrapper">
                                        <a href="product.php?pid=<?php echo $row['id']; ?>">
                                            <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['product']; ?>" onerror="this.src='img/no-image.png';" />
                                        </a>
                                        <?php if($row['expiry']!='' && $numberDays < 90 && $row['stock'] > 0) { ?>
                                        <span class="tag danger font-body--md-400" style="background:#00b207;font-size:13px">Sale <?php echo $discount; ?>%</span>
                                      <?php } if($row['stock'] == 0) { ?>
                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                        <?php }
                                        if (isset($_COOKIE['email'])){
                                        $check = mysqli_query($con, "SELECT * FROM likes WHERE userid='".$uqr['id']."' AND prod_id='".$row['id']."'");
                                        if(mysqli_num_rows($check) == 0){
                                        ?>
                                          <div class="cards-md__favs-list">
                                              <span class="action-btn">
                                                  <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" id2="<?php echo $row['id']; ?>" class="addtowishlist">
                                                      <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                  </svg>
                                              </span>
                                          </div>
                                          <?php } if(mysqli_num_rows($check) == 1){ ?>
                                            <div class="cards-md__favs-list show-heart">
                                                <span class="action-btn liked">
                                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" id2="<?php echo $row['id']; ?>" class="addtowishlist">
                                                        <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                          <?php }} ?>
                                      </div>
                                      <div class="cards-md__info d-flex justify-content-between align-items-center">
                                          <a href="product.php?pid=<?php echo $row['id']; ?>" class="cards-md__info-left">
                                              <h6 class="font-body--md-400 product-title"><?php echo $row['product']; ?></h6>
                                              <div class="cards-md__info-price">
                                                <?php if($row['expiry']!='' && $numberDays < 90) { ?>
                                                  <span class="font-body--lg-500">N<?php echo number_format($sale, 0); ?></span>
                                                  <del class="font-body--lg-400" style="color:#00b207">N<?php echo number_format($row['price'], 0); ?></del>
                                                <?php } else { ?>
                                                  <span class="font-body--lg-500">N<?php echo number_format($row['price'], 0); ?></span>
                                              <?php } ?>
                                              </div>
                                              <ul class="d-flex" style="color:#888;font-size:12px">
                                                <?php if($row['expiry']!='' && $numberDays < 90) { ?>
                                                <li>Expires in <span style="font-weight:550;color:#00b207"><?php echo $numberDays; ?> days</span><li>
                                                <?php } else { ?>
                                                  <li>&nbsp;</li>
                                                <?php } ?>
                                              </ul>

                                          </a>
                                          <div class="cards-md__info-right">
                                              <?php if($row['stock'] > 0) { ?>
                                                <span class="action-btn">
                                                <?php if($row['expiry']!='' && $numberDays < 90) { ?>
                                                  <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="<?php echo $row['id']; ?>" data-price="<?php echo $sale; ?>" data-product="<?php echo $row['product']; ?>" data-photo="<?php echo $row['photo']; ?>">
                                                  <?php } else { ?>
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="<?php echo $row['id']; ?>" data-price="<?php echo $row['price']; ?>" data-product="<?php echo $row['product']; ?>" data-photo="<?php echo $row['photo']; ?>">
                                                    <?php } ?>
                                                      <path
                                                          d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333"
                                                          stroke="currentColor"
                                                          stroke-width="1.3"
                                                          stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                      ></path>
                                                  </svg>
                                              </span>
                                            <?php } ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- featured  end  -->

            <!-- cal-to-action Section Start  -->
            <section class="call-to-action call-to-action--two">
                <div class="container">
                    <div class="newsletter newsletter--two bg--gray-9">
                        <div class="newsletter__leftcontent">
                            <span class="newsletter__leftcontent-icon">
                                <svg width="46" height="42" viewBox="0 0 46 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 15.5V38.25C2 38.7141 2.18437 39.1592 2.51256 39.4874C2.84075 39.8156 3.28587 40 3.75 40H42.25C42.7141 40 43.1592 39.8156 43.4874 39.4874C43.8156 39.1592 44 38.7141 44 38.25V15.5L23 1.5L2 15.5Z"
                                        stroke="#00B307"
                                        stroke-width="3"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                    <path d="M19.1816 27.75L2.53906 39.5047" stroke="#00B307" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M43.4611 39.5065L26.8186 27.75" stroke="#00B307" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M44 15.5L26.8185 27.75H19.1815L2 15.5" stroke="#00B307" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="newsletter__leftcontent-text-content">
                                <h2 class="font-body--xxxl-600" style="font-size:15px">Subscribe to our Newsletter</h2>
                                <p class="font-body--md-400">Receive deals & special offers right in your inbox!</p>
                            </div>
                        </div>
                        <div class="newsletter__rightcontent">
                            <form action="#">
                                <div class="newsletter__input">
                                    <input type="text" placeholder="Your Email Address" />
                                    <button class="button button--lg" type="submit">
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                            <ul class="newsletter__social-icon">
                                <li>
                                    <a href="#">
                                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.99764 2.98875H9.64089V0.12675C9.35739 0.08775 8.38239 0 7.24689 0C4.87764 0 3.25464 1.49025 3.25464 4.22925V6.75H0.640137V9.9495H3.25464V18H6.46014V9.95025H8.96889L9.36714 6.75075H6.45939V4.5465C6.46014 3.62175 6.70914 2.98875 7.99764 2.98875Z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 2.41888C17.3306 2.7125 16.6174 2.90713 15.8737 3.00163C16.6388 2.54488 17.2226 1.82713 17.4971 0.962C16.7839 1.38725 15.9964 1.68763 15.1571 1.85525C14.4799 1.13413 13.5146 0.6875 12.4616 0.6875C10.4186 0.6875 8.77387 2.34575 8.77387 4.37863C8.77387 4.67113 8.79862 4.95238 8.85938 5.22013C5.7915 5.0705 3.07687 3.60013 1.25325 1.36025C0.934875 1.91263 0.748125 2.54488 0.748125 3.2255C0.748125 4.5035 1.40625 5.63638 2.38725 6.29225C1.79437 6.281 1.21275 6.10888 0.72 5.83775C0.72 5.849 0.72 5.86363 0.72 5.87825C0.72 7.6715 1.99912 9.161 3.6765 9.50413C3.37612 9.58625 3.04875 9.62563 2.709 9.62563C2.47275 9.62563 2.23425 9.61213 2.01038 9.56263C2.4885 11.024 3.84525 12.0984 5.4585 12.1333C4.203 13.1154 2.60888 13.7071 0.883125 13.7071C0.5805 13.7071 0.29025 13.6936 0 13.6565C1.63462 14.7106 3.57188 15.3125 5.661 15.3125C12.4515 15.3125 16.164 9.6875 16.164 4.81175C16.164 4.64863 16.1584 4.49113 16.1505 4.33475C16.8829 3.815 17.4982 3.16588 18 2.41888Z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.24471 0C3.31136 0 0.687744 3.16139 0.687744 6.60855C0.687744 8.20724 1.58103 10.2008 3.01097 10.8331C3.22811 10.931 3.34624 10.8894 3.39462 10.688C3.43737 10.535 3.62525 9.79807 3.71638 9.45042C3.74451 9.33904 3.72988 9.24229 3.63988 9.13766C3.16511 8.58864 2.78821 7.58847 2.78821 6.65017C2.78821 4.24594 4.69967 1.91146 7.9522 1.91146C10.7648 1.91146 12.7325 3.73854 12.7325 6.35204C12.7325 9.30529 11.1698 11.3484 9.13912 11.3484C8.0152 11.3484 7.17816 10.4663 7.44367 9.37505C7.76431 8.07561 8.39321 6.6783 8.39321 5.74113C8.39321 4.90072 7.91844 4.20544 6.94865 4.20544C5.80447 4.20544 4.87631 5.33837 4.87631 6.85943C4.87631 7.82585 5.21832 8.47838 5.21832 8.47838C5.21832 8.47838 4.08652 13.0506 3.87614 13.9045C3.52062 15.3502 3.92451 17.6914 3.95939 17.8928C3.98077 18.0042 4.10565 18.0391 4.1754 17.9479C4.28678 17.8017 5.65484 15.8497 6.03848 14.4389C6.17799 13.9248 6.75064 11.84 6.75064 11.84C7.12753 12.5207 8.21546 13.0911 9.37426 13.0911C12.8214 13.0911 15.3123 10.0613 15.3123 6.30141C15.2999 2.69675 12.215 0 8.24471 0Z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="25" height="18" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.0027 24.0548C8.72269 24.0548 8.33602 24.0375 7.05602 23.9815C6.05785 23.9487 5.07259 23.7458 4.14269 23.3815C3.34693 23.0718 2.62426 22.6 2.02058 21.9961C1.4169 21.3922 0.945397 20.6694 0.636019 19.8735C0.28576 18.9402 0.0968427 17.9542 0.0773522 16.9575C0.00268554 15.6802 0.00268555 15.2615 0.00268555 12.0068C0.00268555 8.7175 0.0200189 8.3335 0.0773522 7.06017C0.0972691 6.06486 0.28618 5.08018 0.636019 4.14817C0.945042 3.35128 1.41686 2.62761 2.02134 2.02335C2.62583 1.4191 3.34968 0.947556 4.14669 0.638836C5.07821 0.287106 6.06315 0.0976949 7.05869 0.0788358C8.33202 0.0068358 8.75069 0.00683594 12.0027 0.00683594C15.3094 0.00683594 15.6894 0.0241691 16.9494 0.0788358C17.9467 0.0975025 18.936 0.286836 19.8694 0.638836C20.6661 0.947914 21.3898 1.41958 21.9943 2.02379C22.5987 2.628 23.0706 3.35149 23.38 4.14817C23.736 5.09484 23.9267 6.09484 23.9414 7.10417C24.016 8.3815 24.016 8.79883 24.016 12.0522C24.016 15.3055 23.9974 15.7322 23.9414 16.9948C23.9214 17.9924 23.7321 18.9794 23.3814 19.9135C23.0712 20.7099 22.5988 21.4332 21.9942 22.0373C21.3896 22.6414 20.666 23.1133 19.8694 23.4228C18.936 23.7722 17.9507 23.9615 16.9547 23.9815C15.6814 24.0548 15.264 24.0548 12.0027 24.0548ZM11.9574 2.1175C8.69602 2.1175 8.35735 2.1335 7.08402 2.19084C6.32355 2.20078 5.57042 2.34103 4.85735 2.6055C4.33726 2.80486 3.86471 3.11098 3.47017 3.50414C3.07563 3.89731 2.76786 4.36878 2.56669 4.88817C2.30002 5.60817 2.16002 6.3695 2.15202 7.1375C2.08135 8.4295 2.08135 8.76817 2.08135 12.0068C2.08135 15.2068 2.09335 15.5948 2.15202 16.8788C2.16402 17.6388 2.30402 18.3922 2.56669 19.1055C2.97469 20.1548 3.80669 20.9842 4.85869 21.3868C5.57083 21.653 6.32382 21.7933 7.08402 21.8015C8.37469 21.8762 8.71469 21.8762 11.9574 21.8762C15.228 21.8762 15.5667 21.8602 16.8294 21.8015C17.5899 21.7923 18.3432 21.652 19.056 21.3868C19.5733 21.186 20.0432 20.8796 20.4357 20.4873C20.8282 20.095 21.1348 19.6254 21.336 19.1082C21.6027 18.3882 21.7427 17.6255 21.7507 16.8575H21.7654C21.8227 15.5828 21.8227 15.2428 21.8227 11.9855C21.8227 8.72817 21.808 8.3855 21.7507 7.11217C21.7386 6.35278 21.5984 5.60088 21.336 4.88817C21.1353 4.37023 20.8289 3.89977 20.4364 3.50677C20.0438 3.11376 19.5737 2.80682 19.056 2.6055C18.3427 2.33884 17.5894 2.20017 16.8294 2.19084C15.54 2.1175 15.2027 2.1175 11.9574 2.1175ZM12.0027 18.1655C10.7834 18.1663 9.59136 17.8055 8.5772 17.1287C7.56304 16.4519 6.77236 15.4896 6.30517 14.3634C5.83798 13.2373 5.71526 11.9978 5.95254 10.8019C6.18982 9.60598 6.77644 8.50729 7.63819 7.64478C8.49995 6.78228 9.59814 6.19471 10.7939 5.9564C11.9896 5.71808 13.2291 5.83973 14.3557 6.30594C15.4823 6.77216 16.4453 7.56201 17.1229 8.57558C17.8006 9.58916 18.1624 10.7809 18.1627 12.0002C18.1606 13.6337 17.5111 15.1999 16.3565 16.3555C15.2018 17.5111 13.6363 18.162 12.0027 18.1655ZM12.0027 7.9975C11.2116 7.9975 10.4382 8.2321 9.78041 8.67162C9.12261 9.11115 8.60992 9.73586 8.30717 10.4668C8.00442 11.1977 7.9252 12.0019 8.07954 12.7779C8.23388 13.5538 8.61485 14.2665 9.17426 14.8259C9.73367 15.3853 10.4464 15.7663 11.2223 15.9206C11.9982 16.075 12.8025 15.9958 13.5334 15.693C14.2643 15.3903 14.889 14.8776 15.3286 14.2198C15.7681 13.562 16.0027 12.7886 16.0027 11.9975C16.0002 10.9374 15.578 9.92141 14.8284 9.1718C14.0788 8.42219 13.0628 7.99997 12.0027 7.9975ZM18.4027 7.04683C18.2139 7.04613 18.0272 7.00826 17.8531 6.93538C17.6789 6.8625 17.5209 6.75604 17.3879 6.62208C17.1193 6.35153 16.9693 5.98537 16.9707 5.60417C16.9721 5.22296 17.1249 4.85793 17.3954 4.58938C17.666 4.32083 18.0321 4.17075 18.4134 4.17217C18.7946 4.17358 19.1596 4.32637 19.4281 4.59693C19.6967 4.86748 19.8468 5.23363 19.8454 5.61484C19.8439 5.99604 19.6912 6.36107 19.4206 6.62962C19.15 6.89817 18.7839 7.04825 18.4027 7.04683Z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- cal-to-action Section end  -->

            <!--Footer Section Start  -->
            <footer class="footer footer--two">
                <div class="container">
                    <div class="footer__top">
                        <div class="row justify-content-between">
                            <!-- Brand information-->
                            <div class="col-xl-4">
                                <div class="footer__brand-info">
                                    <div class="footer__brand-info-logo" style="width:110px">
                                        <img src="src/images/logo.png" alt="logo" />
                                    </div>
                                    <p class="font-body--md-400">
                                        Same day deliveries nationaiwde!
                                    </p>
                                    <div style="font-size:13px;font-weight:500">
                                        <span>+234 811 123 4568</span>
                                        <br />
                                        <span>info@expiringsoon.shop</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile app -->
                            <div class="col-xl-auto col-sm-4 col-6">
                                <ul class="footer__navigation mb-0">
                                    <li class="footer__navigation-title">
                                        <h2 class="font-body--lg-500">Get the App</h2>
                                    </li>
                                </ul>
                                <div class="footer__mobile-app">
                                    <a href="#" class="footer__mobile-app--item">
                                        <span>
                                            <svg width="24" height="29" viewBox="0 0 24 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M23.4239 22.0659C23.0156 23.0169 22.5113 23.9238 21.9189 24.7725C21.1268 25.9013 20.4787 26.6824 19.9793 27.1164C19.2053 27.828 18.3752 28.1932 17.4868 28.2136C16.8492 28.2136 16.0803 28.0322 15.1849 27.6641C14.2866 27.2978 13.4612 27.1158 12.7063 27.1158C11.9148 27.1158 11.066 27.2978 10.1578 27.6641C9.24833 28.0322 8.51567 28.2241 7.95567 28.2428C7.104 28.2795 6.25467 27.9044 5.4065 27.1164C4.86575 26.6439 4.18967 25.8354 3.37884 24.6897C2.50909 23.4659 1.79392 22.0472 1.23392 20.429C0.634252 18.682 0.333252 16.9897 0.333252 15.3517C0.333252 13.4751 0.738669 11.8569 1.55067 10.5007C2.18942 9.41103 3.03817 8.55237 4.101 7.9212C5.1437 7.29723 6.33344 6.96145 7.5485 6.9482C8.22517 6.9482 9.11242 7.15762 10.2155 7.56887C11.3151 7.98128 12.0209 8.1907 12.3307 8.1907C12.5617 8.1907 13.3463 7.9457 14.6757 7.45803C15.9333 7.00537 16.9944 6.81812 17.8636 6.8922C20.2197 7.08237 21.9895 8.01103 23.1661 9.68403C21.0597 10.9604 20.0173 12.7483 20.0383 15.0419C20.0569 16.8287 20.705 18.3156 21.979 19.4957C22.5565 20.044 23.2011 20.4675 23.918 20.768C23.7677 21.2059 23.6029 21.6388 23.4239 22.0659ZM18.0211 0.805701C18.0211 2.2057 17.5095 3.51353 16.4898 4.72337C15.259 6.16245 13.7709 6.9937 12.1568 6.86245C12.1351 6.68634 12.1242 6.50906 12.1242 6.33162C12.1242 4.98762 12.7093 3.54912 13.7488 2.37253C14.2679 1.77695 14.9271 1.2817 15.7274 0.886784C16.5266 0.497701 17.2814 0.282451 17.9919 0.245117C18.0123 0.432367 18.0211 0.619617 18.0211 0.805117V0.805701Z"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                        </span>
                                        <div class="footer__mobile-app--info">
                                            <h5>Download on the</h5>
                                            <h2 class="font-body--xl-500">App Store</h2>
                                        </div>
                                    </a>
                                    <a href="#" class="footer__mobile-app--item">
                                        <span>
                                            <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.0652 11.7299L3.7188 1.35472L16.8828 8.91232L14.0652 11.7299ZM1.0176 0.745117C0.408 1.06432 0 1.64512 0 2.40112V23.0891C0 23.8451 0.408 24.4259 1.0176 24.7451L13.05 12.7427L1.0176 0.745117ZM20.9532 11.3219L18.192 9.72352L15.1116 12.7475L18.192 15.7715L21.0096 14.1731C21.8532 13.5023 21.8532 11.9927 20.9532 11.3219ZM3.7188 24.1403L16.8828 16.5827L14.0652 13.7651L3.7188 24.1403Z"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                        </span>
                                        <div class="footer__mobile-app--info">
                                            <h5>Download on the</h5>
                                            <h2 class="font-body--xl-500">Google Play</h2>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer__bottom">
                        <p class="footer__copyright-text">
                            Expiring Soon © 2022. All Rights Reserved
                        </p>
                        <div class="footer__partner d-flex">
                            <div class="footer__partner-item">
                               <a href="#">
                                <img src="src/images/brand-icon/img-02-w.png" alt="img" />
                               </a>
                            </div>
                            <div class="footer__partner-item">
                               <a href="#">
                                <img src="src/images/brand-icon/img-04-w.png" alt="img" />
                               </a>
                            </div>
                            <div class="footer__partner-item">
                               <a href="#">
                                <img src="src/images/brand-icon/img-05-w.png" alt="img" />
                               </a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--Footer Section end  -->
        </main>

        <!-- Modal -->
        <div class="modal fade newsletter-popup" id="newsletter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row newsletter-popup__content">
                            <div class="col-lg-5">
                                <div class="newsletter-popup__img-wrapper">
                                    <img src="src/images/banner/banner-sm-18.png" alt="newsletter" />
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="newsletter-popup__text-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h5 class="font-title--xl">Subscribe to Our Newsletter</h5>
                                    <p class="font-body--lg">
                                        Receive Mouth-watering deals & <span>special offers</span> right in your inbox!
                                    </p>

                                    <form action="#">
                                        <div class="contact-mail">
                                            <input type="email" placeholder="Enter Your email" />
                                            <button class="button button--md">Subscribe</button>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="doNotShowNewsletter" />
                                            <label class="form-check-label font-body--md-400" for="doNotShowNewsletter">
                                                Do not show this window
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shopping Cart sidebar start  -->
        <div class="shopping-cart">
        		<div class="shopping-cart-top">
        				<div class="shopping-cart-header">
        						<h5 class="font-body--xxl-500">Shopping Cart (<span class="count cart-ttl"><?php echo $ttl_cart; ?></span>)</h5>
        						<button class="close">
        								<svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
        										<circle cx="22.5" cy="22.5" r="22.5" fill="white" />
        										<path d="M28.75 16.25L16.25 28.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        										<path d="M16.25 16.25L28.75 28.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        								</svg>
        						</button>
        				</div>
                <div id="cartitems"></div>
        				<?php
                if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
        				$query = "SELECT * FROM cart WHERE orderid='".$orderid."' AND status='Open' ORDER BY date DESC";
        				$qq = mysqli_query($con, $query);
        				if (mysqli_num_rows($qq) == 0) {
        				echo '<div id="cart-empty" style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />Your cart is empty.<br /><a href="shop.php"><span style="font-size:13px;color:#00b207">Start Shopping Now!</span></a></div>';
        				}
        				while ($value = mysqli_fetch_array($qq)){

        				$pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$value['productid']."'");
        				$pqr = mysqli_fetch_assoc($pqq);
        				?>
        				<div class="shopping-cart__product-content cartitem">
        						<div class="shopping-cart__product-content-item">
        								<div class="img-wrapper">
        										<img src="<?php echo $pqr['photo']; ?>" alt="<?php echo $pqr['product']; ?>" />
        								</div>
        								<div class="text-content">
        										<h5 class="font-body--md-400 product-title"><?php echo $pqr['product']; ?></h5>
        										<p class="font-body--md-400"><?php echo $value['qty']; ?> x <span class="font-body--md-500">N<?php echo number_format($value['total'], 2); ?></span></p>
        								</div>
        						</div>
        						<button class="delete-item">
        								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove" id1="<?php echo $value['id']; ?>" data-cart-total="<?php echo $orderttl; ?>" data-product-price="<?php echo $value['price']; ?>" data-qty="<?php echo $value['qty']; ?>">
        										<path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10" />
        										<path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        										<path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        								</svg>
        						</button>
        				</div>
        			<?php }}
              else { echo '<div id="cart-empty" style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />Your cart is empty.<br /><a href="shop.php"><span style="font-size:13px;color:#00b207">Start Shopping Now!</span></a></div>';
              } ?>
        		</div>
        		<div class="shopping-cart-bottom">
        				<div class="shopping-cart-product-info">
        						<p class="product-count font-body--lg-400"><span class=" cart-ttl"><?php echo $ttl_cart; ?></span> Items</p>
        						<span class="product-price font-body--lg-500">N<span id="cart-ttl-2"><?php echo number_format($orderttl, 2); ?></span></span>
        				</div>

        						<!-- <button class="button button--lg w-100" onclick="window.location.href='checkout.php'">Checkout</button> -->
        						<button class="button button--lg w-100" onclick="window.location.href='cart.php'">Go to Cart</button>
        		</div>
        </div>
        <!-- Shopping Cart sidebar end -->

        <script src="src/lib/js/jquery.min.js"></script>
        <script src="src/lib/js/venobox.min.js"></script>
        <script src="src/lib/js/swiper-bundle.min.js"></script>
        <script src="src/lib/js/bvselect.js"></script>
        <script src="src/lib/js/bootstrap.bundle.min.js"></script>
        <script src="src/lib/js/jquery.syotimer.min.js"></script>
        <script src="src/js/main.js"></script>
        <script src="src/js/home2.js"></script>
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
</html>
