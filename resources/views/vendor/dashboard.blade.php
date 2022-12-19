@extends('layouts.app')
@push('styles')

@endpush
@section('title'){{$user->name}} | Vendor Dashboard @endsection
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
  @if (session('statuss'))
    <div class="alert alert-success">
        {{ session('statuss') }}
    </div>
@endif
  @include('layouts.session')
  <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.navigation')
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
                    <h6 class="my-2 text-dark">
            
                      @if($user->activeSubscription)
                          <h6 class="my-2 text-dark">{{$user->activeSubscription->plan->name}}</h6>
                          @if($user->activeSubscription->expiring())
                            <form class="" action="{{route('vendor.subscription.plan')}}" method="POST"> @csrf 
                              <input type="hidden" name="subscription_id" value="{{$user->activeSubscription->id}}"> 
                              <p>Subscription about to expire ({{$user->activeSubscription->end_at->format('d-M-Y')}}) | 
                              <button type="submit"><u>Renew</u></button> | <a href="{{route('vendor.plans')}}"><u>Change plan</u></a> </p>
                            </form> 
                          @elseif($user->activeSubscription->auto_renew) 
                            <form class="" action="{{route('vendor.subscription.cancel_renew')}}" method="POST"> @csrf 
                              <input type="hidden" name="subscription_id" value="{{$user->activeSubscription->id}}"> 
                              <p>Plan will auto-renew on ({{$user->activeSubscription->end_at->format('d-M-Y')}}) | 
                              <button type="submit"><u>Cancel Auto-Renew</u></button></p>  
                            </form> 
                          @else 
                            <p>Plan will expire on {{$user->activeSubscription->end_at->format('d-M-Y')}}, afterwhich you will be downgraded to the free plan </p>
                          @endif
                      @else
                      <h6 class="my-2 text-dark">Free Subscription| <a href="{{route('vendor.plans')}}"><u>upgrade</u></a> </h6>
                      @endif
                        
                    
                    <div class="d-flex justify-content-center">
                      <div style="float:left;padding-right:20px;margin-right:20px;border-right:2px solid #e0dfdf">
                          <p align="left" class="font-body--md-400 designation">Total Shops</p>
                          <div style="margin-top:-10px">
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{{$user->shops->count()}}</a>
                          </div>
                      </div>
                      
                      <div style="float:left;margin-right:10px">
                          <p align="left" class="font-body--md-400 designation">Balance</p>
                          <div style="margin-top:-10px">
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{!!cache('settings')['currency_symbol']!!}{{number_format($user->shops->sum('wallet'), 2)}}</a>
                          </div>
                      </div>
                      
                    </div>
                    {{-- <div>
                        <a href="#" class="edit font-body--lg-500">Request Payout</a>
                    </div> --}}
                   
                  </div>
                </div>
              </div>
              
            </div>

            <!-- Recent Transactions  -->
            @if($user->payments->whereBetween('created_at',[now(),now()->subMonth()])->isNotEmpty())
              <div class="dashboard__order-history" style="margin-top: 24px">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Recent Transactions</h2>
                    <a href="{{route('vendor.payments')}}" class="font-body--lg-500">
                      View All</a>
                </div>
                <div class="dashboard__order-history-table">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                              <th scope="col" class="dashboard__order-history-table-title"> Date </th>
                              <th scope="col" class="dashboard__order-history-table-title"> Payment Reference  </th>
                              <th scope="col" class="dashboard__order-history-table-title"> Total  </th>
                              <th scope="col" class="dashboard__order-history-table-title"> Status  </th>
                              <th scope="col" class="dashboard__order-history-table-title"></th>
                          </tr>
                        </thead>
                        <tbody>                     
                            @foreach($user->payments->whereBetween('created_at',[now(),now()->subMonth()]) as $payment)        
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id"> 
                                        <span style="font-weight:500">{{$payment->created_at->format('Y-m-d')}}</span><br/>
                                    </td>
                                    
                                    <!-- Vendor Split  -->
                                    <td class="dashboard__order-history-table-item order-total "> 
                                        <p class="order-total-price">   #{{$payment->reference}} </p>
                                    </td>
                                    <!-- Site Split  -->
                                    <td class="dashboard__order-history-table-item order-total"> 
                                        <p class="order-total-price">   {!!cache('settings')['currency_symbol']!!}{{number_format($payment->amount, 0)}} </p>
                                    </td>
                                    <!-- Status -->
                                    <td class="dashboard__order-history-table-item   order-status "> {{$payment->status}}</td>
                                    <!-- Details page  -->
                                    <td class="dashboard__order-history-table-item   order-details "> 
                                        <a href="{{route('invoice',$payment)}}">
                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Invoice</span>
                                        </a>
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            @endif

            <!-- susbcriptions -->
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Current Subscriptions</h2>
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
                                  {{$subscription->plan->description}}
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
                            @elseif($subscription->expiring() && $subscription->status)
                                <button class="badge btn-warning">Expiring </button>
                            @elseif(!$subscription->status)
                                <button class="badge btn-danger">Not Active </button>
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

            @if($user->unreadNotifications->isNotEmpty())
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Recent Notifications  </h2>
                <a href="{{route('notifications')}}" class="font-body--lg-500">
                  View All</a>
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
                      @foreach($user->unreadNotifications as $notification)
                        <tr>
                          <!-- Order Id  -->
                          <td class="dashboard__order-history-table-item order-status"> 
                              <span style="font-weight:500">
                                
                              </span>
                          </td>
                          <!-- Date  -->
                          <td class="dashboard__order-history-table-item   order-date "> </td>
                          <!-- Total  -->
                          <td class="   dashboard__order-history-table-item   order-total ">   </td>
                          <!-- Status -->
                          <td class="dashboard__order-history-table-item order-status ">
                            <button class="badge btn-success">Active </button>
                          </td>
                          <td></td>
                        </tr> 
                        
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
@endsection
@push('scripts')

@endpush
