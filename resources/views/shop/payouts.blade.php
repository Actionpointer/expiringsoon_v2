@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

@endpush
@section('title') {{$shop->name}} Payouts | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg
                width="18"
                height="19"
                viewBox="0 0 18 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
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
          <li class="active"><a href="#">Payouts</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('shop.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
              <p class="font-body--xl-500">Payouts</p>
              <a href="#" class="font-body--lg-500">N{{ number_format($shop->wallet, 2)}} Balance</a>
            </div>
            <div class="container">
                
                <!-- Products -->
                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                        <th scope="col" class="cart-table-title">Date</th>
                        <th scope="col" class="cart-table-title">Amount</th>
                        <th scope="col" class="cart-table-title">Status</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shop->payouts as $payout)
                            <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                <!-- item  -->
                                <td class="cart-table-item order-date align-middle">
                                    <span style="font-size:12px;color:#888">{{ $payout->created_at->format('l, F d, Y')}}</span>
                                </td>
                                <!-- Price  -->
                                <td class="cart-table-item order-date align-middle">
                                    <p class="font-body--lg-500" style="color:#00b207">N{{ number_format($payout->amount, 2)}}</p>
                                </td>
                                <!-- Stock Status  -->
                                <td class="cart-table-item order-date align-middle">
                                    
                                    @if($payout->status =='pending')
                                        <p style="color:#d92e2e;font-size:14px"><span id="status">{{ $payout->status}}</span></p>
                                    @else
                                        <p style="color:#00b207;font-size:14px;font-weight:500">{{ $payout->status}}</p>
                                    @endif
                                </td>
                                <td class="cart-table-item add-cart align-middle">
                                    <div class="add-cart__wrapper">
                                    <a href="#" class="cart-table__product-item approve" id="{{ $payout->id}}" >
                                        @if($payout->status =='pending')
                                            <span class="iconify" style="color:#00b207" data-icon="akar-icons:check-box-fill" data-width="25" data-height="25">
                                        @endif
                                    </a>
                                    </div>
                                </td>
                            </tr>   
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                                <br />No Payouts Requests at this time.</span>
                            </div>
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