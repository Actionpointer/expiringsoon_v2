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
                  <path ="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
            </svg>
                <span> > </span>
              </a>
            </li>
            <li>
              <a href="{{route('home')}}">
                Account
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="{{route('wishlist')}}">Wishlist</a></li>
          </ul>
        </div>
      </div>
</div>
    <!-- breedcrumb section end   -->
<section class="cards-section section section--xl">
    <div class="container">
        <div id="doc-header" class="doc-header text-center">
            <h1 class="doc-title"><span aria-hidden="true" class="icon icon_puzzle_alt"></span> Shoppers</h1>
            <div class="meta"><i class="far fa-clock"></i> Last updated: June 13th, 2022</div>
        </div><!--//doc-header-->
        <div class="doc-body row" >
            <div class="doc-sidebar col-md-3 col-12 order-0 d-none d-md-flex">
                <div id="doc-nav" class="doc-nav">
                    <ul id="doc-menu" class="nav doc-menu flex-column sticky">
                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#introduction">Introduction</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#home">Home</a>
                            <ul class="nav doc-sub-menu nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#projects">Projects</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#discussions">Discussions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#members">Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#account">User Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#others">Others</a>
                                </li>
                            </ul><!--//nav-->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#products">Products</a>
                            <ul class="nav doc-sub-menu nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#projects">Single Product View</a>
                                </li>
                                
                            </ul><!--//nav-->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#hotdeal">Hot Deals</a>
                            <ul class="nav doc-sub-menu nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#projects">Projects</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#discussions">Discussions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#members">Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#account">User Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#others">Others</a>
                                </li>
                            </ul><!--//nav-->
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#vendors">Vendors</a>
                            <ul class="nav doc-sub-menu nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#projects">Projects</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#discussions">Discussions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#members">Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#account">User Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scrollto" href="#others">Others</a>
                                </li>
                            </ul><!--//nav-->
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link scrollto heading" href="#authentication">Authentication</a>
                        </li>
                        
                    </ul><!--//doc-menu-->
                </div><!--//doc-nav-->
            </div><!--//doc-sidebar-->
            <div class="doc-content col-md-9 col-12 order-1">
                <div class="content-inner">
                    <section id="introduction" class="doc-section">
                        <h2 class="section-title">Introduction</h2>
                        <div class="section-block">
                            <p class="font-body--md-300 text-secondary">Welcome! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lorem lorem. Fusce ut maximus quam. Donec elit mauris, dignissim nec auctor a, mattis eget mauris. Praesent maximus euismod velit nec fringilla.</p>
                            <ul class="list list-inline my-3">
                                <li class="list-inline-item"><a class="btn btn-cta btn-pink" href="https://themes.3rdwavemedia.com/bootstrap-templates/product/prettydocs-free-bootstrap-theme-for-developers-and-startups/" target="_blank"><i class="fa fa-external-link"></i> View Details</a></li>
                                <li class="list-inline-item"><a class="btn btn-cta btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/product/prettydocs-free-bootstrap-theme-for-developers-and-startups/" target="_blank"><i class="fa fa-eye"></i> View Demo</a></li>
                            </ul>
                            
                        </div><!--//section-block-->
                        <div class="section-block">
                            
                            <div class="row simplelightbox-gallery-1">
                                <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 1</h6>
                                    <p class="font-body--md-300 text-secondary ">Project management</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-1.jpg')}}" >
                                            <img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-1-thumb.jpg')}}" alt="screenshot" /></a>
                                    </div> 
                                </div>
                                    <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 2</h6>
                                    <p>Web analytics</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-2.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-2-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                    <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 3</h6>
                                    <p>Health/Fitness app</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-3.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-3-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                    <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 4</h6>
                                    <p>Web hosting</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-4.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-4-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->
                            <div class="callout-block callout-info">
                                <div class="icon-holder">
                                    <i class="fa fa-bullhorn"></i>
                                </div><!--//icon-holder-->
                                <div class="content">
                                    <h4 class="callout-title">Lightbox Example</h4>
                                    <p>Click the screenshot images to trigger the image modal.</p>
                                </div><!--//content-->
                            </div><!--//callout-->
                        </div><!--//section-block-->
                        
                    </section><!--//doc-section-->

                    <section id="home" class="doc-section">
                        <h2 class="section-title">Dashboards</h2>
                        <div class="section-block">
                            <p class="font-body--md-300 text-secondary">Welcome! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et lorem lorem. Fusce ut maximus quam. Donec elit mauris, dignissim nec auctor a, mattis eget mauris. Praesent maximus euismod velit nec fringilla.</p>
                            <ul class="list list-inline my-3">
                                <li class="list-inline-item"><a class="btn btn-cta btn-pink" href="https://themes.3rdwavemedia.com/bootstrap-templates/product/prettydocs-free-bootstrap-theme-for-developers-and-startups/" target="_blank"><i class="fa fa-external-link"></i> View Details</a></li>
                                <li class="list-inline-item"><a class="btn btn-cta btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/product/prettydocs-free-bootstrap-theme-for-developers-and-startups/" target="_blank"><i class="fa fa-eye"></i> View Demo</a></li>
                            </ul>
                            
                        </div><!--//section-block-->
                        <div class="section-block">
                            
                            <div class="row simplelightbox-gallery-1">
                                <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 1</h6>
                                    <p class="font-body--md-300 text-secondary ">Project management</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-1.jpg')}}" >
                                            <img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-1-thumb.jpg')}}" alt="screenshot" /></a>
                                    </div> 
                                </div>
                                    <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 2</h6>
                                    <p>Web analytics</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-2.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-2-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                    <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 3</h6>
                                    <p>Health/Fitness app</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-3.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-3-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                    <div class="col-md-6 col-sm-12 col-sm-12">
                                    <h6>Use Case 4</h6>
                                    <p>Web hosting</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-dashboard-4.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-dashboard-4-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->
                            <div class="callout-block callout-info">
                                <div class="icon-holder">
                                    <i class="fa fa-bullhorn"></i>
                                </div><!--//icon-holder-->
                                <div class="content">
                                    <h4 class="callout-title">Lightbox Example</h4>
                                    <p>Click the screenshot images to trigger the image modal.</p>
                                </div><!--//content-->
                            </div><!--//callout-->
                        </div><!--//section-block-->
                        
                    </section><!--//doc-section-->
                    
                    <section id="app-components" class="doc-section">
                        <h2 class="section-title">App Components</h2>

                        <div id="projects" class="section-block">
                            <h3 class="block-title">Projects</h3>
                            <p>Intro goes here lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis</p>
                            <div class="row simplelightbox-gallery-2">
                                <div class="col-md-6 col-12">
                                    <h6>Projects Overview</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-projects.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-projects-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Project Details</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-project.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-project-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->
                        </div><!--//section-block-->

                        <div id="discussions" class="section-block">
                            <h3 class="block-title">Discussions</h3>
                            <div class="row simplelightbox-gallery-3">
                                <div class="col-md-6 col-12">
                                    <h6>Discussions Overview</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussions.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-discussions-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Discussion Details</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-discussion.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-discussion-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->  
                        </div><!--//section-block-->
                        
                        <div id="members" class="section-block">
                            <h3 class="block-title">Members</h3>
                            <div class="row simplelightbox-gallery-4">
                                <div class="col-md-6 col-12">
                                    <h6>Members Overview</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-members.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-members-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6 col-12">
                                    <h6>Individual Member</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-member.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-member-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->  
                        </div><!--//section-block-->
                        
                        <div id="account" class="section-block">
                            <h3 class="block-title">User Account</h3>
                            <p>Intro goes here lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                            <div class="row simplelightbox-gallery-5">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <h6>User Profile</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-profile.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-profile-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <h6>User Settings</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-settings.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-settings-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <h6>User Billing</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-billing.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-billing-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <h6>User Messages</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-messages.jpg')}}" ><img class="img-fluid" src="{{asset('src/images/demo/appify-account-messages-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <h6>User Drive</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-drive.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-drive-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <h6>User Reminders</h6>
                                    <div class="screenshot-holder">
                                        <a href="{{asset('src/images/demo/appify-account-reminders.jpg')}}"><img class="img-fluid" src="{{asset('src/images/demo/appify-account-reminders-thumb.jpg')}}" alt="screenshot" /></a>
                                        
                                    </div> 
                                </div>
                            </div><!--//row-->  
                        </div><!--//section-block-->
                        
                        <div id="others" class="section-block">
                            <h3 class="block-title">Others</h3>
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

                        <div class="section-block">
                            <p class="text-center">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                            <div class="center-block text-center">
                                    <a class="btn btn-primary" href="#" target="_blank">More App Components</a>
                            </div>
                        </div><!--//section-block-->

                    </section><!--//doc-section-->
                    
                    
                </div><!--//content-inner-->
            </div><!--//doc-content-->
            
        </div><!--//doc-body-->              
    </div><!--//container-->
</section>

  
@endsection
@push('scripts')
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
@endpush
