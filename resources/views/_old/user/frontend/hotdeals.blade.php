@extends('layouts.app')
@push('styles')
    
@endpush
@section('title')
    Hot Deals
@endsection
@section('main')
    
    @include('frontend.adverts.card_horizontal')

    <!-- Our Products Section Start  -->
    <section class="our-products section section--xxl section--green-0">
        <div class="container">
            <div class="section__head section__head--four">
                <h2 class="section--title-four font-title--lg">
                        Hot Deals
                </h2>

                <ul class="our-products__menu nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($highest == 0) active @endif" id="view-tab" data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab" aria-controls="view" aria-selected="false">
                            < 20% off
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($highest == 1) active @endif" id="meat-tab" data-bs-toggle="tab" data-bs-target="#meat" type="button" role="tab" aria-controls="meat" aria-selected="false">
                            20-30% off
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($highest == 2) active @endif" id="fruit-tab" data-bs-toggle="tab" data-bs-target="#fruit" type="button" role="tab" aria-controls="fruit" aria-selected="false">
                            30-40% off
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($highest == 3) active @endif" id="vegetable-tab" data-bs-toggle="tab" data-bs-target="#vegetable" type="button" role="tab" aria-controls="vegetable" aria-selected="false">
                            40-50% off 
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($highest == 4) active @endif" id="All-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                            > 50% off
                        </button>
                    </li>
                </ul>
            </div>

            <div class="our-products__content tab-content" id="myTabContent">

                <!-- <20 -->
                <div class="tab-pane fade @if($highest == 0) show active @endif" id="view" role="tabpanel" aria-labelledby="view-tab">
                    @if($products->where('discount','>',0)->where('discount','<',20)->isNotEmpty())  
                        <!-- Desktop Versions  --> 
                        <div class="our-products__content-items"> 
                            @foreach($products->where('discount','>',0)->where('discount','<',20) as $product)
                            <div class="cards-md cards-md--three">
                                <div class="cards-md__img-wrapper">
                                    <a href="{{route('product.show',$product)}}">
                                        <img src="{{$product->image}}" alt="{{$product->name}}" />
                                    </a>
                                    @if($product->price > $product->amount)
                                        <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                    @endif
                                    @if(!$product->isAvailable())
                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                        <div class="cards-md__favs-list">
                                            <span class="action-btn">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                        <div class="cards-md__favs-list show-heart">
                                            <span class="action-btn liked">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="cards-md__info d-flex justify-content-between align-items-center">
                                    <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                        <h6 class="font-body--md-400">{{$product->name}}</h6>
                                        <div class="cards-md__info-price">
                                            @if($product->price > $product->amount)
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                            @else
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                            @endif
                                        </div>
                                        {{-- <ul class="cards-md__info-rating d-flex">
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#CCCCCC" ></path>
                                                </svg>
                                            </li>
                                        </ul> --}}
                                        <ul class="d-flex" style="color:#888;font-size:12px">
                                            <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                        </ul>
                                    </a>
                                    <div class="cards-md__info-right">
                                        <span class="action-btn">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
                                                <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                </path>
                                            </svg>
                                        </span> 
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Mobile Versions  -->
                        <div class="swiper-container our-products__content-slider">
                            <div class="swiper-wrapper">
                                @foreach($products->where('discount','>',0)->where('discount','<',20) as $product)
                                <div class="swiper-slide">
                                    <div class="cards-md w-100">
                                        <div class="cards-md__img-wrapper">
                                            <a href="{{route('product.show',$product)}}">
                                                <img src="{{$product->image}}" alt="{{$product->name}}" />
                                            </a>
                                            @if($product->price > $product->amount)
                                                <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                            @endif
                                            @if(!$product->isAvailable())
                                                <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                                <div class="cards-md__favs-list">
                                                    <span class="action-btn">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                                <div class="cards-md__favs-list show-heart">
                                                    <span class="action-btn liked">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cards-md__info d-flex justify-content-between align-items-center">
                                            <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                                <h6 class="font-body--md-400">{{$product->name}}</h6>
                                                <div class="cards-md__info-price">
                                                    @if($product->price > $product->amount)
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                        <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                                    @else
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                                    @endif
                                                </div>
                                                
                                                <ul class="d-flex" style="color:#888;font-size:12px">
                                                    <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                                </ul>
                                            </a>
                                            <div class="cards-md__info-right">
                                                <span class="action-btn">
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
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
                            <div class="swiper-pagination"></div>
                        </div> 
                    @else
                        <div class="text-center">
                            <p>No Deal in this category at this time, check again later.</p>
                        </div>
                    @endif
                </div>

                <!-- 20-30 -->
                <div class="tab-pane fade @if($highest == 1) show active @endif" id="meat" role="tabpanel" aria-labelledby="meat-tab">
                    @if($products->whereBetween('discount',[20,30])->isNotEmpty())
                        <!-- Desktop Versions  -->
                        <div class="our-products__content-items">
                            @foreach($products->whereBetween('discount',[20,30]) as $product)
                            <div class="cards-md cards-md--three">
                                <div class="cards-md__img-wrapper">
                                    <a href="{{route('product.show',$product)}}">
                                        <img src="{{$product->image}}" alt="{{$product->name}}" />
                                    </a>
                                    @if($product->price > $product->amount)
                                        <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                    @endif
                                    @if(!$product->isAvailable())
                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                        <div class="cards-md__favs-list">
                                            <span class="action-btn">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                        <div class="cards-md__favs-list show-heart">
                                            <span class="action-btn liked">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="cards-md__info d-flex justify-content-between align-items-center">
                                    <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                        <h6 class="font-body--md-400">{{$product->name}}</h6>
                                        <div class="cards-md__info-price">
                                            @if($product->price > $product->amount)
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                            @else
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                            @endif
                                        </div>
                                        {{-- <ul class="cards-md__info-rating d-flex">
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#FF8A00" ></path>
                                                </svg>
                                            </li>
                                            <li>
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z" fill="#CCCCCC" ></path>
                                                </svg>
                                            </li>
                                        </ul> --}}
                                        <ul class="d-flex" style="color:#888;font-size:12px">
                                            <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                        </ul>
                                    </a>
                                    <div class="cards-md__info-right">
                                        <span class="action-btn">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
                                                <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                </path>
                                            </svg>
                                        </span> 
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Mobile Versions  -->
                        <div class="swiper-container our-products__content-slider">
                            <div class="swiper-wrapper">
                                @foreach($products->whereBetween('discount',[20,30]) as $product)
                                <div class="swiper-slide">
                                    <div class="cards-md w-100">
                                        <div class="cards-md__img-wrapper">
                                            <a href="{{route('product.show',$product)}}">
                                                <img src="{{$product->image}}" alt="{{$product->name}}" />
                                            </a>
                                            @if($product->price > $product->amount)
                                                <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                            @endif
                                            @if(!$product->isAvailable())
                                                <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                                <div class="cards-md__favs-list">
                                                    <span class="action-btn">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                                <div class="cards-md__favs-list show-heart">
                                                    <span class="action-btn liked">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cards-md__info d-flex justify-content-between align-items-center">
                                            <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                                <h6 class="font-body--md-400">{{$product->name}}</h6>
                                                <div class="cards-md__info-price">
                                                    @if($product->price > $product->amount)
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                        <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                                    @else
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                                    @endif
                                                </div>
                                                
                                                <ul class="d-flex" style="color:#888;font-size:12px">
                                                    <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                                </ul>
                                            </a>
                                            <div class="cards-md__info-right">
                                                <span class="action-btn">
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
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
                            <div class="swiper-pagination"></div>
                        </div>
                    @else
                        <div class="text-center">
                            <p>No Deal in this category at this time, check again later.</p>
                        </div>
                    @endif
                </div>

                <!-- 30-40 -->
                <div class="tab-pane fade @if($highest == 2) show active @endif" id="fruit" role="tabpanel" aria-labelledby="fruit-tab">
                    @if($products->whereBetween('discount',[30,40])->isNotEmpty())
                        <!-- Desktop Versions  -->
                        <div class="our-products__content-items">
                            @foreach($products->whereBetween('discount',[30,40]) as $product)
                            <div class="cards-md cards-md--three">
                                <div class="cards-md__img-wrapper">
                                    <a href="{{route('product.show',$product)}}">
                                        <img src="{{$product->image}}" alt="{{$product->name}}" />
                                    </a>
                                    @if($product->price > $product->amount)
                                        <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off </span>
                                    @endif
                                    @if(!$product->isAvailable())
                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                        <div class="cards-md__favs-list">
                                            <span class="action-btn">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                        <div class="cards-md__favs-list show-heart">
                                            <span class="action-btn liked">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="cards-md__info d-flex justify-content-between align-items-center">
                                    <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                        <h6 class="font-body--md-400">{{$product->name}}</h6>
                                        <div class="cards-md__info-price">
                                            @if($product->price > $product->amount)
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                            @else
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                            @endif
                                        </div>
                                        
                                        <ul class="d-flex" style="color:#888;font-size:12px">
                                            <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                        </ul>
                                    </a>
                                    <div class="cards-md__info-right">
                                        <span class="action-btn">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
                                                <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                </path>
                                            </svg>
                                        </span> 
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Mobile Versions  -->
                        <div class="swiper-container our-products__content-slider">
                            <div class="swiper-wrapper">
                                @foreach($products->whereBetween('discount',[30,40]) as $product)
                                <div class="swiper-slide">
                                    <div class="cards-md w-100">
                                        <div class="cards-md__img-wrapper">
                                            <a href="{{route('product.show',$product)}}">
                                                <img src="{{$product->image}}" alt="{{$product->name}}" />
                                            </a>
                                            @if($product->price > $product->amount)
                                                <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                            @endif
                                            @if(!$product->isAvailable())
                                                <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                                <div class="cards-md__favs-list">
                                                    <span class="action-btn">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                                <div class="cards-md__favs-list show-heart">
                                                    <span class="action-btn liked">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cards-md__info d-flex justify-content-between align-items-center">
                                            <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                                <h6 class="font-body--md-400">{{$product->name}}</h6>
                                                <div class="cards-md__info-price">
                                                    @if($product->price > $product->amount)
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                        <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                                    @else
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                                    @endif
                                                </div>
                                                
                                                <ul class="d-flex" style="color:#888;font-size:12px">
                                                    <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                                </ul>
                                            </a>
                                            <div class="cards-md__info-right">
                                                <span class="action-btn">
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
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
                            <div class="swiper-pagination"></div>
                        </div>
                    @else
                        <div class="text-center">
                            <p>No Deal in this category at this time, check again later.</p>
                        </div>
                    @endif
                </div>

                <!-- 40-50  -->
                <div class="tab-pane fade @if($highest == 3) show active @endif" id="vegetable" role="tabpanel" aria-labelledby="vegetable-tab">
                    @if($products->whereBetween('discount',[40,50])->isNotEmpty())
                        
                        <!-- Desktop Versions  -->
                        <div class="our-products__content-items">
                            @foreach($products->whereBetween('discount',[40,50]) as $product)
                            <div class="cards-md cards-md--three">
                                <div class="cards-md__img-wrapper">
                                    <a href="{{route('product.show',$product)}}">
                                        <img src="{{$product->image}}" alt="{{$product->name}}" />
                                    </a>
                                    @if($product->price > $product->amount)
                                        <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                    @endif
                                    @if(!$product->isAvailable())
                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                        <div class="cards-md__favs-list">
                                            <span class="action-btn">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                        <div class="cards-md__favs-list show-heart">
                                            <span class="action-btn liked">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="cards-md__info d-flex justify-content-between align-items-center">
                                    <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                        <h6 class="font-body--md-400">{{$product->name}}</h6>
                                        <div class="cards-md__info-price">
                                            @if($product->price > $product->amount)
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                            @else
                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                            @endif
                                        </div>
                                        
                                        <ul class="d-flex" style="color:#888;font-size:12px">
                                            <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                        </ul>
                                    </a>
                                    <div class="cards-md__info-right">
                                        <span class="action-btn">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
                                                <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                </path>
                                            </svg>
                                        </span> 
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Mobile Versions  -->
                        <div class="swiper-container our-products__content-slider">
                            <div class="swiper-wrapper">
                                @foreach($products->whereBetween('discount',[40,50]) as $product)
                                <div class="swiper-slide">
                                    <div class="cards-md w-100">
                                        <div class="cards-md__img-wrapper">
                                            <a href="{{route('product.show',$product)}}">
                                                <img src="{{$product->image}}" alt="{{$product->name}}" />
                                            </a>
                                            @if($product->price > $product->amount)
                                                <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                            @endif
                                            @if(!$product->isAvailable())
                                                <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                                <div class="cards-md__favs-list">
                                                    <span class="action-btn">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                                <div class="cards-md__favs-list show-heart">
                                                    <span class="action-btn liked">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cards-md__info d-flex justify-content-between align-items-center">
                                            <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                                <h6 class="font-body--md-400">{{$product->name}}</h6>
                                                <div class="cards-md__info-price">
                                                    @if($product->price > $product->amount)
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                        <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                                    @else
                                                        <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                                    @endif
                                                </div>
                                                
                                                <ul class="d-flex" style="color:#888;font-size:12px">
                                                    <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                                </ul>
                                            </a>
                                            <div class="cards-md__info-right">
                                                <span class="action-btn">
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
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
                            <div class="swiper-pagination"></div>
                        </div>
                        
                    @else
                        <div class="text-center">
                            <p>No Deal in this category at this time, check again later.</p>
                        </div>
                    @endif
                </div>

                <!-- >50 -->
                <div class="tab-pane fade @if($highest == 4) show active @endif" id="all" role="tabpanel" aria-labelledby="All-tab">
                    @if($products->where('discount','>',50)->isNotEmpty())
                            <!-- Desktop Versions  -->
                            <div class="our-products__content-items">
                                @foreach($products->where('discount','>',50) as $product)
                                <div class="cards-md cards-md--three">
                                    <div class="cards-md__img-wrapper">
                                        <a href="{{route('product.show',$product)}}">
                                            <img src="{{$product->image}}" alt="{{$product->name}}" />
                                        </a>
                                        @if($product->price > $product->amount)
                                            <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                        @endif
                                        @if(!$product->isAvailable())
                                            <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                        @endif
                                        @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                            <div class="cards-md__favs-list">
                                                <span class="action-btn">
                                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                        <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        @endif
                                        @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                            <div class="cards-md__favs-list show-heart">
                                                <span class="action-btn liked">
                                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                        <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="cards-md__info d-flex justify-content-between align-items-center">
                                        <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                            <h6 class="font-body--md-400">{{$product->name}}</h6>
                                            <div class="cards-md__info-price">
                                                @if($product->price > $product->amount)
                                                    <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                    <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                                @else
                                                    <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                                @endif
                                            </div>
                                            
                                            <ul class="d-flex" style="color:#888;font-size:12px">
                                                <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                            </ul>
                                        </a>
                                        <div class="cards-md__info-right">
                                            <span class="action-btn">
                                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
                                                    <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                    </path>
                                                </svg>
                                            </span> 
                                        </div>
                                    </div>
                                </div>  
                                @endforeach                  
                            </div>
                            <!-- Mobile Versions  -->
                            <div class="swiper-container our-products__content-slider">
                                <div class="swiper-wrapper">
                                    @foreach($products->where('discount','>',50) as $product)
                                        <div class="swiper-slide">
                                            <div class="cards-md w-100">
                                                <div class="cards-md__img-wrapper">
                                                    <a href="{{route('product.show',$product)}}">
                                                        <img src="{{$product->image}}" alt="{{$product->name}}" />
                                                    </a>
                                                    @if($product->price > $product->amount)
                                                        <span class="tag blue font-body--md-400">sale {{floor($product->discount)}}% off</span>
                                                    @endif
                                                    @if(!$product->isAvailable())
                                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                                    @endif
                                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                                                        <div class="cards-md__favs-list">
                                                            <span class="action-btn">
                                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                                                        <div class="cards-md__favs-list show-heart">
                                                            <span class="action-btn liked">
                                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="cards-md__info d-flex justify-content-between align-items-center">
                                                    <a href="{{route('product.show',$product)}}" class="cards-md__info-left">
                                                        <h6 class="font-body--md-400">{{$product->name}}</h6>
                                                        <div class="cards-md__info-price">
                                                            @if($product->price > $product->amount)
                                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                                                <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del>
                                                            @else
                                                                <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</span>
                                                            @endif
                                                        </div>
                                                        
                                                        <ul class="d-flex" style="color:#888;font-size:12px">
                                                            <li>Expires in <span style="font-weight:550;color:#d42222">{{$product->expire_at->diffInDays(now())}} days</span><li>                                           
                                                        </ul>
                                                    </a>
                                                    <div class="cards-md__info-right">
                                                        <span class="action-btn">
                                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product">
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
                                <div class="swiper-pagination"></div>
                            </div>
                           
                    @else
                        <div class="text-center">
                            <p>No Deal in this category at this time, check again later.</p>
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    </section>
    <!-- Our Products Section end   -->
    @include('frontend.adverts.mini_cards_3')

    <section class="best-deals section section--xxl section--green-0">
        <div class="container">
            <div class="best-deals__content">
                <span class="title">Best Deals</span>
                <h2 class="font-title--lg">Our Special Products Deal of the Month</h2>
    
                <div class="best-deals__countdown syotimer timer" id="countdownTwo">
                    
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
    
                <div class="best-deals__img-content">
                    <div class="best-deals__img-content--one">
                        <img src="{{asset('images/banner/banner-sm-06.png')}}" alt="banner-sm">
                    </div>
                    <div class="best-deals__img-content--two">
                        <img src="{{asset('images/banner/banner-sm-13.png')}}" alt="banner-sm">
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    @if($features->count())
        @include('frontend.adverts.featured_products')
    @endif  
    <!-- featureds  end  -->

@endsection

@push('scripts')
<script src="{{asset('src/js/home4.js')}}"></script>
@include('layouts.front')
@endpush
