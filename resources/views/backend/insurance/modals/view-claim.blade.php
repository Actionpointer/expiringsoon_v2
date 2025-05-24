<!-- Claim View Modal -->
<div class="modal fade" id="viewClaimModal" tabindex="-1" aria-labelledby="viewClaimModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewClaimModalLabel">Claim #CLM-5678</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <!-- Status Banner -->
                <div class="alert alert-soft-warning mb-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi-clock-history"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="alert-heading mb-1">Processing</h5>
                            <p class="mb-0">Awaiting documentation review - Est. completion in 2 days</p>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                Update Status
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Claim Details -->
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4>Claim Information</h4>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Policy:</dt>
                            <dd class="col-sm-7">POL-1234</dd>

                            <dt class="col-sm-5">Company:</dt>
                            <dd class="col-sm-7">FastTrack Logistics</dd>

                            <dt class="col-sm-5">Type:</dt>
                            <dd class="col-sm-7">Vehicle Damage</dd>

                            <dt class="col-sm-5">Amount:</dt>
                            <dd class="col-sm-7">$12,400</dd>

                            <dt class="col-sm-5">Filed Date:</dt>
                            <dd class="col-sm-7">Mar 15, 2024</dd>

                            <dt class="col-sm-5">Incident Date:</dt>
                            <dd class="col-sm-7">Mar 12, 2024</dd>
                        </dl>
                    </div>
                    <div class="col-sm-6">
                        <h4>Additional Details</h4>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">Vehicle:</dt>
                            <dd class="col-sm-7">2022 Freightliner Cascadia</dd>

                            <dt class="col-sm-5">VIN:</dt>
                            <dd class="col-sm-7">1FUJA6CV12LK89012</dd>

                            <dt class="col-sm-5">Location:</dt>
                            <dd class="col-sm-7">I-95, Miami, FL</dd>

                            <dt class="col-sm-5">Driver:</dt>
                            <dd class="col-sm-7">John Smith</dd>

                            <dt class="col-sm-5">Police Report:</dt>
                            <dd class="col-sm-7">#PR-98765</dd>
                        </dl>
                    </div>
                </div>

                <!-- Incident Description -->
                <div class="mb-4">
                    <h4>Incident Description</h4>
                    <p class="mb-0">Vehicle involved in a collision with a passenger car during heavy rain. Front bumper and hood damage. No injuries reported. Police report filed on scene.</p>
                </div>

                <!-- Documents -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Documents</h4>
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            <i class="bi-upload me-1"></i> Upload
                        </button>
                    </div>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="bi-file-pdf fs-2 text-danger"></i>
                                </div>
                                <div class="col">
                                    <h5 class="mb-1">Police Report</h5>
                                    <small class="text-muted">PDF, 2.4MB</small>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle">
                                        <i class="bi-download"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="bi-images fs-2 text-info"></i>
                                </div>
                                <div class="col">
                                    <h5 class="mb-1">Damage Photos</h5>
                                    <small class="text-muted">ZIP, 15.8MB</small>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle">
                                        <i class="bi-download"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div>
                    <h4>Claim Timeline</h4>
                    <ul class="step step-icon-xs mb-0">
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-primary">
                                    <i class="bi-file-text"></i>
                                </span>
                                <div class="step-content">
                                    <h5 class="mb-1">Documentation Review</h5>
                                    <p class="fs-6 mb-0">Additional photos requested from driver</p>
                                    <small class="text-muted">Today at 9:16 AM - by Sarah Johnson</small>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-info">
                                    <i class="bi-upload"></i>
                                </span>
                                <div class="step-content">
                                    <h5 class="mb-1">Documents Uploaded</h5>
                                    <p class="fs-6 mb-0">Police report and initial photos uploaded</p>
                                    <small class="text-muted">Mar 15, 2024 at 2:30 PM - by John Smith</small>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-warning">
                                    <i class="bi-exclamation-triangle"></i>
                                </span>
                                <div class="step-content">
                                    <h5 class="mb-1">Claim Filed</h5>
                                    <p class="fs-6 mb-0">Initial claim submitted for vehicle damage</p>
                                    <small class="text-muted">Mar 15, 2024 at 10:15 AM - by John Smith</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" id="claimActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="claimActionsDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="bi-pencil dropdown-item-icon"></i> Edit Claim
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-chat-left-dots dropdown-item-icon"></i> Add Note
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-download dropdown-item-icon"></i> Download All Documents
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#">
                            <i class="bi-x-circle dropdown-item-icon"></i> Mark as Fraud
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 