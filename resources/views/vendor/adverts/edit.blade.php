@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/css/custom.css')}}"/>
@endpush
@section('title') Edit Adverts | Expiring Soon @endsection
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
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          
          <li class="active"><a href="#">Edit Adverts</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.vendor_navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          
            <div class="container">
              <div class="dashboard__content-card">
                <div class="dashboard__order-history-title border-bottom">
                    <h5 class="font-body--xl-500">Edit Advert </h5> 
                    <h2 class="font-body--xl-500">Adverts for {{$advert->adset->adplan->name}}</h2>
                    <span class="font-body--lg-600"> Adset No: {{$advert->adset->slug}}</span>
                </div>
                <div class="dashboard__content-card-body">
                    <div class="row shoping-cart__content justify-content-center">              
                        <div class="col-lg-8">
                          <form method="POST" action="{{route('vendor.advert.update')}}" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="advert_id" value="{{$advert->id}}">
                            <input type="hidden" name="adset_id" value="{{$advert->adset->id}}">
                            <div class="contact-form-input">
                              <label>Show in Location</label>
                              <select id="stateselect" name="state_id" class="select2" required>
                                @foreach ($states as $state)
                                  <option value="{{$state->id}}" @if($state->id == $advert->state_id) selected @endif>{{$state->name}}</option>  
                                @endforeach     
                              </select>
                            </div>
                            <div class="contact-form-file mb-3">
                              <label for="category" class="d-block">Display Image </label>
                              <img src="{{$advert->image}}" class="img-thumbnail" alt="">
                            </div>
                            <div class="contact-form-file mb-3">
                              <label for="category" class="d-block">Replace Image (optional)</label>
                              <input type="file" name="photo" placeholder="" />
                              <small class="d-block">{{$advert->adset->adplan->instruction}} </small>
                            </div>
                            <div class="contact-form-input">
                              <label for="category">Heading</label>
                              <input type="text" name="heading" value="{{$advert->heading}}" placeholder="" />
                            </div>
                            <div class="contact-form-input">
                              <label for="category">Subheading</label>
                              <input type="text" name="subheading" value="{{$advert->subheading}}"  placeholder="" />
                            </div>
                            
                            <div class="contact-form-input">
                              <label for="category">Offer Text</label>
                              <input type="text" name="offer" value="{{$advert->offer}}" placeholder="e.g Sales 50% off" maxlength="20"/>
                            </div>
                            <div class="contact-form-input">
                              <label for="category">Text Color (for heading & subheading & offer)</label>
                              <select type="text" name="text_color" class="form-control like_select2">
                                  <option value="black" @if($advert->text_color == "black") selected @endif>Black</option>
                                  <option value="white" @if($advert->text_color == "white") selected @endif>White</option>
                              </select>
                            </div>
                            <div class="contact-form__content-group justify-content-start mb-3">
                              <label class="font-body--md-500">Link to: </label>
                              <div class="form-check mx-3">
                                <label class="form-check-label font-body--400" for="type_shop"> 
                                    Shop
                                </label>
                                <input class="form-check-input linkto" type="radio" name="type" id="type_shop" value="shop" @if($advert->advertable_type == "App\Models\Shop") checked @endif>
                              </div>
                              <div class="form-check mx-3">
                                <label class="form-check-label font-body--400" for="type_product"> 
                                    Product
                                </label>
                                <input class="form-check-input linkto" type="radio" name="type" id="type_product" value="product" @if($advert->advertable_type == "App\Models\Product") checked @endif >
                              </div>
                            </div>
                            <div class="contact-form-input" id="show_shops">
                              <label>Select Shop</label>
                              <select id="shops" name="shop_id" class="select2">
                                @foreach ($shops as $shop)
                                  <option value="{{$shop->id}}" @if($advert->advertable_id == $shop->id) selected @endif>{{$shop->name}} </option>  
                                @endforeach 
                              </select>
                            </div>
                            <div class="contact-form-input" id="show_products" style="display:none;">
                              <label>Select Product</label>
                              <select id="products" name="product_id" class="select2">
                                  @foreach ($products as $product)
                                    <option value="{{$product->id}}" @if($advert->advertable_id == $product->id) selected @endif>{{$product->name}}</option>  
                                  @endforeach      
                              </select>
                            </div>
                            <div class="contact-form-input">
                              <label for="category">Button Text</label>
                              <select name="button_text" class="form-control like_select2">
                                <option value="Shop Now" @if($advert->button_text == "Shop Now") selected @endif>Shop Now</option>
                                <option value="Buy Now" @if($advert->button_text == "Buy Now") selected @endif>Buy Now</option>
                                <option value="Hurry Now" @if($advert->button_text == "Hurry Now") selected @endif>Hurry Now</option>
                            </select>
                            </div>
                            <div class="contact-form-input">
                              <label for="category">Button Color</label>
                              <select name="button_color" class="form-control like_select2">
                                  <option value="green" @if($advert->button_color == "green") selected @endif>Green</option>
                                  <option value="white" @if($advert->button_color == "white") selected @endif>White</option>
                              </select>
                            </div>
                            
                            <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                              Update Ad
                            </button>
                            
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


@endsection
@push('scripts')

<script>
  var limit = @json($advert->adset->units);
  var used = @json($advert->adset->adverts->count());
  $('.linkto').on('change',function(){
      if($(this).val() == 'product'){
        $('#show_shops').hide();
        $('#show_products').fadeIn();
      }else{
        $('#show_products').hide();
        $('#show_shops').fadeIn();
        
      }
  })
</script>
@endpush