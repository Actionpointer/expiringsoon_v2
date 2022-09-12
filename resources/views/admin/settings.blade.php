@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" /> 
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>
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
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  
  @if(Session::has('result'))
      <div class="mb-0 @if(Session('result')) notify @else error @endif" >
          <p style="color:#fff">{{Session('message')}}</p>
      </div>
  @endif
  <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                              General
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                            Plans
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">
                              Admins
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false">
                              Advert
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-shipping-tab" data-bs-toggle="pill" data-bs-target="#pills-shipping" type="button" role="tab" aria-controls="pills-shipping" aria-selected="false">
                            Shipping
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
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Global</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.settings')}}" method="post" id="vat">@csrf
                                        <div class="contact-form__content">
                                            <div class="contact-form-input">
                                                <label for="country">Country</label>
                                                <select name="country_id" id="countries" class="select2">
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->id}}" @if(cache('settings')['country_id'] == $country->id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="contact-form-input">
                                                <label for="gateway">Payment Gateway</label>
                                                <select name="active_payment_gateway" id="selectbox2">
                                                    @foreach (explode(',',$settings->firstWhere('name','payment_gateways')->value) as $key=>$gateway)
                                                        <option value="{{$gateway}}" @if($settings->firstWhere('name','active_payment_gateway')->value == $gateway) selected @endif>{{ucwords($gateway)}}</option>
                                                    @endforeach                                                    
                                                </select>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="vat">VAT %</label>
                                                <input type="text" name="vat" placeholder="Set VAT Percentage" value="{{$settings->firstWhere('name','vat')->value}}" />
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="vat">Maximum Delivery Hours</label>
                                                <input type="text" name="maximum_delivery_hours" placeholder="Set Maximum Delivery Hours" value="{{$settings->firstWhere('name','maximum_delivery_hours')->value}}" />
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="number1">Throttle request</label>
                                                <div class="input-group d-flex">
                                                    <div class="prepend">
                                                        <label for="number1">Count</label>
                                                        <input type="number" name="throttle_request_count" class="form-control" value="{{$settings->firstWhere('name','throttle_request_count')->value}}" placeholder="Throttle count" />
                                                    </div>
                                                    <div>
                                                        <label for="number1">Every (minutes)</label>
                                                    <input type="number" name="throttle_request_minutes" class="form-control" value="{{$settings->firstWhere('name','throttle_request_minutes')->value}}" placeholder="Throttle minutes"  />
                                                    </div>
                                                    
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
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Others</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.settings')}}" method="post" id="vat">@csrf
                                        <div class="contact-form__content">
                                            <table>
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Auto Approve Advert
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="auto_approve_advert" @if($settings->firstWhere('name','auto_approve_advert')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="auto_approve_advert" @if(!$settings->firstWhere('name','auto_approve_advert')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
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
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Send Shop Approval Email
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_shop_approval_email" @if($settings->firstWhere('name','send_shop_approval_email')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_shop_approval_email" @if(!$settings->firstWhere('name','send_shop_approval_email')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Send Shop Rejection Email
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_shop_rejection_email" @if($settings->firstWhere('name','send_shop_rejection_email')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_shop_rejection_email" @if(!$settings->firstWhere('name','send_shop_rejection_email')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Send Product Approval Email
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_product_approval_email" @if($settings->firstWhere('name','send_product_approval_email')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_product_approval_email" @if(!$settings->firstWhere('name','send_product_approval_email')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Send Product Rejection Email
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_product_rejection_email" @if($settings->firstWhere('name','send_product_rejection_email')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_product_rejection_email" @if(!$settings->firstWhere('name','send_product_rejection_email')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Send Advert Approval Email
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_advert_approval_email" @if($settings->firstWhere('name','send_advert_approval_email')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_product_approval_email" @if(!$settings->firstWhere('name','send_advert_approval_email')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex">
                                                        <label class="form-check-label font-body--400" for="existing"> 
                                                            Send Advert Rejection Email
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="form-check mx-3">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                On
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_advert_rejection_email" @if($settings->firstWhere('name','send_advert_rejection_email')->value) checked @endif value="1" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> 
                                                                Off
                                                            </label>
                                                            <input class="form-check-input previous_addresses" type="radio" name="send_product_rejection_email" @if(!$settings->firstWhere('name','send_advert_rejection_email')->value) checked @endif value="0" > 
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="contact-form-btn">
                                                <button class="button button--md" type="submit"> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                          </div>
                      </div>

                      <!-- Plan  -->
                      <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                        <div class="products-tab__description">
                          <div class="dashboard__content-card">
                              <div class="dashboard__content-card-header">
                                  <h5 class="font-body--xl-500">Basic</h5>
                              </div>
                              <div class="dashboard__content-card-body">
                                  <form action="{{route('admin.settings')}}" method="post" id="vat">@csrf
                                      <div class="contact-form__content">
                                          <div class="contact-form-input">
                                              <label for="feature">Minimum Payout</label>
                                              <input type="text" name="minpayout" placeholder="Minimum Payout" value="{{$settings->firstWhere('name','basic_minimum_payout')->value}}" />
                                          </div>
                                          <div class="contact-form-input">
                                              <label for="vat">Maximum Payout</label>
                                              <input type="text" name="maxpayout" placeholder="Set Maximum. Payout" value="{{$settings->firstWhere('name','basic_maximum_payout')->value}}"/>
                                          </div>
                                          <div class="contact-form-input">
                                              <div class="row">
                                                    <div class="col-sm-3">
                                                        <label for="vat">Commission %</label>
                                                        <input type="text" name="basic_commission_percentage" placeholder="Percentage" value="{{$settings->firstWhere('name','basic_commission_percentage')->value}}"/>
                                                    </div>
                                                    <div class="col-sm-1"> 
                                                        <p class="h4 my-4 text-center">+</p>  
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="vat">Commission Fixed</label>
                                                        <input type="text" name="basic_commission_fixed" placeholder="Fixed" value="{{$settings->firstWhere('name','basic_commission_fixed')->value}}"/>
                                                    </div>
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
                          <div class="dashboard__content-card">
                              <div class="dashboard__content-card-header">
                                  <h5 class="font-body--xl-500">Enterprise</h5>
                              </div>
                              <div class="dashboard__content-card-body">
                                  <form method="post" id="payout">
                                    <div class="contact-form__content">
                                        <div class="contact-form-input">
                                            <label for="vat">Enterprise Minimum Payout</label>
                                            <input type="text" name="minpayout" placeholder="Set Min. Payout" value="{{$settings->firstWhere('name','enterprise_minimum_payout')->value}}" onkeypress="validate(event)" />
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="vat">Enterprise Maximum Payout</label>
                                            <input type="text" name="minpayout" placeholder="Set Min. Payout" value="{{$settings->firstWhere('name','enterprise_maximum_payout')->value}}" onkeypress="validate(event)" />
                                        </div>
                                        <div class="contact-form-input">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="vat">Enterprise Commission %</label>
                                                        <input type="text" name="enterprise_commission_percentage" placeholder="Percentage" value="{{$settings->firstWhere('name','enterprise_commission_percentage')->value}}"/>
                                                    </div>
                                                    <div class="col-sm-1"> 
                                                        <p class="h4 my-4 text-center">+</p>  
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="vat">Enterprise Commission Fixed</label>
                                                        <input type="text" name="enterprise_commission_fixed" placeholder="Fixed" value="{{$settings->firstWhere('name','enterprise_commission_fixed')->value}}"/>
                                                    </div>
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
                                <form method="post" action="{{route('admin.user.store')}}" id="admin" class="mb-3">@csrf
                                    <div class="contact-form__content">
                                    <div class="contact-form-input">
                                        <label for="states" style="margin-top:15px">Admin Level</label>
                                        <select id="zip" name="role" class="contact-form-input__dropdown" >
                                        <option value='admin' selected>Administrator</option>
                                        <option value='customercare'>Customer Care</option>
                                        <option value='security'>Security</option>
                                        <option value='auditor'>Auditor</option>
                                        </select>
                                    </div>
                                    <div class="contact-form-input">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" placeholder="Enter Full Name" required />
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
                                        <button class="button button--md" type="submit"> + Create Admin </button>
                                    </div>
                                    </div>
                                </form>
                                <div id="process3">
                                    <table id="" class="table " style="width:100%;font-size:13px">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Manage</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->mobile}}</td>
                                                <td>{{$user->role}}</td>
                                                <td>
                                                    @if($user->id != Auth::id()) 
                                                    <a href="#" onclick="event.preventDefault();document.getElementById('adminedit'+{{$user->id}}).style.display='block'">Edit</a>| 
                                                    <form class="d-inline" action="{{route('admin.user.delete')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <button type="submit" class="text-danger">Delete</button>
                                                    </form>
                                                    
                                                    @endif
                                                </td> 
                                            </tr>
                                            @if($user->id != Auth::id())
                                            <tr>
                                                <td colspan="6" style="border:none;padding:0px">
                                                    <form action="#" method="post" id="adminedit{{$user->id}}" style="display:none">
                                                        @csrf 
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <div class="contact-form__content">
                                                            <div class="contact-form__content-group my-3">
                                                                <div class="contact-form-input">
                                                                    <label for="states">Admin Level</label>
                                                                    <select name="role" class="form-control-lg w-100 contact-form-input__dropdown border text-muted" >
                                                                        <option value='admin' @if($user->role == 'admin') selected @endif>Administrator</option>
                                                                        <option value='customercare'  @if($user->role == 'customercare') selected @endif>Customer Care</option>
                                                                        <option value='security' @if($user->role == 'security') selected @endif>Security</option>
                                                                        <option value='auditor'  @if($user->role == 'auditor') selected @endif>Auditor</option>
                                                                    </select>
                                                                </div>
                                                            
                                                                <div class="contact-form-input">
                                                                    <label for="address">Full Name @error('fname') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                    <input type="text" name="name" value="{{$user->name}}" placeholder="Enter Full Name" />
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
                                                            <div class="contact-form__content-group">
                                                                <div class="contact-form-input">
                                                                <label for="password">Password @error('password') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                <input type="password" name="password" placeholder="Enter Password"/>
                                                                </div>
                                                                <div class="contact-form-input">
                                                                <label for="repeat">Repeat Password</label>
                                                                <input type="password" name="password_confirmation" placeholder="Repeat Password"/>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="contact-form-btn">
                                                                <button class="button button--md" type="submit"> Update Admin </button>
                                                                <button class="button button--md bg-danger" type="button" onclick="event.preventDefault();document.getElementById('adminedit'+{{$user->id}}).style.display='none'"> Cancel </button>
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
                      <!--  Advert  -->
                      <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                          <div class="row products-tab__feedback">
                            
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Adverts</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form method="post" id="vat">
                                        <div class="contact-form__content">
                                            <table class="table">
                                                <tr>
                                                    <th>Plan</th>
                                                    <th>Days</th>
                                                    <th>Rate</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Shops</th>
                                                </tr>
                                                <tr>
                                                    <td>Feature one shop</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature many shops</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature to home page</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature to the top</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Products</th>
                                                </tr>
                                                <tr>
                                                    <td>Feature one product</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature one category</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature many products</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature many categories</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature to home page</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Feature to the top</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr><th colspan="3">Emails to customers on:</th></tr>
                                                <tr>
                                                    <td>New Product</td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <td>Price Drop </td>
                                                    <td><input type="text" value="10" class="form-control"></td>
                                                    <td><input type="text" value="1000" class="form-control"></th>
                                                </tr>
                                            </table>
                                            <div class="contact-form-btn">
                                                <button class="button button--md" type="submit"> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>
                      </div>
                      <!--  Shipping  -->
                      <div class="tab-pane fade" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                        <div class="row products-tab__feedback">
                            <!-- Add Category  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Add Destination</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <form method="post" id="editcategory" action="{{route('admin.shipments')}}">@csrf
                                    <div class="contact-form__content">
                                        <div class="contact-form__content-group">
                                            <div class="contact-form-input">
                                                <label for="origin">Origin </label>
                                                <select id="state" name="origin_id" class="select2">
                                                    @foreach ($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="postal">Destination </label>
                                                <select id="postals" name="destination_id" class="select2">
                                                    @foreach ($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="contact-form__content-group">
                                            <div class="contact-form-input">
                                                <label for="hours">Hours</label>
                                                <input type="number" name="hours" max="{{$settings->firstWhere('name','maximum_delivery_hours')->value}}" placeholder="hours" />
                                            </div>

                                            <div class="contact-form-input">
                                                <label for="amounts">Amount</label>
                                                <input type="number" name="amount" placeholder="Delivery cost" />
                                            </div>
                                        </div>

                                        <div class="contact-form-btn">
                                            <button class="button button--md" type="submit">
                                            + Add Shipping Rate
                                            </button>
                                        </div>
                                    
                                    </div>
                                </form>
                                </div>
                            </div>
                
                            <!-- Manage Shipping  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Manage Shipping Rates</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table display" style="width:100%;font-size:13px">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="">Origin</th>
                                            <th scope="col" class="">Destination</th>
                                            <th scope="col" class="">Hours</th>
                                            <th scope="col" class="">Amount</th>
                                            <th scope="col" class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rates as $rate)
                                            <tr>
                                                <td>{{$rate->origin->name}}</td>
                                                <td>{{$rate->destination->name}}</td>
                                                <td>{{$rate->hours}}</td>
                                                <td>{{$rate->amount}}</td>
                                                <td> 
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#rateedit{{$rate->id}}">Edit</a> | 
                                                    <form class="d-inline" action="{{route('admin.shipments')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                                        <input type="hidden" name="rate_id" value="{{$rate->id}}">
                                                        <input type="hidden" name="option" value="delete">
                                                        <button type="submit" class="text-danger">Delete</button>
                                                    </form>
                                                </td>
                                                <div class="modal fade" id="rateedit{{$rate->id}}" tabindex="-1" aria-labelledby="rateedit{{$rate->id}}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="rateedit{{$rate->id}}ModalLabel">Edit Shipping Rate</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.shipments')}}" method="post" id="rateedit{{$rate->id}}" style="display:none">
                                                                @csrf 
                                                                <input type="hidden" name="rate_id" value="{{$rate->id}}">
                                                                <div class="contact-form__content my-3">
                                                                    <div class="contact-form__content-group">
                                                                        <div class="contact-form-input">
                                                                            <label for="origin">Origin </label>
                                                                            <select id="country" name="origin_id" class="form-control-lg w-100 contact-form-input__dropdown border text-muted" >
                                                                                @foreach ($states as $state)
                                                                                    <option value="{{$state->id}}" @if($rate->origin_id == $state->id) selected @endif>{{$state->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="contact-form-input">
                                                                            <label for="destination">Destination </label>
                                                                            <select id="destination" name="destination_id" class="form-control-lg w-100 contact-form-input__dropdown border text-muted" >
                                                                                @foreach ($states as $state)
                                                                                    <option value="{{$state->id}}" @if($rate->destination_id == $state->id) selected @endif>{{$state->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="contact-form__content-group">
                                                                        <div class="contact-form-input">
                                                                            <label for="hours">Hours</label>
                                                                            <input type="number" name="hours" value="{{$rate->hours}}" placeholder="hours" />
                                                                        </div>
                                                            
                                                                        <div class="contact-form-input">
                                                                            <label for="amounts">Amount</label>
                                                                            <input type="number" name="amount" value="{{$rate->amount}}" placeholder="Delivery cost" />
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="contact-form-btn">
                                                                        <button class="button button--md" type="submit">
                                                                            Update Shipping Rate
                                                                        </button>
                                                                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                      </div>
                                                    </div>
                                                </div>
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
<script src="{{asset('src/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/demo.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/jszip.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/pdfmake.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/vfs_fonts.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/buttons.print.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
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
            searchPlaceholder: "Search",
            }
        });
    });
</script>
@endpush
