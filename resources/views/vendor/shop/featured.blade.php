@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

@endpush
@section('title') Shops | Expiring Soon @endsection
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
          
          <li class="active"><a href="#">Shops</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('vendor.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            
            {{-- <div class="container"> --}}
              <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Shops</h2>
                    <a href="{{route('vendor.shop.create')}}" class="font-body--lg-500">
                      Create Shop</a>
                </div>
                <div class="dashboard__order-history-table">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="dashboard__order-history-table-title"> Shop
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
                                    <!-- Vendor Split  -->
                                    <td class="dashboard__order-history-table-item order-total "> 
                                        <p class="order-total-price">   {{number_format($shop->products->count(), 0)}} </p>
                                    </td>
                                    <!-- Site Split  -->
                                    <td class="dashboard__order-history-table-item order-total"> 
                                        <p class="order-total-price">   {!!cache('settings')['currency_symbol']!!}{{number_format($shop->orders->sum('total'), 0)}} </p>
                                    </td>
                                    <!-- Status -->
                                    <td class="dashboard__order-history-table-item   order-status "> unavailable</td>
                                    <td class="dashboard__order-history-table-item   order-status "> {{number_format($shop->wallet,2)}}</td>
                                    <!-- Details page  -->
                                    <td class="dashboard__order-history-table-item   order-details "> 
                                        <a href="{{route('shop.dashboard',$shop)}}">
                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Go to Dashboard
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                    <p>You have no orders at this time.</p><br>
                                    <a href="{{route('vendor.shop.create')}}">Create Shop</a>
                                    
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            {{-- </div> --}}
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush