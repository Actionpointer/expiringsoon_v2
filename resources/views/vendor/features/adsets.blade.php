@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>
<style> 
  .shoping-cart__content .cart-table{display: block!important}
</style>
@endpush
@section('title') Advert | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#"> Vendor <span> > </span> </a>
          </li>
          <li class="active"><a href="{{route('home')}}">Dashboard</a></li>
        </ul>
      </div>
    </div>
  </div>
    <!-- breedcrumb section end   -->
    @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('vendor.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                              Adsets
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                              Add New Sets
                          </button>
                      </li>       
                  </ul>
              </div>
            </div>
            <div class="products-tab__content">
              <div class="tab-content" id="pills-tabContent">
                <!-- General  -->
                <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                    <div class="products-tab__description">
                      <section class="shoping-cart section section--xl pt-0">                
                        <div class="row shoping-cart__content">
                          <div class="col-lg-12">
                            <div class="rounded border">
                              <div class="table-responsive">
                                <table class="table border-0" id="datatable">
                                  <thead>
                                    <tr>  
                                      <th scope="col" class="dashboard__order-history-table-title"> Details</th>
                                      <th scope="col" class="dashboard__order-history-table-title">Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($user->activeFeatures as $feature)
                                    <tr style="border-color:#eee">
                                        <td>
                                          <div class="cards-blog__info">
                                          <a href="single-blog.html" class="blog-title font-body--xl-500 d-block">
                                            {{$feature->adplan->name}}-{{$feature->slug}}</a>
                                            <div class="cards-blog__info-tags d-flex flex-column flex-md-row">
                                              <div class="cards-blog__info-tags-item">
                                                <span>
                                                  <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.1583 11.6748L11.1833 17.6498C11.0285 17.8048 10.8447 17.9277 10.6424 18.0116C10.4401 18.0955 10.2232 18.1386 10.0042 18.1386C9.78513 18.1386 9.56825 18.0955 9.36592 18.0116C9.16359 17.9277 8.97978 17.8048 8.82499 17.6498L1.66666 10.4998V2.1665H9.99999L17.1583 9.32484C17.4687 9.63711 17.643 10.0595 17.643 10.4998C17.643 10.9401 17.4687 11.3626 17.1583 11.6748V11.6748Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M5.83331 6.33301H5.84165" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  </svg>
                                                </span>
                                                {{$feature->adplan->page}}
                                              </div>
                                              
                                              <div class="cards-blog__info-tags-item">
                                                <span class="icon">
                                                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 16V9.00004H7L3.783 12.22C4.33247 12.7819 4.98837 13.2287 5.71241 13.5343C6.43644 13.8399 7.21411 13.9983 8 14C9.23925 13.9982 10.4475 13.6127 11.4589 12.8965C12.4702 12.1802 13.2349 11.1684 13.648 10H13.666C13.78 9.67504 13.867 9.34004 13.925 9.00004H15.937C15.6934 10.9333 14.7527 12.7111 13.2913 14C11.83 15.2888 9.9485 16 8 16H7.99C6.93982 16.0032 5.89944 15.798 4.9291 15.3963C3.95876 14.9946 3.07772 14.4045 2.337 13.66L0 16ZM2.074 7.00004H0.0619998C0.305476 5.06751 1.24564 3.29019 2.70616 2.00145C4.16667 0.712703 6.04719 0.00107558 7.995 3.98088e-05H8C9.05036 -0.00328613 10.0909 0.201826 11.0615 0.603496C12.032 1.00517 12.9132 1.59541 13.654 2.34004L16 3.98088e-05V7.00004H9L12.222 3.78004C11.672 3.21752 11.0153 2.77035 10.2903 2.46471C9.56537 2.15907 8.78674 2.0011 8 2.00004C6.76074 2.00187 5.55246 2.38738 4.54114 3.10361C3.52982 3.81985 2.76508 4.83166 2.352 6.00004H2.334C2.219 6.32504 2.132 6.66004 2.075 7.00004H2.074Z" fill="currentColor"></path>
                                                  </svg>
                                                    
                                                </span>
                                                {{$feature->units}} {{$feature->adplan->type}}. {{$feature->adverts->count()}} used
                                              </div>

                                              <div class="cards-blog__info-tags-item">
                                                <span class="icon">
                                                  <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.25 3.5H3.75C2.92157 3.5 2.25 4.17157 2.25 5V15.5C2.25 16.3284 2.92157 17 3.75 17H14.25C15.0784 17 15.75 16.3284 15.75 15.5V5C15.75 4.17157 15.0784 3.5 14.25 3.5Z" stroke="#00B307" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M12 2V5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M6 2V5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M2.25 8H15.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  </svg>
                                                </span>
                                                {{$feature->start_at->format('M d, Y')}} - {{$feature->end_at->format('M d, Y')}}
                                              </div>
                                            </div>
                                            
                                            <a href="{{route('vendor.adverts',$feature)}}" class="btn btn-success text-white">
                                              Manage Ads
                                              <span>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                              </span>
                                            </a>
                                            @if(!$feature->active())
                                              <form action="{{route('vendor.subscription.feature')}}" method="post">@csrf
                                                <input type="hidden" name="feature_id" value="{{$feature->id}}">
                                                <button class="btn btn-primary text-white">
                                                  Renew
                                                  <span>
                                                  <svg width="20" height="21" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M8 10H5L3 21H21L19 10H16M8 10V7C8 4.79086 9.79086 3 12 3V3C14.2091 3 16 4.79086 16 7V10M8 10H16M8 10V13M16 10V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                  </span>
                                                </button>
                                              </form>
                                            @endif
                                          </div>
                                        </td>
                                        <td style="padding:20px;vertical-align:middle">
                                          @if($feature->active())
                                            <button class="badge btn-success">Active </button>
                                          @elseif($feature->expiring())
                                              <button class="badge btn-warning">Expiring </button>
                                          @else
                                              <button class="badge btn-danger">Expired </button>
                                          @endif 
                                        </td> 
                                    </tr>
                                    @empty
                                      <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                        <button type="button" class="button button--md bg-dark" id="addbankaccount">Add Subscription</button>
                                      </div>
                                    @endforelse
                                  </tbody>
                                </table>
                              </div>
                            </div>       
                                   
                          </div>
                        </div>
                      </section>
                    </div>
                </div>
  
                <!-- Plan  -->
                <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                  <div class="products-tab__description">
                    <section class="shoping-cart section section--xl pt-0">
                      <form action="{{route('vendor.subscription.feature')}}" method="post">@csrf
                        <div class="row shoping-cart__content">
                          <div class="col-lg-12">
                            <a href="#" class="small text-muted"><u>View detailed description on all the adset plans</u></a>
                            <div class="cart-table">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col" class="cart-table-title">Plans</th>
                                      <th scope="col" class="cart-table-title">Days</th>
                                      <th scope="col" class="cart-table-title">Units</th>
                                      <th scope="col" class="cart-table-title">Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                    @foreach ($adplans->sortBy('type') as $adplan)
                                      <tr class="item" data-plan="adplan_id{{$adplan->id}}" data-price="{{$adplan->price_per_day}}" data-days="{{cache('settings')['minimum_advert_days']}}" data-units="1" data-amount="{{$adplan->price_per_day * cache('settings')['minimum_advert_days']}}">
                                        <!-- Product item  -->
                                        <td class="cart-table-item align-middle">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input adplans" type="checkbox" name="adplans[]" value="{{$adplan->id}}" id="adplan_id{{$adplan->id}}">
                                                <label class="form-check-label font-body--400" for="adplan_id{{$adplan->id}}">
                                                    <div>
                                                      <span class="lh-1">{{$adplan->description}} <span class="d-block small">{{$adplan->page}}</span></span>
                                                    
                                                    </div>
                                                        
                                                </label>
                                                <input type="hidden" name="price[]" class="price" value="{{$adplan->price_per_day}}">
                                            </div>
                                        </td>
                                        <!-- Price  -->
                                        
                                        <!-- quantity -->
                                        <td class="cart-table-item order-total align-middle">
                                          <div class="counter-btn-wrapper">
                                            <button type="button" class="counter-btn-dec counter-btn" data-action="decrement">
                                              -
                                            </button>
                                            <input type="number" class="counter-btn-counter quantity days" data-type="days" name="days[]" value="{{cache('settings')['minimum_advert_days']}}" min="{{cache('settings')['minimum_advert_days']}}" max="365" placeholder="1">
                                            <button type="button" class="counter-btn-inc counter-btn" data-action="increment">
                                              +
                                            </button>
                                          </div>
                                        </td>
                                        <td class="cart-table-item order-total align-middle">
                                          <div class="counter-btn-wrapper">
                                            <button type="button" class="counter-btn-dec counter-btn" data-action="decrement">
                                              -
                                            </button>
                                            <input type="number" class="counter-btn-counter quantity units" data-type="units" name="units[]" value="1" min="1" max="1000" placeholder="1">
                                            <button type="button" class="counter-btn-inc counter-btn" data-action="increment">
                                              +
                                            </button>
                                          </div>
                                        </td>
                                        <!-- Subtotal  -->
                                        <td class="cart-table-item order-subtotal align-middle">
                                          <div class="d-flex justify-content-between align-items-center ">
                                            <p class="font-body--md-500">{!!cache('settings')['currency_symbol']!!}
                                              {{-- <span class="plan-total">{{cache('settings')['minimum_advert_days'] * $adplan->price_per_day}}</span> </p> --}}
                                              {{-- <input type="hidden" class="counter-btn-counter quantity" data-type="units" name="units[]" value="1" min="1" max="1000" placeholder="1"> --}}
                                              <input type="text" name="amount[]" class="d-inline border-0 amount" size="8" value="{{cache('settings')['minimum_advert_days'] * $adplan->price_per_day}}" readonly>
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>                    
                            </div>
                          </div>
                
                          <div class="col-lg-12">
                            <div class="bill-card">
                              <div class="bill-card__content">
                                <div class="bill-card__header">
                                  <h2 class="bill-card__header-title font-body--xxl-500">
                                    Order Summery
                                  </h2>
                                </div>
                                <div class="bill-card__body">
                                  <!-- memo  -->
                                  <div class="bill-card__memo">
                                    <!-- Shipping  -->
                                    <div class="bill-card__memo-item shipping">
                                      <p class="font-body--md-400">No of Ad Sets:</p>
                                      <span class="font-body--md-500" id="adset">0</span>
                                    </div>
                                    <!-- Subtotal  -->
                                    
                                    
                                    <!-- total  -->
                                    <div class="bill-card__memo-item total">
                                      <p class="font-body--lg-400">SubTotal:</p>
                                      <span class="font-body--xl-500">{!!cache('settings')['currency_symbol']!!}
                                        <span id="subtotal">0.00</span> </span>
                                    </div>
                                  </div>
                                  
                                    <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                                      Place Order
                                    </button>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </section>                   
                  </div>
                </div>   
              </div>
            </div>
            <!-- Set VAT -->
          </div>
            
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            }
        });
    });
