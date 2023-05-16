<section class="banner-sales section section--lg">
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
            @endforelse 
        </div>
    </div>
</section>