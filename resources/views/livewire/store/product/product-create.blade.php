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
    <form wire:submit.prevent="saveProduct">
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
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label">Product Category</label>
                                <select wire:model="category_id" class="form-select select2" data-placeholder="Select Product Category">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
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
                                    <input id="thumbnail" wire:model="photos" class="form-control" type="text" name="photos">
                                </div>
                                <div id="holder" class="border-dashed rounded-2" style="margin-top:15px;max-height:100px;"></div>
                                
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-lg-12 mt-5">
                                <h4 class="mb-3 h5">Product Descriptions</h4>
                                <textarea wire:model="description" class="summernote-editor form-control" rows="3" placeholder="Product Description"></textarea>
                            </div>
                            <div class="mb-3 mt-5 col-lg-12">
                                <h4 class="mb-3 h5">Meta Data</h4>
                                <div class="mb-3">
                                    <textarea wire:model="meta_description" class="form-control" rows="3" placeholder="Meta Description"></textarea>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-12 mt-5">
                                <!-- heading -->
                                <h4 class="mb-3 h5">Product Attributes</h4>
                                <div class="card">
                                    <div class="card-body" id="attribute_container">
                                        <div class="row mb-3">
                                            <div class="col-md-4"><label class="form-label">Attributes</label></div>
                                            <div class="col-md-8"><label class="form-label">Options</label></div>
                                        </div>
                                        <div class="row mb-3 attribute_row">
                                            <div class="col-md-4">
                                                <select wire:model="selected_attributes.0" class="form-select select2 select_attribute" data-placeholder="Select Attribute">
                                                    <option value=""></option>
                                                    @foreach($product_attributes as $attribute)
                                                        <option value="{{ $attribute->id }}" data-options="{{ $attribute->options }}">{{ $attribute->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-7 d-flex align-items-center">
                                                <select wire:model="selected_options.0" class="form-select select2 select_attribute_options" multiple data-tags="true" data-placeholder="Select Options">

                                                </select>
                                            </div>
                                            <div class="col-md-1 px-0">
                                                <a href="#" class="text-danger fs-4 p-2 delete-attribute">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>

                                        </div>
                                            </div>
                                    <div class="d-grid p-4">
                                            <button type="button" class="btn btn-outline-primary" id="addAttributeBtn">Add Attribute</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 mt-5" id="variant_container">
                                <h4 class="mb-3 h5">Product Variants</h4>
                                <div class="card mb-3 variant-item" id="variant_1">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label variant-label">Variant 1</label>
                                            </div>
                                            <div class="col-md-8 text-end">
                                                <a href="#" class="text-danger fs-4 p-2 delete-variant">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="mb-3 col-lg-6">
                                                <label class="form-label">Price</label>
                                                <input type="number" wire:model="variants.0.price" class="form-control" placeholder="0" />
                                            </div>
                                            <!-- input -->
                                            <div class="mb-3 col-lg-6">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" wire:model="variants.0.stock" class="form-control" placeholder="0" />
                                            </div>
                                        </div>
                                        <!-- Dynamic attribute options will be inserted here -->
                                        <div class="row variant-options-container">
                                            <!-- Options will be dynamically generated via JavaScript -->
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
                            <input class="form-check-input" type="checkbox" role="switch" wire:model="always_available" value="1" id="flexSwitchStock" checked />
                            <label class="form-check-label" for="flexSwitchStock">Always Available</label>
                        </div>
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" role="switch" wire:model="preorder" value="1" id="flexSwitchStock" checked />
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
                                <select class="form-select" wire:model="expiry_term">
                                    <option value="best_before" selected>Best Before</option>
                                    <option value="expire_on">Expire on</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" wire:model="expire_at">
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
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="2 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount60" min="0" max="100" placeholder="%">
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="3 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount90" min="0" max="100" placeholder="%">
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-9">
                                        <input type="text" class="form-control-plaintext mb-2" placeholder="6 Months" readonly="">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="percent-input">
                                            <input type="number" class="form-control mb-2" wire:model="discount120" min="0" max="100" placeholder="%">
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
                    <button type="button" wire:click="saveAsDraft" class="btn btn-light flex-grow-1">
                        <span wire:loading.remove wire:target="saveAsDraft">Save as Draft</span>
                        <span wire:loading wire:target="saveAsDraft">Saving...</span>
                    </button>
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <span wire:loading.remove wire:target="saveProduct">Publish</span>
                        <span wire:loading wire:target="saveProduct">Publishing...</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
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
@push('scripts')
<script src="{{asset('vendor/summernote/summernote-bs5.js')}}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
    $(document).ready(function(){
        // Store a clone of the attribute row template
        var attributeRowTemplate = $('.attribute_row').first().clone();
        
        // Store a clone of the variant template
        var variantTemplate = $('#variant_1').clone();
        
        // Store selected attributes and their options
        var selectedAttributes = {};
        
        // Initialize plugins
        $('.summernote-editor').summernote({
            height: 'auto',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear','fontsize','italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']]
            ]
        });
        
        initSelect2();
        
        function initSelect2() {
        $('.select2').select2();
        }

        // Handle attribute selection change
        $(document).on('change', '.select_attribute', function() {
            var selectedOption = $(this).find('option:selected');
            var options = selectedOption.data('options');
            
            if (options) {
                var optionsArray = options.split(",");
                var optionsHtml = '';
                optionsArray.forEach(function(option) {
                    optionsHtml += '<option value="' + option + '">' + option + '</option>';
                });
                $(this).closest('.attribute_row').find('.select_attribute_options').html(optionsHtml);
            } else {
                $(this).closest('.attribute_row').find('.select_attribute_options').html('');
            }
            
            // Refresh select2
            $(this).closest('.attribute_row').find('.select_attribute_options').select2();
            
            // Delay to ensure options are populated before collecting
            setTimeout(collectSelectedAttributes, 100);
        });
        
        // Handle attribute options change
        $(document).on('change', '.select_attribute_options', function() {
            collectSelectedAttributes();
        });

        // Function to collect selected attributes and their options
        function collectSelectedAttributes() {
            selectedAttributes = {};
            
            $('.attribute_row').each(function() {
                var attributeSelect = $(this).find('.select_attribute');
                var optionsSelect = $(this).find('.select_attribute_options');
                
                var attributeId = attributeSelect.val();
                if (attributeId) {
                    var attributeName = attributeSelect.find('option:selected').text();
                    var selectedOptions = [];
                    
                    // Get all selected options
                    optionsSelect.find('option:selected').each(function() {
                        selectedOptions.push($(this).val());
                    });
                    
                    if (selectedOptions.length > 0) {
                        selectedAttributes[attributeName] = {
                            id: attributeId,
                            options: selectedOptions
                        };
                    }
                }
            });
            // Update all existing variants with the new attributes
            updateVariantsBasedOnAttributes();
        }
        
        // Add event listener for add attribute button
        $('#addAttributeBtn').on('click', function() {
            // Get current number of attribute rows before adding new one
            var rowCount = $('.attribute_row').length;
            
            // Clone the template
            var newRow = attributeRowTemplate.clone();
            
            // Clear selected values in the new row
            newRow.find('select').val('').trigger('change');
            
            // Update wire:model attributes with dot notation for the new row
            newRow.find('.select_attribute').attr('wire:model', 'selected_attributes.' + rowCount);
            newRow.find('.select_attribute_options').attr('wire:model', 'selected_options.' + rowCount);
            
            // Append to container before the grid div
            $('#attribute_container').find('.attribute_row').last().after(newRow);
            
            // Reinitialize Select2 on the new row
            newRow.find('.select2').select2();
            
            //Let Livewire know a property has changed
            let attributeSelect = newRow.find('select[wire\\:model^="selected_attributes"]')[0];
            if (attributeSelect) {
                attributeSelect.dispatchEvent(new Event('change', { 'bubbles': true }));
            }
        });
        
        // Delete attribute row
        $(document).on('click', '.delete-attribute', function(e) {
            e.preventDefault();
            
            // Count attribute rows
            var rowCount = $('.attribute_row').length;
            
            // Only delete if more than one row exists
            if (rowCount > 1) {
                $(this).closest('.attribute_row').remove();
                
                // Update indices for wire:model with dot notation
                updateAttributeIndices();
                
                // Notify Livewire of the changes
                $('#attribute_container').find('.attribute_row').first().find('select').first().trigger('change');
                
                // Update variants based on current attributes
                updateVariantsBasedOnAttributes();
            } else {
                // Alert user they can't delete the last row
                alert('You must have at least one attribute row.');
            }
        });
        
        // Add event listener for add variant button
        $('#addVariantBtn').on('click', function() {
            // Count current variants
            var variantCount = $('.variant-item').length;
            
            // Clone the template
            var newVariant = $('#variant_1').clone();
            
            // Update the ID
            newVariant.attr('id', 'variant_' + (variantCount + 1));
            
            // Clear input values
            newVariant.find('input[type="number"]').val('');
            
            // Add class for identification
            newVariant.addClass('variant-item');
            
            // Append to container
            $('#variant_container').append(newVariant);
            
            // Update wire:model attributes if using Livewire
            updateVariantIndices();
            
            // Apply the current attribute options to this variant
            generateVariantFields(newVariant, variantCount);
        });
        
        // Delete variant
        $(document).on('click', '.delete-variant', function(e) {
            e.preventDefault();
            
            // Count variants
            var variantCount = $('.variant-item').length;
            
            // Only delete if more than one variant exists
            if (variantCount > 1) {
                $(this).closest('.variant-item').remove();
                
                // Update indices for wire:model attributes
                updateVariantIndices();
            } else {
                // Alert user they can't delete the last variant
                alert('You must have at least one variant.');
            }
        });
        
        // Helper function to update wire:model indices for attributes using dot notation
        function updateAttributeIndices() {
            // Get all attribute rows and update their indices
            $('.attribute_row').each(function(index) {
                // Find the select elements with wire:model for attributes and options
                var attrSelect = $(this).find('select[wire\\:model^="selected_attributes"]');
                var optSelect = $(this).find('select[wire\\:model^="selected_options"]');
                
                // Store current values
                var attrValue = attrSelect.val();
                var optValues = [];
                optSelect.find('option:selected').each(function() {
                    optValues.push($(this).val());
                });
                
                // Update wire:model attributes
                attrSelect.attr('wire:model', 'selected_attributes.' + index);
                optSelect.attr('wire:model', 'selected_options.' + index);
                
                // Important: To make Livewire aware of the change, we need to create a temporary input,
                // set its wire:model and value, and then trigger a change event
                var tempInput = $('<input type="hidden">');
                tempInput.attr('wire:model', 'selected_attributes.' + index);
                tempInput.val(attrValue);
                
                // Append to DOM temporarily
                $(this).append(tempInput);
                
                // Trigger change to notify Livewire
                tempInput.trigger('change');
                
                // Remove temporary input
                tempInput.remove();
                
                // Now do the same for options if there were selected options
                if (optValues.length > 0) {
                    var tempOptInput = $('<input type="hidden">');
                    tempOptInput.attr('wire:model', 'selected_options.' + index);
                    tempOptInput.val(JSON.stringify(optValues));
                    
                    $(this).append(tempOptInput);
                    tempOptInput.trigger('change');
                    tempOptInput.remove();
                }
            });
            
            // Initialize Select2 again
            $('.select2').select2();
        }
        
        // Helper function to update wire:model indices for variants
        function updateVariantIndices() {
            $('.variant-item').each(function(index) {
                // Update price and stock fields
                $(this).find('input[wire\\:model^="variants"][wire\\:model$="price"]').attr('wire:model', 'variants.' + index + '.price');
                $(this).find('input[wire\\:model^="variants"][wire\\:model$="stock"]').attr('wire:model', 'variants.' + index + '.stock');
                
                // Update option fields (which will be dynamically generated)
                $(this).find('select[wire\\:model^="variants"]').each(function() {
                    var optionName = $(this).attr('wire:model').split('.').pop();
                    $(this).attr('wire:model', 'variants.' + index + '.options.' + optionName);
                });
            });
        }
        
        // Update all variants based on current attributes
        function updateVariantsBasedOnAttributes() {
            $('.variant-item').each(function(index) {
                generateVariantFields($(this), index);
            });
        }

        // Helper function to generate variant fields based on selected attributes
        function generateVariantFields(variantElement, variantIndex) {
            var optionsContainer = variantElement.find('.variant-options-container');
            if (optionsContainer.length === 0) {
                // Create container if it doesn't exist
                variantElement.find('.card-body').append('<div class="row variant-options-container"></div>');
                optionsContainer = variantElement.find('.variant-options-container');
            } else {
                // Clear existing fields
                optionsContainer.empty();
            }
            
            // Add fields for each selected attribute
            Object.keys(selectedAttributes).forEach(function(attrName) {
                var attrOptions = selectedAttributes[attrName].options;
                var attrId = selectedAttributes[attrName].id;
                
                // Create select field for this attribute
                var fieldHtml = `
                    <div class="mb-3 col-lg-4">
                        <label class="form-label">${attrName}</label>
                        <select class="form-select" wire:model="variants.${variantIndex}.options.${attrId}">
                            <option value="">Select ${attrName}</option>
                `;
                
                // Add options
                attrOptions.forEach(function(option) {
                    fieldHtml += `<option value="${option}">${option}</option>`;
                });
                
                fieldHtml += `
                        </select>
                    </div>
                `;
                
                optionsContainer.append(fieldHtml);
            });
        }
        
        // Handle variant option changes
        $(document).on('change', '.variant-options-container select', function() {
            // Notify Livewire that variant options have changed
            let wireModelAttr = $(this).attr('wire:model');
            if (wireModelAttr) {
                let value = $(this).val();
                $(this).val(value).trigger('change');
            }
        });

        // Toggle expiry details based on checkbox
        document.getElementById('productCanExpire').addEventListener('change', function() {
            document.getElementById('expiryDetails').style.display = this.checked ? 'block' : 'none';
        });
        
        // Initialize file manager
        var route_prefix = "{{ route('store.filemanager',$store) }}";
        $('#lfm').filemanager('image', {prefix: route_prefix});

        // Add variant-item class to the first variant for tracking
        $('#variant_1').addClass('variant-item');
        
        // Update variant fields initially (in case there are pre-selected attributes)
        setTimeout(collectSelectedAttributes, 500);
    });
</script>
@endpush
