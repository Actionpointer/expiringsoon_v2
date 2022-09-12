@extends('layouts.app')
@push('styles')
<style>
  .user-img{
    margin-right:5px;
  }
</style>

@endpush
@section('title')Messages | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#"> Admin <span> > </span> </a>
          </li>
          <li class="active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="user-comments">
                <h5 class="font-body--xxxl">Messages</h5>
                <div class="user-comments__list">
                  <div class="d-flex py-4 border-bottom">
                    <div class="user-img">
                      <img src="{{asset('src/images/user/img-02.png')}}" alt="user-photo">
                    </div>

                    <div class="user-message-info">
                        <div class="d-flex ">
                          <h5 class="font-body--md-500">Chidi Black</h5>
                          <ul class="inside"><li class="text-muted border-top border-white">26 Apr, 2021</li></ul>
                        </div>

                        <p class="font-body--sm-400">
                          In a nisi commodo, porttitor ligula consequat, tincidunt
                          dui. Nulla volutpat, metus eu aliquam malesuada, elit
                          libero venenatis urna, consequat maximus arcu diam non
                          diam.
                        </p>
                    </div>
                  </div>
                  <div class="d-flex py-4 border-bottom">
                    <div class="user-img">
                      <img src="{{asset('src/images/user/img-03.png')}}" alt="user-photo">
                    </div>
                    <div class="user-message-info">
                      <div class="d-flex">
                        <h5 class="font-body--md-500">Lekan Black</h5>
                        <ul class="inside"><li class="text-muted border-top border-white">26 Apr, 2021</li></ul>
                      </div>
                      <p class="font-body--sm-400">
                        Quisque eget tortor lobortis, facilisis metus eu,
                        elementum est. Nunc sit amet erat quis ex convallis
                        suscipit. Nam hendrerit, velit ut aliquam euismod, nibh
                        tortor rutrum nisi, ac sodales nunc eros porta nisi. Sed
                        scelerisque, est eget aliquam venenatis, est sem tempor
                        eros.
                      </p>
                    </div>
                  </div>
                  
                </div>
                <form action="#">
                  <button class="button button--outline">Load more</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush