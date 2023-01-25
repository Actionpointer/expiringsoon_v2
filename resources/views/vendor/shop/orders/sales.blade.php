@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/asset/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title')Sales History | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="index.php">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="{{route('vendor.shop.order.list',$shop)}}">Sales History</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  

  <!-- dashboard Secton Start  -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
          <div class="container">
            <!-- Order History  -->
            <div class="dashboard__order-history" style="padding:10px;font-size:13px">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Sales History</h2>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                            <th scope="col" class="dashboard__order-history-table-title"> Product</th>
                            <th scope="col" class="dashboard__order-history-table-title"> Date</th>
                            <th scope="col" class="dashboard__order-history-table-title"> Vendor %</th>
                            <th scope="col" class="dashboard__order-history-table-title"> Comm %</th>
                            <th scope="col" class="dashboard__order-history-table-title"> QTY</th>
                            <th scope="col" class="dashboard__order-history-table-title"></th>
                          </tr>
                    </thead>
                    <tbody>                     
                        @forelse($shop->carts->where('status','Delivered')->sortByDesc('date')->take(10) as $cart)
                                @php
                                    $deliveryfee = '500';
                                    $vat = (5 / 100) * $cart->total;
                                    $finalttl = $vat + $cart->total + $deliveryfee;
                                @endphp
                                <tr>
                                    <!-- Order Id  -->
                                    <td class="dashboard__order-history-table-item order-id"> 
                                        <span style="font-weight:500">{{$cart->product->name}}</span><br/>
                                    </td>
                                    <!-- Date  -->
                                    <td class="dashboard__order-history-table-item order-date "> {{$cart->created_at->format('Y-m-d')}}
                                    </td>
                                    <!-- Vendor Split  -->
                                    <td class="dashboard__order-history-table-item order-total "> 
                                        <p class="order-total-price">   {!!session('locale')['currency_symbol']!!}{{number_format($shop->commission / 100 * $cart->total, 0)}} </p>
                                    </td>
                                    <!-- Site Split  -->
                                    <td class="dashboard__order-history-table-item order-total"> 
                                        <p class="order-total-price">   {!!session('locale')['currency_symbol']!!}{{number_format($cart->total - ($shop->commission / 100 * $cart->total), 0)}} </p>
                                    </td>
                                    <!-- Status -->
                                    <td class="   dashboard__order-history-table-item   order-status "> {{$cart->qty}}</td>
                                    <!-- Details page  -->
                                    <td class="dashboard__order-history-table-item   order-details "> 
                                        <a href="invoice.php?ref={{$cart->orderid}}">
                                            <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%"><img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}"><br />You have no orders at this time.</div>
                        @endforelse
                    </tbody>
                  </table>
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

    <script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/jszip.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/pdfmake.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/vfs_fonts.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatable/assets/buttons/buttons.print.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "pagingType": "full_numbers",
                dom: 'lBfrtip',
                buttons: [
                    { extend: 'print', className: 'btn btn-danger' }, { extend: 'pdf', className: 'btn btn-primary' }, { extend: 'csv', className: 'btn btn-warning' }, { extend: 'excel', className: 'btn btn-success' }, { extend: 'copy', className: 'btn btn-info' }
                ],
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Orders",
                }
            });
        });
    </script>
@endpush
