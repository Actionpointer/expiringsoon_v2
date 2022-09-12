<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

if (isset($_POST['btn-sch'])){
header("Location: results.php?str=".urlencode($_POST['sch'])."");
}

// session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];

$sum = "SELECT sum(total) as ttl FROM cart WHERE orderid='".$orderid."' AND status='Open'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$orderttl = $row['ttl'];
$vat = (7 / 100) * $orderttl;
}

$sum = "SELECT count(id) as ttcart FROM cart WHERE orderid='".$orderid."' AND status='Open'";
$res = mysqli_query($con, $sum);
while ($row = mysqli_fetch_array($res)){
$ttl_cart = $row['ttcart'];
}
}
else{
$vat = '0';
$orderttl = '0';
$ttl_cart = '0';
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
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
		 $(".cart-ttl").text(parseInt($(".cart-counter").text()) - 1);
   }
 });
$(this).parents(".cartitem").animate({ backgroundColor: "#fff" }, "fast")
.animate({ opacity: "hide" }, "slow");
return false;
});
});

// Search SUggest
$.noConflict();
$(document).ready(function(){
$('#searchid').keyup(function (){
var searchid = $(this).val();
var dataString = 'search='+ searchid;
//if(searchid!=''){
	$.ajax({
	type: "POST",
	url: "autocomplete.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	}
	});
if(searchid.length = 0){
$("#result").html(html).hide();
}
//}
return false;
});

jQuery("#result").live("click",function(e){
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) {
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut();
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});

if(searchid=''){
  	$("#result").html(html).hide();
    };

});

// Search SUggest
$.noConflict();
$(document).ready(function(){
$('#searchid2').keyup(function (){
var searchid = $(this).val();
var dataString = 'search='+ searchid;
//if(searchid!=''){
	$.ajax({
	type: "POST",
	url: "autocomplete.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	}
	});
if(searchid.length = 0){
$("#result").html(html).hide();
}
//}
return false;
});

jQuery("#result").live("click",function(e){
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) {
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut();
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});

if(searchid=''){
  	$("#result").html(html).hide();
    };

});
</script>

<style>
.show-heart {
	opacity: 1;
	visibility: visible;
}

.droplist {
  height: 50px;
  width: 100%;
  border: 1px solid #e5e5e5;
  line-height: 30px;
  color: #666666;
  font-size: 14px;
  padding-left: 16px;
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

.button--md.products__content-action-item {
	margin-right: 12px;
	-ms-flex-negative: 0;
			flex-shrink: 0;
			width: 200px;
		}

.heart{
  position: absolute;
  top: 5px;
  right: 5px;
  padding: 5px;
  z-index: 100;
  width: 25px;
}
</style>

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
										<p class="font-body--md-400"><?php echo $value['qty']; ?> x <span class="font-body--md-500">N<?php echo number_format($value['total'], 0); ?></span></p>
								</div>
						</div>
						<button class="delete-item">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove" id1="<?php echo $value['id']; ?>" data-cart-total="<?php echo $orderttl; ?>" data-product-price="<?php echo $pqr['price']; ?>" data-qty="<?php echo $value['qty']; ?>">
										<path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10" />
										<path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
						</button>
				</div>
			<?php }}
			else{
				echo '<div id="cart-empty" style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />Your cart is empty.<br /><a href="shop.php"><span style="font-size:13px;color:#00b207">Start Shopping Now!</span></a></div>';
				} ?>
		</div>
		<div class="shopping-cart-bottom">
				<div class="shopping-cart-product-info">
						<p class="product-count font-body--lg-400"><span class=" cart-ttl"><?php echo $ttl_cart; ?></span> Items</p>
						<span class="product-price font-body--lg-500">N<span id="cart-ttl"><?php echo number_format($orderttl, 0); ?></span></span>
				</div>

						<button class="button button--lg w-100" onclick="window.location.href='checkout.php'">Checkout</button>
						<button class="button button--lg w-100" onclick="window.location.href='cart.php'">Go to Cart</button>
		</div>
</div>
<!-- Shopping Cart sidebar end -->

<!-- Header Section start -->
<header class="header header--one">
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
								<div class="header__top-right">
										<div class="header__in">
											<?php if(!isset($_COOKIE['admin'])){ ?>
												<a href="login.php">Admin Login</a>
											<?php } else {?>
												<a href="admin-dashboard.php">Hi, Admin</a>
											<?php } ?>
										</div>
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

						</div>
				</div>
		</div>
</header>
<!-- Header  Section start -->
