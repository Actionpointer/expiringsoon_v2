@extends('layouts.frontend.store.app')
@push('styles')
<link href="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('frontend/libs/@yaireo/tagify/dist/tagify.css') }}" />
<style>
    .form-group {
        margin-bottom: 1rem;
    }
</style>
@endpush
@section('content')
<div class="container">
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
							<!-- Left column with logo and basic info -->
							<div class="col-lg-4 col-md-5 mb-4 mb-md-0">
								<div class="p-3 border rounded bg-light mb-4">
									<h5 class="h6 mb-3">Store Logo</h5>
									<div class="text-center mb-3">
										<img class="image avatar avatar-xl rounded-3 mb-3" src="{{ asset('frontend/images/docs/placeholder-img.jpg') }}" alt="Store Logo" id="store-logo-preview" />
										
										<div class="file-upload btn btn-primary w-100">
											<input type="file" class="file-input opacity-0" id="store-logo" name="logo" accept="image/*" />
											<i class="bi bi-upload me-2"></i>Upload Logo
										</div>
										<div class="mt-2">
											<small class="text-muted">JPG, GIF or PNG. 1MB Max</small>
										</div>
									</div>
								</div>
								
								<div class="p-3 border rounded">
									<h5 class="h6 mb-3">Location Details</h5>
									<div class="form-group">
										<label for="storeAddress" class="form-label">
											Address <span class="text-danger">*</span>
										</label>
										<input type="text" class="form-control @error('address') is-invalid @enderror" id="storeAddress" name="address" placeholder="Enter store address" value="{{ old('address') }}" required />
										<small class="text-muted">Start typing to get suggestions</small>
										@error('address')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
									
									<!-- Hidden fields -->
									<input type="hidden" id="storeContinent" name="continent" value="{{ old('continent') }}" />
									<input type="hidden" id="storeCountryCode" name="country_code" value="{{ old('country_code') }}" />
									
									<div class="row g-2 mt-3">
										<div class="col-12">
											<div class="form-group">
												<label for="storeCountry" class="form-label small">Country</label>
												<input type="text" class="form-control form-control-sm bg-light" id="storeCountry" name="country" readonly />
											</div>
										</div>
										
										<div class="col-6">
											<div class="form-group">
												<label for="storeState" class="form-label small">State/Province</label>
												<input type="text" class="form-control form-control-sm bg-light" id="storeState" name="state" readonly />
											</div>
										</div>
										
										<div class="col-6">
											<div class="form-group">
												<label for="storeCity" class="form-label small">City</label>
												<input type="text" class="form-control form-control-sm bg-light" id="storeCity" name="city" readonly />
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Right column with store details -->
							<div class="col-lg-8 col-md-7">
								<h5 class="h6 mb-3 pb-2 border-bottom">Store Information</h5>
								
								<div class="row g-3">
									<div class="col-md-6">
										<div class="form-group">
											<label for="storeName" class="form-label">
												Store Name <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control @error('name') is-invalid @enderror" id="storeName" name="name" placeholder="Enter store name" value="{{ old('name') }}" required />
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
											<input type="email" class="form-control @error('email') is-invalid @enderror" id="storeEmail" name="email" placeholder="Store contact email" value="{{ old('email') }}" required />
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
											<input type="text" class="form-control @error('phone') is-invalid @enderror" id="storePhone" name="phone" placeholder="Store contact number" value="{{ old('phone') }}" required />
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
											<select class="form-select @error('type') is-invalid @enderror" id="storeType" name="type" required>
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
											<textarea class="form-control @error('description') is-invalid @enderror" id="storeDescription" name="description" rows="4" placeholder="Tell customers about your store">{{ old('description') }}</textarea>
											@error('description')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<div class="form-text">Describe your store, products, and what makes you unique (250-500 characters recommended)</div>
										</div>
									</div>
									
									<div class="col-12 mt-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="terms" name="terms" required>
											<label class="form-check-label" for="terms">
												I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
											</label>
											<div class="invalid-feedback">
												You must agree to the terms before creating a store
											</div>
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
@endsection
@push('scripts')	
<script src="{{ asset('frontend/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('frontend/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('frontend/libs/@yaireo/tagify/dist/tagify.min.js') }}"></script>

<!-- Google Maps JavaScript API with Places Library -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>

<script>
    // Preview image before upload
    document.getElementById('store-logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('store-logo-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Initialize Google Places Autocomplete
    function initAutocomplete() {
        const input = document.getElementById('storeAddress');
        const autocomplete = new google.maps.places.Autocomplete(input);
        
        // Set fields to be returned
        autocomplete.setFields(['address_components', 'formatted_address']);
        
        // Listen for place selection
        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            
            if (!place.address_components) {
                return;
            }
            
            // Reset fields
            document.getElementById('storeCountry').value = '';
            document.getElementById('storeState').value = '';
            document.getElementById('storeCity').value = '';
            document.getElementById('storeCountryCode').value = '';
            document.getElementById('storeContinent').value = '';
            
            // Extract address components
            for (const component of place.address_components) {
                const componentType = component.types[0];
                
                switch (componentType) {
                    case 'country':
                        document.getElementById('storeCountry').value = component.long_name;
                        document.getElementById('storeCountryCode').value = component.short_name;
                        // Set continent based on country code (simplified)
                        setContinent(component.short_name);
                        break;
                    case 'administrative_area_level_1':
                        document.getElementById('storeState').value = component.long_name;
                        break;
                    case 'locality':
                        document.getElementById('storeCity').value = component.long_name;
                        break;
                }
            }
        });
    }
    
    // Helper function to determine continent from country code
    function setContinent(countryCode) {
        // Simplified mapping of countries to continents
        const continentMap = {
            // North America
            'US': 'North America', 'CA': 'North America', 'MX': 'North America',
            // Europe
            'GB': 'Europe', 'DE': 'Europe', 'FR': 'Europe', 'IT': 'Europe', 'ES': 'Europe',
            // Asia
            'CN': 'Asia', 'JP': 'Asia', 'IN': 'Asia', 'KR': 'Asia',
            // Africa
            'NG': 'Africa', 'ZA': 'Africa', 'EG': 'Africa', 'GH': 'Africa',
            // South America
            'BR': 'South America', 'AR': 'South America', 'CO': 'South America',
            // Australia/Oceania
            'AU': 'Oceania', 'NZ': 'Oceania'
        };
        
        document.getElementById('storeContinent').value = continentMap[countryCode] || 'Unknown';
    }
</script>
@endpush
