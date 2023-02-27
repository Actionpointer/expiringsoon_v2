@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title') Subscriptions | Expiring Soon @endsection
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
          <li class="active"><a href="#">Paymens</a></li>
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
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                Enterprise Subscription
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                                Advert Subscription
                          </button>
                      </li>       
                  </ul>
              </div>
            </div>
            <div class="products-tab__content">
              <div class="">
                  <div class="tab-content" id="pills-tabContent">
                      <!-- General  -->
                      <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                          <div class="products-tab__description">
                                
                                <div class="dashboard__content-card">
                                    <div class="dashboard__content-card-header d-flex justify-content-between">
                                        <h5 class="font-body--xl-500">Manage Susbcription</h5>
                                        <a href="#" class="font-body--lg-500">{{number_format($subscriptions->count(), 0)}} Subscriptions</a>
                                    </div>
                                    <div class="dashboard__content-card-body px-0">
                                      <table class="datatable table display" style="width:100%;font-size:13px">
                                        <thead>
                                          <tr>
                                            <th scope="col" class="cart-table-title">User Details</th>
                                            <th scope="col" class="cart-table-title">Plan</th>
                                            <th scope="col" class="cart-table-title">Begins</th>
                                            <th scope="col" class="cart-table-title">Ends</th>
                                            <th scope="col" class="cart-table-title">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($subscriptions as $subscription)
                                            <tr class="likeditem">
                                              <!-- Product item  -->
                                              <td class="cart-table-item align-middle">
                                                  {{$subscription->user->name}}
                                              </td>
                                              <td class="cart-table-item order-date align-middle">      
                                                      {{$subscription->plan->name}}
                                              </td>
                                              
                                              <td class="cart-table-item order-date align-middle">
                                                {{$subscription->start_at->format('d-M-Y h:iA')}}
                                              </td>
                                              <td class="cart-table-item order-date align-middle">
                                                {{$subscription->end_at ? $subscription->end_at->format('d-M-Y h:iA') : '-'}}
                                              </td>
                                              <!-- Stock Status  -->
                                              <td class="cart-table-item order-date align-middle">
                                                  @if($subscription->end_at)
                                                    @if($subscription->expired())
                                                        <button class="badge btn-danger">Expired </button>
                                                    @elseif($subscription->renew_at && $subscription->renew_at < now())
                                                        <button class="badge btn-warning">Expiring </button>
                                                    @elseif(!$subscription->status)
                                                        <button class="badge btn-danger">Not Active </button>
                                                    @else 
                                                        <button class="badge btn-success">Active </button>
                                                    @endif
                                                  @else
                                                    <button class="badge btn-success">Active </button>
                                                  @endif
                                                  
                                                
                                              </td>
                                              
                                            </tr>
                                          
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                </div>                
                          </div>
                      </div>
        
                      <!-- Plan  -->
                      <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                          <div class="products-tab__description">         
                                <div class="dashboard__content-card">
                                    <div class="dashboard__content-card-header d-flex justify-content-between">
                                        <h5 class="font-body--xl-500">Manage Advert Susbcription</h5>
                                        <a href="#" class="font-body--lg-500">{{number_format($features->count(), 0)}} Advert Subscriptions</a>
                                    </div>
                                    <div class="dashboard__content-card-body px-0">
                                      <table class="datatable table display" style="width:100%;font-size:13px">
                                        <thead>
                                          <tr>
                                            <th scope="col" class="cart-table-title">User Details</th>
                                            <th scope="col" class="cart-table-title">Plan</th>
                                            <th scope="col" class="cart-table-title">Units</th>
                                            <th scope="col" class="cart-table-title">Begins</th>
                                            <th scope="col" class="cart-table-title">Ends</th>
                                            <th scope="col" class="cart-table-title">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($features as $feature)
                                            <tr class="likeditem">
                                              <!-- Product item  -->
                                              <td class="cart-table-item align-middle"> {{$feature->user->name}} </td>
                                              <td class="cart-table-item order-date align-middle"> {{$feature->adplan->name}} </td>
                                              <td class="cart-table-item order-date align-middle"> {{$feature->units}} </td>
                                              
                                              <td class="cart-table-item order-date align-middle">
                                                {{$feature->start_at->format('d-m-Y h:iA')}}
                                              </td>
                                              <td class="cart-table-item order-date align-middle">
                                                {{$feature->end_at->format('d-m-Y h:iA')}}
                                              </td>
                                              
                                              <!-- Stock Status  -->
                                              <td class="cart-table-item order-date align-middle">
                                                
                                                  @if($feature->deleted_at || $feature->end_at < now())
                                                      <button class="badge btn-danger">Expired </button>
                                                  @elseif($feature->end_at->diffInMonths(now()) < 2)
                                                      <button class="badge btn-warning">Expiring </button>
                                                  @else
                                                      <button class="badge btn-success">Active </button>
                                                  @endif
                                                
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
            </div>
            <!-- Set VAT -->
        </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/jszip.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/pdfmake.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/vfs_fonts.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/buttons.print.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
            buttons: [
                { extend: 'print', className: 'btn btn-danger' }, { extend: 'pdf', className: 'btn btn-primary' }, { extend: 'csv', className: 'btn btn-warning' }, { extend: 'excel', className: 'btn btn-success' }, { extend: 'copy', className: 'btn btn-info' }
            ],
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Users",
            }
        });
    });
</script>
<script>
    $('#addbankaccount').click(function(e){
        e.preventDefault();
        $('#pills-plans-tab').tab('show');
    })
</script>
@endpush