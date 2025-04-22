@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/css/custom.css')}}"/>
@endpush
@section('title') Settlements | Expiring Soon @endsection
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
          <li class="active"><a href="#">Settlements</a></li>
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
              <div class="dashboard__order-history-title border-bottom">
                <h2 class="font-body--xl-500">Settlements</h2>
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
                          <form action="{{route('admin.settlements')}}" method="get">
                            <div class="row">
                              <div class="col-3">
                                  <label for="">Description</label>
                                  <select name="description" id="purpose" class="select2">
                                    <option></option>
                                    <option value="all" @if($description == 'all') selected @endif>All</option>
                                    <option value="refund" @if($description == 'refund') selected @endif>Refund</option>
                                    <option value="commission" @if($description == 'commission') selected @endif>Commission</option>
                                    <option value="shipment" @if($description == 'shipment') selected @endif>Shipment</option>  
                                  </select>
                              </div>
                              <div class="col-3">
                                  <label for="">Status</label>
                                  <select name="status" id="status" class="select2">
                                    <option></option>
                                    <option value="all" @if($status == 'all') selected @endif>All</option>
                                    <option value="pending" @if($status == 'pending') selected @endif>Pending</option>
                                    <option value="paid" @if($status == 'paid') selected @endif>Paid</option>   
                                  </select>
                              </div>
                              <div class="col-4">
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
                            </div> 
                            <div class="row mt-3 justify-content-center">
                              <div class="col-md-2">
                                <button class="button button--md" name="download" value="0">Filter</button>
                              </div>
                              @can('download','App\Models\Settlement')
                              <div class="col-md-2">
                                <button class="button button--md" name="download" value="1">Download</button>
                              </div>
                              @endcan
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
                            <th scope="col" class="dashboard__order-history-table-title">Recipient</th>
                            <th scope="col" class="dashboard__order-history-table-title">Description</th>
                            <th scope="col" class="dashboard__order-history-table-title">Amount</th>
                            <th scope="col" class="dashboard__order-history-table-title">Status</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($settlements->sortByDesc('updated_at') as $settlement)
                              <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                  <!-- item  -->
                                  <td class="cart-table-item order-date align-middle">
                                      <span style="font-size:12px;color:#888">{{ $settlement->created_at->format('l, F d, Y h:i A')}}</span>
                                  </td>
                                  <!-- Price  -->
                                  <td class="cart-table-item order-date align-middle">
                                      {{$settlement->receiver->name}}
                                  </td>
                                  <td class="cart-table-item order-date align-middle">{{$settlement->description}}
                                      
                                  </td>
                                  <td class="cart-table-item order-date align-middle">
                                      <p class="font-body--lg-500" style="color:#00b207">{!!$settlement->receiver->country->currency->symbol!!}{{ number_format($settlement->amount, 2)}}</p>
                                  </td>
                                  <!-- Stock Status  -->
                                  <td class="cart-table-item order-date align-middle">
                                      @if(!$settlement->status)
                                          <p style="color:#d98013;font-size:14px"><span id="status">Pending</span></p>
                                      @else
                                          <p style="color:#00b207;font-size:14px;font-weight:500">Paid</p>
                                      @endif
                                  </td>
                                  
                              </tr>   
                          @empty
                              <div style="margin:auto;padding:1%;text-align:center">
                                  <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                  <br />No Settlement at this time.</span>
                              </div>
                          @endforelse
                          
                      </tbody>
                  </table>
                </div>
                @include('layouts.pagination',['data'=> $settlements])
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