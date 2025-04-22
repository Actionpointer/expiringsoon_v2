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
                            <h5 class="card-header-title">Settlements</h5>
                            
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Profile</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($settlements as $settlement)
                                <tr>
                                    <td>{{$settlement->created_at->format('jS M,Y h:i A')}}</td>
                                    <td>
                                        <div class="d-flex align-items-center ">
                                            <div class="flex-shrink-0">
                                                @if($settlement->profile->photo)
                                                <img class="avatar avatar-sm avatar-circle" src="{{Storage::url($settlement->profile->photo)}}" alt="Image Description">
                                                @else
                                                <span class="avatar avatar-sm avatar-info avatar-circle">
                                                    <span class="avatar-initials">{{ substr($settlement->profile->name,0,2) }}</span>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-inline-block">
                                                    <p class=" mb-0">{{ $settlement->profile->name }} 
                                                        <img class="avatar avatar-xss ms-1" src="{{asset('svg/illustrations/top-vendor.svg')}}" alt="Image Description" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Verified user" data-bs-original-title="Verified user">
                                                    </p>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$settlement->description}} </td>
                                    <td>{{ $settlement->currency }} {{$settlement->amount}}</td>
                                    <td>{{ $settlement->status }}</td>
                                    
                                    <td> <button class="btn btn-sm btn-outline-primary">View Source</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation">
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
<div class="modal fade" id="settlementModal" tabindex="-1" aria-labelledby="settlementModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="settlementModalLabel">Create settlement</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="modal-body">
                <form action="" method="post">@csrf

                    <input type="hidden" name="action" value="create">
                    <fieldset>

                        <label for="instruction" class="mb-5">The settlement code will be auto-generated after you save </label>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="percentage">Percentage<span class="required">*</span></label>
                                    <input type="number" class="form-control px-3 " name="percentage" max="" required
                                        id="percentage">
                                </div>
                                <small class="">Percentage will be taken out of your commission</small>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimum">Minimum Spend </label>
                                    <input type="number" class="form-control px-3 " name="minimum"
                                        id="minimum" autocomplete="given-name">
                                </div>
                                <small class="">Threshold to avail settlement (optional)</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_at">Start Date</label>
                                    <input type="date" class="form-control" name="start_at" id="start_at" value="{{now()}}">
                                </div>
                                <small class="">If left empty, today will be used</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_at">End Date<span class="required">*</span></label>
                                    <input type="date" class="form-control" name="end_at"
                                        id="end_at" autocomplete="given-name">
                                </div>
                                <small class="">If left empty, settlement will run indefinitely</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 mb-4">
                                <label for="">Limitation</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="limit_per_user" id="limit_per_user_1" value="1" checked>
                                    <label class="form-check-label" for="limit_per_user_1">
                                        Allow single use by a customer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="limit_per_user" value="0" id="limit_per_user0">
                                    <label class="form-check-label" for="limit_per_user0">
                                        Allow multiple use by a customer
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="1" id="status1" checked>
                                    <label class="form-check-label" for="status1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="0" id="status0">
                                    <label class="form-check-label" for="status0">
                                        Draft
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="woocommerce-Button button" name="save_account_details" value="Save changes">Save changes</button>



                    </fieldset>


                    <div class="clear"></div>


                </form>
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
    (function() {
        HSCore.components.HSTomSelect.init('.js-select')
    })()
    $('.show_assignment').on('click', function() {
        let package = $(this).attr('data-package_url');
        $('.appended').remove()

    })
</script>
@endpush