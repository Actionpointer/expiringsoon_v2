@extends('layouts.app')
@push('styles')

@endpush
@section('title') Order Details #{{$order->id}} | Expiring Soon @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
                              {{$order->address->street}},  {{$order->address->city ? $order->address->city->name :'' }},  {{$order->address->state->name}}
                            @else
                              {{$order->user->state->name}}
                            @endif
                          </p>
                        </div>
                        <div class="dashboard__details-card-item__inner">
                          <div class="dashboard__details-card-item__inner-contact">
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
                                {{$order->shop->address}}, {{$order->shop->city ? $order->shop->city->name : ''}} , {{$order->shop->state->name}}
                            </p>
                          @elseif($order->deliveryfee)
                            <p class="font-body--md-400">
                              {{$order->shop->address}}, {{$order->shop->city ? $order->shop->city->name : ''}} , {{$order->shop->state->name}}
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
                        @elseif($order->deliveryfee)
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
                            <h5 class="title">Order: {{$order->slug}}</h5>
                            {{-- <p class="details order-id"> {{$order->trackingcode}}</p> --}}
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
                          <p class="font-body--md-500">{!!$order->user->country->currency->symbol!!} {{number_format($order->subtotal, 2)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">VAT :</h5>
                          <p class="font-body--md-500">{!!$order->user->country->currency->symbol!!} {{number_format($order->vat, 2)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Shipping:</h5>
                          <p class="font-body--md-500">{!!$order->user->country->currency->symbol!!} {{number_format($order->deliveryfee, 0)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Delivery Type:</h5>
                          <p class="font-body--md-500">
                            {{ucwords($order->deliverer)}} 
                          </p>
                        </div>
                        
                        <div class="dashboard__totalpayment-card-body-item total" >
                          <h5 class="font-body--xl-400">Total:</h5>
                          <p class="font-body--xl-500">{!!$order->user->country->currency->symbol!!} {{number_format($order->total, 2)}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Progress  -->
              
              @include('vendor.shop.orders.status',['status'=> $order->status])

              @if($order->status == "disputed")
              <form method="post" class="my-5" id="orderstatus" action="{{route('admin.order.resolution')}}" onsubmit="return confirm('Are you sure the dispute has been resolved between the parties?');">@csrf
                <div class="mb-3 text-center">
                  <label for="states" class="font-body--md-600">Resolve Dispute: </label>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                      <div class="d-flex flex-column px-3">
                        <input type="hidden" name="order_id" value=" {{$order->id}}">
                        <div class="d-flex justify-content-center align-items-center">
                          <div class="contact-form-input">
                            <label for="lname2">Pay Seller % </label>
                            <input type="number" max="100" id="seller" value="100" name="seller" required/>
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Refund Buyer %</label>
                            <input type="number" max="100" id="buyer" value="0"  name="buyer"  required/>
                          </div>
                        </div>
                        
                        
                        <div class="pt-2 pt-md-0 text-center">
                          <div class="contact-form-input contact-form-textarea" style="margin-top:20px">
                            <textarea name="remark" id="remark" placeholder="Remark" required></textarea>
                          </div>
                          <div class="contact-form-input" style="margin-top:20px">
                            <input name="pin" id="pin" placeholder="Enter Pin" required>
                          </div>
                          <button class="button button--md w-100" type="submit" id="btn-update">
                            Close Dispute
                          </button>
                        </div>
                      </div>
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
                                            <a href="#" class="dashboard__product-item" >
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
                                          
                                        </td>
                                        <!-- Price  -->
                                        <td class="dashboard__order-history-table-item order-date align-middle "     >
                                            {!!$order->shop->country->currency->symbol!!} {{number_format($item->amount, 0)}}
                                        </td>
                                        <!-- quantity -->
                                        <td class="dashboard__order-history-table-item order-total align-middle" >
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
                        @if($order->status == 'disputed')
                        <div class="comment-box pt-0"> 
                          <h5 class="font-body--md-400">Write a message to buyer & seller </h5>
                          <form action="{{route('admin.order.message')}}" method="POST" class="mt-2" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="order_id" value=" {{$order->id}}">
                            <input type="hidden" name="sender_id" value=" {{auth()->id()}}">
                            <input type="hidden" name="sender_type" value="App\Models\User">
                            <div class="contact-form--input contact-form--input-area mb-0" id="comments">
                              <label for="message">Message</label>
                              <textarea name="body" id="message" placeholder="Write your message here…"></textarea>
                            </div>
                            <div class="contact-form__content-group mt-3">
                              <div class="contact-form-input">
                                <label for="origin">To </label>
                                <select id="" name="receiver" class="form-control-lg w-100 border" required style="min-width:250px">
                                  <option selected disabled>Select </option>
                                  <option value="shop">Shop </option>
                                  <option value="buyer">Buyer </option>
                                </select>
                              </div>
                              <div class="contact-form-input ">
                                <label for="attach"> Attach file <span class="text-muted small">optional</span></label>
                                <input type="file" name="file" id="" class="">
                              </div>
                            </div>
                            
                            <div class="contact-form-button">
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
                            @forelse ($order->messages->sortByDesc('created_at') as $message)
                            <div class="user">
                              <div class="user-img">
                                @if($message->sender_type == 'App\Models\User')
                                  <img class="rounded-circle" alt="user-photo" @if(!$order->user->pic) src="{{asset('images/site/avatar.png')}}" @else src="{{Storage::url($order->user->pic)}}" @endif > 
                                @elseif($message->sender_type == 'App\Models\Shop')
                                <img class="rounded-circle" alt="user-photo" @if(!$order->shop->banner) src="{{asset('images/site/avatar.png')}}" @else src="{{Storage::url($order->shop->banner)}}" @endif >
                                @else
                                <img class="rounded-circle" alt="user-photo" src="{{asset('images/site/avatar.png')}}"> 
                                @endif
                              </div>
                              <div class="user-message-info">
                                <div class="user-name">
                                  <h5 class="font-body--md-500">
                                    {{$message->sender->name}}
                                  </h5>
                                  <p class="date">{{$message->created_at->format('d M,Y h:i A')}}</p>
                                </div>
                                <p class="user-message">
                                  {{$message->body}} 
                                  @if($message->attachment) 
                                    <a href="{{Storage::url($message->attachment)}}" target="_blank">{{$message->attachment}}</a> 
                                  @endif
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
<!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')
<script>
    $('#seller').on('input',function(){
      $('#buyer').val(100 - $(this).val())
    })
    $('#buyer').on('input',function(){
      $('#seller').val(100 - $(this).val())
    })
</script>
@endpush
