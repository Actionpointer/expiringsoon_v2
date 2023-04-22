@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> 

<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush
@section('title') Admin Settings | Expiring Soon @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('home')}}">
              Settings
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Roles</a></li>
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
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                            Admin
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-countries-tab" data-bs-toggle="pill" data-bs-target="#pills-countries" type="button" role="tab" aria-controls="pills-countries" aria-selected="false">
                            Manager
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">
                            Auditor
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                           Customer Care
                          </button>
                      </li>
                     
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false">
                            Logistics Agent
                          </button>
                      </li>
                      
                      
                      
                  </ul>
              </div>
            </div>
            <div class="products-tab__content">
              <div class="container">
                  <div class="tab-content" id="pills-tabContent">
                      <!-- General  -->
                      <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                          <div class="products-tab__description">
                            {{-- <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Global</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.settings')}}" method="post" id="global">@csrf
                                        <div class="contact-form__content">
                                            <div class="contact-form-input">
                                                <label for="country">Country</label>
                                                <select name="country_id" id="countries" class="select2">
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->id}}" @if(session('locale')['country_id'] == $country->id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="vat">VAT %</label>
                                                <input type="text" name="vat" placeholder="Set VAT Percentage" value="{{$settings->firstWhere('name','vat')->value}}" />
                                            </div>

                                            

                                            
                                            <div class="contact-form-input">
                                                <label for="gateway">Payout</label>
                                                <select name="automatic_payout" id="selectbox1">
                                                   <option value="1" @if($settings->firstWhere('name','automatic_payout')->value) selected @endif> Automatic </option>
                                                   <option value="0" @if(!$settings->firstWhere('name','automatic_payout')->value) selected @endif> Manual </option>
                                                                                                  
                                                </select>
                                            </div>
                                            
                                            <div class="contact-form-btn">
                                                <button class="button button--md askpin" type="button"> Save </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Throttle</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.settings.global')}}" method="post" >@csrf
                                        <div class="contact-form__content">
                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Security Throttle</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <input type="number" name="throttle_security_attempt" class="form-control" value="{{$settings->firstWhere('name','throttle_security_attempt')->value}}" placeholder="Maximum Attempt" />
                                                            <i class="small text-sm text-muted">Maximum attempt per minute</i>
                                                        </div>
                                                        <div>
                                                            <input type="number" name="throttle_security_time" class="form-control" value="{{$settings->firstWhere('name','throttle_security_time')->value}}" placeholder="Timeframe"  />
                                                            <i class="small text-sm text-muted">Delay Timeframe (minutes)</i>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>

                                            

                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Service Request Throttle</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <input type="number" name="throttle_service_attempt" class="form-control" value="{{$settings->firstWhere('name','throttle_service_attempt')->value}}" placeholder="Maximum Attempt" />
                                                            <i class="small text-sm text-muted">Maximum attempt per minute</i>
                                                        </div>
                                                        <div>
                                                            <input type="number" name="throttle_service_time" class="form-control" value="{{$settings->firstWhere('name','throttle_service_time')->value}}" placeholder="Timeframe"  />
                                                            <i class="small text-sm text-muted">Delay Timeframe (minutes)</i>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>

                                            

                                            <div class="contact-form-btn">
                                                <button class="button button--md askpin" type="button"> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="dashboard__content-card">
                                        <div class="dashboard__content-card-header">
                                            <h5 class="font-body--xl-500">Products</h5>
                                        </div>
                                        <div class="dashboard__content-card-body">
                                            <form action="{{route('admin.settings.global')}}" method="post" id="product">@csrf
                                                <div class="contact-form__content">
                                                    <div class="form-group row mb-2 font-body--md-400">
                                                        <label for="min_stck_level" class="col-8">Minimum stock level</label>
                                                        <input type="text" class="col-4"  name="minimum_stock_level" placeholder="Set Minimum stock level" value="{{$settings->firstWhere('name','minimum_stock_level')->value}}" />
                                                    </div>
                                                    <div class="form-group row mb-2 font-body--md-400">
                                                        <label for="max_stck_hours" class="col-8">Maximum stock level</label>
                                                        <input type="text" class="col-4"  name="maximum_stock_level" placeholder="Set Maximum stock level" value="{{$settings->firstWhere('name','maximum_stock_level')->value}}" />
                                                    </div>
                                                    <table>
                                                        
                                                        <tr>
                                                            <td class="d-flex">
                                                                <label class="form-check-label font-body--400" for="existing"> 
                                                                    Auto Approve Product
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <div class="form-check mx-3">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        On
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_product" @if($settings->firstWhere('name','auto_approve_product')->value) checked @endif value="1" >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        Off
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_product" @if(!$settings->firstWhere('name','auto_approve_product')->value) checked @endif value="0" > 
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        

                                                       
                                                    </table>
                                                    <div class="contact-form-btn">
                                                        <button class="button button--md askpin" type="button"> Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dashboard__content-card">
                                        <div class="dashboard__content-card-header">
                                            <h5 class="font-body--xl-500">Orders</h5>
                                        </div>
                                        <div class="dashboard__content-card-body">
                                            <form action="{{route('admin.settings.global')}}" method="post" id="orders">@csrf
                                                <div class="contact-form__content">
                                                    <div class="form-group row mb-2 font-body--sm-500">
                                                        <label for="max_del_hours" class="col-8 ">Order Processing to Cancel Hours</label>
                                                        <input type="text" class="col-4"  name="order_processing_to_user_cancel_period" placeholder="Set Processing to Cancellation Period" value="{{$settings->firstWhere('name','order_processing_to_delivery_period')->value}}" />
                                                    </div>
                                                    <div class="form-group row mb-2 font-body--sm-500">
                                                        <label for="max_del_hours" class="col-8 ">Order Processing to Shipment Hours</label>
                                                        <input type="text" class="col-4"  name="order_processing_to_shipment_period" placeholder="Set Processing to Shipment Period" value="{{$settings->firstWhere('name','order_processing_to_shipment_period')->value}}" />
                                                    </div>
                                                    <div class="form-group row mb-2 font-body--sm-500">
                                                        <label for="vat" class="col-8 ">Order Processing to Delivery Hours</label>
                                                        <input type="text" class="col-4" name="order_processing_to_delivery_period" placeholder="Set Processing to Delivery Period" value="{{$settings->firstWhere('name','order_processing_to_delivery_period')->value}}" />
                                                    </div>
                                                    <div class="form-group row mb-2 font-body--sm-500">
                                                        <label for="vat" class="col-8 ">Order Delivery to Acceptance Hours</label>
                                                        <input type="text" class="col-4" name="order_delivered_to_acceptance_period" placeholder="Set Delivery to Acceptance Period" value="{{$settings->firstWhere('name','order_delivered_to_acceptance_period')->value}}" />
                                                    </div>
                                                    
                                                    <div class="form-group row mb-2 font-body--sm-500">
                                                        <label for="vat" class="col-8 ">Order Rejected to Returned Hours</label>
                                                        <input type="text" class="col-4" name="order_rejected_to_returned_period" placeholder="Set Rejected to Returned Period" value="{{$settings->firstWhere('name','order_rejected_to_returned_period')->value}}" />
                                                    </div>
                                                    <div class="form-group row mb-2 font-body--sm-500">
                                                        <label for="vat" class="col-8 ">Order Rejected to Acceptance Hours</label>
                                                        <input type="text" class="col-4" name="order_rejected_to_acceptance_period" placeholder="Set Rejected to Acceptance Period" value="{{$settings->firstWhere('name','order_rejected_to_acceptance_period')->value}}" />
                                                    </div>
                                                    
                                                    <div class="contact-form-btn">
                                                        <button class="button button--md askpin" type="button"> Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- shop and adverts --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="dashboard__content-card">
                                        <div class="dashboard__content-card-header">
                                            <h5 class="font-body--xl-500">Shop</h5>
                                        </div>
                                        <div class="dashboard__content-card-body">
                                            <form action="{{route('admin.settings.global')}}" method="post" id="shop">@csrf
                                                <div class="contact-form__content">
                                                    <table>
                                                        
                                                        <tr>
                                                            <td class="d-flex">
                                                                <label class="form-check-label font-body--400" for="existing"> 
                                                                    Auto Approve Shop
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <div class="form-check mx-3">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        On
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_shop" @if($settings->firstWhere('name','auto_approve_shop')->value) checked @endif value="1" >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        Off
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_shop" @if(!$settings->firstWhere('name','auto_approve_shop')->value) checked @endif value="0" > 
                                                                </div>
                                                            </td>
                                                        </tr>
        
                                                    </table>
                                                    <div class="contact-form-btn">
                                                        <button class="button button--md askpin" type="button"> Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dashboard__content-card">
                                        <div class="dashboard__content-card-header">
                                            <h5 class="font-body--xl-500">Advert</h5>
                                        </div>
                                        <div class="dashboard__content-card-body">
                                            <form action="{{route('admin.settings.global')}}" method="post" id="advert">@csrf
                                                <div class="contact-form__content">
                                                    <div class="form-group row mb-2 font-body--md-400">
                                                        <label for="max_del_hours" class="col-8 font-body--400">Minimum Advert Days</label>
                                                        <input type="text" class="col-4"  name="minimum_advert_days" placeholder="Set minimum advert days" value="{{$settings->firstWhere('name','minimum_advert_days')->value}}" />
                                                    </div>
                                                    {{-- <div class="form-group row mb-2">
                                                        <label for="vat" class="col-8 font-body--400">Maximum Advert Days</label>
                                                        <input type="text" class="col-4" name="vat" placeholder="Set maximum advert days" value="{{$settings->firstWhere('name','maximum_advert_days')->value}}" />
                                                    </div> --}}
                                                    <table>
                                                        <tr>
                                                            <td class="d-flex">
                                                                <label class="form-check-label font-body--400" for="existing"> 
                                                                    Auto Approve Product Advert
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <div class="form-check mx-3">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        On
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_product_advert" @if($settings->firstWhere('name','auto_approve_product_advert')->value) checked @endif value="1" >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        Off
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_product_advert" @if(!$settings->firstWhere('name','auto_approve_product_advert')->value) checked @endif value="0" > 
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="d-flex">
                                                                <label class="form-check-label font-body--400" for="existing"> 
                                                                    Auto Approve Shop Advert
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <div class="form-check mx-3">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        On
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_shop_advert" @if($settings->firstWhere('name','auto_approve_shop_advert')->value) checked @endif value="1" >
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label font-body--400" for="existing"> 
                                                                        Off
                                                                    </label>
                                                                    <input class="form-check-input previous_addresses" type="radio" name="auto_approve_shop_advert" @if(!$settings->firstWhere('name','auto_approve_shop_advert')->value) checked @endif value="0" > 
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="contact-form-btn">
                                                        <button class="button button--md askpin" type="button"> Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                          </div>
                      </div>
                      <!-- Countries -->
                      <div class="tab-pane fade" id="pills-countries" role="tabpanel" aria-labelledby="pills-countries-tab">
                        <div class="row products-tab__feedback"> 
                            <!-- Manage Countries  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Manage Countries</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <div class="table-responsive">
                                        <table class="table display datatable" style="width:100%;font-size:13px">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="">Country</th>
                                                <th scope="col" class="">Currency</th>
                                                <th scope="col" class="">Location</th>
                                                <th scope="col" class="">Payment Gateway</th>
                                                <th scope="col" class="">Payout Gateway</th>
                                                <th scope="col" class="">Settings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($countries as $country)
                                                <tr>
                                                    <td>{{$country->name}}</td>
                                                    <td>{{$country->currency->name}}</td>
                                                    <td>{{$country->states->count()}} states, {{$country->cities->count()}} cities</td>
                                                    <td>{{$country->payment_gateway}}</td>
                                                    <td>{{$country->payout_gateway}}</td>
                                                    <td><a href="{{route('admin.settings.country',$country)}}" target="_blank">Open Settings</a></td>
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- Admin -->
                      <div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
                          <div class="products-tab__information">
                            <!-- Manage Admins  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Manage Admins</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <form method="post" action="{{route('admin.staff.store')}}" id="admin" class="mb-3">@csrf
                                    <div class="contact-form__content">
                                        <div class="contact-form__content-group">
                                            <div class="contact-form-input">
                                                <label for="states" style="">Admin Level</label>
                                                <select id="zips" name="role" class="form-control-lg w-100 border text-muted" >
                                                    <option value='admin' selected>Administrator</option>
                                                    <option value='customercare'>Customer Care</option>
                                                    <option value='security'>Security</option>
                                                    <option value='auditor'>Auditor</option>
                                                </select>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="states" style="">Status</label>
                                                <select id="zissdsp" name="status" class="form-control-lg w-100 border text-muted" >
                                                    <option value='1'>Active</option>
                                                    <option value='0'>Suspended</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="contact-form__content-group">
                                            <div class="contact-form-input">
                                                <label for="name">First Name</label>
                                                <input type="text" name="fname" placeholder="Enter First Name" required />
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="name">Last Name</label>
                                                <input type="text" name="lname" placeholder="Enter Last Name" required />
                                            </div>
                                        </div>
                                        <div class="contact-form__content-group">
                                            <div class="contact-form-input"> 
                                            <label for="email">Email</label>
                                            <input type="email" name="email" placeholder="Enter Email" required />
                                            </div>
                                            <div class="contact-form-input">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" placeholder="Enter Phone" required />
                                            </div>
                                        </div>
                                        <div class="contact-form__content-group">
                                            <div class="contact-form-input">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" placeholder="Enter Password" required />
                                            </div>
                                            <div class="contact-form-input">
                                            <label for="password">Repeat Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Repeat Password" required />
                                            </div>
                                        </div>
                                        <div class="contact-form-btn">
                                            <button class="button button--md askpin" type="button"> + Create Admin </button>
                                        </div>
                                    </div>
                                </form>
                                <div id="process3">
                                    <table id="" class="table " style="width:100%;font-size:13px">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">Manage</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}<br>{{$user->mobile}}
                                                    </td>
                                                    <td>@if($user->status) Active @else Suspended @endif</td>
                                                    <td>{{$user->role->name}}</td>
                                                    <td>
                                                        @if($user->id != Auth::id()) 
                                                        <a href="#" onclick="event.preventDefault();document.getElementById('adminedit'+{{$user->id}}).style.display='block';$('.select2').select2();">Edit </a> | 
                                                        <form class="d-inline" action="{{route('admin.staff.delete')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                                            <button type="submit" name="delete" value="1" class="text-danger">Delete</button>
                                                        </form>
                                                        
                                                        @endif
                                                    </td> 
                                                </tr>
                                                @if($user->id != Auth::id())
                                                <tr>
                                                    <td colspan="6" style="border:none;padding:0px">
                                                        <form action="{{route('admin.staff.update')}}" method="post" id="adminedit{{$user->id}}" style="display:none">
                                                            @csrf 
                                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                                            <div class="contact-form__content">
                                                                <div class="contact-form__content-group my-3">
                                                                    <div class="contact-form-input">
                                                                        <label for="states">Admin Level</label>
                                                                        <select id="abdcc{{$user->id}}" name="role" class="form-control-lg w-100 border text-muted" >
                                                                            <option value='admin' @if($user->role->name == 'admin') selected @endif>Administrator</option>
                                                                            <option value='customercare'  @if($user->role->name == 'customercare') selected @endif>Customer Care</option>
                                                                            <option value='security' @if($user->role->name == 'security') selected @endif>Security</option>
                                                                            <option value='auditor'  @if($user->role->name == 'auditor') selected @endif>Auditor</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="states">Status</label>
                                                                        <select id="abc{{$user->id}}" name="status" class="form-control-lg w-100 border text-muted" >
                                                                            <option value='1' @if($user->status) selected @endif>Active</option>
                                                                            <option value='0' @if(!$user->status) selected @endif>Suspended</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="contact-form__content-group my-3">
                                                                    <div class="contact-form-input">
                                                                        <label for="firstname">First Name @error('fname') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                        <input type="text" name="fname" value="{{$user->fname}}" placeholder="Enter First Name" />
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="lastname">Last Name @error('lname') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                        <input type="text" name="lname" value="{{$user->lname}}" placeholder="Enter Last Name" />
                                                                    </div>
                                                                </div>
                                                                <div class="contact-form__content-group">
                                                                    <div class="contact-form-input"> 
                                                                    <label for="email">Email @error('email') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                    <input type="email" name="email" value="{{$user->email}}" placeholder="Enter Email" />
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                    <label for="phone">Phone @error('phone') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                    <input type="text" name="phone" value="{{$user->phone}}" placeholder="Enter Phone" />
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="contact-form-btn">
                                                                    <button class="button button--md askpin" type="button"> Update Admin </button>
                                                                    <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            
                          </div>
                      </div>
                      <!-- Plan  -->
                      <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                        <div class="products-tab__information">
                            <!-- Manage Plan  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Manage Plans</h5>
                                </div>
                                <div class="dashboard__content-card-body">                                        
                                    <table class="table " style="width:100%;font-size:13px">
                                        
                                        <tbody>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Shops</th>
                                                <th scope="col">Products</th>
                                                <th scope="col">Parameters</th>
                                                <th scope="col">Prices</th>
                                                <th></th>
                                            </tr>
                                            @forelse ($plans as $plan)
                                                <tr>
                                                    <td>{{$plan->name}}</td>
                                                    <td>{{$plan->shops}}</td>
                                                    <td>{{$plan->products}}</td>
                                                    <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#plan_edit{{$plan->id}}">Edit Parameters</a></td>
                                                    <td><a href="{{route('admin.settings.plan',$plan)}}" target="_blank">Set Prices</a></td> 
                                                </tr>
                                                
                                                <div class="modal fade" id="plan_edit{{$plan->id}}" tabindex="-1" aria-labelledby="plan_edit{{$plan->id}}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="plan_edit{{$plan->id}}ModalLabel">Edit {{$plan->name}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.settings.plans')}}" method="post" id="planedit{{$plan->id}}" style="display:none;margin:20px 0px;"> @csrf 
                                                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                                                <div class="contact-form__content">
                                                                    
                                                                    <div class="contact-form-input">
                                                                        <label for="name">Plan Name</label>
                                                                        <input type="text" name="name" value="{{$plan->name}}" required />
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="name">Plan Description</label>
                                                                        <input type="text" name="description" value="{{$plan->description}}" required />
                                                                    </div>
                                                                    <div class="contact-form__content-group">
                                                                        <div class="contact-form-input">
                                                                            <label>No of Shops</label>
                                                                            <input type="number" name="shops" class="form-control" required value="{{$plan->shops}}"/>
                                                                        </div>
                                                                        <div class="contact-form-input">
                                                                            <label>No of Products</label>
                                                                            <input type="number" name="products" class="form-control" required value="{{$plan->products}}"/>     
                                                                        </div>
                                                                        
                                                                    </div> 
                                                                    <div class="contact-form-input">
                                                                        <label for="pin">Enter Your Access Pin</label>
                                                                        <input type="text" name="pin" id="pin_para{{$plan->id}}" value="" placeholder="Access pin">
                                                                    </div>
                                                                    <div class="contact-form-btn">
                                                                        <button class="button button--md" type="submit"> Update Plan </button>
                                                                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                        </div>
                                                    </div>
                                                </div> 
                                            @empty
                                                <tr><td colspan="7" class="text-center">No Plan</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                
                        </div>
                        
                      </div>
                      
                      <!--  Advert  -->
                      <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                          <div class="row products-tab__feedback">
                            
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Advert Plans</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <div class="contact-form__content">
                                        <table class="table" style="width:100%;font-size:13px">
                                            <tbody>
                                                <tr>
                                                    <th scope="col">Plan</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Page</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                                @foreach($adplans->sortBy('type') as $adplan)
                                                <tr>
                                                    <td>{{$adplan->name}}</td>
                                                    <td>{{ucwords($adplan->type)}}</td>
                                                    <td>{{$adplan->page}}</td>
                                                    <td>{{ucwords($adplan->description)}}</td>
                                                    <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#adplan_price{{$adplan->id}}">Set Prices</a></td>
                                                </tr>
                                                <div class="modal fade" id="adplan_price{{$adplan->id}}" tabindex="-1" aria-labelledby="adplan_price{{$adplan->id}}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="adplan_price{{$adplan->id}}ModalLabel">{{$adplan->name}} Pricing</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                            <form action="{{route('admin.settings.ad.pricing')}}" method="post" id="adplan_price{{$adplan->id}}form">
                                                                @csrf 
                                                                <input type="hidden" name="adplan_id" value="{{$adplan->id}}">
                                                                
                                                                <div class="pricing">
                                                                    <div class="row py-2">
                                                                        <div class="col-md-4">
                                                                            <span>Currency</span> 
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <span>Price Per Unit Per Day</span> 
                                                                        </div>
                                                                    </div>
                                                                    @foreach ($currencies as $currency)
                                                                    <div class="row py-2">
                                                                        <div class="col-md-4">
                                                                            {{$currency->name}}
                                                                            <input type="hidden" name="currencies[]" value="{{$currency->id}}">
                                                                        </div>  

                                                                        <div class="col-md-6">
                                                                            <input class="form-control-sm col border-light" type="number" step="0.001" required name="amount[{{$currency->id}}]" value="{{$adplan->costs->firstWhere('currency_id',$currency->id)->amount ?? 0}}">
                                                                        </div>  
                                                                    </div>
                                                                    @endforeach
                                                                </div> 
                                                                <div class="contact-form-input">
                                                                    <label for="pin">Enter Your Access Pin</label>
                                                                    <input type="text" name="pin" id="pin_ad{{$currency->id}}" value="" placeholder="Access pin">
                                                                </div>
                                                                <div class="contact-form-btn pt-2">
                                                                    <button class="button button--md" type="submit"> Update Advert Plan Prices </button>
                                                                    <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                      </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            
                                            
                                            </tbody>
                                        </table>
                                        <div class="contact-form-btn">
                                            <button class="button button--md askpin" type="button"> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <!--  Shipping  -->

                      
                  </div>
              </div>
            </div>
            <!-- Set VAT -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')
<script src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script>
<script>
    var modal_select = false;
    // var submittedform;
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
    
    $(document).on('change','.country',function(){
        var clicked = $(this);
        var country_id = $(this).val();
        states = $(this).closest('.location').find('.states');
        $.ajax({
            dataType: 'json',
            url: "{{url('getStates')}}"+'/'+country_id,
            success:function(data) {
                console.log(data)
                states.children().remove()
                data.data.forEach(element => {
                    states.append(`<option value="`+element.id+`">`+element.name+` </option>`)
                });
                if(clicked.parents('.modal').length){
                    states.select2({
                        dropdownParent: clicked.closest('.modal')
                    });
                }else{
                    states.select2();
                }
                    
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        })
    })

    $('.modal').on('show.bs.modal', function () {
        $(this).find('.select2').select2({
            dropdownParent: $(this).find('.modal-content')
        });
        // $('.select2').select2();
        console.log($(this).html())
    });
</script>
@endpush
