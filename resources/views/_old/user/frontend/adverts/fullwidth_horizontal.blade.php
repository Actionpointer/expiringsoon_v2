<section class="banner-sales">
    <div class="container">
        @if($advert)
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
        @else
        <div class="banner-sales__content">
            <img src="{{asset('images/banner/banner-lg-17.jpg')}}" alt="banner" />
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