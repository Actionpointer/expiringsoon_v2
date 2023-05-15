@extends('layouts.app')
@push('styles')
    
@endpush
@section('title')
    Ad Preview
@endsection
@section('main')


    <!-- Advert B  Section Start  -->
    <section class="cyclone section section--lg section--green-0">
        <div class="container">
            <div class="row">

                @if($advert->adset->adplan->id == '3')
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{$advert->image}}" alt="banner" />
                            <div class="cards-ss__content text-center">
                                <h6 class="font-body--md-500">{{strtoupper($advert->subheading)}}</h6>
                                <h2 class="font-title--lg">{{$advert->heading}} </h2>

                                <div class="cards-ss__startpackage">
                                    <p>
                                        <span class="font-body--xxl-600">{{$advert->offer}}</span>
                                    </p>
                                </div>

                                <a href="{{$advert->url}}" class="button button--md">
                                    {{$advert->button_text}}
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
                </div>
                @else
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg cards-ss--darktext">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{asset('src/images/banner/banner-sm-02.png')}}" alt="banner" />
                            <div class="cards-ss__content text-center">
                                <h6 class="font-body--md-500">New Year Sale</h6>
                                <h2 class="font-title--lg">Fresh Fruits</h2>

                                <div class="cards-ss__saleoff">
                                    <p>Up to <span>40% off</span></p>
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
                </div>
                @endif
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{asset('src/images/banner/banner-sm-01.png')}}" alt="banner" />
                            <div class="cards-ss__content text-center">
                                <h6 class="font-body--md-500">85% Fat Free</h6>
                                <h2 class="font-title--lg">Low-Fat Meat</h2>
                                <div class="cards-ss__startpackage">
                                    <p>
                                        Starting from
                                        <span class="font-body--xxl-600">N550</span>
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
                </div> 
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg cards-ss--darktext">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{asset('src/images/banner/banner-sm-02.png')}}" alt="banner" />
                            <div class="cards-ss__content text-center">
                                <h6 class="font-body--md-500">New Year Sale</h6>
                                <h2 class="font-title--lg">Fresh Fruits</h2>

                                <div class="cards-ss__saleoff">
                                    <p>Up to <span>40% off</span></p>
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
                </div>
            </div>
        </div>
    </section>


    <section class="section section--xxl sales-banner--two">
        <div class="container">
            <div class="row">
                @if($advert->adset->adplan->id == '4')
                    <div class="col-lg-6">
                        <div class="banner-sale--two cards-ss--md">
                            <div class="banner-sale--two__img-wrapper">
                                <img src="{{$advert->image}}" alt="banner">
                                <div class="banner-sale--two__text-content">
                                    {{-- <span class="title">100% Organic</span> --}}
                                    <h5 class="font-title--md">{{$advert->heading}}</h5>
                                    <p class="font-body--md-400">{{$advert->subheading}}</p>
                                    <a href="{{$advert->url}}" class="button button--md">
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
                    </div>
                @else
                    <div class="col-lg-6">
                        <div class="banner-sale--two cards-ss--md">
                            <div class="banner-sale--two__img-wrapper">
                                <img src="{{asset('src/images/banner/banner-sm-15.png')}}" alt="banner">
                                <div class="banner-sale--two__text-content">
                                    <span class="title">100% Organic</span>
                                    <h5 class="font-title--md">Fruit &amp; Vegetable</h5>
                                    <p class="font-body--md-400">Starting at: <span>$11.99</span></p>
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
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="banner-sale--two cards-ss--md">
                        <div class="banner-sale--two__img-wrapper">
                            <img src="{{asset('src/images/banner/banner-sm-15.png')}}" alt="banner">
                            <div class="banner-sale--two__text-content">
                                <span class="title">100% Organic</span>
                                <h5 class="font-title--md">Fruit &amp; Vegetable</h5>
                                <p class="font-body--md-400">Starting at: <span>$11.99</span></p>
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
                </div>

                @if($advert->adset->adplan->id == '5')
                    <div class="col-lg-4 col-md-6">
                        <div class="cards-ss cards-ss--md cards-ss--md-three">
                            <div class="cards-ss--md__img-wrapper">
                                <img src="{{asset('src/images/banner/banner-sm-11.png')}}" alt="banner-sale" />
                                <div class="cards-ss--md__text-content">
                                    <h5>100% Organic</h5>
                                    <h2 class="font-title--sm">Quick Breakfast</h2>
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
                    </div>
                @else
                    <div class="col-lg-4 col-md-6">
                        <div class="cards-ss cards-ss--md cards-ss--md-one">
                            <div class="cards-ss--md__img-wrapper">
                                <img src="{{asset('src/images/banner/banner-sm-09.png')}}" alt="banner-sale" />
                                <div class="cards-ss--md__text-content">
                                    <h2 class="font-title--sm">100% Fresh Cow Milk</h2>
                                    <p>Starting at <span>$14.99</span></p>
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
                    </div>
                    
                @endif
                <div class="col-lg-4 col-md-6">
                    <div class="cards-ss cards-ss--md cards-ss--md-two">
                        <div class="cards-ss--md__img-wrapper">
                            <img src="{{asset('src/images/banner/banner-sm-10.png')}}" alt="banner-sale" />
                            <div class="cards-ss--md__text-content">
                                <h5>Drink Sale</h5>
                                <h2 class="font-title--sm">Water & Soft Drink</h2>

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
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="cards-ss cards-ss--md cards-ss--md-three">
                        <div class="cards-ss--md__img-wrapper">
                            <img src="{{asset('src/images/banner/banner-sm-11.png')}}" alt="banner-sale" />
                            <div class="cards-ss--md__text-content">
                                <h5>100% Organic</h5>
                                <h2 class="font-title--sm">Quick Breakfast</h2>
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
                </div>
                
                
            </div>
        </div>
    </section>

    
    <section class="banner-sales">
        <div class="container">
            @if($advert->adset->adplan->id == '2')
            <div class="banner-sales__content">
                <img src="{{$advert->image}}" alt="banner" />
                <div class="text-content">
                    
                    <h2 class="font-title--lg">{{$advert->heading}}</h2>
                    <span class="title d-block">{{$advert->subheading}}</span>
                    <div id="countdown" class="countdown-clock">
                        {{$advert->offer}}
                    </div>
                    <a href="{{$advert->url}}" class="button button--md">
                        Shop Now
                        <span>
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                
            </div>
            @else
            <div class="banner-sales__content">
                <img src="{{asset('src/images/banner/banner-lg-17.jpg')}}" alt="banner" />
                <div class="text-content">
                    <span class="title">Limited Offer</span>
                    <h2 class="font-title--lg">Save on Veggies</h2>
                    <div id="countdown" class="countdown-clock"></div>
                    <a href="#" class="button button--md">
                        Shop Now
                        <span>
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="sale-off">
                    <h5>60%</h5>
                    <p>off</p>
                </div>
            </div>
            @endif
        </div>
    </section>


    <section class="banner banner--01">
        <div class="container">
            <!-- Desktop Version -->
            <div class="banner__wrapper row">
                <div class="col-lg-8">
                    <div class="swiper-container banner-slider--one">
                        <div class="swiper-wrapper">
                            @if($advert->adset->adplan->id == '1')
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="{{$advert->image}}" alt="banner" />

                                    <div class="banner__wrapper-text" style="max-width: 400px;">
                                        <h2 class="font-title--xl w-100" style="max-width: 100% !important">
                                            {{$advert->heading}}
                                        </h2>
                                        <div class="sale-off">
                                            <h5 class="font-body--xl-500 w-100" style="max-width: 80% !important">{{$advert->subheading}}</h5>
                                        </div>
                                        <a href="{{$advert->url}}" class="button button--md">
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
                            @else
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="{{asset('src/images/banner/banner-lg-03.jpg')}}" alt="banner" />

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
                            @endif
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="{{asset('src/images/banner/banner-lg-03.jpg')}}" alt="banner" />

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
                                    <img src="{{asset('src/images/banner/banner-lg-03.jpg')}}" alt="banner" />

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
                        </div>
                        {{-- <div class="swiper-pagination"></div> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="banner__wrapper-img-sm">
                        @if ($advert->adset->adplan->id == '5')
                        <div class="banner__wrapper-img banner__wrapper--img-02">
                            <img src="{{$advert->image}}" alt="banner" />

                            <div class="banner__wrapper-text">
                                {{-- <h5 class="font-body--md-500">Summer Sale</h5> --}}
                                <h2 class="font-title--sm">{{$advert->heading}}</h2>
                                <p class="font-body--md-400">{{$advert->subheading}}</p>
                                <a href="{{$advert->url}}" class="button button--md">
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
                        @else
                        <div class="banner__wrapper-img banner__wrapper--img-02">
                            <img src="{{asset('src/images/banner/banner-sm-05.png')}}" alt="banner" />

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
                        @endif
                        <div class="banner__wrapper-img banner__wrapper--img-03">
                            <img src="{{asset('src/images/banner/banner-sm-04.png')}}" alt="banner" />

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
                       
                        
                    </div>
                </div>
            </div>
            <!-- Mobile Version  -->
        </div>
    </section>


@endsection

@push('scripts')
<script src="{{asset('src/js/home2.js')}}"></script>

@endpush
