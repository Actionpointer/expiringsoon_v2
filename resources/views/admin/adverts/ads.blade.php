@extends('layouts.app')
@push('styles')
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
          <li>
            <a href="#">
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Adverts</a></li>
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
                <h2 class="font-body--xl-500">Adverts</h2>
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
                            <form action="{{route('admin.adverts')}}" method="get">
                              <div class="row">
                                @if(auth()->user()->role->name == 'superadmin')                                  
                                  <div class="col-md-3">
                                    <label>Select Country</label>
                                      <select name="country_id" id="country_id" class="select2">
                                          <option></option>
                                          <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$adverts->total()}}</option>
                                          @foreach ($countries->sortBy('category') as $country)
                                            <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->adverts->count()}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                @endif
                                
                                <div class="col-md-3">
                                    <label>Select Types</label>
                                    <select name="type" id="types" class="form-control like_select2">
                                      <option></option>
                                      <option value="all" @if($type == 'all') selected @endif>All</option>
                                      <option value="Shop" @if($type == 'Shop') selected @endif>Shops</option>
                                      <option value="Product" @if($type == 'Product') selected @endif>Products</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                  <label>Select Status</label>
                                  <select name="status" id="status" class="select2">
                                      <option></option>
                                      <option value="all" @if($status == 'all') selected @endif> All </option>
                                      <option value="live" @if($status == 'live') selected @endif>Live </option>
                                      <option value="pending" @if($status == 'pending') selected @endif>Pending Approval</option>
                                      <option value="inactive" @if($status == 'inactive') selected @endif>Inactive </option>
                                      <option value="expired" @if($status == 'expired') selected @endif>Expired </option>
                                      
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

                                <div class="col-md-2">
                                  <label>Sort</label>
                                  <select name="sortBy" id="sort-byd" class="form-control like_select2">
                                    <option value="date_asc" @if($sortBy == 'date_asc') selected @endif>Sort by: Date Asc</option>
                                    <option value="date_desc" @if($sortBy == 'date_desc') selected @endif>Sort by: Date Desc</option>  
                                  </select>
                                </div>
                                
                                <div class="row mt-3 justify-content-center">
                                  <div class="col-md-2">
                                    <button class="button button--md" name="download" value="0">Filter</button>
                                  </div>
                                  @can('download','App\Models\Payment')
                                  <div class="col-md-2">
                                    <button class="button button--md" name="download" value="1">Download</button>
                                  </div>
                                  @endcan
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
                          <th scope="col" class="dashboard__order-history-table-title">Result</th>
                          <th scope="col" class="dashboard__order-history-table-title">Status</th>
                          <th scope="col" class="dashboard__order-history-table-title">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse ($adverts as $advert)
                      <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                          <!-- Product item  -->
                          <td class="">
                              <a href=" @if($advert->advertable_type == 'App\Models\Product') {{route('product.show',$advert->advertable)}} @else {{route('vendor.show',$advert->advertable)}} @endif"  class="cart-table__product-item" >
                                  <div class="cart-table__product-item-img">
                                      @if($advert->advertable_type == 'App\Models\Product')
                                          <img src="{{Storage::url($advert->advertable->photo)}}" alt="{{$advert->advertable->name}}" />
                                      @else
                                          <img src="{{Storage::url($advert->advertable->banner)}}" alt="{{$advert->advertable->name}}" />
                                      @endif
                                  </div>
                                  <div class="d-flex flex-column">
                                      <h5 class="font-body--lg-400"> {{ $advert->advertable->name}}
                                        @if($advert->advertable_type == 'App\Models\Product')
                                            <small class="text-muted">(product)</small>
                                        @else
                                            <small class="text-muted">(shop)</small>
                                        @endif
                                      </h5>
                                  </div>
                              </a>
                          </td>
                          
                          <td class="cart-table-item stock-status order-date align-middle">
                                {{$advert->views}} Views <br>
                                {{$advert->clicks}} Clicks
                          </td>
                          <!-- Stock Status  -->
                          <td class="cart-table-item stock-status order-date align-middle">
                            @if($advert->running && $advert->status)
                              <span class="font-body--md-400 in"> Live</span>
                            @endif

                            @if(!$advert->approved)
                              <span class="font-body--md-400 out"> Pending Approval</span>
                            @endif

                            @if($advert->approved && $advert->adset->status && $advert->adset->active && !$advert->status)
                              <span class="font-body--md-400 out"> Ad is not showing</span>
                            @endif

                            @if(!$advert->adset->status || !$advert->adset->active)
                              <span class="font-body--md-400 out"> Expired</span>
                            @endif
                              
                          </td>

                          <td class="cart-table-item add-cart align-middle">
                            <div class="dropdown">
                              <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Manage
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form class="d-inline" action="{{route('admin.adverts.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                                  <input type="hidden" name="advert_id" value="{{$advert->id}}">
                                  <a href="#" class="dropdown-item">Preview</a>
                                  @if(!$advert->approved)
                                  <button type="submit" name="approved" value="1" class="dropdown-item">Approve</button>
                                  @else
                                  <button type="submit" name="approved" value="0" class="dropdown-item">Disapprove</button>
                                  @endif
                                  
                                  <button type="submit" name="delete" value="1" class="dropdown-item">Delete</button>
                                </form>                                      
                              </div>
                            </div>
                          </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="4">
                            <div style="margin:auto;padding:1%;text-align:center">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br />There are no adverts at this time.</span>
                            </div>
                        </td>
                      </tr>
                      @endforelse  
                    </tbody>
                  </table>
                  
                </div>
                @include('layouts.pagination',['data'=> $adverts])
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