@extends('layouts.app')
@push('styles')

@endpush
@section('title') Users | Expiring Soon @endsection
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
          <li class="active"><a href="#">Subscribers</a></li>
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
                  <h5 class="font-body--xl-500">Manage Susbcription</h5>
                  <a href="#" class="font-body--lg-500">{{number_format($users->count(), 0)}} users</a>
              </div>
              <div class="dashboard__content-card-body px-0">
                <table class="datatable table display" style="width:100%;font-size:13px">
                  <thead>
                    <tr>
                      <th scope="col" class="cart-table-title">Vendor Details</th>
                      <th scope="col" class="cart-table-title">Location</th>
                      <th scope="col" class="cart-table-title">Shops</th>
                      <th scope="col" class="cart-table-title">Plan</th>
                      <th scope="col" class="cart-table-title">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr class="likeditem">
                        <!-- Product item  -->
                        <td class="cart-table-item align-middle">
                            {{$user->name}} <br>
                            <small>{{$user->email}}</small>
                        </td>
                        <td class="cart-table-item align-middle">
                          {{$user->state->name}}, {{$user->country->name}} <br>
                          <small>{{$user->phone}}</small>
                      </td>
                        <td class="cart-table-item order-date align-middle">      
                          {{$user->shops->count()}}
                        </td>
                        
                        <td class="cart-table-item order-date align-middle">
                          @if(!$user->subscription->end_at)
                          {{$user->subscription->plan->name}}
                          @else {{$user->subscription->plan->name}} <br> <small>{{$user->subscription->start_at->format('d M,Y')}} - {{$user->subscription->end_at ? $user->subscription->end_at->format('d M,Y') : '-'}}</small>
                          @endif
                        </td>
                        
                        <!-- Stock Status  -->
                        <td class="cart-table-item order-date align-middle">
                            @if($user->subscription->end_at)
                              @if($user->subscription->expired())
                                  <button class="badge btn-danger">Expired </button>
                              @elseif($user->subscription->renew_at && $user->subscription->renew_at < now())
                                  <button class="badge btn-warning">Expiring </button>
                              @elseif(!$user->subscription->status)
                                  <button class="badge btn-danger">Not Active </button>
                              @else 
                                  <button class="badge btn-success">Active </button>
                              @endif
                            @else
                              <button class="badge btn-success">Active </button>
                            @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

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