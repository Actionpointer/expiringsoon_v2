@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('src/css/custom.css')}}">
@endpush
@section('title') Products @endsection
@section('main')
    <!-- Breadcrumb Section Start  -->
    <div class="breedcrumb breedcrumb--two">
        <div class="container">
            <ul class="breedcrumb__content">
                <li>
                    <a href="{{route('index')}}">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"  />
                        </svg>
                        <span> > </span>
                    </a>
                </li>
                <li @if(!$category) class="active" @endif>
                    <a href="{{route('product.list')}}">
                        Products
                        @if($category)  <span> ></span>@endif
                    </a>
                </li>
                @if($category)
                <li class="active"><a href="#" id="active">{{$category->name}}</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Breadcrumb Section End  -->

    
    <!-- Banner Section Start  -->
    @include('frontend.adverts.fullwidth_horizontal')
    
    <!-- Banner Section End  -->

   
    <div class="container">
        <form action="{{route('product.list')}}" method="get" id="filterform">
            <div class="row my-3">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3" >
                            <select name="category_id" id="category_id" class="select2 w-100" onchange="document.getElementById('filterform').submit();">
                                <option value="0" >All Categories</option>
                                    @foreach ($categories->sortBy('category') as $cat)
                                        <option value="{{$cat->id}}" @if($category && $category->id == $cat->id) selected @endif>{{$cat->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3" >
                            <select name="tag" id="tag_id" class="select2 w-100" onchange="document.getElementById('filterform').submit();">
                                <option value="0" >All Tags</option>
                                    @foreach (array_filter($products->pluck('tags')->flatten()->toArray()) as $tags)
                                        <option value="{{$tags}}" @if($tag && $tag == $tags) selected @endif>{{$tags}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3" >
                            <select name="state_id" id="state_id" class="select2" onchange="document.getElementById('filterform').submit();">
                                <option value="0" @if($state_id == 0) selected @endif>All States</option>
                                @foreach ($states as $state)
                                    <option value="{{$state->id}}" @if($state_id == $state->id) selected @endif>{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="sortBy" id="sort-bys" class="form-control like_select2" onchange="document.getElementById('filterform').submit();">
                        <option value="price_asc">Sort by: Price Asc</option>
                        <option value="price_desc">Sort by: Price Desc</option>
                        <option value="expiry_asc">Sort by: Expiry date Asc</option>
                        <option value="expiry_desc">Sort by: Expiry date Desc</option>
                        
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Filter section End  -->

    <!-- Shop list Section Start  -->
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
                                                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="remove-from-wish" data-product="{{$product->id}}product">
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
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="add-to-cart" id3="{{$product->id}}" data-price="{{$product->amount}}" data-product="{{$product->id}}product" data-photo="./storage/{{$product->photo}}">
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
                                    <br />No Products in this Category</span>
                                </div>
                            @endforelse
                        
                            
                        </div>

                        @include('layouts.pagination',['data'=> $products])
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop list Section End   -->

    
@endsection

@push('scripts')
@include('layouts.front')
@endpush