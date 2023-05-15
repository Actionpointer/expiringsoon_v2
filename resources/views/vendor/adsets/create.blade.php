@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
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
          <li>
            <a href="{{route('home')}}"> Adsets <span> > </span> </a>
          </li>
          <li class="active"><a href="#">New</a></li>
        </ul>
      </div>
    </div>
  </div>
    <!-- breedcrumb section end   -->
    @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.vendor_navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
                <section class="shoping-cart section section--xl pt-0">
                    <form action="{{route('vendor.adset.subscribe')}}" method="post">@csrf
                      <div class="row shoping-cart__content">
                        <div class="col-lg-12">
                          {{-- <a href="#" class="small text-muted"><u>View detailed description on all the adset plans</u></a> --}}
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
                                              <input class="form-check-input adplans" type="checkbox" name="adplans[{{$adplan->id}}]" value="{{$adplan->id}}" id="adplan_id{{$adplan->id}}">
                                              <label class="form-check-label font-body--400" for="adplan_id{{$adplan->id}}">
                                                  <div>
                                                    <span class="lh-1">{{$adplan->name}} 
                                                        <span class="d-block small">{{$adplan->type}} <a href="#" class="text-muted text-lowercase"><i class="fa fa-info-circle"></i> info</a></span>
                                                    </span>
                                                  </div>
                                                      
                                              </label>
                                              <input type="hidden" name="price[{{$adplan->id}}]" class="price" value="{{$adplan->price_per_day}}">
                                          </div>
                                      </td>
                                      <!-- Price  -->
                                      
                                      <!-- quantity -->
                                      <td class="cart-table-item order-total align-middle">
                                        <div class="counter-btn-wrapper">
                                          <button type="button" class="counter-btn-dec counter-btn" data-action="decrement">
                                            -
                                          </button>
                                          <input type="number" class="counter-btn-counter quantity days" data-type="days" name="days[{{$adplan->id}}]" value="{{cache('settings')['minimum_advert_days']}}" min="{{cache('settings')['minimum_advert_days']}}" max="365" placeholder="1">
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
                                          <input type="number" class="counter-btn-counter quantity units" data-type="units" name="units[{{$adplan->id}}]" value="1" min="1" max="1000" placeholder="1">
                                          <button type="button" class="counter-btn-inc counter-btn" data-action="increment">
                                            +
                                          </button>
                                        </div>
                                      </td>
                                      <!-- Subtotal  -->
                                      <td class="cart-table-item order-subtotal align-middle">
                                        <div class="d-flex justify-content-between align-items-center ">
                                          <p class="font-body--md-500">{!!auth()->user()->country->currency->symbol!!}
                                            {{-- <span class="plan-total">{{cache('settings')['minimum_advert_days'] * $adplan->price_per_day}}</span> </p> --}}
                                            {{-- <input type="hidden" class="counter-btn-counter quantity" data-type="units" name="units[]" value="1" min="1" max="1000" placeholder="1"> --}}
                                            <input type="text" name="amount[{{$adplan->id}}]" class="d-inline border-0 amount" size="8" value="{{cache('settings')['minimum_advert_days'] * $adplan->price_per_day}}" readonly>
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
                                    <span class="font-body--xl-500">{!!auth()->user()->country->currency->symbol!!}
                                      <span id="subtotal">0.00</span> </span>
                                  </div>
    
                                  {{-- <div class="form-check py-2">
                                    <label class="form-check-label" for="autorenew" > Auto-renew</label>
                                    <input class="form-check-input checkboxes" type="checkbox" name="auto_renew" value="1" checked>
                                  </div> --}}
    
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
  </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
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

</script>
@endpush