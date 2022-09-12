@extends('layouts.app')

@push('styles')

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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
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
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  
  @if(Session::has('result'))
      <div class="mb-0 @if(Session('result')) notify @else error @endif" >
          <p style="color:#fff">{{Session('message')}}</p>
      </div>
  @endif
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
                <h5 class="font-body--xl-500">Add Category / Sub Category</h5>
              </div>
              <div class="dashboard__content-card-body">
                <form method="post" id="editcategory">
                  <div class="contact-form__content">

                    <div class="contact-form__content-group">
                      <div class="contact-form-input">
                        <label for="states">Parent <small class="text-muted">(optional: only use when adding subcategory)</small></label>
                        <select id="states" name="cat_id" class="contact-form-input__dropdown">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="contact-form-input">
                      <label for="address">Category/Subcategory Name</label>
                      <input type="text" name="category" placeholder="" />
                    </div>
                    
                    <div class="contact-form-btn">
                      <button class="button button--md" type="submit">
                        + Add Category
                      </button>
                    </div>
                    <div id="process" style="font-size:13px;margin-top:10px"></div>
                  </div>
                </form>
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
                          <th scope="col" class="cart-table-title">Name</th>
                          <th scope="col" class="cart-table-title">Subcategories</th>
                          <th scope="col" class="cart-table-title">No of products</th>
                          <th scope="col" class="cart-table-title">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->subcategories->count()}}</td>
                            <td>{{$category->products->count()}}</td>
                            <td><a href="javascript:void()" data-target="#editcategorymodal" data-toggle="modal">Edit</a> | Delete</td>
                          </tr>
                          @if($category->subcategories->count())
                            @foreach ($category->subcategories as $subcategory)
                              <tr>
                                <td></td>
                                <td>{{$subcategory->name}}</td>
                                <td>{{$subcategory->products->count()}}</td>
                                <td>Edit | Delete</td>
                              </tr>
                            @endforeach
                          @endif
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
  <div class="modal fade" id="editcategorymodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
              <form method="post" id="editcategory">
                <div class="contact-form__content">

                  <div class="contact-form__content-group">
                    <div class="contact-form-input">
                      <label for="states">Parent <small class="text-muted">(optional: only use when adding subcategory)</small></label>
                      <select id="states" name="cat_id" class="contact-form-input__dropdown">
                          @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="contact-form-input">
                    <label for="address">Category/Subcategory Name</label>
                    <input type="text" name="category" placeholder="" />
                  </div>
                  
                  <div class="contact-form-btn">
                    <button class="button button--md" type="submit">
                      + Add Category
                    </button>
                  </div>
                  <div id="process" style="font-size:13px;margin-top:10px"></div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
  function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

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
  $('.edit-discount').click(function(){
      var period = $(this).attr('data-period')
      var discount = $(this).attr('data-discount')
      $('#discount_period option[value="'+period+'"]').prop('selected', true)
      $('#discount_value').val(discount)
      $('#discount_form').show();
  })
</script>
@endpush
