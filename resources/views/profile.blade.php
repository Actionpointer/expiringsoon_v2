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
  
  @if(Session::has('result'))
      <div class="mb-0 @if(Session('result')) notify @else error @endif" >
          <p style="color:#fff">{{Session('message')}}</p>
      </div>
  @endif
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
                          <div class="contact-form-input">
                            <label for="lname2">Last Name </label>
                            <input type="text" name="lname" value="{{$user->lname}}" placeholder="Last Name" />
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Phone Number</label>
                            <div class="input-group d-flex">
                                <div class="prepend">
                                    <select name="code" id="code" class="select2">
                                      @foreach ($countries as $country)
                                        <option class="small" value="+{{$country->dial}}" @if($country->dial == $user->phone_prefix) selected @endif>{{$country->name}} +{{$country->dial}}</option>
                                      @endforeach  
                                    </select>
                                </div>
                                <input type="number" name="phone" class="form-control" value="{{$user->phone}}" placeholder="Phone Number" onkeypress="validate(event)" />
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
                              <img @if(!$user->pic) src="{{asset('img/avatar.png')}}"  @else src="{{Storage::url($user->pic)}}" @endif alt="{{$user->name}}"  onclick="performClick('theFile');"  id="imgPreview"   />
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
                  <h5 class="font-body--xl-500">Delivery Addresses</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <div id="process3">
                    <table id="" class="table " style="width:100%;font-size:13px">
                      <thead>
                          <tr>
                              <th scope="col">Contact</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Status</th>
                              <th scope="col">Manage</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($user->addresses as $address)
                              <tr>
                                  <td>{{$address->contact_name}}</td>
                                  <td>{{$address->contact_phone}}</td>
                                  <td>{{$address->street.' '.$address->city->name.','.$address->state->name}}</td>
                                  <td>@if($address->main) main @endif</td>
                                  <td>
                                    <div class="d-flex">
                                      <a href="#" onclick="event.preventDefault();document.getElementById('adminedit'+{{$address->id}}).style.display='block'">Edit</a>| 
                                      <form class="d-inline" action="{{route('address')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                          <input type="hidden" name="address_id" value="{{$address->id}}">
                                          <input type="hidden" name="delete" value="1">
                                          <button type="submit" class="text-danger">Delete</button>
                                      </form>  
                                    </div>       
                                      
                                  </td> 
                              </tr>
                              
                              <tr>
                                  <td colspan="5" style="border:none;padding:0px">   
                                      <form method="post" action="{{route('address')}}" id="adminedit{{$address->id}}" style="display:none;margin-top:20px">@csrf
                                        <input type="hidden" name="address_id" value="{{$address->id}}">
                                        <div class="contact-form__content">
                                          
                                          <div class="contact-form-input">
                                              <label for="name">Address</label>
                                              <input type="text" name="street" placeholder="Enter Street" value="{{$address->street}}" required />
                                          </div>
                                          <div class="contact-form__content-group location">
                                            <div class="contact-form-input">
                                              <label for="state_id{{$address->id}}">State</label>
                                              <select name="state_id" id="state_id{{$address->id}}" class="select2 states">
                                                  @foreach ($states as $state)
                                                    <option value="{{$state->id}}" @if($address->state_id == $state->id) selected @endif>{{$state->name}}</option> 
                                                  @endforeach
                                                  
                                              </select>
                                            </div>
                                            <div class="contact-form-input">
                                              <label for="city_id{{$address->id}}">City</label>
                                              <select name="city_id" id="city_id{{$address->id}}" class="select2 cities">
                                                  <option value="{{$address->city_id}}">{{$address->city->name}}</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="contact-form__content-group">
                                              <div class="contact-form-input"> 
                                                <label for="contact_name">Contact Name</label>
                                                <input type="text" name="contact_name" value="{{$address->contact_name}}" placeholder="Contact name" required />
                                              </div>
                                              <div class="contact-form-input">
                                                <label for="contact_phone">Phone</label>
                                                <input type="text" name="contact_phone" value="{{$address->contact_phone}}" placeholder="Enter Phone" required />
                                              </div>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="main" @if($address->main) checked @endif value="1" id="main{{$address->id}}" />
                                            <label class="form-check-label" for="remember"> Main address </label>
                                          </div>
                                          <div class="contact-form-btn">
                                              <button class="button button--md" type="submit">Update Address </button>
                                          </div>
                                        </div>
                                    </form>
                                  </td>
                              </tr>
                              
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <form method="post" action="{{route('address')}}" id="admin" class="mb-3">@csrf
                      <h5 class="font-body--xl-500 mb-3 pb-3 border-bottom">Add new address</h5>
                      <div class="contact-form__content">
                        <div class="contact-form-input">
                            <label for="street">Address</label>
                            <input type="text" name="street" placeholder="Street" required />
                        </div>
                        <div class="contact-form__content-group location">
                          <div class="contact-form-input">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="select2 states">
                                @foreach ($states as $state)
                                  <option value="{{$state->id}}">{{$state->name}}</option> 
                                @endforeach 
                            </select>
                          </div>
                          <div class="contact-form-input">
                            <label for="password">City</label>
                            <select name="city_id" id="city_id" class="select2 cities">
                                <option value="90" selected>Somewhere</option>
                            </select>
                          </div>
                        </div>
                        <div class="contact-form__content-group">
                            <div class="contact-form-input"> 
                              <label for="contact_name">Contact Name</label>
                              <input type="text" name="contact_name" placeholder="Contact Name" required />
                            </div>
                            <div class="contact-form-input">
                              <label for="contact_phone">Phone</label>
                              <input type="text" name="contact_phone" placeholder="Contact Phone" required />
                            </div>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="main" value="1" id="main0" />
                          <label class="form-check-label" for="main"> Main address </label>
                        </div>
                        <div class="contact-form-btn">
                            <button class="button button--md" type="submit">Save New Address </button>
                        </div>
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
  $(document).on('change','.states',function(){
      var state_id = $(this).val();
      cities = $(this).closest('.location').find('.cities');
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
            
            //adjust all the subtotals and grandtotals here
        },
        error: function (data, textStatus, errorThrown) {
            console.log(data);
        },
      })
  })
  
</script>
@endpush
