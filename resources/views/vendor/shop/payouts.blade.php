@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

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
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Shop
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Payouts</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header d-flex justify-content-between">
                  <h5 class="font-body--xl-500">Request Payout</h5>
                  <a href="#" class="font-body--lg-500 text-dark">{!!$shop->country->currency->symbol!!}{{ number_format($shop->wallet, 2)}}<span class="text-success"> Balance</span> </a>
              </div>
              <div class="dashboard__content-card-body">
                @if($shop->user->payout_account || $shop->user->bankaccount)
                  <form method="post" action="{{route('vendor.shop.payout',$shop)}}">@csrf
                    <div class="contact-form__content">
                      <div class="contact-form__content-group">
                        <div class="contact-form-input"> 
                          <label for="address">Enter Amount *</label>
                          <input type="number" name="amount" min="{{$shop->user->minimum_payout()}}" max="{{$shop->user->maximum_payout() > $shop->wallet ? $shop->wallet : $shop->user->maximum_payout()}}" id="amount" placeholder="Minimum ({{$shop->user->minimum_payout()}}) and Maximum ({{$shop->user->maximum_payout() > $shop->wallet ? $shop->wallet : $shop->user->maximum_payout()}})" autocomplete="off" required="">
                        </div>
                        <div class="contact-form-input">
                          <label for="address">Enter your access pin. *</label>
                          <input type="text" name="pin" id="pin" value="" placeholder="Access pin" required />
                      </div>
                      </div>
                    </div>
                    <div class="contact-form-btn">
                        <button class="button button--md" type="submit" id="btn-payout1">Submit Request</button>
                    </div>
                  </form>
                @else
                  <a href="{{route('vendor.banking')}}" class="button button--md bg-dark">Add Bank Account</a>
                @endif
              </div>
          </div>
          <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Withdrawals</h5>
              </div>
              <div class="dashboard__content-card-body">
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                      <thead>
                          <tr>
                            <th scope="col" class="cart-table-title">Date</th>
                            <th scope="col" class="cart-table-title">Amount</th>
                            <th scope="col" class="cart-table-title">Channel</th>
                            <th scope="col" class="cart-table-title">Destination</th>
                            <th scope="col" class="cart-table-title">Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($payouts as $payout)
                              <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                  <!-- item  -->
                                  <td class="cart-table-item order-date align-middle">
                                      <span style="font-size:12px;color:#888">{{ $payout->created_at->format('l, F d, Y')}}</span>
                                  </td>
                                  <!-- Price  -->
                                  <td class="cart-table-item order-date align-middle">
                                      <p class="font-body--lg-500" style="color:#00b207">{!!$shop->country->currency->symbol!!}{{ number_format($payout->amount, 2)}}</p>
                                  </td>
                                  <td class="cart-table-item order-date align-middle">
                                    @switch($payout->channel)
                                      @case('paypal') paypal
                                      @break
                                      @case('stripe') Stripe
                                      @break
                                      @default Bank Transfer
                                      @break
                                    @endswitch
                                  </td>
                                  <td class="cart-table-item order-date align-middle">
                                    {{$payout->destination}}
                                  </td>
                                  <!-- Stock Status  -->
                                  <td class="cart-table-item order-date align-middle">
                                    @switch($payout->status)
                                        @case('pending')
                                              <p style="color:#cc7817;font-size:14px"><span id="status">Pending</span></p>
                                            @break
                                        @case('rejected')
                                              <p style="color:#d92e2e;font-size:14px"><span id="status">Cancelled</span></p>
                                            @break
                                        @case('processing')
                                              <p style="color:#5e2ed9;font-size:14px;font-weight:500">Processing</p>
                                        @break
                                        @case('failed')
                                          <p style="color:#d92e2e;font-size:14px"><span id="status">Failed</span></p>
                                        @break
                                        @case('paid')
                                          <p style="color:#00b207;font-size:14px;font-weight:500">Paid</p>
                                        @break
                                        @default
                                            
                                    @endswitch
                                      
                                  </td>
                                  
                                  
                              </tr>   
                          @empty
                              <div style="margin:auto;padding:1%;text-align:center">
                                  <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
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
    </div>
  </div>


@endsection
@push('scripts')

@endpush