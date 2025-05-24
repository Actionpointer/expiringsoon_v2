<div class="tab-pane fade" id="banking">
    <div class="row">
        <!-- Payment Gateway Settings -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Banking Requirements</h4>
                </div>
                <div class="card-body">
                    <!-- Account Format -->
                    <div class="mb-4">
                        <h5>Account Number Format</h5>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Length</label>
                                <input type="number" class="form-control" value="10" min="1" max="20">
                                <small class="form-text text-muted">Number of digits in account number</small>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Valid Prefixes</label>
                                <input type="text" class="form-control" placeholder="e.g. 0,1,2" value="0,1,2">
                                <small class="form-text text-muted">Comma-separated list of valid starting digits</small>
                            </div>
                        </div>
                    </div>

                    <!-- Required Fields -->
                    <div class="mb-4">
                        <h5>Required Banking Fields</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireAccountName" checked>
                                    <label class="form-check-label">Account Name</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireAccountNumber" checked>
                                    <label class="form-check-label">Account Number</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireBankName" checked>
                                    <label class="form-check-label">Bank Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireBranchCode">
                                    <label class="form-check-label">Branch Code</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireSwiftCode">
                                    <label class="form-check-label">SWIFT Code</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="requireIban">
                                    <label class="form-check-label">IBAN Number</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Requirements -->
                    <div class="mb-4">
                        <h5>Account Verification</h5>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="requireVerification" checked>
                                <label class="form-check-label">Require Account Verification</label>
                            </div>
                            <small class="form-text text-muted">Account details will be verified with bank before activation</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Verification Method</label>
                            <select class="form-select">
                                <option value="instant">Instant Verification (via Payment Gateway)</option>
                                <option value="micro_deposit">Micro-deposit Verification</option>
                                <option value="manual">Manual Verification</option>
                            </select>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input" id="allowUnverified">
                            <label class="form-check-label">Allow Unverified Accounts</label>
                        </div>
                        <small class="form-text text-muted">If enabled, unverified accounts can receive payments but with restrictions</small>
                    </div>

                    <!-- Gateway Settings -->
                    <div class="mb-4">
                        <h5>Gateway Settings</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check form-switch mb-2">
                                    <input type="checkbox" class="form-check-input" id="autoSyncBanks" checked>
                                    <label class="form-check-label">Auto-sync bank list daily</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check form-switch mb-2">
                                    <input type="checkbox" class="form-check-input" id="autoSwitchGateway" checked>
                                    <label class="form-check-label">Auto-switch on gateway failure</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Bank List Stats -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Gateway Status</h4>
                </div>
                <div class="card-body">
                    <!-- Gateway Cards -->
                    <div class="mb-4">
                        <div class="card card-bordered shadow-none mb-3">
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input type="checkbox" class="form-check-input" id="paystackEnabled" checked>
                                    <label class="form-check-label">
                                        <img src="assets/images/paystack-logo.svg" alt="Paystack" height="20">
                                    </label>
                                </div>
                                <div class="mb-2">
                                    <span class="badge bg-soft-success">Primary Gateway</span>
                                </div>
                                <small class="text-muted d-block">Last synced: 2 hours ago</small>
                            </div>
                        </div>

                        <div class="card card-bordered shadow-none">
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input type="checkbox" class="form-check-input" id="flutterwaveEnabled" checked>
                                    <label class="form-check-label">
                                        <img src="assets/images/flutterwave-logo.svg" alt="Flutterwave" height="20">
                                    </label>
                                </div>
                                <div class="mb-2">
                                    <span class="badge bg-soft-warning">Backup Gateway</span>
                                </div>
                                <small class="text-muted d-block">Last synced: 1 hour ago</small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-soft-info mb-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi-info-circle"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                Bank list is automatically maintained via selected payment gateways.
                                Configure banking requirements for this country here.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 