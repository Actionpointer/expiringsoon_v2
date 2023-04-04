@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> 

<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush
@section('title') Country Settings | Expiring Soon @endsection
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
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                            Basic
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-countries-tab" data-bs-toggle="pill" data-bs-target="#pills-countries" type="button" role="tab" aria-controls="pills-countries" aria-selected="false">
                            States
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">
                              Cities
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
                                    <h5 class="font-body--xl-500">Basic Settings</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.settings.country.basic')}}" method="post" id="country_basic{{$country->id}}form">
                                        @csrf 
                                        <input type="hidden" name="country_id" value="{{$country->id}}">
                                        <div class="contact-form__content my-3">
                                            <div class="contact-form-input">
                                                <label for="origin">Currency </label>
                                                <select id="currency_id{{$country->id}}" name="currency_id" class="select2" >
                                                    @foreach ($currencies as $currency)
                                                        <option value="{{$currency->id}}" @if($country->currency_id == $currency->id) selected @endif>{{$currency->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="destination_a{{$country->id}}">Receiving Payment Gateway </label>
                                                    <select id="destination_a{{$country->id}}" name="payment_gateway" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="paystack" @if($country->payment_gateway == 'paystack') selected @endif>Paystack</option>
                                                        <option value="flutterwave" @if($country->payment_gateway == 'flutterwave') selected @endif>Flutterwave</option>
                                                        <option value="paypal" @if($country->payment_gateway == 'paypal') selected @endif>Paypal</option>
                                                        <option value="stripe" @if($country->payment_gateway == 'stripe') selected @endif>Stripe</option>
                                                    </select>
                                                </div>
                                                <div class="contact-form-input">
                                                    <label for="destination_b{{$country->id}}">Transfering Payment Gateway </label>
                                                    <select id="destination_b{{$country->id}}" name="payout_gateway" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="paystack" @if($country->payout_gateway == 'paystack') selected @endif >Paystack</option>
                                                        <option value="flutterwave" @if($country->payout_gateway == 'flutterwave') selected @endif >Flutterwave</option>
                                                        <option value="paypal" @if($country->payout_gateway == 'paypal') selected @endif >Paypal</option>
                                                        <option value="stripe" @if($country->payout_gateway == 'stripe') selected @endif >Stripe</option>
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="hours">Vat</label>
                                                    <input type="number" step="0.1" name="vat" value="{{$country->vat}}" placeholder="vat" />
                                                </div>
                                    
                                                <div class="contact-form-input">
                                                    <label for="amounts">Bank Account Digits</label>
                                                    <input type="number" name="bank_digits" value="{{$country->bank_digits}}" placeholder="e.g 10" />
                                                </div>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="pin">Enter Your Access Pin</label>
                                                <input type="text" name="pin" id="pin{{$country->id}}" value="" placeholder="Access pin">
                                            </div>
                                            <div class="contact-form-btn">
                                                <button class="button button--md " type="submit">
                                                    Update Basic Settings
                                                </button>
                                                <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                            </div>
                                        </div>
                                    </form>
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
                                <h5 class="font-body--xl-500">New States</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form action="{{route('admin.settings.country.states')}}" method="post" id="country_states{{$country->id}}form">
                                        <h5 class="font-body--xl-400">Set Automatically</h5>
                                        <p class="font-body--md-400">The system will attempt to fetch online all the states belonging to {{$country->name}}.</p>
                                        <div class="contact-form-btn text-center my-3">
                                            <button class="button button--md" name="type" value="automatic" type="submit">
                                                Fetch States Automatically
                                            </button>
                                        </div>
                                        <p class="text-center">OR</p>
                                        @csrf 
                                        <h5 class="font-body--xl-400">Set Manually</h5>
                                        <p class="font-body--md-400">States added via this form will be appended to the existing list. Any duplicate found will not be added</p>
                                        <p class="font-body--md-400">Kindly ensure to add each state in the format of Code:Name such as e.g LA:Lagos,OG:Ogun,FC:Abuja. Please check the state code online to add the correct code.</p>
                                        <input type="hidden" name="country_id" value="{{$country->id}}">
                                        <div class="contact-form__content my-3">
                                            <div class="contact-form--input contact-form--input-area">
                                                <label for="destination">Add States</label>
                                                <textarea name="states" cols="auto" class="w-100" placeholder="e.g LA:Lagos,OG:Ogun,FC:Abuja" ></textarea>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="pinedit{{$country->id}}">Enter Your Access Pin</label>
                                                <input type="text" name="pin" id="pinedit{{$country->id}}" value="" placeholder="Access pin">
                                            </div>
                                            <div class="contact-form-btn">
                                                <button class="button button--md" name="type" value="manual" type="submit">
                                                    Add States
                                                </button>
                                                <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row products-tab__feedback"> 
                            <!-- Manage Countries  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Manage States</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <div class="table-responsive">
                                        <table class="table display datatable" style="width:100%;font-size:13px">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="">Name</th>
                                                <th scope="col" class="">Code</th>
                                                <th scope="col" class="">Cities</th>
                                                <th scope="col" class="">Settings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($country->states as $state)
                                                <tr>
                                                    <td>{{$state->name}}</td>
                                                    <td>{{$state->iso}}</td>
                                                    <td>{{$state->cities->count()}} cities</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="javascript:void(0)" class="rename_state me-4" data-id="{{$state->id}}" data-name="{{$state->name}}"><i class="fa fa-edit"></i> Rename</a>  
                                                            <a href="javascript:void(0)" class="delete_state text-danger" data-id="{{$state->id}}" data-name="{{$state->name}}" data-shops="{{$state->shops->count()}}" data-users="{{$state->users->count()}}" data-addresses="{{$state->addresses->count()}}" data-rates="{{$state->rates->count()}}" data-cities="{{$state->cities->count()}}" data-locations="{{$state->locations->count()}}">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </div>
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
                      <!-- Admin -->
                      <div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
                            <div class="row products-tab__information">
                            <!-- Manage Admins  -->
                                <div class="dashboard__content-card">
                                    <div class="dashboard__content-card-header">
                                        <h5 class="font-body--xl-500">New Cities</h5>
                                    </div>
                                    <div class="dashboard__content-card-body">
                                        <form action="{{route('admin.settings.country.cities')}}" method="post" id="country_cities{{$country->id}}form">
                                            <input type="hidden" name="country_id" value="{{$country->id}}">
                                            <div class="contact-form__content my-3">
                                                <div class="contact-form-input">
                                                    <label for="statex">State </label>
                                                    <select name="state_id" class="select2" required>
                                                        @foreach ($country->states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}-{{$state->cities->count()}} cities</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <h5 class="font-body--xl-400">Fetch Automatically</h5>
                                            <p class="font-body--md-400">The system will attempt to fetch online all the cities belonging to selected state.</p>
                                            <div class="contact-form-btn text-center my-3">
                                                <button class="button button--md" name="type" value="automatic" type="submit">
                                                    Fetch Cities Automatically
                                                </button>
                                            </div>
                                            <p class="text-center">OR</p>
                                            @csrf 
                                            <h5>Set Manually</h5>
                                            <p class="font-body--md-400">Cities added via this form will be appended to the existing list. Any duplicate found will not be added</p>
                                            <p class="font-body--md-400">Kindly ensure to add each city name like this. e.g Yaba,Agege,</p>
                                            <div class="contact-form--input contact-form--input-area">
                                                <label for="destination">Add Cities</label>
                                                <textarea name="cities" cols="auto" class="w-100" placeholder="e.g Surulere,Agege,Ikotun,Ikorodu" ></textarea>
                                            </div>
                                            <div class="contact-form-input">
                                                <label for="pin">Enter Your Access Pin</label>
                                                <input type="text" name="pin" id="pincity{{$country->id}}" value="" placeholder="Access pin">
                                            </div>
                                            <div class="contact-form-btn">
                                                <button class="button button--md" name="type" value="manual" type="submit">
                                                    Add Cities
                                                </button>
                                                <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row products-tab__feedback"> 
                                <!-- Manage Countries  -->
                                <div class="dashboard__content-card">
                                    <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Manage Cities</h5>
                                    </div>
                                    <div class="dashboard__content-card-body">
                                        <div class="table-responsive">
                                            <table class="table display datatable" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">State</th>
                                                    <th scope="col" class="">City</th>
                                                    <th scope="col" class="">Settings</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($country->cities as $city)
                                                    <tr>
                                                        <td>{{$city->state->name}}</td>
                                                        <td>{{$city->name}}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="javascript:void(0)" class="rename_city me-4" data-id="{{$city->id}}" data-name="{{$city->name}}"><i class="fa fa-edit"></i> Rename</a>  
                                                                <a href="javascript:void(0)" class="delete_city text-danger" data-id="{{$city->id}}" data-name="{{$city->name}}" data-shops="{{$city->shops->count()}}" data-users="{{$city->users->count()}}" data-addresses="{{$city->addresses->count()}}" data-locations="{{$city->locations->count()}}">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a>
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
            </div>
            <!-- Set VAT -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
<div class="modal fade" id="rename_state" tabindex="-1" aria-labelledby="rename_stateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="rename_stateModalLabel">Rename State</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.settings.state.manage')}}" method="post"> @csrf 
                <input type="hidden" name="state_id" id="rename_state_id">
                <div class="contact-form__content">
                    <div class="contact-form-input">
                        <label for="pin">New Name</label>
                        <input type="text" name="name" id="rename_state_name">
                    </div>
                    <div class="contact-form-input">
                        <label for="pin">Enter Your Access Pin</label>
                        <input type="text" name="pin" id="rename_state_pin" value="" placeholder="Access pin">
                    </div>
                    <div class="contact-form-btn">
                        <button class="button button--md" type="submit" name="action" value="rename"> Rename </button>
                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                    </div>
                    
                </div>
            </form>
        </div>
        
        </div>
    </div>
</div>
<div class="modal fade" id="delete_state" tabindex="-1" aria-labelledby="delete_stateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="delete_stateModalLabel">Delete <span id="delete_state_name"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.settings.state.manage')}}" method="post"> @csrf 
                <input type="hidden" name="state_id" id="delete_state_id">
                <div class="contact-form__content">
                    
                    The selected state has 
                    <table class="table">
                        <tr>
                            <td><span id="delete_state_users"></span></td><td>Users</td>
                        </tr>
                        <tr>
                            <td><span id="delete_state_shops"></span></td><td>Shops</td>
                        </tr>
                        <tr>
                            <td><span id="delete_state_rates"></span></td><td>Shipping Rates</td>
                        </tr>
                        <tr>
                            <td><span id="delete_state_cities"></span></td><td>Cities</td>
                        </tr>
                        <tr>
                            <td><span id="delete_state_addresses"></span></td><td>Address</td>
                        </tr>
                        <tr>
                            <td><span id="delete_state_locations"></span></td><td>Locations</td>
                        </tr>
                    </table>
                    <div id="delete_state_message">
                        <p>State cannot be deleted until all the dependant data are deleted</p> 
                    </div>
                    <div id="delete_state_button" style="display:none">
                        <div class="contact-form-input">
                            <label for="pin">Enter Your Access Pin</label>
                            <input type="text" name="pin" id="delete_state_pin" value="" placeholder="Access pin">
                        </div>
                        <div class="contact-form-btn">
                            <button class="button button--md" type="submit" name="action" value="delete"> Delete </button>
                            <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        </div>
    </div>
</div>
<div class="modal fade" id="rename_city" tabindex="-1" aria-labelledby="rename_cityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="rename_cityModalLabel">Rename City</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.settings.city.manage')}}" method="post"> @csrf 
                <input type="hidden" name="city_id" id="rename_city_id">
                <div class="contact-form__content">
                    <div class="contact-form-input">
                        <label for="pin">New Name</label>
                        <input type="text" name="name" id="rename_city_name">
                    </div>
                    <div class="contact-form-input">
                        <label for="pin">Enter Your Access Pin</label>
                        <input type="text" name="pin" id="rename_city_pin" value="" placeholder="Access pin">
                    </div>
                    <div class="contact-form-btn">
                        <button class="button button--md" type="submit" name="action" value="rename"> Rename </button>
                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                    </div>
                    
                </div>
            </form>
        </div>
        
        </div>
    </div>
</div>
<div class="modal fade" id="delete_city" tabindex="-1" aria-labelledby="delete_cityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="delete_cityModalLabel">Delete <span id="delete_city_name"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.settings.city.manage')}}" method="post"> @csrf 
                <input type="hidden" name="city_id" id="delete_city_id">
                <div class="contact-form__content">
                    
                    The selected city has 
                    <table class="table">
                        <tr>
                            <td><span id="delete_city_users"></span></td><td>Users</td>
                        </tr>
                        <tr>
                            <td><span id="delete_city_shops"></span></td><td>Shops</td>
                        </tr>
                        
                        <tr>
                            <td><span id="delete_city_addresses"></span></td><td>Address</td>
                        </tr>
                        <tr>
                            <td><span id="delete_city_locations"></span></td><td>Locations</td>
                        </tr>
                    </table>
                    <div id="delete_city_message">
                        <p>City cannot be deleted until all the dependant data are deleted</p> 
                    </div>
                    <div id="delete_city_button" style="display:none">
                        <div class="contact-form-input">
                            <label for="pin">Enter Your Access Pin</label>
                            <input type="text" name="pin" id="delete_city_pin" value="" placeholder="Access pin">
                        </div>
                        <div class="contact-form-btn">
                            <button class="button button--md" type="submit" name="action" value="delete"> Delete </button>
                            <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
        
        </div>
    </div>
</div>
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

    $('.rename_state').on('click',function(){
        
        $('#rename_state_id').val($(this).attr('data-id'))
        $('#rename_state_name').val($(this).attr('data-name'))
        $('#rename_state').modal('show');
    });

    $('.delete_state').on('click',function(){
        let total = 0;
        let shops = parseInt($(this).attr('data-shops'))
        let users = parseInt($(this).attr('data-users'))
        let rates = parseInt($(this).attr('data-rates'))
        let cities = parseInt($(this).attr('data-cities'))
        let addresses = parseInt($(this).attr('data-addresses'))
        let locations = parseInt($(this).attr('data-locations'))
        total = shops + users + rates + cities + addresses + locations;
        if(!total){
            $('#delete_state_message').hide()
            $('#delete_state_button').show()
        }
        $('#delete_state_id').val($(this).attr('data-id'))
        $('#delete_state_name').text($(this).attr('data-name'))
        $('#delete_state_shops').text(shops)
        $('#delete_state_users').text(users)
        $('#delete_state_rates').text(rates)
        $('#delete_state_cities').text(cities)
        $('#delete_state_addresses').text(addresses)
        $('#delete_state_locations').text(locations)
        $('#delete_state').modal('show');
    });

    $('.rename_city').on('click',function(){
        
        $('#rename_city_id').val($(this).attr('data-id'))
        $('#rename_city_name').val($(this).attr('data-name'))
        $('#rename_city').modal('show');
    });

    $('.delete_city').on('click',function(){
        let total = 0;
        let shops = parseInt($(this).attr('data-shops'))
        let users = parseInt($(this).attr('data-users'))
        let addresses = parseInt($(this).attr('data-addresses'))
        let locations = parseInt($(this).attr('data-locations'))
        total = shops + users + addresses + locations;
        if(!total){
            $('#delete_city_message').hide()
            $('#delete_city_button').show()
        }
        $('#delete_city_id').val($(this).attr('data-id'))
        $('#delete_city_name').text($(this).attr('data-name'))
        $('#delete_city_shops').text(shops)
        $('#delete_city_users').text(users)
        $('#delete_city_addresses').text(addresses)
        $('#delete_city_locations').text(locations)
        $('#delete_city').modal('show');
    });
    

    // $('.modal').on('show.bs.modal', function () {
    //     $(this).find('.select2').select2({
    //         dropdownParent: $(this).find('.modal-content')
    //     });
    //     // $('.select2').select2();
    //     console.log($(this).html())
    // });
</script>
@endpush
