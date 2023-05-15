@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/css/custom.css')}}"/>
@endpush
@section('title') Adverts | Expiring Soon @endsection
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
          
          <li class="active"><a href="#">Shop Adverts</a></li>
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
              <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Adverts for {{$adset->adplan->name}}</h2>
                    <span class="font-body--lg-600"> Adset No: {{$adset->slug}}</span>
                </div>
                <div class="products-tab__btn">
                  <div class="container">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-live-tab" data-bs-toggle="pill" data-bs-target="#pills-live" type="button" role="tab" aria-controls="pills-live" aria-selected="true">
                                Live
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-approval-tab" data-bs-toggle="pill" data-bs-target="#pills-approval" type="button" role="tab" aria-controls="pills-approval" aria-selected="false">
                                Pending Approval
                            </button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-inactive-tab" data-bs-toggle="pill" data-bs-target="#pills-inactive" type="button" role="tab" aria-controls="pills-inactive" aria-selected="false">
                              Inactive
                              </button>
                          </li>
                          @if($adset->units > $adset->adverts->count()) 
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-draft-tab" data-bs-toggle="pill" data-bs-target="#pills-draft" type="button" role="tab" aria-controls="pills-draft" aria-selected="false">
                                Add Advert
                              </button>
                          </li>
                          @endif
                          
                          
                          
                      </ul>
                  </div>
                </div>
                <div class="products-tab__content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-live" role="tabpanel" aria-labelledby="pills-live-tab">
                            <div class="dashboard__order-history-table">
                              <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="dashboard__order-history-table-title"> Ad </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Location </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Views</th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Clicks</th>
                                        <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                    </thead>
                                    <tbody>                     
                                        @foreach($adset->adverts->where('running',true)->where('status',true) as $advert)        
                                            <tr class="border-top">
                                                <td class="cart-table-item align-middle" >
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check pt-2 d-inline-block">
                                                              <label class="form-check-label font-body--400" for="existing"> </label>
                                                              <input class="form-check-input checkboxes" type="checkbox" name="advert_id[]" value="{{$advert->id}}" >
                                                            </div>
                                                            <a href="{{$advert->url}}" class="cart-table__product-item">
                                                              <div class="cart-table__product-item-img">
                                                                <img src="{{$advert->image}}" alt="{{$advert->heading}}" />
                                                              </div>
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="d-flex flex-column justify-content-center">
                                                          <a href="{{$advert->url}}" class="cart-table__product-item">
                                                            <h5 class="font-body--lg-400" style="font-size:14px"> {{$advert->heading}} </h5>
                                                          </a>
                                                          <span>{{$advert->offer}}</span> 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <!-- Date  -->
                                                <td class="cart-table-item align-middle"> {{ $advert->state->name}}</td>
                                                <td class="cart-table-item align-middle"> {{ $advert->views}}</td>
                                                <!-- Total  -->
                                                <td class="cart-table-item align-middle ">  {{ $advert->clicks}} </td>
          
                                                
                                                <td class="cart-table-item align-middle">
                                                    <div class="button-group">
                                                        <a href="{{route('adpreview',[$advert->adset,$advert])}}" class="btn btn-sm btn-outline-primary">Preview</a>
                                                        <form action="{{route('vendor.advert.remove')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this advert?');" class="d-inline">@csrf
                                                          <input type="hidden" name="adverts[]" value="{{$advert->id}}">
                                                          <button class="btn btn-sm btn-danger" type="submit">
                                                              Remove
                                                          </button>
                                                        </form>
                                                        
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-approval" role="tabpanel" aria-labelledby="pills-approval-tab">
                          <div class="dashboard__order-history-table">
                            <div class="table-responsive">
                              <table class="table datatable">
                                <thead>
                                <tr>
                                    <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                                    <th scope="col" class="dashboard__order-history-table-title"> Location </th>
                                    <th scope="col" class="dashboard__order-history-table-title"> Views</th>
                                    <th scope="col" class="dashboard__order-history-table-title"> Clicks</th>
                                    <th scope="col" class="dashboard__order-history-table-title"></th>
                                </tr>
                                </thead>
                                <tbody>                     
                                    @foreach($adset->adverts->where('approved',false) as $advert)        
                                        <tr class="border-top">
                                            <td class="cart-table-item align-middle" >
                                              <div class="d-flex flex-column flex-md-row">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check pt-2 d-inline-block">
                                                      <label class="form-check-label font-body--400" for="existing"> </label>
                                                      <input class="form-check-input checkboxes" type="checkbox" name="advert_id[]" value="{{$advert->id}}" >
                                                    </div>
                                                    <a href="{{$advert->url}}" class="cart-table__product-item">
                                                      <div class="cart-table__product-item-img">
                                                        <img src="{{$advert->image}}" alt="{{$advert->heading}}" />
                                                      </div>
                                                    </a>
                                                </div>
                                                
                                                <div class="d-flex flex-column justify-content-center">
                                                  <a href="{{$advert->url}}" class="cart-table__product-item">
                                                    <h5 class="font-body--lg-400" style="font-size:14px"> {{$advert->heading}} </h5>
                                                  </a>
                                                  <span>{{$advert->offer}}</span> 
                                                </div>
                                              </div>
                                            </td>
                                            <td class="cart-table-item align-middle"> {{ $advert->state->name}}</td>
                                            <!-- Date  -->
                                            <td class="cart-table-item align-middle"> {{ $advert->views}}</td>
                                            <!-- Total  -->
                                            <td class="cart-table-item align-middle ">  {{ $advert->clicks}} </td>
                                            
                                            <td class="cart-table-item align-middle">
                                              <div class="button-group">
                                                <a href="{{route('adpreview',[$advert->adset,$advert])}}" class="btn btn-sm btn-outline-primary">Preview</a>
                                                <form action="{{route('vendor.advert.remove')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this advert?');" class="d-inline">@csrf
                                                  <input type="hidden" name="adverts[]" value="{{$advert->id}}">
                                                  <button class="btn btn-sm btn-danger" type="submit">
                                                      Remove
                                                  </button>
                                                </form>
                                                
                                                
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                        
                        
                        <div class="tab-pane fade" id="pills-inactive" role="tabpanel" aria-labelledby="pills-inactive-tab">
                          <div class="dashboard__order-history-table">
                            <div class="table-responsive">
                              <table class="table datatable">
                                  <thead>
                                  <tr>
                                      <th scope="col" class="dashboard__order-history-table-title"> Shop </th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Location </th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                                      <th scope="col" class="dashboard__order-history-table-title"></th>
                                  </tr>
                                  </thead>
                                  <tbody>                     
                                      @foreach($adset->adverts->where('running',true)->where('approved',true)->where('status',false) as $advert)        
                                          <tr class="border-top">
                                              <td class="cart-table-item align-middle" >
                                                <div class="d-flex flex-column flex-md-row">
                                                  <div class="d-flex align-items-center">
                                                      <div class="form-check pt-2 d-inline-block">
                                                        <label class="form-check-label font-body--400" for="existing"> </label>
                                                        <input class="form-check-input checkboxes" type="checkbox" name="advert_id[]" value="{{$advert->id}}" >
                                                      </div>
                                                      <a href="{{$advert->url}}" class="cart-table__product-item">
                                                        <div class="cart-table__product-item-img">
                                                          <img src="{{$advert->image}}" alt="{{$advert->heading}}" />
                                                        </div>
                                                      </a>
                                                  </div>
                                                  
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <a href="{{$advert->url}}" class="cart-table__product-item">
                                                      <h5 class="font-body--lg-400" style="font-size:14px"> {{$advert->heading}} </h5>
                                                    </a>
                                                    <span>{{$advert->offer}}</span> 
                                                  </div>
                                                </div>
                                              </td>
                                              
                                              <td class="cart-table-item align-middle"> {{ $advert->state->name}}, {{ $advert->state->country->name}}</td>

                                              <td class="cart-table-item align-middle"> 
                                                  @if(!$advert->status)
                                                  <span class="d-block text-success">Product is not showing </span>
                                                  @elseif(!$advert->adset->active)
                                                  <span class="d-block text-danger">Adset is expired</span>
                                                  @endif  
                                              </td>
                                              <!-- Status -->
                                              
                                              <td class="cart-table-item align-middle">
                                                <div class="button-group">
                                                  <a href="{{route('adpreview',[$advert->adset,$advert])}}" class="btn btn-sm btn-outline-primary">Preview</a>
                                                  <form action="{{route('vendor.advert.remove')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this advert?');" class="d-inline">@csrf
                                                    <input type="hidden" name="adverts[]" value="{{$advert->id}}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                        Remove
                                                    </button>
                                                  </form> 
                                                </div>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        
                        @if($adset->units > $adset->adverts->count()) 
                        <div class="tab-pane fade" id="pills-draft" role="tabpanel" aria-labelledby="pills-draft-tab">
                            <div class="products-tab__description">
                              <section class="shoping-cart section section--xl pt-0 pb-5">
                                <div class="row shoping-cart__content justify-content-center">              
                                  <div class="col-lg-8">
                                    <form method="POST" action="{{route('vendor.advert.store.shops')}}" enctype="multipart/form-data">@csrf
                                      <input type="hidden" name="adset_id" value="{{$adset->id}}">
                                      <div class="contact-form-input">
                                        <label>Show in Location</label>
                                        <select id="stateselect" name="state_id" class="select2" required>
                                          @foreach ($states as $state)
                                            <option value="{{$state->id}}" @if($state->id == $state_id) selected @endif>{{$state->name}}</option>  
                                          @endforeach     
                                        </select>
                                      </div>
                                      <div class="contact-form-file mb-3">
                                        <label for="category" class="d-block">Display Image </label>
                                        <input type="file" name="photo" placeholder="" />
                                        <small class="d-block">{{$adset->adplan->instruction}} </small>
                                      </div>
                                      <div class="contact-form-input">
                                        <label for="category">Heading</label>
                                        <input type="text" name="heading" placeholder="" />
                                      </div>
                                      <div class="contact-form-input">
                                        <label for="category">Subheading</label>
                                        <input type="text" name="subheading"  placeholder="" />
                                      </div>
                                      
                                      <div class="contact-form-input">
                                        <label for="category">Offer Text</label>
                                        <input type="text" name="offer" placeholder="e.g Sales 50% off" maxlength="20"/>
                                      </div>
                                      <div class="contact-form-input">
                                        <label for="category">Text Color (for heading & subheading & offer)</label>
                                        <select type="text" name="text_color" class="form-control like_select2">
                                            <option value="black">Black</option>
                                            <option value="white">White</option>
                                        </select>
                                      </div>
                                      <div class="contact-form__content-group justify-content-start mb-3">
                                        <label class="font-body--md-500">Link to: </label>
                                        <div class="form-check mx-3">
                                          <label class="form-check-label font-body--400" for="type_shop"> 
                                              Shop
                                          </label>
                                          <input class="form-check-input linkto" type="radio" name="type" id="type_shop" value="shop" checked>
                                        </div>
                                        <div class="form-check mx-3">
                                          <label class="form-check-label font-body--400" for="type_product"> 
                                              Product
                                          </label>
                                          <input class="form-check-input linkto" type="radio" name="type" id="type_product" value="product" >
                                        </div>
                                      </div>
                                      <div class="contact-form-input" id="show_shops">
                                        <label>Select Shop</label>
                                        <select id="shops" name="shop_id" class="select2">
                                          @foreach ($shops as $shop)
                                            <option value="{{$shop->id}}">{{$shop->name}} </option>  
                                          @endforeach 
                                        </select>
                                      </div>
                                      <div class="contact-form-input" id="show_products" style="display:none;">
                                        <label>Select Product</label>
                                        <select id="products" name="product_id" class="select2">
                                            @foreach ($products as $product)
                                              <option value="{{$product->id}}">{{$product->name}}</option>  
                                            @endforeach      
                                        </select>
                                      </div>
                                      <div class="contact-form-input">
                                        <label for="category">Button Text</label>
                                        <select name="button_text" class="form-control like_select2">
                                          <option value="Shop Now">Shop Now</option>
                                          <option value="Buy Now">Buy Now</option>
                                          <option value="Hurry Now">Hurry Now</option>
                                      </select>
                                      </div>
                                      <div class="contact-form-input">
                                        <label for="category">Button Color</label>
                                        <select name="button_color" class="form-control like_select2">
                                            <option value="green">Green</option>
                                            <option value="white">White</option>
                                        </select>
                                      </div>
                                      
                                      <button class="button button--lg w-100" style="margin-top: 20px" type="submit" @if($adset->units <= $adset->adverts->count()) disabled @endif>
                                        Create Ad
                                      </button>
                                      
                                    </form>
                                  </div>
                                </div>
                              </section>                   
                            </div>
                        </div> 
                        @endif
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
<script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script>
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
</script>
<script>
  var limit = @json($adset->units);
  var used = @json($adset->adverts->count());
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