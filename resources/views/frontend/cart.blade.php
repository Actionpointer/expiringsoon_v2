@extends('layouts.app')
@push('styles')
@endpush
@section('title')Shopping Cart | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
      <div class="breedcrumb__img-wrapper">
        <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
        <div class="container">
          <ul class="breedcrumb__content">
            <li>
              <a href="{{route('index')}}">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                  <path ="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
            </svg>
                <span> > </span>
              </a>
            </li>
            <li>
              <a href="{{route('home')}}">
                Account
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="{{route('wishlist')}}">Wishlist</a></li>
          </ul>
        </div>
      </div>
  </div>
    <!-- breedcrumb section end   -->

  <!-- Shopping Cart Section Start   -->
  @include('layouts.session')
  <section class="shoping-cart section section--xl">
    <div class="container">
      <div class="section__head justify-content-center">
        <h2 class="section--title-four font-title--sm">My Shopping Cart</h2>
      </div>
      <div class="row shoping-cart__content">
        <div class="col-lg-8">
          @forelse ($shops as $shop)
            <div class="cart-table shop-cart">
              <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr><th colspan="4" class="cart-table-title">Shop: {{$shop->name}}</th></tr>
                      <tr>
                        <th scope="col" class="cart-table-title">Product</th>
                        <th scope="col" class="cart-table-title">Price</th>
                        <th scope="col" class="cart-table-title">quantity</th>
                        <th scope="col" class="cart-table-title">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach(collect($items)->where('shop_id',$shop->id) as $key=>$cart)
                            <tr class="item" data-product="{{$key}}product" data-price="{{$cart['product']->amount}}" data-amount="{{$cart['product']->amount * $cart['quantity']}}" data-qty="{{$cart['quantity']}}">
                                <!-- Product item  -->
                                <td class="cart-table-item align-middle">
                                    <a href="{{route('product.show',$cart['product'])}}" class="cart-table__product-item">
                                        <div class="cart-table__product-item-img">
                                        <img src="{{Storage::url($cart['product']->photo)}}" alt="product">
                                        </div>
                                        <h5 class="font-body--lg-400">{{$cart['product']->name}}</h5>
                                    </a>
                                </td>
                                <!-- Price  -->
                                <td class="cart-table-item order-date align-middle">
                                    {!!cache('settings')['currency_symbol']!!}{{number_format($cart['product']->amount, 2)}}
                                </td>
                                <!-- quantity -->
                                <td class="cart-table-item order-total align-middle">
                                    <div class="counter-btn-wrapper">
                                        <button class="counter-btn-dec counter-btn" data-action="decrement">
                                        -
                                        </button>
                                        <input type="number" class="counter-btn-counter quantity" data-slug="qtyfor{{$key}}" min="1" max="1000" placeholder="1" value="{{$cart['quantity']}}">
                                        <button class="counter-btn-inc counter-btn" data-action="increment">
                                        +
                                        </button>
                                    </div>
                                </td>
                                <!-- Subtotal  -->
                                <td class="cart-table-item order-subtotal align-middle">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="font-body--md-500">{!!cache('settings')['currency_symbol']!!} <span class="product-total">{{$cart['total']}}</span> </p>
                                        <button class="delete-item remove-item" data-product="{{$key}}product">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                            <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                  </table>               
              </div>
              <!-- Action Buttons  -->
              <form action="{{route('checkout')}}" method="POST">@csrf
                <div class="cart-table-action-btn d-flex">
                  <a href="{{route('vendor.show',$shop)}}" class="button button--md shop">Return to Shop</a>
                  <input type="hidden" name="shop_id" value="{{$shop->id}}">
                  <button type="submit" class="button button--md update bg-success text-white">Checkout: {!!cache('settings')['currency_symbol']!!}<span class="subtotal mx-0">{{collect($items)->where('shop_id',$shop->id)->sum('total')}}</span></button>
                </div>
              </form>
            </div>
          @empty
            <div id="cart-empty" style="margin:auto;padding:10%;text-align:center">
                <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                <br/>Your cart is empty.<br />
                <a href="{{route('product.list')}}">
                    <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
                </a>
            </div>
          @endforelse
          <div id="cart-empty" style="margin:auto;padding:10%;text-align:center;display:none">
            <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
            <br/>Your cart is empty.<br />
            <a href="{{route('product.list')}}">
                <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
            </a>
          </div>
          <div class="shoping-cart__mobile">
            @forelse(collect($items) as $key=>$cart)
              <div class="shoping-card">
                <div class="shoping-card__img-wrapper">
                  <img src="./storage/{{$cart['product']->photo}}" alt="product-item">
                </div>
                <h5 class="shoping-card__product-caption font-body--lg-400">
                  {{$cart['product']->name}}
                </h5>

                <h6 class="shoping-card__product-price font-body--lg-400">
                  {!!cache('settings')['currency_symbol']!!}{{number_format($cart['product']->amount, 2)}}
                </h6>

                <div class="counter-btn-wrapper">
                  <button class="counter-btn-dec counter-btn" data-action="decrement">
                    -
                  </button>
                  <input type="number" class="counter-btn-counter quantity" data-slug="qtyfor{{$key}}" min="1" max="1000" value="{{$cart['quantity']}}" placeholder="0">
                  <button class="counter-btn-inc counter-btn" data-action="increment">
                    +
                  </button>
                </div>
                <h6 class="shoping-card__product-totalprice font-body--lg-600">
                  {!!cache('settings')['currency_symbol']!!} <span class="product-total"></span> {{$cart['total']}}
                </h6>
                <button class="close-btn remove-item" data-product="{{$key}}product">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                    <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </button>
              </div>
            @empty
            <div class="cart-empty" style="margin:auto;padding:10%;text-align:center">
                <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                <br/>Your cart is empty.<br />
                <a href="{{route('product.list')}}">
                    <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
                </a>
            </div>
            @endforelse
            <div class="cart-table-action-btn justify-content-center">
              <a href="{{route('product.list')}}" class="button button--md shop">Continue Shopping</a>
            </div>
          </div>

        </div>

        <div class="col-lg-4">
          <div class="bill-card">
            <div class="bill-card__content">
              <div class="bill-card__header">
                <h2 class="bill-card__header-title font-body--xxl-500">
                  Cart Summary
                </h2>
              </div>
              <div class="bill-card__body">
                <!-- memo  -->
                <div class="bill-card__memo">
                  <!-- Subtotal  -->
                  <div class="bill-card__memo-item">
                    <p class="font-body--md-400">No of Items:</p>
                    <span id="items_count" class="font-body--md-500">{{collect($items)->count()}}</span>
                  </div>
                  
                  <div class="bill-card__memo-item">
                    <p class="font-body--md-400">No of Shops :</p>
                    <span id="shops_count" class="font-body--md-500">{{$shops->count()}}</span>
                  </div>
                  <!-- total  -->
                  <div class="bill-card__memo-item total">
                    <p class="font-body--lg-400">Total:</p>
                    <span class="font-body--xl-500">
                      {!!cache('settings')['currency_symbol']!!} 
                      <span id="grandtotal">
                        {{number_format(collect($items)->sum('total'))}}
                      </span>
                      
                    </span>
                  </div>
                </div>
                @if($shops->isNotEmpty())
                <form action="{{route('checkout')}}" method="POST">@csrf
                  <input type="hidden" name="shop_id" value="0">
                  <button type="submit" class="button button--lg w-100" style="margin-top: 20px" type="submit">
                    Place Order
                  </button>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Shopping Cart Section End    -->
  
