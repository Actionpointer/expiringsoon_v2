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
                  </a>
                </li>
            </ul>
        </div>
      </div>
</div>
    <!-- breedcrumb section end   -->
    <section class="cards-section text-center section section--xl">
        <div class="container">
            <h2 class="font-body--xxxl-400">Getting started is easy!</h2>
            <div class="intro pt-3" style="font-size:14px">
                <p>Here you will find help articles to guide you on how to use the platform seamlessly. Although you can easily navigate your way through the platform,
                    we just want to give you a go-to reference material.</p>
            </div><!--//intro-->
            <div id="cards-wrapper" class="cards-wrapper row">
                <div class="item item-pink item-2 col-lg-4 col-6">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_puzzle_alt"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">Shoppers</h3>
                        <p class="intro">Useful for website guest and customers</p>
                        <a class="link" href="{{route('help.shoppers')}}"><span></span></a>
                    </div><!--//item-inner-->
                </div><!--//item-->
                <div class="item item-green col-lg-4 col-6">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_puzzle_alt"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">Vendors</h3>
                        <p class="intro">Useful for shop/store owners and staff</p>
                        <a class="link" href="{{route('help.vendors')}}"><span></span></a>
                    </div><!--//item-inner-->
                </div><!--//item-->
                
                <div class="item item-blue col-lg-4 col-6">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_datareport_alt"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">Api Documentation</h3>
                        <p class="intro">Useful for developers </p>
                        <a class="link" href="{{route('help.api_documentation')}}"><span></span></a>
                    </div><!--//item-inner-->
                </div><!--//item-->
                <div class="item item-purple col-lg-4 col-6">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_lifesaver"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">FAQs</h3>
                        <p class="intro">Here are questions we think you might want to ask</p>
                        <a class="link" href="{{route('help.faq')}}"><span></span></a>
                    </div><!--//item-inner-->
                </div><!--//item-->
                <div class="item item-primary col-lg-4 col-6">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_genius"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">Download App</h3>
                        <p class="intro">Download our Android and iOS Apps for Vendors</p>
                        <a class="link" href="{{route('help.download')}}"><span></span></a>
                    </div><!--//item-inner-->
                </div><!--//item-->
                <div class="item item-orange col-lg-4 col-6">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="icon icon_gift"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">Contact Us</h3>
                        <p class="intro">We love feedbacks and we love to solve problems.</p>
                        <a class="link" href="{{route('help.contact')}}"><span></span></a>
                    </div><!--//item-inner-->
                </div><!--//item-->
            </div><!--//cards-->
            
        </div><!--//container-->
    </section>

  
@endsection
@push('scripts')
{{-- <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script> --}}
@endpush
