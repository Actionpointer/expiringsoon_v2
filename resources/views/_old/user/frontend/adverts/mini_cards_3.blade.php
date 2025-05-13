<section class="section section--lg sales-banner--two">
    <div class="container">
        <div class="row">
            @for($i = 0;$i < 3;$i++)
                @if($ads->has($i))
                <div class="col-lg-4 col-md-6">
                    <div class="cards-ss cards-ss--md cards-ss--md-three">
                        <div class="cards-ss--md__img-wrapper">
                            <img src="{{$ads[$i]->image}}" alt="banner-sale" />
                            <div class="cards-ss--md__text-content">
                                <h5 class="@if($ads[$i]->text_color == 'white') text-white @else text-dark @endif">{{$ads[$i]->subheading}}</h5>
                                <h2 class="font-title--sm @if($ads[$i]->text_color == 'white') text-white @else text-dark @endif">{{$ads[$i]->heading}}</h2>
                                <a href="{{$ads->url}}" class="button button--md @if($ads[$i]->button_color == 'white') bg-white text-success @else bg-success text-white @endif">
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
                        <div class="col-lg-4 col-md-6">
                            <div class="cards-ss cards-ss--md cards-ss--md-one">
                                <div class="cards-ss--md__img-wrapper">
                                    <img src="images/banner/banner-sm-09.png" alt="banner-sale" />
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
                        @break
                        @case(1)
                        <div class="col-lg-4 col-md-6">
                            <div class="cards-ss cards-ss--md cards-ss--md-two">
                                <div class="cards-ss--md__img-wrapper">
                                    <img src="images/banner/banner-sm-10.png" alt="banner-sale" />
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
                        @break
                        @case(2)
                        <div class="col-lg-4 col-md-6">
                            <div class="cards-ss cards-ss--md cards-ss--md-three">
                                <div class="cards-ss--md__img-wrapper">
                                    <img src="images/banner/banner-sm-11.png" alt="banner-sale" />
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
                        @break
                    @endswitch
                @endif
            @endfor 
        </div>
    </div>
</section>