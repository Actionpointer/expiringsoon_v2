@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title')My Products | Expiring Soon @endsection
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
                  <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
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
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <!-- Order History  -->
            <div class="dashboard__order-history" style="padding:10px;font-size:13px">
              <div class="dashboard__order-history-title d-flex flex-column flex-md-row justify-content-between">
                <h2 class="font-body--xl-500 ">My Products</h2>
                
                <a href="{{route('vendor.shop.product.create',$shop)}}" class="button button--md" style="margin: unset;color:white">Add Products</a>
              </div>
              <div class="">
                <form id="featureform" action="{{route('vendor.adset.products')}}" method="POST">@csrf
                  <input type="hidden" name="shop_id" value="{{$shop->id}}" >
                </form>
                <form id="deleteform" action="{{route('vendor.shop.products.destroy',$shop)}}" method="POST">@csrf
                  <input type="hidden" name="delete" value="1" >
                </form>
                
                
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                      <tr>
                          {{-- <th scope="col" class="cart-table-title"></th> --}}
                          <th scope="col" class="cart-table-title" style="min-width:200px!important;">
                            <div class="d-flex align-items-center">
                              <div class="form-check d-inline">
                                <label class="form-check-label font-body--400" for="existing"> </label>
                                <input class="form-check-input checkboxes" type="checkbox" id="checkbox_master">
                              </div>
                             <span class="align-bottom">Product</span> 
                            </div>
                            
                          </th>
                          <th scope="col" class="cart-table-title align-middle">
                            Price</th>
                          <th scope="col" class="cart-table-title"></th>
                          {{-- <th scope="col" class="cart-table-title"></th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($shop->products as $product)
                          <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                            <td class="cart-table-item align-middle" >
                              <div class="d-flex flex-column">
                                  <div class="d-flex flex-column flex-md-row">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check pt-2 d-inline-block">
                                          <label class="form-check-label font-body--400" for="existing"> </label>
                                          <input class="form-check-input checkboxes" type="checkbox" name="products[]" value="{{$product->id}}" >
                                        </div>
                                        <a href="{{route('product.show',$product)}}" class="cart-table__product-item">
                                          <div class="cart-table__product-item-img">
                                            <img src="{{Storage::url($product->photo)}}" alt="{{$product->name}}" />
                                          </div>
                                        </a>
                                    </div>
                                    
                                    <div class="d-flex align-items-center">
                                      <a href="{{route('product.show',$product)}}" class="cart-table__product-item">
                                        <h5 class="font-body--lg-400" style="font-size:14px"> {{$product->name}}
                                          <span>
                                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0177 13.7381 15.4884L12.7138 11.4581C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9085 12.9129 10.8337L16.0933 8.18711C16.5106 7.83949 16.2958 7.14593 15.7586 7.11105L11.6056 6.84105C11.4938 6.83312 11.3866 6.79359 11.2964 6.72707C11.2061 6.66055 11.1367 6.56977 11.096 6.4653L9.5469 2.56493C9.50471 2.45408 9.42984 2.35867 9.33219 2.29136C9.23455 2.22404 9.11875 2.18799 9.00015 2.18799C8.88155 2.18799 8.76574 2.22404 8.6681 2.29136C8.57046 2.35867 8.49558 2.45408 8.4534 2.56493L6.90427 6.4653C6.86372 6.56988 6.79429 6.66077 6.70406 6.7274C6.61383 6.79402 6.50652 6.83364 6.39465 6.84161L2.24171 7.11161C1.70508 7.14593 1.48908 7.83949 1.90702 8.18711L5.0874 10.8342C5.17588 10.909 5.2415 11.0072 5.27673 11.1175C5.31195 11.2278 5.31534 11.3459 5.28652 11.4581L4.33702 15.1959C4.17558 15.8309 4.85115 16.3434 5.39452 15.9986L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z" fill="#2c742f"></path>
                                            </svg>
                                          </span>
                                        </h5>
                                      </a>
                                    </div>
                                  </div>

                                  <div>
                                    <div class="d-flex flex-md-row text-nowrap" style="margin-top:10px;color:#888;font-size:12px">          
                                      @if(!$product->valid)
                                        <span class="font-body--md-400 rounded px-1 mx-1 text-white bg-danger">Expired</span> 
                                      @else
                                        Expires in <span class="font-body--md-400 rounded px-1 mx-1 text-white @if($product->expire_at->diffInDays(now()) <= 7) bg-warning @else bg-success  @endif">{{$product->expire_at->diffInDays(now())}} days  </span>  
                                      @endif
                                      Stock:<span class="font-body--md-400 rounded px-1 mx-1 text-white @if($product->stock  > 10) bg-success  @else bg-danger @endif ">{{$product->stock}} remaining</span>  
                                      Status: <span class="font-body--md-400 rounded px-1 mx-1 text-white @if($product->status) bg-success @else bg-danger @endif"> 
                                        @if($product->status) Active  @else Inactive @endif 
                                      </span> 
                                      Approval: <span class="font-body--md-400 rounded px-1 mx-1 text-white @if($product->approved) bg-success  @else bg-warning @endif"> 
                                        @if($product->approved) Approved  @else Pending @endif 
                                      </span> 
                                      Visibility: <span class="font-body--md-400 rounded px-1 mx-1 text-white @if($product->published) bg-success @else bg-dark @endif"> 
                                        @if($product->published) Published  @else Draft @endif 
                                      </span>
                                      {{-- @if($product->adverts->isNotEmpty()) | Featured @endif --}}
                                    <div>
                                  </div>
                              </div>
                            </td>
                              <!-- Price  -->
                            <td class="cart-table-item order-date align-middle">
                              <p class="font-body--lg-500">
                                {!!$shop->country->currency->symbol!!}{{number_format($product->price , 2)}}
                              </p>
                            </td>

                            <td class="cart-table-item add-cart align-middle">
                              <div class="d-flex flex-column">
                                  <a href="{{route('vendor.shop.product.edit',[$shop,$product])}}" class="btn btn-sm btn-secondary">Edit</a>
                                  @if(auth()->id() == $shop->user_id)
                                    <form class="d-inline" action="{{route('vendor.adset.products')}}"  method="POST">@csrf
                                      <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                      <input type="hidden" name="product_id" value="{{$product->id}}">
                                      <button type="submit" class="btn btn-sm my-1 btn-primary">Feature</button>
                                    </form>
                                  @endif
                                  
                                  <form class="d-inline" action="{{route('vendor.shop.products.destroy',$shop)}}"  method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">@csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                  </form>
                                  
                              </div>
                              
                            </td>
                            
    
                          </tr>   
                        @empty
                          <div style="margin:auto;padding:1%;text-align:center">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br/><span>There are no products at this time.</span></a>
                          </div>
                        
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
    <!-- dashboard Secton  End  -->
    
@endsection
@push('scripts')

    <script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "pagingType": "full_numbers",
                dom: 'lBfrtip',
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Products",
                }
            });
        });
    </script>
    <script>
      
      function deleteform(){
        if($('.checkboxes:checked').length){
          $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
              var input = $("<input>").attr("type", "hidden").attr("name", 'products[]').val(elem.value);
              $('#deleteform').append($(input));
          });
          $('#deleteform').submit();
        }
      }
      function featureform(){
        if($('.checkboxes:checked').length){
          $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
              var input = $("<input>").attr("type", "hidden").attr("name", 'products[]').val(elem.value);
              $('#featureform').append($(input));
          });
          $('#featureform').submit();
        }
      }
      function publishform(){
        if($('.checkboxes:checked').length){
          $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
              var input = $("<input>").attr("type", "hidden").attr("name", 'products[]').val(elem.value);
              $('#publishform').append($(input));
          });
          $('#publishform').submit();
        }
      }
      function draftform(){
        if($('.checkboxes:checked').length){
          $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
              var input = $("<input>").attr("type", "hidden").attr("name", 'products[]').val(elem.value);
              $('#draftform').append($(input));
          });
          $('#draftform').submit();
        }
      }
    
    </script>
@endpush
