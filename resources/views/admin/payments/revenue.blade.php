@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/css/custom.css')}}"/>

@endpush
@section('title') Revenue | Expiring Soon @endsection
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
          <li class="active"><a href="#">Revenue</a></li>
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
        <div class="col-lg-9 pt-0" style="font-size:13px">
          <div class="container">
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title border-bottom">
                <h2 class="font-body--xl-500">Revenue</h2>
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
                          <form action="{{route('admin.revenue')}}" method="get">
                            <div class="row">
                              @if(auth()->user()->role->name == 'superadmin')                                  
                                <div class="col-md-3">
                                  <label>Select Country</label>
                                    <select name="country_id" id="country_id" class="select2">
                                        <option></option>
                                        <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$revenues->total()}}</option>
                                        @foreach ($countries->sortBy('category') as $country)
                                          <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->revenues->count()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                              @endif
                              
                              <div class="col-md-3">
                                  <label>Select Type</label>
                                  <select name="type" id="type" class="select2">
                                    <option></option>
                                    <option value="all" @if($type == 'all') selected @endif>All</option>
                                    <option value="adset" @if($type == 'adset') selected @endif>Adset</option>
                                    <option value="subscription" @if($type == 'subscription') selected @endif>Subscription</option>
                                    <option value="commission" @if($type == 'commission') selected @endif>Commission</option>  
                                    <option value="shipment" @if($type == 'shipment') selected @endif>Shipment</option>  
                                  </select>
                              </div>
                              
                              
                              <div class="col-md-5">
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
                              <div class="col-md-3">
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
                                @can('download','App\Models\Payout')
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
                  <table class="table display">
                      <thead>
                          <tr>
                            <th scope="col" class="dashboard__order-history-table-title"><span>Country</span> </th>
                            <th scope="col" class="dashboard__order-history-table-title">Description</th>
                            <th scope="col" class="dashboard__order-history-table-title">Date</th>
                            <th scope="col" class="dashboard__order-history-table-title">Amount</th>
                            
                            
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($revenues as $revenue)
                              <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                  <td class="dashboard__order-history-table-item align-middle"> {{$revenue->country->name}} </td>
                                 <td class="cart-table-item order-date align-middle">{{ucwords($revenue->description)}} </td> 
                                  <td class="cart-table-item order-date align-middle"> {{ $revenue->created_at->format('d-m-Y')}} </td>
                                 
                                  <td class="cart-table-item order-date align-middle">
                                    <p class="font-body--md-400" style="color:#00b207">{!!$revenue->currency->symbol!!}{{ number_format($revenue->amount, 2)}}</p>
                                  </td>
                                   
                              </tr>   
                          @empty
                          <tr>
                            <td colspan="4">
                              <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                <br />No Revenue yet </span>
                            </div>
                            </td>
                          </tr>
                              
                          @endforelse
                          
                      </tbody>
                  </table>
                </div>
                  
                  @include('layouts.pagination',['data'=> $revenues])
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

<script>


</script>
@endpush