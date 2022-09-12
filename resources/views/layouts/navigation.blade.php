@if(auth()->user()->role == 'shopper')
    @include('customer.navigation')
@endif
@if(auth()->user()->role == 'vendor')
    @if(auth()->user()->staff->where('role','owner')->isNotEmpty())
    @include('vendor.navigation')
    @else
    @include('shop.navigation')
    @endif
@endif
@if(in_array(auth()->user()->role,['admin','customercare','security']))
    @include('admin.navigation')
@endif