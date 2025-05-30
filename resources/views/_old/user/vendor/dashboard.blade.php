@extends('layouts.app')
@push('styles')

@endpush
@section('title'){{$user->name}} | Vendor Dashboard @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
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
                    <img @if(!$user->pic) src="{{asset('images/site/avatar.png')}}" @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xl-500 name">{{$user->name}}</h5>
                    <h6 class="my-2 text-dark">{{$user->subscription->plan->name}} Subscription @if($user->subscription->is_free) | <a href="{{route('vendor.plans')}}"><u>upgrade</u></a> @endif </h6>
                    @if($user->subscription->renew_at && $user->subscription->renew_at > now())
                      <p>Subscription will expire on {{$user->subscription->end_at->format('d-M-Y')}} </p>
                    @endif
                    @if($user->subscription->renew_at && $user->subscription->renew_at < now() && $user->subscription->end_at > now() )
                      <form class="" action="{{route('vendor.plans.subscribe')}}" method="POST"> @csrf 
                        <input type="hidden" name="subscription_id" value="{{$user->subscription->id}}"> 
                        <p>Subscription will expire in {{$user->subscription->end_at->diffInDays(now())}}, afterwhich you will be downgraded to the free plan </p> 
                        <button type="submit"><u>Renew Now </u></button>
                      </form>
                    @endif
                        
                    <div class="d-flex justify-content-center mt-3">
                      <div style="float:left;padding-right:20px;margin-right:20px;border-right:2px solid #e0dfdf">
                          <p align="left" class="font-body--md-400 designation">Total Shops</p>
                          <div style="margin-top:-10px">
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{{$user->shops->count()}}</a>
                          </div>
                      </div>
                      
                      <div style="float:left;margin-right:10px">
                          <p align="left" class="font-body--md-400 designation">Balance</p>
                          <div style="margin-top:-10px">
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{!!$user->country->currency->symbol!!}{{number_format($user->shops->sum('wallet'), 2)}}</a>
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
                      @forelse($user->unreadNotifications->sortBy('created_at')->take(4) as $notification)
                        <div class="dashboard__totalpayment-card-body-item">
                            <div class="d-flex">
                                <div>
                                  <p class="muted font-body--sm-400 text-nowrap">{{$notification->created_at->format('d-M')}}</p>
                                </div>
                                
                                <h5 class="font-body--sm-400 px-2"> 
                                  {{$notification->data['body']}}
                                </h5> 
                            </div>
                            @if(array_key_exists('url',$notification->data))
                            <div class="ml-auto">
                              <a href="{{url($notification->data['url'])}}" class="btn btn-sm btn-outline-dark">View</a>
                            </div>
                            @endif
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
                        <p class="font-body--md-500"> {{$user->shops->where('status',true)->count()}} of {{$user->shops->count()}} </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shops Published:</h5>
                        <p class="font-body--md-500"> {{$user->shops->where('published',true)->count()}} of {{$user->shops->count()}} </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shops Approved:</h5>
                        <p class="font-body--md-500">{{$user->shops->where('approved',true)->count()}} of {{$user->shops->count()}}</p>
                      </div>
                      {{-- <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Orders:</h5>
                        <p class="font-body--md-500">{!!$user->country->currency->symbol!!} 5</p>
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
                        <p class="font-body--md-500"> {{$user->products->where('status',true)->count()}} of {{$user->products->count()}} </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Products Published:</h5>
                        <p class="font-body--md-500">{{$user->products->where('published',true)->count()}} of {{$user->products->count()}}</p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Products Approved:</h5>
                        <p class="font-body--md-500">{{$user->products->where('approved',true)->count()}} of {{$user->products->count()}}</p>
                      </div>
                      {{-- <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Orders:</h5>
                        <p class="font-body--md-500">{!!$user->country->currency->symbol!!} 5</p>
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
                                @forelse($orders->sortByDesc('updated_at')->take(5) as $order)                                        
                                    <tr>
                                        <td class="dashboard__order-history-table-item order-date "> 
                                          {{$order->created_at->format('Y-m-d')}}
                                        </td>
                                        <!-- Vendor Split  -->
                                        <td class="dashboard__order-history-table-item order-total "> 
                                            <p class="order-total-price"> {{$order->shop->name}} </p>
                                        </td>
                                        
                                        <td class="dashboard__order-history-table-item order-status">
                                          {{ ucwords($order->status)}}
                                        </td>
                                        <td class="dashboard__order-history-table-item order-details" style="text-align: left!important">
                                          <a href="{{route('vendor.shop.order.view',[$order->shop,$order])}}" > View Order
                                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                              <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M11 2v60h44V18L39 2H11z" stroke-linejoin="round" stroke-linecap="round"></path>
                                              <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M39 2v16h16" stroke-linejoin="round" stroke-linecap="round"></path>
                                              <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M19 26v28h26" stroke-linejoin="round" stroke-linecap="round"></path>
                                              <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M19 46l10-10 6 4.9L45 30" stroke-linejoin="round" stroke-linecap="round"></path>
                                            </svg>
                                            
                                          </a>
                                        </td>
                                    </tr>
                                 @empty 
                                    <tr>
                                      <td colspan="4" class="text-center border-0">
                                        <div style="padding:1%;margin-bottom:5%">
                                          <img style="padding:10px;width:100px" src="{{asset('images/site/exclamation.png')}}">
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
