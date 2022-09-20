@extends('layouts.app')

@push('styles')

@endpush
@section('title') Create Shop @endsection
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
                  <h5 class="font-body--xl-500">Create Shop </h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" id="editinfo" action="{{route('vendor.shop.store')}}" enctype="multipart/form-data">@csrf
                    <div class="row">
                      <div class="col-lg-7 order-lg-0 order-2">
                        <div class="contact-form__content">
                          
                          <div class="contact-form-input">
                            <label for="fname">Shop Name </label>
                            <input type="text" name="name" placeholder=" Name"/>
                          </div>
                          <div class="contact-form-input">
                            <label for="lname2">Shop Email </label>
                            <input type="email" name="email" placeholder="Email" />
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Phone Number</label>
                            <input type="number" name="phone" placeholder="Phone Number in local format. e.g 080945432" />
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img flex-column">
                            
                            <div class="dashboard__content-img-wrapper" id="avatar">
                              <img src="{{asset('img/avatar.png')}}" alt="logo"  onclick="performClick('theFile');"  id="imgPreview"   />
                            </div>
                            <div>
                              <input type="file" name="photo" id="theFile" onchange="readURL(this,'imgPreview')" accept=".png, .jpg, .jpeg" />
                              <button type="button" class="button w-100 mt-3 button--outline" id="btn-avatar" onclick="performClick('theFile');">Upload Logo/Banner </button>
                            </div>
                            
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="contact-form__content">
                            <div class="contact-form-input">
                              <label for="address">Street Address *</label>
                              <input type="text" name="address" placeholder="Store Address" required/>
                            </div>
                            <div class="contact-form__content-group row">
                              <!-- states -->
                              <div class="contact-form-input col-lg-6">
                                <label for="states">state</label>
                                <select id="states" name="state" class="contact-form-input__dropdown">
                                  @foreach ($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="contact-form-input col-lg-6">
                                <label for="city">city</label>
                                <select name="city_id" class="select2">
                                    @foreach ($cities as $city)
                                      <option value="{{$city->id}}">{{ucwords(strtolower($city->name))}}</option>
                                    @endforeach
                                </select>
                              </div>
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

</script>
@endpush
