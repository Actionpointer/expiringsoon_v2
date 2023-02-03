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
        @include('admin.navigation')
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
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom "> <span> Total Products :</span> <strong>{{\App\Models\Product::count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom "> <span> Total Shops :</span> <strong>{{\App\Models\Shop::count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom "> <span> Total Adverts :</span> <strong>{{\App\Models\Advert::count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom "> <span> Total Customers :</span> <strong>{{\App\Models\User::where('role','shopper')->count()}}</strong></p>
                    <p class="dashboard__user-billing-location font-body--md-400 d-flex justify-content-between border-bottom "> <span> Total Sales :</span> <strong>{!!session('locale')['currency_symbol']!!} {{App\Models\Order::where('status','completed')->sum('total')}}</strong></p>
                    
                  </div>
                </div>
              </div>
            </div>

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
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                        <th scope="col" class="dashboard__order-history-table-title"> Shop Details</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Date
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Type
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        @forelse ($documents as $document)
                            <tr>
                                <!-- Order Id  -->
                                <td class="dashboard__order-history-table-item order-id" >
                                    @if($document->verifiable_type == 'App\Models\Shop')
                                      <img @if(!$document->verifiable->banner) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($document->verifiable->banner)}}" @endif alt="{{$document->verifiable->name}}" style="width:50px;height:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                    @else
                                    <img @if(!$document->verifiable->photo) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($document->verifiable->photo)}}" @endif alt="{{$document->verifiable->name}}" style="width:50px;height:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                    @endif
                                </td>
                                <!-- Date  -->
                                <td class="dashboard__order-history-table-item order-date">
                                    <p class="order-total-price">
                    
                                        {{$document->verifiable->name}}
                                        <br />
                                        <span style="font-size:12px;color:#888">
                                            {{$document->verifiable->email}}
                                        </span>
                                     
                                    </p>
                                </td>
                                <!-- Total  -->
                                <td class="dashboard__order-history-table-item order-total " >
                                    {{-- <?php echo date("l, M jS, Y", strtotime($row['date'])); ?> --}}
                                    {{$document->created_at->format('l, M jS, Y')}}
                                </td>
                                <!-- Status -->
                                <td class="dashboard__order-history-table-item order-status">
                                    {{ucwords($document->type)}}
                                </td>
                                <!-- Details page  -->
                                <td class=" dashboard__order-history-table-item order-details ">
                                  @if($document->verifiable_type == 'App\Models\Shop')
                                    <a href="{{route('admin.shop.show',$document->verifiable)}}"> View Shop</a>
                                  @else
                                    <a href="{{route('admin.user.show',$document->verifiable)}}"> View User</a>
                                  @endif
                                </td>
                            </tr>
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                <br />No pending documents at this time
                            </div>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

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
                      
                      
                      {{-- <div class="dashboard__totalpayment-card-body-item total" >
                        <h5 class="font-body--xl-400">Total:</h5>
                        <p class="font-body--xl-500">{!!session('locale')['currency_symbol']!!} {{number_format($order->total, 2)}}</p>
                      </div> --}}
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
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">No Notification</h5>
                        
                      </div>
                      
                     
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
                                <p class="order-total-price">   {!!session('locale')['currency_symbol']!!}{{ number_format($order->total)}} </p>
                            </td>
                            <!-- Status -->
                            <td class="   dashboard__order-history-table-item   order-status "> 
                                {{$order->status}}
                            </td>
                            <td class="   dashboard__order-history-table-item   order-status "> 
                              @if($order->deliveryfee == '0.00')
                                Pickup
                              @elseif($order->deliveryByVendor())
                                Delivery by Vendor
                              @else 
                                Delivery by Admin
                              @endif
                            </td>
                            <!-- Details page  -->
                            <td class="   dashboard__order-history-table-item   order-details "> 
                                <a href="{{route('order-details',$order)}}"> View Order</a>
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