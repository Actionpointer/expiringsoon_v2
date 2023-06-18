@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

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
          
          <li class="active"><a href="#">Product Adverts</a></li>
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
                    <h2 class="font-body--xl-500">{{$adset->adplan->name}} Adverts</h2>
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
                          @if($adset->units > $adset->features->count())
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-draft-tab" data-bs-toggle="pill" data-bs-target="#pills-draft" type="button" role="tab" aria-controls="pills-draft" aria-selected="false">
                                Add Product
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
                                        <th scope="col" class="dashboard__order-history-table-title"> Products </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Location </th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Views</th>
                                        <th scope="col" class="dashboard__order-history-table-title"> Clicks</th>
                                        <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                    </thead>
                                    <tbody>                     
                                        @foreach($adset->features->where('running',true) as $feature)        
                                            <tr class="border-top">
                                                <td class="cart-table-item align-middle" >
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check pt-2 d-inline-block">
                                                              <label class="form-check-label font-body--400" for="existing"> </label>
                                                              <input class="form-check-input checkboxes" type="checkbox" name="features[]" value="{{$feature->id}}" >
                                                            </div>
                                                            <a href="{{$feature->url}}" class="cart-table__product-item">
                                                              <div class="cart-table__product-item-img">
                                                                <img src="{{$feature->product->image}}" alt="{{$feature->product->name}}" />
                                                              </div>
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="d-flex align-items-center">
                                                          <a href="{{$feature->url}}" class="cart-table__product-item">
                                                            <h5 class="font-body--lg-400" style="font-size:14px"> {{$feature->product->name}}
                                                              <span>
                                                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0177 13.7381 15.4884L12.7138 11.4581C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9085 12.9129 10.8337L16.0933 8.18711C16.5106 7.83949 16.2958 7.14593 15.7586 7.11105L11.6056 6.84105C11.4938 6.83312 11.3866 6.79359 11.2964 6.72707C11.2061 6.66055 11.1367 6.56977 11.096 6.4653L9.5469 2.56493C9.50471 2.45408 9.42984 2.35867 9.33219 2.29136C9.23455 2.22404 9.11875 2.18799 9.00015 2.18799C8.88155 2.18799 8.76574 2.22404 8.6681 2.29136C8.57046 2.35867 8.49558 2.45408 8.4534 2.56493L6.90427 6.4653C6.86372 6.56988 6.79429 6.66077 6.70406 6.7274C6.61383 6.79402 6.50652 6.83364 6.39465 6.84161L2.24171 7.11161C1.70508 7.14593 1.48908 7.83949 1.90702 8.18711L5.0874 10.8342C5.17588 10.909 5.2415 11.0072 5.27673 11.1175C5.31195 11.2278 5.31534 11.3459 5.28652 11.4581L4.33702 15.1959C4.17558 15.8309 4.85115 16.3434 5.39452 15.9986L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z" fill="#2c742f"></path>
                                                                </svg>
                                                              </span>
                                                            </h5>
                                                          </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <!-- Date  -->
                                                <td class="cart-table-item align-middle"> {{ $feature->state->name}}, {{ $feature->state->country->name}}</td>
                                                <td class="cart-table-item align-middle"> {{ $feature->views}}</td>
                                                <td class="cart-table-item align-middle ">  {{ $feature->clicks}} </td> 
                                                <td class="cart-table-item align-middle">
                                                  <form action="{{route('vendor.feature.remove')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this advert?');" class="d-inline">@csrf
                                                    <input type="hidden" name="features[]" value="{{$feature->id}}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                      Remove
                                                    </button>
                                                  </form>
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
                                    <th scope="col" class="dashboard__order-history-table-title"> Products </th>
                                    <th scope="col" class="dashboard__order-history-table-title"> Location </th>
                                    <th scope="col" class="dashboard__order-history-table-title"> Views</th>
                                    <th scope="col" class="dashboard__order-history-table-title"> Clicks</th>
                                    
                                    <th scope="col" class="dashboard__order-history-table-title"></th>
                                </tr>
                                </thead>
                                <tbody>                     
                                    @foreach($adset->features->where('approved',false) as $feature)        
                                        <tr class="border-top">
                                            <td class="cart-table-item align-middle" >
                                              <div class="d-flex flex-column flex-md-row">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check pt-2 d-inline-block">
                                                      <label class="form-check-label font-body--400" for="existing"> </label>
                                                      <input class="form-check-input checkboxes" type="checkbox" name="features[]" value="{{$feature->id}}" >
                                                    </div>
                                                    <a href="{{$feature->url}}" class="cart-table__product-item">
                                                      <div class="cart-table__product-item-img">
                                                        <img src="{{$feature->product->image}}" alt="{{$feature->product->name}}" />
                                                      </div>
                                                    </a>
                                                </div>
                                                
                                                <div class="d-flex align-items-center">
                                                  <a href="{{$feature->url}}" class="cart-table__product-item">
                                                    <h5 class="font-body--lg-400" style="font-size:14px"> {{$feature->product->name}}
                                                      <span>
                                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0177 13.7381 15.4884L12.7138 11.4581C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9085 12.9129 10.8337L16.0933 8.18711C16.5106 7.83949 16.2958 7.14593 15.7586 7.11105L11.6056 6.84105C11.4938 6.83312 11.3866 6.79359 11.2964 6.72707C11.2061 6.66055 11.1367 6.56977 11.096 6.4653L9.5469 2.56493C9.50471 2.45408 9.42984 2.35867 9.33219 2.29136C9.23455 2.22404 9.11875 2.18799 9.00015 2.18799C8.88155 2.18799 8.76574 2.22404 8.6681 2.29136C8.57046 2.35867 8.49558 2.45408 8.4534 2.56493L6.90427 6.4653C6.86372 6.56988 6.79429 6.66077 6.70406 6.7274C6.61383 6.79402 6.50652 6.83364 6.39465 6.84161L2.24171 7.11161C1.70508 7.14593 1.48908 7.83949 1.90702 8.18711L5.0874 10.8342C5.17588 10.909 5.2415 11.0072 5.27673 11.1175C5.31195 11.2278 5.31534 11.3459 5.28652 11.4581L4.33702 15.1959C4.17558 15.8309 4.85115 16.3434 5.39452 15.9986L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z" fill="#2c742f"></path>
                                                        </svg>
                                                      </span>
                                                    </h5>
                                                  </a>
                                                </div>
                                              </div>
                                            </td>
                                            
                                            <!-- Date  -->
                                            <td class="cart-table-item align-middle"> {{ $feature->state->name}}, {{ $feature->state->country->name}}</td>
                                            <td class="cart-table-item align-middle"> {{ $feature->views}}</td>
                                            <!-- Total  -->
                                            <td class="cart-table-item align-middle ">  {{ $feature->clicks}} </td>                                          
                                            <td class="cart-table-item align-middle">
                                              <form action="{{route('vendor.feature.remove')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this advert?');" class="d-inline">@csrf
                                                <input type="hidden" name="features[]" value="{{$feature->id}}">
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    Remove
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Plan  -->
                        <div class="tab-pane fade" id="pills-inactive" role="tabpanel" aria-labelledby="pills-inactive-tab">
                          <div class="dashboard__order-history-table">
                            <div class="table-responsive">
                              <table class="table datatable">
                                  <thead>
                                  <tr>
                                      <th scope="col" class="dashboard__order-history-table-title"> Products </th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Location </th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                                      <th scope="col" class="dashboard__order-history-table-title"></th>
                                  </tr>
                                  </thead>
                                  <tbody>                     
                                      @foreach($adset->features->where('status',false) as $feature)        
                                          <tr class="border-top">
                                              <td class="cart-table-item align-middle" >
                                                <div class="d-flex flex-column flex-md-row">
                                                  <div class="d-flex align-items-center">
                                                      <div class="form-check pt-2 d-inline-block">
                                                        <label class="form-check-label font-body--400" for="existing"> </label>
                                                        <input class="form-check-input checkboxes" type="checkbox" name="features[]" value="{{$feature->id}}" >
                                                      </div>
                                                      <a href="{{$feature->url}}" class="cart-table__product-item">
                                                        <div class="cart-table__product-item-img">
                                                          <img src="{{$feature->product->image}}" alt="{{$feature->product->name}}" />
                                                        </div>
                                                      </a>
                                                  </div>
                                                  
                                                  <div class="d-flex align-items-center">
                                                    <a href="{{$feature->url}}" class="cart-table__product-item">
                                                      <h5 class="font-body--lg-400" style="font-size:14px"> {{$feature->product->name}}
                                                        <span>
                                                          <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                              <path d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0177 13.7381 15.4884L12.7138 11.4581C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9085 12.9129 10.8337L16.0933 8.18711C16.5106 7.83949 16.2958 7.14593 15.7586 7.11105L11.6056 6.84105C11.4938 6.83312 11.3866 6.79359 11.2964 6.72707C11.2061 6.66055 11.1367 6.56977 11.096 6.4653L9.5469 2.56493C9.50471 2.45408 9.42984 2.35867 9.33219 2.29136C9.23455 2.22404 9.11875 2.18799 9.00015 2.18799C8.88155 2.18799 8.76574 2.22404 8.6681 2.29136C8.57046 2.35867 8.49558 2.45408 8.4534 2.56493L6.90427 6.4653C6.86372 6.56988 6.79429 6.66077 6.70406 6.7274C6.61383 6.79402 6.50652 6.83364 6.39465 6.84161L2.24171 7.11161C1.70508 7.14593 1.48908 7.83949 1.90702 8.18711L5.0874 10.8342C5.17588 10.909 5.2415 11.0072 5.27673 11.1175C5.31195 11.2278 5.31534 11.3459 5.28652 11.4581L4.33702 15.1959C4.17558 15.8309 4.85115 16.3434 5.39452 15.9986L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z" fill="#2c742f"></path>
                                                          </svg>
                                                        </span>
                                                      </h5>
                                                    </a>
                                                  </div>
                                              </div>
                                              </td>

                                              <td class="cart-table-item align-middle"> {{ $feature->state->name}}, {{ $feature->state->country->name}}</td>

                                              <td class="cart-table-item align-middle"> 
                                                  <span class="d-block text-danger">Product is not showing </span> 
                                              </td>
                                              <!-- Status -->
                                              
                                              <td class="cart-table-item align-middle">
                                                  <form action="{{route('vendor.feature.remove')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this advert?');" class="d-inline">@csrf
                                                    <input type="hidden" name="features[]" value="{{$feature->id}}">
                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                      Remove
                                                    </button>
                                                  </form>
                                              </td>
                                          </tr>
                                      
                                      @endforeach
                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        
                        @if($adset->units > $adset->features->count())
                        <div class="tab-pane fade" id="pills-draft" role="tabpanel" aria-labelledby="pills-draft-tab">
                            <div class="products-tab__description">
                                <section class="shoping-cart section section--xl pt-0">
                                  <div class="row shoping-cart__content justify-content-center">              
                                    <div class="col-lg-8">
                                      <form method="POST" action="{{route('vendor.advert.feature.products')}}">@csrf
                                          <input type="hidden" name="adset_id" value="{{$adset->id}}">
                                          <div class="my-3 filter" style="display: block;">
                                              <div class="contact-form-input">
                                                <label>Filter by Shop</label>
                                                <select id="shops" name="shops[]" class="select2 w-100" multiple>
                                                  @foreach ($shops as $shop)
                                                    <option value="{{$shop->id}}">{{$shop->name}} </option>  
                                                  @endforeach    
                                                </select>
                                              </div>
                                          </div>
                                          <div class="my-3 filter" style="display: block;">
                                              <div class="contact-form-input">
                                                <label>Filter by Categories</label>
                                                <select id="categories" name="categories[]" class="select2 w-100" multiple>
                                                    @foreach ($categories as $category)
                                                      <option value="{{$category->id}}">{{$category->name}}</option>  
                                                    @endforeach  
                                                </select>
                                              </div>
                                          </div>
                                        {{-- @endif --}}
                                        <div class="contact-form-input">
                                            <label>Select Products</label>
                                            <select id="product" name="products[]" class="select2" multiple @if($adset->units <= $adset->features->count()) disabled @endif required>
                                                @foreach ($products as $product)
                                                  <option value="{{$product->id}}">{{$product->name}} in {{$product->shop->name}}</option>  
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
                                        <button class="button button--lg w-100" style="margin-top: 20px" type="submit" @if($adset->units <= $adset->features->count()) disabled @endif>
                                          Create Advert
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
    var used = @json($adset->features->count());
    $('.select2#product[multiple]').select2({
      maximumSelectionLength:limit-used,
    })

    $(document).on('change','#shops',function(){
      var shops = $('#shops').val();
      var categories = $('#categories').val(); 
      $.ajax({
          type:'POST',
          dataType: 'json',
          url: "{{route('vendor.advert.filter_product')}}",
          data:{
              '_token' : $('meta[name="csrf-token"]').attr('content'),
              'shops': shops,
              'categories': categories,
          },
          success:function(data) {
            $('#product').children().remove()
            console.log('filtered product count '+data)
            data.data.forEach(element => {
              $('#product').append(`<option value="`+element.id+`">`+element.name+` in `+element.shop_name+` </option>`)
            });
            $('#product').select2();
          },
          error: function (data, textStatus, errorThrown) {
              console.log(data);
          },
      })
    })

    $(document).on('change','#categories',function(){
      var shops = $('#shops').val();
      var categories = $('#categories').val();
      $.ajax({
          type:'POST',
          dataType: 'json',
          url: "{{route('vendor.advert.filter_product')}}",
          data:{
              '_token' : $('meta[name="csrf-token"]').attr('content'),
              'shops': shops,
              'categories': categories,
          },
          success:function(data) {
            $('#product').children().remove()
            console.log('filtered product count '+data.length)
            data.data.forEach(element => {
              $('#product').append(`<option value="`+element.id+`">`+element.name+` in `+element.shop_name+` </option>`)
            });
            $('#product').select2();
              
              //adjust all the subtotals and grandtotals here
          },
          error: function (data, textStatus, errorThrown) {
              console.log(data);
          },
      })
    })
</script>
@endpush