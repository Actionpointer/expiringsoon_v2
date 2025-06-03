<div class="container">
    <!-- Debug script to catch errors -->
    <script>
        window.addEventListener('error', function(event) {
            console.log('JavaScript Error:', event.error ? event.error.message : event.message);
            console.log('At:', event.filename, 'line:', event.lineno, 'column:', event.colno);
            if (event.error && event.error.stack) {
                console.log('Stack:', event.error.stack);
            }
        });
    </script>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <div>
                <h2>Create New Store</h2>
                <!-- breacrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Launch your store today and unlock unlimited earning potential with our powerful e-commerce platform</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body p-4 p-lg-5">
                    <form class="needs-validation" method="GET" action="#" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="row">
                            <!-- Right column with store details -->
                            <div class="col-lg-8 col-md-7">
                                <h5 class="h6 mb-3 pb-2 border-bottom">Store Information</h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storeName" class="form-label">
                                                Store Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="storeName" wire:model="name" placeholder="Enter store name" value="{{ old('name') }}" required />
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storeEmail" class="form-label">
                                                Email <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="storeEmail" wire:model="email" placeholder="Store contact email" value="{{ old('email') }}" required />
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storePhone" class="form-label">
                                                Phone Number <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="storePhone" wire:model="phone" placeholder="Store contact number" value="{{ old('phone') }}" required />
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storeType" class="form-label">
                                                Store Type <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select @error('type') is-invalid @enderror" id="storeType" wire:model="business_type" required>
                                                <option value="" selected disabled>Select store type</option>
                                                <option value="business">Registered Business</option>
                                                <option value="individual">Individual Business</option>
                                            </select>
                                            @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="storeDescription" class="form-label">
                                                Description
                                            </label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="storeDescription" wire:model="description" rows="2" placeholder="Tell customers about your store">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Describe your store, products, and what makes you unique (250-500 characters recommended)</div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="storeAddress" class="form-label">
                                                Address <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="storeAddress" wire:model="address" placeholder="Enter store address" role="presentation" autocomplete="off" value="{{ old('address') }}" required />
                                            <small class="text-muted">Start typing to get suggestions</small>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="storeCountrySelect" class="form-label">
                                                Country <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select select2 @error('country_id') is-invalid @enderror" 
                                                id="storeCountrySelect" 
                                                wire:model="country_id"
                                                wire:change="updateCountry($event.target.value)"
                                                required>
                                                <option value="" selected disabled>Select country</option>
                                                @foreach ($countries as $country_record)
                                                    <option value="{{ $country_record->code }}">{{ $country_record->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="storeStateSelect" class="form-label">
                                                State/Province <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select select2 @error('state_id') is-invalid @enderror" 
                                                id="storeStateSelect" 
                                                wire:model="state_id"
                                                wire:change="updateState($event.target.value)"
                                                {{ count($states) ? '' : 'disabled' }} 
                                                required>
                                                <option value="" selected disabled>{{ count($states) ? 'Select state' : 'Select a country first' }}</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->code }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="storeCitySelect" class="form-label">
                                                City <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select select2 @error('city_id') is-invalid @enderror" 
                                                id="storeCitySelect" 
                                                wire:model="city_id"
                                                wire:change="updateCity($event.target.value)"
                                                {{ count($cities) ? '' : 'disabled' }} 
                                                required>
                                                <option value="" selected disabled>{{ count($cities) ? 'Select city' : 'Select a state first' }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="storeZipCode" class="form-label">
                                                Zip/Postal Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="storeZipCode" name="zip_code" placeholder="Enter zip code" value="{{ old('zip_code') }}" required />
                                            @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <!-- Left column with logo and basic info -->
                            <div class="col-lg-4 col-md-5 mb-4 mb-md-0">
                                <div class="p-3 border rounded bg-light mb-4">
                                    <h5 class="h6 mb-3">Store Logo</h5>
                                    <div class="text-center mb-3">
                                        <img class="image avatar avatar-xl rounded-3 mb-3" src="{{ asset('frontend/images/docs/placeholder-img.jpg') }}" alt="Store Logo" id="store-logo-preview" />

                                        <div class="file-upload btn btn-primary w-100">
                                            <input type="file" class="file-input opacity-0" id="store-logo" wire:model="logo" accept="image/*" />
                                            <i class="bi bi-upload me-2"></i>Upload Logo
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">JPG, GIF or PNG. 1MB Max</small>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-12 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" wire:model="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree to the terms before creating a store
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4 pt-2 border-top">
                                    <button class="btn btn-primary me-2" type="submit">
                                        <i class="bi bi-shop me-1"></i>Create Store
                                    </button>
                                    <a href="{{ route('welcome') }}" class="btn btn-secondary">Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<link href="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('frontend/libs/@yaireo/tagify/dist/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<style>
    .select2-container {
        width: 100% !important;
    }
    .select2-container .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('frontend/libs/@yaireo/tagify/dist/tagify.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

<script>
    // Safer function to get elements
    function safeGetElement(id) {
        return document.getElementById(id) || null;
    }
    
    // Initialize Select2 safely
    function initSelect2() {
        try {
            if (typeof $ !== 'undefined' && typeof $.fn.select2 !== 'undefined') {
                $('.select2').select2().on('select2:select', function(e) {
                    this.dispatchEvent(new Event('change'));
                });
            }
        } catch (error) {
            console.error('Error initializing Select2:', error);
        }
    }
    
    // DOM ready function that's compatible with all browsers
    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else if (document.addEventListener) {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            document.attachEvent('onreadystatechange', function() {
                if (document.readyState !== 'loading') {
                    fn();
                }
            });
        }
    }
    
    // Main initialization function
    ready(function() {
        // Initialize Select2
        initSelect2();
        
        // Setup logo preview
        var logoInput = safeGetElement('store-logo');
        var logoPreview = safeGetElement('store-logo-preview');
        
        if (logoInput && logoPreview) {
            logoInput.addEventListener('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        
        // Add Livewire event listeners
        if (typeof window !== 'undefined') {
            try {
                window.addEventListener('states-updated', function() {
                    setTimeout(initSelect2, 100);
                });
                
                window.addEventListener('cities-updated', function() {
                    setTimeout(initSelect2, 100);
                });
            } catch (error) {
                console.error('Error setting up Livewire listeners:', error);
            }
        }
    });
</script>
@endpush