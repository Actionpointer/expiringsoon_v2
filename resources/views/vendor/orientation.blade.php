@extends('layouts.app')
@push('styles')

@endpush
@section('title')Vendor Orientation | Expiring Soon @endsection
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
                <li class="active"><a href="{{route('wishlist')}}">Orientation</a></li>
            </ul>
            </div>
        </div>
    </div>
        <!-- breedcrumb section end   -->

    

    <section class="hero section--xl section">
        <div class="container">
            <div class="row hero__content">
                <div class="col-lg-4">
                    <div class="hero__img-wrapper">
                        <img src="{{asset('src/images/members/img-11.png')}}" alt="img" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero__text-content">
                        <h6>
                            Now, What's Next.
                        </h6>
                        <p class="info--two">
                            Now that you've registered, here a few things you might want to do next to get you started with making money on expiringsoon and having the best experience as a vendor.   
                        </p>
                        <ul class="hero__list-info">
                            <li>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <p>Create a shop. <a href="#" class="text-muted small"><i>See how</i></a></p>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <p>Create products in your shop <a href="#" class="text-muted small"><i>See how</i></a></p>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <p>Get a subscription plan to unlock more features. <a href="#" class="text-muted small"><i>See how</i></a></p>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <p>Verify both yourself and your business <a href="#" class="text-muted small"><i>See how</i></a></p>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <p>Setup your bank accounts <a href="#" class="text-muted small"><i>See how</i></a></p>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <p>Manage Orders <a href="#" class="text-muted small"><i>See how</i></a></p>
                            </li>
                        </ul>
                        <a href="{{route('vendor.dashboard')}}" class="button button--md">
                            Vendor Dashboard
                            <span>
                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="section section--xl members--two faq">
        <div class="container">
          <div class="row faq__content">
            <div class="col-lg-6 order-lg-0 order-2">
              <div class="faq__accordion">
                <h5 class="font-title--xl">You might like to ask </h5>
                <div class="accordion" id="faq-accordion">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        In elementum est a ante sodales iaculis.
                        <span class="icon">
                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="currentColor"></rect>
                            <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </span>
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                      <div class="accordion-body">
                        Morbi porttitor ligula in nunc varius sagittis. Proin dui
                        nisi, laoreet ut tempor ac, cursus vitae eros. Cras quis
                        ultricies elit. Proin ac lectus arcu. Maecenas aliquet vel
                        tellus at accumsan. Donec a eros non massa vulputate
                        ornare. Vivamus ornare commodo ante, at commodo felis
                        congue vitae.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Etiam lobortis massa eu nibh tempor elementum.
                        <span class="icon">
                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="currentColor"></rect>
                            <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </span>
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faq-accordion">
                      <div class="accordion-body">
                        Morbi porttitor ligula in nunc varius sagittis. Proin dui
                        nisi, laoreet ut tempor ac, cursus vitae eros. Cras quis
                        ultricies elit. Proin ac lectus arcu. Maecenas aliquet vel
                        tellus at accumsan. Donec a eros non massa vulputate
                        ornare. Vivamus ornare commodo ante, at commodo felis
                        congue vitae.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        In elementum est a ante sodales iaculis.
                        <span class="icon">
                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="currentColor"></rect>
                            <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </span>
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faq-accordion">
                      <div class="accordion-body">
                        Morbi porttitor ligula in nunc varius sagittis. Proin dui
                        nisi, laoreet ut tempor ac, cursus vitae eros. Cras quis
                        ultricies elit. Proin ac lectus arcu. Maecenas aliquet vel
                        tellus at accumsan. Donec a eros non massa vulputate
                        ornare. Vivamus ornare commodo ante, at commodo felis
                        congue vitae.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        In elementum est a ante sodales iaculis.
                        <span class="icon">
                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="currentColor"></rect>
                            <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </span>
                      </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faq-accordion">
                      <div class="accordion-body">
                        Morbi porttitor ligula in nunc varius sagittis. Proin dui
                        nisi, laoreet ut tempor ac, cursus vitae eros. Cras quis
                        ultricies elit. Proin ac lectus arcu. Maecenas aliquet vel
                        tellus at accumsan. Donec a eros non massa vulputate
                        ornare. Vivamus ornare commodo ante, at commodo felis
                        congue vitae.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 order-lg-0 order-1">
              <div class="faq__img-wrapper">
                <img src="{{asset('src/images/banner/banner-lg-09.png')}}" alt="banner" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
    </section>
    
  
@endsection
@push('scripts')
{{-- <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script> --}}
@endpush
