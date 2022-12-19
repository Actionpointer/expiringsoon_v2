@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

@endpush
@section('title') Manage Shipping | Expiring Soon @endsection
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
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
                <span> > </span>
                </a>
            </li>
            <li>
                <a href="#">
                Admin
                <span> > </span>
                </a>
            </li>
            <li class="active"><a href="#">Shipping</a></li>
            </ul>
        </div>
        </div>
    </div>
    <!-- breedcrumb section end   -->
    @include('layouts.session')
    <div class="dashboard section">
        <div class="container">
        <div class="row dashboard__content">
            @include('admin.navigation')
            <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
                <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
                <p class="font-body--xl-500">Shipping History</p>
                <a href="#" class="font-body--lg-500">{!!cache('settings')['currency_symbol']!!}{{number_format($shippings->count(), 2)}} Total</a>
                </div>
                <div class="container">
                <div style="margin-bottom:10px;border-bottom:1px solid #ddd;padding-bottom:10px">
                    <a href="{{route('admin.payouts')}}" style="font-size:13px;color:#00b207;font-weight:500">Payout Requests</a> | 
                    <a href="{{route('admin.shipping')}}" style="font-size:13px;color:#00b207;font-weight:500">Shipping Settlements</a>
                </div>
                <!-- Products -->
                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                    <tr>
                        <th scope="col" class="cart-table-title">Order ID</th>
                        <th scope="col" class="cart-table-title">Amount</th>
                        <th scope="col" class="cart-table-title">Status</th>
                        <th scope="col" class="cart-table-title">
                        <a href="#" class="cart-table__product-item" id="payAll" data-action="payall" >
                        <span class="iconify" style="color:#000" data-icon="akar-icons:check-box-fill" data-width="25" data-height="25">
                        </a>
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($shippings as $shipping)    
                        <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                            <!-- item  -->
                            <td class="cart-table-item order-date align-middle">
                            <div style="margin-top:10px">
                            <span class="font-body--lg-500">
                                <a href="{{route('admin.invoice')}}" style="color:#00b207">#{{$shipping->orderid}}</a></span></div>
                            </td>
                            <!-- Price  -->
                            <td class="cart-table-item order-date align-middle">
                            <p class="font-body--lg-500" style="color:#000">{!!cache('settings')['currency_symbol']!!}{{number_format($shipping->amount, 2)}}</p>
                            </td>
                            <!-- Stock Status  -->
                            <td class="cart-table-item order-date align-middle">
                            <span style="font-size:12px;color:#888">{{$shipping->created_at->format('l, F d, Y')}}</span>
                            @if($shipping->status =='pending')
                                <p style="color:#d92e2e;font-size:14px"><span id="status">{{$shipping->status}}</span></p>
                            @else
                                <p style="color:#00b207;font-size:14px;font-weight:500">{{$shipping->status}}</p>
                            @endif
                            </td>
                            <td class="cart-table-item add-cart align-middle">
                            <div class="add-cart__wrapper">
                                <a href="#" class="cart-table__product-item approve" id="{{$shipping->id}}" >
                                @if($shipping->status =='pending')
                                    <span class="iconify" style="color:#00b207" data-icon="akar-icons:check-box-fill" data-width="25" data-height="25">
                                @endif
                                </a>
                            </div>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                    
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush