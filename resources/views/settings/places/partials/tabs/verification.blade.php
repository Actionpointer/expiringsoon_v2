<div class="tab-pane fade" id="verification">
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
                            <select class="form-select form-select-sm w-auto">
                                <option value="all">Require All</option>
                                <option value="any">Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="nationalId" checked>
                                    <label class="form-check-label">National ID</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="driverLicense" checked>
                                    <label class="form-check-label">Driver's License</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="passport" checked>
                                    <label class="form-check-label">International Passport</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="votersCard">
                                    <label class="form-check-label">Voter's Card</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Documents -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Business Documents</h5>
                            <select class="form-select form-select-sm w-auto">
                                <option value="all">Require All</option>
                                <option value="any" selected>Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="regCertificate" checked>
                                    <label class="form-check-label">Registration Certificate</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="taxCertificate" checked>
                                    <label class="form-check-label">Tax Certificate</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="tradingLicense" checked>
                                    <label class="form-check-label">Trading License</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="vatCertificate">
                                    <label class="form-check-label">VAT Certificate</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Verification -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Address Verification</h5>
                            <select class="form-select form-select-sm w-auto">
                                <option value="all">Require All</option>
                                <option value="any" selected>Any One</option>
                                <option value="none">Not Required</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="utilityBill" checked>
                                    <label class="form-check-label">Utility Bill</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="bankStatement" checked>
                                    <label class="form-check-label">Bank Statement</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="tenancyAgreement">
                                    <label class="form-check-label">Tenancy Agreement</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="councilTax">
                                    <label class="form-check-label">Council Tax Bill</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Requirements -->
                    <div class="mb-4">
                        <h5>Additional Requirements</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireSelfie" checked>
                                    <label class="form-check-label">Selfie with ID</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireProofOfOwnership">
                                    <label class="form-check-label">Proof of Ownership</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requirePhoneVerification" checked>
                                    <label class="form-check-label">Phone Verification</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireEmailVerification" checked>
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
                        <select class="form-select mb-2">
                            <option value="manual">Manual Verification</option>
                            <option value="smile">Smile Identity</option>
                            <option value="veriff">Veriff</option>
                            <option value="jumio">Jumio</option>
                        </select>
                        <small class="form-text text-muted">Provider used for automated verification</small>
                    </div>

                    <!-- Verification Process -->
                    <div class="mb-4">
                        <label class="form-label">Verification Process</label>
                        <select class="form-select mb-2">
                            <option value="instant">Instant (Automated)</option>
                            <option value="manual">Manual Review</option>
                            <option value="hybrid">Hybrid (Auto + Manual)</option>
                        </select>
                    </div>

                    <!-- Verification Settings -->
                    <div class="mb-4">
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input" id="allowPartialVerification">
                            <label class="form-check-label">Allow Partial Verification</label>
                        </div>
                        <small class="form-text text-muted">Users can access basic features while completing verification</small>

                        <div class="form-check form-switch mb-2 mt-3">
                            <input type="checkbox" class="form-check-input" id="autoApprove">
                            <label class="form-check-label">Auto-approve if all checks pass</label>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input" id="requireReVerification">
                            <label class="form-check-label">Require periodic re-verification</label>
                        </div>
                    </div>

                    <!-- Verification Expiry -->
                    <div class="mb-4">
                        <label class="form-label">Verification Validity</label>
                        <select class="form-select">
                            <option value="0">Never Expires</option>
                            <option value="180">6 Months</option>
                            <option value="365">1 Year</option>
                            <option value="730">2 Years</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Verification Limits -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Verification Limits</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">Maximum Attempts</label>
                        <input type="number" class="form-control" value="3" min="1" max="10">
                        <small class="form-text text-muted">Maximum verification attempts per user</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Cooldown Period</label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="24">
                            <span class="input-group-text">hours</span>
                        </div>
                        <small class="form-text text-muted">Wait time after maximum attempts</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 