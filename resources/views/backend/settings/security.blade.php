@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Security</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Security Settings</h1>
            </div>
        </div>
        @include('backend.settings.partials.menu')
    </div>

    <div class="row">
        <div class="col-lg-3">
            <!-- Navbar -->
            <div class="navbar-expand-lg navbar-vertical mb-3 mb-lg-5">
                <!-- Navbar Toggle -->
                <div class="d-grid">
                    <button type="button" class="navbar-toggler btn btn-white mb-3" data-bs-toggle="collapse"
                        data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false"
                        aria-controls="navbarVerticalNavMenu">
                        <span class="d-flex justify-content-between align-items-center">
                            <span class="text-dark">Menu</span>
                            <span class="navbar-toggler-default">
                                <i class="bi-list"></i>
                            </span>
                        </span>
                    </button>
                </div>
                <!-- End Navbar Toggle -->

                <!-- Navbar Collapse -->
                <div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
                    <ul id="navbarSettings" class="nav nav-tabs nav-vertical">
                        <li class="nav-item">
                            <a class="nav-link active" href="#rateLimit" data-bs-toggle="tab">
                                <i class="bi-speedometer nav-icon"></i> Rate Limiting
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#authentication" data-bs-toggle="tab">
                                <i class="bi-shield-lock nav-icon"></i> Authentication
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fraudDetection" data-bs-toggle="tab">
                                <i class="bi-exclamation-diamond nav-icon"></i> Fraud Detection
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ipProtection" data-bs-toggle="tab">
                                <i class="bi-globe nav-icon"></i> IP Protection
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#automatedResponses" data-bs-toggle="tab">
                                <i class="bi-robot nav-icon"></i> Automated Responses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#notifications" data-bs-toggle="tab">
                                <i class="bi-bell nav-icon"></i> Security Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#walletControls" data-bs-toggle="tab">
                                <i class="bi-wallet2 nav-icon"></i> Wallet Controls
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Navbar -->
        </div>

        <div class="col-lg-9">
            <div class="tab-content">
                <!-- Rate Limiting Settings -->
                <div class="tab-pane fade show active" id="rateLimit">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Rate Limiting Configuration</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>API Rate Limits</h5>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label class="form-label">Default Rate Limit (requests/minute)</label>
                                        <input type="number" class="form-control" value="60">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Burst Allowance</label>
                                        <input type="number" class="form-control" value="100">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Rate Limit by Endpoint Type</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text">GET</span>
                                                <input type="number" class="form-control" value="100">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text">POST</span>
                                                <input type="number" class="form-control" value="30">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text">DELETE</span>
                                                <input type="number" class="form-control" value="10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Login Attempt Limits</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Max Login Attempts</label>
                                        <input type="number" class="form-control" value="5">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Time Window (minutes)</label>
                                        <input type="number" class="form-control" value="15">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Authentication Settings -->
                <div class="tab-pane fade" id="authentication">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Authentication Security</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Password Policy</h5>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label class="form-label">Minimum Password Length</label>
                                        <input type="number" class="form-control" value="12">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Password Expiry (days)</label>
                                        <input type="number" class="form-control" value="90">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Password Requirements</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Require uppercase letters</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Require numbers</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Require special characters</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Prevent password reuse (last 5 passwords)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Two-Factor Authentication</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Require 2FA for all admin accounts</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Require 2FA for all user accounts</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fraud Detection Settings -->
                <div class="tab-pane fade" id="fraudDetection">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Fraud Detection Rules</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Suspicious Activity Detection</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Multiple failed transactions</label>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Failed Transaction Threshold</label>
                                        <input type="number" class="form-control" value="3">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Time Window (minutes)</label>
                                        <input type="number" class="form-control" value="60">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Location-based Detection</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Detect unusual login locations</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Block high-risk countries</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Behavioral Analysis</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Monitor unusual activity patterns</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Track rapid account changes</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- IP Protection Settings -->
                <div class="tab-pane fade" id="ipProtection">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">IP Protection Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Automated IP Blocking</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Enable automatic IP blocking</label>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Block Duration (hours)</label>
                                        <input type="number" class="form-control" value="24">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>IP Whitelist</h5>
                                <div class="mb-3">
                                    <label class="form-label">Trusted IP Addresses</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter IP addresses (one per line)"></textarea>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Proxy/VPN Detection</h5>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Block proxy/VPN connections</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Allow VPN for specific user roles</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Automated Responses -->
                <div class="tab-pane fade" id="automatedResponses">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Automated Response Configuration</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Login Security</h5>
                                <div class="mb-3">
                                    <label class="form-label">After Failed Login Attempts:</label>
                                    <select class="form-select">
                                        <option value="block_ip">Block IP Address</option>
                                        <option value="lock_account">Lock User Account</option>
                                        <option value="both" selected>Both</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Account Recovery Method:</label>
                                    <select class="form-select">
                                        <option value="email">Email Verification</option>
                                        <option value="2fa">2FA Verification</option>
                                        <option value="manual">Manual Admin Review</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Suspicious Activity Response</h5>
                                <div class="mb-3">
                                    <label class="form-label">On Detection:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Temporarily suspend account</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Send alert to security team</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Notify user via email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>API Security Response</h5>
                                <div class="mb-3">
                                    <label class="form-label">On Rate Limit Exceed:</label>
                                    <select class="form-select">
                                        <option value="block_temp">Temporary Block (15 minutes)</option>
                                        <option value="block_day">Extended Block (24 hours)</option>
                                        <option value="review">Flag for Review</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Notifications -->
                <div class="tab-pane fade" id="notifications">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Security Notification Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Admin Notifications</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Failed login attempts</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Suspicious activity detection</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">IP blocking events</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Account suspensions</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Notification Channels</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Email</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">SMS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Slack</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Discord</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Emergency Contacts</h5>
                                <div class="mb-3">
                                    <label class="form-label">Security Team Email</label>
                                    <input type="email" class="form-control" value="security@company.com">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Emergency Phone</label>
                                    <input type="tel" class="form-control" value="+1234567890">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wallet Controls -->
                <div class="tab-pane fade" id="walletControls">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-header-title">Global Wallet Controls</h4>
                        </div>
                        <div class="card-body">
                            <!-- Global Freeze Control -->
                            <div class="alert alert-warning">
                                <div class="d-flex">
                                    <i class="bi-exclamation-triangle-fill fs-2 me-2"></i>
                                    <div>
                                        <h5>⚠️ Critical Action Zone</h5>
                                        <p class="mb-0">Freezing wallets will prevent all transactions. Use with extreme caution.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="mb-0">Global Wallet Freeze</h5>
                                        <p class="small text-muted">Affects all wallets across all countries</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="globalWalletFreeze" 
                                               onchange="confirmGlobalFreeze(this)">
                                        <label class="form-check-label" for="globalWalletFreeze">Freeze All Wallets</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Country-Specific Controls</h4>
                        </div>
                        <div class="card-body">
                            <!-- Country Specific Controls -->
                            <div class="mb-4">
                                <div class="row mb-3">
                                    <div class="col">
                                        <select class="form-select" id="countrySelector">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    data-status="{{ $country->wallet_freeze_status }}"
                                                    data-reason="{{ $country->freeze_reason }}">
                                                    {{ $country->name }} ({{ $country->currency_code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="countryWalletFreeze" disabled
                                                   onchange="confirmCountryFreeze(this)">
                                            <label class="form-check-label" for="countryWalletFreeze">Freeze Country Wallets</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Frozen Countries List -->
                            <div class="mb-4">
                                <h5>Currently Frozen Countries</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Country</th>
                                                <th>Frozen Since</th>
                                                <th>Reason</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="frozenCountriesList">
                                            <!-- Dynamically populated -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Freeze History -->
                            <div>
                                <h5>Freeze History</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Country</th>
                                                <th>Action</th>
                                                <th>By Admin</th>
                                                <th>Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody id="freezeHistory">
                                            <!-- Dynamically populated -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirmationMessage"></p>
                <div id="modalFreezeReason" class="mt-3">
                    <label class="form-label">Reason for freeze <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="freezeReasonText" rows="3" placeholder="Enter reason for freeze (required)"></textarea>
                    <small class="text-muted">This will be logged and displayed to affected users</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" id="modalCancelBtn">Cancel</button>
                <button type="button" class="btn btn-danger" id="modalConfirmBtn">Proceed</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function saveAllSettings() {
        // Implementation for saving all security settings
        console.log('Saving security settings...');
        // Show success toast
        toast('Settings saved successfully');
    }

    function toast(message) {
        // Implementation for showing toast notification
    }

    // Store callback functions
    let confirmCallback = null;
    let cancelCallback = null;

    function showConfirmationModal(title, message, onConfirm, onCancel, showReason = false) {
        // Store callbacks
        confirmCallback = onConfirm;
        cancelCallback = onCancel;

        // Update modal content
        $('#confirmationModalLabel').text(title);
        $('#confirmationMessage').text(message);
        
        // Show/hide reason textarea
        $('#modalFreezeReason').toggle(showReason);
        if (showReason) {
            $('#freezeReasonText').val('');
        }

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    }

    // Handle modal button clicks
    document.getElementById('modalConfirmBtn').addEventListener('click', function() {
        if ($('#modalFreezeReason').is(':visible') && !$('#freezeReasonText').val().trim()) {
            alert('Please enter a reason for the freeze');
            return;
        }

        if (confirmCallback) {
            const reason = $('#freezeReasonText').val().trim();
            confirmCallback(reason);
        }
        bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
    });

    function confirmGlobalFreeze(checkbox) {
        if (checkbox.checked) {
            showConfirmationModal(
                'Global Wallet Freeze',
                'Are you sure you want to freeze ALL wallets across ALL countries? This is a critical action.',
                function(reason) {
                    // Here you would make an API call to freeze all wallets with the reason
                    console.log('Freezing all wallets with reason:', reason);
                },
                function() {
                    checkbox.checked = false;
                },
                true // Show reason field
            );
        } else {
            showConfirmationModal(
                'Unfreeze Global Wallets',
                'Are you sure you want to unfreeze all wallets?',
                function() {
                    // Here you would make an API call to unfreeze all wallets
                    console.log('Unfreezing all wallets');
                },
                function() {
                    checkbox.checked = true;
                },
                false // Don't show reason field for unfreezing
            );
        }
    }

    function confirmCountryFreeze(checkbox) {
        const country = $('#countrySelector option:selected').text();
        if (checkbox.checked) {
            showConfirmationModal(
                'Country Wallet Freeze',
                `Are you sure you want to freeze all wallets in ${country}?`,
                function(reason) {
                    // Here you would make an API call to freeze country wallets with the reason
                    console.log('Freezing wallets for', country, 'with reason:', reason);
                },
                function() {
                    checkbox.checked = false;
                },
                true // Show reason field
            );
        } else {
            showConfirmationModal(
                'Unfreeze Country Wallets',
                `Are you sure you want to unfreeze all wallets in ${country}?`,
                function() {
                    // Here you would make an API call to unfreeze country wallets
                    console.log('Unfreezing wallets for', country);
                },
                function() {
                    checkbox.checked = true;
                },
                false // Don't show reason field for unfreezing
            );
        }
    }

    // Country selector handling
    $('#countrySelector').change(function() {
        const selected = $(this).find(':selected');
        $('#countryWalletFreeze')
            .prop('disabled', !selected.val())
            .prop('checked', selected.data('status') === 'frozen');
    });
</script>
@endpush 