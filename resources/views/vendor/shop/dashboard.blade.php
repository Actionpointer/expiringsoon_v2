@extends('layouts.app')
@push('styles')

@endpush
@section('title'){{$shop->name}} | Vendor Dashboard @endsection
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
              <a href="{{route('vendor.shop.show',$shop)}}">
                Vendor
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="#">Storefront</a></li>
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
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- User Info -->
            <div class="row">
              <!-- User Profile  -->
              <div class="col-lg-7">
                <div class="dashboard__user-profile dashboard-card">
                  <div class="dashboard__user-profile-img">
                    <img @if(!$shop->banner) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($shop->banner)}}" @endif alt="{{$shop->name}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xl-500 name">
                      {{$shop->name}} 
                      @if($shop->verified())
                      <svg width="16" height="16" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="#00b207" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="#00b207" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                      @endif
                    </h5>
                    <div style="margin:auto">
                        <div style="float:left;padding-right:20px;margin-right:20px;border-right:2px solid #e0dfdf">
                            <p align="left" class="font-body--md-400 designation">Total Earnings</p>
                                <div style="margin-top:-10px">
                                    <a href="{{route('vendor.shop.order.list',$shop)}}" class="edit font-body--lg-500" style="font-size:20px">{!!$shop->country->currency->symbol!!}{{number_format($shop->settlements->where('status',true)->sum('amount'), 2)}}</a>
                                </div>
                        </div>
                        <div style="float:left;margin-right:20px;padding-right:20px;border-right:2px solid #e0dfdf">
                            <p align="left" class="font-body--md-400 designation">Balance</p>
                            <div style="margin-top:-10px">
                                <a href="#" class="edit font-body--lg-500" style="font-size:20px">{!!$shop->country->currency->symbol!!}{{number_format($shop->wallet, 2)}}</a>
                            </div>
                        </div>
                        <div style="float:left;margin-right:10px">
                          <p align="left" class="font-body--md-400 designation">Unavailable Balance</p>
                          <div style="margin-top:-10px">
                              <a href="#" class="edit font-body--lg-500" style="font-size:20px">{!!$shop->country->currency->symbol!!}{{number_format(
                                  $shop->orders->filter(function($value){
                                        return $value->statuses->isNotEmpty() && $value->statuses->whereNotIn('name',['completed','cancelled'])->count();
                                    })->sum('subtotal') , 2)}}
                              </a>
                          </div>
                      </div>
                    </div>
                    @if($shop->user_id == auth()->id())
                    <div>
                        <a href="{{route('vendor.shop.payouts',$shop)}}" class="edit font-body--lg-500">Request Payout</a>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <!-- User Billing Address -->
              <div class="col-lg-5">
                <div class="dashboard__user-billing dashboard-card">
                  <h2 class="dashboard__user-billing-title font-body--md-500">
                    Shop Info
                  </h2>
                  <div class="dashboard__user-billing-info">
                    <h5 class="dashboard__user-billing-name font-body--xl-500" >
                      Status: 
                      @if($shop->status) 
                        <span class="iconify" style="color:#00b207" data-icon="akar-icons:check-box-fill" data-width="20" data-height="20">Active </span>
                       @else 
                        <span class="iconify" style="color:#b20000" data-icon="akar-icons:check-box-fill" data-width="20" data-height="20">Inactive </span>
                      @endif
                    </h5>
                    <p class="dashboard__user-billing-location font-body--md-400"> {{$shop->address}}, {{$shop->state->name}} </p>
                    <p class="dashboard__user-billing-email font-body--lg-400" > {{$shop->email}} </p>
                    <p class="dashboard__user-billing-number font-body--lg-400" > {{$shop->mobile}} </p>
                  </div>
                  @if($shop->user_id == auth()->id())
                  <a href="{{route('vendor.shop.settings',$shop)}}" class="dashboard__user-billing-editaddress font-body--lg-500" > Shop Settings</a>
                  @endif
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
                          <h5 class="title">Shop Details</h5>
                          {{-- <p class="details order-id"> {{$order->trackingcode}}</p> --}}
                        </div>
                      </div>
                    </div>

                    <div class="dashboard__totalpayment-card-body">
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Status:</h5>
                        <p class="font-body--md-500">
                          @if($shop->status) Active @else Inactive @endif
                        </p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Visibility:</h5>
                        <p class="font-body--md-500">{{$shop->published ? 'Published': 'Draft'}}</p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Approval Status:</h5>
                        <p class="font-body--md-500">{{$shop->approved ? 'Approved': 'Pending Approval'}}</p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Shop Orders:</h5>
                        <p class="font-body--md-500"> {{number_format($shop->orderStatuses->unique('order_id')->count())}}</p>
                      </div>
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Products:</h5>
                        <p class="font-body--md-500">{{number_format($shop->products->count())}}</p>
                      </div>
                      
                      {{-- <div class="dashboard__totalpayment-card-body-item total" >
                        <h5 class="font-body--xl-400">Total:</h5>
                        <p class="font-body--xl-500">{!!$shop->country->currency->symbol!!} {{number_format($order->total, 2)}}</p>
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
                      @forelse($shop->unreadNotifications as $notification)
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

            <div class="my-3">
              <div class="row">
                @if($shop->user_id == auth()->id())
                <div class="col-lg-6">
                  <div class="dashboard__order-history">
                    <div class="dashboard__order-history-title">
                        <h2 class="font-body--xl-500">Recent Payouts</h2>
                        <a href="{{route('vendor.shop.payouts',$shop)}}" class="font-body--lg-500"> View All</a>
                    </div>
                    <div class="dashboard__order-history-table">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title"> Date </th>
                                <th scope="col" class="dashboard__order-history-table-title"> Amount </th>
                                <th scope="col" class="dashboard__order-history-table-title"> Status</th>   
                            </tr>
                            </thead>
                            <tbody>                     
                                @forelse($shop->payouts->sortByDesc('updated_at')->take(5) as $payout)                                       
                                    <tr>
                                        <td class="dashboard__order-history-table-item order-date "> 
                                          {{$payout->created_at->format('Y-m-d')}}
                                        </td>
                                        <!-- Vendor Split  -->
                                        <td class="dashboard__order-history-table-item order-total "> 
                                            <p class="order-total-price">   {!!$shop->country->currency->symbol!!}{{number_format($payout->amount, 0)}} 
                                            </p>
                                        </td>
                                        
                                        <td class="dashboard__order-history-table-item order-details" style="text-align: left!important"> 
                                            <span class="@if($payout->status == 'pending' || $payout->status == 'processing') text-warning @elseif($payout->status == 'rejected') text-danger @else text-success @endif">
                                                {{$payout->status}}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                      <td colspan="3" class="text-center">
                                        <div style="padding:1%;margin-bottom:5%">
                                          <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                          <br />You have no payouts at this time.
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
                @endif
                <div class="col-lg-6">
                  <div class="dashboard__order-history">
                    <div class="dashboard__order-history-title">
                      <h2 class="font-body--xl-500">Recent Order Updates</h2>
                      <a href="{{route('vendor.shop.order.list',$shop)}}" class="font-body--lg-500">
                        All Orders</a>
                    </div>
                    <div class="dashboard__order-history-table">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                             
                              <th scope="col" class="dashboard__order-history-table-title"> Date</th>
                              <th scope="col" class="dashboard__order-history-table-title"> Total</th>
                              <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                              <th scope="col" class="dashboard__order-history-table-title"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($shop->orderStatuses->take(5) as $status)
                                  
                                  <tr>
                                      
                                      <!-- Date  -->
                                      <td class="   dashboard__order-history-table-item   order-date "> {{$status->created_at->format('Y-m-d')}}</td>
                                      <!-- Total  -->
                                      <td class="   dashboard__order-history-table-item   order-total "> 
                                          <p class="order-total-price">   {!!$shop->country->currency->symbol!!}{{number_format($status->order->total, 0)}} </p>
                                      </td>
                                      <!-- Status -->
                                      <td class="dashboard__order-history-table-item   order-status "> {{ucwords($status->name)}}</td>
                                      <!-- Details page  -->
                                      <td class="dashboard__order-history-table-item   order-details ">
                                          <a href="{{route('vendor.shop.order.view',[$shop,$status->order])}}">
                                              <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24"></span>
                                          </a>
                                      </td>
                                  </tr>
                                  
                              @empty
                              <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                  <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                  <br />You have no orders at this time.
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
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
@endsection
@push('scripts')

@endpush
