@extends('layouts.app')
@push('styles')
<style>
    .border-left {
        border-left: 0.0625rem solid #e7eaf3 !important;
    }
    .border-right {
        border-right: 0.0625rem solid #e7eaf3 !important;
    }
    table{
        color: #677788; 
    }
    .table thead th {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    border-width: 0;
}
</style>
@endpush
@section('title') Subscription Plans | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
      <div class="breedcrumb__img-wrapper">
        <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
        <div class="container">
          <ul class="breedcrumb__content">
            <li>
                <a href="{{route('index')}}">
                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span> > </span>
                </a>
            </li>
            
            <li class="active"><a href="#">Plans</a></li>
          </ul>
        </div>
      </div>
  </div>
    <!-- breedcrumb section end   -->

    {{-- <section class="hero section--xl section">
        <div class="container">
            <div class="row hero__content">
                <div class="col-lg-6 order-lg-0 order-2">
                    <div class="hero__text-content">
                        <h5>
                            100% Trusted Organic Food Store
                        </h5>
                        <p class="info">
                            Morbi porttitor ligula in nunc varius sagittis. Proin dui nisi, laoreet ut tempor ac, cursus vitae eros. Cras quis ultricies elit. Proin ac lectus arcu. Maecenas aliquet vel tellus at accumsan. Donec a eros
                            non massa vulputate ornare. Vivamus ornare commodo ante, at commodo felis congue vitae.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-0 order-1">
                    <div class="hero__img-wrapper">
                        <img src="src/images/members/img-08.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <div class="container mt-5">
        <!-- Title -->
        <div class="text-center mb-5">
          <h2>Choose a plan that's right for you.</h2>
          <p>Everything you need. From front to back.</p>
        </div>
  
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead class="text-center">
                    <tr>
                        <th scope="col" class=""></th>
                        @foreach($plans as $enterprise)
                        <th scope="col" class="@if(!$loop->last) border-right @endif ">
                            <span class="">{{$enterprise->name}}</span>
                            {{-- <small class="d-block text-body">$0/mon</small> --}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Shops</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light"></td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="font-body--md-400 py-3 ps-5 mb-0">No of Shops</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                @if($enterprise->shops == '-1')
                                    Unlimited
                                @else
                                    {{$enterprise->shops}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Products</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light"></td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="font-body--md-400 py-3 ps-5 mb-0">No of Products</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                @if($enterprise->products == '-1')
                                    Unlimited
                                @else
                                    {{$enterprise->products}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Payouts</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light "></td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="font-body--md-400 pt-3 pb-3 ps-5 mb-0">Minimum Payouts</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                {!!cache('settings')['currency_symbol']!!}{{number_format($enterprise->minimum_payout)}}
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 pt-3 pb-3 ps-5 mb-0">Maximum Payouts</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                {!!cache('settings')['currency_symbol']!!}{{number_format($enterprise->maximum_payout)}}
                            </td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Commission</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light"></td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">Platform</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                @if($enterprise->commission_percentage){{$enterprise->commission_percentage}}% @endif @if($enterprise->commission_percentage && $enterprise->commission_fixed) + @endif @if($enterprise->commission_fixed) {!!cache('settings')['currency_symbol']!!}{{$enterprise->commission_fixed}} @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Email</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light"></td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">Order Emails</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">Transaction Emails</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </td>
                        @endforeach
                    </tr>
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Support</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light"></td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">Chat</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">Email</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">Phone</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.1" width="20" height="20" rx="10" fill="#00B307"></rect>
                                        <path d="M14.4168 7.125L8.68766 12.8542L6.0835 10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </td>
                        @endforeach
                    </tr>   
                    <tr class="">
                        <th scope="row" class="bg-light py-3 px-4 mb-0">Pricing</th>
                        @foreach($plans as $enterprise)
                            <td class="bg-light"></td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">1 Month</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                {!!cache('settings')['currency_symbol']!!}{{number_format($enterprise->months_1)}}
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">3 Months</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                {!!cache('settings')['currency_symbol']!!}{{number_format($enterprise->months_3)}}
                            </td>
                        @endforeach
                    </tr> 
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5">6 Months</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                {!!cache('settings')['currency_symbol']!!}{{number_format($enterprise->months_6)}}
                            </td>
                        @endforeach
                    </tr> 
                    <tr>
                        <th scope="row" class="font-body--md-400 py-3 ps-5"> 1 Year</th>
                        @foreach($plans as $enterprise)
                            <td class="text-center @if(!$loop->last) border-right @endif">
                                {!!cache('settings')['currency_symbol']!!}{{number_format($enterprise->months_12)}}
                            </td>
                        @endforeach
                    </tr>                
                <tr class="border-top">
                    <th scope="row" class="p-3"> </th>
                    @foreach($plans as $enterprise)
                        <td class="text-center @if(!$loop->last) border-right @endif p-3">
                            @if(auth()->check())
                                @if(auth()->user()->activeSubscription)
                                    @if($enterprise->id == auth()->user()->activeSubscription->id)
                                        <button type="button" class="btn btn-sm btn-primary disabled text-nowrap">
                                            Current Plan 
                                            {{auth()->user()->activeSubscription->start_at->diffInMonths(auth()->user()->activeSubscription->end_at)}} months
                                        </button>
                                    @else
                                        <select id="{{$enterprise->slug}}" class="form-control-sm chooseplan" @if($enterprise->slug == 'free_plan') disabled @endif>
                                            <option value="0">Choose Plan</option>
                                            <option value="1">1 Month</option>
                                            <option value="3">3 Months</option>
                                            <option value="6">6 Months</option>
                                            <option value="12">1 Year</option>
                                        </select>
                                    @endif
                                @else
                                    @if($enterprise->slug == 'free_plan')
                                        <button type="button" class="btn btn-sm btn-primary disabled text-nowrap">
                                            Current Plan 
                                        </button>
                                    @else
                                        <select id="{{$enterprise->slug}}" class="form-control-sm chooseplan" >
                                            <option value="0">Choose Plan</option>
                                            <option value="1">1 Month</option>
                                            <option value="3">3 Months</option>
                                            <option value="6">6 Months</option>
                                            <option value="12">1 Year</option>
                                        </select>  
                                    @endif
                                @endif
                            @else
                                <select id="{{$enterprise->slug}}" class="form-control-sm chooseplan">
                                    <option value="0">Choose Plan</option>
                                    <option value="1">1 Month</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="12">1 Year</option>
                                </select> 
                            @endif
                            
                        </td>  
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
        <!-- End Table -->
    </div>

    <section class="members members--two section section--md" id="confirmation" style="display: none">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-md-6  mb-0">
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
                                    
                                    <div class="bill-card__memo-item total">
                                        <p class="font-body--lg-400">Selected Plan:</p> 
                                        <span class="font-body--xl-500">
                                            <span id="plan_name" > </span> 
                                        </span>
                                    </div>
                                
                                    <!-- total  -->
                                    <div class="bill-card__memo-item total">
                                        <p class="font-body--lg-400">Duration:</p> 
                                        <span class="font-body--xl-500">
                                            <span id="plan_duration" > </span> Months
                                        </span>
                                    </div>
                                    <div class="bill-card__memo-item total">
                                        <p class="font-body--lg-400">Amount:</p>
                                        <span class="font-body--xl-500">{!!cache('settings')['currency_symbol']!!}
                                        <span id="plan_amount" class="ms-0"></span> 
                                        </span>
                                    </div>
                                    <div class="bill-card__memo-item">
                                        <p class="font-body--lg-400">Discount:</p>
                                        <span class="font-body--xl-500">-{!!cache('settings')['currency_symbol']!!}
                                        <span id="discount_text" class="ms-0">0</span> 
                                        </span>
                                    </div>
                                    <div class="bill-card__memo-item mb-3">
                                        <p class="font-body--lg-400">Total:</p>
                                        <span class="font-body--xl-500">{!!cache('settings')['currency_symbol']!!}
                                            <span id="total" class="ms-0">0</span> 
                                        </span>
                                    </div>
                                    <form action="{{route('plans.subscribe')}}" method="post" >@csrf
                                        <input type="hidden" name="plan" id="plan">
                                        <input type="hidden" name="duration" id="duration">
                                        <input type="hidden" name="amount" id="amount">
                                        <div class="">
                                            <div class="newsletter-card__input w-100">
                                                <input type="text" name="coupon" id="coupon_code" placeholder="Enter Code">
                                                <button class="button button--lg" type="button" id="coupon_button"> Apply Coupon </button>
                                            </div>
                                            <small id="coupon_description" class="d-block text-info text-center"></small>
                                        </div>
                                        <input type="hidden" name="discount" id="discount" value="0">
                                        <input type="hidden" name="coupon_used" id="coupon_used">
                                        <div class="form-check py-2">
                                            <label class="form-check-label" for="autorenew" > Auto-renew</label>
                                            <input class="form-check-input checkboxes" type="checkbox" name="auto_renew" value="1" checked>
                                        </div>
                                        <button class="button button--lg w-100" style="margin-top: 20px" type="submit">
                                            Place Order
                                        </button>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection
@push('scripts')
<script>
    var enterprises = @json($enterprises);  
    $('.chooseplan').change(function(){
        $('.chooseplan').not($(this)).val(0);   
        $('#plan_name').text(enterprises[$(this).attr('id')]['name'])
        $('#plan_duration').text($(this).val())
        $('#plan_amount,#total').text(enterprises[$(this).attr('id')]['months_'+$(this).val()])
        $('#plan').val($(this).attr('id'))
        $('#duration').val($(this).val())
        $('#amount').val(enterprises[$(this).attr('id')]['months_'+$(this).val()])
        $('#confirmation').show();
    })

    $('#coupon_button').on('click',function(){
        let code = $('#coupon_code').val()
        let amount = $('#amount').val()
        if(code != ''){
            $.ajax({
                type:'POST',
                dataType: 'json',
                url: "{{route('vendor.applycoupon')}}",
                data:{
                    '_token' : $('meta[name="csrf-token"]').attr('content'),
                    'code': code,
                    'amount': amount,
                },
                success:function(data) {
                    console.log(data)
                    if(data.value != 0){
                        $('#discount').val(data.value);
                        $('#total').text(parseInt(amount) - parseInt(data.value))
                        $('#amount').val(parseInt(amount) - parseInt(data.value))
                        $('#discount_text').html(data.value);
                        $('#coupon_used').val(code);
                    }
                    $('#coupon_description').html(data.description);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            })
        }  
    })
</script>
@endpush
