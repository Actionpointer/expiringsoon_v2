<script>
$(document).on('click','.add-to-cart',function(){
    var product_id = parseInt($(this).attr('data-product'));
    // var imgurl = $(this).attr("data-photo");
    // var product = $(this).attr("data-product");
    // var price = $(this).attr("data-price");
    // alert(product_id);
    $.ajax({
        type:'POST',
        dataType: 'json',
        url: "{{route('product.addtocart')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'product_id': product_id
        },
        success:function(data) {
                // console.log(data.cart);
                var cart_total = 0;
                $(".cart-counter").text(data.cart_count);
                $(".ec-cart-count").text(data.cart_count);
                $(".cart-ttl").text(data.cart_count);
                $('#cartitems').html('');
                $.each( data.cart, function( key, value ) {
                    cart_total += parseInt(value['quantity']) * parseInt(value['amount']);
                    var cartitem = `<div class="shopping-cart__product-content cartitem">
                                        <div class="shopping-cart__product-content-item">
                                            <div class="img-wrapper">
                                                <img src="`+ window.location.origin+ '/storage/'+value.product.photo +`" alt="`+ value.product.name +`">
                                            </div>
                                            <div class="text-content">
                                                <h5 class="font-body--md-400 product-title">`+ value.product.name + `</h5>
                                                <p class="font-body--md-400">`+ value.quantity + ` x <span class="font-body--md-500">N`+ value.amount.toLocaleString() +`</span></p>
                                            </div>
                                        </div>
                                        <button class="delete-item">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove-from-cart" data-product="`+ key +`product">
                                                <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                                <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>`
                    // Update cart items
                    $('#cartitems').append(cartitem);
                });
                $('.cart-ttl-amount').text(cart_total.toLocaleString());
                // Show cart popup
                $(".ec-cart-float").fadeIn();
                // Remove Empty message
                $(".cart-empty").hide();

                // Hide Cart Popup
                setTimeout(function(){
                    $(".ec-cart-float").fadeOut();
                }, 3000);
            
        },
        error: function (data, textStatus, errorThrown) {
        console.log(data);
        },
    });
});   

$(document).on('click','.remove-from-cart',function(){
    var product_id = parseInt($(this).attr('data-product'));

    $.ajax({
        type:'POST',
        dataType: 'json',
        url: "{{route('product.removefromcart')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'product_id': product_id
        },
        success:function(data) {
            console.log(data.cart);
            if(!data.cart_count){
                $(".cart-empty").show();
            }
            var cart_total = 0;
            $(".cart-counter").text(data.cart_count);
            $(".ec-cart-count").text(data.cart_count);
            $(".cart-ttl").text(data.cart_count);
            $('#cartitems').html('');
            $.each( data.cart, function( key, value ) {
                cart_total += parseInt(value['quantity']) * parseInt(value['amount']);
                var cartitem = `<div class="shopping-cart__product-content cartitem">
                                    <div class="shopping-cart__product-content-item">
                                        <div class="img-wrapper">
                                            <img src="`+ window.location.origin+'/storage/'+value.product.photo +`" alt="`+ value.product.name +`">
                                        </div>
                                        <div class="text-content">
                                            <h5 class="font-body--md-400 product-title">`+ value.product.name + `</h5>
                                            <p class="font-body--md-400">`+ value.quantity + ` x <span class="font-body--md-500">N`+ value.amount.toLocaleString() +`</span></p>
                                        </div>
                                    </div>
                                    <button class="delete-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove-from-cart" data-product="`+ key +`product">
                                            <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                            <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>`
                // Update cart items
                $('#cartitems').append(cartitem);
            });
            $('.cart-ttl-amount').text(cart_total.toLocaleString());
        },
        error: function (data, textStatus, errorThrown) {
        console.log(data);
        },
    });
});   

$(document).on('click','.add-to-wish',function(){
    var product_id = parseInt($(this).attr('data-product'));
    $.ajax({
        type:'POST',
        dataType: 'json',
        url: "{{route('product.addtowish')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'product_id': product_id
        },
        success:function(data) {
            $('.wish-counter').html(data.wish_count);
            $('.wish-counter').show();
            $(".ec-wish-float").fadeIn();
            setTimeout(function(){
                $(".ec-wish-float").fadeOut();
            }, 3000);
        },
        error: function (data, textStatus, errorThrown) {
        console.log(data);
        },
    });
});

$(document).on('click','.remove-from-wish',function(){
    var product_id = parseInt($(this).attr('data-product'));
    $(this).parents(".likeditem").animate({ backgroundColor: "#fff" }, "fast")
            .animate({ opacity: "hide" }, "slow");
    $.ajax({
        type:'POST',
        dataType: 'json',
        url: "{{route('product.removefromwish')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'product_id': product_id
        },
        success:function(data) {
            if(data.wish_count){
                $('.wish-counter').html(data.wish_count);
                $('.wish-counter').show();
            }else{
                $('#wishlist-empty').show();
            }
        },
        error: function (data, textStatus, errorThrown) {
        console.log(data);
        },
    });
});

function updatecart(product_id,quantity){
    $.ajax({
        type:'POST',
        dataType: 'json',
        url: "{{route('product.addtocart')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'product_id': product_id,
            'quantity': quantity,
            'update': true,
        },
        success:function(data) {
                // console.log(data.cart);
                var cart_total = 0;
                $(".cart-counter").text(data.cart_count);
                $(".ec-cart-count").text(data.cart_count);
                $(".cart-ttl").text(data.cart_count);
                $('#cartitems').html('');
                $.each( data.cart, function( key, value ) {
                    cart_total += parseInt(value['quantity']) * parseInt(value['amount']);
                    var cartitem = `<div class="shopping-cart__product-content cartitem">
                                        <div class="shopping-cart__product-content-item">
                                            <div class="img-wrapper">
                                                <img src="`+ window.location.origin+ '/storage/'+value.product.photo +`" alt="`+ value.product.name +`">
                                            </div>
                                            <div class="text-content">
                                                <h5 class="font-body--md-400 product-title">`+ value.product.name + `</h5>
                                                <p class="font-body--md-400">`+ value.quantity + ` x <span class="font-body--md-500">N`+ value.amount.toLocaleString() +`</span></p>
                                            </div>
                                        </div>
                                        <button class="delete-item">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove-from-cart" data-product="`+ key +`product">
                                                <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                                <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>`
                    // Update cart items
                    $('#cartitems').append(cartitem);
                });
                $('.cart-ttl-amount').text(cart_total.toLocaleString());
                $(".cart-empty").hide();
            
        },
        error: function (data, textStatus, errorThrown) {
        console.log(data);
        },
    });
} 

</script>
