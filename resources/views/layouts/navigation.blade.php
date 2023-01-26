@if(auth()->user()->role == 'shopper')
    @include('layouts.customer_navigation')
@endif
@if(auth()->user()->role == 'vendor')
    
    @if(auth()->user()->subscription_id)
        @include('layouts.vendor_navigation')
    @else  
        @include('layouts.shop_navigation')
    @endif


@endif
@if(in_array(auth()->user()->role,['admin','customercare','security']))
    @include('admin.navigation')
@endif