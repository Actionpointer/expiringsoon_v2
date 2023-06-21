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
        @include('layouts.shop_navigation')
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
                        <button class="nav-link" id="pills-verification-tab" data-bs-toggle="pill" data-bs-target="#pills-verification" type="button" role="tab" aria-controls="pills-verification" aria-selected="false">
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
                                            <label for="number">Phone Number</label>
                                            <div class="input-group  d-flex">
                                                <button class="btn btn-outline-secondary" type="button">+{{session('locale')['dial']}}</button>
                                                <input type="number" name="phone" class="form-control" value="{{$shop->phone}}" placeholder="Phone Number"/>
                                            </div>
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
                                          <button class="button button--md" type="submit"> Save Details</button>
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
                                      <button class="button button--md" type="submit"> Save Details</button>
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
                                  <form method="post" id="discount_form" action="{{route('vendor.shop.update')}}">@csrf
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <div class="table-responsive">
                                      <table class="table">
                                        <tr>
                                            <th class="text-nowrap">Expiry Period</th>
                                            <th>Discount</th>
                                            <th></th>
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
                                            <td>@error('discount30') {{$message}}  @enderror</td>
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
                                          <td>@error('discount60') {{$message}}  @enderror</td>
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
                                          <td>@error('discount90') {{$message}}  @enderror</td>
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
                                          <td>@error('discount120') {{$message}}  @enderror</td>
                                        </tr>
                                      </table>
                                      <div class="contact-form-btn">
                                        <button class="button button--md" type="submit">Save Discount</button>
                                      </div>
                                    </div>
                                  </form>   
                                </div>
                              </div>
                            
                          </div>
                      </div>

                      <!-- Verification -->
                      <div class="tab-pane fade" id="pills-verification" role="tabpanel" aria-labelledby="pills-verification-tab">
                        <div class="products-tab__information">
                          <div class="dashboard__content-card">
                              
                            <div class="dashboard__content-card-header">
                              <h5 class="font-body--xl-500">Verification Document</h5>
                              <p style="font-size:11px;color:#888">Documents required for payout requests</p>
                            </div>
                            <div class="dashboard__content-card-body">
                              <div class="py-2 text-uppercase">
                                
                                <div class="text-uppercase">Upload all of the following documents so we can authenticate your account</div>  
                                
                                
                              </div>
                              
                              <div class="d-flex py-3 border-top">
                                <div class="docimg text-center">
                                  <a href="{{route('profile')}}#verification">
                                    <img  @if($user->idcard) 
                                            @if($user->idcard->doctype == 'application') 
                                              src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                                            @else
                                              src="{{Storage::url($user->idcard->document)}}" 
                                            @endif 
                                          @else
                                              src="{{asset('src/images/site/icon.jpg')}}"
                                          @endif >
                                  </a>
                                </div>
                                <div class="docinfo d-flex justify-content-between align-items-center">
                                  <div>
                                    <a href="{{route('profile')}}#verification" style="font-size:14px;text-transform:uppercase">Owner ID</a>
                                      <br />
                                      <span style="font-weight:500;font-size:12px;">
                                      National ID Card / Driver's License / International Passport
                                    </span>
                                  </div>
                                  @if($user->idcard) 
                                      <div>
                                        <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($user->idcard->status ) #00b207; @else #ff0000; @endif">
                                          @if($user->idcard->status) Approved
                                          @elseif($user->idcard->reason) Rejected
                                          @else Pending Approval  
                                          @endif 
                                        </span>
                                        @if($user->idcard->reason)
                                          <span class="d-block font-body--sm-400 text-danger">{{$user->idcard->reason}}</span>
                                        @endif
                                      </div> 
                                  @endif
            
                                </div>
                              </div>

                              <div class="d-flex py-3 border-top">
                                
                                <div class="docimg">
                                  <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}x');" class="text-center">
                                    <img  @if($shop->addressproof)  
                                            @if($shop->addressproof->doctype == 'application')) 
                                              src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                                            @else
                                              src="{{Storage::url($shop->addressproof->document)}}" 
                                            @endif 
                                          @else
                                              src="{{asset('src/images/site/icon.jpg')}}"
                                          @endif id="item{{$shop->id}}x_preview"
                                    >
                                    <small style="font-size:10px;text-decoration:underline" class="text-muted">Upload File</small>
                                  </a>
                                </div>

                                <div class="docinfo d-flex justify-content-between align-items-center">
                                  <div>
                                    <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}x');"  style="font-size:14px;text-transform:uppercase">Address Proof</a>
                                      <br />
                                      <span style="font-weight:500;font-size:12px">
                                      Upload Utility Bill e.g Electricity Bill, Waste Bill etc
                                    </span>
                                  </div>
                                  @if($shop->addressproof) 
                                      <div>
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
                                  @endif
                                </div>
                                <div class="align-self-center mx-1">
                                  <form method="post" enctype="multipart/form-data" action="{{route('vendor.shop.verification',$shop)}}">@csrf
                                    <input type="hidden" name="type" value="addressproof">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <input type="file" style="display: none" name="document[]" id="item{{$shop->id}}x" onchange="readVURL(this,'item{{$shop->id}}x')" accept=".pdf, .png, .jpg, .jpeg" />
                                    <button class="button button--md" id="item{{$shop->id}}x_submit" type="submit" style="display: none">Upload</button>
                                  </form>
                                </div>
                              </div>

                              <div class="d-flex py-3 border-top">
                                <div class="docimg">
                                  <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}y');" class="text-center">
                                    <img src="{{asset('src/images/site/iconm.jpg')}}" id="item{{$shop->id}}y_preview">
                                        {{-- @if($shop->companydocs) 
                                          @if($shop->companydocs->doctype == 'application') 
                                            src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                                          @else
                                            src="{{Storage::url($shop->companydocs->document)}}" 
                                          @endif 
                                        @else
                                            
                                        @endif 
                                      src="{{asset('src/images/site/icon-jpg.jpg')}}"  --}}
                                      
                                    <small style="font-size:10px;text-decoration:underline" class="text-muted">Upload Files</small>
                                  </a>
                                  
                                </div>
                                <div class="docinfo d-flex justify-content-between align-items-center">
                                  <div>
                                    <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}y');" style="font-size:14px;text-transform:uppercase">Company Documents</a>
                                      <br />
                                      <span style="font-weight:500;font-size:12px">
                                      Upload all company documents
                                    </span>
                                  </div>
                                  <div class="d-flex flex-column">
                                    @forelse($shop->companydocs as $companydoc) 
                                        <div>
                                          <a href="{{Storage::url($companydoc->document)}}" target="_blank">File :</a>
                                          <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($companydoc->status ) #00b207; @else #ff0000; @endif">
                                            @if($companydoc->status) Approved
                                            @elseif($companydoc->reason) Rejected
                                            @else Pending Approval  
                                            @endif 
                                          </span>
                                          @if($companydoc->reason)
                                            <span class="d-block font-body--sm-400 text-danger">{{$companydoc->reason}}</span>
                                          @endif
                                        </div>  
                                      @empty
                                    @endforelse
                                  </div> 
                                </div>
                                <div class="align-self-center mx-1">
                                  <form method="post" enctype="multipart/form-data" action="{{route('vendor.shop.verification',$shop)}}">@csrf
                                    <input type="hidden" name="type" value="companydoc">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <input type="file" style="display: none" name="document[]" multiple id="item{{$shop->id}}y" onchange="readVURL(this,'item{{$shop->id}}y')" accept=".pdf, .png, .jpg, .jpeg" />
                                    <button class="button button--md" id="item{{$shop->id}}y_submit" type="submit" style="display: none">Upload</button>
                                  </form>
                                </div>
                              </div>         
                            
                            </div>
                        </div>
                          
                        </div>
                    </div>

                      <!-- Staff -->
                      <div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
                          <div class="products-tab__information">
                            <!-- Manage Admins  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Manage Staff</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <form method="post" action="{{route('vendor.shop.staff.store',$shop)}}" id="admin" class="mb-3">@csrf
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
                                            <div class="input-group  d-flex">
                                              <button class="btn btn-outline-secondary" type="button">+{{$shop->country->dial}}</button>
                                              <input type="number" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone Number" required/>
                                            </div>
                                            
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
                                          <button class="button button--md" type="submit"> + Create Staff </button>
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
                                                  
                                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editstaff{{$user->id}}" >Edit</a> | 
                                                  <form class="d-inline" action="{{route('vendor.shop.staff.destroy',$shop)}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <button type="submit" name="delete" value="1" class="text-danger">Delete</button>
                                                  </form>
                                                  
                                              </td> 
                                              <div class="modal fade" id="editstaff{{$user->id}}" tabindex="-1" aria-labelledby="editstaff{{$user->id}}ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="editstaff{{$user->id}}ModalLabel">Edit Staff</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('vendor.shop.staff.update',$shop)}}" method="post" id="editstaff{{$user->id}}"> @csrf 
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
                                                                <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal" > Cancel </button>
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
                      
                      <!--  Shipping  -->
                      <div class="tab-pane fade" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                        <div class="row products-tab__feedback">
                            <!-- Add Category  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Add Destination</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                <form method="post" id="editcategory" action="{{route('vendor.shop.shipping.store',$shop)}}" >@csrf
                                    <div class="contact-form__content">
                                      <input type="hidden" name="shop_id" value="{{$shop->id}}">
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
                                        <input type="number" name="hours" max="{{cache('settings')['order_processing_to_delivery_period']}}" placeholder="hours" />
                                    </div>
                                    <div class="contact-form-input">
                                        <label for="amounts">Amount</label>
                                        <input type="number" name="amount" placeholder="delivery cost" />
                                        <small class="small text-muted"><i>Please note that we charge {{$shop->user->subscription->plan->shipment_percentage}}% + {!! $shop->country->currency->symbol !!}{{$shop->user->subscription->plan->shipment_fixed}} on your delivery cost as transfer processing fee</i></small>
                                    </div>
                                    
                                    <div class="contact-form-btn">
                                        <button class="button button--md " type="submit">
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
                                                
                                                <form class="d-inline" action="{{route('vendor.shop.shipping.delete',$shop)}}" method="post" onsubmit="return confirm('Are you sure you want to delete shipping rate?');">@csrf
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
                                                      <form action="{{route('vendor.shop.shipping.update',$shop)}}" method="post" id="rateedit{{$rate->id}}">
                                                          @csrf 
                                                          <input type="hidden" name="shop_id" value="{{$shop->id}}">
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

  function readVURL(input,output) {
      
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            if(e.target.result.split(';')[0].split('/')[1] == 'pdf'){
              $('#'+output+'_preview').attr('src', "{{asset('src/images/site/icon-pdf.jpg')}}" );
            }else{
              $('#'+output+'_preview').attr('src', e.target.result);
            }
            
          }
          reader.readAsDataURL(input.files[0]);
      }
      $('#'+output+'_submit').show()
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
        // type:'POST',
        dataType: 'json',
        url: "{{url('getCities')}}"+'/'+state_id,
        success:function(data) {
          cities.children().remove()
          data.data.forEach(element => {
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
