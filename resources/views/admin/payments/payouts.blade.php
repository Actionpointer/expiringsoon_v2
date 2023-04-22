@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title') Manage Payouts | Expiring Soon @endsection
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
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Payouts</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.admin_navigation')
        <div class="col-lg-9 pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                    <h5 class="font-body--xl-500">Payouts</h5>
                </div>
                <div class="dashboard__content-card-body px-0">
                  <div class="dropdown">
                    <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Manage
                    </button>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  
                      {{-- <form class="d-inline" action="{{route('admin.payouts.manage')}}" method="post">@csrf --}}
                          <input type="hidden" name="payouts[]" >
                          <button type="button" onclick="approve_many()" class="dropdown-item">
                            @if(cache('settings')['automatic_payout'])
                              Pay
                            @else
                              Paid
                            @endif
                          </button>
                          <button type="button" onclick="disapprove_many()" class="dropdown-item">Reject</button>
                      {{-- </form>                                       --}}
                    </div>
                  </div>
                    <table class="table display" style="width:100%;font-size:13px">
                        <thead>
                            <tr>
                              <th scope="col" class="cart-table-title">
                                <div class="form-check pt-2">
                                  <label class="form-check-label font-body--400" for="existing"> </label>
                                  <input class="form-check-input checkboxes" type="checkbox" id="checkbox_master">
                                </div>
                              </th>
                              <th scope="col" class="cart-table-title">Recipient</th>
                              <th scope="col" class="cart-table-title">Amount</th>
                              <th scope="col" class="cart-table-title">Requested</th>
                              <th scope="col" class="cart-table-title">Status</th>
                              <th scope="col" class="cart-table-title">Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payouts as $payout)
                                <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                    <td class="cart-table-item order-date align-middle">
                                      <div class="form-check pt-2">
                                        <label class="form-check-label font-body--400" for="existing"> </label>
                                        <input class="form-check-input checkboxes" type="checkbox" name="payouts[]" value="{{$payout->id}}" >
                                      </div>
                                    </td>
                                    <td class="cart-table-item order-date align-middle">
                                      <div style="margin-top:10px">
                                        <span class="font-body--lg-500" style="color:#000">
                                            {{$payout->user->name}}
                                        </span>
                                        <br />
                                        <span style="font-size:12px;color:#888">
                                            {{$payout->channel}}:{{$payout->destination}}
                                        </span>
                                      </div>
                                    </td>
                                    <td class="cart-table-item order-date align-middle">
                                      <p class="font-body--md-400" style="color:#00b207">{!!$payout->user->country->currency->symbol!!}{{ number_format($payout->amount, 2)}}</p>
                                    </td>
                                    <td class="cart-table-item order-date align-middle">
                                        <span style="font-size:12px;color:#888">{{ $payout->created_at->format('jS F, Y')}}</span>
                                    </td>
                                    <td class="cart-table-item order-date align-middle">
                                        @switch($payout->status)
                                          @case('pending')
                                                <p style="color:#cc7817;font-size:14px"><span id="status">Pending</span></p>
                                              @break
                                          @case('approved')
                                              <p style="color:#5e2ed9;font-size:14px;font-weight:500">Approved</p>
                                          @break
                                          @case('processing')
                                            <p style="color:#5e2ed9;font-size:14px;font-weight:500">Processing</p>
                                          @break
                                          @case('failed')
                                            <p style="color:#d92e2e;font-size:14px"><span id="status">Failed</span></p>
                                          @break
                                          @case('paid')
                                            <p style="color:#00b207;font-size:14px;font-weight:500">Paid at {{$payout->paid_at->format('d-m-y h:i')}}</p>
                                          @break

                                          @default
                                            <p style="color:#d92e2e;font-size:14px"><span id="status">{{$payout->status}}</span></p>
                                          @break
                                              
                                        @endswitch
                                    </td>
                                    <td class="cart-table-item order-date align-middle">
                                        <a href="{{route('receipt',$payout)}}" target="_blank">{{$payout->reference}}</a>
                                    </td>
                                    
                                </tr>   
                            @empty
                                <div style="margin:auto;padding:1%;text-align:center">
                                    <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                    <br />No Payout </span>
                                </div>
                            @endforelse
                            
                        </tbody>
                    </table>
                    @include('layouts.pagination',['data'=> $payouts])
                </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="approval" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approvalModalLabel">Comfirm Payout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="approveform" action="{{route('admin.payouts.manage')}}" method="post">@csrf
            <input type="hidden" name="action" value="pay">
            <div class="contact-form__content my-3">
              <div class="contact-form-input">
                  <label for="pin">Enter Your Access Pin</label>
                  <input type="text" name="pin" id="pin" value="" placeholder="Access pin" />
              </div>
              <div class="contact-form-btn">
                  <button class="button button--md" type="submit"> Continue </button>
                  <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer justify-content-start">
          <span class="small text-muted">Set or reset your access pin from your <a href="{{route('profile')}}">profile</a></span>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="disapproval" tabindex="-1" aria-labelledby="disapprovalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="disapprovalModalLabel">Comfirm Rejected</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="disapproveform" action="{{route('admin.payouts.manage')}}" method="post">@csrf
          <input type="hidden" name="action" value="reject">
          <div class="contact-form__content my-3">
            <div class="contact-form-input">
              <label for="pin">Rejection Reason</label>
              <input type="text" name="reason" placeholder="Type reason for rejection" />
          </div>
            <div class="contact-form-input">
                <label for="pin">Enter Your Access Pin</label>
                <input type="text" name="pin" id="pin" value="" placeholder="Access pin" />
            </div>
            <div class="contact-form-btn">
                <button class="button button--md bg-dark" type="submit"> Reject </button>
                <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-start">
        <span class="small text-muted">Set or reset your access pin from your <a href="{{route('profile')}}">profile</a></span>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')

<script>
  function approve_many(){
    if($('.checkboxes:checked').length){
      $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
          var input = $("<input>").attr("type", "hidden").attr("name", 'payouts[]').val(elem.value);
          $('#approveform').append($(input));
      });
      $('#approval').modal('show');
    }
  }
  function disapprove_many(){
    if($('.checkboxes:checked').length){
      $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
          var input = $("<input>").attr("type", "hidden").attr("name", 'payouts[]').val(elem.value);
          $('#disapproveform').append($(input));
      });
      $('#disapproval').modal('show');
    }
  }

</script>
@endpush