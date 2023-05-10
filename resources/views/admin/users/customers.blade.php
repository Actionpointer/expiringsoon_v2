@extends('layouts.app')
@push('styles')

@endpush
@section('title') Customers | Expiring Soon @endsection
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
          <li class="active"><a href="#">Customers</a></li>
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
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Customers</h2>
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
                        <form action="{{route('admin.customers')}}" method="get" id="filterform">
                            <div class="filter-box__top">
                                <div class="filter-box__top-left">
                                    @if(auth()->user()->role->name == 'superadmin')                                  
                                    <div class="select-box--item" style="min-width: 200px!important">
                                        <select name="country_id" id="country_id" class="select2" onchange="document.getElementById('filterform').submit();">
                                            <option></option>
                                            <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$users->count()}}</option>
                                                @foreach ($countries->sortBy('category') as $country)
                                                    <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$users->where('country_id',$country->id)->count()}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <div class="form-input mb-0">
                                      <input type="text" name="name" value="{{$name}}" placeholder="Search Name" oninput="this.value.length > 2 ? document.getElementById('filterform').submit() : ''">
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
                        <th scope="col" class="dashboard__order-history-table-title"> Customer</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Location</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Orders</th>
                        <th scope="col" class="dashboard__order-history-table-title">  Status</th>
                        <th scope="col" class="dashboard__order-history-table-title text-end">  Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($users as $user)
                      <tr>
                        <!-- Order Id  -->
                        <td class="dashboard__order-history-table-item order-id"> 
                          <a href="{{route('admin.user.show',$user)}}" class="text-success"> {{$user->name}}</a>
                        </td>
                        <!-- Date  -->
                        <td class="dashboard__order-history-table-item order-date "> 
                          {{$user->state->name}}, {{$user->country->name}}
                        </td>
          
                        <td class="dashboard__order-history-table-item order-status ">
                          @if($user->orders->count())
                          <p class="font-body--md-400">
                            {{$user->orders->count()}} orders - ({!!$user->country->currency->symbol!!} {{$user->orders->sum('total')}})
                          </p>
                          @else 0 orders @endif
                        </td>
                        <!-- Total  -->
                        <td class="dashboard__order-history-table-item order-total "> 
                          @if($user->status)
                          <span class="font-body--md-400 in"> Active</span>
                          @else
                          <span class="font-body--md-400 out"> Suspended</span>
                          @endif
                        </td>
                        <td class="dashboard__order-history-table-item ">
                          <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Manage
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <form class="d-inline" action="{{route('admin.user.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                @if(!$user->status)
                                <button type="submit" name="status" value="1" class="dropdown-item">Activate</button>
                                @else
                                <button type="submit" name="status" value="0" class="dropdown-item">Suspend</button>
                                @endif
                              </form>                                      
                            </div>
                          </div>
                        </td>
                       
                      </tr>  
                        @empty
                        <tr>
                          <td colspan="5">
                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br />You have no customers at this time.
                          </div>
                          </td>
                        </tr>
                        
                      @endforelse
                      
                    </tbody>
                  </table>
                </div>
                @include('layouts.pagination',['data'=> $users])
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