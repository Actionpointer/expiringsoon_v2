@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title') Security | Expiring Soon @endsection
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
                <a href="{{route('home')}}">
                Admin
                <span> > </span>
                </a>
            </li>
            <li class="active"><a href="#">Security</a></li>
            </ul>
        </div>
        </div>
    </div>
  <!-- breedcrumb section end   -->

  
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
                    <h2 class="font-body--xl-500">Security</h2>
                    
                </div>
                <div class="products-tab__btn">
                  <div class="container">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-live-tab" data-bs-toggle="pill" data-bs-target="#pills-live" type="button" role="tab" aria-controls="pills-live" aria-selected="true">
                                IP Address
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-approval-tab" data-bs-toggle="pill" data-bs-target="#pills-approval" type="button" role="tab" aria-controls="pills-approval" aria-selected="false">
                                Users
                            </button>
                          </li>
                      </ul>
                  </div>
                </div>
                <div class="products-tab__content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-live" role="tabpanel" aria-labelledby="pills-live-tab">
                            <div class="container">
                              <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Add IP Address</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.security.ip_block')}}" method="post" >@csrf
                                        <div class="contact-form__content">
                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">IP Address</label>
                                                </div>
                                                <div class="col-md-10">
                                                    
                                                  <input type="text" name="ipaddress" class="form-control" value="" placeholder="Enter IP Address" />
                                                            
                                                </div>  
                                            </div>
  
                                            <div class="contact-form-btn">
                                                <button class="button button--md" type="submit"> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                            
                            <div class="dashboard__order-history-table">
                                <div class="table-responsive">
                                    <table id="datatable" class="table display" style="width:100%;font-size:13px">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="dashboard__order-history-table-title ">  
                                                <div class="d-flex align-content-end">
                                                <div class="form-check">
                                                    <label class="form-check-label" for="existing">  </label>
                                                    <input class="form-check-input checkboxes" type="checkbox" id="checkbox_master">
                                                </div>
                                                <span class="font-body--md-700">IP ADDRESS</span>
                                                </div>
                                            
                                            </th>
                                            <th scope="col" class="dashboard__order-history-table-title">  Location</th>
                                            <th scope="col" class="dashboard__order-history-table-title text-end">  Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($locations as $location)
                                                <tr>
                                                    <!-- Details page  -->
                                                    <td class="dashboard__order-history-table-item align-middle">
                                                    <div class="form-check d-inline-block">
                                                        <label class="form-check-label font-body--400" for="existing"> </label>
                                                        <input class="form-check-input checkboxes" type="checkbox" name="payouts[]" value="{{$location->id}}" >
                                                    </div>
                                                        {{$location->ipaddress}}
                                                    </td>
                                                    <td class="dashboard__order-history-table-item   order-status "> {{$location->place}}</td>
                                                    
                                                    <td class="dashboard__order-history-table-item order-details ">
                                                        
                                                        <form action="{{route('admin.security.ip_release')}}" method="post">@csrf
                                                          <input type="hidden" name="location_id" value="{{$location->id}}">
                                                          <input type="hidden" name="status" value="1">
                                                          <button type="submit" class="btn btn-success"> Release</button>
                                                        </form>
                                                    </td>
                                                </tr>   
                                            @empty
                                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                                <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                                <br />You have no blocked IP at this time.
                                            </div>
                                        @endforelse
                                        
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
                                          <th scope="col" class="dashboard__order-history-table-title"> User </th>
                                          <th scope="col" class="dashboard__order-history-table-title">Location</th>
                                          <th scope="col" class="dashboard__order-history-table-title"></th>
                                      </tr>
                                      </thead>
                                      <tbody>                     
                                          @foreach($users->where('status',false) as $user)        
                                              <tr>
                                                  <!-- Order Id  -->
                                                  <td class="dashboard__order-history-table-item "> 
                                                    <div class="d-flex flex-column flex-md-row">
                                                      <div class="d-flex align-items-center">
                                                          <div class="form-check pt-2 d-inline-block">
                                                            <label class="form-check-label font-body--400" for="existing"> </label>
                                                            <input class="form-check-input checkboxes" type="checkbox" name="products[]" value="{{$user->id}}" >
                                                          </div>
                                                          <a href="#" class="cart-table__product-item">
                                                            <div class="cart-table__product-item-img">
                                                              <img @if(!$user->pic) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}" />
                                                            </div>
                                                          </a>
                                                      </div>
                                                      
                                                      <div class="d-flex align-items-center">
                                                        <a href="{{route('admin.user.show',$user)}}" class="cart-table__product-item">
                                                          <h5 class="font-body--lg-400" style="font-size:14px"> {{$user->name}} </h5>
                                                        </a>
                                                      </div>
                                                  </div>
                                                  </td>
                                                  <!-- Vendor Split  -->
                                                  <td class="dashboard__order-history-table-item order-total "> 
                                                    <div class="d-flex align-items-center">
                                                      {{$user->country->name}}
                                                    </div>
                                                  </td>
                                                  
                                                  
                                                  <!-- Details page  -->
                                                  <td class="dashboard__order-history-table-item   order-details "> 
                                                        <form action="{{route('admin.user.manage')}}" method="post">@csrf
                                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                                            <input type="hidden" name="status" value="1">
                                                            <button class="button button--sm button--outline"> Release </button>
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