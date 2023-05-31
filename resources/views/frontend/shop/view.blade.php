@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('src/css/custom.css')}}">
@endpush

@section('title') {{$shop->name}} Products | Expiring Soon @endsection
@section('main')
    <!-- Breadcrumb Section Start  -->
    <div class="breedcrumb breedcrumb--two">
        <div class="container">
            <ul class="breedcrumb__content">
                <li>
                    <a href="index.php">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span> > </span>
                    </a>
                </li>
                <li class="">
                    <a href="#"> Shop <span> ></span> </a>
                </li>
                <li class="active"><a href="#" id="active">{{$shop->name}}</a></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb Section End  -->

    <!-- Banner Section Start  -->
    <section class="banner-sales">
        <div class="container">
            <div class="banner-sales__content">
                <img src="{{Storage::url($shop->banner)}}" alt="banner" />
                <div class="text-content">
                    <span class="title">Limited Offer</span>
                    <h2 class="font-title--lg">
                        {{$shop->name}} 
                        @if($shop->verified())
                        <svg width="16" height="16" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="#00b207" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="#00b207" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                        @endif
                    </h2>
                    <a href="#" class="button button--md">
                        Follow
                    </a>
                    <a href="#" class="unfollow button button--md bg-white text-success">
                        Following
                    </a>
                </div>
                <div class="sale-off">
                    <h5>60%</h5>
                    <p>off</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner Section End  -->
    <div class="row products-tab__description">
        <!-- Filter section Start  -->
        <div class="col-lg-12 order-lg-0 order-2">
            <div class="filter__sidebar">
                <button class="filter">
                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 5.75C18.4142 5.75 18.75 5.41421 18.75 5C18.75 4.58579 18.4142 4.25 18 4.25V5.75ZM9 4.25C8.58579 4.25 8.25 4.58579 8.25 5C8.25 5.41421 8.58579 5.75 9 5.75V4.25ZM18 4.25H9V5.75H18V4.25Z" fill="white"></path>
                        <path d="M13 14.75C13.4142 14.75 13.75 14.4142 13.75 14C13.75 13.5858 13.4142 13.25 13 13.25V14.75ZM4 13.25C3.58579 13.25 3.25 13.5858 3.25 14C3.25 14.4142 3.58579 14.75 4 14.75V13.25ZM13 13.25H4V14.75H13V13.25Z" fill="white" ></path>
                        <circle cx="5" cy="5" r="4" stroke="white" stroke-width="1.5"></circle>
                        <circle cx="17" cy="14" r="4" stroke="white" stroke-width="1.5"></circle>
                    </svg>
                </button>
                <div class="filter-box">
                    <div class="container">
                        <form action="{{route('vendor.show',$shop)}}" method="get" id="filterform">
                            <div class="filter-box__top">
                                <div class="filter-box__top-left">
                                    <div class="select-box--item" style="min-width: 200px!important">
                                        <select name="category_id" id="category_id" class="select2 w-100" onchange="document.getElementById('filterform').submit();">
                                            <option value="0">All Categories</option>
                                                @foreach ($categories->sortBy('category') as $cat)
                                                    <option value="{{$cat->id}}" @if($category && $category->id == $cat->id) selected @endif>{{$cat->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="filter-box__top-right">
                                    <div class="select-box--item">
                                        <select name="sortBy" id="sort-by" class="filter__dropdown-menu" onchange="document.getElementById('filterform').submit();">
                                            <option value="price_asc">Sort by: Price Asc</option>
                                            <option value="price_desc">Sort by: Price Desc</option>
                                            <option value="expiry_asc">Sort by: Expiry date Asc</option>
                                            <option value="expiry_desc">Sort by: Expiry date Desc</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="filter-box__bottom">
                        <div class="container">
                            <div class="filter-box__bottom-content">
                                <div class="active__filters">
                                    <h5>Active Filters:</h5>
                                    <div class="active__filters-item">
                                        <button class="filter-item">
                                            <span class="icon">
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 2.5L6.00003 6.5M6.00003 6.5L10 2.5M6.00003 6.5L2 10.5M6.00003 6.5L10 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </button>
                                        <button class="filter-item">
                                            <span id="activeprice">All Prices</span>
                                            <span class="icon">
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 2.5L6.00003 6.5M6.00003 6.5L10 2.5M6.00003 6.5L2 10.5M6.00003 6.5L10 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="filter__result">
                                    <p><span class="number" id="showcount">0</span> Products</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-12 order-lg-0 order-1">
            <section class="shop shop--two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Desktop Version  -->
                            <div id="loadproducts">
                                <div class="row shop__product-items">                        
                                    @forelse($products as $product)
                                        <div class="col-lg-3 col-md-6">
                                            <div class="cards-md cards-md--four w-100">
                                                <div class="cards-md__img-wrapper">
                                                    <a href="{{route('product.show',$product)}}">
                                                        <img src="{{Storage::url($product->photo)}}" alt="{{$product->name}}" onerror="this.src='{{asset('src/images/site/no-image.png')}}';" />
                                                    </a>
                                                        @if($product->price > $product->amount)
                                                        <span class="tag blue font-body--md-400" style="font-size:13px">Sale {{floor($product->discount)}}% off</span>
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
                                                        <h6 class="font-body--md-400 product-title">{{$product->name}}</h6>
                                                        
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
                                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product" >
                                                                <path d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" >
                                                                </path>
                                                            </svg>
                                                        </span>     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div style="margin:auto;padding:10%;text-align:center">
                                            <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                            <br />No Products in this Shop</span>
                                        </div>
                                    @endforelse
                                </div>
                                @include('layouts.pagination',['data'=> $products])
                                
                            </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    
@endsection

@push('scripts')
    @include('layouts.front')
    <script>
        $('.select2').select2()
    </script>
    
@endpush