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
                              Manage Rates
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-countries-tab" data-bs-toggle="pill" data-bs-target="#pills-countries" type="button" role="tab" aria-controls="pills-countries" aria-selected="false">
                              Add New
                          </button>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="products-tab__content">
                <div class="tab-content" id="pills-tabContent">
                    <!-- General  -->
                    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                        <div class="products-tab__description">
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                <h5 class="font-body--xl-500">Manage Shipping Rates</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <div class="table-responsive">
                                        <table class="table display" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">Country</th>
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
                                                        <td>{{$rate->country->name}}</td>
                                                        <td>{{$rate->origin->name}}</td>
                                                        <td>{{$rate->destination->name}}</td>
                                                        <td>{{$rate->hours}}</td>
                                                        <td>{!! $rate->country->currency->symbol !!}{{$rate->amount}}</td>
                                                        <td> 
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#rateedit{{$rate->id}}">Edit </a> | 
                                                            <form class="d-inline" action="{{route('admin.shipments.delete')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
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
                                                                    <form action="{{route('admin.shipments.update')}}" method="post" id="rateedit{{$rate->id}}">
                                                                        @csrf 
                                                                        <input type="hidden" name="rate_id" value="{{$rate->id}}">
                                                                        <div class="contact-form__content my-3 location">
                                                                            <div class="contact-form-input">
                                                                                <label for="countrisdes">Country </label>
                                                                                <select id="countrisdes{{$rate->id}}" name="country_id" class="select2 country" >
                                                                                    @foreach ($countries as $country)
                                                                                        <option value="{{$country->id}}" @if($rate->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="contact-form__content-group">
                                                                                <div class="contact-form-input">
                                                                                    <label for="origin">Origin </label>
                                                                                    <select id="countryz{{$rate->id}}" name="origin_id" class="select2 states" >
                                                                                        @foreach ($states as $state)
                                                                                            <option value="{{$state->id}}" @if($rate->origin_id == $state->id) selected @endif>{{$state->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="contact-form-input">
                                                                                    <label for="destination">Destination </label>
                                                                                    <select id="destination_edit{{$rate->id}}" name="destination_id" class="select2 states" >
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
                    
                    <div class="tab-pane fade" id="pills-countries" role="tabpanel" aria-labelledby="pills-countries-tab">
                        <div class="row products-tab__feedback"> 
                            <!-- Manage Countries  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Add Destination</h5>
                                </div>
                                <div class="dashboard__content-card-body">
                                    <form method="post" id="editcategory" action="{{route('admin.shipments.store')}}">@csrf
                                        <div class="contact-form__content location">
                                            <div class="contact-form__content-group">
                                                @if(auth()->user()->role->name == 'superadmin')
                                                    <div class="contact-form-input">
                                                        <label for="origin">Country </label>
                                                        <select id="countriez" name="country_id" class="select2 country">
                                                            @foreach ($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="country_id" value="{{auth()->user()->country_id}}">
                                                @endif
                                                <div class="contact-form-input">
                                                    <label for="shipper">Shipper Name</label>
                                                    <input type="text" name="shipper_name" placeholder="Logistic Company Name" />
                                                </div>
                                            </div>
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="shipper">Shipper Email</label>
                                                    <input type="text" name="shipper_email" placeholder="Logistic Company Email" />
                                                </div>
                                                <div class="contact-form-input">
                                                    <label for="shipper">Shipper Phone</label>
                                                    <input type="text" name="shipper_phonw" placeholder="Logistic Company Phone" />
                                                </div>
                                            </div>
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="origin">Origin </label>
                                                    <select id="state" name="origin_id" class="select2 states">
                                                        @foreach ($states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="contact-form-input">
                                                    <label for="postal">Destination </label>
                                                    <select id="postals" name="destination_id" class="select2 states">
                                                        @foreach ($states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="hours">Hours</label>
                                                    <input type="number" name="hours" max="{{cache('settings')['order_processing_to_delivery_period']}}" placeholder="hours" />
                                                </div>
        
                                                <div class="contact-form-input">
                                                    <label for="amounts">Amount</label>
                                                    <input type="number" name="amount" placeholder="Delivery cost" />
                                                </div>
                                            </div>
        
                                            <div class="contact-form-btn">
                                                <button class="button button--md askpin" type="button">
                                                + Add Shipping Rate
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
