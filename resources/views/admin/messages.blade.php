@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/css/jquery.dataTables.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/assets/buttons/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/datatable/custom.css')}}"/>

<style>
  .user-img{
    margin-right:5px;
    width:40px;
    height:40px;
    
  }
  /* *::-webkit-scrollbar {
    width: 12px;
  } */
 
</style>

@endpush
@section('title')Messages | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#"> Admin <span> > </span> </a>
          </li>
          <li class="active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
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
            <div class="messages">
                <h5 class="font-body--xxxl">Messages</h5>
                <div class="user-comments__list">
                  <div class="table-responsive">
                    <table id="datatable" class="table display" style="width:100%;font-size:13px">
                      <thead>
                        <tr>
                          <th scope="col" class="cart-table-title">Sender </th>
                          <th scope="col" class="cart-table-title">Type </th>
                          <th scope="col" class="cart-table-title">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @forelse ($messages as $message)
                          <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                              <td class="cart-table-item align-middle" style="background-color:#fff;padding-top:12px !important">
                                <a @if($message->order_id) href="{{route('order-details',$message->order)}}" @else href="{{route('admin.message',$message->user)}}" @endif class="d-block text-dark">
                                  <div class="d-flex">
                                    <div class="user-img">
                                      <img @if(!$message->user->pic) src="{{asset('img/avatar.png')}}" @else src="{{Storage::url($message->user->pic)}}" @endif class="rounded-circle" alt="user-photo">
                                    </div>
          
                                    <div class="user-message-info">
                                        <div class="d-flex">
                                          <h5 class="font-body--md-500">{{$message->user->name}}</h5>
                                          <ul class="inside"><li class="text-muted border-top border-white">{{$message->created_at->format('d M,Y h:i A')}}</li></ul>
                                        </div>
          
                                        <p class="font-body--sm-400">
                                          {{$message->body}}
                                        </p>
                                    </div>
                                  </div>
                                </a> 
                              </td>
                              <td class="cart-table-item order-date align-middle">
                                  @if($message->order_id) Order @else Support @endif
                              </td>
                              <td class="cart-table-item order-date align-middle">
                                {{$message->is_read ? 'Read': 'Unread'}}
                              </td>
                          </tr>
                        @empty
                          <div class="text-center">No Messages</div>
                        @endforelse
                    </table>
                  </div>
                  
                  
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('src/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
{{-- <script src="{{asset('src/datatable/assets/buttons/demo.js')}}"></script> --}}
<script src="{{asset('src/datatable/assets/buttons/vfs_fonts.js')}}"></script>
{{-- <script src="{{asset('src/datatable/assets/buttons/buttons.html5.min.js')}}"></script> --}}
{{-- <script src="{{asset('src/datatable/assets/buttons/buttons.print.min.js')}}"></script> --}}
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
            order: [2,'desc'],
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Messages",
            }
        });
    });
</script>
@endpush