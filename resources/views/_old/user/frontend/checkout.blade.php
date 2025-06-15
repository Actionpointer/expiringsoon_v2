@extends('layouts.app')

@push('styles')

@endpush
@section('title')Checkout | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('cart')}}">
              Shopping Cart
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Checkout</a></li>
        </ul>
      </div>
    </div>
</div>
@include('layouts.session')
<section class="section billing section--xl pt-0">
    <div class="container">
      <form id="set_address_form" action="{{route('address.store')}}" method="POST" style="display: none">@csrf</form>
      <form action="{{route('confirmcheckout')}}" method="POST">@csrf
        <div class="row billing__content">
          <div class="col-lg-8">
            <div class="billing__content-card">
              <div class="billing__content-card-header">
                <h2 class="font-body--xxxl-500">Delivery Options</h2>
              </div>
              <div class="billing__content-card-body border-bottom-0">
                <div class="table-responsive">
                    <table class="table">
                      @foreach ($carts->unique('shop_id') as $item)
                        <tr>
                            <th>
                              {{$item->shop->name}} <br> <small class="text-muted font-body--sm-400">{{($item->shop->city ? $item->shop->city->name.', ' : '').$item->shop->state->name}}</small>
                            </th>
                            <th>
                                <div class="bill-card__payment-method-item ">
                                  <div class="form-check">
                                      @if($user->addresses->isNotEmpty() && $rates->where('shop_id',$item->shop_id)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first())
                                          
                                          <input class="form-check-input shopdelivery" type="radio" name="deliveries[{{$item->shop_id}}]" id="shopdelivery{{$item->shop_id}}" value="{{$rates->where('shop_id',$item->shop_id)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()->amount + $item->delivery_cost}}" data-state="checked" checked>
                                          <label class="form-check-label font-body--400" for="cash">
                                            {!!$user->country->currency->symbol!!}
                                            <span id="deliveryamount{{$item->shop_id}}">
                                              {{$rates->where('shop_id',$item->shop_id)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()->amount  + $item->delivery_cost}}
                                            </span> 
                                            <span id="deliverytext{{$item->shop_id}}">for delivery latest by</span> 
                                            <span id="deliverytime{{$item->shop_id}}"> {{now()->addHours($rates->where('shop_id',$item->shop_id)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()->hours)->format('l jS \of\ F')}}</span>
                                          </label>
                                      @elseif($user->addresses->isNotEmpty() && $rates->where('shop_id',null)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first())
                                          <input class="form-check-input shopdelivery" type="radio" name="deliveries[{{$item->shop_id}}]" id="shopdelivery{{$item->shop_id}}" value="{{$rates->where('shop_id',null)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()->amount  + $item->delivery_cost}}" data-state="checked" checked>
                                          <label class="form-check-label font-body--400" for="cash">
                                            {!!$user->country->currency->symbol!!}
                                            <span id="deliveryamount{{$item->shop_id}}">
                                              {{$rates->where('shop_id',null)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()->amount  + $item->delivery_cost}}
                                            </span> 
                                            <span id="deliverytext{{$item->shop_id}}"> for delivery latest by </span> 
                                            <span id="deliverytime{{$item->shop_id}}">
                                              {{now()->addHours($rates->where('shop_id',null)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()->hours)->format('l jS \of\ F')}}
                                            </span>
                                          </label>
                                      @else
                                        <input class="form-check-input shopdelivery" type="radio" name="deliveries[{{$item->shop_id}}]" id="shopdelivery{{$item->shop_id}}" value='0' data-state="unchecked" disabled>
                                        <label class="form-check-label font-body--400" for="cash">
                                          <span id="deliveryamount{{$item->shop_id}}"></span>
                                          <span id="deliverytext{{$item->shop_id}}"> Delivery is not available</span>
                                          <span id="deliverytime{{$item->shop_id}}"></span>
                                        </label>
                                      @endif   
                                  </div>
                                </div>
                            </th>
                            <th>
                                <div class="bill-card__payment-method-item ">
                                  <div class="form-check">
                                    <input class="form-check-input shopdelivery" type="radio" name="deliveries[{{$item->shop->id}}]" value="0" id="nodelivery{{$item->shop_id}}" 
                                    @if($user->addresses->isEmpty() || (!$rates->where('shop_id',null)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first() && !$rates->where('shop_id',$item->shop_id)->where('destination_id',$user->addresses->firstWhere('main',true)->state_id)->first()) ) checked data-state="checked" @else data-state="unchecked" @endif>
                                    <label class="form-check-label font-body--400" for="cash">
                                        Pick up
                                    </label>
                                  </div>
                                </div>
                            </th>
                        </tr>
                      @endforeach                        
                    </table>
                </div>
              </div>
            </div>
            <div class="billing__content-card">
              <div class="billing__content-card-header">
                <h2 class="font-body--xxxl-500 mb-0">Delivery Address</h2>
                <small class="text-muted font-body--sm-400">Please note that only orders wherein the buyer's delivery address and the sellers location are in the same state are eligible for refund! </small>
              </div>
              <div class="billing__content-card-body">  
                @if($user->addresses->isNotEmpty())
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="delivery_address" id="existingaddress" value="existing" checked >
                    <label class="form-check-label font-body--400" for="existing"> Existing Address</label>
                  </div> 
                  <div class="contact px-5">
                      @foreach ($user->addresses as $address)
                        <div class="form-check d-flex">
                          <input class="form-check-input previous_addresses px-2" type="radio" name="address_id" data-main="{{$address->main}}" value="{{$address->id}}" id="address{{$address->id}}" @if($address->main) checked @endif >
                          <label class="form-check-label font-body--400" for="existing"> 
                              {{$address->contact_name.'('.$address->contact_phone.'): '.$address->street.', '.($address->city? $address->city->name:'').', '.$address->state->name}}
                          </label>
                        </div>
                      @endforeach
                  </div>
                @endif
                <div class="form-check my-3">
                  <input class="form-check-input" type="radio" name="delivery_address" id="newaddress" value="new" @if($user->addresses->isEmpty()) checked @endif>
                  <label class="form-check-label font-body--400" for="existing"> Add New Address</label>
                </div>

                <div class="contact-form__content" id="new_address_form" @if($user->addresses->isNotEmpty()) style="display: none;" @endif>            
                    <div class="contact-form-input">
                        <label for="address">Street Address </label>
                        <input type="text" name="street" id="street" placeholder="Your Address" >
                    </div>
                    <div class="contact-form__content-group row location">
                        <div class="col-md-4">
                          <div class="contact-form-input">
                              <label for="states">states </label>
                              <select id="statess" name="state_id" class="select2">
                                  @foreach ($user->country->states as $state)
                                    <option value="{{$state->id}}" @if($state->id == $user->state_id) selected @endif>{{$state->name}}</option> 
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <!-- zip -->
                        <div class="col-md-4">
                            <div class="contact-form-input">
                              <label for="zip">City</label>
                              <select id="zips" name="city_id" class="select2 cities">
                                  @foreach ($user->country->cities as $city)
                                    <option data-state="{{$city->state_id}}" value="{{$city->id}}">{{$city->name}}</option> 
                                  @endforeach
                              </select>
                    
                            </div>
                        </div>
                        <!-- postal -->
                        <div class="col-md-4">
                          <div class="contact-form-input">
                            <label for="postal_code">Postal Code</label>
                            <input id="postals" name="postal_id" id="postal_code" placeholder="Postal Code">
                          </div>
                        </div>
                    </div>
                    <div class="contact-form__content-group">
                      <div class="contact-form-input">
                        <label for="contact_name"> Contact Name </label>
                        <input type="text" name="contact_name" id="contact_name" placeholder="Contact Name">
                      </div>
                      <div class="contact-form-input">
                        <label for="contact_phone"> Contact Phone </label>
                        <div class="input-group  d-flex">
                          <button class="btn btn-outline-secondary" type="button">+{{$user->country->dial}}</button>
                          <input type="number" name="contact_phone" class="form-control" value="{{old('contact_phone')}}" placeholder="Contact Phone Number" />
                        </div>
                      </div>
                    </div>
                    <div class="contact-form-input">
                        <button type="button" class="btn btn-success" id="save_address">Save </button>
                    </div>
                </div>
                    
              </div>
            </div>

            
          </div>

          <div class="col-lg-4">
            <div class="bill-card">
              <div class="bill-card__content">
                <div class="bill-card__header">
                  <h2 class="bill-card__header-title font-body--xxl-500">
                    Order Summary
                  </h2>
                </div>
                <div class="bill-card__body">
                  <!-- Product Info -->
                  <div class="bill-card__product">
                    
                    @foreach ($carts as $item)
                        <input type="hidden" name="carts[]" value="{{$item->id}}">
                    @endforeach
                  </div>
                  <!-- memo  -->
                  <div class="bill-card__memo">
                    <!-- Items  -->
                    <div class="bill-card__memo-item items">
                      <p class="font-body--md-400"># of items:</p>
                      <span class="font-body--md-500"> {{$carts->count()}}  </span>
                    </div>
                    <!-- Items  -->
                    <div class="bill-card__memo-item shops">
                      <p class="font-body--md-400"># of shops:</p>
                      <span class="font-body--md-500">  {{$carts->unique('shop_id')->count()}} </span>
                    </div>
                    <!-- Amount  -->
                    <div class="bill-card__memo-item subtotal">
                      <p class="font-body--md-400">Order Amount:</p>
                      <span class="font-body--md-500">
                        {!!$user->country->currency->symbol!!} 
                        <span id="subtotal" data-value="{{$order['subtotal']}}">{{number_format($order['subtotal'], 2)}}</span>
                      </span>
                    </div>
                    <!-- Shipping  -->
                    <div class="bill-card__memo-item shipping">
                      <p class="font-body--md-400">Shipping:</p>
                      <span class="font-body--md-500">
                        {!!$user->country->currency->symbol!!}
                        <span id="shipping_cost" data-value="{{$order['shipping']}}">{{number_format($order['shipping'],2)}}</span>
                      </span>
                    </div>
                    
                    
                    <!-- VAT  -->
                    <div class="bill-card__memo-item vat">
                      <p class="font-body--md-400">VAT ({{$order['vat_percent']}}%):</p>
                      <span class="font-body--md-500">
                        {!!$user->country->currency->symbol!!}
                        <span id="vat_cost" data-value="{{$order['vat_percent']}}">{{number_format($order['vat'],2)}}</span>
                      </span>
                    </div>
                    <div class="bill-card__memo-item">
                      <p class="font-body--lg-400">Discount:</p>
                      <span class="font-body--xl-500">-{!!$user->country->currency->symbol!!}
                      <span id="discount_text" class="ms-0">0</span> 
                      </span>
                    </div>
                    <!-- total  -->
                    <div class="bill-card__memo-item total">
                      <p class="font-body--lg-400">Total:</p>
                      <span class="font-body--xl-500">
                        {!!$user->country->currency->symbol!!}
                        <span id="grandtotal" data-value="{{$order['grandtotal']}}">{{number_format($order['grandtotal'],2)}}</span>
                      </span>
                    </div>
                    <input type="hidden" name="amount" id="amount" value="{{$order['subtotal']}}">
                    <div class="mt-3">
                        <div class="newsletter-card__input w-100">
                            <input type="text" name="coupon" id="coupon_code" placeholder="Enter Coupon Code">
                            <button class="button button--lg" type="button" id="coupon_button"> Apply Coupon </button>
                        </div>
                        <small id="coupon_description" class="d-block text-info text-center"></small>
                    </div>
                    <input type="hidden" name="discount" id="discount" value="0">
                    <input type="hidden" name="coupon_used" id="coupon_used">
                  </div>
                </div>
              </div>
              <div class="bill-card__content">             
                <div class="bill-card__body">
                    <button class="button button--lg w-100" type="submit">
                      Pay Now
                    </button>                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection
