@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Shop
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
        @include('layouts.vendor_navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Vendor Transactions</h2>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title">
                          Reference
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title">
                          Date
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title">
                          Amount
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title">
                          Item
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title">
                          Status
                        </th>
                        <th scope="col" class="dashboard__order-history-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($payments as $payment)
                      <tr>
                        <!-- Order Id  -->
                        <td class="dashboard__order-history-table-item order-id">
                          #{{$payment->reference}}
                        </td>
                        <!-- Date  -->
                        <td class="dashboard__order-history-table-item order-date">
                          {{ $payment->created_at->format('d M, Y')}}
                          
                        </td>
                        <!-- Total  -->
                        <td class=" dashboard__order-history-table-item order-total ">
                          <p class="order-total-price">
                            {!!$payment->currency->symbol!!}{{$payment->amount}}
                          </p>
                        </td>
                        <td class=" dashboard__order-history-table-item order-ortal ">
                          <p class="order-total-price">
                            <span class="quantity"> {{$payment->items->first()->paymentable_type == 'App\Models\Subscription' ? 'Subscription': 'Adset'}}</span>
                          </p>
                        </td>
                        <!-- Status -->
                        <td class="dashboard__order-history-table-item order-status">
                          {{ ucwords($payment->status)}}
                        </td>
                        <!-- Details page  -->
                        <td class="dashboard__order-history-table-item order-details">
                          <a href="{{route('invoice',$payment)}}"> View Details
                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                              <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M11 2v60h44V18L39 2H11z" stroke-linejoin="round" stroke-linecap="round"></path>
                              <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M39 2v16h16" stroke-linejoin="round" stroke-linecap="round"></path>
                              <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M19 26v28h26" stroke-linejoin="round" stroke-linecap="round"></path>
                              <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M19 46l10-10 6 4.9L45 30" stroke-linejoin="round" stroke-linecap="round"></path>
                            </svg>
                            
                          </a>
                        </td>
                      </tr>
                      @empty
                        <tr>
                          <td class="text-center border-0" colspan="6">
                            <div style="padding:1%;margin-bottom:5%">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br />You have no payments at this time.
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


@endsection
@push('scripts')

@endpush