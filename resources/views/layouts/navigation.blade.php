@switch(auth()->user()->role->name)
    @case('shopper')
        @include('layouts.customer_navigation')
    @break

    @case('vendor')
        @include('layouts.vendor_navigation')
    @break

    @case('staff')
        @include('layouts.shop_navigation')
    @break

    @default
        @include('layouts.admin_navigation')
@endswitch