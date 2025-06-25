@extends('layouts.frontend.store.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/libs/quill/dist/quill.snow.css') }}">

<style>
    
    
</style>
@endpush
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Add Bundle</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Stores</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Tech Gadgets Store</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Bundles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Bundle</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="#" class="btn btn-light">Back to Bundles</a>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <form action="#" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body p-4">
                        <h4 class="mb-4 h5">Bundle Information</h4>
                        
                        <!-- Bundle Title -->
                        <div class="mb-4">
                            <label class="form-label">Bundle Title</label>
                            <input type="text" class="form-control" placeholder="Christmas Bundle" required />
                        </div>
                        
                        <!-- Select Products -->
                        <div class="mb-4">
                            <label class="form-label">Select Products</label>
                            <select class="form-select select2" multiple data-placeholder="Select products to add to bundle">
                                <option value="product_a">Product A</option>
                                <option value="product_b">Product B</option>
                                <option value="product_c">Product C</option>
                                <option value="product_d">Product D</option>
                                <option value="product_e">Product E</option>
                            </select>
                            
                        </div>
                        
                        <!-- Bundle Image -->
                        <div class="mb-4">
                            <label class="form-label">Bundle Image</label>
                            <div class="border-dashed mb-3">
                                <div class="file-upload-box py-3">
                                    <i class="bi bi-cloud-arrow-up fs-3 mb-2"></i>
                                    <p class="mb-0">Choose File</p>
                                    <p class="small text-muted mb-0">No file chosen</p>
                                    <input type="file" id="bundleImage" name="bundle_image">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bundle Price -->
                        <div class="mb-4">
                            <label class="form-label">Bundle Price</label>
                            <input type="text" class="form-control" placeholder="Enter bundle price" />
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Publish</button>
                            <button type="submit" class="btn btn-outline-secondary">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body p-4">
                        <h4 class="mb-4 h5">Bundle Summary</h4>
                        
                        <!-- Selected Products -->
                        <h6 class="mb-3">Selected Products</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-hover border">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Product A</td>
                                        <td>$100</td>
                                        <td>50</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Product C</td>
                                        <td>$200</td>
                                        <td>25</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Summary -->
                        <h6 class="mb-3">Summary</h6>
                        <table class="table summary-table">
                            <tr>
                                <td>Number of Items:</td>
                                <td class="text-end">2</td>
                            </tr>
                            <tr>
                                <td>Sum Up Price:</td>
                                <td class="text-end">$300</td>
                            </tr>
                            <tr>
                                <td>Bundle Price:</td>
                                <td class="text-end">$0</td>
                            </tr>
                            <tr>
                                <td>Discount:</td>
                                <td class="text-end">$300</td>
                            </tr>
                        </table>
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
            width: '100%',
            tags: true,
            tokenSeparators: [',']
        });
        
        // Display filename when file is selected
        $('#bundleImage').on('change', function() {
            const fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $(this).parent().find('.text-muted').text(fileName);
            } else {
                $(this).parent().find('.text-muted').text('No file chosen');
            }
        });
        
        // Remove product when × is clicked
        $('.product-tag .remove').on('click', function() {
            $(this).parent().remove();
            // Update the select2 value as well
            // This is simplified - you'd need to update the actual select2 value based on your data structure
        });
        
        // Remove product when trash button is clicked
        $('.btn-outline-danger').on('click', function() {
            $(this).closest('tr').remove();
            // Update the select2 value and the product tags as well
        });
        
        // Calculate discount and update summary when bundle price changes
        $('input[placeholder="Enter bundle price"]').on('input', function() {
            const bundlePrice = parseFloat($(this).val()) || 0;
            const sumUpPrice = 300; // This should be calculated based on selected products
            const discount = sumUpPrice - bundlePrice;
            
            // Update summary table
            $('.summary-table tr:nth-child(3) td:last-child').text('$' + bundlePrice);
            $('.summary-table tr:nth-child(4) td:last-child').text('$' + discount);
        });
    });
</script>
@endpush