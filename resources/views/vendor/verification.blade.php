@extends('layouts.app')
@push('styles')

@endpush
@section('title'){{$user->name}} | Vendor Verification @endsection
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
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('index')}}">
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Verification</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @if (session('statuss'))
    <div class="alert alert-success">
        {{ session('statuss') }}
    </div>
@endif
  @include('layouts.session')
  <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- User Info -->
            <div class="dashboard__content-card">
                              
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Verification Document</h5>
                  <p style="font-size:11px;color:#888;text-transform:uppercase">Documents required for payout requests</p>
                </div>
                <div class="dashboard__content-card-body">
                  <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px">Upload any of the following documents so we can authenticate your account</div>
                  @php $shop = $user->shops->first();  @endphp
                  <form method="post" enctype="multipart/form-data" id="uploadDoc" action="{{route('shop.kyc',$shop)}}">@csrf
                    <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                      @if($shop->idcard)
                        <div class="docimg">
                          <a href="{{Storage::url($shop->idcard->document)}}" target="_blank">
                            <img @if($shop->idcard->doctype =='PDF') src="{{asset('src/images/site/icon-pdf.jpg')}}" @else src="{{Storage::url($shop->idcard->document)}}" @endif id="idcardpreview">
                          </a>
                          
                        </div>
                        <div class="docinfo d-flex justify-content-between align-items-center">
                          <div>
                            <span style="font-size:14px">Owner ID</span>
                              <br />
                              <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->idcard->status ) #00b207; @else #ff0000; @endif">
                                @if($shop->idcard->status) Approved
                                @elseif($shop->idcard->reason) Rejected
                                @else Pending Approval
                                @endif
                              </span>
                              @if($shop->idcard->reason)
                                <span class="d-block font-body--sm-400 text-danger">{{$shop->idcard->reason}}</span>
                              @endif
                          </div>
                          <button class="btn btn-primary" type="button" onclick="performClick('idcard');">@if(!$shop->idcard->reason) Uploaded @else Upload @endif</button>
                      
                        </div>
                      @else
                      <div class="docimg">
                        <a href="javascript:void()" onclick="performClick('idcard');" target="_blank">
                          <img src="{{asset('src/images/site/icon-jpg.jpg')}}" id="idcardpreview">
                        </a>
                        
                      </div>
                      <div class="docinfo d-flex justify-content-between align-items-center">
                        <div>
                          <span style="font-size:14px">Owner ID</span>
                            <br />
                            <span style="font-weight:500;font-size:12px;text-transform:uppercase">
                            Upload National ID Card / Driver's License / International Passport
                          </span>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="performClick('idcard');">Upload</button>
                        
                      </div>
                      @endif
                      <input type="file" style="display: none" name="idcard" id="idcard" onchange="readURL(this,'idcardpreview')" accept=".pdf, .png, .jpg, .jpeg" />
                    </div>
                    <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                      @if($shop->addressproof)
                        <div class="docimg">
                          <a href="{{Storage::url($shop->addressproof->document)}}" target="_blank">
                            <img @if($shop->addressproof->doctype =='PDF') src="{{asset('src/images/site/icon-pdf.jpg')}}" @else src="{{Storage::url($shop->addressproof->document)}}" @endif id="addressproofpreview">
                          </a>
                        </div>
                        <div class="docinfo d-flex justify-content-between align-items-center">
                          <div>
                            <span style="font-size:14px">Address Proof</span>
                              <br />
                              <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->addressproof->status ) #00b207; @else #ff0000; @endif">
                                @if($shop->addressproof->status) Approved
                                @elseif($shop->addressproof->reason) Rejected
                                @else Pending Approval
                                @endif
                              </span>
                              @if($shop->addressproof->reason)
                                <span class="d-block font-body--sm-400 text-danger">{{$shop->addressproof->reason}}</span>
                              @endif
                          </div>
      
                          <button class="btn btn-primary" type="button" onclick="performClick('addressproof');">@if(!$shop->addressproof->reason) Uploaded @else Upload @endif</button>
                        </div>
                      @else
                      <div class="docimg">
                        <a href="javascript:void()" onclick="performClick('addressproof');" target="_blank">
                          <img src="{{asset('src/images/site/icon-jpg.jpg')}}" id="addressproofpreview">
                        </a>
                        
                      </div>
                      <div class="docinfo d-flex justify-content-between align-items-center">
                        <div>
                          <span style="font-size:14px">Address Proof</span>
                            <br />
                            <span style="font-weight:500;font-size:12px;text-transform:uppercase">
                            Upload Utility Bill e.g Electricity Bill, Waste Bill etc
                          </span>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="performClick('addressproof');">Upload</button>
                      </div>
                      @endif
                      <input type="file" style="display: none" name="addressproof" id="addressproof" onchange="readURL(this,'addressproofpreview')" accept=".pdf, .png, .jpg, .jpeg" />
                    </div>
                    <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                      @if($shop->companydoc)
                        <div class="docimg">
                          <a href="{{Storage::url($shop->companydoc->document)}}" target="_blank">
                            <img @if($shop->companydoc->doctype =='PDF') src="{{asset('src/images/site/icon-pdf.jpg')}}" @else src="{{Storage::url($shop->companydoc->document)}}" @endif id="companydocpreview">
                          </a>
                        </div>
                        <div class="docinfo d-flex justify-content-between align-items-center">
                          <div>
                            <span style="font-size:14px">Company Document</span>
                              <br />
                              <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->companydoc->status ) #00b207; @else #ff0000; @endif">
                                @if($shop->companydoc->status) Approved
                                @elseif($shop->companydoc->reason) Rejected
                                @else Pending Approval
                                @endif
                              </span>
                              @if($shop->companydoc->reason)
                                <span class="d-block font-body--sm-400 text-danger">{{$shop->companydoc->reason}}</span>
                              @endif
                          </div>
                          <button class="btn btn-primary"  type="button" onclick="performClick('companydoc');">@if(!$shop->companydoc->reason) Uploaded @else Upload @endif</button>
                        </div>
                      @else
                      <div class="docimg">
                        <a href="javascript:void()" onclick="performClick('companydoc');" target="_blank">
                          <img src="{{asset('src/images/site/icon-jpg.jpg')}}" id="companydocpreview">
                        </a>
                        
                      </div>
                      <div class="docinfo d-flex justify-content-between align-items-center">
                        <div>
                          <span style="font-size:14px">Company Document</span>
                            <br />
                            <span style="font-weight:500;font-size:12px;text-transform:uppercase">
                            Upload CAC
                          </span>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="performClick('companydoc');">Upload</button>
                      </div>
                      @endif
                      <input type="file" style="display: none" name="companydoc" id="companydoc" onchange="readURL(this,'companydocpreview')" accept=".pdf, .png, .jpg, .jpeg" />
                    </div>

                      <div class="contact-form-btn">
                        <button class="button button--md submit" type="button" id="btn-doc">
                            Save Document
                        </button>
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

@endpush
