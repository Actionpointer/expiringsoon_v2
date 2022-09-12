@extends('layouts.app')
@push('styles')
<style>
  
</style>

@endpush
@section('title') Message | Expiring Soon @endsection
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
                              Current Subscription
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                                Add New Subscription
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
                            <div class="cart-table">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col" class="dashboard__order-history-table-title"> Plan</th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Start</th>
                                      <th scope="col" class="dashboard__order-history-table-title"> End</th>
                                      <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                                      <th scope="col" class="dashboard__order-history-table-title"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($user->subscriptions as $subscription)
                                      <tr>
                                        <!-- Order Id  -->
                                        <td class="dashboard__order-history-table-item order-status"> 
                                            <span style="font-weight:500">
                                              @if($subscription->plan_id) 
                                                {{$subscription->plan->description}}
                                              @else 
                                                Enterprise plan
                                              @endif
                                            </span>
                                        </td>
                                        <!-- Date  -->
                                        <td class="dashboard__order-history-table-item   order-date "> {{ $subscription->start_at->format('d M, Y h:i A')}}</td>
                                        <!-- Total  -->
                                        <td class="   dashboard__order-history-table-item   order-total ">  {{ $subscription->end_at->format('d M, Y h:i A')}} </td>
                                        <!-- Status -->
                                        <td class="dashboard__order-history-table-item order-status ">
                                          @if($subscription->deleted_at || $subscription->end_at < now())
                                            <button class="badge btn-danger">Expired </button>
                                          @elseif($subscription->end_at->diffInMonths(now()) < 2)
                                              <button class="badge btn-warning">Expiring </button>
                                          @else
                                              <button class="badge btn-success">Active </button>
                                          @endif
                                        </td>
                                        <td class="dashboard__order-history-table-item order-status ">
                                            <select>
                                                <option>Manage</option>
                                                <option>Renew</option>
                                                <option>Cancel</option>
                                            </select>
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
                            {{-- 
                              <div class="shoping-cart__mobile">
                                <div class="shoping-card">
                                  <div class="shoping-card__img-wrapper">
                                    <img src="src/images/products/img-01.png " alt="product-item">
                                  </div>
                                  <h5 class="shoping-card__product-caption font-body--lg-400">
                                    Green Apple
                                  </h5>
                  
                                  <h6 class="shoping-card__product-price font-body--lg-400">
                                    $45.00
                                  </h6>
                  
                                  <div class="counter-btn-wrapper">
                                    <button class="counter-btn-dec counter-btn" onclick="decrement()">
                                      -
                                    </button>
                                    <input type="number" id="counter-btn-counter" class="counter-btn-counter" min="0" max="1000" placeholder="0">
                                    <button class="counter-btn-inc counter-btn" onclick="increment()">
                                      +
                                    </button>
                                  </div>
                                  <h6 class="shoping-card__product-totalprice font-body--lg-600">
                                    $225.00
                                  </h6>
                                  <button class="close-btn">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M12 23C18.0748 23 23 18.0748 23 12C23 5.92525 18.0748 1 12 1C5.92525 1 1 5.92525 1 12C1 18.0748 5.92525 23 12 23Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                      <path d="M16 8L8 16" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      <path d="M16 16L8 8" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                  </button>
                                </div>
                              </div>      
                            --}}         
                          </div>
                        </div>
                      </section>
                    </div>
                </div>
  
                <!-- Plan  -->
                <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                  {{-- <div class="products-tab__description">
                    <section class="shoping-cart section section--xl pt-0">
                      <div class="row shoping-cart__content">
                        <div class="col-lg-12">
                          <div class="cart-tables">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" class="cart-table-title">Plans</th>
                                    <th scope="col" class="cart-table-title">Price</th>
                                    <th scope="col" class="cart-table-title">Months</th>
                                    <th scope="col" class="cart-table-title">Subtotal</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <!-- Product item  -->
                                    <td class="cart-table-item align-middle">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="payment" id="cash" checked="">
                                            <label class="form-check-label font-body--400" for="cash">
                                                    Enterprise Plan
                                            </label>
                                        </div>
                                    </td>
                                    <!-- Price  -->
                                    <td class="cart-table-item order-date align-middle">
                                      {!!cache('settings')['currency_symbol']!!} 14.00
                                    </td>
                                    <!-- quantity -->
                                    <td class="cart-table-item order-total align-middle">
                                      <div class="counter-btn-wrapper">
                                        <button class="counter-btn-dec counter-btn" onclick="decrement()">
                                          -
                                        </button>
                                        <input type="number" id="counter-btn-counter" class="counter-btn-counter" min="0" max="1000" placeholder="0">
                                        <button class="counter-btn-inc counter-btn" onclick="increment()">
                                          +
                                        </button>
                                      </div>
                                    </td>
                                    <!-- Subtotal  -->
                                    <td class="cart-table-item order-subtotal align-middle">
                                      <div class="
                                          d-flex
                                          justify-content-between
                                          align-items-center
                                        ">
                                        <p class="font-body--md-500">$70.00</p>
                                        <button class="delete-item">
                                          <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                            <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                        </button>
                                      </div>
                                    </td>
                                  </tr>
                                  @foreach ($plans as $plan)
                                    <tr>
                                      <!-- Product item  -->
                                      <td class="cart-table-item align-middle">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="payment" id="cash">
                                              <label class="form-check-label font-body--400" for="cash">
                                                      {{$plan->description}}
                                              </label>
                                          </div>
                                        
                                      </td>
                                      <!-- Price  -->
                                      <td class="cart-table-item order-date align-middle">
                                        {!!cache('settings')['currency_symbol']!!} {{$plan->hour_rate}}
                                      </td>
                                      <!-- quantity -->
                                      <td class="cart-table-item order-total align-middle">
                                        <div class="counter-btn-wrapper">
                                          <button class="counter-btn-dec counter-btn" onclick="decrement()">
                                            -
                                          </button>
                                          <input type="number" id="counter-btn-counter" class="counter-btn-counter" min="0" max="1000" placeholder="0">
                                          <button class="counter-btn-inc counter-btn" onclick="increment()">
                                            +
                                          </button>
                                        </div>
                                      </td>
                                      <!-- Subtotal  -->
                                      <td class="cart-table-item order-subtotal align-middle">
                                        <div class="
                                            d-flex
                                            justify-content-between
                                            align-items-center
                                          ">
                                          <p class="font-body--md-500">$70.00</p>
                                          <button class="delete-item">
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z" stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                              <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                          </button>
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
                                  <!-- Subtotal  -->
                                  <div class="bill-card__memo-item subtotal">
                                    <p class="font-body--md-400">Subtotal:</p>
                                    <span class="font-body--md-500">$84.00</span>
                                  </div>
                                  <!-- Shipping  -->
                                  <div class="bill-card__memo-item shipping">
                                    <p class="font-body--md-400">Shipping:</p>
                                    <span class="font-body--md-500">Free</span>
                                  </div>
                                  <!-- total  -->
                                  <div class="bill-card__memo-item total">
                                    <p class="font-body--lg-400">Total:</p>
                                    <span class="font-body--xl-500">$84.00</span>
                                  </div>
                                </div>
                                <form action="#">
                                  <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                                    Place Order
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>                   
                  </div> --}}
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
<script>
    $('#addbankaccount').click(function(e){
        e.preventDefault();
        $('#pills-plans-tab').tab('show');
    })
</script>
@endpush