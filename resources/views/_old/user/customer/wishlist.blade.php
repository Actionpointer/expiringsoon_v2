@extends('layouts.app')
@push('styles')
@endpush
@section('title')Wishlist | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
      <div class="breedcrumb__img-wrapper">
        <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
        <div class="container">
          <ul class="breedcrumb__content">
            <li>
              <a href="{{route('index')}}">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" >
                  <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                  />
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

  <!-- Shopping Cart Section Start   -->
  @include('layouts.session')
  <section class="shoping-cart section section--xl">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            {{-- <div class="section__head justify-content-center">
              <h2 class="section--title-four font-title--sm" style="font-size:20px">My Wishlist</h2>
            </div> --}}
            <div class="shoping-cart__content">
              <div class="cart-table">
                <div class="table-responsive">
                  <table class="table">
                    <thead> 
                      <tr>   
                        <th scope="col" class="cart-table-title">Product</th>   
                        <th scope="col" class="cart-table-title">Price</th>
                        <th scope="col" class="cart-table-title">Stock Status</th>
                        <th scope="col" class="cart-table-title"></th> 
                      </tr>
                    </thead>
                    <tbody> 
                        
                        @forelse ($likes as $like)
                          
                            <tr class="likeditem">   
                                <!-- Product item  -->   
                                <td class="cart-table-item align-middle">     
                                    <a href="{{route('product.show',$like->product)}}" class="cart-table__product-item">
                                        <div class="cart-table__product-item-img">
                                            <img src="{{Storage::url($like->product->photo)}}" alt=" {{$like->product->name}}" />
                                        </div>
                                        <h5 class="font-body--lg-400"> {{$like->product->name}}</h5>
                                    </a>
                                </td>
                                <!-- Price  -->   
                                <td class="cart-table-item order-date align-middle">  
                                    <p class="font-body--lg-500">
                                        {!!$like->product->shop->country->currency->symbol!!}{{number_format($like->product->amount, 0)}} 
                                        @if($like->product->amount != $like->product->price)
                                          <del>{!!$like->product->shop->country->currency->symbol!!}{{number_format($like->product->price, 0)}}</del>
                                        @endif
                                    </p>    
                                </td>   
                                <!-- Stock Status  -->
                                <td class="cart-table-item stock-status align-middle">
                                    @if($like->product->stock > 0 && $like->product->status == true)
                                        <span class="font-body--md-400 in">{{$like->product->stock}} in Stock</span>
                                    @else
                                        <span class="font-body--md-400 out"> out of stock</span>   
                                    @endif  
                                </td>

                                <td class="cart-table-item add-cart align-middle">     
                                    <div class="add-cart__wrapper">
                                        @if($like->product->status == 'live')
                                            <button class="button button--md add-to-cart" data-product="{{$like->product_id}}">Add to Cart</button>
                                        @else
                                            <button class="button button--md button--disable">Unavailable</button>     
                                        @endif      
                                        <button class="delete-item remove-from-wish" data-product="{{$like->product_id}}product">
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z" stroke="#CCCCCC" stroke-miterlimit="10"/>
                                                <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                          <td colspan="4">
                              <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('images/site/exclamation.png')}}">
                                <br />Your Wishlist is empty.<br />
                                <a href="{{route('product.list')}}">
                                    <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
                                </a>
                              </div>
                          </td>
                        </tr>
                            
                        @endforelse
                        <div id="wishlist-empty" style="margin:auto;padding:1%;text-align:center;display:none">
                          <img style="padding:10px;width:100px" src="{{asset('images/site/exclamation.png')}}">
                          <br />Your Wishlist is empty.<br />
                          <a href="{{route('product.list')}}">
                              <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
                          </a>
                        </div>
                    </tbody>
                  </table>
                </div>

                <!-- Share with  -->

                
              </div>
              <div class="shoping-cart__mobile">
                
                // Fetch Products
                @forelse ($likes as $like)
                  <div class="shoping-card likeditem">
                    <div class="shoping-card__img-wrapper">
                      <img src="{{Storage::url($like->product->photo)}}" alt=" {{$like->product->name}}" />
                    </div>
                    <h5 class="shoping-card__product-caption font-body--lg-400">
                      {{$like->product->name}}

                      @if($like->product->stock > 0 && $like->product->status==true)
                        <span class="tag tag--in"> in Stock</span>
                      @else
                        <span class="tag tag--out"> out of stock</span>
                      @endif
                      <!-- <span class="tag tag--out">Out of Stock</span> -->
                    </h5>
                    
                      <h6 class="shoping-card__product-price font-body--lg-600">
                        {!!$like->product->shop->country->currency->symbol!!}{{number_format($like->product->amount, 0)}} 
                        @if($like->product->amount != $like->product->price)
                        <del class="prev-price">
                          {!!$like->product->shop->country->currency->symbol!!}{{number_format($like->product->price, 0)}}
                        </del>
                        @endif
                      </h6>
                    
                      @if($like->product->status == 'live')
                          <button class="button button--md add-to-cart" data-product="{{$like->product_id}}">Add to Cart</button>
                      @else
                          <button class="button button--md button--disable">Unavailable</button>     
                      @endif  
                    
                    <button class="close-btn delete-item remove-from-wish" data-product="{{$like->product->id}}">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z"   stroke="#CCCCCC"   stroke-miterlimit="10" /> <path   d="M16 8L8 16"   stroke="#666666"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" /> <path   d="M16 16L8 8"   stroke="#666666"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
                      </svg>
                    </button>
                  </div>

                @empty
                  <div style="margin:auto;padding:1%;text-align:center"><img style="padding:10px;width:100px" src="{{asset('images/site/exclamation.png')}}"><br />Your Wishlist is empty.<br />
                    <a href="{{route('product.list')}}">
                      <span style="font-size:13px;color:#00b207">Start Shopping Now!</span>
                    </a>
                  </div>
                @endforelse
                <div class="cart-table__share-content d-flex align-items-center">
                  <span
                    class="font-body--md-400" style="margin-right: 10px; color: #1a1a1a" >Share:
                  </span>
                  <ul class="social-icon">
                    <li class="social-icon-link"> 
                      <a href="#">   
                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.99764 2.98875H9.64089V0.12675C9.35739 0.08775 8.38239 0 7.24689 0C4.87764 0 3.25464 1.49025 3.25464 4.22925V6.75H0.640137V9.9495H3.25464V18H6.46014V9.95025H8.96889L9.36714 6.75075H6.45939V4.5465C6.46014 3.62175 6.70914 2.98875 7.99764 2.98875Z" fill="currentColor"></path>
                        </svg>
                      </a>
                    </li>
                    <li class="social-icon-link">
                      <a href="#">
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M18 2.41888C17.3306 2.7125 16.6174 2.90713 15.8737 3.00163C16.6388 2.54488 17.2226 1.82713 17.4971 0.962C16.7839 1.38725 15.9964 1.68763 15.1571 1.85525C14.4799 1.13413 13.5146 0.6875 12.4616 0.6875C10.4186 0.6875 8.77387 2.34575 8.77387 4.37863C8.77387 4.67113 8.79862 4.95238 8.85938 5.22013C5.7915 5.0705 3.07687 3.60013 1.25325 1.36025C0.934875 1.91263 0.748125 2.54488 0.748125 3.2255C0.748125 4.5035 1.40625 5.63638 2.38725 6.29225C1.79437 6.281 1.21275 6.10888 0.72 5.83775C0.72 5.849 0.72 5.86363 0.72 5.87825C0.72 7.6715 1.99912 9.161 3.6765 9.50413C3.37612 9.58625 3.04875 9.62563 2.709 9.62563C2.47275 9.62563 2.23425 9.61213 2.01038 9.56263C2.4885 11.024 3.84525 12.0984 5.4585 12.1333C4.203 13.1154 2.60888 13.7071 0.883125 13.7071C0.5805 13.7071 0.29025 13.6936 0 13.6565C1.63462 14.7106 3.57188 15.3125 5.661 15.3125C12.4515 15.3125 16.164 9.6875 16.164 4.81175C16.164 4.64863 16.1584 4.49113 16.1505 4.33475C16.8829 3.815 17.4982 3.16588 18 2.41888Z" fill="currentColor" ></path>
                        </svg>
                      </a>
                    </li>
                    <li class="social-icon-link">
                      <a href="#">
                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M8.24471 0C3.31136 0 0.687744 3.16139 0.687744 6.60855C0.687744 8.20724 1.58103 10.2008 3.01097 10.8331C3.22811 10.931 3.34624 10.8894 3.39462 10.688C3.43737 10.535 3.62525 9.79807 3.71638 9.45042C3.74451 9.33904 3.72988 9.24229 3.63988 9.13766C3.16511 8.58864 2.78821 7.58847 2.78821 6.65017C2.78821 4.24594 4.69967 1.91146 7.9522 1.91146C10.7648 1.91146 12.7325 3.73854 12.7325 6.35204C12.7325 9.30529 11.1698 11.3484 9.13912 11.3484C8.0152 11.3484 7.17816 10.4663 7.44367 9.37505C7.76431 8.07561 8.39321 6.6783 8.39321 5.74113C8.39321 4.90072 7.91844 4.20544 6.94865 4.20544C5.80447 4.20544 4.87631 5.33837 4.87631 6.85943C4.87631 7.82585 5.21832 8.47838 5.21832 8.47838C5.21832 8.47838 4.08652 13.0506 3.87614 13.9045C3.52062 15.3502 3.92451 17.6914 3.95939 17.8928C3.98077 18.0042 4.10565 18.0391 4.1754 17.9479C4.28678 17.8017 5.65484 15.8497 6.03848 14.4389C6.17799 13.9248 6.75064 11.84 6.75064 11.84C7.12753 12.5207 8.21546 13.0911 9.37426 13.0911C12.8214 13.0911 15.3123 10.0613 15.3123 6.30141C15.2999 2.69675 12.215 0 8.24471 0Z" fill="currentColor"></path>
                        </svg>
                      </a>
                    </li>
                    <li class="social-icon-link">
                      <a href="#">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12.0027 24.0548C8.72269 24.0548 8.33602 24.0375 7.05602 23.9815C6.05785 23.9487 5.07259 23.7458 4.14269 23.3815C3.34693 23.0718 2.62426 22.6 2.02058 21.9961C1.4169 21.3922 0.945397 20.6694 0.636019 19.8735C0.28576 18.9402 0.0968427 17.9542 0.0773522 16.9575C0.00268554 15.6802 0.00268555 15.2615 0.00268555 12.0068C0.00268555 8.7175 0.0200189 8.3335 0.0773522 7.06017C0.0972691 6.06486 0.28618 5.08018 0.636019 4.14817C0.945042 3.35128 1.41686 2.62761 2.02134 2.02335C2.62583 1.4191 3.34968 0.947556 4.14669 0.638836C5.07821 0.287106 6.06315 0.0976949 7.05869 0.0788358C8.33202 0.0068358 8.75069 0.00683594 12.0027 0.00683594C15.3094 0.00683594 15.6894 0.0241691 16.9494 0.0788358C17.9467 0.0975025 18.936 0.286836 19.8694 0.638836C20.6661 0.947914 21.3898 1.41958 21.9943 2.02379C22.5987 2.628 23.0706 3.35149 23.38 4.14817C23.736 5.09484 23.9267 6.09484 23.9414 7.10417C24.016 8.3815 24.016 8.79883 24.016 12.0522C24.016 15.3055 23.9974 15.7322 23.9414 16.9948C23.9214 17.9924 23.7321 18.9794 23.3814 19.9135C23.0712 20.7099 22.5988 21.4332 21.9942 22.0373C21.3896 22.6414 20.666 23.1133 19.8694 23.4228C18.936 23.7722 17.9507 23.9615 16.9547 23.9815C15.6814 24.0548 15.264 24.0548 12.0027 24.0548ZM11.9574 2.1175C8.69602 2.1175 8.35735 2.1335 7.08402 2.19084C6.32355 2.20078 5.57042 2.34103 4.85735 2.6055C4.33726 2.80486 3.86471 3.11098 3.47017 3.50414C3.07563 3.89731 2.76786 4.36878 2.56669 4.88817C2.30002 5.60817 2.16002 6.3695 2.15202 7.1375C2.08135 8.4295 2.08135 8.76817 2.08135 12.0068C2.08135 15.2068 2.09335 15.5948 2.15202 16.8788C2.16402 17.6388 2.30402 18.3922 2.56669 19.1055C2.97469 20.1548 3.80669 20.9842 4.85869 21.3868C5.57083 21.653 6.32382 21.7933 7.08402 21.8015C8.37469 21.8762 8.71469 21.8762 11.9574 21.8762C15.228 21.8762 15.5667 21.8602 16.8294 21.8015C17.5899 21.7923 18.3432 21.652 19.056 21.3868C19.5733 21.186 20.0432 20.8796 20.4357 20.4873C20.8282 20.095 21.1348 19.6254 21.336 19.1082C21.6027 18.3882 21.7427 17.6255 21.7507 16.8575H21.7654C21.8227 15.5828 21.8227 15.2428 21.8227 11.9855C21.8227 8.72817 21.808 8.3855 21.7507 7.11217C21.7386 6.35278 21.5984 5.60088 21.336 4.88817C21.1353 4.37023 20.8289 3.89977 20.4364 3.50677C20.0438 3.11376 19.5737 2.80682 19.056 2.6055C18.3427 2.33884 17.5894 2.20017 16.8294 2.19084C15.54 2.1175 15.2027 2.1175 11.9574 2.1175ZM12.0027 18.1655C10.7834 18.1663 9.59136 17.8055 8.5772 17.1287C7.56304 16.4519 6.77236 15.4896 6.30517 14.3634C5.83798 13.2373 5.71526 11.9978 5.95254 10.8019C6.18982 9.60598 6.77644 8.50729 7.63819 7.64478C8.49995 6.78228 9.59814 6.19471 10.7939 5.9564C11.9896 5.71808 13.2291 5.83973 14.3557 6.30594C15.4823 6.77216 16.4453 7.56201 17.1229 8.57558C17.8006 9.58916 18.1624 10.7809 18.1627 12.0002C18.1606 13.6337 17.5111 15.1999 16.3565 16.3555C15.2018 17.5111 13.6363 18.162 12.0027 18.1655ZM12.0027 7.9975C11.2116 7.9975 10.4382 8.2321 9.78041 8.67162C9.12261 9.11115 8.60992 9.73586 8.30717 10.4668C8.00442 11.1977 7.9252 12.0019 8.07954 12.7779C8.23388 13.5538 8.61485 14.2665 9.17426 14.8259C9.73367 15.3853 10.4464 15.7663 11.2223 15.9206C11.9982 16.075 12.8025 15.9958 13.5334 15.693C14.2643 15.3903 14.889 14.8776 15.3286 14.2198C15.7681 13.562 16.0027 12.7886 16.0027 11.9975C16.0002 10.9374 15.578 9.92141 14.8284 9.1718C14.0788 8.42219 13.0628 7.99997 12.0027 7.9975ZM18.4027 7.04683C18.2139 7.04613 18.0272 7.00826 17.8531 6.93538C17.6789 6.8625 17.5209 6.75604 17.3879 6.62208C17.1193 6.35153 16.9693 5.98537 16.9707 5.60417C16.9721 5.22296 17.1249 4.85793 17.3954 4.58938C17.666 4.32083 18.0321 4.17075 18.4134 4.17217C18.7946 4.17358 19.1596 4.32637 19.4281 4.59693C19.6967 4.86748 19.8468 5.23363 19.8454 5.61484C19.8439 5.99604 19.6912 6.36107 19.4206 6.62962C19.15 6.89817 18.7839 7.04825 18.4027 7.04683Z" fill="currentColor"></path>
                        </svg>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Shopping Cart Section End    -->
  
@endsection
@push('scripts')
@include('layouts.front')
{{-- <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script> --}}
@endpush
