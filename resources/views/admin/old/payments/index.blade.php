@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/css/custom.css')}}"/>

@endpush
@section('title') Payments | Expiring Soon @endsection
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
            <a href="#">
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Payments</a></li>
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
        <div class="col-lg-9 section--xl pt-0" style="font-size:13px">
          <div class="container">
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title border-bottom">
                <h2 class="font-body--xl-500">Payments</h2>
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
                            <form action="{{route('admin.payments')}}" method="get">
                              <div class="row">
                                @if(auth()->user()->role->name == 'superadmin')                                  
                                  <div class="col-md-3">
                                    <label>Select Country</label>
                                      <select name="country_id" id="country_id" class="select2">
                                          <option></option>
                                          <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$payments->total()}}</option>
                                          @foreach ($countries->sortBy('category') as $country)
                                            <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->payments->count()}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                @endif
                                
                                <div class="col-md-3">
                                    <label>Select Types</label>
                                    <select name="description" id="description" class="select2">
                                      <option></option>
                                      <option value="all" @if($status == 'all') selected @endif>All</option>
                                      <option value="Order" @if($status == 'Order') selected @endif>Orders</option>
                                      <option value="Subscription" @if($status == 'Subscription') selected @endif>Subscription</option>
                                      <option value="Adset" @if($status == 'Adset') selected @endif>Adsets</option>  
                                    </select>
                                </div>
                                <div class="col-md-3">
                                  <label>Select Types</label>
                                  <select name="status" id="status" class="select2">
                                      <option></option>
                                      <option value="all" @if($status == 'all') selected @endif>Select Status </option>
                                      <option value="success" @if($status == 'success') selected @endif>Success </option>
                                      <option value="pending" @if($status == 'pending') selected @endif>Pending </option>
                                      <option value="failed" @if($status == 'failed') selected @endif>Failed </option>
                                      <option value="cancelled" @if($status == 'cancelled') selected @endif>Cancelled </option>
                                  </select>
                                </div>
                
                                <div class="col-md-4">
                                    <label for="">Date range</label>
                                    <div class="input-group d-flex">
                                      <div class="prepend">
                                          <input type="date" min="{{$min_date}}" name="from_date" class="form-control-sm border text-secondary" style="height:50px;" />
                                      </div>
                                      <div>
                                          <input type="date" max="{{$max_date}}" name="to_date" class="form-control-sm border text-secondary" style="height:50px;"  />
                                      </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                  <label>Sort</label>
                                  <select name="sortBy" id="sort-byd" class="form-control like_select2">
                                    <option value="date_asc" @if($sortBy == 'date_asc') selected @endif>Sort by: Date Asc</option>
                                    <option value="date_desc" @if($sortBy == 'date_desc') selected @endif>Sort by: Date Desc</option>  
                                  </select>
                                </div>
                                
                                <div class="row mt-3 justify-content-center">
                                  <div class="col-md-2">
                                    <button class="button button--md" name="download" value="0">Filter</button>
                                  </div>
                                  @can('download','App\Models\Payment')
                                  <div class="col-md-2">
                                    <button class="button button--md" name="download" value="1">Download</button>
                                  </div>
                                  @endcan
                                </div>
                                
                              </div> 
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
        
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <tr>
                          <th scope="col" class="dashboard__order-history-table-title">Date</th>
                          <th scope="col" class="dashboard__order-history-table-title">Transaction ID</th>
                          <th scope="col" class="dashboard__order-history-table-title">User</th>
                          
                          <th scope="col" class="dashboard__order-history-table-title">Status</th>
                          <th scope="col" class="dashboard__order-history-table-title">Discount</th>
                          <th scope="col" class="dashboard__order-history-table-title">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                <!-- item  -->
                                <td class="cart-table-item order-date align-middle">
                                    <span style="font-size:12px;color:#888">{{ $payment->created_at->format('jS F, Y')}}</span>
                                </td>
                                <td class="cart-table-item order-date align-middle">
                                  <a href="{{route('invoice',$payment)}}" target="_blank">{{$payment->reference}}</a>
                                </td>
                                <!-- Price  -->
                                <td class="cart-table-item order-date align-middle">
                                    {{$payment->user->name}}
                                </td>
                                <td class="cart-table-item order-date align-middle">
                                    
                                  @if($payment->status =='pending')
                                      <p style="color:#d9862e;font-size:14px"><span id="status">{{ $payment->status}}</span></p>
                                  @elseif($payment->status =='failed' || $payment->status =='cancelled')
                                      <p style="color:#d92e2e;font-size:14px"><span id="status">{{ $payment->status}}</span></p>
                                  @else
                                      <p style="color:#00b207;font-size:14px;font-weight:500">{{ $payment->status}}</p>
                                  @endif
                              </td>
                                <td class="cart-table-item order-date align-middle">
                                    <p class="font-body--lg-500" style="color:#00b207">{!!$payment->user->country->currency->symbol!!}{{ number_format($payment->coupon_value)}}</p>
                                </td>
                                <td class="cart-table-item order-date align-middle">
                                  <p class="font-body--lg-500" style="color:#00b207">{!!$payment->user->country->currency->symbol!!}{{ number_format($payment->payable, 2)}}</p>
                                </td>
                                
                                
                                
                            </tr>   
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                <br />No Payment Requests at this time.</span>
                            </div>
                        @endforelse
                        
                    </tbody>
                  </table>
                  
                </div>
                @include('layouts.pagination',['data'=> $payments])
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