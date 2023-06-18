@extends('layouts.app')
@push('styles')
<meta property="og:title" content="Check out {{ucwords($shop->name)}} on Expiring Soon| Amazing Discounts ongoing">
<meta property="og:type" content="article" />
<meta property="og:image" content="{{$shop->image}}">
<meta property="og:description" content="Rush hour discount offers on all products at {{route('vendor.show',$shop)}}. Buy Now while stock last">
<meta property="og:url" content="{{route('vendor.show',$shop)}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@site_username">
<meta name="twitter:title" content="Check out {{ucwords($shop->name)}} on Expiring Soon| Amazing Discounts ongoing">
<meta name="twitter:description" content="Rush hour discount offers on all products at {{route('vendor.show',$shop)}}. Buy Now while stock last">
<meta name="twitter:creator" content="@creator_username">
<meta name="twitter:image" content="{{$shop->image}}">
<meta name="twitter:domain" content="https://expiringsoon.shop">
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
                  <div class="social-site mt-3">
                            
                    <ul class="social-icon">
                        <li class="pt-2 pe-2">Share:</li>
                        <li class="social-icon-link">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{route('vendor.show',$shop)}}" 
                            target="_blank"
                            rel="noopener noreferrer" >
                                <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.99764 2.98875H9.64089V0.12675C9.35739 0.08775 8.38239 0 7.24689 0C4.87764 0 3.25464 1.49025 3.25464 4.22925V6.75H0.640137V9.9495H3.25464V18H6.46014V9.95025H8.96889L9.36714 6.75075H6.45939V4.5465C6.46014 3.62175 6.70914 2.98875 7.99764 2.98875Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="social-icon-link">
                            <a href="https://twitter.com/intent/tweet?text=Get Unbelievable Discount on {{$shop->name}} at {{route('vendor.show',$shop)}}" target="_blank" rel="noopener noreferrer">
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18 2.41888C17.3306 2.7125 16.6174 2.90713 15.8737 3.00163C16.6388 2.54488 17.2226 1.82713 17.4971 0.962C16.7839 1.38725 15.9964 1.68763 15.1571 1.85525C14.4799 1.13413 13.5146 0.6875 12.4616 0.6875C10.4186 0.6875 8.77387 2.34575 8.77387 4.37863C8.77387 4.67113 8.79862 4.95238 8.85938 5.22013C5.7915 5.0705 3.07687 3.60013 1.25325 1.36025C0.934875 1.91263 0.748125 2.54488 0.748125 3.2255C0.748125 4.5035 1.40625 5.63638 2.38725 6.29225C1.79437 6.281 1.21275 6.10888 0.72 5.83775C0.72 5.849 0.72 5.86363 0.72 5.87825C0.72 7.6715 1.99912 9.161 3.6765 9.50413C3.37612 9.58625 3.04875 9.62563 2.709 9.62563C2.47275 9.62563 2.23425 9.61213 2.01038 9.56263C2.4885 11.024 3.84525 12.0984 5.4585 12.1333C4.203 13.1154 2.60888 13.7071 0.883125 13.7071C0.5805 13.7071 0.29025 13.6936 0 13.6565C1.63462 14.7106 3.57188 15.3125 5.661 15.3125C12.4515 15.3125 16.164 9.6875 16.164 4.81175C16.164 4.64863 16.1584 4.49113 16.1505 4.33475C16.8829 3.815 17.4982 3.16588 18 2.41888Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                            </a>
                        </li>
                        <li class="social-icon-link">
                            <a target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/shareArticle?mini=false&url={{route('vendor.show',$shop)}}&title={{$shop->name}}&summary=Get unbeatable discount offers on all products at {{route('vendor.show',$shop)}} Buy Now while stock last&source=ExpiringSoon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"> <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/> </svg>
                            </a>
                        </li>
                        <li class="social-icon-link">
                            <a target="_blank" rel="noopener noreferrer" href="https://api.whatsapp.com/send?text=Check%20out%20{{$shop->name}}%20shop%20onExpiringSoon/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/> </svg>
                            </a>
                        </li>
                        
                    </ul>
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
                      <div class="dashboard__totalpayment-card-body-item">
                        <h5 class="font-body--md-400">Followers:</h5>
                        <p class="font-body--md-500">{{number_format($shop->followers->count())}}</p>
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
                      @forelse($shop->unreadNotifications->sortBy('created_at')->take(4) as $notification)
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
