@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title')Order History | Expiring Soon @endsection
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
          <li class="active"><a href="{{route('vendor.shop.order.list',$shop)}}">Order History</a></li>
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
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Order History  -->
            <div class="dashboard__order-history">
              <div class="dashboard__order-history-title">
                <h2 class="font-body--xl-500">Order History</h2>
              </div>
              <div class="dashboard__order-history-table" style="padding:10px;font-size:13px">
                <div class="table-responsive">
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                      <tr>
                        <th scope="col" class="cart-table-title"> Order No</th>
                        <th scope="col" class="cart-table-title"> Date</th>
                        <th scope="col" class="cart-table-title"> Total</th>
                        <th scope="col" class="cart-table-title"> Status</th>
                        <th scope="col" class="cart-table-title"> Shipment By</th>
                        <th scope="col" class="cart-table-title"> Manage </th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($orders as $order)
                            <tr>

                                <td> 
                                    <span style="font-weight:500">#{{$order->slug}}</span>
                                </td>
                                <!-- Date  -->
                                <td> 
                                  <span style="font-weight:500">{{$order->created_at->format('Y-m-d')}} </span> </td>
                                <!-- Total  -->
                                <td> 
                                    <p class="order-total-price">   {!!$shop->country->currency->symbol!!}{{number_format($order->total, 0)}} </p>
                                </td>
                                <!-- Status -->
                                <td> {{ucwords($order->status)}}</td>
                                <!-- Details page  -->
                                <td>
                                      {{ucwords($order->deliverer)}}
                                </td>

                                <td>
                                    <a href="{{route('vendor.shop.order.view',[$shop,$order])}}">
                                        <span class="iconify" data-icon="ant-design:info-circle-filled" data-width="24" data-height="24">
                                          View
                                        </span>
                                    </a>
                                </td>
                            </tr>   
                        @empty
                        <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                            <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                            <br />You have no orders at this time.
                        </div>
                      @endforelse
                      
                    </tbody>
                  </table>
                  @include('layouts.pagination',['data'=> $orders])
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
