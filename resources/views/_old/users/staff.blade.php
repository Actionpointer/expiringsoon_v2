@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> 

<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush
@section('title') Admin Settings | Expiring Soon @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
              Settings
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Staff</a></li>
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
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0" >
            <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Staff</h2>
                </div>
                <div class="products-tab__btn">
                    <div class="container">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                    Manage Staff
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-countries-tab" data-bs-toggle="pill" data-bs-target="#pills-countries" type="button" role="tab" aria-controls="pills-countries" aria-selected="false">
                                    Add Staff
                                </button>
                            </li> 
                        </ul>
                    </div>
                </div>
                <div class="products-tab__content">
                    <div class="tab-content" id="pills-tabContent">
                        
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                            <div class="products-tab__information">
                                
                                <div class="dashboard__order-history-table">
                                    <div class="table-responsive">
                                        <table id="" class="table " style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    @if(auth()->user()->role->name == 'superadmin')
                                                    <th scope="col">Country</th>
                                                    @endif
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Manage</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{$user->name}}</td>
                                                        @if(auth()->user()->role->name == 'superadmin')
                                                            <td>{{$user->country->name}}</td>
                                                        @endif
                                                        <td>{{$user->email}}<br>{{$user->mobile}} </td>
                                                        <td>@if($user->status) Active @else Suspended @endif</td>
                                                        <td>
                                                                {{$user->role->name}}
                                                                @if($user->role->name == 'arbitrator')
                                                                    - {{$user->disputes->count()}} cases
                                                                @endif
                                                            </td>
                                                        <td>
                                                            @if($user->id != Auth::id()) 
                                                            <a href="javascript:void(0)" class="openedit"  data-staff="adminedit{{$user->id}}">Edit </a> | 
                                                            <form class="d-inline" action="{{route('admin.staff.delete')}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">@csrf
                                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                                <button type="submit" name="delete" value="1" class="text-danger">Delete</button>
                                                            </form>
                                                            
                                                            @endif
                                                        </td> 
                                                    </tr>
                                                    @if($user->id != Auth::id())
                                                    <tr>
                                                        <td colspan="6" style="border:none;padding:0px">
                                                            <form action="{{route('admin.staff.update')}}" method="post" id="adminedit{{$user->id}}" style="display:none">
                                                                @csrf 
                                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                                <div class="contact-form__content">
                                                                    <div class="contact-form__content-group my-3">
                                                                        <div class="contact-form-input">
                                                                            <label for="states">Admin Level</label>
                                                                            <select id="abdcc{{$user->id}}" name="role" class="form-control-lg w-100 border text-muted" >
                                                                                @foreach ($roles as $role)
                                                                                    <option value='{{$role}}' @if($user->role->name == $role) selected @endif>{{ucwords($role)}}</option>
                                                                                @endforeach
                                                                                
                                                                                
                                                                            </select>
                                                                        </div>
                                                                        <div class="contact-form-input">
                                                                            <label for="states">Status</label>
                                                                            <select id="abc{{$user->id}}" name="status" class="form-control-lg w-100 border text-muted" >
                                                                                <option value='1' @if($user->status) selected @endif>Active</option>
                                                                                <option value='0' @if(!$user->status) selected @endif>Suspended</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="contact-form__content-group my-3">
                                                                        <div class="contact-form-input">
                                                                            <label for="firstname">First Name @error('fname') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                            <input type="text" name="fname" value="{{$user->fname}}" placeholder="Enter First Name" />
                                                                        </div>
                                                                        <div class="contact-form-input">
                                                                            <label for="lastname">Last Name @error('lname') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                            <input type="text" name="lname" value="{{$user->lname}}" placeholder="Enter Last Name" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="contact-form__content-group">
                                                                        <div class="contact-form-input"> 
                                                                        <label for="email">Email @error('email') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                        <input type="email" name="email" value="{{$user->email}}" placeholder="Enter Email" />
                                                                        </div>
                                                                        <div class="contact-form-input">
                                                                        <label for="phone">Phone @error('phone') <span class="text-danger">{{$message}}</span> @enderror</label>
                                                                        <input type="text" name="phone" value="{{$user->phone}}" placeholder="Enter Phone" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="contact-form-btn">
                                                                        <button class="button button--md askpin" type="button"> Update Admin </button>
                                                                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="pills-countries" role="tabpanel" aria-labelledby="pills-countries-tab">
                            <div class="row products-tab__feedback"> 
                                <div class="dashboard__content-card-body">
                                    <form method="post" action="{{route('admin.staff.store')}}" id="admin" class="mb-3">@csrf
                                        <div class="contact-form__content">
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="states" style="">Admin Level</label>
                                                    <select id="zips" name="role" class="form-control-lg w-100 border text-muted" >
                                                        @foreach ($roles as $role)
                                                            <option value='{{$role}}'>{{ucwords($role)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="contact-form-input">
                                                    <label for="states" style="">Status</label>
                                                    <select id="zissdsp" name="status" class="form-control-lg w-100 border text-muted" >
                                                        <option value='1'>Active</option>
                                                        <option value='0'>Suspended</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="name">First Name</label>
                                                    <input type="text" name="fname" placeholder="Enter First Name" required />
                                                </div>
                                                <div class="contact-form-input">
                                                    <label for="name">Last Name</label>
                                                    <input type="text" name="lname" placeholder="Enter Last Name" required />
                                                </div>
                                            </div>
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input"> 
                                                <label for="email">Email</label>
                                                <input type="email" name="email" placeholder="Enter Email" required />
                                                </div>
                                                <div class="contact-form-input">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" placeholder="Enter Phone" required />
                                                </div>
                                            </div>
                                            <div class="contact-form__content-group">
                                                <div class="contact-form-input">
                                                    <label for="password">Password</label>
                                                    <input type="text" name="password" placeholder="Enter Password" required />
                                                </div>
                                                @if(auth()->user()->role->name == 'superadmin')
                                                    <div class="contact-form-input">
                                                        <label for="origin">Country </label>
                                                        <select id="countriez" name="country_id" class="select2 country">
                                                            @foreach ($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="country_id" value="{{auth()->user()->country_id}}">
                                                @endif
                                                
                                            </div>
                                            <div class="contact-form-btn">
                                                <button class="button button--md askpin" type="button"> + Create Admin </button>
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
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')
<script src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script>
<script>
    var modal_select = false;
    // var submittedform;
    $(document).ready(function() {
        $('.datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
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
    
    $(document).on('change','.country',function(){
        var clicked = $(this);
        var country_id = $(this).val();
        states = $(this).closest('.location').find('.states');
        $.ajax({
            dataType: 'json',
            url: "{{url('getStates')}}"+'/'+country_id,
            success:function(data) {
                console.log(data)
                states.children().remove()
                data.data.forEach(element => {
                    states.append(`<option value="`+element.id+`">`+element.name+` </option>`)
                });
                if(clicked.parents('.modal').length){
                    states.select2({
                        dropdownParent: clicked.closest('.modal')
                    });
                }else{
                    states.select2();
                }
                    
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        })
    })

    $('.modal').on('show.bs.modal', function () {
        $(this).find('.select2').select2({
            dropdownParent: $(this).find('.modal-content')
        });
        // $('.select2').select2();
        console.log($(this).html())
    });

    $('.openedit').click(function(){
        let id = $(this).attr('data-staff');
        $('#'+id).show();
        $('.select2').select2();
    })
</script>
@endpush
