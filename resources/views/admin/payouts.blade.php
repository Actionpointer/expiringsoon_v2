@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>

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

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
              <p class="font-body--xl-500">Payout Requests</p>
              <a href="#" class="font-body--lg-500">{!!cache('settings')['currency_symbol']!!}{{ number_format($payouts->count(), 2)}} Total</a>
            </div>
            <div class="container">
                <div style="margin-bottom:10px;border-bottom:1px solid #ddd;padding-bottom:10px">
                  <a href="{{route('admin.payouts')}}" style="font-size:13px;color:#00b207;font-weight:500">Payout Requests</a> | 
                  <a href="{{route('admin.shipping')}}" style="font-size:13px;color:#00b207;font-weight:500">Shipping Settlements</a>
                </div>
                <form id="approveform" action="{{route('admin.payouts.manage')}}" method="POST">@csrf
                  <input type="hidden" name="action" value="pay" >
                </form>
                <form id="disapproveform" action="{{route('admin.payouts.manage')}}" method="POST">@csrf
                  <input type="hidden" name="action" value="reject" >
                </form>
                <div class="table-responsive">
                <!-- Products -->
                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                        <th scope="col" class="cart-table-title"></th>
                        <th scope="col" class="cart-table-title">User</th>
                        <th scope="col" class="cart-table-title">Amount</th>
                        <th scope="col" class="cart-table-title">Status</th>
                        <th></th>
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
                                            {{$payout->account->bank->name}}<br />{{$payout->account->acctname}} > 
                                            <span style="color:#000">{{$payout->account->acctno}}</span>
                                        </span>
                                    </div>
                                  </td>
                                  <!-- Price  -->
                                  <td class="cart-table-item order-date align-middle">
                                      <p class="font-body--lg-500" style="color:#00b207">{!!cache('settings')['currency_symbol']!!}{{ number_format($payout->amount, 2)}}</p>
                                  </td>
                                  <!-- Stock Status  -->
                                  <td class="cart-table-item order-date align-middle">
                                      <span style="font-size:12px;color:#888">{{ $payout->created_at->format('l, F d, Y')}}</span>
                                      @if($payout->status == 'pending')
                                          <p style="color:#b6800c;font-size:14px"><span id="status">Pending</span></p>
                                      @elseif($payout->status == 'rejected')
                                          <p style="color:#d92e2e;font-size:14px;font-weight:500">Rejected</p>
                                      @elseif($payout->status == 'processing')
                                          <p style="color:#d92e2e;font-size:14px;font-weight:500">Processing</p>
                                      @else
                                          <p style="color:#00b207;font-size:14px;font-weight:500">Paid</p>
                                      @endif
                                  </td>
                                 
                                  <td class="cart-table-item add-cart align-middle">
                                    @if($payout->status == 'paid')
                                      <a href="">View Receipt</a>
                                    @else
                                    <div class="dropdown">
                                      <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Action
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form class="d-inline" action="{{route('admin.payouts.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                                          <input type="hidden" name="payouts[]" value="{{$payout->id}}">
                                          @if($payout->status =='pending' || $payout->status == 'rejected')
                                          <button type="submit" name="action" value="pay" class="dropdown-item">Pay</button>
                                          @endif
                                          @if($payout->status == 'pending')
                                          <button type="submit" name="action" value="reject" class="dropdown-item">Reject</button>
                                          @endif
                                        </form>                                      
                                      </div>
                                    </div>
                                    @endif
                                  </td>
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
    </div>
  </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/demo.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/jszip.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/pdfmake.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/vfs_fonts.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/buttons.print.min.js')}}"></script>
<script>
  $(document).ready(function() {
      $('#datatable').DataTable({
          "pagingType": "full_numbers",
          dom: 'lBfrtip',
          buttons: [
              { extend: 'print', className: 'btn btn-danger' }, { extend: 'pdf', className: 'btn btn-primary' }, { extend: 'csv', className: 'btn btn-warning' }, { extend: 'excel', className: 'btn btn-success' }, { extend: 'copy', className: 'btn btn-info' },
              {text: 'Pay',className: 'btn btn-dark mx-2',action: approve_many},{text: 'Reject',className: 'btn btn-dark mx-2',action: disapprove_many}
          ],
          "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
          ],
          responsive: true,
          language: {
          search: "_INPUT_",
          searchPlaceholder: "Search Users",
          }
      });
  });
</script>
<script>
  function approve_many(){
    if($('.checkboxes:checked').length){
      $('.checkboxes:checked').each(function(key,elem){
          var input = $("<input>").attr("type", "hidden").attr("name", 'payouts[]').val(elem.value);
          $('#approveform').append($(input));
      });
      $('#approveform').submit();
    }
  }
  function disapprove_many(){
    if($('.checkboxes:checked').length){
      $('.checkboxes:checked').each(function(key,elem){
          var input = $("<input>").attr("type", "hidden").attr("name", 'payouts[]').val(elem.value);
          $('#disapproveform').append($(input));
      });
      $('#disapproveform').submit();
    }
  }

</script>
@endpush