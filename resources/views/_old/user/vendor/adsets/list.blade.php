@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush
@section('title') Adsets | Expiring Soon @endsection
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
          
          <li class="active"><a href="#">Adsets</a></li>
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
          
            {{-- <div class="container"> --}}
              <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Adsets</h2>
                    <a href="{{route('vendor.adset.create')}}" class="font-body--lg-500">
                      Add New AdSets</a>
                </div>
                <div class="products-tab__btn">
                  <div class="container">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-live-tab" data-bs-toggle="pill" data-bs-target="#pills-live" type="button" role="tab" aria-controls="pills-live" aria-selected="true">
                                Active
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-approval-tab" data-bs-toggle="pill" data-bs-target="#pills-approval" type="button" role="tab" aria-controls="pills-approval" aria-selected="false">
                                Expired
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
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="dashboard__order-history-table-title"> Details</th>
                                        
                                        <th scope="col" class="dashboard__order-history-table-title">Usage</th>
                                        <th scope="col" class="dashboard__order-history-table-title">Expiry</th>
                                        <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                    </thead>
                                    <tbody>                     
                                        @foreach($adsets->where('end_at','>',now()) as $adset)        
                                            <tr>
                                                <!-- Order Id  -->
                                                <td class="dashboard__order-history-table-item order-id"> 
                                                    <span style="font-weight:500;white-space:nowrap">{{$adset->adplan->name}} -{{$adset->slug}}</span><br/>
                                                </td>
                                                <!-- Vendor Split  -->
                                                
                                                <td class="dashboard__order-history-table-item order-total"> 
                                                    <p class="order-total-price text-nowrap">   
                                                        {{$adset->units}} units. {{$adset->adplan->width ? $adset->adverts->count() : $adset->features->count()}} used
                                                    </p>
                                                </td>
                                                <!-- Status -->
                                                <td class="dashboard__order-history-table-item   order-status "> 
                                                    {{$adset->end_at->format('M d, Y')}}
                                                </td>
                                                
                                                <!-- Details page  -->
                                                <td class="dashboard__order-history-table-item   order-details "> 
                                                    <a @if($adset->adplan->width) href="{{route('vendor.adverts',$adset)}}" @else href="{{route('vendor.featureds',$adset)}}" @endif class="button button--sm button--outline"> Manage Ads </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        <!-- Countries -->
                        <div class="tab-pane fade" id="pills-approval" role="tabpanel" aria-labelledby="pills-approval-tab">
                            <div class="dashboard__order-history-table">
                                <div class="table-responsive">
                                  <table class="table datatable">
                                      <thead>
                                      <tr>
                                          <th scope="col" class="dashboard__order-history-table-title"> Details </th>
                                          
                                          <th scope="col" class="dashboard__order-history-table-title">Usage</th>
                                          <th scope="col" class="dashboard__order-history-table-title">Expiry</th>
                                          <th scope="col" class="dashboard__order-history-table-title"></th>
                                      </tr>
                                      </thead>
                                      <tbody>                     
                                          @foreach($adsets->where('end_at','<',now()) as $adset)        
                                              <tr>
                                                  <!-- Order Id  -->
                                                  <td class="dashboard__order-history-table-item "> 
                                                      <span style="font-weight:500" class="text-nowrap">{{$adset->adplan->name}} -{{$adset->slug}}</span><br/>
                                                  </td>
                                                  <!-- Vendor Split  -->
                                                  
                                                  <td class="dashboard__order-history-table-item order-total"> 
                                                      <p class="order-total-price text-nowrap">   
                                                          {{$adset->units}} {{$adset->adplan->type}}. {{$adset->adverts->count()}} used
                                                      </p>
                                                  </td>
                                                  <!-- Status -->
                                                  <td class="dashboard__order-history-table-item   order-status "> 
                                                        <p class="order-total-price text-nowrap">     
                                                            {{$adset->end_at->format('M d, Y')}}
                                                        </p>
                                                  </td>
                                                  
                                                  <!-- Details page  -->
                                                  <td class="dashboard__order-history-table-item   order-details "> 
                                                        <form action="{{route('vendor.adset.subscribe')}}" method="post">@csrf
                                                            <input type="hidden" name="adset_id" value="{{$adset->id}}">
                                                            <button class="button button--sm button--outline"> Renew </button>
                                                        </form>
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
              </div>
            {{-- </div> --}}
        </div>
      </div>
    </div>
  </div>

@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            }
        });
    });
</script>

@endpush