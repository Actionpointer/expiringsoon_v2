@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

@endpush
@section('title')Add Product | Expiring Soon @endsection
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
              <a href="{{route('home')}}">
                Account
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="{{route('shop.product.list',$shop)}}">My Products</a></li>
          </ul>
        </div>
      </div>
  </div>
    <!-- breedcrumb section end   -->

    

    <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('shop.navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Edit Product  -->
              <div class="dashboard__content-card">
                <div class="dashboard__order-history-title" style="border-bottom:1px solid #ddd">
                  <h2 class="font-body--xxl-500">Add New Product</h2>
                  <a href="{{route('shop.product.list',$shop)}}" class="font-body--lg-500">
                    See All</a
                  >
                </div>
                <div class="dashboard__content-card-body">
                  <div class="row">
                    <div class="col-lg-7 order-lg-0 order-2">
                      <form method="post" id="addproduct" enctype="multipart/form-data">
                        <div class="contact-form__content">
                          <div class="contact-form-input">
                            <label for="fname">Product </label>
                            <input
                              type="text"
                              name="product"
                              placeholder"Product"
                              required
                            />
                          </div>
                          <div class="contact-form-input">
                            <label for="lname2">Price </label>
                            <input
                              type="text"
                              name="price"
                              placeholder"Price (Numbers Only)"
                              onkeypress="validate(event)"
                              required
                            />
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Stock</label>
                            <input
                              type="number"
                              name="stock"
                              placeholder"Stock (Numbers Only)"
                              onkeypress="validate(event)"
                              required
                            />
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Expiry Date</label>
                            <input
                              type="text"
                              name="expiry"
                              placeholder"YYYY-MM-DD"
                              onkeypress="validate(event)"
                              id="datepicker"
                            />
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-5 order-lg-0 order-1">
                      <div class="dashboard__content-card-img">
                          <div class="dashboard__content-img-wrapper">
                            <img
                              src="img/no-image.jpg"
                              alt="Product Photo"
                               onclick="performClick('theFile');"
                               id="imgPreview"
                               required
                            />
                          </div>
                            <input type="file" name="theFile" id="theFile" onchange="loadFile(event)" accept=".png, .jpg, .jpeg" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Billing Address  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xxl-500">Product Category</h5>
                </div>
                <div class="dashboard__content-card-body">
                    <div class="contact-form__content">
                      <div class="contact-form--input contact-form--input-area">
                        <textarea
                          name="info"
                          cols="auto"
                          rows="auto"
                          placeholder="Product Description"
                        ></textarea>
                      </div>
                      <div class="contact-form__content-group">
                        <!-- states -->
                        <div class="contact-form-input">
                            <label for="states">Category</label>
                            <select id="states" name="cat_id" class="contact-form-input__dropdown" onChange="getSubs()" required>
                                <option value="" selected>Select</option>
                                @foreach ($categories as $category)
                                    <option value={{$category->id}}>{{$category->name}}</option>
                                @endforeach

                          </select>
                        </div>
                        <div class="contact-form-input">
                          <label for="loadsubs">Sub Category</label>
                          <select id="loadsubs" name="subcat_id" class="contact-form-input__dropdown droplist" required >
                            <option value="" selected>Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="contact-form-btn">
                        <button class="button button--md" type="submit" id="submit">
                          + Add Product
                        </button>
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
    <!-- dashboard Secton  End  -->
    
@endsection
@push('scripts')

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
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
