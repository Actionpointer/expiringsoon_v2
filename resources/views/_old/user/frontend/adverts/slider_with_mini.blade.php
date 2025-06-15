<section class="banner banner--01">
    <div class="container">
        <!-- Desktop Version -->
        <div class="banner__wrapper row">
            <div class="col-lg-8">
                <div class="swiper-container banner-slider--one">
                    <div class="swiper-wrapper">
                        @forelse ($sliders as $slider)
                        <div class="swiper-slide">
                            <div class="banner__wrapper-img banner__wrapper--img-01">
                                <img src="{{$slider->image}}" alt="banner" />

                                <div class="banner__wrapper-text" style="max-width: 400px;">
                                    <h2 class="font-title--xl w-100 @if($slider->text_color == 'white') text-white @else text-dark @endif" style="max-width: 100% !important">
                                        {{$slider->heading}}
                                    </h2>
                                    <div class="sale-off  @if($slider->text_color == 'white') border-white @else border-dark @endif">
                                        <h5 class="font-body--xl-500 w-100 @if($slider->text_color == 'white') text-white @else text-dark @endif" style="max-width: 80% !important">{{$slider->offer}}</h5>
                                        <p class="font-body--md @if($slider->text_color == 'white') text-white @else text-dark @endif">
                                            {{$slider->subheading}}
                                        </p>
                                    </div>
                                    <a href="{{$slider->url}}" class="button button--md @if($slider->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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
                                <img src="{{asset('images/banner/banner-lg-03.jpg')}}" alt="banner" />

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
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="banner__wrapper-img-sm">
                    @for($i = 0;$i < 3;$i++)
                        @if($minis->has($i))
                            <div class="banner__wrapper-img banner__wrapper--img-02">
                                <img src="{{$minis[$i]->image}}" alt="banner" />

                                <div class="banner__wrapper-text">
                                    {{-- <h5 class="font-body--md-500">Summer Sale</h5> --}}
                                    <h2 class="font-title--sm">{{$minis[$i]->heading}}</h2>
                                    <p class="font-body--md-400">{{$minis[$i]->subheading}}</p>
                                    <a href="{{$minis[$i]->url}}" class="button button--md">
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
                            @switch($i)
                                @case(0)
                                <div class="banner__wrapper-img banner__wrapper--img-02">
                                    <img src="{{asset('images/banner/check3.png')}}" alt="banner" />

                                    <div class="banner__wrapper-text">
                                        <h5 class="font-body--md-500">Summer Sale</h5>
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
                                @break
                                @case(1)
                                <div class="banner__wrapper-img banner__wrapper--img-03">
                                    <img src="images/banner/banner-sm-04.png" alt="banner" />

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
                                @break
                            @endswitch
                        @endif
                    @endfor
                    
                </div>
            </div>
        </div>
        <!-- Mobile Version  -->
    </div>
</section>