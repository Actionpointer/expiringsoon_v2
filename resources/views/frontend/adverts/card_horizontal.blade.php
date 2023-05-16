<section class="banner-sales section section--lg">
    <div class="container">
        <div class="row">
            @for($i = 0;$i < 2;$i++)
                @if($ads->has($i))
                <div class="col-lg-6">
                    <div class="banner-sale--two cards-ss--md">
                        <div class="banner-sale--two__img-wrapper">
                            <img src="{{$ads[$i]->image}}" alt="banner">
                            <div class="banner-sale--two__text-content">
                                {{-- <span class="title">100% Organic</span> --}}
                                <h5 class="font-title--md">{{$ads[$i]->heading}}</h5>
                                <p class="font-body--md-400">{{$ads[$i]->subheading}}</p>
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
                    @switch($i)
                        @case(0)
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
                        @break
                        @case(1)
                            <div class="col-lg-6">
                                <div class="banner-sale--two cards-ss--md">
                                    <div class="banner-sale--two__img-wrapper">
                                        <img src="src/images/banner/banner-sm-14.png" alt="banner">
                                        <div class="banner-sale--two__text-content">
                                            <span class="title">sale off the week</span>
                                            <h5 class="font-title--md">Sales of the Year</h5>

                                            <div class="banner-sale__countdown syotimer timer" id="countdownTwo">
                                                {{-- <div class="timer-head-block"></div>
                                                <div class="timer-body-block">
                                                    <p style="font-size: 1.2em;">The countdown is finished!</p>
                                                </div>
                                                <div class="timer-foot-block"></div> --}}
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
                        @break
                    @endswitch
                @endif
            @endfor 
        </div>
    </div>
</section>