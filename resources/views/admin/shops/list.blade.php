@extends('layouts.app')
@push('styles')

@endpush
@section('title') Manage Shops | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                />
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
          <li class="active"><a href="{{route('admin.products')}}">Shops</a></li>
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
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Order History  -->
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Shops</h2>
              </div>
              <div class="filter__sidebar">
                <button class="filter">
                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 5.75C18.4142 5.75 18.75 5.41421 18.75 5C18.75 4.58579 18.4142 4.25 18 4.25V5.75ZM9 4.25C8.58579 4.25 8.25 4.58579 8.25 5C8.25 5.41421 8.58579 5.75 9 5.75V4.25ZM18 4.25H9V5.75H18V4.25Z" fill="white"></path>
                        <path
                            d="M13 14.75C13.4142 14.75 13.75 14.4142 13.75 14C13.75 13.5858 13.4142 13.25 13 13.25V14.75ZM4 13.25C3.58579 13.25 3.25 13.5858 3.25 14C3.25 14.4142 3.58579 14.75 4 14.75V13.25ZM13 13.25H4V14.75H13V13.25Z"
                            fill="white"
                        ></path>
                        <circle cx="5" cy="5" r="4" stroke="white" stroke-width="1.5"></circle>
                        <circle cx="17" cy="14" r="4" stroke="white" stroke-width="1.5"></circle>
                    </svg>
                </button>
                <div class="filter-box">
                    <div class="container">
                        <form action="{{route('admin.shops')}}" method="get" id="filterform">
                            <div class="filter-box__top">
                                <div class="filter-box__top-left">
                                    @if(auth()->user()->role->name == 'superadmin')                                  
                                    <div class="select-box--item" style="min-width: 200px!important">
                                        <select name="country_id" id="country_id" class="w-100" onchange="document.getElementById('filterform').submit();">
                                            <option></option>
                                            <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$shops->total()}}</option>
                                                @foreach ($countries->sortBy('category') as $country)
                                                    <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->shops->count()}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <div class="form-input mb-0">
                                      <input type="text" name="name" value="{{$name}}" placeholder="Search Name" oninput="this.value.length > 2 ? document.getElementById('filterform').submit() : ''">
                                    </div>
                                    <div class="select-box--item" style="min-width: 200px!important">
                                        <select name="status" id="order_status" class="select2" onchange="document.getElementById('filterform').submit();">
                                            <option></option>
                                            <option value="all" @if($status == 'all') selected @endif>All Statuses</option>
                                            <option value="live" @if($status == 'live') selected @endif>Live</option>
                                            <option value="pending" @if($status == 'pending') selected @endif>Pending Approval</option>
                                            <option value="inactive" @if($status == 'inactive') selected @endif>Inactive</option>
                                            <option value="draft" @if($status == 'draft') selected @endif>Draft</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                                
                                <div class="filter-box__top-right">
                                    <div class="select-box--item" style="min-width: 200px!important">
                                      <select name="sortBy" id="sort-byd" class="form-control" onchange="document.getElementById('filterform').submit();">
                                        <option value="name_asc" @if($sortBy == 'name_asc') selected @endif>Sort by: Name Asc</option>
                                        <option value="name_desc" @if($sortBy == 'name_desc') selected @endif>Sort by: Date Desc</option>  
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title">  Shop</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Owner</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Revenue</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Balance</th>
                        <th scope="col" class="dashboard__order-history-table-title text-end">  Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($shops as $shop)
                      <tr>
                        <!-- Order Id  -->
                        <td class="dashboard__order-history-table-item order-id"> 
                          <a href="{{route('admin.shop.show',$shop)}}" class="" >
                            <h5>
                             {{ $shop->name}}
                             @if($shop->verified())
                             <svg width="16" height="16" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="#00b207" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="#00b207" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                             @endif
                           </h5>
                          </a>
                        </td>
                        <!-- Date  -->
                        <td class="dashboard__order-history-table-item order-date "> 
                          {{$shop->user->name}}
                        </td>
                        <!-- Total  -->
                        <td class="dashboard__order-history-table-item order-total "> 
                            <p class="order-total-price">   {!!$shop->country->currency->symbol!!}{{ number_format($shop->orders->sum('subtotal'), 2)}} </p>
                        </td>
                        <!-- Status -->
                        <td class="dashboard__order-history-table-item order-status "> 
                          {!!$shop->country->currency->symbol!!}{{ number_format($shop->wallet, 2)}}
                        </td>
                        <td class="dashboard__order-history-table-item order-status "> 
                          <span class="font-body--md-400 in"> {{ucwords($shop->status)}}</span>
                        </td>
                        
                      </tr>  
                        @empty
                        <tr>
                          <td colspan="5">
                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br />You have no shops at this time.
                          </div>
                          </td>
                        </tr>
                        
                      @endforelse
                      
                    </tbody>
                  </table>
                </div>
                @include('layouts.pagination',['data'=> $shops])
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
<script>
    $('#country_id').select2({
      placeholder:'Filter Country'
    })
    $('#shipmentType').select2({
      placeholder:'Filter Shipment'
    })
    $('#order_status').select2({
      placeholder:'Filter Status'
    })
    $('#sort-byd').select2({
      placeholder:'Sort By',
      minimumResultsForSearch: 5,
    })
    
    
</script>
@endpush
