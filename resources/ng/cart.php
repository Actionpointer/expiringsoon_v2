<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];

$cqq = mysqli_query($con, "SELECT count(DISTINCT vendor) as vendors FROM cart WHERE orderid='".$_SESSION['orderid']."' AND status='Open'");
$row = mysqli_fetch_assoc($cqq);
if($row['vendors'] > 1){
header("Location: cart-v.php");
}
}
else{
header("Location: index.php");
}

$cqq = mysqli_query($con, "SELECT * FROM cart WHERE orderid='".$_SESSION['orderid']."' AND status='Open'");
while ($vrow = mysqli_fetch_array($cqq)){
$vendor = $vrow['vendor'];

$vqq = mysqli_query($con, "SELECT * FROM users WHERE id='".$vrow['vendor']."'");
$vqr = mysqli_fetch_assoc($vqq);
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shopery.netlify.app/main/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Shopping Cart | Expiring Soon</title>
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
    <script type="text/javascript">
    // Convert number format
    function Commafy(yourNumber) {
    //Seperates the components of the number
    var n= yourNumber.toString().split(".");
    // Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    return n.join(".");
    }

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
    		 $('#cart-ttl').text(Commafy(parseInt($('#cart-ttl').text().replace(/,/g, '')) - (parseInt(pp_price) * parseInt(qty))));
       }
     });
    $(this).parents(".cartitem").animate({ backgroundColor: "#fff" }, "fast")
    .animate({ opacity: "hide" }, "slow");
    return false;
    });
    });

      // Update Cart Decrease
      $(document).on('click','.counter-btn-dec',function(){
      var clicked = $(this);
      var row = $(this).closest("tr");
      var itemPrice = parseInt(clicked.attr('data-price'));
      var cartid = clicked.attr('data-cart-id');
      var subttl = parseInt(row.find('#subttl').html());
      var itemQty = parseInt(row.find('#counter-btn-counter').val()) - 1;
      var newTotal = parseInt(itemPrice) * parseInt(itemQty);
      var subTotal = parseInt($('#cart-subttl').text().replace(/,/g, '')) - itemPrice;
      var vat = parseInt((7.5 / 100) * subTotal);
      // alert(itemQty);
      row.find('#subttl').text(Commafy(newTotal));
      row.find('#counter-btn-counter').val(itemQty);
      $('#cart-subttl').text(Commafy(parseInt($('#cart-subttl').text().replace(/,/g, '')) - itemPrice));
      $('#cart-vat').text(Commafy(vat));
      $('#cart-total').text(Commafy(parseInt(subTotal + vat)));

      $.post("process.php", {qty:itemQty, cartid:cartid, ttl:newTotal}, function (data) {
      });
      });

      // Update Cart Increase
      $(document).on('click','.counter-btn-inc',function(){
      var clicked = $(this);
      var row = $(this).closest("tr");
      var itemPrice2 = parseInt(clicked.attr('data-price-inc'));
      var cartid = clicked.attr('data-cart-id');
      var subttl2 = row.find('#subttl').html();
      var itemQty2 = parseInt(row.find('#counter-btn-counter').val()) + 1;
      var newTotal2 = parseInt(itemPrice2) * parseInt(itemQty2);
      var subTotal2 = parseInt($('#cart-subttl').text().replace(/,/g, '')) + itemPrice2;
      var vat2 = parseInt((7.5 / 100) * subTotal2);
      row.find('#subttl').text(Commafy(newTotal2));
      row.find('#counter-btn-counter').val(itemQty2);
      // alert(subTotal2);
      $('#cart-subttl').text(Commafy(parseInt($('#cart-subttl').text().replace(/,/g, '')) + itemPrice2));
      $('#cart-vat').html(Commafy(vat2));
      $('#cart-total').text(Commafy(parseInt(subTotal2 + vat2)));

      $.post("process.php", {qty:itemQty2, cartid:cartid, ttl:newTotal2}, function (data) {
      });
      });

      // Update Cart Increase Mobile
      $(document).on('click','.counter-btn-inc-mobile',function(){
      var clicked = $(this);
      var row = $(this).closest("div");
      var itemPrice3 = parseInt(clicked.attr('data-price-inc'));
      var cartid = clicked.attr('data-cart-id');
      var itemQty3 = parseInt(row.find('#counter-btn-counter-mobile').val()) + 1;
      var newTotal3 = parseInt(itemPrice3) * parseInt(itemQty3);
      var subTotal3 = parseInt($('#cart-subttl').text().replace(/,/g, '')) + itemPrice3;
      var vat3 = parseInt((7 / 100) * subTotal3);
      $(this).parent().siblings().find('#subttl-mobile').text(Commafy(newTotal3));
      row.find('#counter-btn-counter-mobile').val(itemQty3);
      $('#cart-subttl').text(Commafy(parseInt($('#cart-subttl').text().replace(/,/g, '')) + itemPrice3));
      $('#cart-vat').html(Commafy(vat3));
      $('#cart-total').text(Commafy(parseInt(subTotal3 + vat3)));

      $.post("process.php", {qty:itemQty3, cartid:cartid, ttl:newTotal3}, function (data) {
      });
      });

      // Update Cart Decrease Mobile
      $(document).on('click','.counter-btn-dec-mobile',function(){
      var clicked = $(this);
      var row = $(this).closest("div");
      var itemPrice4 = parseInt(clicked.attr('data-price'));
      var cartid = clicked.attr('data-cart-id');
      var itemQty4 = parseInt(row.find('#counter-btn-counter-mobile').val()) - 1;
      var newTotal4 = parseInt(itemPrice4) * parseInt(itemQty4);
      var subTotal4 = parseInt($('#cart-subttl').text().replace(/,/g, '')) - itemPrice4;
      var vat4 = parseInt((7 / 100) * subTotal4);
      // alert(itemPrice4);
      $(this).parent().siblings().find('#subttl-mobile').text(Commafy(newTotal4));
      row.find('#counter-btn-counter-mobile').val(itemQty4);
      $('#cart-subttl').text(Commafy(parseInt($('#cart-subttl').text().replace(/,/g, '')) - itemPrice4));
      $('#cart-vat').html(Commafy(vat4));
      $('#cart-total').text(Commafy(parseInt(subTotal4 + vat4)));

      $.post("process.php", {qty:itemQty4, cartid:cartid, ttl:newTotal4}, function (data) {
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
              <a href="cart.php">Shopping cart</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- breedcrumb section end   -->

    <!-- Shopping Cart Section Start   -->
    <section class="shoping-cart section section--xl">
      <div class="container">
        <div class="section__head justify-content-center">
          <h2 class="section--title-four font-title--sm">My Shopping Cart</h2>
        </div>
        <div class="row shoping-cart__content">
          <div class="col-lg-8">
            <?php
            $cqq = mysqli_query($con, "SELECT * FROM cart WHERE orderid='".$_SESSION['orderid']."' AND status='Open' group by vendor");
            while ($vrow = mysqli_fetch_array($cqq)){

            $vqq = mysqli_query($con, "SELECT * FROM users WHERE id='".$vrow['vendor']."'");
            $vqr = mysqli_fetch_assoc($vqq);
            }
            ?>
            <div class="cart-table">
              <div class="table-responsive">
                <div style="font-size:14px;margin:2%;width:96%;padding:10px;border-bottom:1px solid #ddd">
                  <a href="https://ng.expiringsoon.shop/<?php echo $vqr['username']; ?>" class="brand-name-logo">
                      <img src="<?php echo $vqr['pic']; ?>" alt="<?php echo $vqr['username']; ?>" style="width:40px;border-radius:50px;border:1px solid #bababa;padding:2px" />
                  </a>
                <a href="https://ng.expiringsoon.shop/<?php echo $vqr['username']; ?>" style="color:#00b207;font-weight:500"><?php echo $vqr['fname']; ?> <?php echo $vqr['lname']; ?></a></div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="cart-table-title">Product</th>
                      <th scope="col" class="cart-table-title">Price</th>
                      <th scope="col" class="cart-table-title">quantity</th>
                      <th scope="col" class="cart-table-title">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
                    if(isset($_COOKIE['email'])){
                    $query = "SELECT * FROM cart WHERE userid='".$uqr['id']."' AND orderid='".$_SESSION['orderid']."' AND status='Open' ORDER BY date DESC";
                    } else {
                    $query = "SELECT * FROM cart WHERE orderid='".$_SESSION['orderid']."' AND status='Open' ORDER BY date DESC";
                    }
                    $qq = mysqli_query($con, $query);
                    if (mysqli_num_rows($qq) == 0){
                    echo '<div style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />Your cart is empty.<br /><a href="shop.php"><span style="font-size:14px;color:#00b207">Start Shopping Now!</span></a></div>';
                    }
                    while ($value = mysqli_fetch_array($qq)){

                    $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$value['productid']."'");
                    $pqr = mysqli_fetch_assoc($pqq);
                    ?>
                    <tr class="cartitem">
                      <!-- Product item  -->
                      <td class="cart-table-item align-middle">
                        <a
                          href="product.php?pid=<?php echo $pqr['id']; ?>"
                          class="cart-table__product-item"
                        >
                          <div class="cart-table__product-item-img">
                            <img
                              src="<?php echo $pqr['photo']; ?>"
                              alt="<?php echo $pqr['product']; ?>"
                            />
                          </div>
                          <h5 class="font-body--lg-400" style="font-size:14px"><?php echo $pqr['product']; ?></h5>
                        </a>
                      </td>
                      <!-- Price  -->
                      <td class="cart-table-item order-date align-middle">
                        N<?php echo number_format($value['price'], 0); ?>
                      </td>
                      <!-- quantity -->
                      <td class="cart-table-item order-total align-middle">
                        <div class="counter-btn-wrapper">
                          <button
                            class="counter-btn-dec counter-btn"
                            data-cart-id="<?php echo $value['id']; ?>"
                            data-price="<?php echo $value['price']; ?>"
                            data-qty="<?php echo $value['qty']; ?>"
                          >
                            -
                          </button>
                          <input
                            data-price="<?php echo $value['price']; ?>"
                            type="number"
                            id="counter-btn-counter"
                            class="counter-btn-counter"
                            min="0"
                            max="1000"
                            value="<?php echo $value['qty']; ?>"
                          />
                          <button
                            class="counter-btn-inc counter-btn"
                            data-cart-id="<?php echo $value['id']; ?>"
                            data-price-inc="<?php echo $value['price']; ?>"
                            data-qty="<?php echo $value['qty']; ?>"
                          >
                            +
                          </button>
                        </div>
                      </td>
                      <!-- Subtotal  -->
                      <td class="cart-table-item order-subtotal align-middle">
                        <div
                          class="
                            d-flex
                            justify-content-between
                            align-items-center
                          "
                        >
                          <p class="font-body--md-500">N<span class="subttl" id="subttl"><?php echo number_format($value['price'] * $value['qty'], 0); ?></span></p>
                          <button class="delete-item">
                            <svg
                              width="24"
                              height="25"
                              viewBox="0 0 24 25"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                              class="remove" id1="<?php echo $value['id']; ?>" data-cart-total="<?php echo $orderttl; ?>" data-product-price="<?php echo $pqr['price']; ?>" data-qty="<?php echo $value['qty']; ?>"
                            >
                              <path
                                d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                stroke="#CCCCCC"
                                stroke-miterlimit="10"
                              />
                              <path
                                d="M16 8.5L8 16.5"
                                stroke="#666666"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M16 16.5L8 8.5"
                                stroke="#666666"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php }} else{
                    echo '<div style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />Your cart is empty.<br /><a href="shop.php"><span style="font-size:14px;color:#00b207">Start Shopping Now!</span></a></div>';
                    } ?>
                  </tbody>
                </table>
              </div>
              <!-- Action Buttons  -->
              <form action="#">
                <div class="cart-table-action-btn d-flex">
                  <a
                    href="shop.php"
                    class="button button--md shop"
                    >Return to Shop</a
                  >
                  <a href="cart.php" class="button button--md update"
                    >Update to Cart</a
                  >
                </div>
              </form>
            </div>

            <div class="shoping-cart__mobile">
              <?php
              if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
              $query = "SELECT * FROM cart WHERE userid='".$uqr['id']."' AND orderid='".$_SESSION['orderid']."' AND status='Open' ORDER BY date DESC";
              $qq = mysqli_query($con, $query);
              if (mysqli_num_rows($qq) == 0){
              echo '<div style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />Your cart is empty.<br /><a href="shop.php"><span style="font-size:14px;color:#00b207">Start Shopping Now!</span></a></div>';
              }
              while ($value = mysqli_fetch_array($qq)){

              $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$value['productid']."'");
              $pqr = mysqli_fetch_assoc($pqq);
              ?>
              <div class="shoping-card">
                <div class="shoping-card__img-wrapper">
                  <img
                    src="<?php echo $pqr['photo']; ?>"
                    alt="<?php echo $pqr['product']; ?>"
                  />
                </div>
                <h5 class="shoping-card__product-caption font-body--lg-400">
                  <?php echo $pqr['product']; ?>
                </h5>

                <h6 class="shoping-card__product-price font-body--lg-400">
                    N<?php echo number_format($value['price'], 0); ?>
                </h6>

                <div class="counter-btn-wrapper">
                  <button
                            class="counter-btn-dec-mobile counter-btn"
                            data-cart-id="<?php echo $value['id']; ?>"
                            data-price="<?php echo $value['price']; ?>"
                            data-qty="<?php echo $value['qty']; ?>"
                          >
                            -
                          </button>
                  <input
                  data-price="<?php echo $value['price']; ?>"
                    type="number"
                    id="counter-btn-counter-mobile"
                    class="counter-btn-counter"
                    min="0"
                    max="1000"
                    value="<?php echo $value['qty']; ?>"
                  />
                  <button
                            class="counter-btn-inc-mobile counter-btn"
                            data-cart-id="<?php echo $value['id']; ?>"
                            data-price-inc="<?php echo $value['price']; ?>"
                            data-qty="<?php echo $value['qty']; ?>"
                          >
                            +
                          </button>
                </div>
                <h6 class="shoping-card__product-totalprice font-body--lg-600">
                  N<span class="subttl" id="subttl-mobile"><?php echo number_format($value['price'] * $value['qty'], 0); ?></span>
                </h6>
                <button class="close-btn">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z"
                      stroke="#CCCCCC"
                      stroke-miterlimit="10"
                    />
                    <path
                      d="M16 8L8 16"
                      stroke="#666666"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M16 16L8 8"
                      stroke="#666666"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </button>
              </div>
            <?php }} ?>

            <form action="#">
              <div class="cart-table-action-btn d-flex">
                <a
                  href="shop.php"
                  class="button button--md shop"
                  >Return to Shop</a
                >
                <a href="cart.php" class="button button--md update"
                  >Update to Cart</a
                >
              </div>
            </form>
            </div>

            <!-- newsletter  -->
            <div class="newsletter-card">
              <h5 class="newsletter-card-title font-body--xxl-500">
                Coupon
              </h5>
              <form action="#">
                <div class="newsletter-card__input">
                  <input type="text" placeholder="Enter Code " />
                  <button class="button button--lg" type="submit">
                    Apply Coupon
                  </button>
                </div>
              </form>
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
                  <!-- memo  -->
                  <div class="bill-card__memo">
                    <!-- Subtotal  -->
                    <div class="bill-card__memo-item subtotal">
                      <p class="font-body--md-400">Subtotal:</p>
                      <span class="font-body--md-500">N<span id="cart-subttl"><?php echo number_format($orderttl, 2); ?></span></span>
                    </div>
                    <!-- Shipping  -->
                    <div class="bill-card__memo-item shipping">
                      <p class="font-body--md-400">VAT <?php echo $stqr['vat']; ?>%:</p>
                      <span class="font-body--md-500">N<span id="cart-vat"><?php echo number_format($vat, 2); ?></span></span>
                    </div>
                    <!-- total  -->
                    <div class="bill-card__memo-item total">
                      <p class="font-body--lg-400">Total:</p>
                      <span class="font-body--xl-500">N<span id="cart-total"><?php echo number_format($orderttl + $vat, 2); ?></span></span>
                    </div>
                  </div>
                      <button
                      onclick="location.href='checkout.php?v=<?php echo $vqr['id']; ?>';"
                      class="button button--lg w-100"
                      style="margin-top: 20px"
                      type="submit"
                    >
                      Proceed to Checkout
                    </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End    -->

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
