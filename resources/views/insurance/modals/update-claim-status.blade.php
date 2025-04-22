<!-- Update Claim Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Claim Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <!-- Current Status -->
                <div class="mb-4">
                    <label class="form-label">Current Status</label>
                    <div class="form-control bg-light">
                        <span class="badge bg-warning">Processing</span>
                        <small class="ms-2 text-muted">Updated 2 days ago by Sarah Johnson</small>
                    </div>
                </div>

                <!-- New Status -->
                <div class="mb-4">
                    <label class="form-label">New Status</label>
                    <div class="tom-select-custom">
                        <select class="js-select form-select" autocomplete="off">
                            <option value="">Select status</option>
                            <option value="pending_review">Pending Review</option>
                            <option value="processing">Processing</option>
                            <option value="pending_documents">Pending Documents</option>
                            <option value="under_investigation">Under Investigation</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="fraud">Marked as Fraud</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="mb-4">
                    <label class="form-label">Admin Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Add internal notes about this status change"></textarea>
                </div>

                <!-- Administrative Actions -->
                <div class="mb-4">
                    <label class="form-label">Administrative Actions</label>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="notifyCompany">
                        <label class="form-check-label" for="notifyCompany">Notify Company</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="notifyInsurer">
                        <label class="form-check-label" for="notifyInsurer">Notify Insurance Provider</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="requireApproval">
                        <label class="form-check-label" for="requireApproval">Require Secondary Approval</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="flagForReview">
                        <label class="form-check-label" for="flagForReview">Flag for Compliance Review</label>
                    </div>
                </div>

                <!-- Payment Authorization (Appears only for Approved status) -->
                <div class="mb-4 d-none" id="paymentAuthSection">
                    <label class="form-label">Payment Authorization</label>
                    <div class="alert alert-soft-primary mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi-info-circle"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h5 class="alert-heading">Claim Amount: $12,400</h5>
                                <p class="mb-0">Payment requires approval for amounts over $10,000</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="authorizePayment">
                        <label class="form-check-label" for="authorizePayment">Authorize Payment</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="expeditePayment">
                        <label class="form-check-label" for="expeditePayment">Expedite Payment (24h)</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Update Status</button>
            </div>
        </div>
    </div>
</div> 