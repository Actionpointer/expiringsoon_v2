@extends('layouts.app')
@push('styles')

@endpush
@section('title'){{$user->fname.' '.$user->lname}} | User Dashboard @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg
                width="18"
                height="19"
                viewBox="0 0 18 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
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

  <?php
  if(isset($_GET['top']) && $_GET['top']=='1'){
  echo'
  <div class="notify">
  <p style="color:#fff">You topped up your Wallet</p>
  </div>
  ';
  }
  if(isset($_GET['top']) && $_GET['top']!=='1'){
    echo'
    <div class="error">
    <p style="color:#fff">Error Processing Payment</p>
    </div>
    ';
  }
  ?>

  <!-- dashboard Secton Start  -->
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
                    <img @if(!$user->pic) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->fname}} {{$user->lname}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xl-500 name">{{$user->fname}} {{$user->lname}}</h5>
                    
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
                                <a href="#" class="edit font-body--lg-500" style="font-size:20px">N{{number_format($user->shops->sum('wallet'), 2)}}</a>
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
                    <a href="{{route('shop.create')}}" class="font-body--lg-500">
                      Create Shop</a>
                </div>
                <div class="dashboard__order-history-table">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="dashboard__order-history-table-title"> Shop
                            </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Date
                            </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Products
                            </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Sales
                            </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Profit
                            </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Wallet
                            </th>
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
                                    <!-- Date  -->
                                    <td class="dashboard__order-history-table-item order-date "> {{$shop->status? 'Active':'Pending'}} | {{$shop->created_at->format('Y-m-d')}}
                                    </td>
                                    <!-- Vendor Split  -->
                                    <td class="dashboard__order-history-table-item order-total "> 
                                        <p class="order-total-price">   {{number_format($shop->products->count(), 0)}} </p>
                                    </td>
                                    <!-- Site Split  -->
                                    <td class="dashboard__order-history-table-item order-total"> 
                                        <p class="order-total-price">   N{{number_format($shop->orders->sum('total'), 0)}} </p>
                                    </td>
                                    <!-- Status -->
                                    <td class="dashboard__order-history-table-item   order-status "> unavailable</td>
                                    <td class="dashboard__order-history-table-item   order-status "> {{number_format($shop->wallet,2)}}</td>
                                    <!-- Details page  -->
                                    <td class="dashboard__order-history-table-item   order-details "> 
                                        <a href="#">
                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                    <p>You have no orders at this time.</p><br>
                                    <a href="{{route('shop.create')}}">Create Shop</a>
                                    
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            
            <!-- Staff -->
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Staff</h2>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Name</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Email</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Phone</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Shop</th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($user->shops as $shop)
                          @foreach ($shop->users->where('id','!=',$user->id) as $staff)
                            <tr>
                              <!-- Order Id  -->
                              <td class="dashboard__order-history-table-item order-status"> 
                                  <span style="font-weight:500">#{{$staff->lname.' '.$staff->fname}}</span>
                              </td>
                              <!-- Date  -->
                              <td class="dashboard__order-history-table-item   order-date "> {{$staff->email}}</td>
                              <!-- Total  -->
                              <td class="   dashboard__order-history-table-item   order-total "> {{$staff->phone}}  </td>
                              <!-- Status -->
                              <td class="dashboard__order-history-table-item order-status "> {{$staff->shops->first()->name}} </td>
                              <!-- Details page  -->
                              <td class="dashboard__order-history-table-item order-details ">
                  
                                  <p class="d-flex">  
                                      <a href="{{route('cart')}}"> Edit</a>
                                      <a href="#" class="mx-2">Delete </a>
                                  </p>
                                  
                                    
                                  
                              </td>
                            </tr>
                          @endforeach 
                        @empty
                        <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <br />You have no staff at this time.
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
