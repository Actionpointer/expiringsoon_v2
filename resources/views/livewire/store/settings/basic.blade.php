<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Store Settings</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Store Settings</li>
                        </ol>
                    </nav>
                </div>
                <!-- Save changes button -->
                <div>
                    <button type="submit" form="storeSettingsForm" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            @include('livewire.store.settings.sidebar',['store'=> $store])

            <!-- Verification Status -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0 fs-5">Verification Status</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-success text-success rounded-circle me-3">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h6 class="mb-0 fs-6">Store Information</h6>
                        </div>
                        <p class="text-muted fs-6 mb-0 ms-5">Completed</p>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-success text-success rounded-circle me-3">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h6 class="mb-0 fs-6">Bank Account</h6>
                        </div>
                        <p class="text-muted fs-6 mb-0 ms-5">Verified</p>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-warning text-warning rounded-circle me-3">
                                <i class="bi bi-exclamation-circle"></i>
                            </div>
                            <h6 class="mb-0 fs-6">KYC Verification</h6>
                        </div>
                        <p class="text-muted fs-6 mb-0 ms-5">Pending Review</p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-danger text-danger rounded-circle me-3">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <h6 class="mb-0 fs-6">Tax Information</h6>
                        </div>
                        <p class="text-muted fs-6 mb-0 ms-5">Not Submitted</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Store Information</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveStoreSettings" enctype="multipart/form-data">
                        
                        <!-- Store Logo & Banner -->
                        <div class="row mb-5">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label class="form-label">Store Logo</label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="position-relative">
                                        @if($store->photo)
                                            <img src="{{ asset('storage/'. $store->photo) }}" alt="Store Logo" class="img-thumbnail rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('frontend/images/avatar/avatar-1.jpg') }}" alt="Store Logo" class="img-thumbnail rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                        @endif
                                        @if($store->photo)
                                            <button type="button" wire:click="removeLogo" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1" style="margin-top: -10px; margin-right: -10px;">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" wire:model="logo" accept="image/*">
                                    <small class="text-muted">Recommended size: 500x500px, max 2MB. Formats: JPG, PNG</small>
                                    @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Store Banner</label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="position-relative w-100">
                                        @if($store->banner)
                                            <img src="{{ asset('storage/'.$store->banner) }}" alt="Store Banner" class="img-thumbnail rounded-3" style="width: 100%; height: 120px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('frontend/images/banner/hero-img.jpg') }}" alt="Store Banner" class="img-thumbnail rounded-3" style="width: 100%; height: 120px; object-fit: cover;">
                                        @endif
                                        @if($store->banner)
                                            <button type="button" wire:click="removeBanner" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1" style="margin-top: -10px; margin-right: -10px;">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" wire:model="banner" accept="image/*">
                                    <small class="text-muted">Recommended size: 1200x300px, max 3MB. Formats: JPG, PNG</small>
                                    @error('banner') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Basic Information -->
                        <div class="mb-5">
                            <h5>Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="storeName" class="form-label">Store Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="storeName" wire:model="name" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="legalBusinessName" class="form-label">Legal Business Name</label>
                                    <input type="text" class="form-control" id="legalBusinessName" wire:model="legal_business_name">
                                    @error('legal_business_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="storeEmail" class="form-label">Store Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="storeEmail" wire:model="email" required>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="storePhone" class="form-label">Store Phone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="storePhone" wire:model="phone" required>
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="storeDescription" class="form-label">Store Description</label>
                                    <textarea class="form-control" id="storeDescription" wire:model="description" rows="4"></textarea>
                                    <small class="text-muted">Brief description of your store (max 500 characters)</small>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Contact Information -->
                        <div class="mb-5">
                            <h5>Contact Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="contactPerson" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contactPerson" wire:model="contact_person">
                                    @error('contact_person') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="altContactPhone" class="form-label">Alternative Phone</label>
                                    <input type="tel" class="form-control" id="altContactPhone" wire:model="alt_contact_phone">
                                    @error('alt_contact_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Address Information -->
                        <div class="mb-5">
                            <h5>Address Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                    <select class="form-select" id="country" wire:model="country_id" disabled>
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="state" class="form-label">State/Province <span class="text-danger">*</span></label>
                                    <select class="form-select" id="state" wire:model="state_id" required>
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <select class="form-select" id="city" wire:model="city_id" required>
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="zipCode" class="form-label">ZIP/Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="zipCode" wire:model="zip_code" required>
                                    @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" wire:model="address" required>
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Social Media Links -->
                        <div class="mb-5">
                            <h5>Social Media</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="website" class="form-label">Website</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                        <input type="url" class="form-control" id="website" wire:model="website">
                                    </div>
                                    @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                        <input type="url" class="form-control" id="facebook" wire:model="facebook">
                                    </div>
                                    @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                        <input type="url" class="form-control" id="instagram" wire:model="instagram">
                                    </div>
                                    @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                        <input type="url" class="form-control" id="twitter" wire:model="twitter">
                                    </div>
                                    @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Business Information -->
                        <div class="mb-5">
                            <h5>Business Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="businessType" class="form-label">Business Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="businessType" wire:model="business_type" required>
                                        <option value="">Select Business Type</option>
                                        <option value="individual" @if($business_type == 'individual') selected @endif>Sole Proprietorship</option>
                                        <option value="business" @if($business_type == 'business') selected @endif>Limited Liability Company (LLC)</option>
                                    </select>
                                    @error('business_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="taxId" class="form-label">Tax ID/EIN</label>
                                    <input type="text" class="form-control" id="taxId" wire:model="tax_id">
                                    @error('tax_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="businessRegistrationNumber" class="form-label">Business Registration Number</label>
                                    <input type="text" class="form-control" id="businessRegistrationNumber" wire:model="business_registration_number">
                                    @error('business_registration_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="yearEstablished" class="form-label">Year Established</label>
                                    <select class="form-select" id="yearEstablished" wire:model="year_established">
                                        <option value="">Select Year</option>
                                        @for($year = date('Y'); $year >= 1900; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('year_established') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>Save Changes</span>
                                <span wire:loading>Saving...</span>
                            </button>
                            <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                            <button type="button" wire:click="outputFormValues" class="btn btn-info ms-2">Debug: Show Form Values</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>