@extends('layouts.backend.base.app')

@section('main')
<form method="POST" action="{{ route('admin.settings.countries.update.verifications') }}">
    @csrf
    <input type="hidden" name="country_id" value="{{ $country->id }}">
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
                                    <option value="all" {{ (isset($country_verification) && $country_verification->id_requirement == 'all') ? 'selected' : '' }}>Require All</option>
                                    <option value="any" {{ (isset($country_verification) && $country_verification->id_requirement == 'any') ? 'selected' : '' }}>Any One</option>
                                </select>
                            </div>
                            <div class="row">
                                @php
                                    $idDocs = [
                                        ['key' => 'nationalId', 'label' => 'National ID'],
                                        ['key' => 'driverLicense', 'label' => "Driver's License"],
                                        ['key' => 'passport', 'label' => 'International Passport'],
                                        ['key' => 'votersCard', 'label' => "Voter's Card"],
                                    ];
                                    $idSaved = isset($country_verification) ? collect($country_verification->id_documents) : collect();
                                @endphp
                                @foreach($idDocs as $doc)
                                @php
                                    $saved = $idSaved->firstWhere('key', $doc['key']);
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="border rounded p-3">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="id_{{ $doc['key'] }}" name="id_documents[{{ $doc['key'] }}][enabled]" value="1" {{ $saved ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold">{{ $doc['label'] }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="id_documents[{{ $doc['key'] }}][require_file]" value="1" {{ (!empty($saved) && !empty($saved['require_file'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">File</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="id_documents[{{ $doc['key'] }}][require_issue_date]" value="1" {{ (!empty($saved) && !empty($saved['require_issue_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Issue Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="id_documents[{{ $doc['key'] }}][require_expiry_date]" value="1" {{ (!empty($saved) && !empty($saved['require_expiry_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Expiry Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="id_documents[{{ $doc['key'] }}][require_document_number]" value="1" {{ (!empty($saved) && !empty($saved['require_document_number'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Document Number</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Business Documents -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Business Documents</h5>
                                <select class="form-select form-select-sm w-auto" name="business_requirement">
                                    <option value="all" {{ (isset($country_verification) && $country_verification->business_requirement == 'all') ? 'selected' : '' }}>Require All</option>
                                    <option value="any" {{ (isset($country_verification) && $country_verification->business_requirement == 'any') ? 'selected' : '' }}>Any One</option>
                                </select>
                            </div>
                            <div class="row">
                                @php
                                    $bizDocs = [
                                        ['key' => 'regCertificate', 'label' => 'Registration Certificate'],
                                        ['key' => 'taxCertificate', 'label' => 'Tax Certificate'],
                                        ['key' => 'tradingLicense', 'label' => 'Trading License'],
                                        ['key' => 'vatCertificate', 'label' => 'VAT Certificate'],
                                    ];
                                    $bizSaved = isset($country_verification) ? collect($country_verification->business_documents) : collect();
                                @endphp
                                @foreach($bizDocs as $doc)
                                @php
                                    $saved = $bizSaved->firstWhere('key', $doc['key']);
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="border rounded p-3">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="biz_{{ $doc['key'] }}" name="business_documents[{{ $doc['key'] }}][enabled]" value="1" {{ $saved ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold">{{ $doc['label'] }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="business_documents[{{ $doc['key'] }}][require_file]" value="1" {{ (!empty($saved) && !empty($saved['require_file'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">File</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="business_documents[{{ $doc['key'] }}][require_issue_date]" value="1" {{ (!empty($saved) && !empty($saved['require_issue_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Issue Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="business_documents[{{ $doc['key'] }}][require_expiry_date]" value="1" {{ (!empty($saved) && !empty($saved['require_expiry_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Expiry Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="business_documents[{{ $doc['key'] }}][require_document_number]" value="1" {{ (!empty($saved) && !empty($saved['require_document_number'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Document Number</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Address Verification -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Address Verification</h5>
                                <select class="form-select form-select-sm w-auto" name="address_requirement">
                                    <option value="all" {{ (isset($country_verification) && $country_verification->address_requirement == 'all') ? 'selected' : '' }}>Require All</option>
                                    <option value="any" {{ (isset($country_verification) && $country_verification->address_requirement == 'any') ? 'selected' : '' }}>Any One</option>
                                </select>
                            </div>
                            <div class="row">
                                @php
                                    $addrDocs = [
                                        ['key' => 'utilityBill', 'label' => 'Utility Bill'],
                                        ['key' => 'bankStatement', 'label' => 'Bank Statement'],
                                        ['key' => 'tenancyAgreement', 'label' => 'Tenancy Agreement'],
                                        ['key' => 'councilTax', 'label' => 'Council Tax Bill'],
                                    ];
                                    $addrSaved = isset($country_verification) ? collect($country_verification->address_documents) : collect();
                                @endphp
                                @foreach($addrDocs as $doc)
                                @php
                                    $saved = $addrSaved->firstWhere('key', $doc['key']);
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="border rounded p-3">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="addr_{{ $doc['key'] }}" name="address_documents[{{ $doc['key'] }}][enabled]" value="1" {{ $saved ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold">{{ $doc['label'] }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="address_documents[{{ $doc['key'] }}][require_file]" value="1" {{ (!empty($saved) && !empty($saved['require_file'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">File</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="address_documents[{{ $doc['key'] }}][require_issue_date]" value="1" {{ (!empty($saved) && !empty($saved['require_issue_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Issue Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="address_documents[{{ $doc['key'] }}][require_expiry_date]" value="1" {{ (!empty($saved) && !empty($saved['require_expiry_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Expiry Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="address_documents[{{ $doc['key'] }}][require_document_number]" value="1" {{ (!empty($saved) && !empty($saved['require_document_number'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Document Number</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Additional Requirements -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Additional Requirements</h5>
                                <select class="form-select form-select-sm w-auto" name="additional_requirement">
                                    <option value="all" {{ (isset($country_verification) && $country_verification->additional_requirement == 'all') ? 'selected' : '' }}>Require All</option>
                                    <option value="any" {{ (isset($country_verification) && $country_verification->additional_requirement == 'any') ? 'selected' : '' }}>Any One</option>
                                </select>
                            </div>
                            <div class="row">
                                @php
                                    $addDocs = [
                                        ['key' => 'requireSelfie', 'label' => 'Selfie with ID'],
                                        ['key' => 'requireProofOfOwnership', 'label' => 'Proof of Ownership'],
                                        ['key' => 'requirePhoneVerification', 'label' => 'Phone Verification'],
                                        ['key' => 'requireEmailVerification', 'label' => 'Email Verification'],
                                    ];
                                    $addSaved = isset($country_verification) ? collect($country_verification->additional_documents) : collect();
                                @endphp
                                @foreach($addDocs as $doc)
                                @php
                                    $saved = $addSaved->firstWhere('key', $doc['key']);
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="border rounded p-3">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="add_{{ $doc['key'] }}" name="additional_documents[{{ $doc['key'] }}][enabled]" value="1" {{ $saved ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold">{{ $doc['label'] }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="additional_documents[{{ $doc['key'] }}][require_file]" value="1" {{ (!empty($saved) && !empty($saved['require_file'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">File</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="additional_documents[{{ $doc['key'] }}][require_issue_date]" value="1" {{ (!empty($saved) && !empty($saved['require_issue_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Issue Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="additional_documents[{{ $doc['key'] }}][require_expiry_date]" value="1" {{ (!empty($saved) && !empty($saved['require_expiry_date'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Expiry Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="additional_documents[{{ $doc['key'] }}][require_document_number]" value="1" {{ (!empty($saved) && !empty($saved['require_document_number'])) ? 'checked' : '' }}>
                                            <label class="form-check-label">Document Number</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
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
                            <select class="form-select mb-2" name="verification_provider_id">
                                @foreach($verification_providers as $provider)
                                <option value="{{$provider->id}}" {{ (isset($country_verification) && $country_verification->verification_provider_id == $provider->id) ? 'selected' : '' }}>{{$provider->display_name}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Provider used for automated verification</small>
                        </div>

                        <!-- Mode Setting -->
                        <div class="mb-4">
                            <label class="form-label">Provider Mode</label>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mode" id="modeTest" value="test" {{ (isset($country_verification) && $country_verification->mode == 'test') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="modeTest">Test Mode</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mode" id="modeLive" value="live" {{ (isset($country_verification) && $country_verification->mode == 'live') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="modeLive">Live Mode</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Test mode doesn't affect real users</small>
                        </div>

                        <!-- Verification Settings -->
                        <div class="mb-4">
                            <div class="form-check form-switch mb-2 d-flex align-items-center">
                                <input type="checkbox" class="form-check-input" id="autoApprove" name="auto_approve" {{ (isset($country_verification) && $country_verification->auto_verify_after_pass) ? 'checked' : '' }}>
                                <label class="form-check-label">Auto-verify account after all checks pass</label>
                            </div>
                        </div>

                        <!-- Verification Expiry -->
                        <div class="mb-4">
                            <label class="form-label">Verification Validity</label>
                            <select class="form-select" name="verification_validity_days">
                                <option value="0" {{ (isset($country_verification) && $country_verification->verification_validity_days == 0) ? 'selected' : '' }}>Never Expires</option>
                                <option value="180" {{ (isset($country_verification) && $country_verification->verification_validity_days == 180) ? 'selected' : '' }}>6 Months</option>
                                <option value="365" {{ (isset($country_verification) && $country_verification->verification_validity_days == 365) ? 'selected' : '' }}>1 Year</option>
                                <option value="730" {{ (isset($country_verification) && $country_verification->verification_validity_days == 730) ? 'selected' : '' }}>2 Years</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // For each document group
    document.querySelectorAll('.border.rounded.p-3').forEach(function(box) {
        const parentCheckbox = box.querySelector('input[type="checkbox"][name$="[enabled]"]');
        const childCheckboxes = box.querySelectorAll('input[type="checkbox"]:not([name$="[enabled]"])');

        // When parent is checked/unchecked, toggle all children
        parentCheckbox.addEventListener('change', function() {
            childCheckboxes.forEach(cb => cb.checked = parentCheckbox.checked);
        });

        // When any child is checked/unchecked, update parent
        childCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                if ([...childCheckboxes].some(c => c.checked)) {
                    parentCheckbox.checked = true;
                } else {
                    parentCheckbox.checked = false;
                }
            });
        });
    });
});
</script>

@endsection