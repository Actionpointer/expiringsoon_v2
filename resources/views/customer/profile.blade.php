@extends('layouts.app')

@push('styles')
<style>
  .docimg {
      width: 10%;
      margin-right: 5px;
      float: left;
  }
  .docimg img {
      width: 100%;
  }
  .docinfo {
      width: 70%;
  }
  #topUp,#theFile,#theDoc {
      display: none;
    }
</style>
@endpush
@section('title')Account Settings | User Dashboard @endsection
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
                <path
                  d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
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
        @if(auth()->user()->role == 'shopper')
          @include('customer.navigation')
        @endif
        @if(auth()->user()->role == 'vendor')
          @if(auth()->user()->staff->where('role','owner')->isNotEmpty())
            @include('vendor.navigation')
          @else
            @include('shop.navigation')
          @endif
        @endif
        @if(in_array(auth()->user()->role,['admin','customercare','security']))
          @include('admin.navigation')
        @endif

        
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Account Settings  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Account Settings </h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" id="editinfo" action="{{route('profile.update')}}" enctype="multipart/form-data">@csrf
                    <div class="row">
                      <div class="col-lg-7 order-lg-0 order-2">
                        <div class="contact-form__content">
                          <div class="contact-form-input">
                            <label for="fname">Username </label>
                            <input type="text" name="username" value="{{$user->username}}" placeholder="Choose Username" id="username" disabled   />
                          </div>
                          <div class="contact-form-input">
                            <label for="fname">First Name </label>
                            <input type="text" name="fname" value="{{$user->fname}}" placeholder="First Name"/>
                          </div>
                          <div class="contact-form-input">
                            <label for="lname2">Last Name </label>
                            <input type="text" name="lname" value="{{$user->lname}}" placeholder="Last Name" />
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Phone Number</label>
                            <input type="number" name="phone" value="{{$user->phone}}" placeholder="Phone Number" onkeypress="validate(event)" />
                          </div>
                          <div id="process" style="font-size:13px;font-weight:500"></div>
                          {{-- <div class="contact-form-btn">
                            <button class="button button--md" type="submit"> Save Details</button>
                          </div> --}}
                        </div>
                      </div>
                      <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img flex-column">
                            
                            <div class="dashboard__content-img-wrapper" id="avatar">
                              <img @if(!$user->pic) src="{{asset('img/avatar.png')}}"  @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->fname}} {{$user->lname}}"  onclick="performClick('theFile');"  id="imgPreview"   />
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

              @if(auth()->user()->role == 'shopper')
              <!-- Delivery Address  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">@if($user->role=='Shopper') Delivery Address @else Store/Pick-Up Address @endif</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" id="editaddress" action="{{route('edit-address')}}">@csrf
                    <input type="hidden" name="uid2" value="{{$user->id}}">
                    <div class="contact-form__content">
                      <div class="contact-form-input">
                        <label for="address">Street Address *</label>
                        <input type="text" name="address" value="{{$user->address}}" placeholder="Delivery Address" required/>
                      </div>
                      <div class="contact-form__content-group">
                        <!-- states -->
                        <div class="contact-form-input">
                          <label for="states">state</label>
                          <select id="states" name="state" class="contact-form-input__dropdown">
                          
                            @foreach ($states as $state)
                              <option value="{{$state->name}}" @if($user->state == $state->name) selected @endif>{{$state->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div id="process2" style="font-size:13px;font-weight:500"></div>
                    </div>
                    <div class="contact-form-btn">
                      <button class="button button--md" type="submit"> Save Details</button>
                  </div>
                  </form>
                </div>
              </div>
              <!-- Top Up Wallet  -->
              <div class="dashboard__content-card" id="topUpSection">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Top-Up Wallet</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" action="{{route('topup')}}">@csrf
                    <div class="contact-form__content">
                      <div class="contact-form-input">
                        <label for="address">Enter Amount *</label>
                        <input type="number" name="amount" id="amount" placeholder="0.00" autocomplete="off" required/>
                      </div>
                      <div id="process2" style="font-size:13px"></div>
                    </div>
                    <div class="contact-form-btn">
                      <button class="button button--md" type="submit">
                        Pay Now
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              @endif
              <!-- Change Password  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Change Password</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" action="{{route('edit-password')}}" id="editPassword">@csrf
                    <div class="contact-form__content">
                      <div class="contact-form-input">
                        <label for="cpassword">Current Password </label>
                        <input type="password" id="cpassword" name="oldpassword" placeholder="" autocomplete="current-password" required/>
                        <span class="icon" onclick="showPassword('cpassword',this)">
                          <svg   xmlns="http://www.w3.org/2000/svg"   width="20"   height="21"   viewBox="0 0 24 24"   fill="none"   stroke="currentColor"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round"   class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"   ></path>
                            <circle cx="12" cy="12" r="3"></circle>
                          </svg>
                        </span>
                      </div>
                      <div class="contact-form__content-group">
                        <!-- New Password  -->
                        <div class="contact-form-input"> <label for="npassword">New Password </label>
                          <input   type="password" id="newPassword" name="password" placeholder="" autocomplete="new-password" required />
                          <span class="icon" onclick="showPassword('npassword',this)"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye" > <path   d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" ></path> <circle cx="12" cy="12" r="3"></circle> </svg> </span>
                        </div>
                        <!-- confirm  Password  -->
                        <div class="contact-form-input">
                          <label for="confirmPassword">Confirm Password</label>
                          <input   type="password"   id="confirmPassword"   name="password_confirmation"  autocomplete="new-password" placeholder=""   required />
                          <span   class="icon"   onclick="showPassword('confirmPassword',this)">   
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                              <path   d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" ></path> 
                              <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                          </span>
                        </div>
                      </div>
                      <div id="passmatch" style="font-size:13px;font-weight:450"></div>
                      <div class="contact-form-btn">
                        <button type="submit" class="button button--md" type="submit"> Save New Password
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
  </div>
  <!-- dashboard Secton  End  -->
@endsection
@push('scripts')
<script>
  function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

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
</script>
@endpush
