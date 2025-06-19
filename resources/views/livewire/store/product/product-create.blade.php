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
    <form wire:submit.prevent="saveAsPublished">
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
                                <input type="text" wire:model="name" class="form-control" placeholder="Product Name" required />
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label">Product Category</label>
                                @php
                                    $categoryOptions = [];
                                    foreach($categories as $category) {
                                        $categoryOptions[] = [
                                            'value' => $category->id,
                                            'label' => $category->name,
                                            'extra' => '',
                                        ];
                                    }
                                @endphp
                                @livewire('components.form.select2-single', [
                                    'value' => $category_id,
                                    'options' => $categoryOptions,
                                    'placeholder' => 'Select Product Category',
                                    'wireModel' => 'category_id',
                                    'uniqueId' => 'category_id',
                                ])
                                @error('category_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-5 col-lg-12">
                                <h4 class="mb-3 h5">Product Images</h4>
                                @livewire('components.form.file-manager', [
                                    'value' => $photos,
                                    'placeholder' => 'Choose product images',
                                    'wireModel' => 'photos',
                                    'routePrefix' => route('store.filemanager', $store)
                                ])
                                @error('photos')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- input -->
                            <div wire:ignore class="mb-3 col-lg-12 mt-5">
                                <h4 class="mb-3 h5">Product Descriptions</h4>
                                @livewire('components.form.summernote-editor', [
                                    'content' => $description,
                                    'placeholder' => 'Product Description',
                                    'wireModel' => 'description'
                                ])
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 mt-5 col-lg-12">
                                <h4 class="mb-3 h5">Meta Data</h4>
                                <div class="mb-3">
                                    <textarea wire:model="meta_description" class="form-control" rows="3" placeholder="Meta Description"></textarea>
                                    @error('meta_description')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Attributes Component -->
                            <div class="mb-3 col-lg-12 mt-5">
                                @livewire('store.product.product-attributes')
                            </div>

                            <!-- Product Variants Component -->
                            <div class="col-lg-12 mt-5" >
                                @livewire('store.product.product-variants', ['routePrefix' => route('store.filemanager', $store)])
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
                            <input class="form-check-input" type="checkbox" role="switch" wire:model="always_available" value="1" id="flexSwitchStock" checked />
                            <label class="form-check-label" for="flexSwitchStock">Always Available</label>
                            @error('always_available')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" role="switch" wire:model="preorder" value="1" id="flexSwitchStock" checked />
                            <label class="form-check-label" for="flexSwitchStock">Allow Pre-order</label>
                            @error('preorder')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
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
                                <select class="form-select" wire:model="expiry_term">
                                    <option value="best_before" selected>Best Before</option>
                                    <option value="expire_on">Expire on</option>
                                </select>
                                @error('expiry_term')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" wire:model="expire_at">
                                @error('expire_at')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expiry Discount</label>
                                <div class="row g-2">
                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="1 Month" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount30" min="0" max="100" placeholder="%">
                                            @error('discount30')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="2 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount60" min="0" max="100" placeholder="%">
                                            @error('discount60')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="3 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount90" min="0" max="100" placeholder="%">
                                            @error('discount90')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="6 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount120" min="0" max="100" placeholder="%">
                                            @error('discount120')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- button -->
                <div class="d-flex gap-2">
                    <button type="button" wire:click="saveAsDraft" class="btn btn-light flex-grow-1">
                        <span wire:loading.remove wire:target="saveAsDraft">Save as Draft</span>
                        <span wire:loading wire:target="saveAsDraft">Saving...</span>
                    </button>
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <span wire:loading.remove wire:target="saveAsPublished">Publish</span>
                        <span wire:loading wire:target="saveAsPublished">Publishing...</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
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

@push('scripts')
<script src="{{asset('vendor/summernote/summernote-bs5.js')}}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
    $(document).ready(function(){
        // Toggle expiry details based on checkbox
        document.getElementById('productCanExpire').addEventListener('change', function() {
            document.getElementById('expiryDetails').style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@endpush 