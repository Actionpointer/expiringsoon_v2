@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>KYC Compliance</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', 1) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">KYC Compliance</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button type="submit" form="kycForm" class="btn btn-primary">
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
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            <!-- KYC Status Card -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <span class="badge bg-warning p-2">
                                <i class="bi bi-hourglass-split fs-5"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="mb-1">Verification Status: Pending</h5>
                            <p class="mb-0 text-muted">Your KYC verification is currently under review. This process typically takes 1-3 business days.</p>
                        </div>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <small class="text-muted">Submitted</small>
                        <small class="text-muted">Under Review</small>
                        <small class="text-muted">Verified</small>
                    </div>
                </div>
            </div>

            <!-- KYC Form Card -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Personal Information</h4>
                    <p class="text-muted small mb-0">Provide your personal details for verification</p>
                </div>
                <div class="card-body">
                    <form id="kycForm" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="alert alert-info mb-4">
                            <div class="d-flex">
                                <i class="bi bi-info-circle fs-4 me-2"></i>
                                <div>
                                    <h5 class="alert-heading">Why We Need This Information</h5>
                                    <p class="mb-0">To comply with anti-money laundering regulations and to protect our platform, we need to verify the identity of all vendors. Your information is securely stored and handled in accordance with our privacy policy.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="fullName" class="form-label">Full Legal Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullName" name="full_name" value="John Alexander Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label for="birthdate" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="1985-06-15" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                <select class="form-select" id="nationality" name="nationality" required>
                                    <option value="" disabled>Select your nationality</option>
                                    <option value="US" selected>United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="AU">Australia</option>
                                    <option value="DE">Germany</option>
                                    <option value="FR">France</option>
                                    <option value="IN">India</option>
                                    <option value="JP">Japan</option>
                                    <!-- More countries would be listed here -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="taxResidence" class="form-label">Country of Tax Residence <span class="text-danger">*</span></label>
                                <select class="form-select" id="taxResidence" name="tax_residence" required>
                                    <option value="" disabled>Select your country of tax residence</option>
                                    <option value="US" selected>United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="AU">Australia</option>
                                    <option value="DE">Germany</option>
                                    <option value="FR">France</option>
                                    <option value="IN">India</option>
                                    <option value="JP">Japan</option>
                                    <!-- More countries would be listed here -->
                                </select>
                            </div>
                        </div>

                        <div class="border-bottom mb-4"></div>

                        <!-- Address Information -->
                        <h5 class="mb-4">Residential Address</h5>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="addressLine1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="addressLine1" name="address_line1" value="123 Main Street" required>
                            </div>
                            <div class="col-md-6">
                                <label for="addressLine2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" id="addressLine2" name="address_line2" value="Apt 4B">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" value="New York" required>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <label for="state" class="form-label">State/Province <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="state" name="state" value="NY" required>
                            </div>
                            <div class="col-md-4">
                                <label for="postalCode" class="form-label">Postal/ZIP Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="postalCode" name="postal_code" value="10001" required>
                            </div>
                        </div>

                        <div class="border-bottom mb-4"></div>

                        <!-- ID Verification -->
                        <h5 class="mb-4">Identity Verification</h5>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="idType" class="form-label">ID Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="idType" name="id_type" required>
                                    <option value="" disabled>Select ID type</option>
                                    <option value="passport" selected>Passport</option>
                                    <option value="drivers_license">Driver's License</option>
                                    <option value="national_id">National ID Card</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="idNumber" class="form-label">ID Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="idNumber" name="id_number" value="123456789" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="idFront" class="form-label">ID Front Side <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="idFront" name="id_front" accept="image/*">
                                    <label class="input-group-text" for="idFront">Upload</label>
                                </div>
                                <div class="form-text">Accepted formats: JPG, PNG, PDF. Max size: 5MB</div>
                                <!-- Preview area for already uploaded document -->
                                <div class="mt-2 p-2 border rounded">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-image text-success me-2"></i>
                                        <span>passport_front.jpg</span>
                                        <button type="button" class="btn btn-sm text-danger ms-auto">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="idBack" class="form-label">ID Back Side <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="idBack" name="id_back" accept="image/*">
                                    <label class="input-group-text" for="idBack">Upload</label>
                                </div>
                                <div class="form-text">Accepted formats: JPG, PNG, PDF. Max size: 5MB</div>
                                <!-- Preview area for already uploaded document -->
                                <div class="mt-2 p-2 border rounded">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-image text-success me-2"></i>
                                        <span>passport_back.jpg</span>
                                        <button type="button" class="btn btn-sm text-danger ms-auto">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="selfie" class="form-label">Selfie with ID <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="selfie" name="selfie" accept="image/*">
                                    <label class="input-group-text" for="selfie">Upload</label>
                                </div>
                                <div class="form-text">Please upload a photo of yourself holding your ID</div>
                                <!-- Preview area for already uploaded document -->
                                <div class="mt-2 p-2 border rounded">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-image text-success me-2"></i>
                                        <span>selfie_with_id.jpg</span>
                                        <button type="button" class="btn btn-sm text-danger ms-auto">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom mb-4"></div>

                        <!-- Business Information -->
                        <h5 class="mb-4">Business Information</h5>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="businessType" class="form-label">Business Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="businessType" name="business_type" required>
                                    <option value="" disabled>Select business type</option>
                                    <option value="sole_proprietorship" selected>Sole Proprietorship</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="llc">Limited Liability Company (LLC)</option>
                                    <option value="corporation">Corporation</option>
                                    <option value="non_profit">Non-profit Organization</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="registrationNumber" class="form-label">Business Registration Number</label>
                                <input type="text" class="form-control" id="registrationNumber" name="registration_number" value="BUS12345678">
                                <div class="form-text">If applicable to your business type</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="businessDocument" class="form-label">Business Registration Document</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="businessDocument" name="business_document" accept="image/*,.pdf">
                                    <label class="input-group-text" for="businessDocument">Upload</label>
                                </div>
                                <div class="form-text">Upload business registration certificate, if applicable</div>
                                <!-- Preview area for already uploaded document -->
                                <div class="mt-2 p-2 border rounded">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                        <span>business_registration.pdf</span>
                                        <button type="button" class="btn btn-sm text-danger ms-auto">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="taxDocument" class="form-label">Tax Document</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="taxDocument" name="tax_document" accept="image/*,.pdf">
                                    <label class="input-group-text" for="taxDocument">Upload</label>
                                </div>
                                <div class="form-text">E.g., W-9 for US, VAT registration for EU</div>
                            </div>
                        </div>

                        <div class="border-bottom mb-4"></div>

                        <!-- Terms & Conditions -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree_terms" required>
                                <label class="form-check-label" for="agreeTerms">
                                    I confirm that all information provided is accurate and complete. I understand that providing false information may lead to account termination.
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeProcessing" name="agree_processing" required>
                                <label class="form-check-label" for="agreeProcessing">
                                    I consent to the processing of my personal data for KYC verification purposes in accordance with the <a href="#" target="_blank">Privacy Policy</a>.
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-outline-secondary">Save as Draft</button>
                            <button type="submit" class="btn btn-primary">Submit for Verification</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Verification History -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Verification History</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jun 10, 2023</td>
                                    <td>Initial KYC Submission</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>Under review by compliance team</td>
                                </tr>
                                <tr>
                                    <td>Jun 5, 2023</td>
                                    <td>Document Upload</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>All required documents uploaded</td>
                                </tr>
                                <tr>
                                    <td>Jun 1, 2023</td>
                                    <td>KYC Registration</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>KYC process initiated</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview uploaded images
    document.querySelectorAll('input[type="file"]').forEach(function(input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const parentDiv = this.closest('div.col-md-6');
                const previewArea = parentDiv.querySelector('div.mt-2');
                
                if (previewArea) {
                    // Remove any existing preview
                    const existingPreview = previewArea.querySelector('div.d-flex');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create new preview
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'd-flex align-items-center';
                    
                    // Choose icon based on file type
                    let iconClass = 'bi-file-earmark';
                    if (file.type.includes('image')) {
                        iconClass = 'bi-file-earmark-image text-success';
                    } else if (file.type.includes('pdf')) {
                        iconClass = 'bi-file-earmark-pdf text-danger';
                    }
                    
                    previewDiv.innerHTML = `
                        <i class="bi ${iconClass} me-2"></i>
                        <span>${file.name}</span>
                        <button type="button" class="btn btn-sm text-danger ms-auto">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                    
                    previewArea.appendChild(previewDiv);
                    
                    // Add event listener to remove button
                    const removeButton = previewDiv.querySelector('button');
                    removeButton.addEventListener('click', function() {
                        previewDiv.remove();
                        input.value = '';
                    });
                }
            }
        });
    });
</script>
@endpush 