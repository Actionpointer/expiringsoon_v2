@extends('layouts.app')
@push('styles')
<style>
    .docimgg img{
       width:80px !important;
    }
</style>
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
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
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
                  <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px;">
                    Upload all of the following documents so we can authenticate your account
                  </div>
                  @error('document')
                    <div style="border-bottom:1px solid #ddd;padding-bottom:10px;margin-bottom:10px;font-size:13px;color:red">
                      {{$message}}
                    </div>
                  @enderror
                  
                  <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                    <div class="docimg">
                      <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}x');">
                        <img 
                          @if($shop->addressproof) 
                            @if($shop->addressproof->doctype == 'application')) 
                              src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                            @else
                              src="{{Storage::url($shop->addressproof->document)}}" 
                            @endif 
                          @else
                              src="{{asset('src/images/site/icon-jpg.jpg')}}"
                          @endif 
                          id="item{{$shop->id}}x_preview">
                        <small style="font-size:10px;" class="text-muted">Upload image</small>
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
                      @if($shop->addressproof) 
                          <div>
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
                      @endif
                    </div>
                    <div class="align-self-center mx-1">
                      <form method="post" enctype="multipart/form-data" action="{{route('vendor.kyc')}}">@csrf
                        <input type="hidden" name="type" value="addressproof">
                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                        <input type="file" style="display: none" name="document" id="item{{$shop->id}}x" onchange="readURL(this,'item{{$shop->id}}x')" accept=".pdf, .png, .jpg, .jpeg" />
                        <button class="button button--md" id="item{{$shop->id}}x_submit" type="submit" style="display: none">Upload</button>
                      </form>
                    </div>
                  </div>
                  <div class="d-flex" style="border-bottom: 1px solid #ddd;padding-bottom:20px;margin-top:10px;">
                    <div class="docimg">
                      <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}y');">
                        <img 
                            @if($shop->companydoc) 
                            @if($shop->companydoc->doctype == 'application')) 
                              src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                            @else
                              src="{{Storage::url($shop->companydoc->document)}}" 
                            @endif 
                          @else
                              src="{{asset('src/images/site/icon-jpg.jpg')}}"
                          @endif 
                          src="{{asset('src/images/site/icon-jpg.jpg')}}" 
                          id="item{{$shop->id}}y_preview">
                        <small style="font-size:10px;" class="text-muted">Upload image</small>
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
                      @if($shop->companydoc) 
                          <div>
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
                      @endif
                    </div>
                    <div class="align-self-center mx-1">
                      <form method="post" enctype="multipart/form-data" action="{{route('vendor.kyc')}}">@csrf
                        <input type="hidden" name="type" value="companydoc">
                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                        <input type="file" style="display: none" name="document" id="item{{$shop->id}}y" onchange="readURL(this,'item{{$shop->id}}y')" accept=".pdf, .png, .jpg, .jpeg" />
                        <button class="button button--md" id="item{{$shop->id}}y_submit" type="submit" style="display: none">Upload</button>
                      </form>
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
<script>

    function performClick(elemId) {
      var elem = document.getElementById(elemId);
      if(elem && document.createEvent) {
          var evt = document.createEvent("MouseEvents");
          evt.initEvent("click", true, false);
          elem.dispatchEvent(evt);
      }
    }
        
  function readURL(input,output) {
      
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            if(e.target.result.split(';')[0].split('/')[1] == 'pdf'){
              $('#'+output+'_preview').attr('src', "{{asset('src/images/site/icon-pdf.jpg')}}" );
            }else{
              $('#'+output+'_preview').attr('src', e.target.result);
            }
            
          }
          reader.readAsDataURL(input.files[0]);
      }
      $('#'+output+'_submit').show()
  }
</script>
@endpush
