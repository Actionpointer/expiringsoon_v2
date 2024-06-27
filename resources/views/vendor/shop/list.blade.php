@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
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
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.vendor_navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          
            
              <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Shops</h2>
                    <a href="{{route('vendor.shop.create')}}" class="font-body--lg-500">
                      Create Shop</a>
                </div>
                <div class="products-tab__btn">
                  <div class="container">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-live-tab" data-bs-toggle="pill" data-bs-target="#pills-live" type="button" role="tab" aria-controls="pills-live" aria-selected="true">
                                  Live ({{$shops->where('status','live')->count()}})
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-hidden-tab" data-bs-toggle="pill" data-bs-target="#pills-hidden" type="button" role="tab" aria-controls="pills-hidden" aria-selected="false">
                              Hidden ({{$shops->where('status','hidden')->count()}})
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-approval-tab" data-bs-toggle="pill" data-bs-target="#pills-approval" type="button" role="tab" aria-controls="pills-approval" aria-selected="false">
                                Pending Approval ({{$shops->where('status','pending')->count()}})
                            </button>
                          </li>

                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-inactive-tab" data-bs-toggle="pill" data-bs-target="#pills-inactive" type="button" role="tab" aria-controls="pills-inactive" aria-selected="false">
                                  Inactive ({{$shops->where('status','inactive')->count()}})
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-rejected-tab" data-bs-toggle="pill" data-bs-target="#pills-rejected" type="button" role="tab" aria-controls="pills-rejected" aria-selected="false">
                                  Rejected ({{$shops->where('status','rejected')->count()}})
                              </button>
                          </li>
                      </ul>
                  </div>
                </div>
                <div class="products-tab__content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-live" role="tabpanel" aria-labelledby="pills-live-tab">
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
                                        <th scope="col" class="dashboard__order-history-table-title"> Earnings
                                        </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Wallet
                                        </th>
                                        <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                    </thead>
                                    <tbody>                     
                                        @forelse($shops->where('status','live') as $shop)        
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
                                                    <p class="order-total-price">   {!!$shop->country->currency->symbol!!}
                                                        {{number_format($shop->orders->filter(function($value){ return $value->statuses->count(); })->sum('subtotal') , 0)}} 
                                                    </p>
                                                </td>
                                                <!-- Status -->
                                                <td class="dashboard__order-history-table-item   order-status "> {!!$shop->country->currency->symbol!!} 
                                                        {{number_format(
                                                            $shop->orders->filter(function($value){ return $value->statuses->count() && $value->statuses->whereIn('name',['completed','closed'])->count(); })->sum('subtotal')
                                                        ,2)}}
                                                </td>
                                                <td class="dashboard__order-history-table-item   order-status "> {!!$shop->country->currency->symbol!!} {{number_format($shop->wallet,2)}}</td>
                                                <!-- Details page  -->
                                                <td class="dashboard__order-history-table-item   order-details "> 
                                                    <a href="{{route('vendor.shop.show',$shop)}}">
                                                        <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Go to Storefront
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">
                                              <div style="margin:auto;padding:1%;text-align:center;">
                                                <a href="{{route('vendor.shop.create')}}">Create Shop</a>
                                                
                                              </div>
                                            </td>
                                        </tr>
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-hidden" role="tabpanel" aria-labelledby="pills-hidden-tab">
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
                                        <th scope="col" class="dashboard__order-history-table-title"> Earnings
                                        </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Wallet
                                        </th>
                                        <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                    </thead>
                                    <tbody>                     
                                        @forelse($shops->where('status','hidden') as $shop)        
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
                                                    <p class="order-total-price">   {!!$shop->country->currency->symbol!!}
                                                        {{number_format($shop->orders->filter(function($value){ return $value->statuses->count(); })->sum('subtotal') , 0)}} 
                                                    </p>
                                                </td>
                                                <!-- Status -->
                                                <td class="dashboard__order-history-table-item   order-status "> {!!$shop->country->currency->symbol!!} 
                                                        {{number_format(
                                                            $shop->orders->filter(function($value){ return $value->statuses->count() && $value->statuses->whereIn('name',['completed','closed'])->count(); })->sum('subtotal')
                                                        ,2)}}
                                                </td>
                                                <td class="dashboard__order-history-table-item   order-status "> {!!$shop->country->currency->symbol!!} {{number_format($shop->wallet,2)}}</td>
                                                <!-- Details page  -->
                                                <td class="dashboard__order-history-table-item   order-details "> 
                                                    <a href="{{route('vendor.shop.show',$shop)}}">
                                                        <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Go to Storefront
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="border-0">
                                              <div class="text-center">
                                                  No Shop in Category
                                              </div>
                                            </td>
                                        </tr>
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        <!-- Countries -->
                        <div class="tab-pane fade" id="pills-approval" role="tabpanel" aria-labelledby="pills-approval-tab">
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
                                        <th scope="col" class="dashboard__order-history-table-title"> Earnings
                                        </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Wallet
                                        </th>
                                        <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                    </thead>
                                    <tbody>                     
                                        @forelse($shops->where('status','pending') as $shop)        
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
                                                    <p class="order-total-price">   {!!$shop->country->currency->symbol!!}
                                                        {{number_format($shop->orders->filter(function($value){ return $value->statuses->count(); })->sum('subtotal') , 0)}} 
                                                    </p>
                                                </td>
                                                <!-- Status -->
                                                <td class="dashboard__order-history-table-item   order-status "> {!!$shop->country->currency->symbol!!} 
                                                        {{number_format(
                                                            $shop->orders->filter(function($value){ return $value->statuses->count() && $value->statuses->whereIn('name',['completed','closed'])->count(); })->sum('subtotal')
                                                        ,2)}}
                                                </td>
                                                <td class="dashboard__order-history-table-item   order-status "> {!!$shop->country->currency->symbol!!} {{number_format($shop->wallet,2)}}</td>
                                                <!-- Details page  -->
                                                <td class="dashboard__order-history-table-item   order-details "> 
                                                    <a href="{{route('vendor.shop.show',$shop)}}">
                                                        <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Go to Storefront
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="border-0">
                                              <div class="text-center">
                                                  No Shop in Category
                                              </div>
                                            </td>
                                        </tr>
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        
                       
                        <div class="tab-pane fade" id="pills-inactive" role="tabpanel" aria-labelledby="pills-inactive-tab">
                            <div class="dashboard__order-history-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                                            <th scope="col" class="dashboard__order-history-table-title"> Fault </th>
                                            
                                            <th scope="col" class="dashboard__order-history-table-title"></th>
                                        </tr>
                                        </thead>
                                        <tbody>                     
                                            @forelse($shops->where('status','inactive') as $shop)        
                                                <tr>
                                                    <!-- Order Id  -->
                                                    <td class="dashboard__order-history-table-item order-id"> 
                                                        <span style="font-weight:500">{{$shop->name}}</span><br/>
                                                    </td>
                                                    <!-- Vendor Split  -->
                                                    <td class="dashboard__order-history-table-item order-total "> 
                                                        <p class="order-total-price">   {{$shop->fault}} </p>
                                                    </td>
                                                    
                                                    <td class="dashboard__order-history-table-item   order-details "> 
                                                        @if ($shop->rates->isEmpty() || !$shop->dimension_rate)
                                                        <a href="{{route('vendor.shop.shipping',$shop)}}">
                                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Shop Shipment
                                                            </span>
                                                        </a>
                                                        @else
                                                        <a href="{{route('vendor.shop.settings',$shop)}}">
                                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Shop Settings
                                                            </span>
                                                        </a>  
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="border-0">
                                                  <div class="text-center">
                                                      No Shop in Category
                                                  </div>
                                                </td>
                                            </tr>
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 

                        <div class="tab-pane fade" id="pills-rejected" role="tabpanel" aria-labelledby="pills-rejected-tab">
                            <div class="dashboard__order-history-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                                            <th scope="col" class="dashboard__order-history-table-title"> Reason </th>
                                            <th scope="col" class="dashboard__order-history-table-title"></th>
                                        </tr>
                                        </thead>
                                        <tbody>                     
                                            @forelse($shops->where('status','rejected') as $shop)        
                                                <tr>
                                                    <!-- Order Id  -->
                                                    <td class="dashboard__order-history-table-item order-id"> 
                                                        <span style="font-weight:500">{{$shop->name}}</span><br/>
                                                    </td>
                                                    <!-- Vendor Split  -->
                                                    <td class="dashboard__order-history-table-item order-total "> 
                                                        <p class="order-total-price">   {{$shop->rejected->reason}} </p>
                                                    </td>
                                                    
                                                    
                                                    <td class="dashboard__order-history-table-item   order-details "> 
                                                        <a href="{{route('vendor.shop.settings',$shop)}}">
                                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">Store Settings
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="border-0">
                                                  <div class="text-center">
                                                      No Shop in this Category
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


@endsection
@push('scripts')

@endpush