@extends('layouts.app')
@push('styles')

@endpush
@section('title') Manage Coupons | Expiring Soon @endsection
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
            <li>
                <a href="{{route('home')}}">
                Admin
                <span> > </span>
                </a>
            </li>
            <li class="active"><a href="#">Coupons</a></li>
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
                                          Manage Coupons
                                      </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="pills-countries-tab" data-bs-toggle="pill" data-bs-target="#pills-countries" type="button" role="tab" aria-controls="pills-countries" aria-selected="false">
                                          Add New
                                      </button>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="products-tab__content">
                            <div class="tab-content" id="pills-tabContent">
                                <!-- General  -->
                                <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                    <div class="products-tab__description">
                                        <div class="dashboard__content-card">
                                            <div class="dashboard__content-card-header">
                                                <h5 class="font-body--xl-500">Manage Coupons</h5>
                                            </div>
                                            <form id="deleteform" action="{{route('admin.coupon.delete')}}" method="POST" onsubmit="return confirm('Are you sure you want to delete coupons?');">@csrf
                                                
                                            </form>
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
                                                        <form action="{{route('admin.coupons')}}" method="get">
                                                          <div class="row">
                                                            @if(auth()->user()->role->name == 'superadmin')                                  
                                                              <div class="col-md-3">
                                                                <label>Select Country</label>
                                                                  <select name="country_id" id="country_id" class="select2">
                                                                        <option value=""></option>
                                                                        <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$coupons->total()}}</option>
                                                                        <option value="global" @if($country_id == 'global') selected @endif>Global - {{$coupons->where('country_id',null)->count()}}</option>
                                                                        @foreach ($countries->sortBy('category') as $country)
                                                                            <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->coupons->count()}}</option>
                                                                        @endforeach
                                                                  </select>
                                                              </div>
                                                            @endif
                                                            
                                                            <div class="col-md-3">
                                                                <label>Select Role</label>
                                                                <select name="role" id="role" class="form-control like_select2">
                                                                  <option value="all" @if($role == 'all') selected @endif>All</option>
                                                                  <option value="vendor" @if($role == 'vendor') selected @endif>Vendor</option>
                                                                  <option value="shopper" @if($role == 'shopper') selected @endif>Shopper</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                              <label>Select Status</label>
                                                              <select name="status" id="status" class="form-control like_select2">
                                                                  <option value="all" @if($status == 'all') selected @endif>All </option>
                                                                  <option value="true" @if($status) selected @endif>Active </option>
                                                                  <option value="false" @if(!$status) selected @endif>Inactive </option>
                                                              </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                              <label>Search Title</label>
                                                              <input name="name" id="name" value="{{$name}}" class="form-control like_select2">
                                                            </div>
                                                            <div class="col-md-4">
                                                              <label for="">Date range</label>
                                                              <div class="input-group d-flex">
                                                                <div class="prepend">
                                                                    <input type="date" min="{{$min_date}}" name="from_date" class="form-control-sm border text-secondary" style="height:38px;" />
                                                                </div>
                                                                <div>
                                                                    <input type="date" max="{{$max_date}}" name="to_date" class="form-control-sm border text-secondary" style="height:38px;"  />
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-2">
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
                                                              @can('download','App\Models\Coupon')
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
                                            <div class="dashboard__content-card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table display" style="width:100%;font-size:13px">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th scope="col" class="cart-table-title align-middle">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="form-check d-inline">
                                                                            <label class="form-check-label font-body--400" for="existing"> </label>
                                                                            <input class="form-check-input checkboxes" type="checkbox" id="checkbox_master">
                                                                        </div>
                                                                        <span class="align-bottom">Title</span> 
                                                                    </div>
                                                                </th>
                                                                
                                                                <th scope="col" class="cart-table-title align-middle">Code</th>
                                                                <th scope="col" class="cart-table-title align-middle">Role</th>
                                                                <th scope="col" class="cart-table-title align-middle">Discount</th>
                                                                <th scope="col" class="cart-table-title align-middle">Period</th>
                                                                <th scope="col" class="cart-table-title align-middle">Qty</th>
                                                                <th scope="col" class="cart-table-title align-middle">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            @forelse ($coupons as $coupon)
                                                                <tr>
                                                                    
                                                                    
                                                                    <td class="cart-table-item stock-status order-date align-middle">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label font-body--400" for="existing"> </label>
                                                                                <input class="form-check-input checkboxes" type="checkbox" name="coupons[]" value="{{$coupon->id}}" >
                                                                            </div>
                                                                            <span class="text-nowrap">
                                                                                {{$coupon->name}} 
                                                                                @if($coupon->status) 
                                                                                    <i class="fa fa-circle text-success"></i> 
                                                                                @else <i class="fa fa-circle text-danger"></i> 
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                    </td>

                                                                    <td class="cart-table-item stock-status order-date align-middle"> {{$coupon->code}}</td>
                                                                    <td class="cart-table-item stock-status order-date align-middle"> {{ucwords($coupon->role)}}</td>
                                                                    <td class="cart-table-item stock-status order-date align-middle"> @if(!$coupon->country_id) Global @else {{$coupon->country->name}} @endif :
                                                                        @if($coupon->is_percentage) 
                                                                            {{$coupon->value}}%  off 
                                                                        @else 
                                                                            -{{$coupon->value}} Off 
                                                                        @endif
                                                                    </td>
                                                                    <td class="cart-table-item stock-status order-date align-middle"> 
                                                                        <small class="small">
                                                                            @if($coupon->start_at && $coupon->end_at)
                                                                            {{ $coupon->start_at->format('M-d')}} to {{$coupon->end_at->format('M-d')}} 
                                                                            @else 
                                                                                - 
                                                                            @endif

                                                                        </small>
                                                                        
                                                                    </td>
                                                                    <td class="cart-table-item stock-status order-date align-middle">
                                                                        {{$coupon->available}} of {{$coupon->quantity}}
                                                                    </td>
                                                                    <td class="cart-table-item stock-status order-date align-middle">
                                                                        <button class="btn btn-xs btn-info text-white" data-bs-toggle="modal" data-bs-target="#editcoupon{{$coupon->id}}"><i class="fa fa-pencil"></i></button> 

                                                                        <form action="{{route('admin.coupon.delete')}}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete coupon?');">@csrf
                                                                
                                                                            <input type="hidden" name="coupons[]" value="{{$coupon->id}}">
                                                                            <button type="submit" class="btn btn-xs btn-danger" title="delete">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                        
                                                                    </td>  
                                                                </tr>
                                                                <div class="modal fade" id="editcoupon{{$coupon->id}}" aria-labelledby="editcoupon{{$coupon->id}}Label" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="editcoupon{{$coupon->id}}Label">Edit Coupon</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('admin.coupon.update')}}" method="POST">@csrf
                                                                                
                                                                                <input type="hidden" name="edit" value="1">
                                                                                <input type="hidden" name="coupon_id" value="{{$coupon->id}}">
                                                                                <div class="contact-form__content">
                                                                                    <div class="contact-form__content-group">
                                                                                        <div class="contact-form-input">
                                                                                            <label for="title" class=""><span>*</span> Coupan Title</label>
                                                                                            <input class="form-control " id="title" name="title" value="{{$coupon->name}}" type="text" required="">
                                                                                        </div>
                                                                                        <div class="contact-form-input">
                                                                                            <label for="code" class=""><span>*</span>Coupan Code</label>
                                                                                            <input class="form-control " id="code" name="code" value="{{$coupon->code}}" type="text" required="" >
                                                                                            <div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="contact-form__content-group">
                                                                                        <div class="contact-form-input">
                                                                                            <label class="">Start Date</label>
                                                                                            <input class=" form-control digits" value="{{$coupon->start_at ? $coupon->start_at->format('Y-m-d') : '' }}" name="start_date" type="date">
                                                                                        </div>
                                                                                        <div class="contact-form-input">
                                                                                            <label class="">End Date</label>
                                                                                            <input class="form-control digits " value="{{$coupon->end_at ? $coupon->end_at->format('Y-m-d') : '' }}" name="end_date" type="date">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="contact-form__content-group">        
                                                                                        <div class="contact-form-input">
                                                                                            <label class="">Quantity</label>
                                                                                            <input class="form-control " type="number" name="quantity" value="{{$coupon->quantity}}" required="">
                                                                                        </div>
                                                                                        <div class="contact-form-input">
                                                                                            <label class="">Discount Type</label>
                                                                                            <select class="form-control-lg text-muted border w-100 " required="" name="type">
                                                                                                <option value="percent" @if($coupon->is_percentage) selected @endif>Percent</option>
                                                                                                <option value="fixed" @if(!$coupon->is_percentage) selected @endif>Fixed</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="contact-form-input">
                                                                                            <label for="discountvalue" class=""><span>*</span>Discount Value</label>
                                                                                            <input class="form-control " id="discountvalue" name="value" value="{{$coupon->value}}" type="number" required="" >
                                                                                            <div class="valid-feedback">Enter correct values.</div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <h5 class="my-4">Usage Limits</h4>
                                                                                    <div class="contact-form__content-group">
                                                                                        
                                                                                        <div class="contact-form-input">
                                                                                            <label for="minimum_spend" class="">Minimum Spend</label>
                                                                                            <input class="form-control " id="minimum_spend" value="{{$coupon->minimum_spend}}" type="number" name="minimum_spend">
                                                                                        </div>
                                                                                        <div class="contact-form-input">
                                                                                            <label for="maximum_spend" class="">Maximum Spend</label>
                                                                                            <input class="form-control " id="maximum_spend" value="{{$coupon->maximum_spend}}" type="number" name="maximum_spend">
                                                                                        </div>
                                                                                        <div class="contact-form-input">
                                                                                            <label for="per_customer" class="">Limit Per User</label>
                                                                                            <input class="form-control " id="per_customer" value="{{$coupon->limit_per_user}}" type="number" name="per_customer" placeholder="no of times a user can use it">
                                                                                        </div>
                                                                                        
                                                                                    </div>    
                                                                                    <div class="row">
                                                                                        @if(auth()->user()->role->name == 'superadmin')
                                                                                            <div class="contact-form-input  col-md-4">
                                                                                                <label for="origin">Country </label>
                                                                                                <select id="countriez" name="country_id" class="select2 country">
                                                                                                    <option value="0">All Countries</option>
                                                                                                    @foreach ($countries as $country)
                                                                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        @else
                                                                                            <input type="hidden" name="country_id" value="{{auth()->user()->country_id}}">
                                                                                        @endif
                                                                                        <div class="contact-form-input col-md-4">
                                                                                            <label class="">For Role</label>
                                                                                            <select class="form-control-lg text-muted border w-100 " required="" name="role">
                                                                                                <option value="vendor" @if($coupon->role == 'vendor') selected @endif>Vendors</option>
                                                                                                <option value="shopper" @if($coupon->role == 'shopper' ) selected @endif>Shoppers</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="contact-form-input col-md-4">
                                                                                            <label class="">Status</label>
                                                                                            <select class="form-control-lg text-muted border w-100 " required="" name="status">
                                                                                                <option value="1" @if($coupon->status) selected @endif>Active</option>
                                                                                                <option value="0" @if(!$coupon->status) selected @endif>Inactive</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="contact-form-input d-block">
                                                                                            <button class="button button--md" type="submit">
                                                                                            Update Coupon
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                
                                                                            </form>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-md-center">
                                                                        <div style="margin:auto;padding:1%;">
                                                                            <img style="padding:10px;width:100px" src="{{asset('images/site/exclamation.png')}}">
                                                                            <br />There are no coupons at this time.</span>
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
                                
                                <div class="tab-pane fade" id="pills-countries" role="tabpanel" aria-labelledby="pills-countries-tab">
                                    <div class="row products-tab__feedback"> 
                                        <!-- Manage Countries  -->
                                        <div class="dashboard__content-card">
                                            <div class="dashboard__content-card-header">
                                                <h5 class="font-body--xl-500">Add Coupon</h5>
                                            </div>
                                            <div class="dashboard__content-card-body">
                                                <form action="{{route('admin.coupon.store')}}" method="POST">@csrf
                                                    <input type="hidden" name="create" value="1">
                                                    <div class="contact-form__content">
                                                        <div class="contact-form__content-group">
                                                            <div class="contact-form-input">
                                                                <label for="title" class=""><span>*</span> Coupan Title</label>
                                                                <input class="form-control " id="title" name="title" type="text" required="">
                                                            </div>
                                                            <div class="contact-form-input">
                                                                <label for="code" class=""><span>*</span>Coupan Code</label>
                                                                <input class="form-control " id="code" name="code" type="text" required="" >
                                                                <div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
                                                            </div>
                                                        </div>
                                                        <div class="contact-form__content-group">
                                                            <div class="contact-form-input">
                                                                <label class="">Start Date</label>
                                                                <input class=" form-control digits " name="start_date" type="date">
                                                            </div>
                                                            <div class="contact-form-input">
                                                                <label class="">End Date</label>
                                                                <input class="form-control digits " name="end_date" type="date">
                                                            </div>
                                                        </div>
                                                        <div class="contact-form__content-group">        
                                                            <div class="contact-form-input">
                                                                <label class="">Quantity</label>
                                                                <input class="form-control " type="number" name="quantity" required="">
                                                            </div>
                                                            <div class="contact-form-input">
                                                                <label class="">Discount Type</label>
                                                                <select class="form-control-lg text-muted border w-100 " required="" name="status">
                                                                    <option value="percent">Percent</option>
                                                                    <option value="fixed">Fixed</option>
                                                                </select>
                                                            </div>
                                                            <div class="contact-form-input">
                                                                <label for="discountvalue" class=""><span>*</span>Discount Value</label>
                                                                <input class="form-control " id="discountvalue" name="value" type="number" required="" >
                                                                <div class="valid-feedback">Enter correct values.</div>
                                                            </div>
                                                        </div>
                                                        <h5 class="my-4">Usage Limits</h4>
                                                        <div class="contact-form__content-group">
                                                            
                                                            <div class="contact-form-input">
                                                                <label for="minimum_spend" class="">Minimum Spend</label>
                                                                <input class="form-control " id="minimum_spend" type="number" name="minimum_spend">
                                                            </div>
                                                            <div class="contact-form-input">
                                                                <label for="maximum_spend" class="">Maximum Spend</label>
                                                                <input class="form-control " id="maximum_spend" type="number" name="maximum_spend">
                                                            </div>
                                                            <div class="contact-form-input">
                                                                <label for="per_customer" class="">Limit Per User</label>
                                                                <input class="form-control " id="per_customer" type="number" name="per_customer" placeholder="no of times a user can use it">
                                                            </div>
                                                            
                                                        </div>    
                                                        <div class="row">
                                                            @if(auth()->user()->role->name == 'superadmin')
                                                                <div class="contact-form-input  col-md-4">
                                                                    <label for="origin">Country </label>
                                                                    <select id="countriez" name="country_id" class="select2 country">
                                                                        <option value="0">All Countries</option>
                                                                        @foreach ($countries as $country)
                                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <input type="hidden" name="country_id" value="{{auth()->user()->country_id}}">
                                                            @endif
                                                            <div class="contact-form-input col-md-4">
                                                                <label class="">For Role</label>
                                                                <select class="form-control-lg text-muted border w-100 " required="" name="role">
                                                                    <option value="vendor" selected>Vendors</option>
                                                                    <option value="shopper" >Shoppers</option>
                                                                </select>
                                                            </div>
                                                            <div class="contact-form-input col-md-4">
                                                                <label class="">Status</label>
                                                                <select class="form-control-lg text-muted border w-100 " required="" name="type">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="contact-form-input d-block">
                                                                <button class="button button--md" type="submit">
                                                                + Add Coupon
                                                                </button>
                                                            </div>
                                                        </div>
                                                            
                                                        
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div> 
                                    </div>
                                    
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

<script>
    function deleteform(){
        if($('.checkboxes:checked').length){
          $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
              var input = $("<input>").attr("type", "hidden").attr("name", 'coupons[]').val(elem.value);
              $('#deleteform').append($(input));
          });
          $('#deleteform').submit();
        }
      }
</script>
@endpush

