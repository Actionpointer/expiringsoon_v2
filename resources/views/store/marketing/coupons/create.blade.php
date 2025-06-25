@extends('layouts.frontend.store.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/libs/quill/dist/quill.snow.css') }}">

@endpush
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Create Coupon</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Coupon</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.coupons',1) }}" class="btn btn-light">Back to Coupon</a>
                </div>
            </div>
        </div>
    </div>

    <!-- row -->
    <form action="#" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Giveaway Information Card -->
                <div class="card">
                    <div class="card-header">
                        Coupon Information
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Coupon Code</label>
                                <input type="text" class="form-control" name="coupon_code" placeholder="Enter coupon code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Coupon Quantity</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity">

                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Coupon Description</label>
                            <textarea class="form-control" name="coupon_description" placeholder="Enter coupon description"></textarea>

                        </div>
                        <!-- Start Date -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" placeholder="mm/dd/yyyy">

                            </div>

                            <!-- End Date -->
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" placeholder="mm/dd/yyyy">
                                
                            </div>
                        </div>

                        <!-- Select Product -->
                        

                        <!-- Maximum per User -->
                        
                        

                        

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Publish</button>
                            <button type="button" class="btn btn-outline-secondary">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <!-- Giveaway Summary Card -->
                <div class="card">
                    <div class="card-header">
                        Coupon Limits
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Details -->
                        <h6 class="mb-3">Product Limits</h6>
                        <div class="mb-4">      
                            <div class="form-group">
                                <select class="form-select" name="product_id">
                                    <option selected>Select products for this coupon</option>
                                    <option value="1">Product A</option>
                                    <option value="2">Product B</option>
                                    <option value="3">Product C</option>
                                </select>

                            </div>
                        </div>

                        
                        <h6 class="mb-3">Coupon Usage Limits</h6>
                        <div class="mb-4">
                            <label class="form-label">Number of uses per user</label>
                            <input type="number" class="form-control" name="number_of_uses_per_user" placeholder="Enter Number of uses per user">
                        </div>
                         
                        <h6 class="mb-3">Order Limits</h6>
                        <div class="mb-4">
                            <label class="form-label">Minimum order amount</label>
                            <input type="number" class="form-control" name="minimum_order_amount" placeholder="Enter Minimum order amount">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Maximum order amount</label>
                            <input type="number" class="form-control" name="maximum_order_amount" placeholder="Enter Maximum order amount">
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="{{ asset('frontend/libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/editor.js') }}"></script>
<script src="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendors/dropzone.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            width: '100%'
        });

        // Update maximum per user in summary
        $('input[name="max_per_user"]').on('input', function() {
            const value = $(this).val();
            let displayText = 'Unlimited';

            if (value && parseInt(value) > 0) {
                displayText = value;
            }

            $('.summary-item:nth-child(1) span:last-child').text(displayText);
        });

        // Update restrict to existing customers in summary
        $('#restrictToExisting').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.summary-item:nth-child(2) span:last-child').text(isChecked ? 'Yes' : 'No');
        });

        // Update start date in summary
        $('input[name="start_date"]').on('change', function() {
            const value = $(this).val();
            let displayText = 'Not set';

            if (value) {
                displayText = value;
            }

            $('.summary-item:nth-child(3) span:last-child').text(displayText);
        });

        // Update end date in summary
        $('input[name="end_date"]').on('change', function() {
            const value = $(this).val();
            let displayText = 'Continuous';

            if (value) {
                displayText = value;
            }

            $('.summary-item:nth-child(4) span:last-child').text(displayText);
        });

        // Initialize datepicker for date fields
        $('input[name="start_date"], input[name="end_date"]').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
@endpush