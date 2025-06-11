@extends('layouts.frontend.store.app')
@push('styles')
<!-- <link rel="stylesheet" href="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.css') }}"> -->
<link href="{{asset('vendor/summernote/summernote-bs5.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/css/select2.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/css/custom.css')}}" />
<style>
    .note-color .dropdown-toggle {
        width: 35px !important;
    }
    .note-color .note-dropdown-menu.show{
        display:flex !important;
    }
</style>
@endpush
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Add New Product</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="products.html" class="btn btn-light">Back to Product</a>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <form action="" method="get">
        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- card -->
                <div class="card mb-6 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <h4 class="mb-4 h5">Product Information</h4>
                        <div class="row">
                            <!-- input -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" placeholder="Product Name" required />
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label">Product Category</label>
                                <select class="form-select">
                                    <option selected>Product Category</option>
                                    <option value="Dairy, Bread & Eggs">Dairy, Bread & Eggs</option>
                                    <option value="Snacks & Munchies">Snacks & Munchies</option>
                                    <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                                </select>
                            </div>
                            <!-- input -->

                            <div class="mb-3 mt-5 col-lg-12">
                                <h4 class="mb-3 h5">Product Images</h4>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="filepath">
                                </div>
                                <div id="holder" class="border-dashed rounded-2" style="margin-top:15px;max-height:100px;"></div>
                                
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-lg-12 mt-5">
                                <h4 class="mb-3 h5">Product Descriptions</h4>
                                <textarea class="summernote-editor form-control" rows="3" placeholder="Product Description"></textarea>
                            </div>
                            <div class="mb-3 mt-5 col-lg-12">
                                <h4 class="mb-3 h5">Meta Data</h4>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="Meta Description"></textarea>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-12 mt-5">
                                <!-- heading -->
                                <h4 class="mb-3 h5">Product Attributes</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4"><label class="form-label">Attributes</label></div>
                                            <div class="col-md-8"><label class="form-label">Options</label></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">

                                                <select class="form-select select2">
                                                    <option value="color" selected>Color</option>
                                                    <option value="size">Size</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7 d-flex align-items-center">

                                                <select name="" id="" class="form-select select2" multiple data-placeholder="Select Attribute" data-tags="true">
                                                    <option value=""></option>
                                                    <option value="blue">Blue</option>
                                                    <option value="red">Red</option>
                                                    <option value="green">Green</option>
                                                    <option value="yellow">Yellow</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="purple">Purple</option>
                                                    <option value="pink">Pink</option>
                                                    <option value="brown">Brown</option>
                                                    <option value="black">Black</option>
                                                    <option value="white">White</option>
                                                    <option value="gray">Gray</option>

                                                </select>
                                            </div>
                                            <div class="col-md-1 px-0">
                                                <a href="#" class="text-danger fs-4 p-2">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <select class="form-select select2" data-placeholder="Select Attribute" data-tags="true">
                                                    <option value=""></option>
                                                    <option value="color">Color</option>
                                                    <option value="size">Size</option>
                                                    <option value="weight">Weight</option>
                                                    <option value="material">Material</option>
                                                    <option value="style">Style</option>
                                                    <option value="brand">Brand</option>

                                                </select>
                                            </div>
                                            <div class="col-md-7 d-flex align-items-center">
                                                <select name="" id="" class="form-select select2" multiple data-placeholder="Select Attribute" data-tags="true">
                                                    <option value=""></option>
                                                    <option value="blue">Blue</option>
                                                    <option value="red">Red</option>
                                                    <option value="green">Green</option>
                                                    <option value="yellow">Yellow</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="purple">Purple</option>
                                                    <option value="pink">Pink</option>
                                                    <option value="brown">Brown</option>
                                                    <option value="black">Black</option>
                                                    <option value="white">White</option>
                                                    <option value="gray">Gray</option>

                                                </select>
                                            </div>
                                            <div class="col-md-1 px-0">
                                                <a href="#" class="text-danger fs-4 p-2">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button type="button" class="btn btn-outline-primary" id="addAttributeBtn">Add Attribute</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 mt-5" id="variant_container">
                                <h4 class="mb-3 h5">Product Variants</h4>
                                <div class="card mb-3" id="variant_1">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Variant 1</label>
                                            </div>
                                            <div class="col-md-8 text-end">
                                                <a href="#" class="text-danger fs-4 p-2">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="mb-3 col-lg-6">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" placeholder="0" />
                                            </div>
                                            <!-- input -->
                                            <div class="mb-3 col-lg-6">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" class="form-control" placeholder="0" />
                                            </div>
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label">Color</label>
                                                <select class="form-select">
                                                    <option value="red">Red</option>
                                                    <option value="blue">Blue</option>
                                                    <option value="green">Green</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label">Size</label>
                                                <select class="form-select">
                                                    <option value="small">Small</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="large">Large</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label">Material</label>
                                                <select class="form-select">
                                                    <option value="cotton">Cotton</option>
                                                    <option value="polyester">Polyester</option>
                                                    <option value="silk">Silk</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <button type="button" class="w-100 btn btn-outline-success" id="addVariantBtn">Add Variant</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- card -->
                <div class="card mb-6 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <h4 class="mb-4 h5">Product Inventory</h4>
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock" checked />
                            <label class="form-check-label" for="flexSwitchStock">Always Available</label>
                        </div>
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock" checked />
                            <label class="form-check-label" for="flexSwitchStock">Allow Pre-order</label>
                        </div>
                        <!-- input -->
                        
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-6 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <h4 class="mb-4 h5">Product Expiry</h4>
                        <!-- input -->
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" role="switch" id="productCanExpire" checked />
                            <label class="form-check-label" for="flexSwitchStock">Product can expire</label>
                        </div>
                        <!-- input -->
                        <div id="expiryDetails" style="display: block;">
                            <div class="mb-3">
                                <label class="form-label">Expiry Term</label>
                                <select class="form-select" name="expiry_term">
                                    <option selected>Best Before</option>
                                    <option value="use_by">Use By</option>
                                    <option value="sell_by">Sell By</option>
                                    <option value="display_until">Display Until</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" name="expiry_date">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expiry Discount</label>
                                <div class="row g-2">
                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="1 Month" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" name="discount_1_month" min="0" max="100" placeholder="%">
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="2 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" name="discount_2_month" min="0" max="100" placeholder="%">
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="3 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" name="discount_3_month" min="0" max="100" placeholder="%">
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="6 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" name="discount_6_month" min="0" max="100" placeholder="%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
                
                <!-- button -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-light flex-grow-1">Save as Draft</button>
                    <button type="submit" class="btn btn-primary flex-grow-1">Publish</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="{{asset('vendor/summernote/summernote-bs5.js')}}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.summernote-editor').summernote({
            height: 'auto',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear','fontsize','italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']]
            ]
        })
        $('.select2').select2();
        // Toggle expiry details based on checkbox
        document.getElementById('productCanExpire').addEventListener('change', function() {
            document.getElementById('expiryDetails').style.display = this.checked ? 'block' : 'none';
        });
        // Add event listeners for add attribute and variant buttons
        document.getElementById('addAttributeBtn').addEventListener('click', function() {
            // Add attribute logic
            console.log('Add attribute');
        });

        document.getElementById('addVariantBtn').addEventListener('click', function() {
            // Add variant logic
            console.log('Add variant');
        });

        // Remove buttons
        document.querySelectorAll('.remove-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Remove parent element logic
                console.log('Remove element');
            });
        });
        var route_prefix = "{{ route('store.filemanager',$store) }}";
        $('#lfm').filemanager('image', {prefix: route_prefix});

    })
</script>
@endpush