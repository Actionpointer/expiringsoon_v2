@extends('layouts.app')
@push('styles')

@endpush
@section('title') Payment Invoice #{{$payment->id}} | Expiring Soon @endsection
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
              Payment
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Payment #{{$payment->reference}}</a></li>
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
                <h2 class="font-body--xl-500">Payment Details</h2>
                {{-- <h2 class="font-body--md-400">Vendor:<br /> --}}
                {{-- <a href="{{route('admin.orders')}}">back to list</a> --}}
              </div>

              <div class="dashboard__details-content">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="dashboard__details-card">
                      <div class="dashboard__details-card-item">
                        <h5 class="dashboard__details-card-title"> Payer </h5>
                        <!-- billing Address -->
                        <div class="dashboard__details-card-item__inner">
                          <h2 class="font-body--lg-400 name">
                              {{$payment->user->name}}
                          </h2>
                          <p class="font-body--md-400">
                              {{$payment->user->state->name}}
                          </p>
                        </div>
                        <div class="dashboard__details-card-item__inner">
                          <div
                            class="dashboard__details-card-item__inner-contact">
                            <h5 class="title">Email</h5>
                            <p class="font-body--md-400">
                                {{$payment->user->email}}
                            </p>
                          </div>
                          <div class=" dashboard__details-card-item__inner-contact">
                            <h5 class="title">Phone</h5>
                            <p class="font-body--md-400"> {{$payment->user->mobile}}</p>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="dashboard__details-card-item">
                        <h5 class="dashboard__details-card-title"> Beneficiary </h5>
                        <!-- Shipping Address -->
                        <div class="dashboard__details-card-item__inner">
                          <h2 class="font-body--lg-400 name">
                              {{$order->shop->name}}
                          </h2>
                          <p class="font-body--md-400">
                              {{$order->shop->address}}, {{$order->shop->city ? $order->shop->city->name : ''}} , {{$order->shop->state->name}}
                          </p>
                        </div>
                        <div class="dashboard__details-card-item__inner">
                          <div class=" dashboard__details-card-item__inner-contact   " >
                            <h5 class="title">Email</h5>
                            <p class="font-body--md-400">
                                {{$order->shop->email}}
                            </p>
                          </div>
                          <div class=" dashboard__details-card-item__inner-contact " >
                            <h5 class="title">Phone</h5>
                            <p class="font-body--md-400"> {{$order->shop->mobile}}</p>
                          </div>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="dashboard__totalpayment-card">
                      <div class="dashboard__totalpayment-card-header">
                        <div class="dashboard__totalpayment-card-header">
                          <div class="dashboard__totalpayment-card-header-item">
                            <h5 class="title">Payment Details:</h5>
                            
                          </div>
                        </div>
                      </div>

                      <div class="dashboard__totalpayment-card-body">
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Payment Status:</h5>
                          <p class="font-body--md-500">
                              @if($payment->status == 'success') 
                                Success 
                              @endif
                          </p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Date:</h5>
                          <p class="font-body--md-500">{{$payment->created_at->format('jS F Y')}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Medium</h5>
                          <p class="font-body--md-500">{{$payment->method}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Reference:</h5>
                          <p class="font-body--md-500">{{$payment->reference}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">VAT {{$payment->vat}}%:</h5>
                          <p class="font-body--md-500">{!!$payment->user->country->currency->symbol!!}{{number_format(($payment->amount * $payment->vat) / ($payment->vat+100))}}</p>
                        </div>
                        
                        <div class="dashboard__totalpayment-card-body-item total" >
                          <h5 class="font-body--xl-400">Amount:</h5>
                          <p class="font-body--xl-500">{!!$payment->user->country->currency->symbol!!} {{number_format($payment->amount, 2)}}</p>
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
                      @if($payment->items->first()->paymentable_type == 'App\Models\Order')
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Order </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Subtotal </th>
                      </tr>
                      @else
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Plan </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Amount </th>
                        <th scope="col" class="dashboard__order-history-table-title" > Duration </th>
                      </tr>
                      @endif
                    </thead>
                    <tbody>
                      
                      @foreach($payment->items as $item)
                        @if ($item->paymentable_type == 'App\Models\Order')
                          <tr>
                            <!-- Product item  -->
                            <td class="dashboard__order-history-table-item align-middle">
                              <a href="{{route('order.show',$item->paymentable)}}">#{{$item->paymentable->id}} <span class="small">click to view </span></a>
                            </td>
                            <!-- Order  -->
                            <td class="dashboard__order-history-table-item order-date align-middle "     >
                              <a href="{{route('vendor.show',$item->paymentable->shop)}}">{{$item->paymentable->shop->name}}</a>
                            </td>
                            
                            <!-- Subtotal  -->     
                            <td class="dashboard__order-history-table-item order-status align-middle " style="text-align: left" >
                                <p class="font-body--md-500">{!!$payment->user->country->currency->symbol!!} {{number_format($item->paymentable->total, 0)}}</p>
                            </td>
                          </tr>
                        @else
                          <tr>
                            <!-- Product item  -->
                            <td class="dashboard__order-history-table-item align-middle">
                              <h5 class="font-body--md-400"> {{$item->paymentable_type == 'App\Models\Subscription' ? 'Subscription: '.$item->paymentable->plan->name : 'Adset: '.$item->paymentable->adplan->name}}</h5>
                            </td>
                            <!-- Price  -->
                            <td class="dashboard__order-history-table-item order-date align-middle">
                                {!!$payment->user->country->currency->symbol!!} {{number_format($item->paymentable->amount, 0)}}
                            </td>
                            <!-- quantity -->
                            <td class="dashboard__order-history-table-item order-total align-middle" style="text-align: left" >
                                <p class="order-total-price">  {{$item->paymentable->start_at->diffInMonths($item->paymentable->end_at)}} Months</p>
                            </td>
                            
                          </tr>
                        @endif
                        
                      @endforeach
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
