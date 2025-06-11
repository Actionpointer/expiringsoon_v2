<div class="container">
    <style>
        .spinner {
            display: inline-block;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
        }
        
        .file-input {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            cursor: pointer;
            z-index: 1;
        }
    </style>
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
                    <form class="needs-validation" enctype="multipart/form-data" wire:submit.prevent="createStore">
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
                                            <select name="country_id" class="form-select select2 @error('country_id') is-invalid @enderror" data-placeholder="Select country" 
                                                id="storeCountrySelect" 
                                                wire:model="country_id"
                                                required>
                                                <option value=""></option>
                                                @foreach ($countries as $country_record)
                                                <option value="{{ $country_record->id }}">{{ $country_record->name }}</option>
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
                                            <select class="form-select select2 @error('state_id') is-invalid @enderror" data-placeholder="{{ count($states) ? 'Select a state' : 'Select a country first' }}"
                                                id="storeStateSelect" 
                                                wire:model="state_id"
                                                {{ count($states) ? '' : 'disabled' }} 
                                                required>
                                                <option value=""></option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
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
                                            <select class="form-select select2 @error('city_id') is-invalid @enderror" data-placeholder="{{ count($cities) ? 'Select city' : 'Select a state first' }}" 
                                                id="storeCitySelect" 
                                                wire:model="city_id"
                                                {{ count($cities) ? '' : 'disabled' }} 
                                                required>
                                                <option value=""></option>
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
                                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="storeZipCode" wire:model="zip_code" placeholder="Enter zip code" value="{{ old('zip_code') }}" required />
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
                                        @if($photo)
                                            @if(is_object($photo) && method_exists($photo, 'temporaryUrl'))
                                                <img class="image avatar avatar-xl rounded-3 mb-3" src="{{ $photo->temporaryUrl() }}" alt="Store Logo Preview" id="store-logo-preview" />
                                            @else
                                                <img class="image avatar avatar-xl rounded-3 mb-3" src="{{ asset('frontend/images/docs/placeholder-img.jpg') }}" alt="Store Logo" id="store-logo-preview" />
                                            @endif
                                        @else
                                            <img class="image avatar avatar-xl rounded-3 mb-3" src="{{ asset('frontend/images/docs/placeholder-img.jpg') }}" alt="Store Logo" id="store-logo-preview" />
                                        @endif

                                        <div class="file-upload btn btn-primary w-100 position-relative">
                                            <input type="file" class="file-input opacity-0" id="store-logo" wire:model="photo" accept="image/*" />
                                            @if($photo && is_object($photo) && method_exists($photo, 'getClientOriginalName'))
                                                <i class="bi bi-check-circle me-2"></i>{{ Str::limit($photo->getClientOriginalName(), 15) }}
                                            @else
                                                <i class="bi bi-upload me-2"></i>Upload Logo
                                            @endif
                                        </div>
                                        <div wire:loading wire:target="photo" class="mt-2 text-primary">
                                            <i class="bi bi-arrow-repeat spinner"></i> Uploading...
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">JPG, GIF or PNG. 1MB Max</small>
                                        </div>
                                        @error('photo')
                                            <div class="text-danger small mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-12 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" value="1" wire:model="terms" required>
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
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();
        
        // Handle country selection
        $(document).on('select2:select', '#storeCountrySelect', function(e) {
            const value = $(this).val();
            window.Livewire.dispatch('getStates', { country_id: value});
            
        });

        // Handle state selection
        $(document).on('select2:select', '#storeStateSelect', function(e) {
            const value = $(this).val();
            window.Livewire.dispatch('getCities', { state_id: value});
        });

        $(document).on('select2:select', '#storeCitySelect', function(e) {
            const value = $(this).val();
            console.log(value);
            window.Livewire.dispatch('setCityId', { city_id: value});
        });

        // Listen for Livewire events to reinitialize Select2
        Livewire.on('states-updated', function(data) {
            setTimeout(function() {
                $('#storeStateSelect').select2('destroy').off().select2();
                $('#storeStateSelect').select2('open');
            }, 100);   
        });
        
        Livewire.on('cities-updated', function(data) {
            setTimeout(function() {
                $('#storeCitySelect').select2('destroy').off().select2();
                $('#storeCitySelect').select2('open');
            }, 100);
        });


        
        // Logo preview
        document.getElementById('store-logo')?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('store-logo-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
        
        
    });
</script>
@endpush