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
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Products :</span> <strong>{{\App\Models\Product::count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Shops :</span> <strong>{{\App\Models\Shop::count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Adverts :</span> <strong>{{\App\Models\Advert::count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Customers :</span> <strong>{{\App\Models\Role::where('name','shopper')->first()->users->count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom"> <span> Total Orders :</span> <strong>{{App\Models\Order::count()}}</strong></p>
                  </div>
                </div>
              </div>
            </div>

            @if ($documents->isNotEmpty())
              <!-- KYC Documents -->
              <div class="dashboard__order-history" style="margin-top: 24px">
                <div class="dashboard__order-history-title">
                  <h2 class="font-body--xxl-500">KYC Documents</h2>
                  <a href="#" class="font-body--lg-500">&nbsp</a>
                </div>
                <div class="dashboard__order-history-table">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="dashboard__order-history-table-title"> Date</th>
                          <th scope="col" class="dashboard__order-history-table-title"> Type </th>
                          <th scope="col" class="dashboard__order-history-table-title"> Applicant</th>
                          <th scope="col" class="dashboard__order-history-table-title"></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                          @foreach ($documents as $document)
                              <tr>

                                <td class="dashboard__order-history-table-item order-total " >
                                  {{$document->created_at->format('l, M jS, Y')}}
                                </td>
                                <!-- Status -->
                                <td class="dashboard__order-history-table-item order-status">
                                    {{ucwords($document->type)}}
                                </td>

                                  <td class="dashboard__order-history-table-item order-date">
                                    <div class="d-flex">
                                      @if($document->verifiable_type == 'App\Models\Shop')
                                        <img @if(!$document->verifiable->banner) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($document->verifiable->banner)}}" @endif alt="{{$document->verifiable->name}}" style="width:50px;height:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                      @else
                                        <img @if(!$document->verifiable->photo) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($document->verifiable->photo)}}" @endif alt="{{$document->verifiable->name}}" style="width:50px;height:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                      @endif
                                      <p class="order-total-price ps-2">
                      
                                          {{$document->verifiable->name}}
                                          <br />
                                          <span style="font-size:12px;color:#888">
                                              {{$document->verifiable->email}}
                                          </span>
                                      
                                      </p>
                                    </div>
                                    
                                  </td>
                                  <!-- Total  -->
                                  
                                  <!-- Details page  -->
                                  <td class=" dashboard__order-history-table-item order-details ">
                                    @if($document->verifiable_type == 'App\Models\Shop')
                                      <a href="{{route('admin.shop.show',$document->verifiable)}}"> View Shop</a>
                                    @else
                                      <a href="{{route('admin.user.show',$document->verifiable)}}"> View User</a>
                                    @endif
                                  </td>
                              </tr>
                          
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endif

            <!-- Approvals and notifications  -->
            <div class="my-3">
              <div class="row">
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
                            10
                        </p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.products')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Products:</h5>
                        <p class="font-body--md-500">4</p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.adverts')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Adverts</h5>
                        <p class="font-body--md-500">1</p>
                      </a>
                      <a class="dashboard__totalpayment-card-body-item" href="{{route('admin.payouts')}}?search=pending">
                        <h5 class="font-body--md-400 text-primary">Payouts</h5>
                        <p class="font-body--md-500">2</p>
                      </a>
                      
                      
                      
                    </div>
                  </div>
                </div>
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
                      @forelse($user->unreadNotifications as $notification)
                        <div class="dashboard__totalpayment-card-body-item">
                          <div class="d-flex">
                              <div>
                                <small class="muted font-body--sm-400 text-nowrap">{{$notification->created_at->format('d-M')}}</small>
                              </div>
                              
                              <h5 class="font-body--sm-400 px-2"> 
                                {{$notification->data['body']}}
                              </h5>
                              @if($notification->data['url'])
                              <div>
                                <a href="{{url($notification->data['url'])}}" class="btn btn-sm btn-outline-dark">View</a>
                              </div>
                              @endif
                              
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
            </div>
            
            <!-- Order History  -->
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Recent Orders</h2>
                <a href="{{route('admin.orders')}}" class="font-body--lg-500">See All</a>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Order Id
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Date
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Total
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Status </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Delivery </th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @forelse ($orders as $order)
                            
                        <tr>
                            <!-- Order Id  -->
                            <td class="dashboard__order-history-table-item order-id"> 
                                <span style="font-weight:500">#{{$order->id}}</span>
                            </td>
                            <!-- Date  -->
                            <td class="dashboard__order-history-table-item order-date "> 
                                {{$order->created_at->format('d-m-Y h:i A')}}
                            </td>
                            <!-- Total  -->
                            <td class="   dashboard__order-history-table-item   order-total "> 
                                <p class="order-total-price">   {!!$order->shop->country->currency->symbol!!}{{ number_format($order->total)}} </p>
                            </td>
                            <!-- Status -->
                            <td class="   dashboard__order-history-table-item   order-status "> 
                                {{$order->status}}
                            </td>
                            <td class="   dashboard__order-history-table-item   order-status "> 
                              Delivery Type: {{ucwords($order->deliverer)}}
                              
                            </td>
                            <!-- Details page  -->
                            <td class="   dashboard__order-history-table-item   order-details "> 
                                <a href="{{route('admin.order.show',$order)}}"> View Order</a>
                            </td>
                        </tr>
                      @empty
                      <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}"><br />You have no orders at this time.
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


@endsection
@push('scripts')

@endpush