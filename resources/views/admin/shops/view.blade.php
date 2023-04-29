@extends('layouts.app')

@push('styles')

@endpush
@section('title')Account Settings: {{$shop->name}}  @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('home')}}">
              Admin
              <span> > </span>
            </a>
          </li>
          <li><a href="{{route('admin.shops')}}">Shops</a></li>
          <li class="active"><a href="#">{{$shop->name}}</a></li>
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
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Account Settings  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Account Settings </h5>
                </div>
                <div class="dashboard__content-card-body">
                  <div class="row">
                    <div class="col-lg-5 order-lg-0 order-1">
                        <div class="dashboard__content-card-img flex-column">
                            <div class="dashboard__content-img-wrapper" id="avatar">
                              <img @if(!$shop->banner) src="{{asset('src/images/site/avatar.png')}}"  @else src="{{Storage::url($shop->banner)}}" @endif alt="{{$shop->name}}" />
                            </div>  
                            <div class="dropdown">
                              <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Manage
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form class="d-inline" action="{{route('admin.shop.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                                  <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                  @if(!$shop->approved)
                                  <button type="submit" name="approved" value="1" class="dropdown-item">Approve</button>
                                  @else
                                  <button type="submit" name="approved" value="0" class="dropdown-item">Disapprove</button>
                                  @endif
                                </form>                                      
                              </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-lg-7 order-lg-0 order-2">
                        <h2 class=""> 
                          {{$shop->name}} @if($shop->verified())
                          <svg width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="#00b207" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="#00b207" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                          @endif
                        </h2>
                        
                        <div class="mt-2 dashboard__details-card-item__inner-contact ">
                            <p class="font-body--md-400"> 
                                <span>
                                    <svg width="15" height="15" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 8.36364C16 14.0909 8.5 19 8.5 19C8.5 19 1 14.0909 1 8.36364C1 6.41068 1.79018 4.53771 3.1967 3.15676C4.60322 1.77581 6.51088 1 8.5 1C10.4891 1 12.3968 1.77581 13.8033 3.15676C15.2098 4.53771 16 6.41068 16 8.36364Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8.5 10.8182C9.88071 10.8182 11 9.71925 11 8.36364C11 7.00803 9.88071 5.90909 8.5 5.90909C7.11929 5.90909 6 7.00803 6 8.36364C6 9.71925 7.11929 10.8182 8.5 10.8182Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span> {{$shop->address}} {{$shop->city ? $shop->city->name :''}}, {{$shop->state->name}} ,{{$shop->country->name}}
                            </p>
                            <p class="font-body--md-400">
                                <span class="icon">
                                    <svg width="15" height="15" viewBox="0 0 52 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <g clip-path="url(#clip0)">
                                        <path d="M48.95 5.9502H3.05C1.64172 5.9502 0.5 7.09182 0.5 8.5002V42.5002C0.5 43.9084 1.64162 45.0502 3.05 45.0502H48.95C50.3583 45.0502 51.5 43.9085 51.5 42.5002V8.5002C51.5 7.09192 50.3584 5.9502 48.95 5.9502ZM49.8 42.5003C49.8 42.9697 49.4195 43.3502 48.95 43.3502H3.05C2.58054 43.3502 2.20003 42.9697 2.20003 42.5003V8.5002C2.20003 8.03074 2.58054 7.65023 3.05 7.65023H48.95C49.4195 7.65023 49.8 8.03074 49.8 8.5002V42.5003Z" fill="#000"></path>
                                        <path d="M47.3239 9.35387C47.0993 9.33424 46.8761 9.40467 46.7035 9.5497L27.0939 26.0226C26.4614 26.5542 25.5384 26.5542 24.9059 26.0226L5.29654 9.5496C5.06395 9.35437 4.7448 9.29799 4.45942 9.40178C4.17404 9.50557 3.96566 9.7538 3.91286 10.0529C3.86007 10.3521 3.97084 10.6566 4.20342 10.8518L23.8129 27.3239C25.0768 28.388 26.9231 28.388 28.1871 27.3239L47.7965 10.8519C47.9692 10.707 48.0772 10.4994 48.0968 10.2748C48.1164 10.0501 48.046 9.82691 47.901 9.65429C47.7561 9.48147 47.5485 9.37349 47.3239 9.35387Z" fill="#000"></path>
                                        <path d="M16.8483 27.206C16.5474 27.1388 16.2338 27.2398 16.0286 27.4699L4.12856 40.2199C3.91321 40.4405 3.83412 40.7604 3.92197 41.0559C4.00983 41.3514 4.25079 41.5761 4.55161 41.6433C4.85253 41.7104 5.1661 41.6094 5.37129 41.3793L17.2713 28.6293C17.4867 28.4088 17.5658 28.0888 17.4779 27.7934C17.3901 27.4979 17.1492 27.2731 16.8483 27.206Z" fill="none"></path>
                                        <path d="M35.9714 27.4699C35.7663 27.2398 35.4526 27.1388 35.1517 27.206C34.8508 27.2731 34.6099 27.4979 34.5221 27.7934C34.4342 28.0889 34.5133 28.4088 34.7287 28.6293L46.6287 41.3793C46.9514 41.7098 47.479 41.7221 47.8167 41.407C48.1545 41.0918 48.1788 40.5647 47.8714 40.2198L35.9714 27.4699Z" fill="none"></path>
                                      </g>
                                      
                                    </svg>
                                </span>
                                {{$shop->email}}
                            </p>
                            <p class="font-body--md-400">
                                <span>
                                    <svg width="15" height="15" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M14.4359 2.375C15.9193 2.77396 17.2718 3.55567 18.358 4.64184C19.4441 5.72801 20.2258 7.08051 20.6248 8.56388" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      <path d="M13.5306 5.75687C14.4205 5.99625 15.2318 6.46521 15.8833 7.11678C16.5349 7.76835 17.0039 8.57967 17.2433 9.46949" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      <path d="M7.115 11.6517C8.02238 13.5074 9.5263 15.0049 11.3859 15.9042C11.522 15.9688 11.6727 15.9966 11.8229 15.9851C11.9731 15.9736 12.1178 15.9231 12.2425 15.8386L14.9812 14.0134C15.1022 13.9326 15.2414 13.8833 15.3862 13.8698C15.5311 13.8564 15.677 13.8793 15.8107 13.9364L20.9339 16.1326C21.1079 16.2065 21.2532 16.335 21.3479 16.4987C21.4426 16.6623 21.4815 16.8523 21.4589 17.04C21.2967 18.307 20.6784 19.4714 19.7196 20.3154C18.7608 21.1593 17.5273 21.6249 16.25 21.625C12.3049 21.625 8.52139 20.0578 5.73179 17.2682C2.94218 14.4786 1.375 10.6951 1.375 6.75C1.37512 5.47279 1.84074 4.23941 2.68471 3.28077C3.52867 2.32213 4.6931 1.70396 5.96 1.542C6.14771 1.51936 6.33769 1.55832 6.50134 1.653C6.66499 1.74769 6.79345 1.89298 6.86738 2.067L9.06537 7.1945C9.1219 7.32698 9.14485 7.47137 9.13218 7.61485C9.11951 7.75833 9.07162 7.89647 8.99275 8.017L7.17275 10.7977C7.09015 10.923 7.04141 11.0675 7.03129 11.2171C7.02117 11.3668 7.05001 11.5165 7.115 11.6517V11.6517Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                    
                                    +{{$shop->mobile}}
                                </span>
                            </p>
                            <p class="font-body--md-400">Owned by: <a href="{{route('admin.user.show',$shop->user)}}" target="_blank">{{$shop->user->name}}</a> </p>
                        </div>
                        
                        <div class="card">
                          <div class="card-body">
                              <table class="table small">
                                  <tr><td>No of Products</td><td align="right">{{$shop->products->count()}}</td></tr>
                                  <tr><td>No of Staff</td><td align="right">{{$shop->staff->count()}}</td></tr>
                                  <tr><td>Orders</td><td align="right">{{$shop->orders->count()}}</td></tr>
                                  <tr><td>Wallet</td><td align="right">{!! $shop->country->currency->symbol !!} {{number_format($shop->wallet,2)}}</td></tr>
                                  <tr>
                                    <td>Subscription </td>
                                    <td align="right">
                                        {{$shop->user->subscription->plan->name}} Subscription
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Status </td>
                                    <td align="right">
                                        @if($shop->status)
                                          Active
                                        @else Inactive
                                        @endif
                                    </td>
                                  </tr>
                              </table>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
        
              <!-- Verification -->
              <div class="dashboard__content-card">
                
                  <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Verification Document</h5>
                  </div>
                  <div class="dashboard__content-card-body">
                    <table class="table small">
                        <tr>
                            <th>Document</th>
                            <th>Type</th>
                            <th>Upload Date</th>
                            <th>Status</th>
                            <th align="right"></th>
                        </tr>
                       
                        @forelse($shop->kyc->sortByDesc('user_id') as $kyc)  
                            <tr>
                                <td>
                                  <a href="{{Storage::url($kyc->document)}}" target="_blank">
                                    
                                    <img style="width:50px;height:50px;border:1px solid #ddd;padding:3px" 
                                      @if($kyc->doctype == 'application')
                                         src="{{asset('src/images/site/icon-pdf.jpg')}}" 
                                       @else
                                          src="{{Storage::url($kyc->document)}}" 
                                        @endif> 
                                  </a>
                                </td>
                                <td>{{$kyc->type}}</td>
                                <td>{{$kyc->created_at->format('d-m-Y')}}</td>
                                  <td>
                                    @if(!$kyc->status)
                                      Pending {{$kyc->reason}}
                                    @else
                                      Approved
                                    @endif
                                </td>
                                <td>
                                  @if(!$kyc->status)
                                  <form action="{{route('admin.kyc.manage')}}" method="post" class="d-inline" onsubmit="return confirm('Do you really want to approve document?');">@csrf
                                    <input type="hidden" name="kyc_id" value="{{$kyc->id}}">
                                    <input type="hidden" name="status" value="1">
                                    <button class="btn btn-success" type="submit">Approve</button>
                                  </form>
                                  @endif 
                                  @if(!$kyc->reason)
                                  <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#rateedit{{$kyc->id}}">Reject</button>
                                  @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="rateedit{{$kyc->id}}" tabindex="-1" aria-labelledby="rateedit{{$kyc->id}}ModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="rateedit{{$kyc->id}}ModalLabel">Reject KYC Document</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{{route('admin.kyc.manage')}}" method="post" id="rateedit{{$kyc->id}}">
                                          @csrf 
                                          <input type="hidden" name="kyc_id" value="{{$kyc->id}}">
                                          <div class="contact-form__content my-3">
                                              <div class="contact-form-input">
                                                <label for="hours">Reason</label>
                                                <textarea name="reason" class="form-control" placeholder="Rejection Reason"></textarea>
                                              </div>
                                      
                                              <div class="contact-form-btn">
                                                  <button class="button button--md" type="submit">
                                                      Reject
                                                  </button>
                                                  <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            
                        @empty  
                            <tr><td>No KYC</td></tr>
                        @endforelse
                        
                    </table>
                      
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
