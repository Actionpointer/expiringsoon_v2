@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/css/custom.css')}}"/>

@endpush
@section('title') Products | Expiring Soon @endsection
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
          <li>
            <a href="#">
              Admin
              <span> > </span>
            </a>
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
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0" style="font-size:13px">
          <div class="container">
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title border-bottom">
                <h2 class="font-body--xl-500">Products</h2>
              </div>
              
              <div class="dashboard__order-history-table">
                  <div class="m-4">
                    <div class="accordion mb-3" id="faq-accordion">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Manage
                          </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                          <div class="accordion-body">
                            <form action="{{route('admin.products')}}" method="get">
                              <div class="row">
                                @if(auth()->user()->role->name == 'superadmin')                                  
                                  <div class="col-md-3">
                                    <label>Select Country</label>
                                      <select name="country_id" id="country_id" class="select2">
                                          <option></option>
                                          <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$products->total()}}</option>
                                          @foreach ($countries->sortBy('category') as $country)
                                            <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->products->count()}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                @endif
                                
                                <div class="col-md-3">
                                    <label>Search Name</label>
                                    <input type="text" name="name" value="{{$name}}" class="form-control like_select2" id="search_name">
                                </div>
                                <div class="col-md-3">
                                  <label>Select Status</label>
                                  <select name="status" id="status" class="select2">
                                      <option></option>
                                      <option value="all" @if($status == 'all') selected @endif> All </option>
                                      <option value="live" @if($status == 'live') selected @endif>Live </option>
                                      <option value="pending" @if($status == 'pending') selected @endif>Pending Approval</option>
                                      <option value="inactive" @if($status == 'inactive') selected @endif>Inactive </option>
                                      <option value="draft" @if($status == 'draft') selected @endif>Draft </option>
                                      <option value="expired" @if($status == 'expired') selected @endif>Expired </option>
                                      <option value="soldout" @if($status == 'soldout') selected @endif>Sold Out </option>
                                      <option value="inaccessible" @if($status == 'inaccessible') selected @endif>Inaccessible </option>
                                      
                                  </select>
                                </div>
                
                                <div class="col-md-4">
                                    <label for="">Daterange</label>
                                    <div class="input-group d-flex">
                                      <div class="prepend">
                                          <input type="date" min="{{$min_date}}" name="from_date" class="form-control-sm border text-secondary" style="height:50px;" />
                                      </div>
                                      <div>
                                          <input type="date" max="{{$max_date}}" name="to_date" class="form-control-sm border text-secondary" style="height:50px;"  />
                                      </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                  <label>Sort</label>
                                  <select name="sortBy" id="sort-byd" class="form-control like_select2">
                                    <option value="name_asc" @if($sortBy == 'name_asc') selected @endif>Sort by: Name Asc</option>
                                    <option value="name_desc" @if($sortBy == 'name_desc') selected @endif>Sort by: Name Desc</option>
                                    <option value="date_asc" @if($sortBy == 'date_asc') selected @endif>Sort by: Expiry Asc</option>
                                    <option value="date_desc" @if($sortBy == 'date_desc') selected @endif>Sort by: Expiry Desc</option>    
                                  </select>
                                </div>
                                
                                <div class="row mt-3 justify-content-center">
                                  <div class="col-md-2">
                                    <button class="button button--md" name="download" value="0">Filter</button>
                                  </div>
                                  
                                </div>
                                
                              </div> 
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <tr>
                          <th scope="col" class="dashboard__order-history-table-title">Item</th>
                          <th scope="col" class="dashboard__order-history-table-title">Orders</th>
                          <th scope="col" class="dashboard__order-history-table-title">Statuses</th>
                          <th scope="col" class="dashboard__order-history-table-title">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse ($products as $product)
                      <tr  style="border-bottom:1px solid #f1f1f1">
                          <!-- Product item  -->
                          <td class="dashboard__order-history-table-item">
                            <div class="d-flex align-items-center">
                              <div class="form-check pt-2">
                                <label class="form-check-label font-body--400" for="existing"> </label>
                                <input class="form-check-input checkboxes" type="checkbox">
                              </div>
                              <a href="{{route('product.show',$product)}}"  class="cart-table__product-item" >
                                  <div class="cart-table__product-item-img">
                                      <img src="{{$product->image}}" alt="{{$product->name}}" onerror="this.src='{{asset('src/images/site/avatar.png')}}'" />
                                      
                                  </div>
                                  <div class="d-flex flex-column">
                                      <h5 class="font-body--lg-400"> {{ $product->name}}
                                        @if($product->features->where('running',true)->isNotEmpty())
                                        <span>
                                          <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0177 13.7381 15.4884L12.7138 11.4581C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9085 12.9129 10.8337L16.0933 8.18711C16.5106 7.83949 16.2958 7.14593 15.7586 7.11105L11.6056 6.84105C11.4938 6.83312 11.3866 6.79359 11.2964 6.72707C11.2061 6.66055 11.1367 6.56977 11.096 6.4653L9.5469 2.56493C9.50471 2.45408 9.42984 2.35867 9.33219 2.29136C9.23455 2.22404 9.11875 2.18799 9.00015 2.18799C8.88155 2.18799 8.76574 2.22404 8.6681 2.29136C8.57046 2.35867 8.49558 2.45408 8.4534 2.56493L6.90427 6.4653C6.86372 6.56988 6.79429 6.66077 6.70406 6.7274C6.61383 6.79402 6.50652 6.83364 6.39465 6.84161L2.24171 7.11161C1.70508 7.14593 1.48908 7.83949 1.90702 8.18711L5.0874 10.8342C5.17588 10.909 5.2415 11.0072 5.27673 11.1175C5.31195 11.2278 5.31534 11.3459 5.28652 11.4581L4.33702 15.1959C4.17558 15.8309 4.85115 16.3434 5.39452 15.9986L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z" fill="#2c742f"></path>
                                          </svg>
                                        </span>
                                        @endif
                                      </h5>
                                      <small class="text-muted">by {{$product->shop->name}}</small>
                                      
                                  </div>
                              </a>
                            </div>
                          </td>
                          <td class="dashboard__order-history-table-item">{{$product->orders->unique('order_id')->count()}}</td>
                          <td class="cart-table-item stock-status order-date align-middle">
                            <div class="d-flex text-nowrap">
                              @if($product->certified())
                                <span class="font-body--md-400 in me-1"> Live</span>
                              @endif
                              @if(!$product->approved)
                                <span class="font-body--md-400 out me-1"> @if($product->rejection_reason) Rejected @else Pending Approval @endif</span>
                              @endif
                              @if(!$product->status)
                                <span class="font-body--md-400 out me-1"> Inactive</span>
                              @endif
                              @if(!$product->published)
                                <span class="font-body--md-400 out me-1"> Draft</span>
                              @endif
                              @if(!$product->valid)
                                <span class="font-body--md-400 out me-1"> Expired</span>
                              @endif
                              @if(!$product->available)
                                <span class="font-body--md-400 out me-1"> Sold Out</span>
                              @endif
                              @if(!$product->accessible())
                                <span class="font-body--md-400 out"> Inaccessible</span>
                              @endif
                            </div>
                          </td>
                          <!-- Stock Status  -->
                          
                          <td class="cart-table-item stock-status order-date align-middle">
                            <div class="button-group text-nowrap">
                              
                              <form class="d-inline" action="{{route('admin.products.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                                <input type="hidden" name="products[]" value="{{$product->id}}">
                                  @if(!$product->approved)
                                  <button type="submit" name="approved" value="1" class="btn btn-sm btn-success">Approve</button>
                                  @else
                                  <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#reject{{$product->id}}">Reject</button>
                                  @endif

                                  @if(auth()->user()->isRole('superadmin'))
                                  <button type="submit" name="delete" value="1" class="btn btn-sm btn-danger">Delete</button>
                                  @endif                               
                                
                              </form>                                      
                              
                            </div>
                          </td>
                          <div class="modal fade" id="reject{{$product->id}}" tabindex="-1" aria-labelledby="reject{{$product->id}}ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="reject{{$product->id}}ModalLabel">Reject Product</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.products.manage')}}" method="post" id="reject{{$product->id}}form">
                                        @csrf 
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="contact-form__content my-3">
                                            <div class="contact-form-input">
                                              <label for="hours">Reason</label>
                                              <textarea name="reason" class="form-control" placeholder="Rejection Reason"></textarea>
                                            </div>
                                    
                                            <div class="contact-form-btn">
                                              <button class="button button--md" type="submit" name="approved" value="0">Reject</button>
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
                        <td colspan="4">
                            <div style="margin:auto;padding:1%;text-align:center">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br />No products.</span>
                            </div>
                        </td>
                      </tr>
                      @endforelse  
                    </tbody>
                  </table>
                  
                </div>
                @include('layouts.pagination',['data'=> $products])
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush