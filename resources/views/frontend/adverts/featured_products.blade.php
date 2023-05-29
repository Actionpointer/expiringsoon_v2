<section class="section" style="margin-bottom:30px">
    <div class="container">
        <div class="row">   
            <div class="col-lg-12" style="margin-top:30px">
                
                <div class="section__head">
                    <h2 class="section--title-one font-title--sm">Featured Products</h2>
                    @if(Route::currentRouteName() != 'hotdeals')
                    <a href="{{route('hotdeals')}}">
                        View All 
                        <span>
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                    @endif
                </div>
                
                <div class="swiper-container featured-slider--one">
                    <div class="swiper-wrapper">
                        @foreach($features as $featured)
                            <div class="swiper-slide">
                                <div class="cards-md w-100">
                                    <div class="cards-md__img-wrapper">
                                        <a href="{{route('featured.click',$featured)}}">
                                            <img src="{{$featured->image}}" alt="{{$featured->product->name}}" />
                                        </a>
                                        @if($featured->product->price > $featured->product->amount)
                                            <span class="tag blue font-body--md-400">sale {{floor($featured->product->discount)}}% off </span>
                                        @endif
                                        @if($featured->product->stock == 0)
                                            <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                        @endif
                                        @if(Auth::check() && !$featured->product->likes->where('user_id',Auth::id())->count())
                                            <div class="cards-md__favs-list">
                                                <span class="action-btn">
                                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" id="{{$featured->product->id}}" class="add-to-wish" data-product="{{$featured->product->id}}product">
                                                        <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        @endif

                                        @if(Auth::check() && $featured->product->likes->where('user_id',Auth::id())->count())
                                            <div class="cards-md__favs-list show-heart">
                                                <span class="action-btn liked">
                                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" id2="{{$featured->product->id}}" class="remove-from-wish">
                                                        <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        @endif
                                        
                                    </div>
                                    <div class="cards-md__info d-flex justify-content-between align-items-center">
                                        <a href="{{route('advert.click',$featured)}}" class="cards-md__info-left">
                                            <h6 class="font-body--md-400">{{$featured->product->name}}</h6>
                                            <div class="cards-md__info-price">
                                                @if($featured->product->price > $featured->product->amount)
                                                    <span class="font-body--lg-500">{!!$featured->product->shop->country->currency->symbol!!}{{number_format($featured->product->amount, 0)}}</span>
                                                    <del class="font-body--lg-400" style="color:#00b207">{!!$featured->product->shop->country->currency->symbol!!}{{number_format($featured->product->price, 0)}}</del>
                                                @else
                                                    <span class="font-body--lg-500">{!!$featured->product->shop->country->currency->symbol!!}{{number_format($featured->product->price, 0)}}</span>
                                                @endif
                                            </div>
                                            <ul class="d-flex" style="color:#888;font-size:12px">
                                                <li>Expires in <span style="font-weight:550;color:#d42222">{{$featured->product->expire_at->diffInDays(now())}} days</span><li>
                                            </ul>
                                        </a>
                                        <div class="cards-md__info-right">
                                            <span class="action-btn">
                                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$featured->product->id}}" data-price="{{$featured->product->amount}}" data-product="{{$featured->product->id}}product">
                                                    <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach                               
                    </div>
                    <div class="swiper-pagination featured-pagination"></div>
                </div>
            </div>   
        </div>
    </div>
</section>
