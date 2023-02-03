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
        @include('layouts.vendor_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                              Current Adverts
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                                Add Products
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
                      <section class="shoping-cart section section--xl pt-0">
                        <div class="row shoping-cart__content">
                          <div class="col-lg-12">
                            <div class="cart-table">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col" class="dashboard__order-history-table-title"> </th>
                                      <th scope="col" class="dashboard__order-history-table-title" style="padding-left:0px !important"> Product</th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Views</th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Clicks</th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Ad-Status</th>
                                      <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($feature->adverts as $advert)
                                      <tr>
                                        <!-- Product item  -->
                                        <td class="border-0">
                                          <div class="form-check pt-2">
                                            <label class="form-check-label font-body--400" for="existing"> </label>
                                            <input class="form-check-input checkboxes" type="checkbox" name="products[]" value="{{$advert->id}}" >
                                          </div>
                                        </td>
                                        <td class="dashboard__order-history-table-item" style="padding-left:0px !important"> 
                                            <span style="font-weight:500"> {{$advert->product->name}} </span>
                                            <span class="d-block small">Product
                                            
                                            @if(!$advert->product->approved)
                                              <button class="badge btn-danger">Pending Approval </button>
                                            @elseif(!$advert->product->status)
                                              <button class="badge btn-danger">Suspended </button>

                                            @elseif(!$advert->product->isValid())
                                              <button class="badge btn-danger">Expired </button>
                                            
                                            @elseif(!$advert->product->published)
                                              <button class="badge btn-danger">Not visible </button>
                                            
                                            @elseif(!$advert->product->isAccessible())
                                              <button class="badge btn-danger">Not accessible </button>
                                            
                                            @elseif(!$advert->product->stock)
                                              <button class="badge btn-danger"> Out of Stock </button>
                                            @else Satisfactory
                                            @endif </span>
                                        </td>
                                        <!-- Date  -->
                                        <td class="dashboard__order-history-table-item order-date "> {{ $advert->views}}</td>
                                        <!-- Total  -->
                                        <td class="   dashboard__order-history-table-item order-total ">  {{ $advert->clicks}} </td>

                                        <td class="   dashboard__order-history-table-item order-total "> 
                                            @if($advert->approved)
                                                @if($advert->status) Approved & Active
                                                @else Inactive
                                                @endif
                                            @else
                                              Pending Approval
                                            @endif  
                                        </td>
                                        <!-- Status -->
                                        
                                        <td class="dashboard__order-history-table-item order-status ">
                                          <div class="dropdown">
                                            <form action="{{route('vendor.advert.remove')}}" method="post" class="d-inline">@csrf
                                              <input type="hidden" name="adverts[]" value="{{$advert->id}}">
                                              <button class="btn btn-sm btn-danger" type="submit">
                                                Remove
                                              </button>
                                            </form>
                                            
                                            
                                          </div>
                                        </td>

                                      </tr> 
                                      @empty
                                      <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%;margin-top:5%">
                                        <button type="button" class="button button--md bg-dark" id="addbankaccount">Add Products</button>
                                      </div>
                                    @endforelse
                                  </tbody>
                                </table>
                              </div>
                            </div>       
                                     
                          </div>
                        </div>
                      </section>
                    </div>
                </div>
  
                <!-- Plan  -->
                <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                  <div class="products-tab__description">
                    <section class="shoping-cart section section--xl pt-0">
                      <div class="row shoping-cart__content justify-content-center">              
                        <div class="col-lg-8">
                          <form method="POST" action="{{route('vendor.advert.store.products')}}">@csrf
                              <input type="hidden" name="feature_id" value="{{$feature->id}}">
                              
                              
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
                                <select id="product" name="products[]" class="select2" multiple @if($feature->units <= $feature->adverts->count()) disabled @endif required>
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
                            <button class="button button--lg w-100" style="margin-top: 20px" type="submit" @if($feature->units <= $feature->adverts->count()) disabled @endif>
                              Create Advert
                            </button>
                            
                          </form>
                        </div>
                      </div>
                    </section>                   
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


@endsection
@push('scripts')
<script>
    var limit = @json($feature->units);
    var used = @json($feature->adverts->count());
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
            console.log('filtered product count '+data.length)
            data.forEach(element => {
              $('#product').append(`<option value="`+element.id+`">`+element.name+` in `+element.shop.name+` </option>`)
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
            data.forEach(element => {
              $('#product').append(`<option value="`+element.id+`">`+element.name+` in `+element.shop.name+` </option>`)
            });
            $('#product').select2();
              
              //adjust all the subtotals and grandtotals here
          },
          error: function (data, textStatus, errorThrown) {
              console.log(data);
          },
      })
    })
    
    $('#addbankaccount').click(function(e){
        e.preventDefault();
        $('#pills-plans-tab').tab('show');
    })
    
</script>
@endpush
