@extends('layouts.app')
@push('styles')
    
@endpush
@section('title')
    Payment Failed
@endsection
@section('main')
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
        <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb">
        <div class="container">
            <ul class="breedcrumb__content">
                <li>
                    <a href="index.html">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span> &gt; </span>
                    </a>
                </li>
                <li class="active"><a href="404.html">404 Error Page</a></li>
            </ul>
        </div>
    </div>
</div>

<section class="section section--xl">
    <div class="container">
        <div class="error__content">
            <div class="error__content-img">
                <img src="{{asset('images/site/transaction_failed.png')}}" alt="404" class="img-fluid">
            </div>
            {{-- <h2 class="font-title--lg">Payment of </h2> --}}
            {{-- <p>Payment of {!!$payment->currency->symbol!!}{{$payment->amount}} for 
                @switch($payment->items->first()->paymentable_type) 
                    @case('App\Models\Order') Orders
                    @break
                    @case('App\Models\Subscription') Subscriptions
                    @break
                    @case('App\Models\Adset') Adsets
                    @break
                @endswitch --}}
                was not successfully, please try again.</p>
                <div class="button-group">
                    <a href="index.html" class="button button--md">Back to Home</a>
                    <a href="index.html" class="button button--md">Go to Orders</a>
                </div>
            
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{asset('src/js/home2.js')}}"></script>
@include('layouts.front')
@endpush
