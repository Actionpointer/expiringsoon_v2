<!-- Policy View Modal -->
<div class="modal fade" id="viewPolicyModal" tabindex="-1" aria-labelledby="viewPolicyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPolicyModalLabel">Policy #POL-1234</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <!-- Status Banner -->
                <div class="alert alert-soft-success mb-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi-check-circle"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="alert-heading mb-1">Active Policy</h5>
                            <p class="mb-0">Next payment due on April 15, 2024</p>
                        </div>
                    </div>
                </div>

                <!-- Policy Details -->
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4>Policy Information</h4>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Company:</dt>
                            <dd class="col-sm-7">FastTrack Logistics</dd>

                            <dt class="col-sm-5">Provider:</dt>
                            <dd class="col-sm-7">SafeGuard Insurance</dd>

                            <dt class="col-sm-5">Product:</dt>
                            <dd class="col-sm-7">Premium Fleet Protection</dd>

                            <dt class="col-sm-5">Premium:</dt>
                            <dd class="col-sm-7">$2,400/month</dd>

                            <dt class="col-sm-5">Start Date:</dt>
                            <dd class="col-sm-7">Jan 15, 2024</dd>

                            <dt class="col-sm-5">End Date:</dt>
                            <dd class="col-sm-7">Jan 14, 2025</dd>
                        </dl>
                    </div>
                    <div class="col-sm-6">
                        <h4>Coverage Details</h4>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Coverage Limit:</dt>
                            <dd class="col-sm-7">$5,000,000</dd>

                            <dt class="col-sm-5">Deductible:</dt>
                            <dd class="col-sm-7">$5,000</dd>

                            <dt class="col-sm-5">Vehicles Covered:</dt>
                            <dd class="col-sm-7">15</dd>

                            <dt class="col-sm-5">Territory:</dt>
                            <dd class="col-sm-7">Nationwide</dd>

                            <dt class="col-sm-5">Payment Status:</dt>
                            <dd class="col-sm-7"><span class="badge bg-soft-success text-success">Current</span></dd>
                        </dl>
                    </div>
                </div>

                <!-- Claims Summary -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Recent Claims</h4>
                        <span class="badge bg-soft-primary text-primary">3 Total Claims</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Claim ID</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CLM-5678</td>
                                    <td>Mar 10, 2024</td>
                                    <td>Vehicle Damage</td>
                                    <td>$12,400</td>
                                    <td><span class="badge bg-soft-warning text-warning">Processing</span></td>
                                </tr>
                                <tr>
                                    <td>CLM-5677</td>
                                    <td>Feb 15, 2024</td>
                                    <td>Liability</td>
                                    <td>$8,900</td>
                                    <td><span class="badge bg-soft-success text-success">Approved</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div>
                    <h4>Recent Activity</h4>
                    <ul class="step step-icon-xs mb-0">
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-primary">
                                    <i class="bi-receipt"></i>
                                </span>
                                <div class="step-content">
                                    <h5 class="mb-1">Monthly Premium Paid</h5>
                                    <p class="fs-6 mb-0">$2,400 processed successfully</p>
                                    <small class="text-muted">March 15, 2024</small>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-warning">
                                    <i class="bi-exclamation-triangle"></i>
                                </span>
                                <div class="step-content">
                                    <h5 class="mb-1">New Claim Filed</h5>
                                    <p class="fs-6 mb-0">Claim #CLM-5678 submitted</p>
                                    <small class="text-muted">March 10, 2024</small>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-success">
                                    <i class="bi-check-circle"></i>
                                </span>
                                <div class="step-content">
                                    <h5 class="mb-1">Vehicle Added to Policy</h5>
                                    <p class="fs-6 mb-0">New vehicle VIN#1234 added</p>
                                    <small class="text-muted">March 5, 2024</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" id="policyActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="policyActionsDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="bi-pencil dropdown-item-icon"></i> Edit Policy
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-file-text dropdown-item-icon"></i> Download Documents
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-plus-circle dropdown-item-icon"></i> Add Claim
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#">
                            <i class="bi-x-circle dropdown-item-icon"></i> Cancel Policy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 