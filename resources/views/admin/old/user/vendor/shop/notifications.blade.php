@extends('layouts.app')
@push('styles')

@endpush
@section('title')Notifications | Vendor Dashboard @endsection
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
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('vendor.shop.show',$shop)}}">
              {{$shop->name}}
              <span> > </span>
            </a>
          </li>
          
          <li class="active"><a href="#">Notifications</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
  @include('layouts.session')
  <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container single-blog">
            <div class="dashboard__order-history">

              <div class="dashboard__order-history-title border-bottom">
                <h5 class="font-body--xl-500">Shop Notifications</h5>
                
              </div>

              <div class="dashboard__details-content">
                <div class="filter--search-result">
                  <div class="sort-list">
                      <label for="sort">Filter by:</label>
                      <select id="sort" class="sort-list__dropmenu" style="display: none;">
                          <option value="01">Unread</option>
                          <option value="02">Read</option>
                      </select> 
                  </div>
                  <div class="result-found">
                      <p><span class="number">{{$shop->unreadNotifications->count()}}</span> Unread</p>
                  </div>
                </div>
                <div class="single-blog__content">
                  
                  <div class="user-comments">
                      
                      <div class="user-comments__list">
                        @forelse ($notifications as $notification)
                          <div class="user">
                            <div class="user-message-info">
                                <a @if($notification->data['url']) href="{{url($notification->data['url'])}}" @else href="#" @endif>
                                  <div class="user-name">
                                    <h5 class="font-body--md-500">{{$notification->data['subject']}}</h5>
                                    <p class="date">{{$notification->created_at->diffForHumans()}} -</p>
                                    <p class="date">{{$notification->created_at->format('jS M, Y h:i A')}}</p>
                                  </div>
                                  <p class="user-message">
                                    {{$notification->data['body']}}
                                  </p>
                                </a>
                            </div>
                          </div>
                        @empty
                          <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                            <br />You have no notifications at this time.
                          </div>
                        @endforelse
                      </div>
                      
                    </div>
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

@endpush
