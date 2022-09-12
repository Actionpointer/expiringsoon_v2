<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

$catid = $_POST['catid'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
// Add to Cart
$.noConflict();
$(function() {
$(".add-to-cart").click(function(){
alert("Item was added to your Cart");
var element = $(this);
var pid = element.attr("id3");
var price = element.attr("data-price");
var info = 'id3=' + pid + '&price=' + price;
 $.ajax({
   type: "GET",
   url: "process.php",
   data: info,
   success: function(){
    $(".cart-counter").text(parseInt($(".cart-counter").text()) + 1);
   }
 });
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
</script>

<div class="row shop__product-items">
  <?php
  // Fetch Products
  if($catid == 'All'){
  $query = "SELECT * FROM products WHERE status='Listed' ORDER BY uploaded DESC LIMIT 200";
  } else {
  $query = "SELECT * FROM products WHERE cat_id='$catid' AND status='Listed' ORDER BY uploaded DESC LIMIT 200";
  }
  $proddata = mysqli_query($con,$query);
  if (mysqli_num_rows($proddata) == 0){
  echo '<div style="margin:auto;padding:10%;text-align:center"><img style="padding:10px;width:100px" src="img/exclamation.png"><br />No Products in this Category</span></a></div>';
  }
  while($row = mysqli_fetch_array($proddata)){
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
  ?>
  <div class="col-lg-3 col-md-6">
      <div class="cards-md cards-md--four w-100">
          <div class="cards-md__img-wrapper">
            <a href="product.php?pid=<?php echo $row['id']; ?>">
                <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['product']; ?>" />
            </a>
            <?php if($row['expiry']!='') { ?>
            <span class="tag danger font-body--md-400" style="background:#00b207;font-size:13px">Sale <?php echo $discount; ?>%</span>
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
                    <?php if($row['expiry']!='') { ?>
                      <span class="font-body--lg-500">N<?php echo number_format($sale, 0); ?></span>
                      <del class="font-body--lg-400" style="color:#00b207">N<?php echo number_format($row['price'], 0); ?></del>
                    <?php } else { ?>
                      <span class="font-body--lg-500">N<?php echo number_format($row['price'], 0); ?></span>
                  <?php } ?>
                  </div>
                  <ul class="d-flex" style="color:#888;font-size:12px">
                    <?php if($row['expiry']!='') { ?>
                    <li>Expires in <span style="font-weight:550;color:#00b207"><?php echo $numberDays; ?> days</span><li>
                    <?php } else { ?>
                      <li>&nbsp;</li>
                    <?php } ?>
                  </ul>
              </a>
              <div class="cards-md__info-right">
                  <span class="action-btn">
                    <?php if($row['expiry']!='') { ?>
                      <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="<?php echo $row['id']; ?>" data-price="<?php echo $sale; ?>">
                      <?php } else { ?>
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="<?php echo $row['id']; ?>" data-price="<?php echo $row['price']; ?>">
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
              </div>
          </div>
      </div>
  </div>
  <?php } ?>
</div>
