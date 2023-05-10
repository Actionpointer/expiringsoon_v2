@extends('layouts.app')

@push('styles')

@endpush
@section('title') Account Settings | User Dashboard @endsection
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
          <li class="active"><a href="#">Address Book</a></li>
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
                  <h5 class="font-body--xl-500">New Address</h5>
                </div>
                <div class="dashboard__content-card-body">
                  
                  <form method="post" action="{{route('address.store')}}" id="admin" class="mb-3">@csrf
                     
                      <div class="contact-form__content">
                        <div class="contact-form-input">
                            <label for="street">Address</label>
                            <input type="text" name="street" placeholder="Street" required />
                        </div>
                        @error('street')
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
                            <select name="city_id" class="select2 cities" required>
                              <option>Select State First</option>
                              @foreach ($user->state->cities as $city)
                                <option value="{{$city->id}}">{{ucwords(strtolower($city->name))}}</option>
                              @endforeach
                            </select>
                            @error('city_id')
                              <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          
                          
                          
                          
                        </div>
                        <div class="contact-form__content-group">
                            <div class="contact-form-input"> 
                              <label for="contact_name">Contact Name</label>
                              <input type="text" name="contact_name" placeholder="Contact Name" required />
                            </div>
                            @error('contact_name')
                            <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                            <div class="contact-form-input">
                              <label for="contact_phone">Phone</label>
                              <div class="input-group  d-flex">
                                <button class="btn btn-outline-secondary" type="button">+{{$user->country->dial}}</button>
                                <input type="number" name="contact_phone" class="form-control" value="{{old('contact_phone')}}" placeholder="Contact Phone Number" required/>
                              </div>
                              
                            </div>
                            @error('contact_phone')
                            <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
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
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Manage Addresses</h5>
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
                                  <td>{{$address->street.' '.($address->city ? $address->city->name : '').','.$address->state->name}}</td>
                                  <td>@if($address->main) main @endif</td>
                                  <td>
                                    <div class="d-flex">
                                      <a href="#" onclick="event.preventDefault();document.getElementById('adminedit'+{{$address->id}}).style.display='block'">Edit</a>| 
                                      <form class="d-inline" action="{{route('address.delete')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                          <input type="hidden" name="address_id" value="{{$address->id}}">
                                          <input type="hidden" name="delete" value="1">
                                          <button type="submit" class="text-danger">Delete</button>
                                      </form>  
                                    </div>       
                                      
                                  </td> 
                              </tr>
                              
                              <tr>
                                  <td colspan="5" style="border:none;padding:0px">   
                                      <form method="post" action="{{route('address.update')}}" id="adminedit{{$address->id}}" style="display:none;margin-top:20px">@csrf
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
                                              <label for="city{{$address->id}}">City</label>
                                              <select name="city_id" class="select2 cities" required>
                                                <option>Select City</option>
                                                @foreach ($address->state->cities as $city)
                                                  <option value="{{$city->id}}" @if($city->id == $address->city_id) selected @endif>{{ucwords(strtolower($city->name))}}</option>
                                                @endforeach
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
                                                <div class="input-group  d-flex">
                                                  <button class="btn btn-outline-secondary" type="button">+{{$user->country->dial}}</button>
                                                  <input type="number" name="contact_phone" class="form-control" value="{{$address->contact_phone}}" placeholder="Phone Number" required/>
                                                </div>
                                                
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
@include('layouts.front')
<script>
  
  $(document).on('change','.states',function(){
      var state_id = $(this).val();
      cities = $(this).closest('.location').find('.cities');
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
