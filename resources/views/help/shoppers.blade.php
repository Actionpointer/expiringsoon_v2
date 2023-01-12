@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/css/help.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/fonts/elegant_font/css/style.css')}}"/>
@endpush
@section('title')Help | Expiring Soon @endsection
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
                      <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span> > </span>
                  </a>
                </li>
                <li>
                  <a href="{{route('help.index')}}">
                    Help
                    <span> > </span>
                  </a>
                </li>
                <li class="active"><a href="#">Shoppers</a></li>
            </ul>
          
        </div>
      </div>
</div>
    <!-- breedcrumb section end   -->
<section class="cards-section section section--xl">
    <div class="container">
        <div id="doc-header" class="doc-header text-center">
            <h1 class="doc-title"><span aria-hidden="true" class="icon icon_puzzle_alt"></span> Shoppers</h1>
            <div class="meta"><i class="far fa-clock"></i> Last updated: 24th Dec, 2022</div>
        </div><!--//doc-header-->
        <div class="doc-body row" >
            <div class="doc-sidebar col-md-3 col-12 order-0 d-none d-md-flex">
                <div id="doc-nav" class="doc-nav">
                    <ul id="doc-menu" class="nav doc-menu flex-column sticky">
                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#introduction">Introduction</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#how-it-works">How it Works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#site-navigation">Site Navigation</a>
                            <ul class="nav doc-sub-menu nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#products">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#hot-deals">Hot Deals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#vendors">Vendors</a>
                                </li>
                                
                            </ul><!--//nav-->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#account">Account</a>
                            <ul class="nav doc-sub-menu nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#authentication">Authentication</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#dashboard">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#orders">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#wishlist">Wishlist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#transactions">Transactions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#profile">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#notifications">Notifications</a>
                                </li>
                                
                            </ul><!--//nav-->
                        </li>

                        
                        
                    </ul><!--//doc-menu-->
                </div><!--//doc-nav-->
            </div><!--//doc-sidebar-->
            <div class="doc-content col-md-9 col-12 order-1">
                <div class="content-inner">
                    <section id="introduction" class="doc-section">
                        <h2 class="section-title">Introduction</h2>
                        <div class="section-block">
                            <p class="font-body--md-300 text-secondary">
                                Welcome to expiringsoon marketplace, the only online platform where you can buy items at huge discounted rate.
                                All products on expiringsoon are categorized by their expiry date and discounted for you with reference to 
                                the date difference between the date of purchase and the expiry date.
                            </p>
                            {{-- <ul class="list list-inline my-3">
                                <li class="list-inline-item"><a class="btn btn-cta btn-pink" href="https://themes.3rdwavemedia.com/bootstrap-templates/product/prettydocs-free-bootstrap-theme-for-developers-and-startups/" target="_blank"><i class="fa fa-external-link"></i> View Details</a></li>
                                <li class="list-inline-item"><a class="btn btn-cta btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/product/prettydocs-free-bootstrap-theme-for-developers-and-startups/" target="_blank"><i class="fa fa-eye"></i> View Demo</a></li>
                            </ul> --}}
                            
                        </div><!--//section-block-->
                        
                        
                    </section><!--//doc-section-->

                    <section id="how-it-works" class="doc-section active">
                        <h2 class="section-title">How it works</h2>
                        <div class="section-block">
                            <p>For example, lets assume today's date is January 1st 2022. Let's also assume a cake has been uploaded
                                by a vendor with the expiry date as December 25th 2022, and with the following discount prices
                            </p>
                        </div>
                        <div class="section-block">
                            <h6>Normal Price: 5000</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">Expiry Date</th>
                                            <th class="text-nowrap">Discount Price</th>
                                            <th>Meaning</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">120 days </th>
                                            <td>4,500</td>
                                            <td>If you buy the cake 120 days to the expiry date (i.e Between August 27th and September 2th), you will pay the discount price of 4500</td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">90 days</th>
                                            <td>4,000</td>
                                            <td>If you buy the cake 90 days to the expiry date (i.e Between September 26th and October 26th), you will pay the discount price of 4000 </td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">60 days</th>
                                            <td>3,000</td>
                                            <td>If you buy the cake 60 days to the expiry date (i.e Between October 27th and  November 25th), you will pay the discounted price of 3000</td>
                                           
                                        </tr>
                                        <tr>
                                            <th scope="row">30 days</th>
                                            <td>2,500</td>
                                            <td>If you buy the cake 30 days to the expiry date (i.e Between November 26th and December 25th), you will pay the discount price of 2500 </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                            <p>
                                New prices automatically appear on the product with respect to its discount timeline. 
                                Note that some products may not be discount and prices are subject to change before orders are made. 
                                Once you make payment for an order, the price at which the order was made is final even if the product price is adjusted upwards or downwards minutes after 
                                your order is received
                            </p>
                        </div>
                       
                    </section>
                    
                    <section id="site-navigation" class="doc-section">
                        <h2 class="section-title">Site Navigation</h2>

                        <div id="home" class="section-block">
                            <h3 class="block-title">Home</h3>
                            <p>
                                On the homepage, you will find featured products and shops within your locality. All products are categorized based on their nature, for example; Food items
                                Electronics, House hold items, etc 
                            </p>
                            <div class="">
                                <a href="{{asset('src/images/demo/appify-discussions.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-discussions-thumb.jpg')}}" alt="screenshot" /></a>
                            </div> 
                            <p>
                                The home page contains some advert positions where ads (for shops or products) are displayed. 
                            </p>
                            
                            <div class="row simplelightbox-gallery-3">
                                <div class="col-md-6 col-12">
                                    <h6>Slider Position</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussions.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-discussions-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Featured Shop Position</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussion.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-discussion-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Featured Products Position</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussion.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-discussion-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Hot deals Position</h6>
                                    <p>The hot deals section on the homepage shows products whose current discounted price are atleast 50% below their normal price.</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussion.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-discussion-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="products" class="section-block">
                            <h3 class="block-title">Products</h3>
                            <p>
                                We list all products in grid format to help you search, sort, and filter as you wish. You can search for products by name, sort by price or expiry date, 
                                filter by category, tags, and location. It is probably more profitable to filter products by your preferred location in order to reduce the cost of shipment or even pick up the product from the vendor
                                by yourself.
                            </p>
                            <p>
                                Sometimes you will find 'no product in this selection'. This simply means that the filter returned no product, or the products available have expired or run out of stock. Simply search for another product or re-filter the products to 
                                display more options. 
                            </p>
                            <div class="row simplelightbox-gallery-3">
                                <div class="col-md-6 col-12">
                                    <h6>Products Overview</h6>
                                    <p>When you have products listed, you may add product to cart or to wishlist when logged in. 
                                    </p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussions.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-discussions-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Product Details</h6>
                                    <p>In product details page, which you find by clicking on a product, you find more description of the product. </p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussion.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-discussion-thumb.jpg')}}" alt="screenshot" /></a>
                                    </div> 
                                </div>
                            </div><!--//row-->  
                        </div><!--//section-block-->
                        
                        <div id="hot-deals" class="section-block">
                            <h3 class="block-title">Hot Deals</h3>
                            <p>
                                Everybody likes awoof, so here's the page for you to find the hottest deals on expiringsoon.
                                Items are featured and categorized according to their current discount percentage. You will find items
                                with 20% discounts, 30%, 40 and 50% discounts. 
                            </p>
                            <div class="row simplelightbox-gallery-4">
                                <div class="col-md-6 col-12">
                                    <h6>Slider Area</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-members.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-members-thumb.jpg')}}" alt="screenshot" /></a>
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Deals Section</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-member.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-member-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Shop Adverts</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-member.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-member-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Featured Products</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-member.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-member-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->  
                        </div><!--//section-block-->
                        
                        <div id="vendors" class="section-block">
                            <h3 class="block-title">Vendors</h3>
                            <p>
                                You can browse expiringsoon by vendors. This allows you to browse all the product offerings of a particular vendor. It can be very useful
                                when you want to buy several items of similar nature or category. 
                            </p>
                            <p>
                                Also when you shop from a particular vendor, all your delivery comes
                                from one single point, therefore reducing your cost of logistics.
                                You can also filter and sort shops based on different criteria. 
                            </p>
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-12">
                                    <h6>Vendors</h6>
                                    <div class="">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->
                        
                        

                    </section><!--//doc-section-->
                    
                    <section  id="account" class="doc-section">
                        <h2 class="section-title">Account</h2>

                        <div id="authentication" class="section-block">
                            <h3 class="block-title">Authentication</h3>
                            <div class="section-block">
                                <p>For example, lets assume today's date is January 1st 2022. Let's also assume a cake has been uploaded
                                    by a vendor with the expiry date as December 25th 2022, and with the following discount prices
                                </p>
                            </div>
                            <div class="row simplelightbox-gallery-6">
                                <div class="col-md-6">
                                    <h6>Shoppers Register</h6>
                                    <p>You need to have an account to use expiring soon. You can get one <a href="#">here</a> by registering with your personal details</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-tickets.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-tickets-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Vendors Register</h6>
                                    <p>There's a different  <a href="#">link</a> for vendors to register. The first step from that link will be to register yourself. After that, you will get further details on how to proceed to create new shops </p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-timeline.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-timeline-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Login</h6>
                                    <p>Use your email and password to login to your dashboard from <a href="#">here</a> to login to your dashboard </p>
                                    
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-activities.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-activities-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                                <div class="col-md-6">
                                    <h6>Forgot Password</h6>
                                    <p>Incase you forgot your password, use this link to recover your password </p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-inbox.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-inbox-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div>
                            <!--//row-->  
                        </div><!--//section-block-->

                        <div id="dashboard" class="section-block">
                            <h3 class="block-title">Dashboard</h3>
                            <div class="row simplelightbox-gallery-6">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Activities</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-activities.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-activities-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Tickets</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-tickets.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-tickets-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Inbox</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-inbox.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-inbox-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Timeline</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-timeline.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-timeline-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div>
                            <!--//row-->  
                        </div><!--//section-block-->

                        <div id="orders" class="section-block">
                            <h3 class="block-title">Orders</h3>
                            <p>
                                Browse through orders you've made in recent past. You can view details of a particular order and message the vendor 
                                if the order is still open. When the vendor changes the status of an order, you will receive notifications about the change
                            </p>
                           
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-6">
                                    <h6>Order List</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Order Details</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="wishlist" class="section-block">
                            <h3 class="block-title">Wishlist</h3>
                            <p>
                                When you browse through products, you can save/keep those products as wishlists. Click on the heart icon on a product to save it to your wishlist. Though the status of the products in your wishlist may change, the items continue to exist
                                in your wishlist as long as the product is exist on the platform. 
                            </p>
                            
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-6">
                                    <h6>Wishlist</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Cart</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="transactions" class="section-block">
                            <h3 class="block-title">Transactions</h3>
                            <p>
                                This page shows the record of all your transactions on expiringsoon. 
                            </p>
                            
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-12">
                                    
                                    <div class="">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="profile" class="section-block">
                            <h3 class="block-title">Profile</h3>
                            <p>
                                Here's where you edit your personal profile information  
                            </p>
                            
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-12">
                                    <div class="">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div> 
                        </div>

                        <div id="notifications" class="section-block">
                            <h3 class="block-title">Notification</h3>
                            <p>
                                You will find all your notifications on the notification page. These will include
                                notifications about orders you have made, payments, price drops, etc. 
                            </p>
                            
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-12">
                                    <div class="">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>

                            </div><!--//row-->  
                        </div><!--//section-block-->

                    </section>

                    {{-- <section  id="account" class="doc-section">
                        <h2 class="section-title">Account</h2>

                        

                        <div id="dashboard" class="section-block">
                            <h3 class="block-title">Dashboard</h3>
                            <div class="row simplelightbox-gallery-6">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Activities</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-activities.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-activities-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Tickets</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-tickets.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-tickets-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Inbox</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-inbox.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-inbox-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h6>Timeline</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-timeline.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-timeline-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div>
                            <!--//row-->  
                        </div><!--//section-block-->

                        <div id="orders" class="section-block">
                            <h3 class="block-title">Orders</h3>
                            <p>
                                You can browse expiringsoon by vendors. This allows you to browse all the product offerings of a particular vendor. It can be very useful
                                when you want to buy several items of similar nature or category. 
                            </p>
                            <p>
                                Also when you shop from a particular vendor, all your delivery comes
                                from one single point, therefore reducing your cost of logistics.
                                You can also filter and sort shops based on different criteria. 
                            </p>
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-6">
                                    <h6>Order List</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Order Details</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="wishlist" class="section-block">
                            <h3 class="block-title">Wishlist</h3>
                            <p>
                                You can browse expiringsoon by vendors. This allows you to browse all the product offerings of a particular vendor. It can be very useful
                                when you want to buy several items of similar nature or category. 
                            </p>
                            <p>
                                Also when you shop from a particular vendor, all your delivery comes
                                from one single point, therefore reducing your cost of logistics.
                                You can also filter and sort shops based on different criteria. 
                            </p>
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-6">
                                    <h6>Wishlist</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Cart</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="transactions" class="section-block">
                            <h3 class="block-title">Transactions</h3>
                            <p>
                                You can browse expiringsoon by vendors. This allows you to browse all the product offerings of a particular vendor. It can be very useful
                                when you want to buy several items of similar nature or category. 
                            </p>
                            <p>
                                Also when you shop from a particular vendor, all your delivery comes
                                from one single point, therefore reducing your cost of logistics.
                                You can also filter and sort shops based on different criteria. 
                            </p>
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-6">
                                    <h6>Wishlist</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Cart</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        <div id="profile" class="section-block">
                            <h3 class="block-title">Profile</h3>
                            <p>
                                You can browse expiringsoon by vendors. This allows you to browse all the product offerings of a particular vendor. It can be very useful
                                when you want to buy several items of similar nature or category. 
                            </p>
                            <p>
                                Also when you shop from a particular vendor, all your delivery comes
                                from one single point, therefore reducing your cost of logistics.
                                You can also filter and sort shops based on different criteria. 
                            </p>
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-6">
                                    <h6>Wishlist</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <h6>Cart</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                
                            </div><!--//row-->  
                        </div><!--//section-block-->

                        

                    </section> --}}
                    
                </div><!--//content-inner-->
            </div><!--//doc-content-->
            
        </div><!--//doc-body-->              
    </div><!--//container-->
</section>

  
@endsection
@push('scripts')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
@endpush
