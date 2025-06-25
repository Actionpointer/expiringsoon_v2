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
                    <h2>Create Newsletters</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Giveaways</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.giveaways',1) }}" class="btn btn-light">Back to Giveaways</a>
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
                        Giveaway Information
                    </div>
                    <div class="card-body p-4">
                        <!-- Select Product -->
                        <div class="mb-4">
                            <label class="form-label">Select Product</label>
                            <div class="form-group">
                                <select class="form-select" name="product_id">
                                    <option selected>Select a product for this giveaway</option>
                                    <option value="1">Product A</option>
                                    <option value="2">Product B</option>
                                    <option value="3">Product C</option>
                                </select>
                                
                            </div>
                        </div>
                        
                        <!-- Maximum per User -->
                        <div class="mb-4">
                            <label class="form-label">Maximum per User</label>
                            <input type="number" class="form-control" name="max_per_user" placeholder="Enter minimum 1 or leave empty for unlimited">
                            <div class="form-text">Leave empty to allow multiple entries per user</div>
                        </div>
                        
                        <!-- Restrict to existing customers -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="restrictToExisting" name="restrict_to_existing">
                                <label class="form-check-label" for="restrictToExisting">
                                    Restrict to existing customers
                                </label>
                            </div>
                        </div>
                        
                        <!-- Total Quantity -->
                        <div class="mb-4">
                            <label class="form-label">Total Quantity</label>
                            <input type="number" class="form-control" name="total_quantity" placeholder="Enter minimum 1 or leave blank to use all available">
                            <div class="form-text">Leave blank to use all available stock</div>
                        </div>
                        
                        <!-- Start Date -->
                        <div class="mb-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" placeholder="mm/dd/yyyy">
                            
                        </div>
                        
                        <!-- End Date -->
                        <div class="mb-4">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" placeholder="mm/dd/yyyy">
                            <div class="form-text">Leave blank for continuous giveaway</div>
                        </div>
                        
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
                        Giveaway Summary
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Details -->
                        <h6 class="mb-3">Product Details</h6>
                        <p class="text-muted mb-4">No product selected</p>
                        
                        <!-- Giveaway Rules -->
                        <h6 class="mb-3">Giveaway Rules</h6>
                        <div class="summary-item mb-2">
                            <span>Maximum per User:</span>
                            <span>Unlimited</span>
                        </div>
                        <div class="summary-item mb-4">
                            <span>Restricted to Existing Customers:</span>
                            <span>No</span>
                        </div>
                        
                        <!-- Duration -->
                        <h6 class="mb-3">Duration</h6>
                        <div class="summary-item mb-2">
                            <span>Start Date:</span>
                            <span>Not set</span>
                        </div>
                        <div class="summary-item">
                            <span>End Date:</span>
                            <span>Continuous</span>
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