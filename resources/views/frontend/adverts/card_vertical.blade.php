<section class="cyclone section section--lg section--green-0">
    <div class="container">
        <div class="row">
            @for($i = 0;$i < 3;$i++)
                @if($ads->has($i))
                <div class="col-xl-4 col-md-6">
                    <div class="cards-ss cards-ss--lg">
                        <div class="cards-ss__img-wrapper">
                            <img src="{{$ads[$i]->image}}" alt="banner" />
                            <div class="cards-ss__content text-center">
                                <h6 class="font-body--md-500">{{$ads[$i]->subheading}}</h6>
                                <h2 class="font-title--lg">{{$ads[$i]->heading}} </h2>
    
                                <div id="countdownTwo" class="countdown-clock"></div>
    
                                <a href="shop.php" class="button button--md">
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
                            <div class="col-xl-4 col-md-6">
                                <div class="cards-ss cards-ss--lg">
                                    <div class="cards-ss__img-wrapper">
                                        <img src="{{asset('src/images/banner/banner-sm-03.png')}}" alt="banner" />
                                        <div class="cards-ss__content text-center">
                                            <h6 class="font-body--md-500">BEST DEALS</h6>
                                            <h2 class="font-title--lg">Limited Offer </h2>
                
                                            <div id="countdownTwo" class="countdown-clock"></div>
                
                                            <a href="shop.php" class="button button--md">
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
                        @break
                        @case(2)
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
                        @break
                    @endswitch
                @endif   
            @endfor 
        </div>
    </div>
</section>