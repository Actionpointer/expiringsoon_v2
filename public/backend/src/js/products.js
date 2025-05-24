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
// $.noConflict();
$(function() {
    $(".add-to-cart").click(function(){
        alert("Item was added to your Cart");
        var element = $(this);
        var pid = element.attr("id3");
        var imgurl = element.attr("data-photo");
        var product = element.attr("data-product");
        var price = element.attr("data-price");
        // alert(pid);

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

// Filter Products by category
function filterProducts(){
    var val = document.getElementById('category').value;
    var sel = $("#category option:selected").text();
    // alert(val);
    $.post("getProducts.php",{catid:val}, function(data){
        $('#loadproducts').fadeIn('slow');
        $("#loadproducts").html(data);
        $('#active').text(sel);
        $('#active2').text(sel);
    });

    $.post("getCount.php",{catid:val}, function(data){
        $("#showcount").html(data);
    });
}

// Filter Products by category
function filterPrices(){
    var sel = $("#price option:selected").text();
    $('#activeprice').text(sel);
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
// Remove from Wishlist
$(function() {
    $(".delete-item").click(function(){

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

        }
        });
        $(this).parents(".likeditem").animate({ backgroundColor: "#fff" }, "fast")
        .animate({ opacity: "hide" }, "slow");

        return false;
    });
});

// Search SUggest
    $(document).ready(function(){
        $('#searchid').keyup(function (){
        var searchid = $(this).val();
        var dataString = 'search='+ searchid;
        if(searchid!=''){
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
        }
        });
    });
  
  $(document).on("click","#result",function(e){
      var $clicked = $(e.target);
      var $name = $clicked.find('.name').html();
      var decoded = $("<div/>").html($name).text();
      $('#searchid').val(decoded);
  });
  $(document).on("click", function(e) {
      var $clicked = $(e.target);
      if (! $clicked.hasClass("search")){
      jQuery("#result").fadeOut();
      }
  });
  $('#searchid').click(function(){
      jQuery("#result").fadeIn();
  });
  
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
  });