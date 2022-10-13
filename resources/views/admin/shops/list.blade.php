@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>

@endpush
@section('title') Manage Shops | Expiring Soon @endsection
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
            <a href="#">
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="{{route('admin.products')}}">Products</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
              <p class="font-body--xl-500">Manage Shops</p>
              <a href="#" class="font-body--lg-500">{{number_format($shops->count(), 0)}} Shops</a>
            </div>
            <div class="container">
              <!-- Products -->
              <div class="table-responsive">
                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                        <th scope="col" class="cart-table-title">Shop</th>
                        <th scope="col" class="cart-table-title">Owner</th>
                        <th scope="col" class="cart-table-title">Revenue</th>
                        <th scope="col" class="cart-table-title">Status</th>
                        <th scope="col" class="cart-table-title">Action</th>
                        </tr>
                    </thead>
                    <tbody style="width:100%;font-size:13px">
                        @forelse ($shops as $shop)
                            <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                <!-- Product item  -->
                                <td class="px-4 order-date align-middle">
                                    <a href="#" class="cart-table__product-item text-dark" >
                                         <h5>{{ $shop->name}}</h4>
                                    </a>
                                    <small>{{$shop->city->name.' '.$shop->state->name}}</small>
                                </td>
                                <!-- Price  -->
                                <td class="cart-table-item order-date align-middle">
                                    {{$shop->owner()->name}}
                                </td>
                                <td class="cart-table-item order-date align-middle">
                                  <p class="">{!!cache('settings')['currency_symbol']!!}{{ number_format($shop->orders->sum('subtotal'), 2)}}</p>
                                </td>
                                <!-- Stock Status  -->
                                <td class="cart-table-item stock-status order-date align-middle">
                                  
                                  <span class="font-body--md-400  @if($shop->approved) in @else out @endif"> {{ $shop->approved ? 'Approved':'Pending Approval'}}</span>        
                                </td>
                                <td class="cart-table-item add-cart align-middle">
                                  <a href="{{route('admin.shop.show',$shop)}}"  class="cart-table__product-item"  >  
                                    <span class="iconify" style="color:#00b207" data-icon="eva:edit-2-outline" data-width="20" data-height="20"> Manage
                                  </a>
                                 
                                </td>
                            </tr>
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                                <br />There are no shops at this time.</span>
                            </div>
                        @endforelse
                        
                    </tbody>
                </table>
              </div>
            </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script src="{{asset('src/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/demo.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/jszip.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/pdfmake.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/vfs_fonts.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('src/datatable/assets/buttons/buttons.print.min.js')}}"></script>
<script>
  $(document).ready(function() {
      let url = window.location.href;
      let query = url.split('?')[1] ? url.split('?')[1].split('=')[1] :'';
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
          searchPlaceholder: "Search",
          },
          search: {
              "search": query
            }
      });
  });
</script>
@endpush