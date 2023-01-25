@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

@endpush
@section('title')Featured Products | Expiring Soon @endsection
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
              <a href="{{route('home')}}">
                Account
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="{{route('vendor.shop.product.list',$shop)}}">My Products</a></li>
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
              <div class="dashboard__order-history-title d-flex justify-content-between">
                <h2 class="font-body--xl-500 ">My Products</h2>
                <a href="{{route('vendor.shop.product.create',$shop)}}" class="button button--md" style="margin: unset;color:white">Add Products</a>
              </div>
              <div class="dashboard__order-history-table">
                <div class="table-responsive">
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                      <tr>
                        <th scope="col" class="cart-table-title">Product</th>
                          <th scope="col" class="cart-table-title">Price</th>
                          <th scope="col" class="cart-table-title">Stock</th>
                          <th scope="col" class="cart-table-title"></th>
                          <th scope="col" class="cart-table-title"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($shop->products as $product)
                          <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                            <!-- Product item  -->
                            <td class="cart-table-item align-middle">
                              <a href="{{route('product.show',$product)}}" class="cart-table__product-item">
                                <div class="cart-table__product-item-img">
                                  <img src="{{Storage::url($product->photo)}}" alt="{{$product->name}}" />
                                </div>
                                <h5 class="font-body--lg-400" style="font-size:14px">{{$product->name}}</h5>
                              </a>
                              @if($product->expire_at <= now())
                                <ul class="d-flex" style="margin-top:10px;color:#888;font-size:12px">
                                  <li>Expires <span style="font-weight:550;color:#00b207">
                                    {{$product->expire_at->format('l, M jS Y')}} | {{$product->expire_at->diffInDays(now())}} days</span>
                                  <li>
                                </ul>
                              @endif
                              @if($product->expire_at <= now())
                                <ul class="d-flex" style="margin-top:10px;color:#888;font-size:12px">
                                  <li><span style="font-weight:550;color:#ff0000">Product expired and is no longer listed</span><li>
                                </ul>
                              @endif
                            </td>
                            <!-- Price  -->
                            <td class="cart-table-item order-date align-middle">
                              <p class="font-body--lg-500">
                                {!!session('locale')['currency_symbol']!!}{{number_format($product->price , 2)}}
                              </p>
                            </td>
                            <!-- Stock Status  -->
                            <td class="cart-table-item stock-status order-date align-middle">
                              @if($product->stock  > 0)
                                <span class="font-body--md-400 in">{{$product->stock}}</span>
                              @else
                              <span class="font-body--md-400 out">{{$product->stock}}</span>
                              @endif
                            </td>
                            <td class="cart-table-item add-cart align-middle">
                              @if($product->featured)
                                <span class="iconify" style="color:#00b207" data-icon="clarity:star-solid" data-width="20" data-height="20">
                              @endif
                            </td>
                            <td class="cart-table-item add-cart align-middle">
                              <div class="add-cart__wrapper">
                                <a href="{{route('vendor.shop.product.edit',[$shop,$product])}}" class="cart-table__product-item">
                                  <span class="iconify" style="color:#00b207" data-icon="eva:edit-2-outline" data-width="20" data-height="20">
                                </a>
                              </div>
                            </td>
                          </tr>   
                        @empty
                          <div style="margin:auto;padding:1%;text-align:center">
                              <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                              <br/><span>There are no products at this time.</span></a>
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
                searchPlaceholder: "Search Products",
                }
            });
        });
    </script>
@endpush
