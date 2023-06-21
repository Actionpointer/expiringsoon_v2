@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

@endpush
@section('title')Admin Dashboard | Expiring Soon @endsection
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
            <a href="#">
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- User Info -->
            <div class="row">
              <!-- User Profile  -->
              <div class="col-lg-7">
                <div class="dashboard__user-profile dashboard-card">
                  <div class="dashboard__user-profile-img">
                    <img src="{{asset('src/images/site/avatar.png')}}" alt="{{$user->name}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xxl-500 name">Hi, {{$user->name}}</h5>
                    <p class="font-body--md-400 designation">Admin</p>
                  </div>
                </div>
              </div>
              <!-- User Billing Address -->
              <div class="col-lg-5">
                <div class="dashboard__user-billing dashboard-card">
                  <h2 class="dashboard__user-billing-title font-body--md-500"> Summary </h2>
                  <div class="dashboard__user-billing-info">
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Products :</span> <strong>{{\App\Models\Product::within()->count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Shops :</span> <strong>{{\App\Models\Shop::within()->count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Adverts :</span> <strong>{{\App\Models\Advert::within()->count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Customers :</span> <strong>{{\App\Models\User::within()->whereHas('role',function($query){ $query->where('name','shopper');})->count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Orders :</span> <strong>{{App\Models\Order::within()->count()}}</strong></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Approvals and notifications  -->
            <div class="my-3">
              <div class="row">
                @if($user->role->name != 'auditor')
                <div class="col-lg-6">
                  <div class="dashboard__totalpayment-card">
                    <div class="dashboard__totalpayment-card-header">
                      <div class="dashboard__totalpayment-card-header">
                        <div class="dashboard__totalpayment-card-header-item">
                          <h5 class="title">Pending Approvals</h5>
                          {{-- <p class="details order-id"> {{$order->trackingcode}}</p> --}}
                        </div>
                      </div>
                    </div>

                    <div class="dashboard__totalpayment-card-body">
                      
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.shops')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Shops:</h5>
                        <p class="font-body--md-500">
                          {{\App\Models\Shop::within()->where('approved',false)->count()}}
                        </p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.products')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Products:</h5>
                        <p class="font-body--md-500">{{\App\Models\Product::within()->where('approved',false)->count()}}</p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.adverts')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Adverts</h5>
                        <p class="font-body--md-500">{{\App\Models\Advert::within()->where('approved',false)->count()}}</p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.payouts')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Payouts</h5>
                        <p class="font-body--md-500">{{\App\Models\Payout::within()->where('status','pending')->count()}}</p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.payouts')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">KYC</h5>
                        <p class="font-body--md-500">{{\App\Models\Kyc::within()->where('status',false)->whereNull('reason')->count()}}</p>
                      </a>
                      
                      
                      
                    </div>
                  </div>
                </div>
                @endif
                <div class="col-lg-6">
                  <div class="dashboard__totalpayment-card">
                    <div class="dashboard__totalpayment-card-header">
                      <div class="dashboard__totalpayment-card-header">
                        <div class="dashboard__totalpayment-card-header-item">
                          <h5 class="title">Notifications</h5>
                          
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
            </div>
            @if(in_array($user->role->name,['superadmin','admin','arbitrator']) && $disputes->isNotEmpty())
                <!-- Disputes-->
                <div class="dashboard__order-history" style="margin-top: 24px">
                  <div class="dashboard__order-history-title">
                    <h2 class="font-body--xxl-500">Dispute Cases</h2>
                    <a class="font-body--md-500">{{$disputes->count()}} Cases</a>
                  </div>
                  <div class="dashboard__order-history-table">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" class="dashboard__order-history-table-title"> Date</th>
                            <th scope="col" class="dashboard__order-history-table-title"> Subject </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                            <th scope="col" class="dashboard__order-history-table-title"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($disputes as $dispute)
                                <tr>

                                  <td class="dashboard__order-history-table-item order-total " >
                                    {{$dispute->created_at->format('l, M jS, Y')}}
                                  </td>
                                  <!-- Status -->
                                  <td class="dashboard__order-history-table-item order-status">
                                      {{ucwords($dispute->description)}}
                                  </td>

                                  <td class="dashboard__order-history-table-item order-status">
                                    @if($dispute->order->messages->where('sender_id','!=',$dispute->order->user_id)->where('sender_type','App\Models\User')->isNotEmpty())
                                    Ongoing
                                    @else New
                                    @endif
                                  </td>  
                                    
                                    <!-- Details page  -->
                                    <td class=" dashboard__order-history-table-item order-details ">
                                      
                                        <a href="{{route('admin.order.show',$dispute->order)}}"> View Order</a>
                                      
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                  <td colspan="4">
                                    <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                      <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}"><br />No pending KYC at this time.
                                    </div>
                                  </td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            @endif
            
            
            <!-- Order History  -->
            @can('list','App\Models\Order')
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Defaulting Orders</h2>
                <a href="{{route('admin.orders')}}" class="font-body--lg-500">See All</a>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Order Id </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Status </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Since </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Total </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Delivery </th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @forelse ($statuses as $status)
                            
                        <tr>
                            <!-- Order Id  -->
                            <td class="dashboard__order-history-table-item order-id"> 
                                <span style="font-weight:500">#{{$status->order->id}}</span>
                            </td>
                            <td class="   dashboard__order-history-table-item   order-status "> 
                              {{ucwords($status->name)}}
                            </td>
                            <!-- Date  -->
                            <td class="dashboard__order-history-table-item order-date "> 
                                {{$status->created_at->format('d-m-Y h:i A')}}
                            </td>
                            <!-- Total  -->
                            <td class="   dashboard__order-history-table-item   order-total "> 
                                <p class="order-total-price">   {!!$status->order->shop->country->currency->symbol!!}{{ number_format($status->order->total)}} </p>
                            </td>
                            <!-- Status -->
                            
                            <td class="   dashboard__order-history-table-item   order-status "> 
                              Delivery Type: {{ucwords($status->order->deliverer)}}
                              
                            </td>
                            <!-- Details page  -->
                            <td class="   dashboard__order-history-table-item   order-details "> 
                                <a href="{{route('admin.order.show',$status->order)}}"> View Order</a>
                            </td>
                        </tr>
                      @empty
                      <tr>
                        <td colspan="6">
                          <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}"><br />You have no orders at this time.
                          </div>
                        </td>
                      </tr>
                      
                      @endforelse
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush