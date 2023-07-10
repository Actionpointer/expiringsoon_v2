@extends('layouts.app')

@push('styles')

@endpush
@section('title') Shop Verification | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"  />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('home')}}"> Shop <span> > </span> </a>
          </li>
          <li class="active"><a href="#">Verification</a></li>
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
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="dashboard__content-card">
                              
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Verification Document</h5>
                <p style="font-size:11px;color:#888">Documents required for payout requests</p>
              </div>
              <div class="dashboard__content-card-body">
                <div class="py-2 text-uppercase">
                  
                  <div class="text-uppercase">Upload all of the following documents so we can authenticate your account</div>  
                  
                  
                </div>
                
                <div class="d-flex py-3 border-top">
                  <div class="docimg text-center">
                    <a href="{{route('profile')}}#verification">
                      <img  @if($user->idcard) 
                              @if($user->idcard->doctype == 'application') 
                                src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                              @else
                                src="{{Storage::url($user->idcard->document)}}" 
                              @endif 
                            @else
                                src="{{asset('src/images/site/icon.jpg')}}"
                            @endif >
                            <small style="font-size:10px;text-decoration:underline" class="text-muted">Go to Profile</small>
                    </a>
                  </div>
                  <div class="docinfo d-flex justify-content-between align-items-center">
                    <div>
                      <a href="{{route('profile')}}#verification" style="font-size:14px;text-transform:uppercase">Owner ID</a>
                        <br />
                        <span style="font-weight:500;font-size:12px;">
                        National ID Card / Driver's License / International Passport
                      </span>
                    </div>
                    @if($user->idcard) 
                        <div>
                          <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($user->idcard->status ) #00b207; @else #ff0000; @endif">
                            @if($user->idcard->status) Approved
                            @elseif($user->idcard->reason) Rejected
                            @else Pending Approval  
                            @endif 
                          </span>
                          @if($user->idcard->reason)
                            <span class="d-block font-body--sm-400 text-danger">{{$user->idcard->reason}}</span>
                          @endif
                        </div> 
                    @endif

                  </div>
                </div>

                <div class="d-flex py-3 border-top">
                  
                  <div class="docimg">
                    <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}x');" class="text-center">
                      <img  @if($shop->addressproof)  
                              @if($shop->addressproof->doctype == 'application')) 
                                src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                              @else
                                src="{{Storage::url($shop->addressproof->document)}}" 
                              @endif 
                            @else
                                src="{{asset('src/images/site/icon.jpg')}}"
                            @endif id="item{{$shop->id}}x_preview"
                      >
                      <small style="font-size:10px;text-decoration:underline" class="text-muted">Upload File</small>
                    </a>
                  </div>

                  <div class="docinfo d-flex justify-content-between align-items-center">
                    <div>
                      <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}x');"  style="font-size:14px;text-transform:uppercase">Address Proof</a>
                        <br />
                        <span style="font-weight:500;font-size:12px">
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
                    <form method="post" enctype="multipart/form-data" action="{{route('vendor.shop.verify',$shop)}}">@csrf
                      <input type="hidden" name="type" value="addressproof">
                      <input type="hidden" name="shop_id" value="{{$shop->id}}">
                      <input type="file" style="display: none" name="document[]" id="item{{$shop->id}}x" onchange="readVURL(this,'item{{$shop->id}}x')" accept=".pdf, .png, .jpg, .jpeg" />
                      <button class="button button--md" id="item{{$shop->id}}x_submit" type="submit" style="display: none">Upload</button>
                    </form>
                  </div>
                </div>

                <div class="d-flex py-3 border-top">
                  
                  <div class="docimg">
                    <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}z');" class="text-center">
                      <img  @if($shop->certificate)  
                              @if($shop->certificate->doctype == 'application')) 
                                src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                              @else
                                src="{{Storage::url($shop->certificate->document)}}" 
                              @endif 
                            @else
                                src="{{asset('src/images/site/icon.jpg')}}"
                            @endif id="item{{$shop->id}}z_preview"
                      >
                      <small style="font-size:10px;text-decoration:underline" class="text-muted">Upload File</small>
                    </a>
                  </div>

                  <div class="docinfo d-flex justify-content-between align-items-center">
                    <div>
                      <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}z');"  style="font-size:14px;text-transform:uppercase">Company Certificate</a>
                        <br />
                        <span style="font-weight:500;font-size:12px">
                        Upload Government Issued Certificate for Proof of Business
                      </span>
                    </div>
                    @if($shop->certificate) 
                        <div>
                          <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($shop->certificate->status ) #00b207; @else #ff0000; @endif">
                            @if($shop->certificate->status) Approved
                            @elseif($shop->certificate->reason) Rejected
                            @else Pending Approval  
                            @endif 
                          </span>
                          @if($shop->certificate->reason)
                            <span class="d-block font-body--sm-400 text-danger">{{$shop->certificate->reason}}</span>
                          @endif
                        </div> 
                    @endif
                  </div>
                  
                  <div class="align-self-center mx-1">
                    <form method="post" enctype="multipart/form-data" action="{{route('vendor.shop.verify',$shop)}}">@csrf
                      <input type="hidden" name="type" value="certificate">
                      <input type="hidden" name="shop_id" value="{{$shop->id}}">
                      <input type="file" style="display: none" name="document[]" id="item{{$shop->id}}z" onchange="readVURL(this,'item{{$shop->id}}z')" accept=".pdf, .png, .jpg, .jpeg" />
                      <button class="button button--md" id="item{{$shop->id}}z_submit" type="submit" style="display: none">Upload</button>
                    </form>
                  </div>
                </div>

                <div class="d-flex py-3 border-top">
                  <div class="docimg">
                    <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}y');" class="text-center">
                      <img src="{{asset('src/images/site/iconm.jpg')}}" id="item{{$shop->id}}y_preview">
                          {{-- @if($shop->companydocs) 
                            @if($shop->companydocs->doctype == 'application') 
                              src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                            @else
                              src="{{Storage::url($shop->companydocs->document)}}" 
                            @endif 
                          @else
                              
                          @endif 
                        src="{{asset('src/images/site/icon-jpg.jpg')}}"  --}}
                        
                      <small style="font-size:10px;text-decoration:underline" class="text-muted">Upload Files</small>
                    </a>
                    
                  </div>
                  <div class="docinfo d-flex justify-content-between align-items-center">
                    <div>
                      <a href="javascript:void(0)" onclick="performClick('item{{$shop->id}}y');" style="font-size:14px;text-transform:uppercase">Other Company Documents</a>
                        <br />
                        <span style="font-weight:500;font-size:12px">
                        Upload all other company documents
                      </span>
                    </div>
                    <div class="d-flex flex-column">
                      @forelse($shop->companydocs as $companydoc) 
                          <div>
                            <a href="{{Storage::url($companydoc->document)}}" target="_blank">File :</a>
                            <span style="font-weight:500;font-size:12px;text-transform:uppercase;color:@if($companydoc->status ) #00b207; @else #ff0000; @endif">
                              @if($companydoc->status) Approved
                              @elseif($companydoc->reason) Rejected
                              @else Pending Approval  
                              @endif 
                            </span>
                            @if($companydoc->reason)
                              <span class="d-block font-body--sm-400 text-danger">{{$companydoc->reason}}</span>
                            @endif
                          </div>  
                        @empty
                      @endforelse
                    </div> 
                  </div>
                  <div class="align-self-center mx-1">
                    <form method="post" enctype="multipart/form-data" action="{{route('vendor.shop.verify',$shop)}}">@csrf
                      <input type="hidden" name="type" value="companydoc">
                      <input type="hidden" name="shop_id" value="{{$shop->id}}">
                      <input type="file" style="display: none" name="document[]" multiple id="item{{$shop->id}}y" onchange="readVURL(this,'item{{$shop->id}}y')" accept=".pdf, .png, .jpg, .jpeg" />
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
      console.log(input.id);
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
          $('#'+output).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

  function readVURL(input,output) {
      
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
