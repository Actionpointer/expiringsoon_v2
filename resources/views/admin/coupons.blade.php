@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> 
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title') Manage Coupons | Expiring Soon @endsection
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
            <a href="{{route('home')}}">
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Coupons</a></li>
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
                <div class="container">
                    <div class="dashboard__content-card">
                        <div class="dashboard__content-card-header">
                            <h5 class="font-body--xl-500">Manage Coupons</h5>
                        </div>
                        <form id="deleteform" action="{{route('admin.coupon.manage')}}" method="POST" onsubmit="return confirm('Are you sure you want to delete coupons?');">@csrf
                            
                            <input type="hidden" name="delete" value="1" >
                          </form>
                        <div class="dashboard__content-card-body">
                            <div class="table-responsive">
                                
                                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                                    <thead>
                                        <tr>
                                            
                                            <th scope="col" class="cart-table-title align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check d-inline">
                                                        <label class="form-check-label font-body--400" for="existing"> </label>
                                                        <input class="form-check-input checkboxes" type="checkbox" id="checkbox_master">
                                                    </div>
                                                    <span class="align-bottom">Title</span> 
                                                </div>
                                            </th>
                                            <th scope="col" class="cart-table-title align-middle">Code</th>
                                            <th scope="col" class="cart-table-title align-middle">Discount</th>
                                            <th scope="col" class="cart-table-title align-middle">Period</th>
                                            <th scope="col" class="cart-table-title align-middle">Status</th>
                                            <th scope="col" class="cart-table-title align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($coupons as $coupon)
                                            <tr>
                                                
                                                
                                                <td class="cart-table-item stock-status order-date align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check">
                                                            <label class="form-check-label font-body--400" for="existing"> </label>
                                                            <input class="form-check-input checkboxes" type="checkbox" name="coupons[]" value="{{$coupon->id}}" >
                                                        </div>
                                                        <span>{{$coupon->name}}</span>
                                                    </div>
                                                </td>
                                                <td class="cart-table-item stock-status order-date align-middle"> {{$coupon->code}}</td>
                                                <td class="cart-table-item stock-status order-date align-middle"> 
                                                    @if($coupon->is_percentage) 
                                                        {{$coupon->value}}%  off 
                                                    @else 
                                                        -{{$coupon->value}} Off 
                                                    @endif
                                                </td>
                                                
                                                <td class="cart-table-item stock-status order-date align-middle"> 
                                                    @if($coupon->start_at && $coupon->end_at)
                                                        {{ $coupon->start_at->format('M-d')}} to {{$coupon->end_at->format('M-d')}} 
                                                    @else 
                                                        - 
                                                    @endif
                                                </td>
                                                <td class="cart-table-item stock-status order-date align-middle">
                                                    @if($coupon->status) 
                                                        <i class="fa fa-circle text-success"></i> Active
                                                    @else <i class="fa fa-circle text-danger"></i> Inactive
                                                    @endif 
                                                </td>
                                                <td class="cart-table-item stock-status order-date align-middle">
                                                    <button class="btn btn-xs btn-info text-white" data-bs-toggle="modal" data-bs-target="#editcoupon{{$coupon->id}}"><i class="fa fa-pencil"></i></button> 

                                                    <form action="{{route('admin.coupon.manage')}}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete coupon?');">@csrf
                                                        <input type="hidden" name="delete" value="1">
                                                        <input type="hidden" name="coupons[]" value="{{$coupon->id}}">
                                                        <button type="submit" class="btn btn-xs btn-danger" title="delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    
                                                </td>
                                                
                                            </tr>
                                            <div class="modal fade" id="editcoupon{{$coupon->id}}" aria-labelledby="editcoupon{{$coupon->id}}Label" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="editcoupon{{$coupon->id}}Label">Edit Coupon</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('admin.coupon.manage')}}" method="POST">@csrf
                                                            
                                                            <input type="hidden" name="edit" value="1">
                                                            <input type="hidden" name="coupon_id" value="{{$coupon->id}}">
                                                            <div class="contact-form__content">
                                                                <div class="contact-form__content-group">
                                                                    <div class="contact-form-input">
                                                                        <label for="title" class=""><span>*</span> Coupan Title</label>
                                                                        <input class="form-control " id="title" name="title" value="{{$coupon->name}}" type="text" required="">
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="code" class=""><span>*</span>Coupan Code</label>
                                                                        <input class="form-control " id="code" name="code" value="{{$coupon->code}}" type="text" required="" >
                                                                        <div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="contact-form__content-group">
                                                                    <div class="contact-form-input">
                                                                        <label class="">Start Date</label>
                                                                        <input class=" form-control digits" value="{{$coupon->start_at ? $coupon->start_at->format('Y-m-d') : '' }}" name="start_date" type="date">
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label class="">End Date</label>
                                                                        <input class="form-control digits " value="{{$coupon->end_at ? $coupon->end_at->format('Y-m-d') : '' }}" name="end_date" type="date">
                                                                    </div>
                                                                </div>
                                                                <div class="contact-form__content-group">        
                                                                    <div class="contact-form-input">
                                                                        <label class="">Quantity</label>
                                                                        <input class="form-control " type="number" name="quantity" value="{{$coupon->quantity}}" required="">
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label class="">Discount Type</label>
                                                                        <select class="form-control-lg text-muted border w-100 " required="" name="type">
                                                                            <option value="percent" @if($coupon->is_percentage) selected @endif>Percent</option>
                                                                            <option value="fixed" @if(!$coupon->is_percentage) selected @endif>Fixed</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="discountvalue" class=""><span>*</span>Discount Value</label>
                                                                        <input class="form-control " id="discountvalue" name="value" value="{{$coupon->value}}" type="number" required="" >
                                                                        <div class="valid-feedback">Enter correct values.</div>
                                                                    </div>
                                                                </div>
                                                                <h5 class="my-4">Usage Limits</h4>
                                                                <div class="contact-form__content-group">
                                                                    
                                                                    <div class="contact-form-input">
                                                                        <label for="minimum_spend" class="">Minimum Spend</label>
                                                                        <input class="form-control " id="minimum_spend" value="{{$coupon->minimum_spend}}" type="number" name="minimum_spend">
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="maximum_spend" class="">Maximum Spend</label>
                                                                        <input class="form-control " id="maximum_spend" value="{{$coupon->maximum_spend}}" type="number" name="maximum_spend">
                                                                    </div>
                                                                    <div class="contact-form-input">
                                                                        <label for="per_customer" class="">Limit Per User</label>
                                                                        <input class="form-control " id="per_customer" value="{{$coupon->limit_per_user}}" type="number" name="per_customer" placeholder="no of times a user can use it">
                                                                    </div>
                                                                </div>    
                                                                <div class="row">
                                                                    <div class="contact-form-input col-md-4">
                                                                        <label class="">Status</label>
                                                                        <select class="form-control-lg text-muted border w-100 " required="" name="status">
                                                                            <option value="1" @if($coupon->status) selected @endif>Active</option>
                                                                            <option value="0" @if(!$coupon->status) selected @endif>Inactive</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="contact-form-input d-block">
                                                                        <button class="button button--md" type="submit">
                                                                        Update Coupon
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            
                                                        </form>
                                                    </div>
                                                    
                                                  </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-md-center">
                                                    <div style="margin:auto;padding:1%;">
                                                        <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                                        <br />There are no coupons at this time.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard__content-card">
                        <div class="dashboard__content-card-header">
                            <h5 class="font-body--xl-500">Add Coupon</h5>
                        </div>
                        <div class="dashboard__content-card-body">
                            <form action="{{route('admin.coupon.manage')}}" method="POST">@csrf
                                <input type="hidden" name="create" value="1">
                                <div class="contact-form__content">
                                    <div class="contact-form__content-group">
                                        <div class="contact-form-input">
                                            <label for="title" class=""><span>*</span> Coupan Title</label>
                                            <input class="form-control " id="title" name="title" type="text" required="">
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="code" class=""><span>*</span>Coupan Code</label>
                                            <input class="form-control " id="code" name="code" type="text" required="" >
                                            <div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
                                        </div>
                                    </div>
                                    <div class="contact-form__content-group">
                                        <div class="contact-form-input">
                                            <label class="">Start Date</label>
                                            <input class=" form-control digits " name="start_date" type="date">
                                        </div>
                                        <div class="contact-form-input">
                                            <label class="">End Date</label>
                                            <input class="form-control digits " name="end_date" type="date">
                                        </div>
                                    </div>
                                    <div class="contact-form__content-group">        
                                        <div class="contact-form-input">
                                            <label class="">Quantity</label>
                                            <input class="form-control " type="number" name="quantity" required="">
                                        </div>
                                        <div class="contact-form-input">
                                            <label class="">Discount Type</label>
                                            <select class="form-control-lg text-muted border w-100 " required="" name="status">
                                                <option value="percent">Percent</option>
                                                <option value="fixed">Fixed</option>
                                            </select>
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="discountvalue" class=""><span>*</span>Discount Value</label>
                                            <input class="form-control " id="discountvalue" name="value" type="number" required="" >
                                            <div class="valid-feedback">Enter correct values.</div>
                                        </div>
                                    </div>
                                    <h5 class="my-4">Usage Limits</h4>
                                    <div class="contact-form__content-group">
                                        
                                        <div class="contact-form-input">
                                            <label for="minimum_spend" class="">Minimum Spend</label>
                                            <input class="form-control " id="minimum_spend" type="number" name="minimum_spend">
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="maximum_spend" class="">Maximum Spend</label>
                                            <input class="form-control " id="maximum_spend" type="number" name="maximum_spend">
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="per_customer" class="">Limit Per User</label>
                                            <input class="form-control " id="per_customer" type="number" name="per_customer" placeholder="no of times a user can use it">
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="contact-form-input col-md-4">
                                            <label class="">Status</label>
                                            <select class="form-control-lg text-muted border w-100 " required="" name="type">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="contact-form-input d-block">
                                            <button class="button button--md" type="submit">
                                            + Add Coupon
                                            </button>
                                        </div>
                                    </div>
                                        
                                    
                                </div>
                                
                            </form>
                        </div>
                    </div>  
                    
                </div>  
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/jszip.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/pdfmake.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/vfs_fonts.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/buttons.print.min.js')}}"></script>
<script>
  $(document).ready(function() {
      let url = window.location.href;
      let query = url.split('?')[1] ? url.split('?')[1].split('=')[1] :'';
      $('#datatable').DataTable({
          "pagingType": "full_numbers",
          dom: 'lBfrtip',
          buttons: [
              { extend: 'print', className: 'btn btn-danger' }, { extend: 'pdf', className: 'btn btn-primary' }, { extend: 'csv', className: 'btn btn-warning' }, { extend: 'excel', className: 'btn btn-success' }, { extend: 'copy', className: 'btn btn-info' },
              {text: 'Delete',className: 'btn btn-danger mx-2',action: deleteform}
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
<script>
    function deleteform(){
        if($('.checkboxes:checked').length){
          $('.checkboxes:checked').not('#checkbox_master').each(function(key,elem){
              var input = $("<input>").attr("type", "hidden").attr("name", 'coupons[]').val(elem.value);
              $('#deleteform').append($(input));
          });
          $('#deleteform').submit();
        }
      }
</script>
@endpush

