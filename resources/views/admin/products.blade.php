@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>

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
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
              <p class="font-body--xl-500">Manage Products</p>
              <a href="#" class="font-body--lg-500">{{number_format($products->count(), 0)}} Items</a>
            </div>
            <div class="container">
              <!-- Products -->
              <form id="approveform" action="{{route('admin.products.manage')}}" method="POST">@csrf
                  <input type="hidden" name="action" value="approve" >
              </form>
              <form id="disapproveform" action="{{route('admin.products.manage')}}" method="POST">@csrf
                <input type="hidden" name="action" value="reject" >
              </form>
              <div class="table-responsive">
                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                        <th scope="col" class="cart-table-title"> </th>
                        <th scope="col" class="cart-table-title">Product</th>
                        <th scope="col" class="cart-table-title">Vendor</th>
                        <th scope="col" class="cart-table-title">Orders</th>
                        <th scope="col" class="cart-table-title">Status</th>
                        <th scope="col" class="cart-table-title">Manage</th>
                        </tr>
                    </thead>
                    <tbody style="width:100%;font-size:13px">
                        @forelse ($products as $product)
                            <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                <!-- Product item  -->
                                <td>
                                  <div class="form-check pt-2">
                                    <label class="form-check-label font-body--400" for="existing"> </label>
                                    <input class="form-check-input checkboxes" type="checkbox" name="products[]" value="{{$product->id}}" >
                                  </div>
                                </td>
                                <td class="cart-table-item align-middle pt-3">
                                    <a href="{{route('product.show',$product)}}" class="cart-table__product-item pt-2" >
                                        {{ $product->name}}
                                    </a>
                                </td>
                                <td class="cart-table-item stock-status order-date align-middle">
                                    {{$product->shop->name}}
                                </td>
                                <td class="cart-table-item order-date align-middle">
                                  <p class="font-body--lg-500">
                                    {{$product->carts->unique('order_id')->count()}}
                                  </p>
                                </td>
                                <td class="cart-table-item stock-status align-middle">
                                  <div class="d-flex">
                                    @if(!$product->approved)
                                      <span class="font-body--md-400 in bg-warning text-white"> Pending Approval</span>
                                    @else 
                                        <span class="font-body--md-400 in"> Approved</span>
                                    @endif

                                    @if(!$product->status)
                                        <span class="font-body--md-400 out"> Inactive</span>
                                    @else
                                        <span class="font-body--md-400 out"> Active</span>
                                    @endif

                                    @if($product->isEdible())
                                      <span class="font-body--md-400 in"> Edible</span>
                                    @else 
                                        <span class="font-body--md-400 out"> Expired</span>
                                    @endif
                                  </div>
                                  
                              </td>
                              <td class="cart-table-item add-cart align-middle">
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Manage
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <form class="d-inline" action="{{route('admin.products.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                                      <input type="hidden" name="products[]" value="{{$product->id}}">
                                      @if(!$product->approved)
                                      <button type="submit" name="approved" value="1" class="dropdown-item">Approve</button>
                                      @else
                                      <button type="submit" name="approved" value="0" class="dropdown-item">Disapprove</button>
                                      @endif
                                      <button type="submit" name="delete" value="1" class="dropdown-item">Delete</button>
                                    </form>                                      
                                  </div>
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
        $('#datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
            buttons: [
                { extend: 'print', className: 'btn btn-danger' }, { extend: 'pdf', className: 'btn btn-primary' }, { extend: 'csv', className: 'btn btn-warning' }, { extend: 'excel', className: 'btn btn-success' }, { extend: 'copy', className: 'btn btn-info' },
                {text: 'Approve',className: 'btn btn-dark mx-2',action: approve_many},{text: 'Disapprove',className: 'btn btn-dark mx-2',action: disapprove_many}
            ],
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            }
        });
    });
</script>
<script>
  function approve_many(){
    if($('.checkboxes:checked').length){
      $('.checkboxes:checked').each(function(key,elem){
          var input = $("<input>").attr("type", "hidden").attr("name", 'products[]').val(elem.value);
          $('#approveform').append($(input));
      });
      $('#approveform').submit();
    }
  }
  function disapprove_many(){
    if($('.checkboxes:checked').length){
      $('.checkboxes:checked').each(function(key,elem){
          var input = $("<input>").attr("type", "hidden").attr("name", 'products[]').val(elem.value);
          $('#disapproveform').append($(input));
      });
      $('#disapproveform').submit();
    }
  }

</script>
@endpush