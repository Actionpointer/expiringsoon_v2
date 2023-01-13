@if(auth()->user()->role == 'shopper')
    @include('customer.navigation')
@endif
@if(auth()->user()->role == 'vendor')
    
    @if(auth()->user()->subscription_id)
        @include('vendor.navigation')
    @else  
        @include('shop.navigation')
    @endif


@endif
@if(in_array(auth()->user()->role,['admin','customercare','security']))
    @include('admin.navigation')
@endif