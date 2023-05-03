@extends('layouts.app')
@push('styles')
    <style>
        .cards-md--four .cards-md__img-wrapper a{
            height:200px;
        }
    </style>
@endpush
@section('title') Shops @endsection
@section('main')
    <!-- Banner  Section Start  -->
    <section class="banner banner--01">
        <div class="container">
            <!-- Desktop Version -->
            <div class="banner__wrapper row">
                <div class="col-lg-8">
                    <div class="swiper-container banner-slider--one">
                        <div class="swiper-wrapper">
                            @forelse ($advert_G as $item)
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="{{Storage::url($item->shop->banner)}}" alt="banner" />

                                    <div class="banner__wrapper-text" style="max-width: 400px;">
                                        <h2 class="font-title--xl w-100" style="max-width: 100% !important">
                                            {{$item->shop->name}}
                                        </h2>
                                        <div class="sale-off">
                                            <h5 class="font-body--xl-500 w-100" style="max-width: 80% !important">{{$item->shop->description}}</h5>
                                        </div>
                                        <a href="{{route('vendor.show',$item->shop)}}" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="src/images/banner/banner-lg-03.jpg" alt="banner" />

                                    <div class="banner__wrapper-text">
                                        <h2 class="font-title--xl">
                                            Healthy and Fresh Organic Food
                                        </h2>
                                        <div class="sale-off">
                                            <h5 class="font-body--xxl-500">Sale up to <span>30% off</span></h5>
                                            <p class="font-body--md">
                                                Free shipping on all your order.
                                            </p>
                                        </div>
                                        <a href="#" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="src/images/banner/banner-lg-03.jpg" alt="banner" />

                                    <div class="banner__wrapper-text">
                                        <h2 class="font-title--xl">
                                            Fresh & Healthy Organic Food
                                        </h2>
                                        <div class="sale-off">
                                            <h5 class="font-body--xxl-500">Sale up to <span>30% off</span></h5>
                                            <p class="font-body--md">
                                                Free shipping on all your order.
                                            </p>
                                        </div>
                                        <a href="#" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="src/images/banner/banner-lg-03.jpg" alt="banner" />

                                    <div class="banner__wrapper-text">
                                        <h2 class="font-title--xl">
                                            Fresh & Healthy Organic Food
                                        </h2>
                                        <div class="sale-off">
                                            <h5 class="font-body--xxl-500">Sale up to <span>30% off</span></h5>
                                            <p class="font-body--md">
                                                Free shipping on all your order.
                                            </p>
                                        </div>
                                        <a href="#" class="button button--md">
                                            Shop now
                                            <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        {{-- <div class="swiper-pagination"></div> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="banner__wrapper-img-sm">
                        @forelse ($advert_H as $item)
                        <div class="banner__wrapper-img banner__wrapper--img-02">
                            <img src="{{Storage::url($item->shop->banner)}}" alt="banner" />

                            <div class="banner__wrapper-text">
                                {{-- <h5 class="font-body--md-500">Summer Sale</h5> --}}
                                <h2 class="font-title--sm">{{$item->shop->name}}</h2>
                                <p class="font-body--md-400">{{$item->shop->description}}</p>
                                <a href="{{route('vendor.show',$item->shop)}}" class="button button--md">
                                    Shop now
                                    <span>
                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="banner__wrapper-img banner__wrapper--img-02">
                            <img src="src/images/banner/banner-sm-05.png" alt="banner" />

                            <div class="banner__wrapper-text">
                                <h5 class="font-body--md-500">sSummer Sale</h5>
                                <h2 class="font-title--sm">75% off</h2>
                                <p class="font-body--md-400">Only Fruit & Vegetable</p>
                                <a href="#" class="button button--md">
                                    Shop now
                                    <span>
                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="banner__wrapper-img banner__wrapper--img-03">
                            <img src="src/images/banner/banner-sm-04.png" alt="banner" />

                            <div class="banner__wrapper-text">
                                <h5 class="font-body--md-500">Best Deal</h5>
                                <h2 class="font-title--sm">
                                    Special Products Deal of the Month
                                </h2>

                                <a href="#" class="button button--md">
                                    Shop now
                                    <span>
                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>  
                        @endforelse
                        
                    </div>
                </div>
            </div>
            <!-- Mobile Version  -->
        </div>
    </section>
    <!-- Banner Section end  -->
    <!-- Filter section Start  -->
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
                <form action="{{route('vendors')}}" method="get" id="filterform">
                    <div class="filter-box__top">
                        <div class="filter-box__top-left">
                            <div class="select-box--item" style="min-width: 200px!important">
                                <select name="category_id" id="category_id" class="select2 w-100" onchange="document.getElementById('filterform').submit();">
                                    <option value="0">All Categories</option>
                                        @foreach ($categories->sortBy('category') as $cat)
                                            <option value="{{$cat->id}}" @if($category && $category->id == $cat->id) selected @endif>{{$cat->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="select-box--item" style="min-width: 200px!important">
                                <select name="state_id" id="state_id" class="select2" onchange="document.getElementById('filterform').submit();">
                                    <option value="0" @if($state_id == 0) selected @endif>All States</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" @if($state_id == $state->id) selected @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filter-box__top-right">
                            <div class="select-box--item">
                                <select name="sortBy" id="sort-by" class="filter__dropdown-menu" onchange="document.getElementById('filterform').submit();">
                                    <option value="name_asc">Sort by: Name Asc</option>
                                    <option value="name_desc">Sort by: Name Desc</option>  
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Filter section End  -->
    <!-- Shop list Section Start  -->
    <section class="shop shop--two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Desktop Version  -->
                    <div id="loadproducts">
                        <div class="row shop__product-items">                        
                            @forelse($shops as $shop)
                                
                        
                                <div class="col-lg-3 col-md-6">
                                    <div class="cards-md cards-md--four w-100">
                                        <div class="cards-md__img-wrapper">
                                            <a href="{{route('vendor.show',$shop)}}">
                                                <img src="./storage/{{$shop->banner}}" alt="{{$shop->name}}" onerror="this.src='img/no-image.png';" />
                                            </a>
                                        </div>
                                        <div class="cards-md__info d-flex justify-content-between align-items-center">
                                            <a href="{{route('vendor.show',$shop)}}" class="cards-md__info-left">
                                                <h6 class="font-body--md-400 product-title d-flex justify-content-between">
                                                   <span>
                                                    {{$shop->name}} 
                                                    @if($shop->verified())
                                                    <svg width="16" height="16" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="#00b207" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="#00b207" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                                                    @endif
                                                    </span> 
                                                   
                                                </h6>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            @empty
                                <div style="margin:auto;padding:10%;text-align:center">
                                    <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                    <br />No Shop</span>
                                </div>
                            @endforelse
                        
                            
                        </div>
                        @include('layouts.pagination',['data'=> $shops])
                        
                    </div>
            </div>
        </div>
    </section>
    <!-- Shop list Section End   -->

@endsection

@push('scripts')

@endpush