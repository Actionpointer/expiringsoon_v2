@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->

    @include('backend.settings.countries.partials.navigation')

    <div class="row">
        <!-- Document Requirements -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Verification Requirements</h4>
                </div>
                <div class="card-body">
                    <!-- Government ID -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Government ID</h5>
                            <select class="form-select form-select-sm w-auto" name="id_requirement">
                                <option value="all">Require All</option>
                                <option value="any">Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="nationalId" name="id_documents[]" value="nationalId" checked>
                                    <label class="form-check-label">National ID</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="driverLicense" name="id_documents[]" value="driverLicense" checked>
                                    <label class="form-check-label">Driver's License</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="passport" name="id_documents[]" value="passport" checked>
                                    <label class="form-check-label">International Passport</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="votersCard" name="id_documents[]" value="votersCard">
                                    <label class="form-check-label">Voter's Card</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Documents -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Business Documents</h5>
                            <select class="form-select form-select-sm w-auto" name="business_requirement">
                                <option value="all">Require All</option>
                                <option value="any" selected>Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="regCertificate" name="business_documents[]" value="regCertificate" checked>
                                    <label class="form-check-label">Registration Certificate</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="taxCertificate" name="business_documents[]" value="taxCertificate" checked>
                                    <label class="form-check-label">Tax Certificate</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="tradingLicense" name="business_documents[]" value="tradingLicense" checked>
                                    <label class="form-check-label">Trading License</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="vatCertificate" name="business_documents[]" value="vatCertificate">
                                    <label class="form-check-label">VAT Certificate</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Verification -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Address Verification</h5>
                            <select class="form-select form-select-sm w-auto" name="address_requirement">
                                <option value="all">Require All</option>
                                <option value="any" selected>Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="utilityBill" name="address_documents[]" value="utilityBill" checked>
                                    <label class="form-check-label">Utility Bill</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="bankStatement" name="address_documents[]" value="bankStatement" checked>
                                    <label class="form-check-label">Bank Statement</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="tenancyAgreement" name="address_documents[]" value="tenancyAgreement">
                                    <label class="form-check-label">Tenancy Agreement</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="councilTax" name="address_documents[]" value="councilTax">
                                    <label class="form-check-label">Council Tax Bill</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Requirements -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Additional Requirements</h5>
                            <select class="form-select form-select-sm w-auto" name="additional_requirement">
                                <option value="all">Require All</option>
                                <option value="any" selected>Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireSelfie" name="additional_documents[]" value="requireSelfie" checked>
                                    <label class="form-check-label">Selfie with ID</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireProofOfOwnership" name="additional_documents[]" value="requireProofOfOwnership">
                                    <label class="form-check-label">Proof of Ownership</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requirePhoneVerification" name="additional_documents[]" value="requirePhoneVerification" checked>
                                    <label class="form-check-label">Phone Verification</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireEmailVerification" name="additional_documents[]" value="requireEmailVerification" checked>
                                    <label class="form-check-label">Email Verification</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Verification Settings -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-header-title">Verification Settings</h4>
                </div>
                <div class="card-body">
                    <!-- Verification Provider -->
                    <div class="mb-4">
                        <label class="form-label">Primary Verification Provider</label>
                        <select class="form-select mb-2" name="verification_provider">
                            <option value="manual">Manual Verification</option>
                            <option value="smile">Smile Identity</option>
                            <option value="veriff">Veriff</option>
                            <option value="jumio">Jumio</option>
                        </select>
                        <small class="form-text text-muted">Provider used for automated verification</small>
                    </div>

                    <!-- Mode Setting -->
                    <div class="mb-4">
                        <label class="form-label">Provider Mode</label>
                        <div class="d-flex">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="modeTest" value="test" checked>
                                <label class="form-check-label" for="modeTest">Test Mode</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="modeLive" value="live">
                                <label class="form-check-label" for="modeLive">Live Mode</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Test mode doesn't affect real users</small>
                    </div>

                    <!-- Verification Settings -->
                    <div class="mb-4">
                        <div class="form-check form-switch mb-2 d-flex align-items-center">
                            <input type="checkbox" class="form-check-input" id="autoApprove" name="auto_approve">
                            <label class="form-check-label">Auto-verify account after all checks pass</label>
                        </div>
                    </div>

                    <!-- Verification Expiry -->
                    <div class="mb-4">
                        <label class="form-label">Verification Validity</label>
                        <select class="form-select" name="verification_validity_days">
                            <option value="0">Never Expires</option>
                            <option value="180">6 Months</option>
                            <option value="365">1 Year</option>
                            <option value="730">2 Years</option>
                        </select>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection