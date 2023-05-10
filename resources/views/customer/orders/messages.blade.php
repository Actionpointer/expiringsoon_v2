@extends('layouts.app')
@push('styles')
<style>
  /* .user-img{
    margin-right:5px;
    width:40px;
    height:40px;
    
  } */
 
</style>
@endpush
@section('title') Order Messages #{{$order->id}} | Expiring Soon @endsection
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
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header d-md-flex justify-content-between">
                <h5 class="font-body--xl-500">Order Messages</h5>
                <a  @if($order->user_id == auth()->id()) href="{{route('order.show',$order)}}" @else href="{{route('vendor.shop.order.view',[$order->shop,$order])}}" @endif>Back to Order</a>
              </div>

              <div class="dashboard__content-card-body single-blog">
                @if(in_array($order->status,['processing','shipped','delivered'] ))
                <div class="comment-box">
                  @if($order->user_id == auth()->id())
                  <h5 class="font-body--md-400">Write a message to Vendor</h5>
                  <form action="{{route('order.message')}}" method="POST" class="mt-2">@csrf
                    <input type="hidden" name="order_id" value=" {{$order->id}}">
                    <input type="hidden" name="sender_id" value=" {{$order->user_id}}">
                    <input type="hidden" name="sender_type" value="App\Models\User">
                    <div class="contact-form--input contact-form--input-area mb-0" id="comments">
                      <label for="message">Message</label>
                      <textarea name="body" id="message" placeholder="Write your message here…"></textarea>
                    </div>
                    
                    <div class="contact-form-button">
                      <button class="button button--md" type="submit">
                        Send Message
                      </button>
                    </div>
                  </form>
                  @else
                  <h5 class="font-body--md-400">Write a message to Buyer</h5>
                  <form action="{{route('vendor.shop.order.message',$order->shop)}}" method="POST" class="mt-2">@csrf
                    <input type="hidden" name="order_id" value=" {{$order->id}}">
                    <input type="hidden" name="sender_id" value="{{$order->shop_id}}">
                    <input type="hidden" name="sender_type" value="App\Models\Shop">
                    <div class="contact-form--input contact-form--input-area mb-0" id="comments">
                      <label for="message">Message</label>
                      <textarea name="body" id="message" placeholder="Write your message here…"></textarea>
                    </div>
                    
                    <div class="contact-form-button">
                      <button class="button button--md" type="submit">
                        Send Message
                      </button>
                    </div>
                  </form>
                  @endif
                </div>
                @endif
                <div class="user-comments">
                  <h5 class="font-body--xxxl">Messages</h5>
                  <div class="user-comments__list" style="overflow-y:scroll;">
                    @forelse ($order->messages->sortByDesc('created_at') as $message)
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
                            @if($message->sender_type == 'App\Models\Shop'){{$order->shop->name}} @else {{$order->user->name}} @endif
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
    </div>
  </div>
</div>
<!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')
@include('layouts.front')
@endpush
