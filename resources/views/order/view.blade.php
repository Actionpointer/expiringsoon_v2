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
            <a href="#">
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
@include('layouts.session')
<!-- dashboard Secton Start  -->
<div class="dashboard section">
  <div class="container">
    <div class="row dashboard__content">
      @include('layouts.navigation')
      <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Order Details  -->
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Order Details</h2>
                {{-- <h2 class="font-body--md-400">Vendor:<br /> --}}
                <a href="{{route('order.messages',$order)}}">{{$order->messages->count()}} Messages 
                    @if(auth()->id() == $order->user_id), {{$order->messages->where('sender_type','App\Models\User')->whereNull('read_at')->count()}}   
                    @else , {{$order->messages->where('sender_type','App\Models\Shop')->whereNull('read_at')->count()}}
                    @endif unread
                </a>
              </div>

              <div class="dashboard__details-content">
                <div class="row">
                  <div class="col-xl-8">
                    <div class="dashboard__details-card">
                      <div class="dashboard__details-card-item">
                        <h5 class="dashboard__details-card-title"> Customer </h5>
                        <!-- billing Address -->
                        <div class="dashboard__details-card-item__inner">
                          <h2 class="font-body--lg-400 name">
                              {{$order->user->name}}
                          </h2>
                          <p class="font-body--md-400">
                            @if($order->address_id)
                              {{$order->address->street}},  {{$order->address->city->name}},  {{$order->address->state->name}}
                            @else
                              {{$order->user->state->name}}
                            @endif
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
                            <p class="font-body--md-400"> @if($order->address_id) {{$order->address->contact_phone}} @else {{$order->user->mobile}} @endif</p>
                          </div>
                        </div>
                      </div>
                      <div class="dashboard__details-card-item">
                        <h5 class="dashboard__details-card-title"> Vendor </h5>
                        <!-- Shipping Address -->
                        <div class="dashboard__details-card-item__inner">
                          <h2 class="font-body--lg-400 name">
                              {{$order->shop->name}}
                          </h2>
                          @if(auth()->user()->role != 'shopper')
                            <p class="font-body--md-400">
                                {{$order->shop->address}}, {{$order->shop->city->name}} , {{$order->shop->state->name}}
                            </p>
                          @elseif($order->deliveryfee == '0.00')
                            <p class="font-body--md-400">
                              {{$order->shop->address}}, {{$order->shop->city->name}} , {{$order->shop->state->name}}
                            </p>
                          @endif
                        </div>
                        @if(auth()->user()->role != 'shopper')
                          <div class="dashboard__details-card-item__inner">
                            <div class=" dashboard__details-card-item__inner-contact   " >
                              <h5 class="title">Email</h5>
                              <p class="font-body--md-400">
                                  {{$order->shop->email}}
                              </p>
                            </div>
                            <div class=" dashboard__details-card-item__inner-contact " >
                              <h5 class="title">Phone</h5>
                              <p class="font-body--md-400"> {{$order->shop->mobile}}</p>
                            </div>
                          </div>
                        @elseif($order->deliveryfee == '0.00')
                          <div class="dashboard__details-card-item__inner">
                            <div class=" dashboard__details-card-item__inner-contact   " >
                              <h5 class="title">Email</h5>
                              <p class="font-body--md-400">
                                  {{$order->shop->email}}
                              </p>
                            </div>
                            <div class=" dashboard__details-card-item__inner-contact " >
                              <h5 class="title">Phone</h5>
                              <p class="font-body--md-400"> {{$order->shop->mobile}}</p>
                            </div>
                          </div>
                        @endif
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
                          <h5 class="font-body--md-400">Payment Status:</h5>
                          <p class="font-body--md-500">
                              @if($order->payment) Paid @else Pending @endif
                          </p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Subtotal:</h5>
                          <p class="font-body--md-500">{!!session('locale')['currency_symbol']!!} {{number_format($order->subtotal, 2)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">VAT :</h5>
                          <p class="font-body--md-500">{!!session('locale')['currency_symbol']!!} {{number_format($order->vat, 2)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Shipping:</h5>
                          <p class="font-body--md-500">{!!session('locale')['currency_symbol']!!} {{number_format($order->deliveryfee, 0)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Delivery Type:</h5>
                          <p class="font-body--md-500">
                            @if($order->deliveryfee == '0.00')
                              Pickup
                            @elseif($order->deliveryByVendor())
                              Vendor Courier
                            @else 
                              Admin Courier
                            @endif
                          </p>
                        </div>
                        
                        <div class="dashboard__totalpayment-card-body-item total" >
                          <h5 class="font-body--xl-400">Total:</h5>
                          <p class="font-body--xl-500">{!!session('locale')['currency_symbol']!!} {{number_format($order->total, 2)}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
                <div class="progress__bar progress__bar-1x">
                  <div class="progress__bar-item active">
                    <div class="progress__bar-item-ball">
                      <p class=" font-body--md-400 count-number count-number-active " > 01 </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Order received</h2>
                  </div>

                  <div class="progress__bar-item @if(in_array($order->status,['processing','shipped','delivered','completed'])) active @endif">
                    <div class="progress__bar-item-ball">
                      <p class=" font-body--md-400 count-number count-number-active " > 02 </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Processing</h2>
                  </div>

                  <div class="progress__bar-item @if(in_array($order->status,['shipped','delivered','completed'])) active @endif">
                    <div class="progress__bar-item-ball">
                      <p class=" font-body--md-400 count-number count-number-active " > 03 </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Shipped for Delivery</h2>
                  </div>

                  <div class="progress__bar-item @if(in_array($order->status,['delivered','completed'])) active @endif">
                    <div class="progress__bar-item-ball">
                      <p class=" font-body--md-400 count-number count-number-active " > 04 </p>
                      <span class="check-mark">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </span>
                    </div>
                    <h2 class="font-body--md-400">Delivered</h2>
                  </div>
                </div>
              
              

              <div class="dashboard__order-history-table dashboard__order-history-table__product-content">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="dashboard__order-history-table-title"> Product </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Price </th>
                        <th scope="col" class="dashboard__order-history-table-title" > quantity </th>
                        <th scope="col" class="dashboard__order-history-table-title"> Subtotal </th>
                        @if($order->status == 'completed' && $order->reviews->where('reviewable_type','App\Models\Product')->isEmpty())
                          <th scope="col" class="dashboard__order-history-table-title"> Review </th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($order->items as $item)
                          <tr>
                              <!-- Product item  -->
                              <td class="dashboard__order-history-table-item align-middle">
                                  <a href="#" class="dashboard__product-item" >
                                      <div class="dashboard__product-item-img">
                                          <img src="{{Storage::url($item->product->photo)}}" alt=" {{$item->product->name}}" />
                                      </div>
                                      <h5 class="font-body--md-400"> {{$item->product->name}}</h5>
                                      {{-- <div style="margin-top:-20px">
                                          <a href="{{route('admin.shop.show',$order->shop)}}" target="_blank" style="color:#00b207;font-weight:500">
                                              <div style="font-size:12px">
                                                  <span style="font-weight:400;color:#333">Vendor:</span>  
                                                  {{$order->shop->name}}
                                              </div>
                                          </a>
                                      </div> --}}
                                  </a>
                              </td>
                              <!-- Price  -->
                              <td class="dashboard__order-history-table-item order-date align-middle "     >
                                  {!!session('locale')['currency_symbol']!!} {{number_format($item->amount, 0)}}
                              </td>
                              <!-- quantity -->
                              <td class="dashboard__order-history-table-item         order-total         align-middle         "     >
                                  <p class="order-total-price">x  {{$item->quantity}}</p>
                              </td>
                              <!-- Subtotal  -->     
                              <td class="dashboard__order-history-table-item order-status align-middle " style="text-align: left" >
                                  <p class="font-body--md-500">{!!session('locale')['currency_symbol']!!} {{number_format($order->total, 0)}}</p>
                              </td>
                              <td class="align-middle">
                                
                                @if($order->status == 'completed' && $order->reviews->where('reviewable_type','App\Models\Product')->where('reviewable_id',$item->product_id)->isEmpty())
                                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#review{{$item->product_id}}">Review Product</button>
                                @endif
                                @if($order->status == 'completed' &&  $order->reviews->where('reviewable_type','App\Models\Product')->where('reviewable_id',$item->product_id)->isNotEmpty())
                                Reviewed
                                @endif
                              </td>

                          </tr>
                          <div class="modal fade" id="review{{$item->product_id}}" aria-labelledby="review{{$item->product_id}}Label" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="review{{$item->product_id}}Label">Review Product</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h4 class="mb-3">Reviewing:  {{$item->product->name}}</h4>
                                  <form method="post" id="rateService" action="{{route('order.review')}}">@csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                    <div class="contact-form__content">
                                      <div class="bill-card__payment-method-item">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="rating" id="vpoor" value="1"/>
                                          <label class="form-check-label font-body--400" >
                                            <span class="fa fa-star star"></span>
                                            (Very Bad)
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="rating" id="poor" value="2" />
                                          <label class="form-check-label font-body--400" >
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            (Bad)
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="rating" id="fair" value="3" />
                                          <label class="form-check-label font-body--400" >
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            (Fair)
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="rating" id="good" value="4" />
                                          <label class="form-check-label font-body--400" >
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            (Good)
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="rating" id="excellent" value="5" />
                                          <label class="form-check-label font-body--400" >
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            <span class="fa fa-star star"></span>
                                            (Excellent)
                                          </label>
                                        </div>
                                      </div>
                                      <div class="contact-form-input contact-form-textarea" style="margin-top:20px">
                                        <textarea name="comment" id="note" placeholder="Leave a Comment (Optional)"></textarea>
                                      </div>
                                      <div class="form-button">
                                        <button type="submit" id="btn-submit" class="button button--md w-100">Submit</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Order Status -->
            <div class="row">
              @if($order->status !== 'completed' && auth()->user()->role != 'shopper')
                  <div class="col-lg-4" style="margin-top:20px">
                      <form method="post" id="orderstatus" action="{{route('vendor.shop.order.manage',$order->shop)}}">@csrf
                          <input type="hidden" name="order_id" value=" {{$order->id}}">
                          <div class="contact-form__content-group">
                              <div class="contact-form-input">
                                  <label for="states" style="margin-bottom:15px">Update Order Status</label>
                                  <select id="" name="status" class="form-control" required>
                                      
                                      @if($order->status== 'processing')
                                      <option value="shipped">Shipped for Delivery</option>
                                      @endif
                                      @if(in_array($order->status,['processing','shipped']))
                                      <option value="delivered">Delivered</option>
                                      @endif
                                      {{-- @if($order->status == 'processing')
                                      <option value="cancelled">Cancelled</option>
                                      @endif --}}
                                  </select>
                              </div>
                          </div>
                          <div class="contact-form-btn" style="margin-top:-5px">
                              <button class="button button--md askpin" type="button" id="btn-update">
                              Save Status
                              </button>
                          </div>
                      </form>
                  </div>
              @endif

              @if($order->status == 'completed' && $order->reviews->where('reviewable_type','App\Models\Shop')->isEmpty())
                <div class="col-lg-12" style="margin-top:20px">
                    <div class="comment-box">
                      <h5 class="font-body--xxxl-500">Review Vendor</h5>          
                      <form method="post" id="rateService" action="{{route('order.review')}}">@csrf
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <input type="hidden" name="shop_id" value="{{$order->shop_id}}">
                        <div class="contact-form__content">
                          <div class="bill-card__payment-method-item d-md-flex justify-content-between">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="rating" id="vpoor" value="1"/>
                              <label class="form-check-label font-body--400" >
                                <span class="fa fa-star star"></span>
                                (Very Poor)
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="rating" id="poor" value="2" />
                              <label class="form-check-label font-body--400" >
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                (Poor)
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="rating" id="fair" value="3" />
                              <label class="form-check-label font-body--400" >
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                (Fair)
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="rating" id="good" value="4" />
                              <label class="form-check-label font-body--400" >
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                (Good)
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="rating" id="excellent" value="5" />
                              <label class="form-check-label font-body--400" >
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                <span class="fa fa-star star"></span>
                                (Excellent)
                              </label>
                            </div>
                          </div>
                          <div class="contact-form-input contact-form-textarea" style="margin-top:20px">
                            <textarea name="comment" id="note" placeholder="Leave a Comment (Optional)"></textarea>
                          </div>
                          <div class="form-button">
                            <button type="submit" id="btn-submit" class="button button--md w-100">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
              @endif
              
              
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')

@endpush
