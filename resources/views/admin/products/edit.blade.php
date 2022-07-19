@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/> --}}

@endpush
@section('title'){{$product->name}} | Expiring Soon @endsection
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
          <li class="active"><a href="{{route('admin.dashboard')}}">Users</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->

  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
              <!-- Edit Product  -->
              <div class="dashboard__content-card">
                <div class="dashboard__order-history-title" style="border-bottom:1px solid #ddd">
                    <h2 class="font-body--xl-500">Edit Product</h2>
                    <a href="admin-products.php" class="font-body--lg-500"> Back to List</a>
                </div>
                <div class="dashboard__content-card-body">
                  <div class="row">
                    <div class="col-lg-7 order-lg-0 order-2">
                      <form method="post" id="editproductinfo">
                        <input type="hidden" name="prod_id" value="{{$product->id}}">
                        <div class="contact-form__content">
                          <div class="contact-form-input">
                            <label for="fname">Product </label>
                            <input type="text" name="product" value="{{$product->name}}" placeholder="Product"/>
                          </div>
                          <div class="contact-form-input">
                            <label for="lname2">Price </label>
                            <input type="text" name="price" value="{{$product->price}}" placeholder="Price (Numbers Only)" onkeypress="validate(event)"/>
                          </div>
                          <div class="contact-form-input">
                            <label for="number1">Stock</label>
                            <input type="number" name="stock" value="<?php echo $prqr['stock']; ?>" placeholder"Stock (Numbers Only)" onkeypress="validate(event)"/>
                          </div>
                        </div>
                      </form>
                      <div id="process" style="font-size:13px"></div>
                    </div>
                    <div class="col-lg-5 order-lg-0 order-1">
                      <div class="dashboard__content-card-img">
                        <form method="post" enctype="multipart/form-data" style="text-align: center" id="editPhoto">
                          <input type="hidden" name="prod_id3" value="{{$product->id}}">
                          <div class="dashboard__content-img-wrapper" id="avatar">
                            <img src="{{$product->photo}}" alt="{{$product->name}}"  onclick="performClick('theFile');"  id="imgPreview"/>
                          </div>
                            <input type="file" name="theFile" id="theFile" onchange="loadFile(event)" accept=".png, .jpg, .jpeg" />
                          <button type="button" class="button button--outline" id="btn-avatar" onclick="performClick('theFile');">Upload Photo</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Billing Address  -->
              <div class="dashboard__content-card">
                <div class="dashboard__content-card-header">
                  <h5 class="font-body--xl-500">Product Category</h5>
                </div>
                <div class="dashboard__content-card-body">
                  <form method="post" id="editcategory">
                    <input type="hidden" name="prod_id2" value="{{$product->id}}">
                    <div class="contact-form__content">
                      <div class="contact-form--input contact-form--input-area">
                        <label for="address">Description</label>
                        <textarea id="comments" cols="auto" rows="auto" name="info" placeholder="Type product description" >
                            {{$product->info}}
                        </textarea>
                      </div>
                      <div class="contact-form__content-group">
                        <!-- states -->
                        <div class="contact-form-input">
                          <label for="states">Category</label>
                          <select id="states" name="cat_id" class="contact-form-input__dropdown" onChange="getSubs()">
                                @foreach ($categories as $category)
                                    <option value="{{$product->category_id}}" @if($product->category_id == $category->id) selected @endif>{{$category->name}} </option>
                                @endforeach
                          </select>
                        </div>
                        <div class="contact-form-input">
                          <label for="country">Sub Category</label>
                          <select id="loadsubs" name="subcat_id" class="contact-form-input__dropdown droplist" >
                            <option value="" selected>Subcategory</option>
                          </select>
                        </div>
                      </div>
                      <div class="contact-form-btn">
                        <button class="button button--md" type="submit">
                          Save Changes
                        </button>
                      </div>
                      <div id="process2" style="font-size:13px;margin-top:10px"></div>
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

@endpush