@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> 
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush
@section('title') Categories Settings | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
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
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  
  @include('layouts.session')
<!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Add Category  -->
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Add Category</h5>
              </div>
              <div class="dashboard__content-card-body">
                <form method="post" action="{{route('admin.categories.management')}}" id="addcategory" enctype="multipart/form-data">@csrf
                  <div class="row">  
                    <div class="col-lg-7 order-lg-0 order-2">
                      <div class="contact-form__content">
                        
                        <div class="contact-form-input">
                          <label for="category">Name</label>
                          <input type="text" name="category" placeholder="" />
                        </div>
                        
                        <div class="form-group">
                          <label for="subcat">Subcategories <small class="text-muted">(Hint: You can add new)</small></label>
                            <select id="subcat" name="tags[]" class="select2" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contact-form-btn mt-3">
                          <button class="button button--md" type="submit">
                            + Add Category
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 order-lg-0 order-1">
                      <div class="dashboard__content-card-img flex-column align-items-center"> 
                          <div class="dashboard__content-img-wrapper rounded-0 w-50 h-50" id="avatar">
                            <img src="{{asset('src/images/site/no-image.png')}}" style="width:100%;height:100%;" alt="category"  onclick="performClick('theFile');"  id="imgPreview"   />
                          </div>
                          <div>
                            <input type="file" name="photo" id="theFile" onchange="readURL(this,'imgPreview')" accept=".png, .jpg, .jpeg" />
                            <button type="button" class="button w-100 button--outline" id="btn-avatar" onclick="performClick('theFile');">Upload Category Image</button>
                          </div>
                          @error('photo')
                          <span class="invalid-feedback d-block text-danger mb-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                    </div>
                    
                  </div>
                </form>
                <!-- Button trigger modal -->
              </div>
            </div>   

            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Manage Categories</h5>
              </div>
              <div class="dashboard__content-card-body px-0">
                <div class="">
                  <div class="table-responsive">
                    <table class="table" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col" class="cart-table-title">Category</th>
                          <th scope="col" class="cart-table-title">Subcategories</th>
                          <th scope="col" class="cart-table-title">Items</th>
                          <th scope="col" class="cart-table-title">Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                          <!-- Product item  -->
                          <td class="cart-table-item align-middle">
                            <a href="product-details.html" class="cart-table__product-item">
                              <div class="cart-table__product-item-img">
                                <img src="{{asset('src/images/products/img-01.png')}}" alt="product">
                              </div>
                              <h5 class="font-body--lg-400">{{$category->name}}</h5>
                            </a>
                          </td>
                          <!-- Price  -->
                          <td class="cart-table-item order-date align-middle">
                                @foreach ($category->subcategories as $subcategory)
                                    {{$subcategory->name}},
                                @endforeach
                          </td>
                          <!-- quantity -->
                          <td class="cart-table-item order-total align-middle">
                            {{$category->products->count()}}
                          </td>
                          <!-- Subtotal  -->
                          <td class="cart-table-item order-subtotal align-middle">
                            <div class="d-flex justify-content-between align-items-center ">
                                <button class="edit_button" data-bs-toggle="modal" data-bs-target="#editcategory{{$category->id}}">Edit</button> | 
                                <form action="{{route('admin.categories.management')}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">@csrf
                                    <input type="hidden" name="category_id" value="{{$category->id}}">
                                    <button type="submit" name="action" value="delete">Delete</button>
                                </form>
                            </div>
                          </td>
                          <div class="modal fade" id="editcategory{{$category->id}}" aria-labelledby="editcategory{{$category->id}}Label" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="editcategory{{$category->id}}Label">Modal title</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form method="post" action="{{route('admin.categories.management')}}">@csrf
                                    <div class="contact-form__content">
                                      <div class="contact-form-input">
                                        <label for="address">Category Name</label>
                                        <input type="text" name="category" value="{{$category->name}}" placeholder="" />
                                      </div>
                                      <div class="contact-form-input">
                                        <label for="states">Subcategories</label>
                                          <select id="subcategories" name="subcategories[]" class="form-control select2" multiple>
                                            @foreach ($tags as $tag)
                                              <option value="{{$tag->id}}" @if(in_array($tag->id,$category->subcategories->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                            @endforeach 
                                            
                                          </select>
                                      </div>
                                      
                                      <div class="contact-form-btn">
                                        <button class="button button--md" type="submit"> Update Category </button>
                                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                      </div>
                                      
                                    </div>
                                  </form>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- Action Buttons  -->
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  

<!-- Modal -->

  
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
            }
        });
    });

    

    function performClick(elemId) {
      var elem = document.getElementById(elemId);
      if(elem && document.createEvent) {
          var evt = document.createEvent("MouseEvents");
          evt.initEvent("click", true, false);
          elem.dispatchEvent(evt);
      }
    }
          
    function readURL(input,output) {
        console.log(input.id);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#'+output).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $('.edit_button').on('click',function(){
        let id = $(this).attr('data-bs-target');
        $('#'+id.substring(1)).modal()
        $('#'+id.substring(1)+' .select2').select2()
    })
</script>
@endpush
