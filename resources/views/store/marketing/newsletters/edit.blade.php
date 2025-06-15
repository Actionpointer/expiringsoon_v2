@extends('layouts.frontend.store.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/libs/quill/dist/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/css/select2.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/css/custom.css')}}" />
<link rel="stylesheet" href="{{ asset('frontend/libs/flatpickr/dist/flatpickr.min.css') }}">
@endpush

@section('content')
<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Create Newsletter</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.marketing.newsletters', 1) }}" class="text-inherit">Newsletters</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.newsletters', 1) }}" class="btn btn-light">Back to Newsletters</a>
                </div>
            </div>
        </div>
    </div>
    
    <form action="#" method="post">
        @csrf
        <input type="hidden" name="template_type" value="{{ $template ?? 'default' }}">
        
        <div class="row">
            <!-- Main form content -->
            <div class="col-lg-8 col-md-12">
                <!-- General Information Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">General Information</h4>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Newsletter Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter newsletter title" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Brief description of this newsletter"></textarea>
                        </div>
                        
                        <!-- Audience Selection -->
                        <div class="mb-3">
                            <label class="form-label">Select Audience</label>
                            <select class="form-select select2" name="audience[]" multiple required>
                                <optgroup label="Shop Viewers">
                                    <option value="viewed_shop">People who have viewed my shop</option>
                                    <option value="not_viewed_shop">People who have not viewed my shop</option>
                                </optgroup>
                                <optgroup label="Shop Followers">
                                    <option value="followers">People who follow my shop</option>
                                    <option value="non_followers">People who do not follow my shop</option>
                                </optgroup>
                                <optgroup label="Customers">
                                    <option value="customers">People who have bought something from my shop</option>
                                    <option value="customers_all_time">Bought all time</option>
                                    <option value="customers_1month">Bought within a month</option>
                                    <option value="customers_2months">Bought within 2 months</option>
                                    <option value="non_customers">People who have not bought anything from my shop</option>
                                </optgroup>
                            </select>
                        </div>
                        
                        <!-- Schedule Sending -->
                        <div class="mb-3">
                            <label class="form-label">Schedule Sending</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="schedule_type" id="sendImmediately" value="immediate" checked>
                                <label class="form-check-label" for="sendImmediately">
                                    Send immediately after publishing
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schedule_type" id="scheduleForLater" value="scheduled">
                                <label class="form-check-label" for="scheduleForLater">
                                    Schedule for later
                                </label>
                            </div>
                            <div id="scheduleDateTime" class="mt-3 d-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control datepicker" name="schedule_date" placeholder="Select date">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control timepicker" name="schedule_time" placeholder="Select time">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Template Specific Fields Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Template Content</h4>
                    </div>
                    <div class="card-body">
                        <!-- Include template-specific fields based on the selected template -->
                        @if($template == 'new-product' || $template == 'product-showcase' || $template == 'featured-products')
                            <!-- Product Selection for product-focused templates -->
                            <div class="mb-3">
                                <label class="form-label">Select Products</label>
                                <select class="select2 form-control" name="products[]" multiple required>
                                    <option value="1">Product 1</option>
                                    <option value="2">Product 2</option>
                                    <option value="3">Product 3</option>
                                    <option value="4">Product 4</option>
                                    <option value="5">Product 5</option>
                                </select>
                            </div>
                            
                            <!-- Featured Product Image -->
                            <div class="mb-3">
                                <label class="form-label">Featured Product Image</label>
                                <div class="dropzone" id="productImageDropzone"></div>
                                <small class="form-text text-muted">Upload a high-quality image of your featured product</small>
                            </div>
                            
                            <!-- Product Headline -->
                            <div class="mb-3">
                                <label class="form-label">Product Headline</label>
                                <input type="text" class="form-control" name="product_headline" placeholder="Enter an attention-grabbing headline">
                            </div>
                            
                            <!-- Product Description -->
                            <div class="mb-3">
                                <label class="form-label">Product Description</label>
                                <div id="productDescriptionEditor" style="height: 200px;"></div>
                                <input type="hidden" name="product_description">
                            </div>
                            
                            <!-- Call to Action Text -->
                            <div class="mb-3">
                                <label class="form-label">Call to Action Text</label>
                                <input type="text" class="form-control" name="cta_text" value="Shop Now">
                            </div>
                        @elseif($template == 'flash-sale' || $template == 'clearance-sale' || $template == 'special-offer')
                            <!-- Sale-specific fields -->
                            <div class="mb-3">
                                <label class="form-label">Sale Title</label>
                                <input type="text" class="form-control" name="sale_title" placeholder="E.g., Flash Sale, Special Discount, etc.">
                            </div>
                            
                            <!-- Discount Information -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Discount Type</label>
                                    <select class="form-select" name="discount_type">
                                        <option value="percentage">Percentage (%)</option>
                                        <option value="fixed">Fixed Amount</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Discount Value</label>
                                    <input type="number" class="form-control" name="discount_value" placeholder="Enter value">
                                </div>
                            </div>
                            
                            <!-- Sale Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="sale_start_date" placeholder="Select start date">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End Date</label>
                                    <input type="text" class="form-control datepicker" name="sale_end_date" placeholder="Select end date">
                                </div>
                            </div>
                            
                            <!-- Select Products on Sale -->
                            <div class="mb-3">
                                <label class="form-label">Products on Sale</label>
                                <select class="select2 form-control" name="sale_products[]" multiple>
                                    <option value="1">Product 1</option>
                                    <option value="2">Product 2</option>
                                    <option value="3">Product 3</option>
                                    <option value="4">Product 4</option>
                                    <option value="5">Product 5</option>
                                </select>
                            </div>
                            
                            <!-- Sale Banner Image -->
                            <div class="mb-3">
                                <label class="form-label">Sale Banner Image</label>
                                <div class="dropzone" id="saleBannerDropzone"></div>
                                <small class="form-text text-muted">Upload a compelling banner image for your sale</small>
                            </div>
                            
                            <!-- Sale Description -->
                            <div class="mb-3">
                                <label class="form-label">Sale Description</label>
                                <div id="saleDescriptionEditor" style="height: 200px;"></div>
                                <input type="hidden" name="sale_description">
                            </div>
                        @elseif($template == 'announcement' || $template == 'store-news')
                            <!-- Announcement-specific fields -->
                            <div class="mb-3">
                                <label class="form-label">Announcement Title</label>
                                <input type="text" class="form-control" name="announcement_title" placeholder="Enter the main announcement title">
                            </div>
                            
                            <!-- Announcement Image -->
                            <div class="mb-3">
                                <label class="form-label">Announcement Image</label>
                                <div class="dropzone" id="announcementImageDropzone"></div>
                                <small class="form-text text-muted">Upload an image related to your announcement (optional)</small>
                            </div>
                            
                            <!-- Announcement Content -->
                            <div class="mb-3">
                                <label class="form-label">Announcement Content</label>
                                <div id="announcementContentEditor" style="height: 300px;"></div>
                                <input type="hidden" name="announcement_content">
                            </div>
                            
                            <!-- Call to Action (if applicable) -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="enableAnnouncementCTA" name="has_announcement_cta">
                                    <label class="form-check-label" for="enableAnnouncementCTA">
                                        Add a call-to-action button
                                    </label>
                                </div>
                                
                                <div id="announcementCTAOptions" class="mt-3 d-none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Button Text</label>
                                            <input type="text" class="form-control" name="announcement_cta_text" placeholder="E.g., Learn More, Read More">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Button URL</label>
                                            <input type="url" class="form-control" name="announcement_cta_url" placeholder="https://">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($template == 'welcome' || $template == 'thank-you')
                            <!-- Welcome/Thank You specific fields -->
                            <div class="mb-3">
                                <label class="form-label">Greeting</label>
                                <input type="text" class="form-control" name="greeting" placeholder="E.g., Welcome to our store!, Thank you for your support!">
                            </div>
                            
                            <!-- Welcome Image -->
                            <div class="mb-3">
                                <label class="form-label">Header Image</label>
                                <div class="dropzone" id="welcomeImageDropzone"></div>
                                <small class="form-text text-muted">Upload a welcoming image</small>
                            </div>
                            
                            <!-- Welcome Message -->
                            <div class="mb-3">
                                <label class="form-label">Message Content</label>
                                <div id="welcomeMessageEditor" style="height: 200px;"></div>
                                <input type="hidden" name="welcome_message">
                            </div>
                            
                            <!-- Featured Products/Categories -->
                            <div class="mb-3">
                                <label class="form-label">Featured Items to Showcase</label>
                                <select class="select2 form-control" name="welcome_featured_items[]" multiple>
                                    <option value="1">Product 1</option>
                                    <option value="2">Product 2</option>
                                    <option value="3">Product 3</option>
                                    <option value="4">Product 4</option>
                                    <option value="5">Product 5</option>
                                </select>
                                <small class="form-text text-muted">Select a few featured items to showcase in your welcome message</small>
                            </div>
                            
                            <!-- Special Offer for New Subscribers -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeSpecialOffer" name="has_special_offer">
                                    <label class="form-check-label" for="includeSpecialOffer">
                                        Include a special offer for subscribers
                                    </label>
                                </div>
                                
                                <div id="specialOfferOptions" class="mt-3 d-none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Offer Type</label>
                                            <select class="form-select" name="offer_type">
                                                <option value="discount">Discount</option>
                                                <option value="free_shipping">Free Shipping</option>
                                                <option value="gift">Free Gift</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Offer Value</label>
                                            <input type="text" class="form-control" name="offer_value" placeholder="E.g., 10%, WELCOME10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($template == 'holiday-special' || $template == 'summer-collection' || $template == 'seasonal')
                            <!-- Seasonal template fields -->
                            <div class="mb-3">
                                <label class="form-label">Seasonal Theme</label>
                                <input type="text" class="form-control" name="seasonal_theme" placeholder="E.g., Christmas, Summer, Back to School">
                            </div>
                            
                            <!-- Season Banner -->
                            <div class="mb-3">
                                <label class="form-label">Seasonal Banner</label>
                                <div class="dropzone" id="seasonalBannerDropzone"></div>
                                <small class="form-text text-muted">Upload a seasonal themed banner</small>
                            </div>
                            
                            <!-- Season Message -->
                            <div class="mb-3">
                                <label class="form-label">Seasonal Message</label>
                                <div id="seasonalMessageEditor" style="height: 200px;"></div>
                                <input type="hidden" name="seasonal_message">
                            </div>
                            
                            <!-- Featured Seasonal Products -->
                            <div class="mb-3">
                                <label class="form-label">Featured Seasonal Products</label>
                                <select class="select2 form-control" name="seasonal_products[]" multiple>
                                    <option value="1">Product 1</option>
                                    <option value="2">Product 2</option>
                                    <option value="3">Product 3</option>
                                    <option value="4">Product 4</option>
                                    <option value="5">Product 5</option>
                                </select>
                            </div>
                            
                            <!-- Season Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="seasonal_start_date" placeholder="Select start date">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End Date</label>
                                    <input type="text" class="form-control datepicker" name="seasonal_end_date" placeholder="Select end date">
                                </div>
                            </div>
                            
                            <!-- Seasonal Offer -->
                            <div class="mb-3">
                                <label class="form-label">Seasonal Offer (if applicable)</label>
                                <input type="text" class="form-control" name="seasonal_offer" placeholder="E.g., 20% off all summer items">
                            </div>
                        @else
                            <!-- Default/Generic Template Fields -->
                            <div class="mb-3">
                                <label class="form-label">Newsletter Headline</label>
                                <input type="text" class="form-control" name="headline" placeholder="Enter main headline">
                            </div>
                            
                            <!-- Main Image -->
                            <div class="mb-3">
                                <label class="form-label">Main Image</label>
                                <div class="dropzone" id="mainImageDropzone"></div>
                                <small class="form-text text-muted">Upload a main image for your newsletter</small>
                            </div>
                            
                            <!-- Newsletter Content -->
                            <div class="mb-3">
                                <label class="form-label">Newsletter Content</label>
                                <div id="contentEditor" style="height: 300px;"></div>
                                <input type="hidden" name="content">
                            </div>
                            
                            <!-- Call to Action -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Call to Action Text</label>
                                    <input type="text" class="form-control" name="cta_text" placeholder="E.g., Shop Now, Learn More">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Call to Action URL</label>
                                    <input type="url" class="form-control" name="cta_url" placeholder="https://">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Advanced Settings Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Advanced Settings</h4>
                    </div>
                    <div class="card-body">
                        <!-- Email Subject -->
                        <div class="mb-3">
                            <label class="form-label">Email Subject Line</label>
                            <input type="text" class="form-control" name="email_subject" placeholder="Enter the subject line for your email">
                            <small class="form-text text-muted">This is what recipients will see in their inbox</small>
                        </div>
                        
                        <!-- Sender Name -->
                        <div class="mb-3">
                            <label class="form-label">Sender Name</label>
                            <input type="text" class="form-control" name="sender_name" placeholder="Enter sender name">
                        </div>
                        
                        <!-- Preview Text -->
                        <div class="mb-3">
                            <label class="form-label">Preview Text</label>
                            <input type="text" class="form-control" name="preview_text" placeholder="Enter preview text">
                            <small class="form-text text-muted">This text appears after the subject line in some email clients</small>
                        </div>
                        
                        <!-- Track Opens/Clicks -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="trackOpens" name="track_opens" checked>
                                <label class="form-check-label" for="trackOpens">
                                    Track email opens
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="trackClicks" name="track_clicks" checked>
                                <label class="form-check-label" for="trackClicks">
                                    Track link clicks
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-12">
                <!-- Preview Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Template Preview</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://placehold.co/300x400?text=Template+Preview" alt="Template Preview" class="img-fluid border">
                        <div class="mt-3">
                            <p class="text-muted">This is a preview of how your newsletter will look.</p>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="refreshPreview">Refresh Preview</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="viewFullPreview">View Full Preview</button>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="action" value="publish">Publish Newsletter</button>
                            <button type="submit" class="btn btn-outline-primary" name="action" value="draft">Save as Draft</button>
                            <button type="submit" class="btn btn-outline-secondary" name="action" value="test">Send Test Email</button>
                        </div>
                    </div>
                </div>
                
                <!-- Newsletter Summary Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Newsletter Summary</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Template</span>
                                <span class="text-muted">{{ ucfirst(str_replace('-', ' ', $template ?? 'Default')) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <span class="badge bg-secondary">Draft</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Estimated Recipients</span>
                                <span class="text-muted">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Credits Required</span>
                                <span class="text-muted">0</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/libs/flatpickr/dist/flatpickr.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select options'
        });
        
        // Initialize datepickers
        $('.datepicker').flatpickr({
            dateFormat: "Y-m-d",
            allowInput: true
        });
        
        // Initialize timepicker
        $('.timepicker').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        
        // Toggle schedule date/time inputs
        $('input[name="schedule_type"]').on('change', function() {
            if ($(this).val() === 'scheduled') {
                $('#scheduleDateTime').removeClass('d-none');
            } else {
                $('#scheduleDateTime').addClass('d-none');
            }
        });
        
        // Toggle announcement CTA options
        $('#enableAnnouncementCTA').on('change', function() {
            if ($(this).is(':checked')) {
                $('#announcementCTAOptions').removeClass('d-none');
            } else {
                $('#announcementCTAOptions').addClass('d-none');
            }
        });
        
        // Toggle special offer options
        $('#includeSpecialOffer').on('change', function() {
            if ($(this).is(':checked')) {
                $('#specialOfferOptions').removeClass('d-none');
            } else {
                $('#specialOfferOptions').addClass('d-none');
            }
        });
        
        // Initialize Dropzone for image uploads
        Dropzone.autoDiscover = false;
        
        // Configure dropzones based on template type
        const template = '{{ $template ?? "default" }}';
        
        if (template === 'new-product' || template === 'product-showcase' || template === 'featured-products') {
            // Product template dropzone
            new Dropzone("#productImageDropzone", {
                url: "/file/upload/temporary",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='bi bi-cloud-arrow-up-fill fs-2'></i><br>Drop product image here or click to upload"
            });
            
            // Initialize product description editor
            const productEditor = new Quill('#productDescriptionEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input on editor change
            productEditor.on('text-change', function() {
                $('input[name="product_description"]').val(productEditor.root.innerHTML);
            });
        } else if (template === 'flash-sale' || template === 'clearance-sale' || template === 'special-offer') {
            // Sale template dropzone
            new Dropzone("#saleBannerDropzone", {
                url: "/file/upload/temporary",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='bi bi-cloud-arrow-up-fill fs-2'></i><br>Drop sale banner here or click to upload"
            });
            
            // Initialize sale description editor
            const saleEditor = new Quill('#saleDescriptionEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input on editor change
            saleEditor.on('text-change', function() {
                $('input[name="sale_description"]').val(saleEditor.root.innerHTML);
            });
        } else if (template === 'announcement' || template === 'store-news') {
            // Announcement template dropzone
            new Dropzone("#announcementImageDropzone", {
                url: "/file/upload/temporary",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='bi bi-cloud-arrow-up-fill fs-2'></i><br>Drop announcement image here or click to upload"
            });
            
            // Initialize announcement content editor
            const announcementEditor = new Quill('#announcementContentEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input on editor change
            announcementEditor.on('text-change', function() {
                $('input[name="announcement_content"]').val(announcementEditor.root.innerHTML);
            });
        } else if (template === 'welcome' || template === 'thank-you') {
            // Welcome template dropzone
            new Dropzone("#welcomeImageDropzone", {
                url: "/file/upload/temporary",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='bi bi-cloud-arrow-up-fill fs-2'></i><br>Drop welcome image here or click to upload"
            });
            
            // Initialize welcome message editor
            const welcomeEditor = new Quill('#welcomeMessageEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input on editor change
            welcomeEditor.on('text-change', function() {
                $('input[name="welcome_message"]').val(welcomeEditor.root.innerHTML);
            });
        } else if (template === 'holiday-special' || template === 'summer-collection' || template === 'seasonal') {
            // Seasonal template dropzone
            new Dropzone("#seasonalBannerDropzone", {
                url: "/file/upload/temporary",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='bi bi-cloud-arrow-up-fill fs-2'></i><br>Drop seasonal banner here or click to upload"
            });
            
            // Initialize seasonal message editor
            const seasonalEditor = new Quill('#seasonalMessageEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input on editor change
            seasonalEditor.on('text-change', function() {
                $('input[name="seasonal_message"]').val(seasonalEditor.root.innerHTML);
            });
        } else {
            // Default template dropzone
            new Dropzone("#mainImageDropzone", {
                url: "/file/upload/temporary",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='bi bi-cloud-arrow-up-fill fs-2'></i><br>Drop main image here or click to upload"
            });
            
            // Initialize content editor
            const contentEditor = new Quill('#contentEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input on editor change
            contentEditor.on('text-change', function() {
                $('input[name="content"]').val(contentEditor.root.innerHTML);
            });
        }
        
        // Preview actions
        $('#refreshPreview').on('click', function() {
            alert('Preview refreshed');
            // In a real implementation, this would update the preview image based on the current form values
        });
        
        $('#viewFullPreview').on('click', function() {
            window.open('/store/1/marketing/newsletters/preview', '_blank');
        });
    });
</script>
@endpush 