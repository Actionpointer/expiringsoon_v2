@extends('layouts.app')

@push('styles')

@endpush
@section('title') Shop Shipment | Expiring Soon @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
          <li class="active"><a href="#">Shipment</a></li>
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
            
          <div class="row products-tab__feedback">

<div class="dashboard__content-card">
      <div class="dashboard__content-card-header">
      <h5 class="font-body--xl-500">Package Rate</h5>
      </div>
      <div class="dashboard__content-card-body">
      <form method="post" id="editcategory" action="{{route('vendor.shop.shipping.package',$shop)}}" >@csrf
          <div class="contact-form__content">
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
          
            <div class="contact-form__content-group">
                <div class="contact-form-input">
                    <label for="hours">Dimension Rate per cm<sup>2</sup></label>
                    <input type="number" name="dimension_rate" value="{{$shop->dimension_rate}}" placeholder="" />
                </div>
          
                <div class="contact-form-input">
                    <label for="amounts">Weight Rate per kg</label>
                    <input type="number" name="weight_rate" value="{{$shop->weight_rate}}" placeholder="" />
                </div>
            </div>
          
          
              <div class="contact-form-btn">
                  <button class="button button--md " type="submit">
                      Update Package Rate
                  </button>
              </div>
          
          </div>
      </form>
      </div>
  </div>
  
  <div class="dashboard__content-card">
      <div class="dashboard__content-card-header d-flex justify-content-between">
          <h5 class="font-body--xl-500">Manage Shipping Rates</h5>
          <button class="button button--sm mx-0" type="button" data-bs-toggle="modal" data-bs-target="#ratenew" >
              + Add Shipping Rate
          </button>
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
              @forelse ($rates as $rate)
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
                                            <select id="destination{{$rate->id}}" name="destination_id" class="form-control-lg select2 w-100" >
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
              @empty
                <tr>
                  <td colspan="5" class="text-center">No distance rate</td>
                </tr>
              @endforelse
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
  
  <div class="modal fade" id="ratenew" tabindex="-1" aria-labelledby="ratenew" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ratenewModalLabel">New Shipping Rate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                <div class="contact-form__content-group">
                    <div class="contact-form-input">
                        <label for="hours">Hours</label>
                        <input type="number" name="hours" max="{{cache('settings')['order_processing_to_delivery_period']}}" placeholder="hours" />
                    </div>
        
                    <div class="contact-form-input">
                        <label for="amounts">Amount</label>
                        <input type="number" name="amount" placeholder="delivery cost" />
                        
                    </div>
                    
                </div>
                <small class="small text-muted"><i>Please note that we charge {{$shop->user->subscription->plan->shipment_percentage}}% + {!! $shop->country->currency->symbol !!}{{$shop->user->subscription->plan->shipment_fixed}} on your delivery cost as transfer processing fee</i></small>
                
                <div class="contact-form-btn">
                    <button class="button button--md " type="submit">
                    + Add Shipping Rate
                    </button>
                </div>
                
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>
  
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
              $('#'+output+'_preview').attr('src', "{{asset('images/site/icon-pdf.jpg')}}" );
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
