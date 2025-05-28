@extends('layouts.frontend.store.app')

@push('styles')
<style>
    .preview-container {
        border: 2px dashed #dee2e6;
        min-height: 200px;
        position: relative;
        transition: all 0.3s;
    }
    
    .preview-container:hover {
        border-color: #6c757d;
    }
    
    .preview-placeholder {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    
    .ad-preview-image {
        max-width: 100%;
        max-height: 300px;
        display: none;
    }
    
    .selected-categories .badge {
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 0.9rem;
        padding: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Create New Ad</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.marketing.adverts', 1) }}" class="text-inherit">Adverts</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 1]) }}" class="text-inherit">Featured Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create New Ad</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ad Creation Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ad Details</h5>
                </div>
                <div class="card-body">
                    <form id="createAdForm">
                        <div class="mb-3">
                            <label for="adTitle" class="form-label">Ad Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="adTitle" placeholder="Enter a title for your ad" required>
                            <small class="text-muted">This will be displayed as the main headline of your ad</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="adSubtitle" class="form-label">Ad Subtitle</label>
                            <input type="text" class="form-control" id="adSubtitle" placeholder="Enter a subtitle (optional)">
                            <small class="text-muted">Secondary text that appears below the title</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="adDescription" class="form-label">Ad Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="adDescription" rows="4" placeholder="Describe your ad" required></textarea>
                            <small class="text-muted">Provide details about what you're promoting</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="adImage" class="form-label">Ad Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="adImage" accept="image/*" required>
                            <small class="text-muted">Recommended size: 1200 x 628 pixels (16:9 ratio)</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="adUrl" class="form-label">Destination URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="adUrl" placeholder="https://" required>
                            <small class="text-muted">Where users will be directed when they click on your ad</small>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="mb-3">
                            <label class="form-label">Target Categories <span class="text-danger">*</span></label>
                            <select class="form-select" id="categorySelect" multiple>
                                <option value="all">All Categories</option>
                                <option value="electronics">Electronics</option>
                                <option value="fashion">Fashion</option>
                                <option value="home">Home & Garden</option>
                                <option value="beauty">Beauty & Personal Care</option>
                                <option value="toys">Toys & Games</option>
                                <option value="sports">Sports & Outdoors</option>
                                <option value="automotive">Automotive</option>
                                <option value="books">Books & Media</option>
                            </select>
                            <small class="text-muted">Select the categories where your ad should appear</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Selected Categories:</label>
                            <div id="selectedCategories" class="selected-categories">
                                <div class="text-muted">No categories selected</div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Ad Schedule</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="startDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="endDate" required>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="activateImmediately" checked>
                            <label class="form-check-label" for="activateImmediately">
                                Activate ad immediately after creation
                            </label>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Advanced Options</h5>
                        
                        <div class="mb-3">
                            <label for="adKeywords" class="form-label">Keywords (Optional)</label>
                            <input type="text" class="form-control" id="adKeywords" placeholder="Enter keywords separated by commas">
                            <small class="text-muted">Helps target your ad to relevant users</small>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="enableAnalytics" checked>
                            <label class="form-check-label" for="enableAnalytics">
                                Enable detailed analytics for this ad
                            </label>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="restrictCompetitors">
                            <label class="form-check-label" for="restrictCompetitors">
                                Prevent ad from showing alongside competitor products
                            </label>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Ad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Ad Preview Card -->
            <div class="card mb-4 sticky-top" style="top: 20px; z-index: 999;">
                <div class="card-header">
                    <h5 class="mb-0">Ad Preview</h5>
                </div>
                <div class="card-body">
                    <div class="preview-container mb-3">
                        <img id="previewImage" class="ad-preview-image" alt="Ad Preview">
                        <div class="preview-placeholder">
                            <i class="bi bi-image fs-1 text-muted"></i>
                            <p class="mb-0">Your ad preview will appear here</p>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <h5 id="previewTitle" class="mb-1">Ad Title</h5>
                        <p id="previewSubtitle" class="text-muted small mb-2">Ad Subtitle</p>
                        <p id="previewDescription" class="mb-2">Ad description will appear here...</p>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary me-2">Featured Products</span>
                            <small class="text-muted" id="previewUrl">https://example.com</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body">
                            <h6 class="mb-2">Adset Information</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Type:</span>
                                <span class="fw-medium">Featured Products</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Used Slots:</span>
                                <span class="fw-medium">2 of 10</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Expiry Date:</span>
                                <span class="fw-medium">10/06/2025</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-primary" id="refreshPreview">
                            <i class="bi bi-arrow-clockwise me-2"></i> Refresh Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any interactive elements
        function initializeSelects() {
            // Initialize the category select
            if ($.fn.select2) {
                $('#categorySelect').select2({
                    placeholder: "Select categories",
                    allowClear: true
                });
                
                // Handle category selection
                $('#categorySelect').on('change', function() {
                    updateSelectedCategories();
                });
            } else {
                console.warn('Select2 is not available');
            }
        }
        
        initializeSelects();
        
        // Update preview when inputs change
        $('#adTitle, #adSubtitle, #adDescription, #adUrl').on('input', function() {
            updatePreview();
        });
        
        // Handle image upload
        $('#adImage').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result).show();
                    $('.preview-placeholder').hide();
                };
                reader.readAsDataURL(file);
            } else {
                $('#previewImage').hide();
                $('.preview-placeholder').show();
            }
        });
        
        // Refresh preview button
        $('#refreshPreview').on('click', function() {
            updatePreview();
        });
        
        // Form submission
        $('#createAdForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            if (!validateForm()) {
                return false;
            }
            
            // Simulate form submission
            alert('Ad created successfully! Redirecting to ad management page...');
            
            // In a real application, you would submit the form data to the server here
            // window.location.href = "{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 1]) }}";
        });
        
        // Update selected categories display
        function updateSelectedCategories() {
            const selectedOptions = $('#categorySelect').val();
            let html = '';
            
            if (selectedOptions && selectedOptions.length > 0) {
                selectedOptions.forEach(function(category) {
                    let displayName = $('#categorySelect option[value="' + category + '"]').text();
                    html += '<span class="badge bg-light text-dark">' + displayName + 
                            ' <button type="button" class="btn-close btn-close-sm ms-1" data-category="' + category + '"></button></span>';
                });
            } else {
                html = '<div class="text-muted">No categories selected</div>';
            }
            
            $('#selectedCategories').html(html);
            
            // Add event listeners to remove buttons
            $('.btn-close').on('click', function() {
                const category = $(this).data('category');
                const values = $('#categorySelect').val().filter(value => value !== category);
                $('#categorySelect').val(values).trigger('change');
            });
        }
        
        // Update the preview
        function updatePreview() {
            const title = $('#adTitle').val() || 'Ad Title';
            const subtitle = $('#adSubtitle').val() || 'Ad Subtitle';
            const description = $('#adDescription').val() || 'Ad description will appear here...';
            const url = $('#adUrl').val() || 'https://example.com';
            
            $('#previewTitle').text(title);
            $('#previewSubtitle').text(subtitle);
            $('#previewDescription').text(description);
            $('#previewUrl').text(url);
        }
        
        // Validate form
        function validateForm() {
            let isValid = true;
            
            // Check required fields
            if (!$('#adTitle').val()) {
                isValid = false;
                alert('Please enter an ad title');
            } else if (!$('#adDescription').val()) {
                isValid = false;
                alert('Please enter an ad description');
            } else if (!$('#adImage').val()) {
                isValid = false;
                alert('Please upload an ad image');
            } else if (!$('#adUrl').val()) {
                isValid = false;
                alert('Please enter a destination URL');
            } else if (!$('#categorySelect').val() || $('#categorySelect').val().length === 0) {
                isValid = false;
                alert('Please select at least one category');
            } else if (!$('#startDate').val()) {
                isValid = false;
                alert('Please select a start date');
            } else if (!$('#endDate').val()) {
                isValid = false;
                alert('Please select an end date');
            }
            
            // Check if end date is after start date
            const startDate = new Date($('#startDate').val());
            const endDate = new Date($('#endDate').val());
            
            if (startDate >= endDate) {
                isValid = false;
                alert('End date must be after start date');
            }
            
            return isValid;
        }
        
        // Set default dates
        const today = new Date();
        const thirtyDaysLater = new Date(today);
        thirtyDaysLater.setDate(today.getDate() + 30);
        
        $('#startDate').val(today.toISOString().split('T')[0]);
        $('#endDate').val(thirtyDaysLater.toISOString().split('T')[0]);
        
        // Initial preview update
        updatePreview();
    });
</script>
@endpush 