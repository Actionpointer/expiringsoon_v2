@extends('layouts.app')
@push('styles')
<style>
  
</style>

@endpush
@section('title') Feature Products | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#"> Vendor <span> > </span> </a>
          </li>
          <li>
            <a href="{{route('vendor.adsets')}}"> Adsets <span> > </span> </a>
          </li>
          <li class="active"><a href="#">Products</a></li>
        </ul>
      </div>
    </div>
  </div>
    <!-- breedcrumb section end   -->
    @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('vendor.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            
            <section class="shoping-cart section section--xl pt-0">
              <div class="row shoping-cart__content justify-content-center">              
                <div class="col-lg-8">
                  <form method="POST" action="{{route('vendor.feature.products.subscription')}}">@csrf
                      <input type="hidden" name="adplan_id" value="{{$adplan->id}}">
                      
                      
                    <div class="contact-form-input">
                        <label>Select Products</label>
                        <select id="product" name="products[]" class="select2" multiple required>
                            @foreach ($allproducts as $product)
                              <option value="{{$product->id}}" @if(in_array($product->id,$products->pluck('id')->toArray())) selected @endif>{{$product->name}}</option>  
                            @endforeach      
                        </select>
                    </div>
                  
                    <div class="contact-form-input">
                      <label>Show in Location</label>
                      <select id="stateselect" name="state_id" class="select2" required>
                          @foreach ($states as $state)
                            <option value="{{$state->id}}" @if($state->id == $state_id) selected @endif>{{$state->name}}</option>  
                          @endforeach     
                      </select>
                    </div>

                    <div class="contact-form-input">
                      <label>Duration (days)</label>
                      <input type="number" name="days" placeholder="days" id="days" min="{{cache('settings')['minimum_advert_days']}}" value="{{cache('settings')['minimum_advert_days']}}"/>
                    </div>
                    <div class="bill-card">
                      <div class="bill-card__content">
                        <div class="bill-card__header">
                          <h2 class="bill-card__header-title font-body--xxl-500">
                            Order Summery
                          </h2>
                        </div>
                        <div class="bill-card__body">
                          <!-- memo  -->
                          <div class="bill-card__memo">
                            <!-- Shipping  -->
                            <div class="bill-card__memo-item shipping">
                              <p class="font-body--md-400">No of Units:</p>
                              <span class="font-body--md-500" id="adset">{{$products->count()}}</span>
                            </div>
                            <!-- Subtotal  -->
                            
                            
                            <!-- total  -->
                            <div class="bill-card__memo-item total">
                              <p class="font-body--lg-400">SubTotal:</p>
                              <span class="font-body--xl-500">{!!cache('settings')['currency_symbol']!!}
                                <span id="subtotal">{{$products->count() * $adplan->price_per_day * cache('settings')['minimum_advert_days']}}</span> </span>
                            </div>
                            <div class="form-check py-2">
                              <label class="form-check-label" for="autorenew" > Auto-renew</label>
                              <input class="form-check-input checkboxes" type="checkbox" name="auto_renew" value="1" checked>
                            </div>
                          </div>
                            <input type="hidden" id="amount" name="amount" value="{{$products->count() * $adplan->price_per_day * cache('settings')['minimum_advert_days']}}">
                            <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                              Place Order
                            </button>
                          
                        </div>
                      </div>
                    </div>
                    
                  </form>
                </div>
              </div>
            </section> 
            <!-- Set VAT -->
          </div>
            
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script>
    $(document).on('input change','#days',function(){
      let min = parseInt($(this).attr('min'));
      let days = parseInt($(this).val());
      if(days < min){
        $days = min;
        $(this).val(min);
      }
      let price = @json($adplan->price_per_day);
      let products = $('#product').find(':selected').length;
      $('#adset').text(products)
      $('#subtotal').text(parseInt(price) * days * parseInt(products))
      $('#amount').val(parseInt(price) * days * parseInt(products))
    })
    $(document).on('change','#product',function(){
      let min = parseInt($('#days').attr('min'));
      let days = parseInt($('#days').val());
      let products = $(this).find(':selected').length;
      let price = @json($adplan->price_per_day);
      $('#adset').text(products)
      $('#subtotal').text(parseInt(price) * days * parseInt(products))
      $('#amount').val(parseInt(price) * days * parseInt(products))
    })
    
</script>
@endpush