@endsection
@push('scripts')
@include('layouts.front')
<script>
  $('.counter-btn').click(function(){
      let clicked = $(this).closest('.counter-btn-wrapper').find('.quantity');
      let quantity = parseInt($(this).closest('.counter-btn-wrapper').find('.quantity').val());
      if($(this).attr('data-action') == 'increment'){
        newquantity = quantity + 1
      }
      else{
        newquantity = quantity - 1
        if(newquantity <=0) newquantity = 1;
      }
      updatecart(clicked.closest(".item").attr('data-product'),newquantity);
      total(clicked,newquantity);
      mysubtotal(clicked.closest('.shop-cart'));
      mygrandtotal();
  })
  function total(clicked,newquantity){
    $('.quantity[data-slug="'+clicked.attr('data-slug')+'"]').val(newquantity);
    price = parseInt(clicked.closest('.item').attr('data-price'))
    amount = price * newquantity
    clicked.closest('.item').find('.product-total').text(amount);
    clicked.closest('.item').attr('data-amount',amount);
    clicked.closest('.item').attr('data-qty',newquantity);
  }
  function mysubtotal(shopcart){
      let subtotal = 0;
      shopcart.find('.item').each(function(index){
          subtotal += parseInt($(this).attr('data-amount'));
      });
      shopcart.find('.subtotal').text(subtotal);
  }
  function mygrandtotal(){
    let grandtotal = 0;
      $('.item').each(function(index){
          grandtotal += parseInt($(this).attr('data-amount'));
      });
      $('#items_count').text($('.item').length)
      $('#shops_count').text($('.shop-cart').length)
      $('#grandtotal').text(grandtotal);
  }
  $(document).on('change input','.quantity',function(){
      var clicked = $(this); //get the quantity
      if($(this).val() != ''){
        updatecart(clicked.closest(".item").attr('data-product'),$(this).val());
        total($(this),parseInt($(this).val())); 
        mysubtotal(clicked);
        mygrandtotal();
      }
      
  })
  $(document).on('click','.remove-item',function(){
    let product_id = parseInt($(this).attr('data-product'));
    let shopcart = $(this).parents(".shop-cart")
    if($(this).closest('.shop-cart').find('.item').length > 1){
      $(this).parents(".item,.shoping-card").animate({ backgroundColor: "#fff" }, "fast").animate({ opacity: "hide" }, "slow");
      $(this).parents(".item,.shoping-card").remove()
    }else{
      $(this).parents(".shop-cart").animate({ backgroundColor: "#fff" }, "fast").animate({ opacity: "hide" }, "slow");
      $(this).parents(".shop-cart").remove()
    }
    if($(".shop-cart").length == 0){
      $('#cart-empty').show()
    }
    mysubtotal(shopcart)
    mygrandtotal()
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
                                            <img src="`+ '/storage/'+value.product.photo +`" alt="`+ value.product.name +`">
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
            //adjust all the subtotals and grandtotals here
        },
        error: function (data, textStatus, errorThrown) {
        console.log(data);
        },
    });
});

</script>
{{-- <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script> --}}
@endpush
