@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

@endpush
@section('title') {{$shop->name}} Payouts | Expiring Soon @endsection
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
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Shop
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Payouts</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('shop.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                              Withdrawal
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" data-bs-target="#pills-plans" type="button" role="tab" aria-controls="pills-plans" aria-selected="false">
                                Bank Accounts
                          </button>
                      </li>       
                  </ul>
              </div>
            </div>
            <div class="products-tab__content">
              <div class="container">
                  <div class="tab-content" id="pills-tabContent">
                      <!-- General  -->
                      <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                          <div class="products-tab__description">
                                <div class="dashboard__content-card">
                                    <div class="dashboard__content-card-header d-flex justify-content-between">
                                        <h5 class="font-body--xl-500">Request Payout</h5>
                                        <a href="#" class="font-body--lg-500 text-dark">{!!cache('settings')['currency_symbol']!!}{{ number_format($shop->wallet, 2)}}<span class="text-success"> Balance</span> </a>
                                    </div>
                                    <div class="dashboard__content-card-body">
                                        <form method="post">

                                          <div class="contact-form__content">
                                            <div class="contact-form__content-group">
                                              <div class="contact-form-input"> 
                                                <label for="address">Enter Amount *</label>
                                                <input type="number" name="amount" max="{{$shop->wallet}}" id="amount" placeholder="0.00" autocomplete="off" required="">
                                              </div>
                                              <div class="contact-form-input">
                                                <label for="phone">Account</label>
                                                @if($shop->bankaccounts->isNotEmpty())
                                                <select id="states" name="account_id" required="">
                                                    @foreach ($shop->bankaccounts as $account)
                                                        <option value="{{$account->id}}">{{$account->acctname}} Bank 00429892323</option>
                                                    @endforeach  
                                                  
                                                </select>
                                                @else 
                                                <button type="button" class="button button--md bg-dark" id="addbankaccount">Add Bank Account</button>
                                                @endif
                                              </div>
                                          </div>
                                            
                                        </div>
                                        <div class="contact-form-btn">
                                            <button class="button button--md @if($shop->bankaccounts->isEmpty()) button--disable @endif" type="submit" id="btn-payout1">Submit Request</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="dashboard__content-card">
                                    <div class="dashboard__content-card-header">
                                        <h5 class="font-body--xl-500">Withdrawals</h5>
                                    </div>
                                    <div class="dashboard__content-card-body">
                                        <table id="datatable" class="table display" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                  <th scope="col" class="cart-table-title">Date</th>
                                                  <th scope="col" class="cart-table-title">Amount</th>
                                                  <th scope="col" class="cart-table-title">To</th>
                                                  <th scope="col" class="cart-table-title">Status</th>
                                                  <th scope="col" class="cart-table-title">Transaction ID</th>
                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($shop->payouts as $payout)
                                                    <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                                        <!-- item  -->
                                                        <td class="cart-table-item order-date align-middle">
                                                            <span style="font-size:12px;color:#888">{{ $payout->created_at->format('l, F d, Y')}}</span>
                                                        </td>
                                                        <!-- Price  -->
                                                        <td class="cart-table-item order-date align-middle">
                                                            <p class="font-body--lg-500" style="color:#00b207">{!!cache('settings')['currency_symbol']!!}{{ number_format($payout->amount, 2)}}</p>
                                                        </td>
                                                        <td class="cart-table-item order-date align-middle">
                                                          {{$payout->account->bank->name.''.$payout->account->acctno}}
                                                      </td>
                                                        <!-- Stock Status  -->
                                                        <td class="cart-table-item order-date align-middle">
                                                            @if($payout->status == 'pending')
                                                                <p style="color:#cc7817;font-size:14px"><span id="status">Pending</span></p>
                                                            @elseif($payout->status == 'rejected')
                                                            <p style="color:#d92e2e;font-size:14px"><span id="status">Cancelled</span></p>
                                                            @elseif($payment->status == 'processing')
                                                            <p style="color:#d92e2e;font-size:14px;font-weight:500">Processing</p>
                                                            @else 
                                                              <p style="color:#00b207;font-size:14px;font-weight:500">Paid</p>
                                                            @endif
                                                        </td>
                                                        <td class="cart-table-item order-date align-middle">{{$payout->reference}}</td>
                                                        
                                                    </tr>   
                                                @empty
                                                    <div style="margin:auto;padding:1%;text-align:center">
                                                        <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                                                        <br />No Payouts Requests at this time.</span>
                                                    </div>
                                                @endforelse
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                
                          </div>
                      </div>
        
                      <!-- Plan  -->
                      <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                        <div class="products-tab__description">
                          <div class="dashboard__content-card">
                              <div class="dashboard__content-card-header">
                                  <h5 class="font-body--xl-500">Bank Account</h5>
                              </div>
                              <div class="dashboard__content-card-body">
                                @if($shop->bankaccounts->isNotEmpty())
                                    @foreach ($shop->bankaccounts as $account)
                                        <div class="border-bottom pb-3">
                                          <div  style="font-size:15px;margin-bottom:20px">                       
                                              <div style="padding-bottom:10px;margin-top:10px">
                                                  {{$account->bank->name}} <br /> {{$account->acctname}} <br />
                                                  <span style="color:#000;font-weight:500">{{$account->acctno}}</span>
                                                  </br />
                                                  <a href="#" onclick="event.preventDefault();document.getElementById('bankedit'+{{$account->id}}).style.display='block'">Edit</a>
                                              </div>
                                          </div>
                                          <form method="post" id="bankedit{{$account->id}}" action="{{route('bank-info')}}" style="display: none">@csrf
                                              <div class="contact-form__content-group">
                                                  <div class="contact-form-input">
                                                      <label for="bank">Your Bank</label>
                                                      <select id="bank" name="bank" class="form-control-lg w-100 contact-form-input__dropdown border text-muted">
                                                              @foreach($banks as $bank)
                                                              <option value="{{$bank->name}}" @if($shop->bank_id == $bank->id) selected @endif >{{$bank->name}}</option>
                                                              @endforeach
                                                      </select>
                                                  </div>
                      
                                                  <div class="contact-form-input">
                                                      <label for="acctname">Account Name *</label>
                                                      <input type="text" id="acctname" name="acctname" value="{{$shop->acctname}}" placeholder="Account Name" required />
                                                  </div>
                      
                                                  <div class="contact-form-input">
                                                      <label for="address">Account No. *</label>
                                                      <input type="text" name="acctno" id="acctno" value="{{$shop->acctno}}" onkeypress="validate(event)"   autocomplete="off"   maxlength="10"   required />
                                                  </div>
                                              </div>
                                              <div class="contact-form-btn">
                                                  <button class="button button--md" type="submit"> Update Details</button>
                                                  <button class="button button--md bg-danger" type="button" onclick="event.preventDefault();document.getElementById('bankedit').style.display='none'"> Cancel</button>
                                              </div>
                                          </form>
                                        </div>
                                    @endforeach
                                @endif
                                    <form class="my-3" method="post" id="bankinfo" action="#">@csrf
                                        <h4>Add New Bank Account</h4>
                                        <div class="contact-form__content-group mt-3">  
                                            <div class="contact-form-input">
                                                <label for="bank">Your Bank</label>
                                                <select id="country" name="bank" class="form-control-lg w-100 contact-form-input__dropdown border">
                                                    <option selected>- Select -</option>
                                                        @foreach($banks as $bank)
                                                        <option value="{{$bank->name}}">{{$bank->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                        
                                            <div class="contact-form-input">
                                                <label for="acctname">Account No *</label>
                                                <input   type="text"  id="acctnumber"  name="acctno"   placeholder="Account Name"   required />
                                            </div>
                        
                                            <div class="contact-form-input">
                                                <label for="address">BVN. *</label>
                                                <input   type="text"   name="bvn"   id="bvn" autocomplete="off"   maxlength="10"   required />
                                            </div>
                                        </div>
                                        <h6 class="text-muted">Account Name: <span id="account_name">Asuquo Bathelomew</span></h6>
                                        <input type="hidden" name="acctname" required>
                                        <div class="contact-form-btn">
                                            <button class="button button--md" type="submit"> Save Details</button>
                                        </div>
                                    </form>
                                
                              </div>
                          </div>
                          
                        </div>
                      </div>   
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