@extends('layouts.app')
@push('styles')

@endpush
@section('title')Order Disputes | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="index.php">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="{{route('admin.orders')}}">Order Disputes</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  

  <!-- dashboard Secton Start  -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Order History  -->
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Order Disputes</h2>
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
                          <form action="{{route('admin.order.disputes')}}" method="get">
                            <div class="row">
                              @if(auth()->user()->role->name == 'superadmin')                                  
                                <div class="col-md-3">
                                  <label>Select Country</label>
                                    <select name="country_id" id="country_id" class="select2">
                                        <option></option>
                                        <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$disputes->total()}}</option>
                                        @foreach ($countries->sortBy('category') as $country)
                                          <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->disputes->count()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                              @endif
                              <div class="col-md-3">
                                <select name="status" id="order_status" class="select2">
                                    <option></option>
                                    <option value="all" @if($status == 'all') selected @endif>All Statuses</option>
                                    <option value="ongoing" @if($status == 'ongoing') selected @endif>Ongoing</option>
                                    <option value="closed" @if($status == 'closed') selected @endif>Closed</option>
                                </select>
                              </div>
                              <div class="col-md-3">
                                <select name="sortBy" id="sort-byd" class="form-control like_select2">
                                  <option value="date_asc" @if($sortBy == 'date_asc') selected @endif>Sort by: Dispute Date Asc</option>
                                  <option value="date_desc" @if($sortBy == 'date_desc') selected @endif>Sort by: Dispute Date Desc</option>    
                                </select>
                              </div>
                              
                              <div class="row mt-3 justify-content-center">
                                <div class="col-md-2">
                                  <button class="button button--md" name="download" value="0">Filter</button>
                                </div>
                                
                              </div>
                              
                            </div> 
                                
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title">  Dispute Date</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Order Date</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Complaint</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Status</th>
                        <th scope="col" class="dashboard__order-history-table-title text-end"> Arbitrator </th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($disputes as $dispute)
                      <tr>
                        <!-- Order Id  -->
                        <td class="dashboard__order-history-table-item order-id"> 
                          {{-- <a href="{{route('admin.order.show',$order)}}" class="text-success"> #{{$order->slug}}</a> --}}
                          {{$dispute->created_at->format('d-m-Y h:i A')}}
                        </td>
                        <!-- Date  -->
                        <td class="dashboard__order-history-table-item order-date "> 
                            {{$dispute->order->created_at->format('d-m-Y h:i A')}}
                        </td>
                        <!-- Total  -->
                        <td class="dashboard__order-history-table-item order-total "> 
                          <a href="{{route('admin.order.show',$dispute->order)}}"> {{$dispute->description}}</a>
                        </td>
                        <!-- Status -->
                        <td class="dashboard__order-history-table-item order-status "> 
                          @if($dispute->deleted_at)
                            Closed
                          @else Ongoing
                          @endif
                        </td>
                        <td class="dashboard__order-history-table-item order-status "> 
                          {{$dispute->order->arbitrator->name}}
                          
                        </td>
                        
                      </tr>  
                        @empty
                        <tr>
                          <td colspan="5">
                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br />You have no dispute at this time.
                          </div>
                          </td>
                        </tr>
                        
                      @endforelse
                      
                    </tbody>
                  </table>
                </div>
                @include('layouts.pagination',['data'=> $disputes])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')
<script>
    $('#country_id').select2({
      placeholder:'Filter Country'
    })
    $('#shipmentType').select2({
      placeholder:'Filter Shipment'
    })
    $('#order_status').select2({
      placeholder:'Filter Status'
    })
    $('#sort-byd').select2({
      placeholder:'Sort By',
      minimumResultsForSearch: 5,
    })
    
    
</script>
@endpush