@push('scripts')
@include('layouts.front')
<script>
    $(document).on('select2:select','#statess',function(){
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
    $('input[type=radio][name=delivery_address]').change(function(){
        if(this.value == 'new'){
          $('#new_address_form').show();
          $('.previous_addresses').prop('checked',false)
          $('#new_address_form input,#new_address_form select').each(function(){
              $(this).attr('required',true)
          })
        }
        else {
          $('#new_address_form input,#new_address_form select').each(function(){
              $(this).removeAttr('required')
          })
          $('#new_address_form').hide();
          $('.previous_addresses[data-main=1]').prop('checked',true)
        }
    })
    $('.previous_addresses').change(function(){
        $('#new_address_form').hide();
        $('#new_address_form input,#new_address_form select').each(function(){
              $(this).removeAttr('required')
          })
        $('#existingaddress').prop('checked',true);
        //make ajax call to get shipping cost & time
        $.ajax({
          type:'POST',
          dataType: 'json',
          url: "{{route('checkout.shipment')}}",
          data:{
              '_token' : $('meta[name="csrf-token"]').attr('content'),
              'carts': @JSON($carts),
              'address_id': $(this).val(),
          },
          success:function(data) {
              //console.log(data);
              $('#shipping_cost').text(data.total);
              $('#shipping_cost').attr('data-value',data.total);
              $.each( data.shipments, function( key, value ) {
                
                  if(value.amount){
                    $('#shopdelivery'+value.shop_id).attr('disabled',false);
                    $('#shopdelivery'+value.shop_id).prop('checked',true);
                    $('#shopdelivery'+value.shop_id).val(value.amount);
                    $('#deliveryamount'+value.shop_id).text(value.amount);
                    $('#deliverytext'+value.shop_id).text(' for delivery latest by ');
                    $('#deliverytime'+value.shop_id).text(value.time);
                  }else{
                    $('#shopdelivery'+value.shop_id).attr('disabled',true);
                    $('#shopdelivery'+value.shop_id).prop('checked',false);
                    $('#shopdelivery'+value.shop_id).val(value.amount);
                    $('#nodelivery'+value.shop_id).prop('checked',true);
                    $('#deliverytext'+value.shop_id).text(' Delivery is not available ');
                    $('#deliverytime'+value.shop_id).text('');
                  }
              });
              recalculateGrandTotal()
          },
          error: function (data, textStatus, errorThrown) {
            console.log(data);
          },
        });
    
    })

        //replace shipping cost & time on delivery options for each shop
    $('.shopdelivery').change(function(){
        
        if($(this).val() != 0 && $(this).attr('data-state')=='unchecked'){
          str = $(this).attr('id');
          shop = str.replace('shopdelivery','');
          $('#nodelivery'+shop).attr('data-state','unchecked')
          $(this).attr('data-state','checked')
          recalculateShipping('add',$(this).val())//add this value to the grandtotal shipping
        }
        if($(this).val() == 0){
          str = $(this).attr('id')
          shop = str.replace('nodelivery','');
          $('#shopdelivery'+shop).attr('data-state','unchecked')
          $(this).attr('data-state','checked')
          //remove this other value from the grandtotal shipping
          recalculateShipping('minus',$('#shopdelivery'+shop).val())
        }   
    })

    function recalculateShipping(operation,amount){
      //get shipping now
      shipping_cost = parseInt($('#shipping_cost').attr('data-value'));
      if(operation == 'add'){
        shipping_cost += parseInt(amount);
      }else{
        shipping_cost -= parseInt(amount)
      }
      // console.log(shipping_cost)
      $('#shipping_cost').text(shipping_cost);
      $('#shipping_cost').attr('data-value',shipping_cost);
      recalculateGrandTotal()
    }
    function recalculateGrandTotal(){
      shipping_cost = parseInt($('#shipping_cost').attr('data-value'));
      subtotal = parseInt($('#subtotal').attr('data-value'));
      total = subtotal + shipping_cost;
      vat_percent = parseFloat($('#vat_cost').attr('data-value'));
      vat = vat_percent * total / 100;
      grandtotal =  total + vat;
      $('#vat_cost').text(vat);
      $('#grandtotal').text(grandtotal);
    }

    $('#save_address').click(function(){
        street = $('input[name=street]').val();
        state_id = $('select[name=state_id]').val();
        city_id = $('select[name=city_id]').val();
        contact_name = $('input[name=contact_name]').val();
        contact_phone = $('input[name=contact_phone]').val();
        _token = $('meta[name=csrf-token]').attr('content');
        elements = {'street':street,'state_id':state_id,'city_id':city_id,'contact_name':contact_name,'contact_phone':contact_phone,'_token':_token};
        if(street && state_id && contact_name && contact_phone){
          var myform = $('#set_address_form');
          $.each(elements, function(key,value){
              var input = $("<input>").attr("type", "hidden").attr("name", key).val(value);
              $(myform).append($(input));
          });
          $(myform).submit();
        }
        
    })

    $('#coupon_button').on('click',function(){
      let code = $('#coupon_code').val()
      let amount = $('#amount').val()
      if(code != ''){
          $.ajax({
              type:'POST',
              dataType: 'json',
              url: "{{route('applycoupon')}}",
              data:{
                  '_token' : $('meta[name="csrf-token"]').attr('content'),
                  'code': code,
                  'amount': amount,
              },
              success:function(data) {
                  console.log(data)
                  if(data.value != 0){
                      $('#discount').val(data.value);
                      $('#grandtotal').text(parseInt($('#grandtotal').attr('data-value')) - parseInt(data.value))
                      $('#discount_text').html(data.value);
                      $('#coupon_used').val(code);
                      // recalculateGrandTotal();
                  }
                  $('#coupon_description').html(data.description);
              },
              error: function (data, textStatus, errorThrown) {
                  console.log(data);
              },
          })
      }  
    })
    
</script>
@endpush
