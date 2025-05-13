@extends('layouts.app')
@push('styles')
    
@endpush
@section('title')
    Ad Preview
@endsection
@section('main')


    <!-- Advert B  Section Start  -->
@if($adplan_id == '3')
    <section class="cyclone section section--lg section--green-0 my-4">
        <div class="container">
            <div class="row">

                
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{$advert->image}}" alt="banner" />
                            <div class="cards-ss__content text-center @if($advert->text_color == 'white') text-white @else text-dark @endif">
                                <h6 class="font-body--md-500">{{$advert->subheading}}</h6>
                                <h2 class="font-title--lg">{{$advert->heading}} </h2>
    
                                <div class="cards-ss__saleoff">
                                    <p> <span>{{$advert->offer}}</span></p>
                                </div>
    
                                <a href="{{$advert->url}}" class="button button--md @if($advert->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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
@if($advert->adset->adplan->id == '4')
    <section class="section section--xxl sales-banner--two my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner-sale--two cards-ss--md">
                        <div class="banner-sale--two__img-wrapper">
                            <img src="{{$advert->image}}" alt="banner">
                            <div class="banner-sale--two__text-content">
                                {{-- <span class="title">100% Organic</span> --}}
                                <h5 class="font-title--md @if($advert->text_color == 'white') text-white @else text-dark @endif">{{$advert->heading}}</h5>
                                <p class="font-body--md-400 @if($advert->text_color == 'white') text-white @else text-dark @endif">{{$advert->subheading}}</p>
                                <a href="{{$advert->url}}" class="button button--md @if($advert->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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

@if($advert->adset->adplan->id == '5')
    <section class="section section--xxl sales-banner--two my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="cards-ss cards-ss--md cards-ss--md-three">
                        <div class="cards-ss--md__img-wrapper">
                            <img src="{{$advert->image}}" alt="banner-sale" />
                            <div class="cards-ss--md__text-content">
                                <h5 class="@if($advert->text_color == 'white') text-white @else text-dark @endif">{{$advert->subheading}}</h5>
                                <h2 class="font-title--sm @if($advert->text_color == 'white') text-white @else text-dark @endif">{{$advert->heading}}</h2>
                                <a href="{{$ads->url}}" class="button button--md @if($advert->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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
@if($advert->adset->adplan->id == '2')
    <section class="banner-sales my-4">
        <div class="container">
            <div class="banner-sales__content">
                <img src="{{$advert->image}}" alt="banner" />
                <div class="text-content @if($advert->text_color == 'white') text-white @else text-dark @endif">
                    
                    <h2 class="font-title--lg">{{$advert->heading}}</h2>
                    <span class="title d-block">{{$advert->subheading}}</span>
                    <div class="cards-ss__saleoff">
                        <p> <span>{{$advert->offer}}</span></p>
                    </div>
                    <a href="{{$advert->url}}" class="button button--md @if($advert->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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
        </div>
    </section>
@endif
@if($advert->adset->adplan->id == '1')
    <section class="banner banner--01 my-4">
        <div class="container">
            <!-- Desktop Version -->
            <div class="banner__wrapper row">
                <div class="col-lg-8">
                    <div class="swiper-container banner-slider--one">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="banner__wrapper-img banner__wrapper--img-01">
                                    <img src="{{$advert->image}}" alt="banner" />

                                    <div class="banner__wrapper-text" style="max-width: 400px;">
                                        <h2 class="font-title--xl w-100 @if($advert->text_color == 'white') text-white @else text-dark @endif" style="max-width: 100% !important">
                                            {{$advert->heading}}
                                        </h2>
                                        <div class="sale-off  @if($advert->text_color == 'white') border-white @else border-dark @endif">
                                            <h5 class="font-body--xl-500 w-100 @if($advert->text_color == 'white') text-white @else text-dark @endif" style="max-width: 80% !important">{{$advert->offer}}</h5>
                                            <p class="font-body--md @if($advert->text_color == 'white') text-white @else text-dark @endif">
                                                {{$advert->subheading}}
                                            </p>
                                        </div>
                                        <a href="{{$advert->url}}" class="button button--md @if($advert->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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
                
            </div>
            <!-- Mobile Version  -->
        </div>
    </section>
@endif

@endsection

@push('scripts')
<script src="{{asset('src/js/home2.js')}}"></script>

@endpush
