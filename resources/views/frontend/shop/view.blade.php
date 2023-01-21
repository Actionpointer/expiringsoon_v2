@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush

@section('title') Vendor Products | Expiring Soon @endsection
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
                    <a href="shop.php"> Shop <span> ></span> </a>
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
                    <h2 class="font-title--lg">{{$shop->name}}</h2>
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
        </div>
    </section>

    <!-- Banner Section End  -->
    <section class="products-tab section section--xl">
        <div class="products-tab__btn">
            <div class="container">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                            Products
                        </button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false">
                            Customer feedback
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
                                                                            @if($product->stock == 0)
                                                                                <span class="tag danger font-body--md-400" style="background:#ea4b4833; color:#ea4b48;font-weight:500;font-size:13px">Out of Stock</span>
                                                                            @endif
                                                                            @if(Auth::check() && $product->like->where('user_id',Auth::id())->count() == 0)
                                                                                <div class="cards-md__favs-list">
                                                                                    <span class="action-btn">
                                                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-wish" data-product="{{$product->id}}product">
                                                                                            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="currentColor" stroke-width="1.5"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </div>
                                                                            @endif
                                                                            @if(Auth::check() && $product->like->where('user_id',Auth::id())->count() == 1)
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
                                                                                    <span class="font-body--lg-500">{!!session('locale')['currency_symbol']!!}{{number_format($product->amount, 0)}}</span>
                                                                                    <del class="font-body--lg-400" style="color:#00b207">{!!session('locale')['currency_symbol']!!}{{number_format($product->price, 0)}}</del>
                                                                                @else
                                                                                    <span class="font-body--lg-500">{!!session('locale')['currency_symbol']!!}{{number_format($product->price, 0)}}</span>
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
                                                    
                                                    <nav aria-label="Page navigation pagination--one" class="pagination-wrapper section--xl" style="padding-top: 20px;">
                                                        <ul class="pagination justify-content-center">
                                                            <li class="page-item pagination-item @if($products->onFirstPage()) disabled @endif">
                                                                <a class="page-link pagination-link" href="{{$products->previousPageUrl()}}" tabindex="-1">
                                                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M6.91663 1.16634L1.08329 6.99967L6.91663 12.833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </a>
                                                            </li>
                                                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                            <li class="page-item pagination-item">
                                                                <a class="page-link pagination-link @if($products->currentPage() == $i) active @endif" href="{{$products->url($i)}}">{{$i}}</a>
                                                            </li>
                                                            @endfor
                                                            
                                                            <li class="page-item pagination-item @if($products->currentPage() == $products->lastPage()) disabled @endif">
                                                                <a class="page-link pagination-link" href="{{$products->nextPageUrl()}}">
                                                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M1.08337 1.16634L6.91671 6.99967L1.08337 12.833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                    
                                                </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                        <div class="row products-tab__feedback justify-content-center">
                            <div class="col-lg-7 order-lg-0 order-2">
                                <div class="feedback">
                                    <table id="datatable" class="table display">
                                        <thead>
                                            <tr>
                                                <th>Reviews</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($shop->reviews as $review)
                                                <tr>
                                                    <td>
                                                        <div class="products-tab__feedback-content border-bottom-0">
                                                            <div class="products-tab__feedback-content-top">
                                                                <div class="user-details">
                                                                    <div class="user-details__img">
                                                                        <img @if(!$review->order->user->pic) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($review->order->user->pic)}}" @endif alt="user-img">
                                                                    </div>
                                                                    <div class="user-details__info">
                                                                        <h2 class="user-name">{{$review->order->user->name}}</h2>
                                                                        <ul class="user-details__rating">
                                                                            @for ($i = 0; $i < $review->rating; $i++)
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
                                                                {{-- <div class="user-published__info">
                                                                    <p>{{$review->created_at->diffForHumans()}}</p>
                                                                </div> --}}
                                                            </div>
                                                            @if($review->comment)
                                                            <p class="products-tab__feedback-comments">
                                                                {{$review->comment}}
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="user-published__info">
                                                            <p class="text-muted small">{{$review->created_at->diffForHumans()}}</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td class="text-center">No Review</td><td>..</td></tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                    
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
@endsection

@push('scripts')
    @include('layouts.front')
    <script>
        $('.select2').select2()
    </script>
    <script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
    {{-- <script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script> --}}
    <script src="{{asset('src/plugins/datatable/assets/buttons/vfs_fonts.js')}}"></script>
    {{-- <script src="{{asset('src/plugins/datatable/assets/buttons/buttons.html5.min.js')}}"></script> --}}
    {{-- <script src="{{asset('src/plugins/datatable/assets/buttons/buttons.print.min.js')}}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "pagingType": "full_numbers",
                dom: 'lBfrtip',
                order: [2,'desc'],
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Reviews",
                }
            });
        });
    </script>
@endpush