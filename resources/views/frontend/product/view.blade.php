@extends('layouts.app')
@push('styles')
<meta property="og:title" content="{{$product->name}} | {{floor($product->discount)}}% off | Buy Now at: {!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}">
<meta property="og:type" content="article" />
<meta property="og:image" content="{{$product->image}}">
<meta property="og:description" content="Get unbeatable discount offers on all products at https://expiringsoon.shop. Buy {{$product->name}} at {{floor($product->discount)}}% off normal price. Buy Now while stock last">
<meta property="og:url" content="{{route('product.show',$product)}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@site_username">
<meta name="twitter:title" content="{{$product->name}} | {{floor($product->discount)}}% off | Buy Now at: {!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}">
<meta name="twitter:description" content="Get unbeatable discount offers on all products at https://expiringsoon.shop. Buy {{$product->name}} at {{floor($product->discount)}}% off normal price. Buy Now while stock last">
<meta name="twitter:creator" content="@creator_username">
<meta name="twitter:image" content="{{$product->image}}">
<meta name="twitter:domain" content="https://expiringsoon.shop">
@endpush
@section('title') {{$product->name}} @endsection
@section('main')
    <!-- breedcrumb section start  -->
    <div class="section breedcrumb">
        <div class="breedcrumb__img-wrapper">
            <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
            <div class="container">
                <ul class="breedcrumb__content">
                    <li>
                        <a href="{{route('index')}}">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                                    stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span> > </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('product.list')}}">
                            Shop
                            <span> > </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('product.list')}}?cat={{$product->category}}">
                            {{$product->category->name}}
                            <span> > </span>
                        </a>
                    </li>
                    <li class="active"><a href="#">{{$product->name}}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breedcrumb section end -->

    <!-- Products View Section Start  -->
    <section class="products section">
        <div class="container">
            <div class="row" style="margin-top: 32px;">
                <div class="col-lg-6">
                    <!-- Product View Slider -->
                    <div class="gallery-view">
                        <div class="gallery-items">
                        </div>

                        <div class="gallery-main-image products__gallery-img--lg">
                            <img class="product-main-image" src="{{Storage::url($product->photo)}}" alt="Slide 01" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Products information -->
                    <div class="products__content">
                        <div class="products__content-title">
                            <h2 class="font-title--md" style="font-size:20px">{{$product->name}}</h2>
                            @if($product->stock > 0)
                            <span class="label stock-in">{{$product->stock}} in Stock</span>
                          @else
                            <span class="label stock-out">Out of Stock</span>
                          @endif
                        </div>

                        <div class="products__content-price">
                          @if($product->expire_at && $product->expire_at->diffInDays(now()) < 120)
                            <h2 class="font-body--xxxl-500">
                                <del class="font-body--xxl-400">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 0)}}</del> 
                                {!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</h2>
                            <span class="label sale-off">{{floor($product->discount)}}% off </span>
                          @else
                            <h2 class="font-body--xxxl-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->price, 2)}}</h2>
                          @endif
                        </div>
                    </div>
                    <!-- brand  -->
                    <div class="products__content">
                        <div class="products__content-brand">
                            <div class="brand-name">
                                <h2 class="font-body--md-400">Vendor:<br />
                                <a href="{{route('vendor.show',$product->shop)}}" style="color:#00b207;font-weight:500">{{$product->shop->username}}</a></h2>
                                <a href="{{route('vendor.show',$product->shop)}}" class="brand-name-logo">
                                    <img @if(!$product->shop->banner) src="{{asset('src/images/site/avatar.png')}}"  @else src="{{Storage::url($product->shop->banner)}}" @endif alt="{{$product->shop->username}}" style="width:45px;border-radius:50px;border:1px solid #bababa;padding:2px" />
                                </a>
                            </div>
                            <div class="social-site">
                                <h2 class="font-body--md-400">Share item:</h2>
                                <ul class="social-icon">
                                    <li class="social-icon-link">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('product.show',$product)}}" 
                                        target="_blank"
                                        rel="noopener noreferrer" >
                                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.99764 2.98875H9.64089V0.12675C9.35739 0.08775 8.38239 0 7.24689 0C4.87764 0 3.25464 1.49025 3.25464 4.22925V6.75H0.640137V9.9495H3.25464V18H6.46014V9.95025H8.96889L9.36714 6.75075H6.45939V4.5465C6.46014 3.62175 6.70914 2.98875 7.99764 2.98875Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="social-icon-link">
                                        <a href="https://twitter.com/intent/tweet?text=Get Discount on {{$product->name}} at {{route('product.show',$product)}}" target="_blank" rel="noopener noreferrer">
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 2.41888C17.3306 2.7125 16.6174 2.90713 15.8737 3.00163C16.6388 2.54488 17.2226 1.82713 17.4971 0.962C16.7839 1.38725 15.9964 1.68763 15.1571 1.85525C14.4799 1.13413 13.5146 0.6875 12.4616 0.6875C10.4186 0.6875 8.77387 2.34575 8.77387 4.37863C8.77387 4.67113 8.79862 4.95238 8.85938 5.22013C5.7915 5.0705 3.07687 3.60013 1.25325 1.36025C0.934875 1.91263 0.748125 2.54488 0.748125 3.2255C0.748125 4.5035 1.40625 5.63638 2.38725 6.29225C1.79437 6.281 1.21275 6.10888 0.72 5.83775C0.72 5.849 0.72 5.86363 0.72 5.87825C0.72 7.6715 1.99912 9.161 3.6765 9.50413C3.37612 9.58625 3.04875 9.62563 2.709 9.62563C2.47275 9.62563 2.23425 9.61213 2.01038 9.56263C2.4885 11.024 3.84525 12.0984 5.4585 12.1333C4.203 13.1154 2.60888 13.7071 0.883125 13.7071C0.5805 13.7071 0.29025 13.6936 0 13.6565C1.63462 14.7106 3.57188 15.3125 5.661 15.3125C12.4515 15.3125 16.164 9.6875 16.164 4.81175C16.164 4.64863 16.1584 4.49113 16.1505 4.33475C16.8829 3.815 17.4982 3.16588 18 2.41888Z"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="social-icon-link">
                                        <a target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/shareArticle?mini=false&url={{route('product.show',$product)}}&title={{$product->name}}&summary=Get unbeatable discount offers on all products at https://expiringsoon.shop. Buy {{$product->name}} at {{floor($product->discount)}}% off normal price. Buy Now while stock last&source=ExpiringSoon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"> <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/> </svg>
                                        </a>
                                    </li>
                                    <li class="social-icon-link">
                                        <a target="_blank" rel="noopener noreferrer" href="https://api.whatsapp.com/send?text=Check%20out%20this%20unbeliavable%20discount%20on%20{{$product->name}}%20at%20{{route('product.show',$product)}}/">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/> </svg>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <p class="products__content-brand-info font-body--md-400">{{$product->description}}</p>
                        
                    </div>
                    <!-- Action button -->
                    <div class="products__content">
                        <div class="products__content-action">
                            <div class="counter-btn-wrapper products__content-action-item">

                                <button class="counter-btn-dec counter-btn" id="minusBtn" onclick="decrement()">
                                    -
                                </button>
                                <input type="number" name="qty" id="counter-btn-counter" class="counter-btn-counter" min="0" max="1000" value="1" />
                                <button class="counter-btn-inc counter-btn" id="plusBtn" onclick="increment()">
                                    +
                                </button>
                            </div>
                            <!-- add to cart  -->
                            <form method="post" id="addtocart">
                            <input type="hidden" name="pid" id="product_id" value="{{$product->id}}">
                            @if(!$product->isAvailable())
                              <button type="button" class="button button--md products__content-action-item button--disable">
                              @else
                                
                                <button type="button" class="button button--md products__content-action-item" id="addbtn" data-price="{{$product->price}}" data-product="{{$product->name}}" data-photo="{{$product->photo}}">
                                @endif
                                Add to Cart
                                <span>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.66667 7.33333H3.16667L1.5 16.5H16.5L14.8333 7.33333H12.3333M5.66667 7.33333V4.83333C5.66667 2.99239 7.15905 1.5 9 1.5V1.5C10.8409 1.5 12.3333 2.99238 12.3333 4.83333V7.33333M5.66667 7.33333H12.3333M5.66667 7.33333V9.83333M12.3333 7.33333V9.83333"
                                            stroke="currentColor"
                                            stroke-width="1.3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </span>
                            </button>
                          
                          </form>

                            <!-- fav  -->
                            {{-- <button class="button-fav products__content-action-item">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.9996 17.5451C-6.66672 8.33336 4.99993 -1.66664 9.9996 4.65674C14.9999 -1.66664 26.6666 8.33336 9.9996 17.5451Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </button> --}}

                            {{-- <span class="action-btn liked">
                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                </svg>
                            </span> --}}
                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 0)
                               
                                    <span class="action-btn">
                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </span>
                                
                            @endif
                            @if(Auth::check() && $product->likes->where('user_id',Auth::id())->count() == 1)
                            <span class="action-btn liked">
                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove-from-wish" data-product="{{$product->id}}product">
                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                </svg>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- Tags  -->
                    <div class="products__content">
                        <h5 class="products__content-category font-body--md-500">Category: <a href="{{route('product.list')}}?category_id={{$product->category_id}}">{{$product->category->name}}</a></h5>
                        @if($product->tags && count($product->tags))
                        <div class="products__content-tags">
                            <h5 class="font-body--md-500">Tag :</h5>
                            <div class="products__content-tags-item">
                                @foreach ($product->tags as $tag)
                                    <a href="{{route('product.list')}}?tag={{$tag}}" class="font-body--md-400">{{$tag}}</a>
                                @endforeach
                                
                                
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Products View Section end  -->
    <!-- Related Product Section   Start  -->
    <section class="products-tab section section--xl">
        <div class="products-tab__btn">
            <div class="container">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                            Product Timeline
                        </button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false">
                            Product Review
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="products-tab__content">
            <div class="container">
                <div class="tab-content" id="pills-tabContent">
                    <!-- Products Description  -->
                    <div class="tab-pane fade active show" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                        <div class="row products-tab__description">
                            <div class="col-lg-6 order-lg-0 order-2">
                                <ul class="products-tab__information-list">
                                    <li>
                                        <h5 class="title">Expiry Date:</h5>
                                        <p class="title-description">{{$product->expire_at->format('jS M,Y')}}</p>
                                    </li>
                                </ul>
                                <table class="table table-bordered ">
                                    <tr>
                                        <th></th>
                                        <th style="width:200px">Period</th>
                                        <th style="width:30px">Discount</th>
                                        <th>Price</th>
                                        <th style="width:20px">Remaining</th>
                                    </tr>
                                    <tr>
                                        <td> 
                                            @if($product->timeline == 30)
                                                <span class="icon">
                                                    <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/2000/svg" fill="currentColor">
                                                        <path stroke="#00b207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12.0000002,1.99896738 C17.523704,1.99896738 22.0015507,6.47681407 22.0015507,12.0005179 C22.0015507,17.5242217 17.523704,22.0020684 12.0000002,22.0020684 C6.47629639,22.0020684 1.99844971,17.5242217 1.99844971,12.0005179 C1.99844971,6.47681407 6.47629639,1.99896738 12.0000002,1.99896738 Z M12.0000002,3.49896738 C7.30472352,3.49896738 3.49844971,7.30524119 3.49844971,12.0005179 C3.49844971,16.6957946 7.30472352,20.5020684 12.0000002,20.5020684 C16.6952769,20.5020684 20.5015507,16.6957946 20.5015507,12.0005179 C20.5015507,7.30524119 16.6952769,3.49896738 12.0000002,3.49896738 Z M11.9965637,5.99896738 C15.3092306,5.99896738 17.9946777,8.68441449 17.9946777,11.9970814 C17.9946777,15.3097483 15.3092306,17.9951954 11.9965637,17.9951954 C8.68389682,17.9951954 5.99844971,15.3097483 5.99844971,11.9970814 C5.99844971,8.68441449 8.68389682,5.99896738 11.9965637,5.99896738 Z"> </path>        
                                                    </svg>
                                                </span>
                                            @endif
                                        </td>
                                        <td> 1 to 30 days </td>
                                        <td> {{round(($product->price - $product->discount30) * 100 / $product->price)}}% </td>
                                        <td> {!!$product->shop->country->currency->symbol!!} {{$product->discount30}} </td>
                                        <td> @if($product->timeline == 30) {{$product->stock}} @endif </td>
                                    </tr>
                                    <tr>
                                        <td> 
                                            @if($product->timeline == 60)
                                                <span class="icon">
                                                    <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/2000/svg" fill="currentColor">
                                                        <path stroke="#00b207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12.0000002,1.99896738 C17.523704,1.99896738 22.0015507,6.47681407 22.0015507,12.0005179 C22.0015507,17.5242217 17.523704,22.0020684 12.0000002,22.0020684 C6.47629639,22.0020684 1.99844971,17.5242217 1.99844971,12.0005179 C1.99844971,6.47681407 6.47629639,1.99896738 12.0000002,1.99896738 Z M12.0000002,3.49896738 C7.30472352,3.49896738 3.49844971,7.30524119 3.49844971,12.0005179 C3.49844971,16.6957946 7.30472352,20.5020684 12.0000002,20.5020684 C16.6952769,20.5020684 20.5015507,16.6957946 20.5015507,12.0005179 C20.5015507,7.30524119 16.6952769,3.49896738 12.0000002,3.49896738 Z M11.9965637,5.99896738 C15.3092306,5.99896738 17.9946777,8.68441449 17.9946777,11.9970814 C17.9946777,15.3097483 15.3092306,17.9951954 11.9965637,17.9951954 C8.68389682,17.9951954 5.99844971,15.3097483 5.99844971,11.9970814 C5.99844971,8.68441449 8.68389682,5.99896738 11.9965637,5.99896738 Z"> </path>        
                                                    </svg>
                                                </span>
                                            @endif
                                        </td>
                                        <td>31 to 60 days</td>
                                        <td> {{round(($product->price - $product->discount60) * 100 / $product->price)}}% </td>
                                        <td> {!!$product->shop->country->currency->symbol!!} {{$product->discount60}} </td>
                                        <td> @if($product->timeline == 60) {{$product->stock}} @endif </td>
                                    </tr>
                                    <tr>
                                        <td> 
                                            @if($product->timeline == 90)
                                                <span class="icon">
                                                    <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/2000/svg" fill="currentColor">
                                                        <path stroke="#00b207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12.0000002,1.99896738 C17.523704,1.99896738 22.0015507,6.47681407 22.0015507,12.0005179 C22.0015507,17.5242217 17.523704,22.0020684 12.0000002,22.0020684 C6.47629639,22.0020684 1.99844971,17.5242217 1.99844971,12.0005179 C1.99844971,6.47681407 6.47629639,1.99896738 12.0000002,1.99896738 Z M12.0000002,3.49896738 C7.30472352,3.49896738 3.49844971,7.30524119 3.49844971,12.0005179 C3.49844971,16.6957946 7.30472352,20.5020684 12.0000002,20.5020684 C16.6952769,20.5020684 20.5015507,16.6957946 20.5015507,12.0005179 C20.5015507,7.30524119 16.6952769,3.49896738 12.0000002,3.49896738 Z M11.9965637,5.99896738 C15.3092306,5.99896738 17.9946777,8.68441449 17.9946777,11.9970814 C17.9946777,15.3097483 15.3092306,17.9951954 11.9965637,17.9951954 C8.68389682,17.9951954 5.99844971,15.3097483 5.99844971,11.9970814 C5.99844971,8.68441449 8.68389682,5.99896738 11.9965637,5.99896738 Z"> </path>        
                                                    </svg>
                                                </span>
                                            @endif
                                        </td>
                                        <td>61 to 90 days</td>
                                        <td> {{round(($product->price - $product->discount90) * 100 / $product->price)}}% </td>
                                        <td> {!!$product->shop->country->currency->symbol!!} {{$product->discount90}} </td>
                                        <td> @if($product->timeline == 90) {{$product->stock}} @endif </td>
                                    </tr>
                                    <tr>
                                        <td> 
                                            @if($product->timeline == 120)
                                                <span class="icon">
                                                    <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/2000/svg" fill="currentColor">
                                                        <path stroke="#00b207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12.0000002,1.99896738 C17.523704,1.99896738 22.0015507,6.47681407 22.0015507,12.0005179 C22.0015507,17.5242217 17.523704,22.0020684 12.0000002,22.0020684 C6.47629639,22.0020684 1.99844971,17.5242217 1.99844971,12.0005179 C1.99844971,6.47681407 6.47629639,1.99896738 12.0000002,1.99896738 Z M12.0000002,3.49896738 C7.30472352,3.49896738 3.49844971,7.30524119 3.49844971,12.0005179 C3.49844971,16.6957946 7.30472352,20.5020684 12.0000002,20.5020684 C16.6952769,20.5020684 20.5015507,16.6957946 20.5015507,12.0005179 C20.5015507,7.30524119 16.6952769,3.49896738 12.0000002,3.49896738 Z M11.9965637,5.99896738 C15.3092306,5.99896738 17.9946777,8.68441449 17.9946777,11.9970814 C17.9946777,15.3097483 15.3092306,17.9951954 11.9965637,17.9951954 C8.68389682,17.9951954 5.99844971,15.3097483 5.99844971,11.9970814 C5.99844971,8.68441449 8.68389682,5.99896738 11.9965637,5.99896738 Z"> </path>        
                                                    </svg>
                                                </span>
                                            @endif
                                        </td>
                                        <td>91 to 120 days</td>
                                        <td> {{round(($product->price - $product->discount120) * 100 / $product->price)}}% </td>
                                        <td> {!!$product->shop->country->currency->symbol!!} {{$product->discount120}} </td>
                                        <td> @if($product->timeline == 120) {{$product->stock}} @endif </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-5 order-lg-0 order-1">
                                <table class="table font-body--md-400">
                                    <tr>
                                        <td><i> If you buy Now </i></td>
                                        <th>{{now()->format('jS M')}}</th>
                                    </tr>
                                    <tr>
                                        <td><i>It can be delivery by</i></td>
                                        <th>{{now()->addHours(cache('settings')['order_processing_to_delivery_period'])->format('jS M')}}</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><i>And if you have a complaint about the product after delivery,</i></td>
                                    </tr>
                                    <tr>
                                        <td><i>You can request refund anytime before</i></td>
                                        <th>{{now()->addHours( cache('settings')['order_delivered_to_acceptance_period'] + cache('settings')['order_processing_to_delivery_period'])->format('jS M')}}</th>
                                    </tr>
                                </table>
                                <div class="products-video__card">
                                    <div class="products-video__card-item">
                                        <span class="icon">
                                            <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M28.0671 24.7501C28.326 24.7501 28.5359 24.5402 28.5359 24.2813V13.0313C28.5359 12.4718 28.3178 11.8995 27.9219 11.4198L24.4454 7.20769C24.2633 6.987 24.0539 6.801 23.8265 6.65287C23.8405 6.50962 23.8484 6.36494 23.8484 6.21887V0.968872C23.8484 0.709997 23.6385 0.500122 23.3797 0.500122C23.1208 0.500122 22.9109 0.709997 22.9109 0.968872C22.9109 0.968872 22.91 6.26356 22.9096 6.28593C22.7762 6.26231 22.6409 6.25012 22.5047 6.25012H16.4422C16.0154 6.25012 15.597 6.36987 15.2224 6.58994C15.2062 6.59575 15.1902 6.60225 15.1744 6.60994L10.605 8.83568C10.0987 9.08962 9.69392 9.51556 9.46498 10.035C9.46248 10.0407 9.46011 10.0464 9.45786 10.0521L7.56861 14.8441C7.47367 15.085 7.59192 15.3572 7.83279 15.4522C7.88923 15.4744 7.94736 15.4849 8.00461 15.4849C8.19148 15.4849 8.36811 15.3724 8.44079 15.188L10.3264 10.4052C10.4682 10.0884 10.7161 9.82887 11.0204 9.67612L13.4347 8.50019L11.0249 11.4199C10.6641 11.857 10.4734 12.4143 10.4734 13.0314V29.2189C10.4734 29.4074 10.49 29.592 10.52 29.7719L5.68992 27.6316C4.59879 27.1482 4.10429 25.864 4.58779 24.769C4.58986 24.7642 4.59186 24.7594 4.59386 24.7547L7.64904 17.1619C7.74567 16.9217 7.62936 16.6487 7.38917 16.5521C7.14886 16.4554 6.87598 16.5718 6.77929 16.8119L3.72679 24.3976C3.04042 25.9632 3.74942 27.7971 5.31011 28.4886L10.9741 30.9984C10.981 31.0014 10.9881 31.0037 10.9951 31.0064C11.57 31.9046 12.5639 32.5001 13.6922 32.5001H25.2547C27.0333 32.5001 28.5359 30.9974 28.5359 29.2188V26.4688C28.5359 26.2099 28.326 26.0001 28.0672 26.0001C27.8083 26.0001 27.5984 26.2099 27.5984 26.4688V29.2188C27.5984 30.4893 26.5251 31.5626 25.2547 31.5626H13.6922C12.4343 31.5626 11.4109 30.5112 11.4109 29.2188V13.0313C11.4109 12.6289 11.5243 12.2875 11.748 12.0166L15.2244 7.80444C15.548 7.41244 15.9919 7.18756 16.4422 7.18756H22.5047C22.593 7.18756 22.681 7.1965 22.7679 7.21337C22.4745 8.21406 21.7476 9.04906 20.766 9.4675C20.5094 9.03819 20.0401 8.75006 19.5046 8.75006C18.6947 8.75006 18.0359 9.40894 18.0359 10.2188C18.0359 11.0287 18.6947 11.6876 19.5046 11.6876C20.2535 11.6876 20.8729 11.1239 20.962 10.3986C22.2244 9.92112 23.179 8.90937 23.6044 7.67444C23.6452 7.7155 23.6847 7.75869 23.7224 7.80444L27.1989 12.0166C27.4565 12.3287 27.5984 12.6891 27.5984 13.0314V24.2814C27.5984 24.5402 27.8082 24.7501 28.0671 24.7501ZM19.5046 10.7501C19.2117 10.7501 18.9734 10.5117 18.9734 10.2188C18.9734 9.92587 19.2117 9.68756 19.5046 9.68756C19.7975 9.68756 20.0359 9.92587 20.0359 10.2188C20.0359 10.5117 19.7975 10.7501 19.5046 10.7501Z" fill="#00B307"></path>
                                                    <path d="M15.4424 25.4375C15.5623 25.4375 15.6823 25.3917 15.7738 25.3002L23.7738 17.3002C23.9569 17.1171 23.9569 16.8203 23.7738 16.6373C23.5908 16.4542 23.294 16.4542 23.111 16.6373L15.111 24.6373C14.8121 24.9159 15.0414 25.4517 15.4424 25.4375Z" fill="#00B307"></path>
                                                    <path d="M16.4414 20.5C17.5614 20.5 18.4727 19.5887 18.4727 18.4687C18.4727 17.3487 17.5614 16.4375 16.4414 16.4375H16.3789C15.2589 16.4375 14.3477 17.3487 14.3477 18.4687C14.3477 19.5887 15.2589 20.5 16.3789 20.5H16.4414ZM15.2852 18.4687C15.2852 17.8657 15.7758 17.375 16.3789 17.375H16.4414C17.0445 17.375 17.5352 17.8657 17.5352 18.4687C17.5352 19.0718 17.0445 19.5625 16.4414 19.5625H16.3789C15.7758 19.5625 15.2852 19.0718 15.2852 18.4687Z" fill="#00B307"></path>
                                                    <path d="M22.5039 25.4375H22.5664C23.6864 25.4375 24.5977 24.5262 24.5977 23.4062C24.5977 22.2862 23.6864 21.375 22.5664 21.375H22.5039C21.3839 21.375 20.4727 22.2862 20.4727 23.4062C20.4727 24.5262 21.3839 25.4375 22.5039 25.4375ZM22.5039 22.3125H22.5664C23.1695 22.3125 23.6602 22.8032 23.6602 23.4062C23.6602 24.0093 23.1695 24.5 22.5664 24.5H22.5039C21.9008 24.5 21.4102 24.0093 21.4102 23.4062C21.4102 22.8032 21.9008 22.3125 22.5039 22.3125Z" fill="#00B307"></path>
                                                </g>
                                                <defs>
                                                    <clipPath>
                                                        <rect width="32" height="32" fill="white" transform="translate(0 0.5)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <div class="text__info">
                                            <h5>100% Refund Guaranteed</h5>
                                            <p>Easily apply for refund</p>
                                        </div>
                                    </div>
                                    <div class="products-video__card-item">
                                        <span class="icon">
                                            <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M28.0671 24.7501C28.326 24.7501 28.5359 24.5402 28.5359 24.2813V13.0313C28.5359 12.4718 28.3178 11.8995 27.9219 11.4198L24.4454 7.20769C24.2633 6.987 24.0539 6.801 23.8265 6.65287C23.8405 6.50962 23.8484 6.36494 23.8484 6.21887V0.968872C23.8484 0.709997 23.6385 0.500122 23.3797 0.500122C23.1208 0.500122 22.9109 0.709997 22.9109 0.968872C22.9109 0.968872 22.91 6.26356 22.9096 6.28593C22.7762 6.26231 22.6409 6.25012 22.5047 6.25012H16.4422C16.0154 6.25012 15.597 6.36987 15.2224 6.58994C15.2062 6.59575 15.1902 6.60225 15.1744 6.60994L10.605 8.83568C10.0987 9.08962 9.69392 9.51556 9.46498 10.035C9.46248 10.0407 9.46011 10.0464 9.45786 10.0521L7.56861 14.8441C7.47367 15.085 7.59192 15.3572 7.83279 15.4522C7.88923 15.4744 7.94736 15.4849 8.00461 15.4849C8.19148 15.4849 8.36811 15.3724 8.44079 15.188L10.3264 10.4052C10.4682 10.0884 10.7161 9.82887 11.0204 9.67612L13.4347 8.50019L11.0249 11.4199C10.6641 11.857 10.4734 12.4143 10.4734 13.0314V29.2189C10.4734 29.4074 10.49 29.592 10.52 29.7719L5.68992 27.6316C4.59879 27.1482 4.10429 25.864 4.58779 24.769C4.58986 24.7642 4.59186 24.7594 4.59386 24.7547L7.64904 17.1619C7.74567 16.9217 7.62936 16.6487 7.38917 16.5521C7.14886 16.4554 6.87598 16.5718 6.77929 16.8119L3.72679 24.3976C3.04042 25.9632 3.74942 27.7971 5.31011 28.4886L10.9741 30.9984C10.981 31.0014 10.9881 31.0037 10.9951 31.0064C11.57 31.9046 12.5639 32.5001 13.6922 32.5001H25.2547C27.0333 32.5001 28.5359 30.9974 28.5359 29.2188V26.4688C28.5359 26.2099 28.326 26.0001 28.0672 26.0001C27.8083 26.0001 27.5984 26.2099 27.5984 26.4688V29.2188C27.5984 30.4893 26.5251 31.5626 25.2547 31.5626H13.6922C12.4343 31.5626 11.4109 30.5112 11.4109 29.2188V13.0313C11.4109 12.6289 11.5243 12.2875 11.748 12.0166L15.2244 7.80444C15.548 7.41244 15.9919 7.18756 16.4422 7.18756H22.5047C22.593 7.18756 22.681 7.1965 22.7679 7.21337C22.4745 8.21406 21.7476 9.04906 20.766 9.4675C20.5094 9.03819 20.0401 8.75006 19.5046 8.75006C18.6947 8.75006 18.0359 9.40894 18.0359 10.2188C18.0359 11.0287 18.6947 11.6876 19.5046 11.6876C20.2535 11.6876 20.8729 11.1239 20.962 10.3986C22.2244 9.92112 23.179 8.90937 23.6044 7.67444C23.6452 7.7155 23.6847 7.75869 23.7224 7.80444L27.1989 12.0166C27.4565 12.3287 27.5984 12.6891 27.5984 13.0314V24.2814C27.5984 24.5402 27.8082 24.7501 28.0671 24.7501ZM19.5046 10.7501C19.2117 10.7501 18.9734 10.5117 18.9734 10.2188C18.9734 9.92587 19.2117 9.68756 19.5046 9.68756C19.7975 9.68756 20.0359 9.92587 20.0359 10.2188C20.0359 10.5117 19.7975 10.7501 19.5046 10.7501Z" fill="#00B307"></path>
                                                    <path d="M15.4424 25.4375C15.5623 25.4375 15.6823 25.3917 15.7738 25.3002L23.7738 17.3002C23.9569 17.1171 23.9569 16.8203 23.7738 16.6373C23.5908 16.4542 23.294 16.4542 23.111 16.6373L15.111 24.6373C14.8121 24.9159 15.0414 25.4517 15.4424 25.4375Z" fill="#00B307"></path>
                                                    <path d="M16.4414 20.5C17.5614 20.5 18.4727 19.5887 18.4727 18.4687C18.4727 17.3487 17.5614 16.4375 16.4414 16.4375H16.3789C15.2589 16.4375 14.3477 17.3487 14.3477 18.4687C14.3477 19.5887 15.2589 20.5 16.3789 20.5H16.4414ZM15.2852 18.4687C15.2852 17.8657 15.7758 17.375 16.3789 17.375H16.4414C17.0445 17.375 17.5352 17.8657 17.5352 18.4687C17.5352 19.0718 17.0445 19.5625 16.4414 19.5625H16.3789C15.7758 19.5625 15.2852 19.0718 15.2852 18.4687Z" fill="#00B307"></path>
                                                    <path d="M22.5039 25.4375H22.5664C23.6864 25.4375 24.5977 24.5262 24.5977 23.4062C24.5977 22.2862 23.6864 21.375 22.5664 21.375H22.5039C21.3839 21.375 20.4727 22.2862 20.4727 23.4062C20.4727 24.5262 21.3839 25.4375 22.5039 25.4375ZM22.5039 22.3125H22.5664C23.1695 22.3125 23.6602 22.8032 23.6602 23.4062C23.6602 24.0093 23.1695 24.5 22.5664 24.5H22.5039C21.9008 24.5 21.4102 24.0093 21.4102 23.4062C21.4102 22.8032 21.9008 22.3125 22.5039 22.3125Z" fill="#00B307"></path>
                                                </g>
                                                <defs>
                                                    <clipPath>
                                                        <rect width="32" height="32" fill="white" transform="translate(0 0.5)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <div class="text__info">
                                            <h5>Door Delivery</h5>
                                            <p>Fast & Efficient Logistics</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--  Customer Feedback  -->
                    <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                        <div class="row products-tab__feedback">
                            @if($product->reviews->isNotEmpty())
                                <div class="col-lg-4 order-lg-0 order-1">
                                    <div class="col4 -phm">
                                        <div class="text-center">
                                            <h6 class="mb-4">Verified Reviews ({{$product->reviews->count()}})</h6>
                                            <div class="h3">
                                                <span class="">{{$product->ratings()}}</span>/5
                                            </div>
                                            <ul class="user-details__rating d-flex justify-content-center">
                                                @for($i=intval($product->ratings());$i > 0;$i--)
                                                    <li>
                                                        <span class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                            </svg>
                                                        </span>
                                                    </li>
                                                @endfor

                                            </ul>
                                            <p class="-fs16 -pts">{{$product->reviews->count()}} verified ratings</p>
                                            <ul class="user-details__rating mt-4">
                                                @if($product->reviews->where('rating',5)->isNotEmpty())
                                                <li> 5
                                                    <span class="icon">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                        </svg>
                                                    </span> ({{$product->reviews->where('rating',5)->count()}} users)
                                                </li>
                                                @endif
                                                @if($product->reviews->where('rating',4)->isNotEmpty())
                                                <li> 4
                                                    <span class="icon">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                        </svg>
                                                    </span> ({{$product->reviews->where('rating',4)->count()}} users)
                                                </li>
                                                @endif
                                                @if($product->reviews->where('rating',3)->isNotEmpty())
                                                <li> 3
                                                    <span class="icon">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                        </svg>
                                                    </span> ({{$product->reviews->where('rating',3)->count()}} users)
                                                </li>
                                                @endif
                                                @if($product->reviews->where('rating',2)->isNotEmpty())
                                                <li> 2
                                                    <span class="icon">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                        </svg>
                                                    </span> ({{$product->reviews->where('rating',2)->count()}} users)
                                                </li>
                                                @endif
                                                @if($product->reviews->where('rating',1)->isNotEmpty())
                                                <li> 1
                                                    <span class="icon">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                        </svg>
                                                    </span> ({{$product->reviews->where('rating',1)->count()}} users)
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 order-lg-0 order-2 ">
                                    @if($product->reviewable())
                                    <div class="comment-box p-3 mb-3 border">
                                        <form action="{{route('order.review')}}" method="POST">@csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                          <table class="table table-borderless mb-0">
                                            <tr>
                                                <td style="vertical-align: middle">Product Rating: </td>
                                                <td>
                                                    <div class="form-check my-3">
                                                        <input class="form-check-input" type="radio" name="rating" id="rating5" value="5">
                                                        <label class="form-check-label font-body--400" for="rating5"> 
                                                            <ul class="user-details__rating d-flex">
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </label>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    <div class="form-check my-3">
                                                        <input class="form-check-input" type="radio" name="rating" id="rating4" value="enterprise">
                                                        <label class="form-check-label font-body--400" for="rating4"> 
                                                            <ul class="user-details__rating d-flex">
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check my-3">
                                                        <input class="form-check-input" type="radio" name="rating" id="rating3" value="enterprise">
                                                        <label class="form-check-label font-body--400" for="rating3"> 
                                                            <ul class="user-details__rating d-flex">
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                
                                                            </ul>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check my-3">
                                                        <input class="form-check-input" type="radio" name="rating" id="rating2" value="enterprise">
                                                        <label class="form-check-label font-body--400" for="rating2"> 
                                                            <ul class="user-details__rating d-flex">
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                                
                                                            </ul>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check my-3">
                                                        <input class="form-check-input" type="radio" name="rating" id="rating1" value="enterprise">
                                                        <label class="form-check-label font-body--400" for="rating1"> 
                                                            <ul class="user-details__rating d-flex">
                                                                
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                          </table>
                                          <div class="contact-form--input" id="comments">
                                            <label for="message">Comment</label>
                                            <input type="text" name="comment" required id="message" placeholder="Write your comment here…">
                                          </div>
                                          
                                          <div class="contact-form-button">
                                            <button class="button button--md" type="submit">
                                              Add Review
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div class="feedback">
                                        @foreach ($product->reviews->sortByDesc('created_at') as $review)
                                        <div class="products-tab__feedback-content">
                                            <div class="products-tab__feedback-content-top">
                                                <div class="user-details">
                                                    <div class="user-details__img">
                                                        <img @if(!$review->user->pic) src="{{asset('src/images/site/avatar.png')}}"  @else src="{{Storage::url($review->user->pic)}}" @endif alt="user-img">
                                                    </div>
                                                    <div class="user-details__info">
                                                        <h2 class="user-name">{{$review->user->name}}</h2>
                                                        <ul class="user-details__rating">
                                                            @for($j= $review->rating;$j > 0;$j--)
                                                                <li>
                                                                    <span class="icon">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M8.27563 11.9209L11.4281 13.9179C11.8311 14.1729 12.3311 13.7934 12.2116 13.3229L11.3011 9.74042C11.2754 9.64063 11.2784 9.53561 11.3097 9.43743C11.341 9.33925 11.3994 9.2519 11.4781 9.18542L14.3051 6.83292C14.6761 6.52392 14.4851 5.90742 14.0076 5.87642L10.3161 5.63642C10.2167 5.62937 10.1214 5.59424 10.0412 5.53511C9.961 5.47598 9.89925 5.39528 9.86313 5.30242L8.48613 1.83542C8.44864 1.73689 8.38208 1.65209 8.29528 1.59225C8.20849 1.53241 8.10555 1.50037 8.00013 1.50037C7.89471 1.50037 7.79177 1.53241 7.70498 1.59225C7.61818 1.65209 7.55163 1.73689 7.51413 1.83542L6.13713 5.30242C6.10109 5.39538 6.03937 5.47618 5.95916 5.5354C5.87896 5.59462 5.78358 5.62983 5.68413 5.63692L1.99263 5.87692C1.51563 5.90742 1.32363 6.52392 1.69513 6.83292L4.52213 9.18592C4.60079 9.25236 4.65911 9.33962 4.69042 9.4377C4.72173 9.53578 4.72475 9.64071 4.69913 9.74042L3.85513 13.0629C3.71163 13.6274 4.31213 14.0829 4.79513 13.7764L7.72513 11.9209C7.80748 11.8686 7.90305 11.8408 8.00063 11.8408C8.09822 11.8408 8.19378 11.8686 8.27613 11.9209H8.27563Z" fill="#FF8A00"></path>
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="user-published__info">
                                                    <p>{{$review->created_at->diffForHumans()}}</p>
                                                </div>
                                            </div>
                                            <p class="products-tab__feedback-comments">
                                                {{$review->comment}}
                                            </p>
                                        </div>  
                                        @endforeach
                                        
                                        {{-- <form action="#">
                                            <button class="button button--md button--disable feedback__loadbtn">
                                                Load more
                                            </button>
                                        </form> --}}
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        No Reviews yet
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($similar->isNotEmpty())
    <section class="section section--xl related pt-0">
        <div class="container">
            <div class="section__head justify-content-center">
                <h2 style="font-size:20px" class="section--title-four font-title--sm">Similar Products</h2>
            </div>
            <div class="swiper-container related-slider--one">
                <div class="swiper-wrapper">              
                  @foreach ($similar as $item)    
                        <div class="swiper-slide">
                            <div class="cards-md cards-md--four w-100">
                                <div class="cards-md__img-wrapper">
                                    <a href="{{route('product.show',$item)}}">
                                        <img @if(!$item->photo) src='{{asset("img/no-image.png")}}'  @else src="{{$item->image}}" @endif alt="{{$item->product}}" />
                                    </a>
                                    @if($item->expire_at && $item->discount && $item->stock > 0) 
                                        <span class="tag danger font-body--md-400" style="background:#00b207;font-size:13px">Sale {{floor($product->discount)}}% off</span>
                                    @endif
                                    @if($item->stock == 0) 
                                        <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                    @endif
                                    @if(auth()->check() && auth()->user()->likes->where('product_id',$item->id)->count())
                                        <div class="cards-md__favs-list show-heart">
                                            <span class="action-btn liked">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" id2="{{$item->id}}" class="add-to-wish" data-product="{{$item->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @else 
                                        <div class="cards-md__favs-list">
                                            <span class="action-btn">
                                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" id2="{{$item->id}}" class="add-to-wish" data-product="{{$item->id}}product">
                                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="cards-md__info d-flex justify-content-between align-items-center">
                                    <a href="{{route('product.show',$item)}}" class="cards-md__info-left">
                                        <h6 class="font-body--md-400 product-title">{{$item->name}}</h6>
                                        <div class="cards-md__info-price">
                                        @if($item->expire_at && $item->discount) 
                                            <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($product->amount, 0)}}</span>
                                            <del class="font-body--lg-400" style="color:#00b207">{!!$product->shop->country->currency->symbol!!}{{number_format($item->price, 0)}}</del>
                                        @else 
                                            <span class="font-body--lg-500">{!!$product->shop->country->currency->symbol!!}{{number_format($item->price, 0)}}</span>
                                        @endif
                                        </div>
                                        <ul class="d-flex" style="color:#888;font-size:12px">
                                        @if($item->expire_at && $item->discount) 
                                        <li>Expires in <span style="font-weight:550;color:#00b207">{{$item->expire_at->diffInDays(now())}} days</span><li>
                                        @else 
                                            <li>&nbsp;</li>
                                        @endif
                                        </ul>
                                    </a>
                                    <div class="cards-md__info-right">
                                        @if($item->available) 
                                            <span class="action-btn">
                                                @if($item->expire_at && $item->discount) 
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$item->id}}" data-price="{{$product->amount}}" data-product="{{$item->product}}" data-photo="{{$item->photo}}">
                                                        <path
                                                            d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333"
                                                            stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                    @else 
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$item->id}}" data-price="{{$item->price}}" data-product="{{$item->product}}" data-photo="{{$item->photo}}">
                                                        <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333"
                                                        stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" ></path>
                                                    </svg>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                  @endforeach 
                </div>
                <div class="swiper-pagination featured-pagination"></div>
            </div>
        </div>
    </section>
    @endif
    <!-- Related Product Section   end  -->
    
@endsection
@push('scripts')
@include('layouts.front')
{{-- <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script> --}}
<script>
    $('#addbtn').click(function(){
        let quantity = $('#counter-btn-counter').val()
        let product_id = $('#product_id').val()
        updatecart(product_id,quantity);
        // Show cart popup
        $(".ec-cart-float").fadeIn();
        // Remove Empty message
        $(".cart-empty").hide();

        // Hide Cart Popup
        setTimeout(function(){
            $(".ec-cart-float").fadeOut();
        }, 3000);
    })
</script>
@endpush
