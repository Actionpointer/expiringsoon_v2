@extends('layouts.app')

@push('styles')
<style>
  .docimg {
      width: 10%;
      margin-right: 5px;
      float: left;
  }
  .docimg img {
      width: 100%;
  }
  .docinfo {
      width: 70%;
  }
  #topUp,#theFile,#theDoc {
      display: none;
    }
</style>
@endpush
@section('title')Account Settings | User Dashboard @endsection
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
                <path
                  d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('home')}}">
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  
  @if(Session::has('result'))
      <div class="mb-0 @if(Session('result')) notify @else error @endif" >
          <p style="color:#fff">{{Session('message')}}</p>
      </div>
  @endif
  <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('shop.navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Account Settings  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Account Settings </h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" id="editinfo" action="{{route('profile.update')}}" enctype="multipart/form-data">@csrf
                    <div class="row">
                      <div class="col-lg-7 order-lg-0 order-2">
                        <div class="contact-form__content">
                          <div class="contact-form-input">
                            <label for="fname">Username </label>
                            <input type="text" name="username" value="{{$shop->slug}}" placeholder="Choose Username" id="username" disabled   />
                          </div>
                          <div class="contact-form-input">
                            <label for="fname">Shop Name </label>
                            <input type="text" name="name" value="{{$shop->name}}" placeholder=" Name"/>
                          </div>
                          <div class="contact-form-input">
                            <label for="lname2">Shop Email </label>
                            <input type="email" name="email" value="{{$shop->email}}" placeholder="Email" />
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Phone Number</label>
                            <input type="number" name="phone" value="{{$shop->phone}}" placeholder="Phone Number" onkeypress="validate(event)" />
                          </div>
                          <div id="process" style="font-size:13px;font-weight:500"></div>
                          {{-- <div class="contact-form-btn">
                            <button class="button button--md" type="submit"> Save Details</button>
                          </div> --}}
                        </div>
                      </div>
                      <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img flex-column">
                            
                            <div class="dashboard__content-img-wrapper" id="avatar">
                              <img @if(!$shop->banner) src="{{asset('img/avatar.png')}}"  @else src="{{Storage::url($shop->banner)}}" @endif alt="{{$shop->fname}} {{$shop->lname}}"  onclick="performClick('theFile');"  id="imgPreview"   />
                            </div>
                            <div>
                              <input type="file" name="photo" id="theFile" onchange="readURL(this,'imgPreview')" accept=".png, .jpg, .jpeg" />
                              <button type="button" class="button w-100 mt-3 button--outline" id="btn-avatar" onclick="performClick('theFile');">Upload Avatar/Logo</button>
                            </div>
                            
                        </div>
                      </div>
                      <div class="col-lg-12 order-lg-0 order-1">
                        <div class="contact-form-btn">
                          <button class="button button--md" type="submit"> Save Details</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Delivery Address  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500"> Store/Pick-Up Address</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" id="editaddress" action="{{route('edit-address')}}">@csrf
                    <input type="hidden" name="uid2" value="{{$shop->id}}">
                    <div class="contact-form__content">
                      <div class="contact-form-input">
                        <label for="address">Street Address *</label>
                        <input type="text" name="address" value="{{$shop->address}}" placeholder="Delivery Address" required/>
                      </div>
                      <div class="contact-form__content-group">
                        <!-- states -->
                        <div class="contact-form-input">
                          <label for="states">state</label>
                          <select id="states" name="state" class="contact-form-input__dropdown">
                          
                            @foreach ($states as $state)
                              <option value="{{$state->name}}" @if($shop->state_id == $state->id) selected @endif>{{$state->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div id="process2" style="font-size:13px;font-weight:500"></div>
                    </div>
                    <div class="contact-form-btn">
                      <button class="button button--md" type="submit"> Save Details</button>
                  </div>
                  </form>
                </div>
              </div>

              <!-- Bank Info  -->
              <div class="dashboard__content-card">
                
                <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Bank Information</h5>
                </div>
                <div class="dashboard__content-card-body">
                    @if($user->bankinfo)
                      <div id="process4" style="font-size:15px;margin-bottom:20px">                       
                          <div style="padding-bottom:10px;margin-top:10px">
                            {{$user->bankinfo->bank}} <br /> {{$user->bankinfo->acctname}} <br />
                              <span style="color:#000;font-weight:500">{{$user->bankinfo->acctno}}</span>
                              </br />
                              <a href="#" onclick="event.preventDefault();document.getElementById('bankedit').style.display='block'">Edit</a>
                          </div>
                      </div>
                      <form method="post" id="bankedit" action="{{route('bank-info')}}" style="display: none">@csrf
                        <div class="contact-form__content-group">
                            <div class="contact-form-input">
                                <label for="bank">Your Bank</label>
                                <select id="bank" name="bank" class="form-control-lg w-100 contact-form-input__dropdown border">
                                      @foreach($banks as $bank)
                                      <option value="{{$bank->name}}" @if($user->bankinfo->bank == $bank->name) selected @endif >{{$bank->name}}</option>
                                      @endforeach
                                </select>
                            </div>

                            <div class="contact-form-input">
                              <label for="acctname">Account Name *</label>
                              <input type="text" id="acctname" name="acctname" value="{{$user->bankinfo->acctname}}" placeholder="Account Name" required />
                            </div>

                            <div class="contact-form-input">
                              <label for="address">Account No. *</label>
                              <input type="text" name="acctno" id="acctno" value="{{$user->bankinfo->acctno}}" onkeypress="validate(event)"   autocomplete="off"   maxlength="10"   required />
                            </div>
                        </div>
                        <div class="contact-form-btn">
                            <button class="button button--md" type="submit"> Update Details</button>
                            <button class="button button--md bg-danger" type="button" onclick="event.preventDefault();document.getElementById('bankedit').style.display='none'"> Cancel</button>
                        </div>
                      </form>
                    @else
                    <form method="post" id="bankinfo" action="{{route('bank-info')}}">@csrf
                      <div class="contact-form__content-group">
                          <div class="contact-form-input">
                              <label for="bank">Your Bank</label>
                              <select id="bank" name="bank" class="form-control-lg w-100 contact-form-input__dropdown border">
                                  <option selected>- Select -</option>
                                    @foreach($banks as $bank)
                                    <option value="{{$bank->name}}">{{$bank->name}}</option>
                                    @endforeach
                              </select>
                          </div>

                          <div class="contact-form-input">
                            <label for="acctname">Account Name *</label>
                            <input   type="text"  id="acctname"  name="acctname"   placeholder="Account Name"   required />
                          </div>

                          <div class="contact-form-input">
                            <label for="address">Account No. *</label>
                            <input   type="text"   name="acctno"   id="acctno"   onkeypress="validate(event)"   autocomplete="off"   maxlength="10"   required />
                          </div>
                      </div>
                      <div class="contact-form-btn">
                          <button class="button button--md" type="submit"> Save Details</button>
                      </div>
                    </form>
                    @endif
                </div>
              </div>
                    
              <!-- Verification -->
              <div class="dashboard__content-card">
                
                  <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Verification Document</h5>
                    <p style="font-size:11px;color:#888;text-transform:uppercase">Documents required for payout requests</p>
                  </div>
                  <div class="dashboard__content-card-body">
                    <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px">Upload any of the following documents so we can authenticate your account</div>
                    <div id="process6">
                      @if($shop->kyc->isNotEmpty())
                        @foreach($shop->kyc as $kyc)
                          <div style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                            <div class="docimg">
                                <a href="{{$kyc->document}}" target="_blank">
                                  <img @if($kyc->doctype =='PDF') src="{{asset('img/icon-pdf.jpg')}}" @else src="{{asset('img/icon-jpg.jpg')}}" @endif>
                                </a>
                            </div>
                            <div class="docinfo">
                              <span style="font-size:14px">{{$kyc->type}}</span>
                                <br /><span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($kyc->status == 'Approved') #00b207; @else #ff0000; @endif">{{$kyc->status}}</span>
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>

                    <form method="post" enctype="multipart/form-data" id="uploadDoc" action="{{route('upload_id')}}">@csrf
                        <div class="contact-form__content-group">
                          <div class="col-lg-8" style="margin-top:10px">
                              <label for="idtype" style="font-size:14px">Select ID Type *</label>
                              <select id="idtype" name="idType" class="form-control-lg w-100 contact-form-input__dropdown border"  style="margin-top:10px;margin-bottom:10px"  required>
                                <option value="" selected>- Select -</option>
                                <option value="Driver's Licence">Driver's Licence</option>
                                <option value="Internatonal Passport">Internatonal Passport</option>
                                <option value="National Identity Card">National Identity Card</option>
                              </select>

                              <input type="file" name="theDoc" id="theDoc" onchange="loadDoc(event)" accept=".pdf, .png, .jpg, .jpeg" required />
                              <img src="{{asset('img/file-select.png')}}" onclick="performClick('theDoc');" style="width:100%;margin-bottom:5px" id="upload">
                          </div>
                        </div>
                        <div class="contact-form-btn">
                          <button class="button button--md" type="submit" id="btn-doc">
                              Save Document
                          </button>
                        </div>
                    </form>
                  
                  </div>
              </div>

              <!-- Request Payout -->
              <div class="dashboard__content-card" id="requestPayout">
                
                  <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Request Payout</h5>
                    <p style="font-size:11px;color:#888;text-transform:uppercase">Payout threshold is ₦{{$minThreshold}}</p>
                  </div>
                  <div class="dashboard__content-card-body">
                    <div id="process5">
                      <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px">Balance: 
                        <span style="color:#00b207;font-weight:500">₦ {{number_format($shop->wallet, 2)}}</span>
                        </br />
                      </div>
                      
                      <span style="font-size:11px;color:#888">PAYOUT HISTORY | 
                        <a href="{{route('shop.payouts',$shop)}}" style="color:#00b207">VIEW ALL</a>
                      </span>
                      
                      @foreach($shop->payouts->take(5) as $payout)
                          <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-top:10px;margin-bottom:10px">
                              <span style="color:#00b207;font-weight:500">₦ {{number_format($payout->amount, 0)}} on {{$payout->created_at->format('d M Y')}}</span> 
                              <br/>
                              @if($payout->status =='Pending')
                                <span style="font-size:11px;text-transform:uppercase;font-weight:500;color:#d92e2e">{{$payout->status}}</span>
                              @else
                                  <span style="font-size:11px;text-transform:uppercase;font-weight:500">{{$payout->status}}</span>
                              @endif
                          </div>
                      @endforeach
                      
                      
                    </div>
                    <!-- <div id="process5" style="font-size:13px"></div> -->
                    <form method="post" id="payouts" action="{{route('shop.payout',$shop)}}">@csrf
                        <div class="contact-form__content">
                          <div class="contact-form-input">
                              <label for="address">Enter Amount *</label>
                              <input type="text" name="payout" id="payout" placeholder="0.00" onkeypress="validate(event)" autocomplete="off" required/>
                          </div>
                        </div>
                        <div class="contact-form-btn">
                          @if($shop->kyc->where('status','Approved') && $shop->wallet > $minThreshold)
                            <button class="button button--md" type="submit" id="btn-payout1">Submit Request</button>
                          @else 
                            <button class="button button--md button--disable" type="submit" id="btn-payout1">Submit Request</button>
                          @endif
                        </div>
                    </form>
                  </div>
              </div>
           
              <div class="dashboard__content-card">
                  <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Discounts</h5>
                  </div>
                  <div class="dashboard__content-card-body">
                      <div id="process3" style="font-size:15px;margin-bottom:20px">
                          
                              <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-top:10px;display:flex;justify-content:space-between">
                                  <div>30 Days: <span style="color:#00b207;font-weight:500">{{$shop->discounts->where('expiry',30)->first() ? $shop->discounts->where('expiry',30)->first()->discount: 0}} % Discount</span></div>
                                  <a href="javascript:void(0)" class="edit-discount text-success mx-5" data-period="30" data-discount="{{$discount = $shop->discounts->where('expiry',30)->first() ? $shop->discounts->where('expiry',30)->first()->discount: 0}}">Edit</a>
                              </div>
                              </br />
                              <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-top:10px;display:flex;justify-content:space-between">
                                <div>60 Days: <span style="color:#00b207;font-weight:500">{{$discount = $shop->discounts->where('expiry',60)->first() ? $shop->discounts->where('expiry',60)->first()->discount: 0}} % Discount</span></div>
                                <a href="javascript:void(0)" class="edit-discount text-success mx-5" data-period="60" data-discount="{{$discount = $shop->discounts->where('expiry',60)->first() ? $shop->discounts->where('expiry',60)->first()->discount: 0}}">Edit</a>
                              </div>
                              </br />
                              <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-top:10px;display:flex;justify-content:space-between">
                                <div>90 Days: <span style="color:#00b207;font-weight:500">{{$discount = $shop->discounts->where('expiry',90)->first() ? $shop->discounts->where('expiry',90)->first()->discount: 0}} % Discount</span></div>
                                <a href="javascript:void(0)" class="edit-discount text-success mx-5" data-period="90" data-discount="{{$discount = $shop->discounts->where('expiry',90)->first() ? $shop->discounts->where('expiry',90)->first()->discount: 0}}">Edit</a>
                              </div>
                              </br />
                          
                      </div>
                      <form method="post" id="discount_form" action="{{route('shop.discounts',$shop)}}" style="display:none">@csrf
                          <div class="contact-form__content-group">
                              <!-- states -->
                              <div class="contact-form-input">
                                  <label for="discount_period">Expiry Period</label>
                                  <select id="discount_period" name="expirydate" class="form-control-lg w-100 contact-form-input__dropdown border">
                                      <option value="30">1 Month</option>
                                      <option value="60">2 Months</option>
                                      <option value="90">3 Months</option>
                                  </select>
                              </div>
                              <div class="contact-form-input">
                                  <label for="address">Discount (Percentage) *</label>
                                  <input type="number" name="discount" id="discount_value" placeholder="Discount (Numbers Only)" min="0" autocomplete="off" required/>
                              </div>
                          </div>
                          <div class="contact-form-btn">
                              <button class="button button--md" type="submit">Save Discount</button>
                          </div>
                      </form>
                      
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
<script>
  function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

  function performClick(elemId) {
    var elem = document.getElementById(elemId);
    if(elem && document.createEvent) {
        var evt = document.createEvent("MouseEvents");
        evt.initEvent("click", true, false);
        elem.dispatchEvent(evt);
    }
  }
        
  function readURL(input,output) {
      console.log(input.id);
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
          $('#'+output).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $('.edit-discount').click(function(){
      var period = $(this).attr('data-period')
      var discount = $(this).attr('data-discount')
      $('#discount_period option[value="'+period+'"]').prop('selected', true)
      $('#discount_value').val(discount)
      $('#discount_form').show();
  })
</script>
@endpush
