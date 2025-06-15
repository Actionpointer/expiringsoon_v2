@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

@endpush
@section('title') Manage Shipping | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
    <div class="section breedcrumb">
        <div class="breedcrumb__img-wrapper">
        <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
                <a href="#">
                Admin
                <span> > </span>
                </a>
            </li>
            <li class="active"><a href="#">Shipping</a></li>
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
                    <div class="dashboard__order-history">
                        <div class="dashboard__order-history-title">
                            <p class="font-body--xl-500">Shipping History</p>
                            
                        </div>
                        <div class="dashboard__order-history-table">
                            <div class="m-4">
                                <div class="accordion mb-3" id="faq-accordion">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Manage
                                      </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                                      <div class="accordion-body">
                                        <form action="{{route('admin.shipments.index')}}" method="get">
                                          <div class="row location">
                                            @if(auth()->user()->role->name == 'superadmin')                                  
                                              <div class="col-md-3">
                                                <label>Select Country</label>
                                                  <select name="country_id" id="country_id" class="select2 country">
                                                      <option></option>
                                                      <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$shipments->total()}}</option>
                                                      @foreach ($countries->sortBy('name') as $country)
                                                        <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->shipments->count()}}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                            @endif
                                            <div class="col-md-3">
                                                <label>Select Status</label>
                                                <select name="status" id="filter_origin_id" class="select2 states">
                                                    <option value="all" @if($status == 'all') selected @endif>All </option>
                                                    <option value="delivered" @if($status == "delivered") selected @endif>Delivered</option>
                                                    <option value="shipped" @if($status == "shipped") selected @endif>Shipped</option>
                                                    <option value="ready" @if($status == "ready") selected @endif>Ready</option> 
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <label>Shipper</label>
                                                <input type="text" name="name" class="form-control like_select2" value="{{$name}}" placeholder="Search Shipper" style="height:50px">
                                            </div>

                                            <div class="col-md-3">
                                              <label>Sort</label>
                                              <select name="sortBy" id="sort-byd" class="form-control like_select2" style="height:50px;">
                                                
                                                <option value="delivery_asc" @if($sortBy == 'delivery_asc') selected @endif>Sort by: Delivery Date Asc</option>
                                                <option value="delivery_desc" @if($sortBy == 'delivery_desc') selected @endif>Sort by: Delivery Date Desc</option>
                                                <option value="shipped_asc" @if($sortBy == 'shipped_asc') selected @endif>Sort by: Shipped Date Asc</option>
                                                <option value="shipped_desc" @if($sortBy == 'shipped_desc') selected @endif>Sort by: Shipped Date Desc</option>  
                                                <option value="ready_asc" @if($sortBy == 'ready_asc') selected @endif>Sort by: Ready Date Asc</option>
                                                <option value="ready_desc" @if($sortBy == 'ready_desc') selected @endif>Sort by: Ready Date Desc</option>      
                                              </select>
                                            </div>
                                            
                                            <div class="row mt-3 justify-content-center">
                                              <div class="col-md-2">
                                                <button class="button button--md" name="download" value="0">Filter</button>
                                              </div>
                                              
                                            </div>
                                            
                                          </div> 
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="cart-table-title">Shipper</th>
                                        <th scope="col" class="cart-table-title">Amount</th>
                                        <th scope="col" class="cart-table-title">Order Date</th>
                                        <th scope="col" class="cart-table-title">Ready</th>
                                        <th scope="col" class="cart-table-title">Shipped</th>
                                        <th scope="col" class="cart-table-title">Delivered</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($shipments as $shipment)    
                                        <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                            <!-- item  -->
                                            <td class="cart-table-item order-date align-middle">
                                                <div style="margin-top:10px">
                                                    <span class="font-body--lg-500">
                                                        <a href="{{route('shipment')}}" style="color:#00b207">{{$shipment->rate->company_name}}</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <!-- Price  -->
                                            <td class="cart-table-item order-date align-middle">
                                                <p class="font-body--lg-500" style="color:#000">{!!session('locale')['currency_symbol']!!}{{number_format($shipment->amount, 2)}}</p>
                                            </td>

                                            <td class="cart-table-item order-date align-middle">  
                                                
                                                    <span style="font-size:12px;color:#888">{{$shipment->order->created_at->format('l, F d, Y')}}</span>
                                                
                                            </td>
                                            <!-- Stock Status  -->
                                            <td class="cart-table-item order-date align-middle">  
                                                @if($shipment->ready_at) 
                                                    <span style="font-size:12px;color:#888">{{$shipment->ready_at->format('l, F d, Y')}}</span>
                                                @else
                                                    <p style="color:#d92e2e;font-size:14px"><span id="status">Pending</span></p>
                                                @endif
                                            </td>
                                            <td class="cart-table-item order-date align-middle">  
                                                @if($shipment->ready_at && $shipment->shipped_at) 
                                                    <span style="font-size:12px;color:#888">{{$shipment->shipped_at->format('l, F d, Y')}}</span>
                                                @elseif($shipment->ready_at)
                                                    <a href="{{route('shipment')}}" style="color:#00b207">Manage </a>
                                                @else 
                                                    <p style="color:#d92e2e;font-size:14px"><span id="status">Pending</span></p>
                                                @endif
                                            </td>
                                            <td class="cart-table-item add-cart align-middle">
                                                @if($shipment->shipped_at && $shipment->delivered_at) 
                                                    <span style="font-size:12px;color:#888">{{$shipment->delivered_at->format('l, F d, Y')}}</span>
                                                @elseif($shipment->shipped_at)
                                                    <a href="{{route('shipment')}}" style="color:#00b207">Manage </a>
                                                @else 
                                                    <p style="color:#d92e2e;font-size:14px"><span id="status">Pending</span></p>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No shipment</td>
                                        </tr>
                                    @endforelse
                                    
                                    </tbody>
                                </table>
                            </div>
                            @include('layouts.pagination',['data'=> $shipments])
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