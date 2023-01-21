@extends('layouts.app')
@push('styles')

@endpush
@section('title') Analytics | Vendor Dashboard @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('index')}}">
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Dashboard</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  <!-- dashboard Secton Start  -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('vendor.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- User Info -->
            <div class="row">
              <!-- User Profile  -->
              <div class="col-lg-12">
                <div class="dashboard__user-profile dashboard-card">
                  <div class="dashboard__user-profile-img">
                    <img @if(!$user->pic) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xl-500 name">{{$user->name}}</h5>
                    <h6 class="my-2 text-dark">Basic Subscription | <a href="#"><u>upgrade</u></a></h6>
                    <div style="margin:auto">
                      <div style="float:left;padding-right:20px;margin-right:20px;border-right:2px solid #e0dfdf">
                          <p align="left" class="font-body--md-400 designation">Total Shops</p>
                          <div style="margin-top:-10px">
                              <a href="sales.php" class="edit font-body--lg-500" style="font-size:20px">{{$user->shops->count()}}</a>
                          </div>
                      </div>
                      <div style="float:left;padding-right:20px;margin-right:20px;border-right:2px solid #e0dfdf">
                          <p align="left" class="font-body--md-400 designation">Total Sales</p>
                          <div style="margin-top:-10px">
                              <a href="sales.php" class="edit font-body--lg-500" style="font-size:20px">N 0</a>
                          </div>
                      </div>
                      <div style="float:left;margin-right:10px">
                          <p align="left" class="font-body--md-400 designation">Balance</p>
                          <div style="margin-top:-10px">
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{!!session('locale')['currency_symbol']!!}{{number_format($user->shops->sum('wallet'), 2)}}</a>
                          </div>
                      </div>
                    </div>
                    {{-- <div>
                        <a href="#" class="edit font-body--lg-500">Request Payout</a>
                    </div> --}}
                   
                  </div>
                </div>
              </div>
              <!-- User Billing Address -->
              {{-- <div class="col-lg-5">
                <div class="dashboard__user-billing dashboard-card">
                  <h2 class="dashboard__user-billing-title font-body--md-500">
                    @if($user->role =='Shopper') Billing Address @else Pick-Up Address @endif
                  </h2>
                  <div class="dashboard__user-billing-info">
                    <h5 class="dashboard__user-billing-name font-body--xl-500" >
                      {{$user->role}} #{{$user->userid}}
                      @if($user->role =='Vendor' && $user->status =='Approved') 
                        <span class="iconify" style="color:#00b207" data-icon="akar-icons:check-box-fill" data-width="20" data-height="20">
                      @endif
                    </h5>
                    <p class="dashboard__user-billing-location font-body--md-400"> {{$user->address}}, {{$user->state}} </p>
                    <p class="dashboard__user-billing-email font-body--lg-400" > {{$user->email}} </p>
                    <p class="dashboard__user-billing-number font-body--lg-400" > {{$user->phone}} </p>
                  </div>
                  <a href="{{route('profile')}}" class="dashboard__user-billing-editaddress font-body--lg-500" > Edit Profile</a>
                </div>
              </div> --}}
            </div>

            <!-- Sales History  -->
            
              <div class="dashboard__order-history" style="margin-top: 24px">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Shops</h2>
                    <a href="{{route('vendor.shop.create')}}" class="font-body--lg-500">
                      Create Shop</a>
                </div>
                <div class="dashboard__order-history-table">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Products  </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Sales  </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Earnings  </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Wallet  </th>
                            <th scope="col" class="dashboard__order-history-table-title"></th>
                        </tr>
                        </thead>
                        <tbody>                     
                            @forelse($user->shops as $shop)        
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id"> 
                                        <span style="font-weight:500">{{$shop->name}}</span><br/>
                                    </td>
                                    
                                    <!-- Vendor Split  -->
                                    <td class="dashboard__order-history-table-item order-total "> 
                                        <p class="order-total-price">   {{number_format($shop->products->count(), 0)}} </p>
                                    </td>
                                    <!-- Site Split  -->
                                    <td class="dashboard__order-history-table-item order-total"> 
                                        <p class="order-total-price">   {!!session('locale')['currency_symbol']!!}{{number_format($shop->orders->sum('total'), 0)}} </p>
                                    </td>
                                    <!-- Status -->
                                    <td class="dashboard__order-history-table-item   order-status "> {!!session('locale')['currency_symbol']!!} {{number_format($shop->settlements->sum('amount'),2)}}</td>
                                    <td class="dashboard__order-history-table-item   order-status "> {!!session('locale')['currency_symbol']!!} {{number_format($shop->wallet,2)}}</td>
                                    <!-- Details page  -->
                                    <td class="dashboard__order-history-table-item   order-details "> 
                                        <a href="{{route('shop.show',$shop)}}">
                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">
                                            </span>Go to Storefront
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                    <p>You have no orders at this time.</p><br>
                                    <a href="{{route('vendor.shop.create')}}">Create Shop</a>
                                    
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            
            <!-- susbcriptions -->
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Subscriptions</h2>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Plan</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Start</th>
                        <th scope="col" class="dashboard__order-history-table-title"> End</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($user->subscriptions as $subscription)
                        <tr>
                          <!-- Order Id  -->
                          <td class="dashboard__order-history-table-item order-status"> 
                              <span style="font-weight:500">
                                @if($subscription->plan_id) 
                                  {{$subscription->plan->name}}
                                @else 
                                  Enterprise plan
                                @endif
                              </span>
                          </td>
                          <!-- Date  -->
                          <td class="dashboard__order-history-table-item   order-date "> {{ $subscription->start_at->format('d M, Y h:i A')}}</td>
                          <!-- Total  -->
                          <td class="   dashboard__order-history-table-item   order-total ">  {{ $subscription->end_at->format('d M, Y h:i A')}} </td>
                          <!-- Status -->
                          <td class="dashboard__order-history-table-item order-status ">
                            @if($subscription->deleted_at || $subscription->end_at < now())
                              <button class="badge btn-danger">Expired </button>
                            @elseif($subscription->end_at->diffInMonths(now()) < 2)
                                <button class="badge btn-warning">Expiring </button>
                            @else
                                <button class="badge btn-success">Active </button>
                            @endif
                          </td>
                          <td></td>
                        </tr> 
                        @empty
                        <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <br />You have no subscription at this time.
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
  </div>
  <!-- dashboard Secton  End  -->
@endsection
@push('scripts')

@endpush