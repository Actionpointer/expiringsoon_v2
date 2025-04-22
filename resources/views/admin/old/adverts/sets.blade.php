@extends('layouts.app')
@push('styles')

@endpush
@section('title') Adsets @endsection
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
          <li class="active"><a href="#">Adsets</a></li>
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
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header d-flex justify-content-between">
                  <h5 class="font-body--xl-500">Advert Subscription</h5>
                  <a href="#" class="font-body--lg-500">{{number_format($adsets->count(), 0)}} Advert Subscriptions</a>
              </div>
              <div class="dashboard__content-card-body px-0">
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
                          <form action="{{route('admin.adsets')}}" method="get">
                            <div class="row">
                              @if(auth()->user()->role->name == 'superadmin')                                  
                                <div class="col-md-3">
                                  <label>Select Country</label>
                                    <select name="country_id" id="country_id" class="select2">
                                        <option value=""></option>
                                        <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$adsets->total()}}</option>
                                        @foreach ($countries->sortBy('category') as $country)
                                          <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->adsets->count()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                              @endif
                              
                              <div class="col-md-4">
                                  <label>Select Ad Plan</label>
                                  <select name="type" id="sort-byd" class="select2">
                                    <option value="all" @if($type == 'all') selected @endif>All</option>
                                    @foreach ($adplans as $adplan)
                                    <option value="{{$adplan->id}}" @if($type == $adplan->id) selected @endif>{{$adplan->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-md-3">
                                <label>Select Status</label>
                                <select name="status" id="status" class="form-control like_select2" style="height:50px;">
                                  <option value="all" @if($status == 'all') selected @endif>All</option>
                                  <option value="active" @if($status == 'active') selected @endif>Active</option>
                                  <option value="expired" @if($status == 'expired') selected @endif>Expired</option>
                                  
                                </select>
                              </div>
              
                              <div class="col-md-4">
                                  <label for="">Date range</label>
                                  <div class="input-group d-flex">
                                    <div class="prepend">
                                        <input type="date" min="{{$min_date}}" name="from_date" class="form-control-sm border text-secondary" style="height:50px;" />
                                    </div>
                                    <div>
                                        <input type="date" max="{{$max_date}}" name="to_date" class="form-control-sm border text-secondary" style="height:50px;"  />
                                    </div>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                <label>Sort</label>
                                <select name="sortBy" id="sort-byd" class="form-control like_select2" style="height:50px;">
                                  
                                  <option value="date_asc" @if($sortBy == 'date_asc') selected @endif>Sort by: Created Date Asc</option>
                                  <option value="date_desc" @if($sortBy == 'date_desc') selected @endif>Sort by: Created Date Desc</option>    
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
                <table class="table display" style="width:100%;font-size:13px">
                  <thead>
                    <tr>
                      <th scope="col" class="cart-table-title">User Details</th>
                      <th scope="col" class="cart-table-title">Plan</th>
                      <th scope="col" class="cart-table-title">Units</th>
                      <th scope="col" class="cart-table-title">Begins</th>
                      <th scope="col" class="cart-table-title">Ends</th>
                      <th scope="col" class="cart-table-title">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($adsets as $adset)
                      <tr class="likeditem">
                        <!-- Product item  -->
                        <td class="cart-table-item align-middle"> {{$adset->user->name}} </td>
                        <td class="cart-table-item order-date align-middle"> {{$adset->adplan->name}} </td>
                        <td class="cart-table-item order-date align-middle"> {{$adset->units}} </td>
                        
                        <td class="cart-table-item order-date align-middle">
                          {{$adset->start_at->format('d-m-Y h:iA')}}
                        </td>
                        <td class="cart-table-item order-date align-middle">
                          {{$adset->end_at->format('d-m-Y h:iA')}}
                        </td>
                        
                        <!-- Stock Status  -->
                        <td class="cart-table-item order-date align-middle">
                          
                            @if($adset->deleted_at || $adset->end_at < now())
                                <button class="badge btn-danger">Expired </button>
                            @elseif($adset->end_at->diffInDays(now()) < 7)
                                <button class="badge btn-warning">Expiring </button>
                            @else
                                <button class="badge btn-success">Active </button>
                            @endif
                          
                        </td>
                        
                      </tr>                                         
                    @endforeach
                  </tbody>
                </table>
                @include('layouts.pagination',['data'=> $adsets])
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