@extends('layouts.app')
@push('styles')

@endpush
@section('title') Order Details #{{$order->id}} | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('home')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" > 
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.orders')}}">
              Order
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Order #{{$order->id}}</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  

  <!-- dashboard Secton Start  -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Order Details  -->
              <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                  <h2 class="font-body--xl-500">Order Details</h2>
                  <h2 class="font-body--md-400">Vendor:<br />
                  <a href="{{route('admin.orders')}}">back to list</a>
                </div>

                <div class="dashboard__details-content">
                  <div class="row">
                    <div class="col-xl-8">
                      <div class="dashboard__details-card">
                        <div class="dashboard__details-card-item">
                          <h5 class="dashboard__details-card-title"> Billing Address </h5>
                          <!-- billing Address -->
                          <div class="dashboard__details-card-item__inner">
                            <h2 class="font-body--lg-400 name">
                               {{$order->user->name}}
                            </h2>
                            <p class="font-body--md-400">
                               {{$order->address->street}}  {{$order->address->city->name}}, {{$order->address->state->name}}
                            </p>
                          </div>
                          <div class="dashboard__details-card-item__inner">
                            <div
                              class="dashboard__details-card-item__inner-contact">
                              <h5 class="title">Email</h5>
                              <p class="font-body--md-400">
                                 {{$order->user->email}}
                              </p>
                            </div>
                            <div class=" dashboard__details-card-item__inner-contact">
                              <h5 class="title">Phone</h5>
                              <p class="font-body--md-400"> {{$order->user->mobile}}</p>
                            </div>
                          </div>
                        </div>
                        <div class="dashboard__details-card-item">
                          <h5 class="dashboard__details-card-title"> Shipping Address </h5>
                          <!-- Shipping Address -->
                          <div class="dashboard__details-card-item__inner">
                            <h2 class="font-body--lg-400 name">
                               {{$order->recipient}}
                            </h2>
                            <p class="font-body--md-400">
                               {{$order->deliveryaddress}}
                            </p>
                          </div>
                          <div class="dashboard__details-card-item__inner">
                            <div class=" dashboard__details-card-item__inner-contact   " >
                              <h5 class="title">Email</h5>
                              <p class="font-body--md-400">
                                 {{$order->user->email}}
                              </p>
                            </div>
                            <div class=" dashboard__details-card-item__inner-contact " >
                              <h5 class="title">Phone</h5>
                              <p class="font-body--md-400"> {{$order->deliverycontact}}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4">
                      <div class="dashboard__totalpayment-card">
                        <div class="dashboard__totalpayment-card-header">
                          <div class="dashboard__totalpayment-card-header">
                            <div class="dashboard__totalpayment-card-header-item">
                              <h5 class="title">Tracking Code:</h5>
                              <p class="details order-id"> {{$order->trackingcode}}</p>
                            </div>
                          </div>
                        </div>

                        <div class="dashboard__totalpayment-card-body">
                          <div class="dashboard__totalpayment-card-body-item">
                            <h5 class="font-body--md-400">Payment Method:</h5>
                            <p class="font-body--md-500"> {{$order->paymentmethod}}</p>
                          </div>
                          <div class="dashboard__totalpayment-card-body-item">
                            <h5 class="font-body--md-400">Subtotal:</h5>
                            <p class="font-body--md-500">N {{number_format($order->subtotal, 2)}}</p>
                          </div>
                          <div class="dashboard__totalpayment-card-body-item">
                            <h5 class="font-body--md-400">VAT 7%:</h5>
                            <p class="font-body--md-500">N {{number_format($order->vat, 2)}}</p>
                          </div>
                          <div class="dashboard__totalpayment-card-body-item">
                            <h5 class="font-body--md-400">Shipping:</h5>
                            <p class="font-body--md-500">N {{number_format($order->deliveryfee, 0)}}</p>
                          </div>
                          <div class="dashboard__totalpayment-card-body-item total" >
                            <h5 class="font-body--xl-400">Total:</h5>
                            <p class="font-body--xl-500">N {{number_format($order->total, 2)}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              @if($order->deliverystatus =='Processing')
                <div class="progress__bar progress__bar-1x">
                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class="
                          font-body--md-400
                          count-number count-number-active
                        "
                      >
                        01
                      </p>
                      <span class="check-mark">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Order received</h2>
                  </div>

                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class="
                          font-body--md-400
                          count-number count-number-active
                        "
                      >
                        02
                      </p>
                      <span class="check-mark">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Processing</h2>
                  </div>

                  <div class="progress__bar-item">
                    <div class="progress__bar-item-ball">
                      <p class="
                          font-body--md-400
                          count-number count-number-active
                        "
                      >
                        03
                      </p>
                      <span class="check-mark">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Shipped for Delivery</h2>
                  </div>

                  <div class="progress__bar-item">
                    <div class="progress__bar-item-ball">
                      <p class="
                          font-body--md-400
                          count-number count-number-active
                        "
                      >
                        04
                      </p>
                      <span class="check-mark">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Delivered</h2>
                  </div>
                </div>
              @endif
              @if($order->deliverystatus =='Shipped')
                <div class="progress__bar progress__bar-1x">
                    <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class=" font-body--md-400 count-number count-number-active "> 01 </p>
                        <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                            <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Order received</h2>
                    </div>

                    <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class=" font-body--md-400 count-number count-number-active "> 02 </p>
                        <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                            <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Processing</h2>
                    </div>

                    <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                        <p class=" font-body--md-400 count-number count-number-active "> 03 </p>
                        <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Shipped for Delivery</h2>
                    </div>

                    <div class="progress__bar-item">
                    <div class="progress__bar-item-ball">
                        <p class=" font-body--md-400 count-number count-number-active
                        ">
                        04
                        </p>
                        <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                            <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        </span>
                    </div>
                    <h2 class="font-body--md-400">Delivered</h2>
                    </div>
                </div>
              @endif
              @if($order->deliverystatus =='Delivered')
                <div class="progress__bar progress__bar-1x">
                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class="
                          font-body--md-400
                          count-number count-number-active
                        "
                      >
                        01
                      </p>
                      <span class="check-mark">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Order received</h2>
                  </div>

                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class="
                          font-body--md-400
                          count-number count-number-active
                        "
                      >
                        02
                      </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" >
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833"   stroke="currentColor"   stroke-width="2"   stroke-linecap="round"   stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Processing</h2>
                  </div>

                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class=" font-body--md-400 count-number count-number-active" > 03 </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833"   stroke="currentColor"   stroke-width="2"   stroke-linecap="round"   stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Shipped for Delivery</h2>
                  </div>

                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class=" font-body--md-400 count-number count-number-active ">  04 </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833"   stroke="currentColor"   stroke-width="2"   stroke-linecap="round"   stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Delivered</h2>
                  </div>
                </div>
              @endif

                <div class="dashboard__order-history-table dashboard__order-history-table__product-content">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="dashboard__order-history-table-title"> Product </th>
                          <th scope="col" class="dashboard__order-history-table-title"> Price </th>
                          <th scope="col" class="dashboard__order-history-table-title" > quantity </th>
                          <th scope="col" class="dashboard__order-history-table-title"> Subtotal </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($order->items as $cart)
                            <tr>
                                <!-- Product item  -->
                                    <td class="dashboard__order-history-table-item align-middle">
                                        <a href="#" class="dashboard__product-item" >
                                            <div class="dashboard__product-item-img">
                                                <img src=" {{$cart->product->photo}}" alt=" {{$cart->product->product}}" />
                                            </div>
                                            <h5 class="font-body--md-400"> {{$cart->product->product}}</h5>
                                            <div style="margin-top:-20px">
                                                <a href="{{route('admin.shop.show',$order->shop)}}" target="_blank" style="color:#00b207;font-weight:500">
                                                    <div style="font-size:12px">
                                                        <span style="font-weight:400;color:#333">Vendor:</span>  
                                                        {{$order->shop->name}}
                                                    </div>
                                                </a>
                                            </div>
                                        </a>
                                    </td>
                                <!-- Price  -->
                                <td class="dashboard__order-history-table-item order-date align-middle "     >
                                    N {{number_format($cart->product->price, 0)}}
                                </td>
                                <!-- quantity -->
                                <td class="dashboard__order-history-table-item         order-total         align-middle         "     >
                                    <p class="order-total-price">x  {{$order->qty}}</p>
                                </td>
                                <!-- Subtotal  -->     
                                <td class="dashboard__order-history-table-item order-status align-middle " style="text-align: left" >
                                    <p class="font-body--md-500">N {{number_format($order->total, 0)}}</p>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Order Status -->
                <div class="col-lg-4" style="margin-top:20px">
                    @if($order->deliverystatus!=='Delivered')
                        <form method="post" id="orderstatus">
                            <input type="hidden" name="orderstatus" value=" {{$order->id}}">
                            <div class="contact-form__content-group">
                                <div class="contact-form-input">
                                    <label for="states" style="margin-bottom:15px">Update Order Status</label>
                                    <select id="zip" name="status" class="contact-form-input__dropdown" >
                                        <option selected>- Select -</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Shipped">Shipped for Delivery</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="contact-form-btn" style="margin-top:-5px">
                                <button class="button button--md" type="submit" id="btn-update">
                                Save Status
                                </button>
                            </div>
                        </form>
                    @else
                        <p style="font-weight:500;font-size:14px">Order has been Completed</p>
                    @endif
                </div>

                <!-- Send Message -->
                <div class="col-lg-8" style="margin-top:20px">
                    @if($order->deliverystatus!=='Delivered')
                        <form method="post" id="adminMessage">
                            <input type="hidden" name="order_id" value=" {{$order->id}}">
                            <div class="contact-form__content">

                                <div class="contact-form-input">
                                    <label for="states" style="margin-bottom:15px">Compose Message</label>
                                    <select id="states" name="sendto" class="contact-form-input__dropdown" required >
                                        <option value="" selected>- Send To -</option>
                                        <option value=" {{$order->user->id}}">Buyer</option>
                                        <option value="">Vendor </option>
                                    </select>
                                </div>
                                <label for="states" style="margin-bottom:10px">Subject</label>
                                <div class="contact-form-input">
                                    <input type="text" name="sub" id="sub" placeholder"Type Subject" required />
                                </div>
                                <div class="contact-form--input contact-form--input-area">
                                    <textarea name="msg" id="msg" cols="auto" rows="auto" placeholder="Type Message" required ></textarea>
                                </div>
                            </div>
                            <div class="contact-form-btn" style="margin-top:-5px">
                                <button class="button button--md" type="submit" id="btn-send">
                                Send Message
                                </button>
                            </div>
                        </form>
                    @endif
                    <div id="messageSent" style="margin-top:10px;font-size:13px;font-weight:500"></div>
                </div>
          </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')

@endpush
