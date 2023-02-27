@extends('layouts.app')
@push('styles')

@endpush
@section('title'){{$user->name}} | User Dashboard @endsection
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
        @include('layouts.customer_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- User Info -->
            <div class="row">
              <!-- User Profile  -->
              <div class="col-lg-7">
                <div class="dashboard__user-profile dashboard-card">
                  <div class="dashboard__user-profile-img">
                    <img @if(!$user->pic) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xl-500 name">{{$user->name}}</h5>
                        <p class="font-body--lg-400 designation">{{$user->state->name}},{{session('locale')['country_name']}}</p>
                        <span class="text-muted small">
                          <svg width="16" height="16" viewBox="0 0 46 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M2 15.5V38.25C2 38.7141 2.18437 39.1592 2.51256 39.4874C2.84075 39.8156 3.28587 40 3.75 40H42.25C42.7141 40 43.1592 39.8156 43.4874 39.4874C43.8156 39.1592 44 38.7141 44 38.25V15.5L23 1.5L2 15.5Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M19.1816 27.75L2.53906 39.5047" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M43.4611 39.5065L26.8186 27.75" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M44 15.5L26.8185 27.75H19.1815L2 15.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                          {{$user->email}}
                        </span>
                        
                        |<span class="text-muted small"> 
                          <svg width="16" height="16" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7.115 11.6517C8.02238 13.5074 9.5263 15.0049 11.3859 15.9042C11.522 15.9688 11.6727 15.9966 11.8229 15.9851C11.9731 15.9736 12.1178 15.9231 12.2425 15.8386L14.9812 14.0134C15.1022 13.9326 15.2414 13.8833 15.3862 13.8698C15.5311 13.8564 15.677 13.8793 15.8107 13.9364L20.9339 16.1326C21.1079 16.2065 21.2532 16.335 21.3479 16.4987C21.4426 16.6623 21.4815 16.8523 21.4589 17.04C21.2967 18.307 20.6784 19.4714 19.7196 20.3154C18.7608 21.1593 17.5273 21.6249 16.25 21.625C12.3049 21.625 8.52139 20.0578 5.73179 17.2682C2.94218 14.4786 1.375 10.6951 1.375 6.75C1.37512 5.47279 1.84074 4.23941 2.68471 3.28077C3.52867 2.32213 4.6931 1.70396 5.96 1.542C6.14771 1.51936 6.33769 1.55832 6.50134 1.653C6.66499 1.74769 6.79345 1.89298 6.86738 2.067L9.06537 7.1945C9.1219 7.32698 9.14485 7.47137 9.13218 7.61485C9.11951 7.75833 9.07162 7.89647 8.99275 8.017L7.17275 10.7977C7.09015 10.923 7.04141 11.0675 7.03129 11.2171C7.02117 11.3668 7.05001 11.5165 7.115 11.6517V11.6517Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>

                          {{$user->mobile}}
                        </span>
                        <p><a href="{{route('profile')}}" class="dashboard__user-billing-editaddress font-body--lg-500" > Edit Profile</a></p>
                  </div>
                </div>
              </div>
              <!-- User Billing Address -->
              <div class="col-lg-5">
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
            @if($user->orders->whereIn('status',['processing','shipped','delivered','completed'])->isNotEmpty())
            <!-- Order History -->
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Recent Orders</h2>
                <a href="{{route('orders')}}" class="font-body--lg-500">
                  View All</a>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title">Shop/Order Id</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Date</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Total</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($user->orders->whereIn('status',['processing','shipped','delivered','completed'])->sortByDesc('updated_at') as $order)   
                          <tr>
                              <!-- Order Id  -->
                              <td class="dashboard__order-history-table-item order-id"> 
                                  <span style="font-weight:500"><a href="{{route('vendor.show',$order->shop)}}">{{$order->shop->name}}</a>/Order#{{$order->id}}</span>
                              </td>
                              <!-- Date  -->
                              <td class="   dashboard__order-history-table-item   order-date "> {{$order->created_at->format('Y-m-d')}}</td>
                              <!-- Total  -->
                              <td class="   dashboard__order-history-table-item   order-total "> 
                                  <p class="order-total-price">   {!!$user->country->currency->symbol!!}{{number_format($order->total, 0)}} </p>
                              </td>
                              <!-- Status -->
                              <td class="dashboard__order-history-table-item   order-status "> 
                                @switch($order->status)
                                @case('new') Payment Pending
                                    
                                    @break
                                @case('processing') Processing
                                    
                                    @break
                                @case('shipped') Shipped
                                
                                @break
                                @case('delivered') Delivered
                                    
                                    @break
                                @case('completed') Completed
                                
                                @break
                                @default Cancelled
                                    
                            @endswitch
                              </td>
                              <!-- Details page  -->
                              <td class="dashboard__order-history-table-item   order-details ">
                                  
                                  <a href="{{route('order.show',$order)}}">
                                      <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">view</span>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
@endsection
@push('scripts')

@endpush
