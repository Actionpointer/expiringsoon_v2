@extends('layouts.frontend.store.app')

@section('content')
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
            @include('store.settings.sidebar')

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
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Store Information</h4>
                </div>
                <div class="card-body">
                    <form id="storeSettingsForm" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Store Logo & Banner -->
                        <div class="row mb-5">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label class="form-label">Store Logo</label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="position-relative">
                                        <img src="{{ asset('frontend/images/avatar/avatar-1.jpg') }}" alt="Store Logo" class="img-thumbnail rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1" style="margin-top: -10px; margin-right: -10px;">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="storeLogo" name="logo">
                                    <small class="text-muted">Recommended size: 500x500px, max 2MB. Formats: JPG, PNG</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Store Banner</label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="position-relative w-100">
                                        <img src="{{ asset('frontend/images/banner/banner-1.jpg') }}" alt="Store Banner" class="img-thumbnail rounded-3" style="width: 100%; height: 120px; object-fit: cover;">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-1" style="margin-top: -10px; margin-right: -10px;">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="storeBanner" name="banner">
                                    <small class="text-muted">Recommended size: 1200x300px, max 3MB. Formats: JPG, PNG</small>
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
                                    <input type="text" class="form-control" id="storeName" name="store_name" value="FreshMart Grocery" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="legalBusinessName" class="form-label">Legal Business Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="legalBusinessName" name="legal_business_name" value="FreshMart Ltd." required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="storeEmail" class="form-label">Store Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="storeEmail" name="store_email" value="contact@freshmart.com" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="storePhone" class="form-label">Store Phone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="storePhone" name="store_phone" value="+1 (234) 567-8901" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="storeDescription" class="form-label">Store Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="storeDescription" name="store_description" rows="4" required>FreshMart is your neighborhood grocery store offering fresh, organic produce, everyday essentials, and specialty items at competitive prices. We focus on quality, freshness, and exceptional customer service.</textarea>
                                    <small class="text-muted">Brief description of your store (max 500 characters)</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Contact Information -->
                        <div class="mb-5">
                            <h5>Contact Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="contactPerson" class="form-label">Contact Person <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="contactPerson" name="contact_person" value="John Smith" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="contactEmail" class="form-label">Contact Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="contactEmail" name="contact_email" value="john@freshmart.com" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="contactPhone" class="form-label">Contact Phone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="contactPhone" name="contact_phone" value="+1 (234) 567-8901" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="altContactPhone" class="form-label">Alternative Phone</label>
                                    <input type="tel" class="form-control" id="altContactPhone" name="alt_contact_phone" value="+1 (234) 567-8902">
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
                                    <select class="form-select" id="country" name="country" required>
                                        <option value="US" selected>United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="AU">Australia</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="state" class="form-label">State/Province <span class="text-danger">*</span></label>
                                    <select class="form-select" id="state" name="state" required>
                                        <option value="CA" selected>California</option>
                                        <option value="NY">New York</option>
                                        <option value="TX">Texas</option>
                                        <option value="FL">Florida</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" value="San Francisco" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="zipCode" class="form-label">ZIP/Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="zipCode" name="zip_code" value="94105" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="addressLine1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="addressLine1" name="address_line1" value="123 Market Street" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="addressLine2" class="form-label">Address Line 2</label>
                                    <input type="text" class="form-control" id="addressLine2" name="address_line2" value="Suite 456">
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
                                        <input type="url" class="form-control" id="website" name="website" value="https://www.freshmart.com">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                        <input type="url" class="form-control" id="facebook" name="facebook" value="https://www.facebook.com/freshmart">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                        <input type="url" class="form-control" id="instagram" name="instagram" value="https://www.instagram.com/freshmart">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                        <input type="url" class="form-control" id="twitter" name="twitter" value="https://www.twitter.com/freshmart">
                                    </div>
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
                                    <select class="form-select" id="businessType" name="business_type" required>
                                        <option value="sole_proprietorship">Sole Proprietorship</option>
                                        <option value="llc" selected>Limited Liability Company (LLC)</option>
                                        <option value="corporation">Corporation</option>
                                        <option value="partnership">Partnership</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="taxId" class="form-label">Tax ID/EIN <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="taxId" name="tax_id" value="12-3456789" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="businessRegistrationNumber" class="form-label">Business Registration Number</label>
                                    <input type="text" class="form-control" id="businessRegistrationNumber" name="business_registration_number" value="BRN987654321">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="yearEstablished" class="form-label">Year Established</label>
                                    <select class="form-select" id="yearEstablished" name="year_established">
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020" selected>2020</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Store Categories -->
                        <div class="mb-5">
                            <h5>Store Categories</h5>
                            <p class="text-muted">Select up to 5 categories that best describe your products</p>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="groceries" id="category1" name="categories[]" checked>
                                        <label class="form-check-label" for="category1">
                                            Groceries & Food
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="fresh_produce" id="category2" name="categories[]" checked>
                                        <label class="form-check-label" for="category2">
                                            Fresh Produce
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="bakery" id="category3" name="categories[]" checked>
                                        <label class="form-check-label" for="category3">
                                            Bakery
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="dairy" id="category4" name="categories[]">
                                        <label class="form-check-label" for="category4">
                                            Dairy Products
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="meat" id="category5" name="categories[]">
                                        <label class="form-check-label" for="category5">
                                            Meat & Seafood
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="organic" id="category6" name="categories[]" checked>
                                        <label class="form-check-label" for="category6">
                                            Organic & Natural
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="beverages" id="category7" name="categories[]">
                                        <label class="form-check-label" for="category7">
                                            Beverages
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="health" id="category8" name="categories[]">
                                        <label class="form-check-label" for="category8">
                                            Health & Wellness
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="household" id="category9" name="categories[]" checked>
                                        <label class="form-check-label" for="category9">
                                            Household Essentials
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview image before upload for logo and banner
    function previewImage(input, previewElement) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                previewElement.src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    document.getElementById('storeLogo').addEventListener('change', function() {
        const logoPreview = this.closest('.col-md-6').querySelector('img');
        previewImage(this, logoPreview);
    });
    
    document.getElementById('storeBanner').addEventListener('change', function() {
        const bannerPreview = this.closest('.col-md-6').querySelector('img');
        previewImage(this, bannerPreview);
    });
</script>
@endpush
