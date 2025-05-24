@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('vendor/tom-select/dist/css/tom-select.bootstrap5.css')}}">
@endpush
@section('main')
<!-- Breadcrumb -->
@include('layouts.snippets.breadcrumb')
<!-- End Breadcrumb -->

<!-- Content Section -->
<div class="container content-space-1 content-space-t-lg-0 content-space-b-lg-2 mt-lg-n10">
    <div class="row">
        <div class="col-lg-3">
            @include('admin.menu')
        </div>
        <!-- End Col -->


        <div class="col-lg-9">
            
                <div class="card">
                    <div class="card-body">
                        @include('admin.finance.menu')

                        <div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center pb-0">
                            <h5 class="card-header-title">Withdrawals</h5>
                            
                        </div>
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger my-2" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Date</th>
                                    <th>Profile</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($withdrawals as $withdrawal)
                                <tr>
                                    <td></td>
                                    <td>{{$withdrawal->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        <div class="d-flex align-items-center ">
                                            <div class="flex-grow-1">
                                                <div class="d-inline-block">
                                                    <p class=" mb-0">{{ $withdrawal->profile->name }} 
                                                        <img class="avatar avatar-xss ms-1" src="{{asset('svg/illustrations/top-vendor.svg')}}" alt="Image Description" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Verified user" data-bs-original-title="Verified user">
                                                    </p>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $withdrawal->currency }} {{$withdrawal->amount}}</td>
                                    <td>
                                        @if($withdrawal->paid_at) 
                                            <a class="d-block text-success" href="javascript:void(0)" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Paid at {{$withdrawal->paid_at->format('jS M,Y h:i A')}} by {{$withdrawal->approver->name}}">
                                                Paid <i class="bi-info-circle"></i> 
                                            </a>
                                             
                                        @elseif($withdrawal->rejection) 
                                            <a class="d-block text-danger" href="javascript:void(0)" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="{{ $withdrawal->rejection->reason }}">
                                                Rejected <i class="bi-info-circle"></i>
                                            </a>
                                        @elseif($withdrawal->approved_at)
                                            <a class="d-block text-info" href="javascript:void(0)" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Approved at {{$withdrawal->approved_at->format('jS M,Y h:i A')}} by {{$withdrawal->approver->name}}">
                                                Approved <i class="bi-info-circle"></i>
                                            </a>
                                            
                                        @elseif($withdrawal->failed_at) Failed
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    
                                    <td> 
                                        @if($withdrawal->paid_at) 
                                            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0)" >
                                                View <i class="bi-success-circle"></i> 
                                            </a>
                                        @endif
                                        @if(!$withdrawal->paid_at && !$withdrawal->approved_at && !$withdrawal->failed_at && !$withdrawal->rejection) 
                                            <button class="btn btn-sm btn-danger reject" data-withdrawal="{{$withdrawal}}" 
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Reject">
                                                    <i class="bi-x-lg"></i>
                                            </button>
                                        @endif
                                             
                                        @if(!$withdrawal->approved_at) 
                                            
                                            <button type="button" class="btn btn-sm btn-primary approve" data-withdrawal="{{$withdrawal}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" 
                                                 @if($withdrawal->failed_at) title="Retry" @else title="Approve" @endif> 
                                                 <i class="bi-check-lg"></i>
                                               
                                            </button>
                                            
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">Prev</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">Next</a>
                        </li>
                        </ul>
                    </nav>

                </div>
            
        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="confirmModalLabel">Confirmation</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
        <!-- Form -->
            <form class="d-inline" action="{{ route('admin.finance.payout')}}" method="post">@csrf
                <input type="hidden" name="withdrawal_id" class="withdrawal_id" value="{{$withdrawal->id}}">
                <input type="hidden" name="verify" id="withdrawal_action" value="">
                <p>You are about to <span class="withdrawal_action"></span> withdrawal of <span class="withdrawal_amount"></span> <span class="withdrawal_currency"></span> requested by <span class="withdrawal_owner"></span></p>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-sm btn-primary" >
                    <i class="bi-check-lg"></i> <span class="withdrawal_action"></span>
                </button>
            </form>
        <!-- End Form -->
        </div>
        <!-- End Body -->
    </div>
    </div>
</div>
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
            <h4 class="modal-title text-danger" id="rejectModalLabel">Reject Document</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
        <!-- Form -->
        <form action="{{route('admin.finance.payout')}}" method="post">@csrf
            <p>Withdrawal of <span class="withdrawal_amount"></span> <span class="withdrawal_currency"></span> submitted by <span class="withdrawal_owner"></span> is being rejected</p>
            <input type="hidden" name="withdrawal_id" class="withdrawal_id" value="">
            <div class="form-group mb-3">
                <label class="form-label" for="withdrawal_rejection">Rejection Reason</label>
                <textarea id="withdrawal_rejection" class="form-control" placeholder="Write rejection reason" name="reason" rows="5"></textarea>
            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="verify" value="reject" class="btn btn-danger">Reject </button>
            </div>
        </form>
        <!-- End Form -->
        </div>
        <!-- End Body -->
    </div>
    </div>
</div>

@endsection
@push('plugins')
<script src="{{asset('vendor/tom-select/dist/js/tom-select.complete.min.js')}}"></script>
@endpush
@push('scripts')
<script>
    $(document).on('click','.reject',function(){
        let withdrawal = JSON.parse($(this).attr('data-withdrawal'))
        $('.withdrawal_id').val(withdrawal.id)
        $('.withdrawal_amount').text(withdrawal.amount)
        $('.withdrawal_currency').text(withdrawal.currency)
        $('.withdrawal_owner').text(withdrawal.profile.name)
        $('#withdrawal_rejection').val(withdrawal.rejection ? withdrawal.rejection.reason:'')
        $('#rejectModal').modal('show')
    })
    $(document).on('click','.approve',function(){
        let withdrawal = JSON.parse($(this).attr('data-withdrawal'))
        $('.withdrawal_id').val(withdrawal.id)
        $('.withdrawal_amount').text(withdrawal.amount)
        $('.withdrawal_currency').text(withdrawal.currency)
        $('.withdrawal_owner').text(withdrawal.profile.name)
        $('#withdrawal_action').val(withdrawal.rejection ? 'retry':'approve')
        $('.withdrawal_action').text(withdrawal.rejection ? 'Retry':'Approve')
        $('#confirmModal').modal('show')
    })
</script>
@endpush