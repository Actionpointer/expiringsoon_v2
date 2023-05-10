<div class="shopping-cart">
    <div class="shopping-cart-top">
        <div class="shopping-cart-header">
            <h5 class="font-body--xxl-500">Shopping Cart (<span class="count cart-ttl">{{Session::has('carts') ? session('carts')->count(): 0}}</span>)</h5>
            <button class="close">
                <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="22.5" cy="22.5" r="22.5" fill="white" />
                        <path d="M28.75 16.25L16.25 28.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.25 16.25L28.75 28.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div id="cartitems"> 
            @if(Session::has('carts'))
                @foreach(session('carts') as $cart)
                <div class="shopping-cart__product-content cartitem">
                    <div class="shopping-cart__product-content-item">
                        <div class="img-wrapper">
                            <img src="{{$cart['image']}}" alt="{{$cart['name']}}" />
                        </div>
                        <div class="text-content">
                            <h5 class="font-body--md-400 product-title">{{$cart['name']}}</h5>
                            <p class="font-body--md-400">{{$cart['quantity']}} x <span class="font-body--md-500">{!!session('locale')['currency_symbol']!!}{{number_format($cart['amount'], 2)}}</span></p>
                        </div>
                    </div>
                    <button class="delete-item remove-from-cart" data-product="{{$cart['product_id']}}product" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                            <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10" />
                            <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                @endforeach
            @else
                <div class="cart-empty" style="margin:auto;padding:10%;text-align:center">
                    <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                    <br/>Your cart is empty.<br />
                    <a href="{{route('product.list')}}">
                        <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
                    </a>
                </div>
            @endif
	
        </div>
        
        <div class="cart-empty" style="margin:auto;padding:10%;text-align:center;display:none;">
            <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
            <br/>Your cart is empty.<br />
            <a href="{{route('product.list')}}">
                <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
            </a>
        </div>
        <div class="shopping-cart-bottom">
            <div class="shopping-cart-product-info">
                <p class="product-count font-body--lg-400"><span class="cart-ttl">{{Session::has('carts') ? session('carts')->count() : 0}}</span> Items</p>
                <span class="product-price font-body--lg-500">
                    {!!session('locale')['currency_symbol']!!}
                    <span class="cart-ttl-amount">{{number_format($total,2)}}</span>
                </span>
            </div>
            
            <a href="{{route('checkout')}}" class="button button--lg w-100 text-center my-2">Checkout</a>
            
            <a class="button button--lg w-100 text-center" href="{{route('cart')}}" style="background: #56ac591a;color:#00b207;">Go to Cart</a>
        </div>
    </div>
    <!-- Shopping Cart sidebar end -->
</div>