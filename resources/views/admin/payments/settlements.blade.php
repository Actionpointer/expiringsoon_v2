@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

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
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <div class="dashboard__content-card">
                <div class="dashboard__content-card-header d-flex justify-content-between">
                  <h5 class="font-body--xl-500">Settlements</h5>
                  @can('download','App\Models\Settlement')
                  <a href="{{route('admin.settlements.export')}}">Download</a>
                  @endcan
                </div>
                <div class="dashboard__content-card-body">
                  <div class="accordion mb-3" id="faq-accordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          Download
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                        <div class="accordion-body">
                          <form action="{{route('admin.settlements.export')}}" method="post">@csrf
                            <div class="row gx-0">
                              <div class="col-3">
                                  <label for="">Description</label>
                                  <select name="description" id="purpose" class="select2">
                                    <option></option>
                                    <option value="all">All</option>
                                    <option value="Refund">Refund</option>
                                    <option value="Commission">Commission</option>
                                    <option value="Shipment">Shipment</option>  
                                  </select>
                              </div>
                              <div class="col-3">
                                  <label for="">Status</label>
                                  <select name="status" id="status" class="select2">
                                    <option></option>
                                    <option value="all">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>   
                                  </select>
                              </div>
                              <div class="col-4">
                                <label for="">Daterange</label>
                                <div class="input-group d-flex">
                                  <div class="prepend">
                                      <input type="date" min="{{$min_date}}" name="from_date" class="form-control-sm border text-secondary" style="height:50px;" />
                                  </div>
                                  <div>
                                      <input type="date" max="{{$max_date}}" name="to_date" class="form-control-sm border text-secondary" style="height:50px;"  />
                                  </div>
                                </div>
                              </div>
                              <div class="col-2">
                                  <button class="button button--md mt-4">Submit</button>
                              </div>
                            </div> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                      <thead>
                          <tr>
                            <th scope="col" class="cart-table-title">Date</th>
                            <th scope="col" class="cart-table-title">Recipient</th>
                            <th scope="col" class="cart-table-title">Description</th>
                            <th scope="col" class="cart-table-title">Amount</th>
                            <th scope="col" class="cart-table-title">Status</th>
                            
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