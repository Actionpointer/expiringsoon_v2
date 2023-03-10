@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title')Users @endsection
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
          <li class="active"><a href="{{route('admin.dashboard')}}">Users</a></li>
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
          <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
            <p class="font-body--xl-500">Manage Users</p>
            <a href="#" class="font-body--lg-500">{{number_format($users->count(), 0)}} Users</a>
          </div>
          <div class="container">
            <!-- Products -->
            <div class="table-responsive">
              <table id="datatable" class="table display" style="width:100%;font-size:13px">
                <thead>
                  <tr>
                    <th scope="col" class="cart-table-title">User </th>
                    <th scope="col" class="cart-table-title">Details</th>
                    <th scope="col" class="cart-table-title">Role</th>
                    <th scope="col" class="cart-table-title">Status</th>
                    <th scope="col" class="cart-table-title"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                      <!-- Product item  -->
                      <td class="cart-table-item align-middle" style="background-color:#fff;padding-top:12px !important">
                          <div class="cart-table__product-item-img">
                            <a href="{{route('admin.user.show',$user)}}">
                            <img src="{{Storage::url($user->pic)}}" alt="{{$user->name}}" onerror="this.src='{{asset('src/images/site/avatar.png')}}'" /></a>
                          </div>
                      </td>
                      <td class="cart-table-item order-date align-middle">
                        <a href="{{route('admin.user.show',$user)}}">
                          <span class="font-body--lg-500" style="color:#000">#{{$user->id}}. {{$user->name}}</span>
                        <br />
                          <span style="font-size:12px;color:#888">{{$user->email}}</span><br>
                          <span style="font-size:12px;color:#888">{{$user->mobile}}</span>

                        </a>
                      </td>
                      <!-- Price  -->
                      <td class="cart-table-item order-date align-middle">
                        <p class="font-body--lg-500" style="color:#00b207">{{ucwords($user->role->name)}}</p>
                      </td>
                      <!-- Stock Status  -->
                      <td class="cart-table-item order-date align-middle">
                        <p class="font-body--lg-500"> 
                          @if($user->status)
                          <span class="font-body--md-400 in"> Active</span>
                          @else
                          <span class="font-body--md-400 out"> Suspended</span>
                          @endif
                        </p>
                      </td>
                      <td class="cart-table-item add-cart align-middle">
                        <div class="dropdown">
                          <button class="btn btn-sm btn-secondary dropdown-toggle dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Manage
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form class="d-inline" action="{{route('admin.user.manage')}}" method="post" onsubmit="return confirm('Are you sure?');">@csrf
                              <input type="hidden" name="user_id" value="{{$user->id}}">
                              @if(!$user->status)
                              <button type="submit" name="status" value="1" class="dropdown-item">Activate</button>
                              @else
                              <button type="submit" name="status" value="0" class="dropdown-item">Suspend</button>
                              @endif
                            </form>                                      
                          </div>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr style="margin:auto;padding:1%;text-align:center">
                      <td colspan="5"> <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                        <br/>There are no registered customers at this time.</span>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
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
            searchPlaceholder: "Search Users",
            }
        });
    });
</script>
@endpush