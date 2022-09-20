@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" /> 
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>
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
                <form method="post" action="{{route('admin.categories.management')}}" id="editcategory">@csrf
                  <div class="contact-form__content">

                    <div class="contact-form-input">
                      <label for="address">Name</label>
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

                    
                    
                    <div class="contact-form-btn">
                      <button class="button button--md" type="submit">
                        + Add Category
                      </button>
                    </div>
                    <div id="process" style="font-size:13px;margin-top:10px"></div>
                  </div>
                </form>
                <!-- Button trigger modal -->
              </div>
            </div>   

            <!-- Manage Categories  -->
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Manage Categories</h5>
              </div>
              <div class="dashboard__content-card-body">
                <div id="process3">
                  <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                          <th scope="col" class="cart-table-title">S/N</th>
                          <th scope="col" class="cart-table-title">Name</th>
                          <th scope="col" class="cart-table-title">Subcategories</th>
                          <th scope="col" class="cart-table-title">Items</th>
                          <th scope="col" class="cart-table-title">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                @foreach ($category->subcategories as $subcategory)
                                    {{$subcategory->name}},
                                @endforeach
                            </td>
                            <td>{{$category->products->count()}}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#editcategory{{$category->id}}">Edit</button> | 
                                <form action="{{route('admin.categories.management')}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">@csrf
                                    <input type="hidden" name="category_id" value="{{$category->id}}">
                                    <button type="submit" name="action" value="delete">Delete</button>
                                </form>
                            </td>
                          </tr>
                          <div class="modal fade" id="editcategory{{$category->id}}" aria-labelledby="editcategory{{$category->id}}Label" aria-hidden="true">
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
                                              @foreach ($category->subcategories as $subcategory)
                                                  <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
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
                        @endforeach
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
  

<!-- Modal -->

  
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
</script>
<script>
    // $('.select2').select2({
    //   dropdownParent: $(this).parent('.modal.show')
    // })
</script>
@endpush
