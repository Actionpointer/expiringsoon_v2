@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

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
                    <img src="{{asset('img/avatar.png')}}" alt="{{$user->fname}} {{$user->lname}}" />
                  </div>
                  <div class="dashboard__user-profile-info">
                    <h5 class="font-body--xxl-500 name">Hi, {{$user->fname.' '.$user->lname}}</h5>
                    <p class="font-body--md-400 designation">Admin</p>
                  </div>
                </div>
              </div>
              <!-- User Billing Address -->
              <div class="col-lg-5">
                <div class="dashboard__user-billing dashboard-card">
                  <h2 class="dashboard__user-billing-title font-body--md-500">
                    Summary
                  </h2>
                  <div class="dashboard__user-billing-info">
                    <p
                      class="
                        dashboard__user-billing-location
                        font-body--md-400
                      "
                    >
                      Total Products
                    </p>
                    <h5
                      class="dashboard__user-billing-name font-body--xl-500"
                    >
                      --33--
                    </h5>
                    <p
                      class="
                        dashboard__user-billing-location
                        font-body--md-400
                      "
                    >
                      Total Sales
                    </p>
                    <h5
                      class="dashboard__user-billing-name font-body--xl-500"
                    >
                      N--0--
                    </h5>
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
                        <th scope="col" class="dashboard__order-history-table-title"> User Details</th>
                        <th scope="col" class="dashboard__order-history-table-title"> Date
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Status
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        @forelse ($documents as $document)
                            <tr>
                                <!-- Order Id  -->
                                <td class="dashboard__order-history-table-item order-id" >
                                    <img @if(!$document->shop->banner) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($document->shop->banner)}}" @endif alt="{{$document->shop->fname}} {{$document->shop->lname}}" style="width:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                </td>
                                <!-- Date  -->
                                <td class="dashboard__order-history-table-item order-date">
                                    <p class="order-total-price">
                                        {{$document->shop->fname}} {{$document->shop->lname}}
                                        <br />
                                        <span style="font-size:12px;color:#888">
                                            {{$document->shop->email}}
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
                                    <span style="color:#ff0000">Pending</span>
                                </td>
                                <!-- Details page  -->
                                <td class=" dashboard__order-history-table-item order-details ">
                                    <a href="admin-editcustomer.php?uid={{$document->shop->id}}"> View User</a>
                                </td>
                            </tr>
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                                <br />No pending documents at this time
                            </div>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Order History  -->
            <div class="dashboard__order-history" style="margin-top: 24px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Recent Orders</h2>
                <a href="admin-orders.php" class="font-body--lg-500">See All</a>
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
                        <th scope="col" class="dashboard__order-history-table-title"> Status
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @forelse ($orders as $order)
                            @php $deliveryfee = 500 @endphp
                        <tr>
                            <!-- Order Id  -->
                            <td class="dashboard__order-history-table-item order-id"> 
                                <span style="font-weight:500">#{{$order->orderid}}</span>
                            </td>
                            <!-- Date  -->
                            <td class="dashboard__order-history-table-item order-date "> 
                                {{$order->dateadded}}
                            </td>
                            <!-- Total  -->
                            <td class="   dashboard__order-history-table-item   order-total "> 
                                <p class="order-total-price">   N{{ number_format($order->total + $deliveryfee + ($order->total * 0.5), 0)}} </p>
                            </td>
                            <!-- Status -->
                            <td class="   dashboard__order-history-table-item   order-status "> 
                                {{$order->deliverystatus}}
                            </td>
                            <!-- Details page  -->
                            <td class="   dashboard__order-history-table-item   order-details "> 
                                <a href="admin-invoice.php?ref={{$order->orderid}}"> View Details</a>
                            </td>
                        </tr>
                      @empty
                      <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}"><br />You have no orders at this time.
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