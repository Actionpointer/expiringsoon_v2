@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

@endpush
@section('title') Manage Products | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg
                width="18"
                height="19"
                viewBox="0 0 18 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
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

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
              <p class="font-body--xl-500">Manage Products</p>
              <a href="#" class="font-body--lg-500">{{number_format($products->count(), 0)}} Items</a>
            </div>
            <div class="container">
              <!-- Products -->
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
                    <tbody style="width:100%;font-size:13px">
                        @forelse ($products as $product)
                            <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                <!-- Product item  -->
                                <td class="cart-table-item align-middle">
                                    <a href="{{route('admin.product.edit',$product)}}" class="cart-table__product-item" >
                                        <div class="cart-table__product-item-img">
                                            <img  src=" {{ $product->photo}}"  alt=" {{ $product->name}}"/>
                                        </div>
                                        <h5 class="font-body--lg-400"> {{ $product->name}}</h5>
                                        <div style="margin-top:-10px">
                                            <a href="vendor.php?ref= {{ $product->shop->username}}" target="_blank" style="color:#00b207;font-weight:500">
                                                <div style="font-size:12px">
                                                    <span style="font-weight:400;color:#333">Vendor ID # {{ $product->shop->id}}:</span> 
                                                         {{ $product->shop->fname}}  {{ $product->shop->lname}}
                                            </a>
                                        </div>
                                        @if($product->expiry !=='' && $product->status=='Expired')
                                            <ul class="d-flex" style="margin-top:10px;color:#888;font-size:12px">
                                                <li><span style="font-weight:550;color:#ff0000">Product expired and is no longer listed</span><li>
                                            </ul>
                                        @endif
                                        </div>
                                    </a>
                                </td>
                                <!-- Price  -->
                                <td class="cart-table-item order-date align-middle">
                                    <p class="font-body--lg-500">N {{ number_format($product->price, 2)}}</p>
                                </td>
                                <!-- Stock Status  -->
                                <td class="cart-table-item stock-status order-date align-middle">
                                @if($product->stock > 0)
                                <span class="font-body--md-400 in"> {{ $product->stock}}</span>
                                @else
                                <span class="font-body--md-400 out"> {{ $product->stock}}</span>
                                @endif
        
                                </td>
                                <td class="cart-table-item add-cart align-middle">
                                    @if($product->featured)
                                        <span class="iconify" style="color:#00b207" data-icon="clarity:star-solid" data-width="20" data-height="20">
                                    @endif
                                </td>
                                <td class="cart-table-item add-cart align-middle">
                                    <div class="add-cart__wrapper">  
                                        <a  href="admin-editproduct.php?pid= {{ $product->id}}"  class="cart-table__product-item"  >  
                                            <span class="iconify" style="color:#00b207" data-icon="eva:edit-2-outline" data-width="20" data-height="20">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('img/exclamation.png')}}">
                                <br />There are no products at this time.</span>
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

@endpush