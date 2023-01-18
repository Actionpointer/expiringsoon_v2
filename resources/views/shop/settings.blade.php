@extends('layouts.app')

@push('styles')

@endpush
@section('title') Shop Settings | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"  />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('home')}}"> Shop <span> > </span> </a>
          </li>
          <li class="active"><a href="#">Settings</a></li>
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
        @include('shop.navigation')
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
                            Verification
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">
                              Staff
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
                              <!-- Account Settings  -->
                              <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                  <h5 class="font-body--xl-500">Account Settings </h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                  <form method="post" id="editinfo" action="{{route('vendor.shop.update')}}" enctype="multipart/form-data">@csrf
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <div class="row">
                                      <div class="col-lg-7 order-lg-0 order-2">
                                        <div class="contact-form__content">
                                          <div class="contact-form-input">
                                            <label for="fname">Username </label>
                                            <input type="text" name="username" value="{{$shop->slug}}" placeholder="Choose Username" id="username" disabled   />
                                          </div>
                                          <div class="contact-form-input">
                                            <label for="fname">Shop Name </label>
                                            <input type="text" name="name" value="{{$shop->name}}" placeholder=" Name"/>
                                          </div>
                                          <div class="contact-form-input">
                                            <label for="lname2">Shop Email </label>
                                            <input type="email" name="email" value="{{$shop->email}}" placeholder="Email" />
                                          </div>
                                          <div class="contact-form-input">
                                            <label for="number1">Phone Number</label>
                                            <input type="number" name="phone" value="{{$shop->phone}}" placeholder="Phone Number" onkeypress="validate(event)" />
                                          </div>
                                          <div class="contact-form-input">
                                            <label for="visibility">Visibility</label>
                                            <select class="form-control-lg w-100 text-muted border" name="published">
                                                <option value="0" @if(!$shop->published) selected @endif>Draft</option>
                                                <option value="1" @if($shop->published) selected @endif>Published</option>
                                            </select>
                                          </div>
                                          
                                        </div>
                                      </div>
                                      <div class="col-lg-5 order-lg-0 order-1">
                                        <div class="dashboard__content-card-img flex-column">
                                            
                                            <div class="dashboard__content-img-wrapper" id="avatar">
                                              <img @if(!$shop->banner) src="{{asset('src/images/site/avatar.png')}}"  @else src="{{Storage::url($shop->banner)}}" @endif alt="{{$shop->fname}} {{$shop->lname}}"  onclick="performClick('theFile');"  id="imgPreview"   />
                                            </div>
                                            <div>
                                              <input type="file" name="photo" id="theFile" onchange="readURL(this,'imgPreview')" accept=".png, .jpg, .jpeg" />
                                              <button type="button" class="button w-100 mt-3 button--outline" id="btn-avatar" onclick="performClick('theFile');">Upload Avatar/Logo</button>
                                            </div>
                                            
                                        </div>
                                      </div>
                                      <div class="col-lg-12 order-lg-0 order-1">
                                        <div class="contact-form-btn">
                                          <button class="button button--md submit" type="button"> Save Details</button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>

                              <!-- Delivery Address  -->
                              <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                  <h5 class="font-body--xl-500"> Store/Pick-Up Address</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                  <form method="post" id="editaddress" action="{{route('vendor.shop.update')}}">@csrf
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <div class="contact-form__content">
                                      <div class="contact-form-input">
                                        <label for="address">Street Address *</label>
                                        <input type="text" name="address" value="{{$shop->address}}" placeholder="Shop Address" required/>
                                      </div>
                                      <div class="contact-form__content-group">
                                        <!-- states -->
                                        <div class="contact-form-input">
                                          <label for="states">state</label>
                                          <select id="state" name="state_id" class="states select2">
                                            @foreach ($states as $state)
                                              <option value="{{$state->id}}" @if($shop->state_id == $state->id) selected @endif>{{$state->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="contact-form-input">
                                          <label for="cities">City</label>
                                          <select id="city" name="city_id" class="cities select2" >
                                            @foreach ($cities as $city)
                                              <option value="{{$city->name}}" @if($shop->city_id == $city->id ) selected @endif>{{$city->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="contact-form-btn">
                                      <button class="button button--md submit" type="button"> Save Details</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                              
                              <!-- Discount -->
                              <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Discounts</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                  <form method="post" id="discount_form" action="{{route('shop.discounts',$shop)}}">@csrf
                                    <div class="table-responsive">
                                      <table class="table">
                                        <tr>
                                            <th class="text-nowrap">Expiry Period</th>
                                            <th>Discount</th>
                                        </tr>
                                        <tr>
                                            <td>30 Days</td>
                                            <td>
                                              <div class="input-group d-flex flex-nowrap">
                                                  
                                                  <input class="form-control-sm border-light" type="number" name="discount30" value="{{$shop->discount30}}">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                  </div>
                                              </div>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td>60 Days</td>
                                          <td>
                                            <div class="input-group d-flex flex-nowrap">
                                                  
                                              <input class="form-control-sm border-light" type="number" name="discount60" value="{{$shop->discount60}}">
                                              <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                              </div>
                                          </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>90 Days</td>
                                          <td>
                                            <div class="input-group d-flex flex-nowrap">
                                                  
                                              <input class="form-control-sm border-light" type="number" name="discount90" value="{{$shop->discount90}}">
                                              <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                              </div>
                                          </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>120 Days</td>
                                          <td>
                                            <div class="input-group d-flex flex-nowrap">
                                                  
                                              <input class="form-control-sm border-light" type="number" name="discount120" value="{{$shop->discount120}}">
                                              <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                              </div>
                                          </div>
                                          </td>
                                        </tr>
                                      </table>
                                      <div class="contact-form-btn">
                                        <button class="button button--md submit" type="button">Save Discount</button>
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
                            <!-- Verification -->
                            <div class="dashboard__content-card">
                              
                              <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Verification Document</h5>
                                <p style="font-size:11px;color:#888;text-transform:uppercase">Documents required for payout requests</p>
                              </div>
                              <div class="dashboard__content-card-body">
                                <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px">Upload any of the following documents so we can authenticate your account</div>
                                <form method="post" enctype="multipart/form-data" id="uploadDoc" action="{{route('shop.kyc',$shop)}}">@csrf
                                  <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                                    @if($shop->idcard)
                                      <div class="docimg">
                                        <a href="{{Storage::url($shop->idcard->document)}}" target="_blank">
                                          <img @if($shop->idcard->doctype =='PDF') src="{{asset('src/images/site/icon-pdf.jpg')}}" @else src="{{Storage::url($shop->idcard->document)}}" @endif id="idcardpreview">
                                        </a>
                                        
                                      </div>
                                      <div class="docinfo d-flex justify-content-between align-items-center">
                                        <div>
                                          <span style="font-size:14px">Owner ID</span>
                                            <br />
                                            <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->idcard->status ) #00b207; @else #ff0000; @endif">
                                              @if($shop->idcard->status) Approved
                                              @elseif($shop->idcard->reason) Rejected
                                              @else Pending Approval
                                              @endif
                                            </span>
                                            @if($shop->idcard->reason)
                                              <span class="d-block font-body--sm-400 text-danger">{{$shop->idcard->reason}}</span>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary" type="button" onclick="performClick('idcard');">@if(!$shop->idcard->reason) Uploaded @else Upload @endif</button>
                                    
                                      </div>
                                    @else
                                    <div class="docimg">
                                      <a href="javascript:void()" onclick="performClick('idcard');" target="_blank">
                                        <img src="{{asset('src/images/site/icon-jpg.jpg')}}" id="idcardpreview">
                                      </a>
                                      
                                    </div>
                                    <div class="docinfo d-flex justify-content-between align-items-center">
                                      <div>
                                        <span style="font-size:14px">Owner ID</span>
                                          <br />
                                          <span style="font-weight:500;font-size:12px;text-transform:uppercase">
                                          Upload National ID Card / Driver's License / International Passport
                                        </span>
                                      </div>
                                      <button class="btn btn-primary" type="button" onclick="performClick('idcard');">Upload</button>
                                      
                                    </div>
                                    @endif
                                    <input type="file" style="display: none" name="idcard" id="idcard" onchange="readURL(this,'idcardpreview')" accept=".pdf, .png, .jpg, .jpeg" />
                                  </div>
                                  <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                                    @if($shop->addressproof)
                                      <div class="docimg">
                                        <a href="{{Storage::url($shop->addressproof->document)}}" target="_blank">
                                          <img @if($shop->addressproof->doctype =='PDF') src="{{asset('src/images/site/icon-pdf.jpg')}}" @else src="{{Storage::url($shop->addressproof->document)}}" @endif id="addressproofpreview">
                                        </a>
                                      </div>
                                      <div class="docinfo d-flex justify-content-between align-items-center">
                                        <div>
                                          <span style="font-size:14px">Address Proof</span>
                                            <br />
                                            <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->addressproof->status ) #00b207; @else #ff0000; @endif">
                                              @if($shop->addressproof->status) Approved
                                              @elseif($shop->addressproof->reason) Rejected
                                              @else Pending Approval
                                              @endif
                                            </span>
                                            @if($shop->addressproof->reason)
                                              <span class="d-block font-body--sm-400 text-danger">{{$shop->addressproof->reason}}</span>
                                            @endif
                                        </div>
                    
                                        <button class="btn btn-primary" type="button" onclick="performClick('addressproof');">@if(!$shop->addressproof->reason) Uploaded @else Upload @endif</button>
                                      </div>
                                    @else
                                    <div class="docimg">
                                      <a href="javascript:void()" onclick="performClick('addressproof');" target="_blank">
                                        <img src="{{asset('src/images/site/icon-jpg.jpg')}}" id="addressproofpreview">
                                      </a>
                                      
                                    </div>
                                    <div class="docinfo d-flex justify-content-between align-items-center">
                                      <div>
                                        <span style="font-size:14px">Address Proof</span>
                                          <br />
                                          <span style="font-weight:500;font-size:12px;text-transform:uppercase">
                                          Upload Utility Bill e.g Electricity Bill, Waste Bill etc
                                        </span>
                                      </div>
                                      <button class="btn btn-primary" type="button" onclick="performClick('addressproof');">Upload</button>
                                    </div>
                                    @endif
                                    <input type="file" style="display: none" name="addressproof" id="addressproof" onchange="readURL(this,'addressproofpreview')" accept=".pdf, .png, .jpg, .jpeg" />
                                  </div>
                                  <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                                    @if($shop->companydoc)
                                      <div class="docimg">
                                        <a href="{{Storage::url($shop->companydoc->document)}}" target="_blank">
                                          <img @if($shop->companydoc->doctype =='PDF') src="{{asset('src/images/site/icon-pdf.jpg')}}" @else src="{{Storage::url($shop->companydoc->document)}}" @endif id="companydocpreview">
                                        </a>
                                      </div>
                                      <div class="docinfo d-flex justify-content-between align-items-center">
                                        <div>
                                          <span style="font-size:14px">Company Document</span>
                                            <br />
                                            <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->companydoc->status ) #00b207; @else #ff0000; @endif">
                                              @if($shop->companydoc->status) Approved
                                              @elseif($shop->companydoc->reason) Rejected
                                              @else Pending Approval
                                              @endif
                                            </span>
                                            @if($shop->companydoc->reason)
                                              <span class="d-block font-body--sm-400 text-danger">{{$shop->companydoc->reason}}</span>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary"  type="button" onclick="performClick('companydoc');">@if(!$shop->companydoc->reason) Uploaded @else Upload @endif</button>
                                      </div>
                                    @else
                                    <div class="docimg">
                                      <a href="javascript:void()" onclick="performClick('companydoc');" target="_blank">
                                        <img src="{{asset('src/images/site/icon-jpg.jpg')}}" id="companydocpreview">
                                      </a>
                                      
                                    </div>
                                    <div class="docinfo d-flex justify-content-between align-items-center">
                                      <div>
                                        <span style="font-size:14px">Company Document</span>
                                          <br />
                                          <span style="font-weight:500;font-size:12px;text-transform:uppercase">
                                          Upload CAC
                                        </span>
                                      </div>
                                      <button class="btn btn-primary" type="button" onclick="performClick('companydoc');">Upload</button>
                                    </div>
                                    @endif
                                    <input type="file" style="display: none" name="companydoc" id="companydoc" onchange="readURL(this,'companydocpreview')" accept=".pdf, .png, .jpg, .jpeg" />
                                  </div>

                                    <div class="contact-form-btn">
                                      <button class="button button--md submit" type="button" id="btn-doc">
                                          Save Document
                                      </button>
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
                                <h5 class="font-body--xl-500">Manage Staff</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <form method="post" action="{{route('shop.staff',$shop)}}" id="admin" class="mb-3">@csrf
                                    <div class="contact-form__content">
                                      <div class="contact-form__content-group">
                                          <div class="contact-form-input">
                                              <label for="fname">First Name</label>
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
                                          <button class="button button--md submit" type="button"> + Create Staff </button>
                                      </div>
                                    </div>
                                </form>
                                <div id="process3">
                                    <table id="datatable" class="table display" style="width:100%;font-size:13px">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Status</th>
                                            
                                            <th scope="col">Manage</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shop->staff as $user)
                                            <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}} <br> {{$user->mobile}}</td>
                                            <td>@if($user->status) Active @else Suspended @endif</td>
                                           
                                            <td>
                                                @if($user->id != Auth::id()) 
                                                <a href="#" onclick="event.preventDefault();document.getElementById('adminedit'+{{$user->id}}).style.display='block'">Edit</a> | 
                                                <form class="d-inline" action="{{route('shop.staff',$shop)}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                                  <input type="hidden" name="user_id" value="{{$user->id}}">
                                                  <button type="submit" name="delete" value="1" class="text-danger">Delete</button>
                                                </form>
                                                @endif
                                            </td> 
                                            </tr>
                                            @if($user->id != Auth::id())
                                            <tr>
                                              <td colspan="6" style="border:none;padding:0px">
                                                  <form action="{{route('shop.staff',$shop)}}" method="post" id="adminedit{{$user->id}}" style="display:none">
                                                      @csrf 
                                                      <input type="hidden" name="user_id" value="{{$user->id}}">
                                                      <div class="contact-form__content">
                                                      <div class="contact-form__content-group my-3">
                                                          <div class="contact-form-input">
                                                            <label for="address">Full Name @error('name') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                            <input type="text" name="name" value="{{$user->name}}" placeholder="Enter Full Name" readonly/>
                                                          </div>
                                                          <div class="contact-form-input">
                                                            <label for="stat">Status @error('status') <span class="text-danger">{{$status}}</span> @enderror</label>
                                                            <select id="abc{{$user->id}}" name="status" class="form-control-lg w-100 border text-muted" >
                                                              <option value='1' @if($user->status) selected @endif>Active</option>
                                                              <option value='0' @if(!$user->status) selected @endif>Suspended</option>
                                                          </select>
                                                          </div>
                                                      </div>
                                                      <div class="contact-form__content-group">
                                                          <div class="contact-form-input"> 
                                                          <label for="email">Email @error('email') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                          <input type="email" name="email" value="{{$user->email}}" placeholder="Enter Email" readonly/>
                                                          </div>
                                                          <div class="contact-form-input">
                                                          <label for="phone">Phone @error('phone') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                          <input type="text" name="phone" value="{{$user->phone}}" placeholder="Enter Phone" readonly/>
                                                          </div>
                                                      </div>
                                                      
                                                      
                                                      <div class="contact-form-btn">
                                                          <button class="button button--md" type="submit"> Update Staff </button>
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
                      
                      <!--  Shipping  -->
                      <div class="tab-pane fade" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                        <div class="row products-tab__feedback">
                            <!-- Add Category  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Add Destination</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <form method="post" id="editcategory" action="{{route('shop.shipping',$shop)}}" >@csrf
                                    <div class="contact-form__content">
                
                                    <div class="contact-form__content-group">
                                        <div class="contact-form-input">
                                        <label for="states">State </label>
                                        <select id="statez" name="destination_id" class="states select2">
                                            @foreach ($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                
                                    <div class="contact-form-input">
                                        <label for="hours">Hours</label>
                                        <input type="number" name="hours" max="{{cache('settings')['maximum_delivery_hours']}}" placeholder="hours" />
                                    </div>
                                    <div class="contact-form-input">
                                        <label for="amounts">Amount</label>
                                        <input type="number" name="amount" placeholder="delivery cost" />
                                    </div>
                                    
                                    <div class="contact-form-btn">
                                        <button class="button button--md submit" type="button">
                                        + Add Shipping Rate
                                        </button>
                                    </div>
                                    
                                    </div>
                                </form>
                                </div>
                            </div>
                
                            <!-- Manage Categories  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Manage Shipping Rates</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <div id="process3">
                                    <table class="table display" style="width:100%;font-size:13px">
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
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rateedit{{$rate->id}}">Edit</a> | 
                                                
                                                <form class="d-inline" action="{{route('shop.shipping',$shop)}}" method="post" onsubmit="return confirm('Are you sure you want to delete shipping rate?');">@csrf
                                                  <input type="hidden" name="rate_id" value="{{$rate->id}}">
                                                  <button type="submit" name="delete" value="1" class="text-danger">Delete</button>
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
                                                      <form action="{{route('shop.shipping',$shop)}}" method="post" id="rateedit{{$rate->id}}">
                                                          @csrf 
                                                          <input type="hidden" name="rate_id" value="{{$rate->id}}">
                                                          <div class="contact-form__content my-3">
                                                              <div class="contact-form__content-group">
                                                                  
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
<script>
        
  function performClick(elemId) {
    var elem = document.getElementById(elemId);
    if(elem && document.createEvent) {
        var evt = document.createEvent("MouseEvents");
        evt.initEvent("click", true, false);
        elem.dispatchEvent(evt);
    }
  }
        
  function readURL(input,output) {
      console.log(input.id);
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
          $('#'+output).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $('.edit-discount').click(function(){
      var period = $(this).attr('data-period')
      var discount = $(this).attr('data-discount')
      $('#discount_period option[value="'+period+'"]').prop('selected', true)
      $('#discount_value').val(discount)
      $('#discount_form').show();
  })
  $(document).on('change','#state',function(){
      var state_id = $(this).val();
      cities = $('.cities');
      // console.log.val())
      $.ajax({
        type:'POST',
        dataType: 'json',
        url: "{{route('cities')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'state_id': state_id,
        },
        success:function(data) {
          cities.children().remove()
          data.forEach(element => {
            cities.append(`<option value="`+element.id+`">`+element.name+` </option>`)
          });
          cities.select2();
        },
        error: function (data, textStatus, errorThrown) {
            console.log(data);
        },
      })
  })
</script>
@endpush