</script>
<script>
    $('#addbankaccount').click(function(e){
        e.preventDefault();
        $('#pills-plans-tab').tab('show');
    })
</script>
<script>
  $('.counter-btn').click(function(){
      let clicked = $(this).closest('.counter-btn-wrapper').find('.quantity');
      let quantity = parseInt($(this).closest('.counter-btn-wrapper').find('.quantity').val());
      if($(this).attr('data-action') == 'increment'){
        newquantity = quantity + 1
      }
      else{
        newquantity = quantity - 1
        if(newquantity <= clicked.attr('min')) newquantity = clicked.attr('min');
      }
      total(clicked,newquantity);
      // mysubtotal(clicked);
      // mygrandtotal();
  })
  $(document).on('change input','.quantity',function(){
      var clicked = $(this); //get the quantity
      if($(this).val() != ''){
        total($(this),parseInt($(this).val())); 
      }
      
  })
  
  function total(clicked,newquantity){
    clicked.val(newquantity);
    clicked.closest('.item').attr('data-'+clicked.attr('data-type'),newquantity)
    price = parseInt(clicked.closest('.item').find('.price').val())
    days = parseInt(clicked.closest('.item').find('.days').val())
    units = parseInt(clicked.closest('.item').find('.units').val())
    amount = price * days * units;
    clicked.closest('.item').find('.amount').val(amount);
    clicked.closest('.item').find('#'+clicked.closest('.item').attr('data-plan')).prop('checked',true)
    updatesummary()
  }

  function updatesummary(){
      let subtotal = 0;
      $('.adplans:checked').each(function(index){
          subtotal += parseInt($(this).closest('.item').find('.amount').val());
      });
      $('#adset').text($('.adplans:checked').length)
      $('#subtotal').text(subtotal);
  }

  $('.adplans').on('change',function(){
      updatesummary()
  })

  // function markplan(){

  // }


</script>
@endpush