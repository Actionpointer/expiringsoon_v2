@extends('layouts.app')
@push('styles')
<style>
  .user-img{
    margin-right:5px;
    width:40px;
    height:40px;
    
  }
 
</style>
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
                {{-- <a href="{{route('admin.orders')}}">back to list</a> --}}
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
                              {{$order->address->street}},  {{$order->address->city->name}},  {{$order->address->state->name}}
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
                            <p class="font-body--md-400"> {{$order->address->contact_phone}}</p>
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
                          <p class="font-body--md-500">{!!cache('settings')['currency_symbol']!!} {{number_format($order->subtotal, 2)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">VAT 7%:</h5>
                          <p class="font-body--md-500">{!!cache('settings')['currency_symbol']!!} {{number_format($order->vat, 2)}}</p>
                        </div>
                        <div class="dashboard__totalpayment-card-body-item">
                          <h5 class="font-body--md-400">Shipping:</h5>
                          <p class="font-body--md-500">{!!cache('settings')['currency_symbol']!!} {{number_format($order->deliveryfee, 0)}}</p>
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
                          <p class="font-body--xl-500">{!!cache('settings')['currency_symbol']!!} {{number_format($order->total, 2)}}</p>
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
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($order->items as $cart)
                          <tr>
                              <!-- Product item  -->
                                  <td class="dashboard__order-history-table-item align-middle">
                                      <a href="#" class="dashboard__product-item" >
                                          <div class="dashboard__product-item-img">
                                              <img src="{{Storage::url($cart->product->photo)}}" alt=" {{$cart->product->name}}" />
                                          </div>
                                          <h5 class="font-body--md-400"> {{$cart->product->name}}</h5>
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
                                  {!!cache('settings')['currency_symbol']!!} {{number_format($cart->amount, 0)}}
                              </td>
                              <!-- quantity -->
                              <td class="dashboard__order-history-table-item         order-total         align-middle         "     >
                                  <p class="order-total-price">x  {{$cart->quantity}}</p>
                              </td>
                              <!-- Subtotal  -->     
                              <td class="dashboard__order-history-table-item order-status align-middle " style="text-align: left" >
                                  <p class="font-body--md-500">{!!cache('settings')['currency_symbol']!!} {{number_format($order->total, 0)}}</p>
                              </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Order Status -->
            <div class="row">
              @if($order->status != 'completed' && auth()->user()->role != 'shopper')
              <div class="col-lg-4" style="margin-top:20px">
                  <form method="post" id="orderstatus" action="{{route('shop.order.manage',$order->shop)}}">@csrf
                      <input type="hidden" name="order_id" value=" {{$order->id}}">
                      <div class="contact-form__content-group">
                          <div class="contact-form-input">
                              <label for="states" style="margin-bottom:15px">Update Order Status</label>
                              <select id="" name="status" class="form-control" required>
                                  @if($order->status == 'new')
                                  <option value="processing">Processing</option>
                                  @endif
                                  @if(in_array($order->status,['new','processing']))
                                  <option value="shipped">Shipped for Delivery</option>
                                  @endif
                                  @if(in_array($order->status,['new','processing','shipped']))
                                  <option value="delivered">Delivered</option>
                                  @endif
                                  @if(in_array($order->status,['new','processing']))
                                  <option value="cancelled">Cancelled</option>
                                  @endif
                              </select>
                          </div>
                      </div>
                      <div class="contact-form-btn" style="margin-top:-5px">
                          <button class="button button--md" type="submit" id="btn-update">
                          Save Status
                          </button>
                      </div>
                  </form>
              </div>
              @endif
              @if($order->status == 'completed')
              <div class="col-lg-12" style="margin-top:20px">
                  <p style="font-weight:500;font-size:14px">Order has been Completed</p>
              </div>
              @endif
              
              @if($order->status!=='completed')
                <!-- Send Message -->
                <div class="conversation my-4">
                  @if($order->messages->filter(function ($value,$key) {return $value->receiver_id ==auth()->id() || $value->user_id == auth()->id();})->isNotEmpty())
                  <h5 class="font-body--xxxl d-flex justify-content-between pb-3"><span>Conversation</span></h5>
                  <div class="user-comments__list" style="overflow-y:scroll;">
                    @foreach ($order->messages->filter(function ($value,$key) {return $value->receiver_id ==auth()->id() || $value->user_id == auth()->id();}) as $message)
                      <div class="d-flex py-4 border-bottom">
                          @if(!in_array(auth()->user()->role,['shopper','vendor']))
                            <div class="user-img">
                              <img class="rounded-circle" alt="user-photo"
                                  @if($message->user->role == 'vendor')
                                      @if(!$order->shop->banner) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($order->shop->banner)}}" @endif 
                                  @else
                                      @if(!$order->user->pic) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($order->user->pic)}}" @endif 
                                  @endif
                              >
                            </div>

                            <div class="user-message-info">
                                <div class="d-flex ">
                                  <h5 class="font-body--md-500">
                                    @if($message->user->role == 'vendor')
                                      {{$order->shop->name}} 
                                    @endif
                                    @if($message->user->role == 'shopper')
                                      {{$order->user->name}}  
                                    @endif
                                    @if( !in_array($message->user->role,['vendor','shopper']))
                                        Admin
                                    @endif
                                  </h5>
                                  <ul class="inside d-flex">
                                    <li class="text-muted border-top border-white mx-2">{{$message->created_at->format('d M,Y h:i A')}}</li>
                                    <li class="text-muted border-top border-white">
                                      @if($message->receiver->role == 'vendor')
                                          To Seller
                                      @endif
                                      @if($message->receiver->role == 'shopper')
                                          To Buyer 
                                      @endif
                                      @if( !in_array($message->receiver->role,['vendor','shopper']))
                                          To Admin
                                      @endif
                                    </li>
                                  </ul>
                                </div>
      
                                <p class="font-body--sm-400">
                                  {{$message->body}}
                                </p>
                            </div>
                          @else
                            @php $usr = auth()->user()->role == 'shopper'? $order->user_id : $order->shop->owner()->id; @endphp
                            @if($usr == $message->user_id || $usr == $message->receiver_id)
                              <div class="user-img">
                                <img class="rounded-circle" alt="user-photo"
                                    @if($message->user->role == 'vendor')
                                        @if(!$order->shop->banner) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($order->shop->banner)}}" @endif 
                                    @else
                                        @if(!$order->user->pic) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($order->user->pic)}}" @endif 
                                    @endif
                                >
                              </div>

                              <div class="user-message-info">
                                  <div class="d-flex ">
                                    <h5 class="font-body--md-500">
                                      @if($message->user->role == 'vendor')
                                        {{$order->shop->name}} 
                                      @endif
                                      @if($message->user->role == 'shopper')
                                        {{$order->user->name}}  
                                      @endif
                                      @if( !in_array($message->user->role,['vendor','shopper']))
                                          Admin
                                      @endif
                                    </h5>
                                    <ul class="inside"><li class="text-muted border-top border-white">{{$message->created_at->format('d M,Y h:i A')}}</li></ul>
                                  </div>
        
                                  <p class="font-body--sm-400">
                                    {{$message->body}}
                                  </p>
                              </div>
                            @endif
                          @endif
                          
                      </div>
                    @endforeach
                  </div>
                  @endif
                  <form action="{{route('order.message',$order->shop)}}" method="POST"> @csrf
                    <input type="hidden" name="order_id" value=" {{$order->id}}">
                    <div class="contact-form-input mb-0 mt-3">
                      <select id="" name="receiver_id" class="form-control" required >
                          <option value="" selected disabled> Send Message -</option>
                          @if(auth()->user()->role != 'shopper')
                          <option value="{{$order->user->id}}">To Buyer</option>
                          @endif
                          @if(auth()->user()->role != 'vendor')
                            <option value="{{$order->shop->owner()->id}}" @if($order->user_id == auth()->id()) selected @endif > To Vendor </option>
                          @endif
                      </select>
                    </div>
                    <div class="d-flex py-0">
                        <textarea name="body" class="form-control" placeholder="Write Message"></textarea>
                        <button class="button button--outline rounded-0 my-0">Send</button>
                    </div>
                  </form>
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
