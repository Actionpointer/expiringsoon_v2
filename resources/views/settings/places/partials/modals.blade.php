<!-- State Modals -->
<div class="modal fade" id="addStateModal" tabindex="-1" aria-labelledby="addStateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStateModalLabel">Add New State</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">State Name</label>
                        <input type="text" class="form-control" placeholder="Enter state name">
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="stateStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add State</button>
            </div>
        </div>
    </div>
</div>

<!-- City Modals -->
<div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCityModalLabel">Add New City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">City Name</label>
                        <input type="text" class="form-control" placeholder="Enter city name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">State</label>
                        <select class="form-select">
                            <option>Lagos</option>
                            <option>Abuja</option>
                            <option>Rivers</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="cityStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add City</button>
            </div>
        </div>
    </div>
</div>

<!-- Bank Modals -->
<div class="modal fade" id="addBankModal" tabindex="-1" aria-labelledby="addBankModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBankModalLabel">Add New Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control" placeholder="Enter bank name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Bank Code</label>
                        <input type="text" class="form-control" placeholder="e.g. 044">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Account Number Format</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="Length (e.g. 10)">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Prefix (e.g. 0,1,2)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Gateway Support</label>
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="paystackSupport">
                            <label class="form-check-label">Paystack</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="flutterwaveSupport">
                            <label class="form-check-label">Flutterwave</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="bankStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Bank</button>
            </div>
        </div>
    </div>
</div>

<!-- Verification Method Modal -->
<div class="modal fade" id="addVerificationModal" tabindex="-1" aria-labelledby="addVerificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVerificationModalLabel">Add Verification Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">Method Name</label>
                        <input type="text" class="form-control" placeholder="e.g. BVN">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" placeholder="e.g. Bank Verification Number">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Required Fields</label>
                        <input type="text" class="form-control mb-2" placeholder="Field name">
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            <i class="bi-plus"></i> Add Field
                        </button>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Priority</label>
                        <input type="number" class="form-control" min="1" value="1">
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="verificationMethodStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Method</button>
            </div>
        </div>
    </div>
</div> 