@extends('layouts.app')
@push('styles')
    
@endpush
@section('title')
    Ad Preview
@endsection
@section('main')

    @if(isset($advert_A))
    <section class="banner banner--04">
        <div class="container">
            <div class="swiper-container banner-slider--04">
                <div class="swiper-wrapper">
                    @if(isset($slider))
                    <div class="swiper-slide">
                        <div class="row banner--04__content">
                            <div class="col-lg-6">
                                <div class="banner--04__img-wrapper">
                                    <img src="{{Storage::url($slider->photo)}}" alt="banner" class="img-fluid">
                                    <div class="off-sale">
                                        <p>
                                            <span>80%</span>
                                            off
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner--04__text-content">
                                    <h5 class="title">{{$slider->shop->name}}</h5>
                                    <h2 class="font-title--xxxl">
                                        Fresh &amp; Healthy Organic Food
                                    </h2>

                                    <p class="font-body--md-400">
                                        Free shipping on all your order. we deliver, you enjoy
                                    </p>
                                    <a href="{{route('vendor.show',$slider->shop)}}" class="button button--md">
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
                    <div class="swiper-slide">
                        <div class="row banner--04__content">
                            <div class="col-lg-6">
                                <div class="banner--04__img-wrapper">
                                    <img src="{{asset('src/images/banner/banner-sm-06.png')}}" alt="banner" class="img-fluid">
                                    <div class="off-sale">
                                        <p>
                                            <span>70%</span>
                                            off
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner--04__text-content">
                                    <h5 class="title">Welcome to shopery</h5>
                                    <h2 class="font-title--xxxl">
                                        Fresh &amp; Healthy Organic Food
                                    </h2>
                                    <p class="font-body--md-400">
                                        Free coupons on all your order. we deliver, you enjoy
                                    </p>
                                    <a href="https://shopery.netlify.app/main/home-04.html#" class="button button--md">
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
                <div class="swiper-pagination"></div>
            </div>

            <div class="arrows">
                <button class="arrows__btn swiper-button--prev" tabindex="0" aria-label="Previous slide" aria-controls="swiper-wrapper-fed519ebc3a9f7b3">
                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.25 7.22607H16.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.30005 1.20117L1.25005 7.22517L7.30005 13.2502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <button class="arrows__btn swiper-button--next" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-fed519ebc3a9f7b3">
                    <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>
    @endif

    


    <!-- Advert B  Section Start  -->
    @if(isset($advert_B))
    <section class="cyclone section section--lg section--green-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{Storage::url($prime->photo)}}" alt="banner" />
                            <div class="cards-ss__content text-center">
                                <h6 class="font-body--md-500">{{strtoupper($prime->subheading)}}</h6>
                                <h2 class="font-title--lg">{{$prime->heading}} </h2>

                                <div class="cards-ss__startpackage">
                                    <p>
                                        
                                        <span class="font-body--xxl-600">{{$prime->offer}}</span>
                                    </p>
                                </div>

                                <a href="{{route('vendor.show',$prime->advertable)}}" class="button button--md">
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
    @endif

    @if(isset($advert_C))
    <section class="banner banner--04">
        <div class="container">
            <div class="swiper-container banner-slider--04">
                <div class="swiper-wrapper">
                    @forelse ($advert_C as $item)                    
                        <div class="swiper-slide">
                            <div class="row banner--04__content">
                                <div class="col-lg-6">
                                    <div class="banner--04__img-wrapper">
                                        <img src="{{Storage::url($item->shop->banner)}}" alt="banner" class="img-fluid" />
                                        {{-- 
                                            <div class="off-sale">
                                                <p>
                                                    <span>70%</span>
                                                    off
                                                </p>
                                            </div> 
                                        --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner--04__text-content">
                                        <h5 class="title">Welcome to </h5>
                                        <h2 class="font-title--xxxl">
                                            {{$item->shop->name}}
                                        </h2>
                                        <p class="font-body--md-400">
                                            {{$item->shop->description}}
                                        </p>
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
                        </div>
                    @empty               
                        <div class="swiper-slide">
                            <div class="row banner--04__content">
                                <div class="col-lg-6">
                                    <div class="banner--04__img-wrapper">
                                        <img src="src/images/banner/banner-sm-12.png" alt="banner" class="img-fluid" />
                                        <div class="off-sale">
                                            <p>
                                                <span>50%</span>
                                                off
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner--04__text-content">
                                        <h5 class="title">Welcome to shopery</h5>
                                        <h2 class="font-title--xxxl">
                                            Fresh & Healthy Organic Food
                                        </h2>

                                        <p class="font-body--md-400">
                                            Free shipping on all your order. we deliver, you enjoy
                                        </p>
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
                        <div class="swiper-slide">
                            <div class="row banner--04__content">
                                <div class="col-lg-6">
                                    <div class="banner--04__img-wrapper">
                                        <img src="src/images/banner/banner-sm-06.png" alt="banner" class="img-fluid" />
                                        <div class="off-sale">
                                            <p>
                                                <span>80%</span>
                                                off
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner--04__text-content">
                                        <h5 class="title">Welcome to shopery</h5>
                                        <h2 class="font-title--xxxl">
                                            Fresh & Healthy Organic Food
                                        </h2>
    
                                        <p class="font-body--md-400">
                                            Free shipping on all your order. we deliver, you enjoy
                                        </p>
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
                    @endforelse
                    
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="arrows">
                <button class="arrows__btn swiper-button--prev">
                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.25 7.22607H16.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.30005 1.20117L1.25005 7.22517L7.30005 13.2502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="arrows__btn swiper-button--next">
                    <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
    @endif

    @if(isset($advert_D))
    <section class="section section--xxl sales-banner--two">
        <div class="container">
            <div class="row">
                @forelse($advert_D as $advert)
                    <div class="col-lg-6">
                        <div class="banner-sale--two cards-ss--md">
                            <div class="banner-sale--two__img-wrapper">
                                <img src="{{Storage::url($advert->shop->banner)}}" alt="banner">
                                <div class="banner-sale--two__text-content">
                                    {{-- <span class="title">100% Organic</span> --}}
                                    <h5 class="font-title--md">{{$advert->shop->name}}</h5>
                                    <p class="font-body--md-400">{{$advert->shop->description}}</p>
                                    <a href="{{route('vendor.show',$advert->shop)}}" class="button button--md">
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
                @empty
                    <div class="col-lg-6">
                        <div class="banner-sale--two cards-ss--md">
                            <div class="banner-sale--two__img-wrapper">
                                <img src="src/images/banner/banner-sm-15.png" alt="banner">
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
                    <div class="col-lg-6">
                        <div class="banner-sale--two cards-ss--md">
                            <div class="banner-sale--two__img-wrapper">
                                <img src="src/images/banner/banner-sm-14.png" alt="banner">
                                <div class="banner-sale--two__text-content">
                                    <span class="title">sale off the week</span>
                                    <h5 class="font-title--md">Sales of the Year</h5>

                                    <div class="banner-sale__countdown syotimer timer" id="countdownTwo"><div class="timer-head-block"></div><div class="timer-body-block"><p style="font-size: 1.2em;">The countdown is finished!</p></div><div class="timer-foot-block"></div></div>

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
                @endforelse

                @forelse($advert_E as $advert)
                    <div class="col-lg-4 col-md-6">
                        <div class="cards-ss cards-ss--md cards-ss--md-three">
                            <div class="cards-ss--md__img-wrapper">
                                <img src="src/images/banner/banner-sm-11.png" alt="banner-sale" />
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
                @empty
                    <div class="col-lg-4 col-md-6">
                        <div class="cards-ss cards-ss--md cards-ss--md-one">
                            <div class="cards-ss--md__img-wrapper">
                                <img src="src/images/banner/banner-sm-09.png" alt="banner-sale" />
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
                    <div class="col-lg-4 col-md-6">
                        <div class="cards-ss cards-ss--md cards-ss--md-two">
                            <div class="cards-ss--md__img-wrapper">
                                <img src="src/images/banner/banner-sm-10.png" alt="banner-sale" />
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
                                <img src="src/images/banner/banner-sm-11.png" alt="banner-sale" />
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
                @endforelse
                
                
            </div>
        </div>
    </section>
    @endif

    @if(isset($advert_F))
    <section class="banner-sales">
        <div class="container">
            @if($prime)
            <div class="banner-sales__content">
                <img src="{{Storage::url($prime->shop->banner)}}" alt="banner" />
                <div class="text-content">
                    
                    <h2 class="font-title--lg">{{$prime->shop->name}}</h2>
                    <span class="title d-block">{{$prime->shop->description}}</span>
                    {{-- <div id="countdown" class="countdown-clock"></div> --}}
                    <a href="{{route('vendor.show',$prime->shop)}}" class="button button--md">
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
    @endif

    @if(isset($advert_G ))
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
    @endif

@endsection

@push('scripts')
<script src="{{asset('src/js/home2.js')}}"></script>

@endpush
