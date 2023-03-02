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
                <p>Date: {{$order->created_at->format('d/m/Y')}}</p>
              </div>

              <div class="dashboard__details-content">
                  <div class="my-3">
                      <div class="row">
                          <div class="col-lg-6">
                            <div class="dashboard__totalpayment-card">
                              <div class="dashboard__totalpayment-card-header">
                                <div class="dashboard__totalpayment-card-header">
                                  <div class="dashboard__totalpayment-card-header-item">
                                    <h5 class="title">Vendor</h5>
                                    
                                  </div>
                                </div>
                              </div>
          
                              <div class="dashboard__totalpayment-card-body">
                                <div class=" dashboard__details-card-item__inner-contact" >
                                  <h2 class="font-body--lg-400">
                                    <a href="{{route('vendor.show',$order->shop)}}" class="text-success">{{$order->shop->name}}</a>
                                  </h2>
                                  <p class="font-body--md-400">
                                    {{$order->shop->address}}, {{$order->shop->city ? $order->shop->city->name : ''}} , {{$order->shop->state->name}}
                                  </p>
                                </div>
                              
                                
                                <div class=" dashboard__details-card-item__inner-contact" >
                                  <h5 class="title">Email</h5>
                                  <p class="font-body--md-400">
                                      {{$order->shop->email}}
                                  </p>
                                </div>
                                <div class=" dashboard__details-card-item__inner-contact" >
                                  <h5 class="title">Phone</h5>
                                  <p class="font-body--md-400"> 
                                    {{$order->shop->mobile}}
                                  </p>
                                </div>
                                
                              
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="dashboard__totalpayment-card">
                              <div class="dashboard__totalpayment-card-header">
                                <div class="dashboard__totalpayment-card-header">
                                  <div class="dashboard__totalpayment-card-header-item">
                                    <h5 class="title">Order: {{$order->slug}}</h5>
                                  </div>
                                </div>
                              </div>
      
                              <div class="dashboard__totalpayment-card-body">

                                <div class="dashboard__totalpayment-card-body-item">
                                  <h5 class="font-body--md-400">Payment Status:</h5>
                                  <p class="font-body--md-500">
                                      @if($order->payment_item) Paid @else Pending @endif
                                  </p>
                                </div>

                                <div class="dashboard__totalpayment-card-body-item">
                                  <h5 class="font-body--md-400">Subtotal:</h5>
                                  <p class="font-body--md-500">
                                    {!!$order->shop->country->currency->symbol!!} {{number_format($order->subtotal, 2)}}
                                  </p>
                                </div>

                                <div class="dashboard__totalpayment-card-body-item">
                                  <h5 class="font-body--md-400">VAT :</h5>
                                  <p class="font-body--md-500">{!!$order->shop->country->currency->symbol!!} {{number_format($order->vat, 2)}}</p>
                                </div>

                                <div class="dashboard__totalpayment-card-body-item">
                                  <h5 class="font-body--md-400">Shipping:</h5>
                                  <p class="font-body--md-500">{!!$order->shop->country->currency->symbol!!} {{number_format($order->deliveryfee, 0)}}</p>
                                </div>

                                <div class="dashboard__totalpayment-card-body-item">
                                  <h5 class="font-body--md-400">Delivery Type:</h5>
                                  <p class="font-body--md-500">
                                    {{ucwords($order->deliverer)}}
                                  </p>
                                </div>
                                
                                <div class="dashboard__totalpayment-card-body-item total" >
                                  <h5 class="font-body--xl-400">Total:</h5>
                                  <p class="font-body--xl-500">{!!$order->shop->country->currency->symbol!!} {{number_format($order->total, 2)}}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Progress  -->
              
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
              
              <!-- Update status  -->
              @if($allow_update)
              <form method="post" class="my-5" id="orderstatus" action="{{route('order.update')}}" onsubmit="return confirm('Are you sure?');">@csrf
                <input type="hidden" name="order_id" value=" {{$order->id}}">
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center">
                    <div class="py-1">
                        <label for="states" class="font-body--md-600">Update Order Status: </label>
                    </div>
                    <div class="mx-3 pt-1">
                      <select id="" name="status" class="form-control" required style="min-width:250px">
                        <option selected disabled>Select </option>
                          @if($order->status == 'processing' && $order->statuses->firstWhere('name','processing')->created_at->addHours(cache('settings')['order_processing_to_cancel_period']) > now())
                            <option value="cancelled">Cancel</option>
                          @endif
                          @if($order->status == 'delivered' && $order->statuses->firstWhere('name','delivered')->created_at->addHours(cache('settings')['order_delivered_to_acceptance_period']) > now())
                            <option value="rejected">Reject and Request Refund</option>
                            <option value="completed">Received</option>
                          @endif
                          
                          @if($order->status == 'rejected' && $order->statuses->firstWhere('name','rejected')->created_at->addHours(cache('settings')['order_rejected_to_returned_period']) > now())
                            <option value="returned"> Returned </option>
                          @endif
                      </select>
                    </div>
                    <div class="pt-2 pt-md-0">
                      <button class="button button--md" type="submit" id="btn-update">
                        Save Status
                      </button>
                    </div>
                </div>
                
              </form>
              @endif

            </div>

            <div class="dashboard__order-history mt-4">
              <section class="products-tab section">
                <div class="products-tab__btn">
                    <div class="container">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                    Items
                                </button>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false">
                                  @if($order->status == 'disputed') Dispute Resolution @else Messages @endif
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="products-tab__content">
                  <div class="tab-content" id="pills-tabContent">
                    <!-- Products Description  -->
                    <div class="tab-pane fade active show" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                        <div class="row products-tab__description">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col" class="dashboard__order-history-table-title"> Product </th>
                                  <th scope="col" class="dashboard__order-history-table-title"> Review </th>
                                  <th scope="col" class="dashboard__order-history-table-title"> Price </th>
                                  <th scope="col" class="dashboard__order-history-table-title" > quantity </th>
                                  <th scope="col" class="dashboard__order-history-table-title"> Subtotal </th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                
                                @foreach($order->items as $item)
                                    <tr>
                                        <!-- Product item  -->
                                        <td class="dashboard__order-history-table-item align-middle">
                                            <a href="{{route('product.show',$item->product)}}" class="dashboard__product-item" >
                                                <div class="dashboard__product-item-img">
                                                    <img src="{{Storage::url($item->product->photo)}}" alt=" {{$item->product->name}}" />
                                                </div>
                                                <h5 class="font-body--md-400"> {{$item->product->name}}</h5>
                                            </a>
                                        </td>
                                        <td class="dashboard__order-history-table-item align-middle">
                                          @if($order->status == 'completed' &&  $order->reviews->where('reviewable_type','App\Models\Product')->where('reviewable_id',$item->product_id)->isNotEmpty())
                                          <button class="btn btn-sm btn-info" >View Review</button>
                                          @endif
                                          @if($order->status == 'completed' &&  $order->reviews->where('reviewable_type','App\Models\Product')->where('reviewable_id',$item->product_id)->isEmpty())
                                          <button class="btn btn-sm btn-info" >Add Review</button>
                                          @endif
                                        </td>
                                        <!-- Price  -->
                                        <td class="dashboard__order-history-table-item order-date align-middle "     >
                                            {!!$order->shop->country->currency->symbol!!} {{number_format($item->amount, 0)}}
                                        </td>
                                        <!-- quantity -->
                                        <td class="dashboard__order-history-table-item         order-total         align-middle         "     >
                                            <p class="order-total-price">x  {{$item->quantity}}</p>
                                        </td>
                                        <!-- Subtotal  -->     
                                        <td class="dashboard__order-history-table-item order-status align-middle " style="text-align: left" >
                                            <p class="font-body--md-500">{!!$order->shop->country->currency->symbol!!} {{number_format($item->total, 0)}}</p>
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
                    
                    <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                      <div class="dashboard__content-card-body single-blog">
                        @if(!in_array($order->status,['cancelled','completed','closed'] ))
                        <div class="comment-box pt-0">
                          
                          <h5 class="font-body--md-400">Write a message to @if($order->status == 'disputed') the Arbitrator @else Vendor @endif</h5>
                          <form action="{{route('order.message')}}" method="POST" class="mt-2">@csrf
                            <input type="hidden" name="order_id" value=" {{$order->id}}">
                            <input type="hidden" name="sender_id" value=" {{$order->user_id}}">
                            <input type="hidden" name="sender_type" value="App\Models\User">
                            @if($order->status == 'disputed')
                            <input type="hidden" name="receiver_id" value="{{$order->arbitrator_id}}">
                            <input type="hidden" name="receiver_type" value="App\Models\User">
                            @else
                            <input type="hidden" name="receiver_id" value="{{$order->shop_id}}">
                            <input type="hidden" name="receiver_type" value="App\Models\Shop">
                            @endif
                            <div class="contact-form--input contact-form--input-area mb-0" id="comments">
                              <label for="message">Message</label>
                              <textarea name="body" id="message" placeholder="Write your message here…"></textarea>
                            </div>
                            <div class="my-2"><a href="#" class="font-body--md-400 text-success">Attach file</a> </div>
                            <div class="contact-form-button mt-0">
                              <button class="button button--md" type="submit">
                                Send Message
                              </button>
                            </div>
                          </form>
                          
                        </div>
                        @endif
                        <div class="user-comments pb-0">
                          <h5 class="font-body--xxxl">Messages</h5>
                          <div class="user-comments__list" style="overflow-y:scroll;height:400px">
                            @forelse ($messages as $message)
                            <div class="user">
                              <div class="user-img">
                                @if($message->sender_type == 'App\Models\User')
                                  <img class="rounded-circle" alt="user-photo" @if(!$order->user->pic) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($order->user->pic)}}" @endif > 
                                @elseif($message->sender_type == 'App\Models\Shop')
                                <img class="rounded-circle" alt="user-photo" @if(!$order->shop->banner) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($order->shop->banner)}}" @endif >
                                @else
                                <img class="rounded-circle" alt="user-photo" src="{{asset('src/images/site/avatar.png')}}"> 
                                @endif
                              </div>
                              <div class="user-message-info">
                                <div class="user-name">
                                  <h5 class="font-body--md-500">
                                    @if($message->sender_id == $order->user_id || ($message->sender_id == $order->shop_id && $message->sender_type == 'App\Models\Shop'))
                                      {{$message->sender->name}}
                                    @else
                                    Arbitrator
                                    @endif
                                  </h5>
                                  <p class="date">{{$message->created_at->format('d M,Y h:i A')}}</p>
                                </div>
                                <p class="user-message">
                                  {{$message->body}}
                                </p>
                              </div>
                            </div>
                            @empty
                            <div class="text-center">
                              <p>No Message</p>
                            </div>
                            @endforelse
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>

          </div>
      </div>
    </div>
  </div>
</div>
  
@endsection
@push('scripts')

@endpush
