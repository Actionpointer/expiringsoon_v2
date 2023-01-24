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
              <div class="col-lg-6">
                <div class="dashboard__user-profile dashboard-card">
                  <div class="dashboard__user-profile-img">
                    <img @if(!$user->pic) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xl-500 name">{{$user->name}}</h5>
                    <h6 class="my-2 text-dark">{{$user->subscription->plan->name}} Subscription @if($user->subscription->is_free) | <a href="{{route('vendor.plans')}}"><u>upgrade</u></a> @endif </h6>
                      @if($user->subscription->end_at && $user->subscription->end_at > now())
                            
                          @if($user->subscription->renew_at < now())
                            <p>Subscription will expire on {{$user->subscription->end_at->format('d-M-Y')}} </p>
                            
                          @else
                          
                            @if($user->subscription->auto_renew) 
                                
                              <form class="" action="{{route('vendor.subscription.cancel_renew')}}" method="POST"> @csrf 
                                  <input type="hidden" name="subscription_id" value="{{$user->subscription_id}}"> 
                                  <p>Subscription will auto-renew on ({{$user->subscription->end_at->format('d-M-Y')}}) | 
                                  <button type="submit"><u>Cancel Auto-Renew</u></button></p>  
                              </form> 
                              <form class="" action="{{route('vendor.plans.subscribe')}}" method="POST"> @csrf 
                                <input type="hidden" name="subscription_id" value="{{$user->subscription_id}}"> 
                                <button type="submit"><u>Renew Now </u></button>
                              </form>
                            @else

                              <form class="" action="{{route('vendor.plans.subscribe')}}" method="POST"> @csrf 
                                <input type="hidden" name="subscription_id" value="{{$user->subscription_id}}"> 
                                <p>Subscription will expire on {{$user->subscription->end_at->format('d-M-Y')}}, afterwhich you will be downgraded to the free plan </p> 
                                <button type="submit"><u>Renew Now </u></button>
                              </form>

                            @endif 
                            
                          @endif
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
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{!!session('locale')['currency_symbol']!!}{{number_format($user->shops->sum('wallet'), 2)}}</a>
                          </div>
                      </div>
                      
                    </div>
                    {{-- <div>
                        <a href="#" class="edit font-body--lg-500">Request order</a>
                    </div> --}}
                   
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="dashboard__totalpayment-card">
                  <div class="dashboard__totalpayment-card-header">
                    <div class="dashboard__totalpayment-card-header">
                      <div class="dashboard__totalpayment-card-header-item">
                        <h5 class="title">Unread Notifications</h5>
                        
                      </div>
                    </div>
                  </div>

                  <div class="dashboard__totalpayment-card-body">
                      @forelse($user->unreadNotifications as $notification)
                        <div class="dashboard__totalpayment-card-body-item">
                          <div class="d-flex">
                              <div>
                                <small class="muted font-body--sm-400 text-nowrap">12-May</small>
                              </div>
                              
                              <h5 class="font-body--sm-400 px-2"> 
                                {{$notification->data}}
                              </h5>
                              <div>
                                <button class="btn btn-sm btn-outline-dark">View</button>
                              </div>
                              
                          </div>
                        </div>
                      @empty
                        <div class="dashboard__totalpayment-card-body-item pt-5 justify-content-center">
                          <h5 class="font-body--lg-600">No Unread Notification</h5>
                        </div>
                      @endforelse
                  </div>
                </div>
              </div>
            </div>


            <!-- Shop status and notifications  -->
            <div class="my-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="dashboard__totalpayment-card">
                    <div class="dashboard__totalpayment-card-header">
                      <div class="dashboard__totalpayment-card-header">
                        <div class="dashboard__totalpayment-card-header-item">
                          <h5 class="title">Shops Overview</h5>
                          {{-- <p class="details order-id"> {{$order->trackingcode}}</p> --}}
                        </div>
                      </div>
                    </div>

                    <div class="dashboard__totalpayment-card-body">
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Active Shops:</h5>
                        <p class="font-body--md-500"> {{$user->shops->where('status',true)->count()}} / {{$user->shops->count()}} </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shops Visible:</h5>
                        <p class="font-body--md-500"> {{$user->shops->where('published',true)->count()}} / {{$user->shops->count()}} </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shops Approved:</h5>
                        <p class="font-body--md-500">{{$user->shops->where('approved',true)->count()}} / {{$user->shops->count()}}</p>
                      </div>
                      {{-- <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Orders:</h5>
                        <p class="font-body--md-500">{!!session('locale')['currency_symbol']!!} 5</p>
                      </div> --}}
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Ads Running:</h5>
                        <p class="font-body--md-500">{{$user->adverts->where('advertable_type','App\Models\Shop')->where('status',true)->count()}}</p>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="dashboard__totalpayment-card">
                    <div class="dashboard__totalpayment-card-header">
                      <div class="dashboard__totalpayment-card-header">
                        <div class="dashboard__totalpayment-card-header-item">
                          <h5 class="title">Products Overview</h5>
                          {{-- <p class="details order-id"> {{$order->trackingcode}}</p> --}}
                        </div>
                      </div>
                    </div>

                    <div class="dashboard__totalpayment-card-body">
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Active Products:</h5>
                        <p class="font-body--md-500"> {{$user->products->where('status',true)->count()}} / {{$user->products->count()}} </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Products Visible:</h5>
                        <p class="font-body--md-500">{{$user->products->where('published',true)->count()}} / {{$user->products->count()}}</p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Products Approved:</h5>
                        <p class="font-body--md-500">{{$user->products->where('approved',true)->count()}} / {{$user->products->count()}}</p>
                      </div>
                      {{-- <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Orders:</h5>
                        <p class="font-body--md-500">{!!session('locale')['currency_symbol']!!} 5</p>
                      </div> --}}
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Ads Running:</h5>
                        <p class="font-body--md-500">{{$user->adverts->where('advertable_type','App\Models\Product')->where('status',true)->count()}}</p>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="my-3">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="dashboard__order-history">
                    <div class="dashboard__order-history-title">
                        <h2 class="font-body--xl-500">Opened Orders</h2>
                    </div>
                    <div class="dashboard__order-history-table">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title"> Date </th>
                                <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                                <th scope="col" class="dashboard__order-history-table-title"> Status</th>   
                                <th scope="col" class="dashboard__order-history-table-title"> View</th>   
                            </tr>
                            </thead>
                            <tbody>                     
                                @forelse($user->shopOrders->sortByDesc('updated_at')->take(5) as $order)                                        
                                    <tr>
                                        <td class="dashboard__order-history-table-item order-date "> 
                                          {{$order->created_at->format('Y-m-d')}}
                                        </td>
                                        <!-- Vendor Split  -->
                                        <td class="dashboard__order-history-table-item order-total "> 
                                            <p class="order-total-price"> {{$order->shop->name}} </p>
                                        </td>
                                        
                                        <td class="dashboard__order-history-table-item order-details" style="text-align: left!important"> 
                                            <span class="@if($order->status == 'pending' || $order->status == 'processing') text-warning @elseif($order->status == 'rejected') text-danger @else text-success @endif">
                                                {{$order->status}}
                                            </span>
                                        </td>
                                    </tr>
                                 @empty 
                                    <tr>
                                      <td colspan="4" class="text-center border-0">
                                        <div style="padding:1%;margin-bottom:5%">
                                          <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                          <br />You have no opened order at this time.
                                        </div>
                                      </td>
                                    </tr> 
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
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
@endsection
@push('scripts')

@endpush
