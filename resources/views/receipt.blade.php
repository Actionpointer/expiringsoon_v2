@extends('layouts.app')
@push('styles')

@endpush
@section('title') Settlement #{{$settlement->id}} | Expiring Soon @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('home')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" > 
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Settlement
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Settlement #{{$settlement->reference}}</a></li>
        </ul>
      </div>
    </div>
</div>
<!-- breedcrumb section end   -->

  
@include('layouts.session')
<!-- dashboard Secton Start  -->
<div class="dashboard section">
  <div class="container">
    <div class="row dashboard__content">
      @include('layouts.navigation')
      <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Order Details  -->
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Settlement Details</h2>
                
              </div>

              <div class="dashboard__details-content">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="dashboard__details-card">
                      <div class="dashboard__details-card-item">
                        <h5 class="dashboard__details-card-title"> Beneficiary </h5>
                        <!-- billing Address -->
                        <div class="dashboard__details-card-item__inner">
                          <h2 class="font-body--lg-400 name">
                              {{$settlement->receiver->name}}
                          </h2>
                          <p class="font-body--md-400">
                              {{$settlement->receiver->state->name}}
                          </p>
                        </div>
                        <div class="dashboard__details-card-item__inner">
                          <div
                            class="dashboard__details-card-item__inner-contact">
                            <h5 class="title">Email</h5>
                            <p class="font-body--md-400">
                                {{$settlement->receiver->email}}
                            </p>
                          </div>
                          <div class=" dashboard__details-card-item__inner-contact">
                            <h5 class="title">Phone</h5>
                            <p class="font-body--md-400"> {{$settlement->receiver->mobile}}</p>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="dashboard__totalpayment-card">
                      <div class="dashboard__totalpayment-card-header">
                        <div class="dashboard__totalpayment-card-header">
                          <div class="dashboard__totalpayment-card-header-item">
                            <h5 class="title">Settlement Details:</h5>
                            
                          </div>
                        </div>
                      </div>

                      <div class="dashboard__totalpayment-card-body">
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Settlement Status:</h5>
                          <p class="font-body--md-500">
                              @if($settlement->status) 
                                Paid
                                @else Pending 
                              @endif
                          </p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Date:</h5>
                          <p class="font-body--md-500">{{$settlement->created_at->format('jS F Y')}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Medium:</h5>
                          <p class="font-body--md-500">Wallet</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Reference:</h5>
                          <p class="font-body--md-500">{{$settlement->reference}}</p>
                        </div>
                        @if($settlement->order->deliveryByVendor())
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Shipping</h5>
                          <p class="font-body--md-500">{!!$settlement->receiver->country->currency->symbol!!} {{number_format($settlement->order->deliveryfee,2)}}</p>
                        </div>
                        @endif
                        <div class="dashboard__totalpayment-card-body-item total" >
                          <h5 class="font-body--xl-400">Amount:</h5>
                          <p class="font-body--xl-500">{!!$settlement->receiver->country->currency->symbol!!} {{number_format($settlement->amount, 2)}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
              

              <div class="dashboard__order-history-table dashboard__order-history-table__product-content">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Item </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Amount </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Commission </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Earning </th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- Order  -->
                            <td class="dashboard__order-history-table-item align-middle">
                                <a href="{{route('order-details',$settlement->order)}}" class="dashboard__product-item d-flex" >
                                    <h5 class="font-body--md-400 flex-grow-1"> Earning for order #{{$settlement->order->id}}</h5>
                                    <h6 class="small">Click to view</h6>
                                </a>
                            </td>
                            <!-- Price  -->
                            <td class="dashboard__order-history-table-item order-date align-middle">
                                {!!$settlement->receiver->country->currency->symbol!!} {{number_format($settlement->order->subtotal, 2)}}
                            </td>
                            <!-- commission -->
                            <td class="dashboard__order-history-table-item order-total align-middle">
                              <p class="order-total-price">{!!$settlement->receiver->country->currency->symbol!!}  {{number_format($settlement->order->commission(),2)}}</p>
                            </td>
                            <!-- Subtotal  -->     
                            <td class="dashboard__order-history-table-item order-status align-middle " style="text-align: left" >
                                <p class="font-body--md-500">{!!$settlement->receiver->country->currency->symbol!!} {{number_format($settlement->order->earning(), 2)}}</p>
                            </td>
                        </tr>
                        @if($settlement->order->deliveryByVendor())
                          <tr>
                              <!-- Product item  -->
                                  <td class="dashboard__order-history-table-item align-middle">
                                      <a href="#" class="dashboard__product-item" >
                                          <h5 class="font-body--md-400"> Delivery</h5>
                                      </a>
                                  </td>
                              <!-- Price  -->
                              <td class="dashboard__order-history-table-item order-date align-middle ">
                                  {!!$settlement->receiver->country->currency->symbol!!} {{number_format($settlement->order->deliveryfee, 2)}}
                              </td>
                              <td class="dashboard__order-history-table-item order-total align-middle">
                                  <p class="order-total-price">0</p>
                              </td>
                              <!-- Subtotal  -->     
                              <td class="dashboard__order-history-table-item order-status align-middle" style="text-align: left" >
                                  <p class="font-body--md-500">{!!$settlement->receiver->country->currency->symbol!!} {{number_format($settlement->order->deliveryfee, 2)}}</p>
                              </td>
                          </tr>
                        @endif
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Order Status -->
            
          </div>
      </div>
    </div>
  </div>
</div>
<!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')

@endpush
