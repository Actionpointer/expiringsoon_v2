@extends('layouts.app')
@push('styles')

@endpush
@section('title')Add Product | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
      <div class="breedcrumb__img-wrapper">
        <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
            <li>
              <a href="{{route('home')}}">
                Account
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="{{route('vendor.shop.product.list',$shop)}}">My Products</a></li>
          </ul>
        </div>
      </div>
  </div>
    <!-- breedcrumb section end   -->

    

    <!-- dashboard Secton Start  -->
    @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Edit Product  -->
              <form action="{{route('vendor.shop.product.store',$shop)}}" method="post" id="addproduct"  enctype="multipart/form-data">@csrf
                <div class="dashboard__content-card">
                  <div class="dashboard__order-history-title" style="border-bottom:1px solid #ddd">
                    <h2 class="font-body--xxl-500">Add New Product</h2>
                    @if($shop->user->total_products >= $shop->user->max_products) 
                    <span>
                      You have exhausted your product quota
                      @if(auth()->id() == $shop->user->id) <a href="{{route('vendor.plans')}}" class="font-body--lg-500"> <u>UPGRADE</u></a> @endif
                    </span>
                    @endif
                  </div>
                  <div class="dashboard__content-card-body">
                    <div class="row">
                      <div class="col-lg-7 order-lg-0 order-2">
                        
                          <input type="hidden" name="shop_id" value="{{$shop->id}}">
                          <div class="contact-form__content">
                            <div class="contact-form-input">
                              <label for="name">Product </label>
                              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Product Name" required />
                              @error('name')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <div class="contact-form--input contact-form--input-area">
                              <textarea name="description" cols="auto" class="w-100" placeholder="Product Description" required >{{ old('description') }}</textarea>
                              @error('description')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <div class="contact-form-input">
                              <label for="number1">Stock</label>
                              <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Quantity Available"  required/>
                              @error('stock')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img flex-column align-items-center">
                            <div class="dashboard__content-img-wrapper" id="avatar">
                              <img  src="{{asset('images/site/no-image.jpg')}}" class="rounded-circle" alt="Product Photo" onclick="performClick('theFile');" id="imgPreview"    />
                            </div>
                            <div>
                              <input type="file" name="photo" id="theFile" onchange="readURL(this,'imgPreview')" accept=".png, .jpg, .jpeg"/>
                              @error('photo')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            {{-- <p class="d-block">Nothing </p> --}}
                            
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                          <div class="contact-form__content">
                            <div class="contact-form__content-group">
                              
                              <div class="contact-form-input">
                                <label for="tags">Tags  <small>(allows multiple)</small></label>
                                <select name="tags[]" id="tags" class="select2" multiple data-placeholder="Select or Add New" data-tags="true">
                                  @foreach ($tags->sortBy('name') as $tag)
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                  @endforeach
                                  
                                </select>
                                @error('tags')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div> 
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-form__content">
                              <div class="contact-form__content-group">
                                <div class="contact-form-input">
                                  <label for="lname2">Unit Price </label>
                                  <input type="number" name="price" id="prices" value="{{ old('price') }}" placeholder="Price for each" required />
                                  @error('price')
                                      <span class="invalid-feedback d-block" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                <div class="contact-form-input">
                                  <label for="number1">Expiry Date</label>
                                  <input type="date" name="expiry" placeholder="YYYY-MM-DD" value="{{ old('expiry') }}" id="datepicker"/>
                                  @error('expiry')
                                          <span class="invalid-feedback d-block" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                    @enderror
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

              
                <div class="dashboard__content-card">
                  <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Product Discounts</h5>
                  </div>
                  <div class="dashboard__content-card-body">
                    <div class="table-responsive">
                      <table class="table w-auto">
                        <tbody>
                          <tr>
                              <th class="text-nowrap">Expiry in</th>
                              <th>Discount %</th>
                              <th></th>
                              <th>Discounted Price</th>
                              <th></th>
                          </tr>
                          <tr>
                            <td>120 Days</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                    
                                <input class="form-control-sm border-light percent" type="number" step="0.001" name="discount120percent" id="discount120percent" value="{{ old('discount120percent') }}">
                                <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                                </div>
                            </div>
                            </td>
                            <td>OR</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                <div class="input-group-append">
                                  <span class="input-group-text">{!!$shop->country->currency->symbol!!}</span>
                                </div>
                                <input class="form-control-sm border-light discountprice" type="number" step="0.001" name="discount120" id="discount120" value="{{ old('discount120') }}">
                                
                              </div>
                            </td>
                            <td>
                              @error('discount120')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </td>
                          </tr>
                          <tr>
                            <td>90 Days</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                    
                                <input class="form-control-sm border-light percent" type="number" step="0.001" name="discount90percent" id="discount90percent" value="{{ old('discount90percent') }}">
                                <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                                </div>
                              </div>
                            </td>
                            <td>OR</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                <div class="input-group-append">
                                  <span class="input-group-text">{!!$shop->country->currency->symbol!!}</span>
                                </div>    
                                <input class="form-control-sm border-light discountprice" type="number" step="0.001" name="discount90" id="discount90" value="{{ old('discount90') }}">
                                
                              </div>
                            </td>
                            <td>
                                @error('discount90')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                          </tr>

                          <tr>
                            <td>60 Days</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                    
                                <input class="form-control-sm border-light percent" type="number" step="0.001" name="discount60percent" id="discount60percent" value="{{ old('discount60percent') }}">
                                <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                                </div>
                              </div>
                            </td><td>OR</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                <div class="input-group-append">
                                  <span class="input-group-text">{!!$shop->country->currency->symbol!!}</span>
                                </div>  
                                <input class="form-control-sm border-light discountprice" type="number" step="0.001" name="discount60" id="discount60" value="{{ old('discount60') }}">
                              </div>
                            </td>
                            <td>
                              @error('discount60')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </td>
                          </tr>

                          <tr>
                            <td>30 Days</td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                  
                                <input class="form-control-sm border-light percent" type="number" step="0.001" name="discount30percent" id="discount30percent" value="{{ old('discount30percent') }}">
                                <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                                </div>
                              </div>
                            </td>
                            <td><div class="">OR</div></td>
                            <td>
                              <div class="input-group d-flex flex-nowrap">
                                <div class="input-group-append">
                                  <span class="input-group-text">{!!$shop->country->currency->symbol!!}</span>
                                </div> 
                                <input class="form-control-sm border-light discountprice" type="number" step="0.001" name="discount30" id="discount30" value="{{ old('discount30') }}">
                              </div>
                            </td>
                            <td>
                                @error('discount30')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="dashboard__content-card">
                  <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Dimensions</h5>
                  </div>
                  <div class="dashboard__content-card-body">
                    <div class="contact-form__content">
                      <p class="font-body--md-500 mb-2">Exact dimensions of the product is required for accurate logistics  </p>
                      <div class="table-responsive">
                        <table class="table w-auto">
                          <tbody>
                            <tr>
                                <th class="text-nowrap"></th>
                                <th>Value</th>
                                <th>Unit</th>
                                <th></th>
                            </tr>
                            <tr>
                              <td>Length</td>
                              <td>
                                <input class="form-control-sm border-light" type="number" step="0.001" name="length" id="length" value="{{ old('length') }}"> 
                              </td>
                              <td>
                                  <select name="length_unit" id="length_unit" class="form-control">
                                      <option value="cm">Centimeter (cm)</option>
                                      <option value="in">Inches (in)</option>
                                  </select>
                              </td>
                              <td>
                                @error('length')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </td>
                              
                            </tr>
                            <tr>
                              <td>Width</td>
                              <td>
                                  <input class="form-control-sm border-light" type="number" step="0.001" name="width" id="width" value="{{ old('width') }}"> 
                                </td>
                              <td>
                                  <select name="width_unit" id="width_unit" class="form-control">
                                      <option value="cm">Centimeter (cm)</option>
                                      <option value="in">Inches (in)</option>
                                  </select>
                              </td>
                              <td>
                                @error('width')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </td>
                            </tr>
                            <tr>
                              <td>Height</td>
                              <td>
                                <input class="form-control-sm border-light" type="number" step="0.001" name="height" id="height" value="{{ old('height') }}"> 
                              </td>
                              <td>
                                  <select name="height_unit" id="height_unit" class="form-control">
                                      <option value="cm">Centimeter (cm)</option>
                                      <option value="in">Inches (in)</option>
                                  </select>
                              </td>
                              <td>
                                @error('height')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </td>
                            </tr>
                            <tr>
                              <td>Weight</td>
                              <td>
                                <input class="form-control-sm border-light" type="number" step="0.001" name="weight" id="weight" value="{{ old('weight') }}"> 
                              </td>
                              <td>
                                  <select name="weight_unit" id="weight_unit" class="form-control">
                                      <option value="kg">Kilogram (kg)</option>
                                      <option value="g">gram (g)</option>
                                      <option value="oz">Ounce (oz)</option>
                                      <option value="lb">Pound (lb)</option>
                                  </select>
                              </td>
                              <td>
                                @error('weight')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        
                      </div>
                      @if($shop->user->total_products >= $shop->user->max_products) 
                      <h3 class="text-danger">This product will <strong>NOT BE VISIBLE</strong> @if(auth()->id() == $shop->user_id) except you <a href="{{route('vendor.plans')}}">upgrade</a> @endif</h3>
                    
                      @endif
                      <div class="contact-form-btn">
                        <button class="button button--md bg-secondary my-1" name="published" value="0" type="submit" id="submit">
                          Save as Draft
                        </button>
                        <button class="button button--md my-1" name="published" value="1" type="submit" id="submit">
                          Publish Product
                        </button>
                      </div> 
                    </div> 
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
    <!-- dashboard Secton  End  -->
    
@endsection
@push('scripts')
    <script>
      var price = 0;
      // console.log(tags);
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
  
      $(document).on('input blur change',"#prices",function(){
        price = $(this).val();
        // $('.discountprice').attr({"max" : $(this).val(),"min" : price})
        $('.percent').each(function(){
          let result = price - ($(this).val() /100 * price);
          $('#'+$(this).attr('id').split('percent')[0]).val(result.toFixed(3));
        })         // values (or variables) here
      });
      $(document).on('input blur change',".percent",function(){
        let p = $(this).attr('id').split('percent')[0];
        let q = price - ($(this).val() /100 * price);
        $('#'+p).val(q.toFixed(3));
          // $('.discountprice').attr({"max" : $(this).val(),"min" : m})         // values (or variables) here
      });
      $(document).on('input blur change',".discountprice",function(){
        let p = $(this).attr('id')+'percent';
        let q = $(this).val() * 100 / price;
        $('#'+p).val(q.toFixed(3));
          // $('.discountprice').attr({"max" : $(this).val(),"min" : m})         // values (or variables) here
      });

    </script>
@endpush
