@extends('layouts.app')
@push('styles')

@endpush
@section('title') Manage Products @endsection
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
      @include('layouts.admin_navigation')
      <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
        <div class="dashboard__content-card">
          <div class="dashboard__content-card-header">
              <h5 class="font-body--xl-500">Manage Products</h5>
          </div>
          
          <div class="dashboard__content-card-body px-0">
            <div class="dropdown p-3">
              <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Manage
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <form class="d-inline" action="{{route('admin.products.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                  <input type="hidden" name="products[]">
                  
                  <button type="button" class="dropdown-item">Select All</button>
                  <button type="submit" name="approved" value="1" class="dropdown-item">Approve</button>
                  
                  <button type="submit" name="approved" value="0" class="dropdown-item">Disapprove</button>
                 
                  <button type="submit" name="delete" value="1" class="dropdown-item">Delete</button>
                </form>                                      
              </div>
            </div>
            <form id="approveform" action="{{route('admin.products.manage')}}" method="POST">@csrf
              <input type="hidden" name="action" value="approve" >
            </form>
            <form id="disapproveform" action="{{route('admin.products.manage')}}" method="POST">@csrf
              <input type="hidden" name="action" value="reject" >
            </form>
            <div class="table-responsive">
              <table class="table display" style="width:100%;font-size:13px">
                  <thead class="thead-light">
                      <tr>
                        <th scope="col" class="cart-table-title">Item</th>
                        <th scope="col" class="cart-table-title align-middle">Orders</th>
                        <th scope="col" class="cart-table-title align-middle">Available</th>
                        <th scope="col" class="cart-table-title align-middle">Approved</th>
                        <th scope="col" class="cart-table-title align-middle">Status</th>
                        <th scope="col" class="cart-table-title align-middle">Expiry</th>
                      </tr>
                  </thead>
                  <tbody style="width:100%;font-size:13px">
                      @forelse ($products as $product)
                          <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                              <!-- Product item  -->
                              <td class="">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check pt-2">
                                      <label class="form-check-label font-body--400" for="existing"> </label>
                                      <input class="form-check-input checkboxes" type="checkbox">
                                    </div>
                                    <a href="{{route('product.show',$product)}}"  class="cart-table__product-item" >
                                        <div class="cart-table__product-item-img">
                                            <img src="{{Storage::url($product->photo)}}" alt="{{$product->name}}" onerror="this.src='{{asset('src/images/site/avatar.png')}}'" />
                                            
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h5 class="font-body--lg-400"> {{ $product->name}}
                                               <small class="text-muted">by {{$product->shop->name}}</small>
                                            </h5>
                                        </div>
                                    </a>
                                  </div>
                                  
                              </td>
                              
                              <td class="cart-table-item stock-status order-date align-middle">
                                  <p class="font-body--lg-500">
                                    {{$product->carts->unique('order_id')->count()}}
                                  </p>
                              </td>
                              <!-- Stock Status  -->
                              <td class="cart-table-item stock-status order-date align-middle">
                                {{$product->stock}}
                              </td>
                              <td class="cart-table-item stock-status order-date align-middle">
                                {{$product->approved}}
                              </td>
                              <td class="cart-table-item stock-status order-date align-middle">
                                {{$product->status}}
                              </td>
                              <td class="cart-table-item stock-status order-date align-middle">
                                {{$product->valid}}
                              </td>
                          </tr>
                      @empty
                          <tr>
                             <td colspan="6">
                                <div style="margin:auto;padding:1%;text-align:center">
                                  <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                  <br />There are no products at this time.</span>
                                </div>
                             </td>
                          </tr>
                          
                      @endforelse
                      
                  </tbody>
              </table>
              @include('layouts.pagination',['data'=> $products])
            </div>
          </div>
        </div>

          
          
    </div>
  </div>
</div>

@endsection
@push('scripts')

@endpush