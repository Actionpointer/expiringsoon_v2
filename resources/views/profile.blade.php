@extends('layouts.app')

@push('styles')

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
  @include('layouts.session')
<!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.navigation')
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
                            <label for="fname">First Name </label>
                            <input type="text" name="fname" value="{{$user->fname}}" placeholder="First Name"/>
                          </div>
                          @error('fname')
                            <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <div class="contact-form-input">
                            <label for="lname2">Last Name </label>
                            <input type="text" name="lname" value="{{$user->lname}}" placeholder="Last Name" />
                          </div>
                          @error('lname')
                            <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <div class="contact-form-input">
                            <label for="number1">Phone Number</label>
                            <div class="input-group  d-flex">
                              <button class="btn btn-outline-secondary" type="button">+{{$user->country->dial}}</button>
                              <input type="number" name="phone" class="form-control" value="{{$user->phone}}" placeholder="Phone Number"/>
                            </div>
                          </div>
                          @error('phone')
                            <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <div class="contact-form__content-group location">
                                            
                            <div class="contact-form-input">
                              <label for="state_id">State</label>
                              <select name="state_id" id="state_id" class="select2 states">
                                  @foreach ($states as $state)
                                    <option value="{{$state->id}}" @if($user->state_id == $state->id) selected @endif>{{$state->name}}</option> 
                                  @endforeach
                              </select>
                              @error('state_id')
                                <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="contact-form-input">
                              <label for="city">City</label>
                              <select name="city_id" class="select2 cities">
                                <option></option>
                                @foreach ($user->state->cities as $city)
                                  <option value="{{$city->id}}" @if($city->id == $user->city_id) selected @endif>{{ucwords(strtolower($city->name))}}</option>
                                @endforeach
                              </select>
                              @error('city_id')
                                <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                              
                            </div>

                          </div>
                          {{-- <div class="contact-form-btn">
                            <button class="button button--md" type="submit"> Save Details</button>
                          </div> --}}
                        </div>
                      </div>
                      <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img flex-column"> 
                            <div class="dashboard__content-img-wrapper" id="avatar">
                              <img @if(!$user->pic) src="{{asset('src/images/site/avatar.png')}}"  @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}"  onclick="performClick('theFile');"  id="imgPreview"   />
                            </div>
                            <div>
                              <input type="file" name="photo" id="theFile" onchange="readURL(this,'imgPreview')" accept=".png, .jpg, .jpeg" />
                              <button type="button" class="button w-100 mt-3 button--outline" id="btn-avatar" onclick="performClick('theFile');">Upload Avatar/Logo</button>
                            </div>
                            @error('photo')
                            <span class="invalid-feedback d-block text-danger text-center mb-4" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
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
                      @error('oldpassword')
                        <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      <div class="contact-form__content-group">
                        <!-- New Password  -->
                        <div class="contact-form-input"> 
                          <label for="npassword">New Password </label>
                          <input   type="password" id="newPassword" name="password" placeholder="" autocomplete="new-password" required />
                          <span class="icon" onclick="showPassword('npassword',this)"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye" > 
                              <path   d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" ></path> 
                              <circle cx="12" cy="12" r="3"></circle> 
                            </svg> 
                          </span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
              @if(auth()->user()->role->name != 'shopper')
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Access Pin</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" action="{{route('edit-pin')}}" id="editPassword">@csrf
                    <div class="contact-form__content">
                      
                      <div class="contact-form__content-group">
                        <!-- New Password  -->
                        <div class="contact-form-input"> <label for="newPin">New Pin </label>
                          <input   type="password" id="newPin" name="pin" minlength="4" maxlength="4" placeholder="" autocomplete="new-pin" required />
                          <span class="icon" onclick="showPassword('npassword',this)"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye" > <path   d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" ></path> <circle cx="12" cy="12" r="3"></circle> </svg> </span>
                        </div>
                        @error('pin')
                        <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                        <!-- confirm  Password  -->
                        <div class="contact-form-input">
                          <label for="confirmPin">Confirm Pin</label>
                          <input   type="password"   id="confirmPin"   name="pin_confirmation" minlength="4" maxlength="4"  autocomplete="new-pin" placeholder=""   required />
                          <span   class="icon"   onclick="showPassword('confirmPassword',this)">   
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                              <path   d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" ></path> 
                              <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                          </span>
                        </div>
                        
                      </div>
                      <div class="contact-form-input">
                        <label for="number1">One Time Password</label>
                        <div class="input-group d-flex">
                          <div class="append">
                            <button class="btn btn-dark btn-lg" type="button" id="generate">Click to Generate OTP</button>
                          </div>
                           <input type="text" name="otp" class="form-control" placeholder="Enter OTP" />
                        
                            
                          </div>
                      </div>
                      <span id="otp_response"></span>
                      @error('otp')
                        <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      <div id="passmatch" style="font-size:13px;font-weight:450"></div>
                      <div class="contact-form-btn">
                        <button type="submit" class="button button--md" type="submit"> Save New Pin
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              @endif

              @if(auth()->user()->role->name == 'vendor')
              <div class="dashboard__content-card" id="verification">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Verification Document</h5>
                  <p style="font-size:11px;color:#888;text-transform:uppercase">Documents required for payout requests</p>
                </div>
                <div class="dashboard__content-card-body">
                  {{-- <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px;">
                    Upload any of the following documents so we can authenticate your account
                  </div> --}}
                  @error('document')
                    <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px;color:red">
                      {{$message}}
                    </div>
                  @enderror
                  <div class="d-flex" style="padding-bottom:20px;margin-top:10px;">
                    <div class="docimg text-center">
                      <a href="javascript:void(0)" onclick="performClick('idcard');">
                        <img  @if($user->kyc->where('type','idcard')->first()) 
                                @if($user->kyc->where('type','idcard')->where('doctype','application')->first()) 
                                  src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                                @else
                                  src="{{Storage::url($user->kyc->where('type','idcard')->first()->document)}}" 
                                @endif 
                              @else
                                  src="{{asset('src/images/site/icon-jpg.jpg')}}"
                              @endif 
                              
                              id="idcard_preview">
                        <small style="font-size:10px;text-decoration:underline" class="text-muted">Upload image</small>
                      </a>
                    </div>
                    <div class="docinfo d-flex justify-content-between align-items-center">
                      <div>
                        <span style="font-size:14px;text-transform:uppercase">Owner ID</span>
                          <br />
                          <span style="font-weight:500;font-size:12px;">
                          Upload National ID Card / Driver's License / International Passport
                        </span>
                      </div>
                      @if($user->kyc->where('type','idcard')->first()) 
                          <div>
                            <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($user->kyc->where('type','idcard')->first()->status ) #00b207; @else #ff0000; @endif">
                              @if($user->kyc->where('type','idcard')->first()->status) Approved
                              @elseif($user->kyc->where('type','idcard')->first()->reason) Rejected
                              @else Pending Approval  
                              @endif 
                            </span>
                            @if($user->kyc->where('type','idcard')->first()->reason)
                              <span class="d-block font-body--sm-400 text-danger">{{$user->kyc->where('type','idcard')->first()->reason}}</span>
                            @endif
                          </div> 
                      @endif

                    </div>
                    <div class="align-self-center mx-1">
                      <form method="post" enctype="multipart/form-data" action="{{route('vendor.kyc')}}">@csrf
                        <input type="hidden" name="type" value="idcard">
                        <input type="file" style="display: none" name="document" id="idcard" onchange="readVURL(this,'idcard')" accept=".pdf, .png, .jpg, .jpeg" />
                        <button class="button button--md" id="idcard_submit" type="submit" style="display: none">Upload</button>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
              @endif
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
  
  $(document).on('change','.states',function(){
      var state_id = $(this).val();
      cities = $(this).closest('.location').find('.cities');
      // console.log.val())
      $.ajax({
        // type:'POST',
        dataType: 'json',
        url: "{{url('getCities')}}"+'/'+state_id,
        success:function(data) {
          console.log(data)
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

  $(document).on('click','#generate',function(){
      $.ajax({
        type:'GET',
        dataType: 'json',
        url: "{{route('generate_otp')}}",
        success:function(data) {
          console.log(data)
          if(data.data){
            $('#otp_response').addClass('text-success')
          }else {
            $('#otp_response').addClass('text-danger')
          }
          $('#otp_response').text(data.message)
        },
        error: function (data, textStatus, errorThrown) {
            console.log(data);
        },
      })
  })
  
</script>
@endpush
