@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Dispute #DSP-1234</h1>
                <span class="badge bg-warning">Pending</span>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-danger me-2">
                    <i class="bi-x-circle me-1"></i> Close Dispute
                </button>
                <a href="{{ route('admin.support.disputes.index') }}" class="btn btn-secondary me-2">
                    <i class="bi-arrow-left me-1"></i> Back to Disputes
                </a>
                <button class="btn btn-primary">
                    <i class="bi-download me-1"></i> Export Details
                </button>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <!-- Nav -->
                    <ul class="nav nav-tabs card-nav card-nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#details" data-bs-toggle="tab">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#messages" data-bs-toggle="tab">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#timeline" data-bs-toggle="tab">Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#evidence" data-bs-toggle="tab">Evidence</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <!-- Details Tab -->
                    <div class="tab-pane fade show active" id="details">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Dispute Details -->
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <span class="h6">Type:</span>
                                            <span class="badge bg-soft-danger text-danger ms-2">Courier</span>
                                            <small class="d-block text-muted mt-1">Lost Package</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="h6">Amount in Dispute:</span>
                                            <span class="text-dark ms-2">$1,500.00</span>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <span class="h6">Created Date:</span>
                                            <span class="text-body ms-2">Jan 15, 2024</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="h6">Last Updated:</span>
                                            <span class="text-body ms-2">Jan 17, 2024</span>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <span class="h6">Description:</span>
                                        <p class="text-body mt-2">
                                            Package containing electronic equipment was reported lost during transit. 
                                            Customer claims the package was never delivered, while courier's tracking 
                                            system shows it was delivered to the specified address.
                                        </p>
                                    </div>

                                    <div class="mb-4">
                                        <span class="h6">Related Information:</span>
                                        <ul class="list-unstyled mt-2">
                                            <li><i class="bi-box me-2"></i>Package ID: PKG-78901</li>
                                            <li><i class="bi-truck me-2"></i>Tracking Number: TRK-123456</li>
                                            <li><i class="bi-calendar-event me-2"></i>Shipping Date: Jan 10, 2024</li>
                                            <li><i class="bi-geo-alt me-2"></i>Delivery Address: 123 Main St, City</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Parties Involved -->
                                <div class="card-body border-start">
                                    <h4 class="card-header-title mb-4">Parties Involved</h4>
                                    <div class="mb-4">
                                        <span class="h6">Complainant:</span>
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img src="https://via.placeholder.com/150" alt="Customer">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-0">John Doe</h5>
                                                <small class="text-muted">Customer</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <span class="h6">Respondent:</span>
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img src="https://via.placeholder.com/150" alt="Company">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-0">FastTrack Logistics</h5>
                                                <small class="text-muted">Courier Company</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add Assigned Mediator section -->
                                    <div class="mt-4">
                                        <h4 class="card-header-title mb-4">Assigned Mediator</h4>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img src="https://via.placeholder.com/150" alt="Mediator">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-0">Sarah Wilson</h5>
                                                <small class="text-muted">Senior Dispute Mediator</small>
                                            </div>
                                            <div class="ms-2">
                                                <span class="badge bg-soft-warning text-warning">Active</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <small class="text-muted d-block">Assigned on: Jan 16, 2024</small>
                                            <small class="text-muted d-block">Cases Resolved: 145</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Tab -->
                    <div class="tab-pane fade" id="messages">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- Messages Thread -->
                                    <div class="message-thread mb-4">
                                        <!-- System Message -->
                                        <div class="text-center mb-4">
                                            <span class="badge bg-soft-secondary">Dispute opened on Jan 15, 2024</span>
                                        </div>

                                        <!-- Customer Message -->
                                        <div class="message customer-message mb-4">
                                            <div class="message-header d-flex justify-content-between align-items-center mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-xs avatar-circle me-2">
                                                        <img src="https://via.placeholder.com/150" alt="Customer">
                                                    </div>
                                                    <h5 class="mb-0">John Doe</h5>
                                                    <span class="badge bg-soft-primary ms-2">Customer</span>
                                                </div>
                                                <small class="text-muted">Jan 15, 10:30 AM</small>
                                            </div>
                                            <div class="message-content bg-soft-primary p-3 rounded">
                                                <p class="mb-0">I haven't received my package yet. The tracking shows delivered but nothing was left at my address.</p>
                                            </div>
                                        </div>

                                        <!-- Company Response -->
                                        <div class="message company-message mb-4">
                                            <div class="message-header d-flex justify-content-between align-items-center mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-xs avatar-circle me-2">
                                                        <img src="https://via.placeholder.com/150" alt="Company">
                                                    </div>
                                                    <h5 class="mb-0">FastTrack Logistics</h5>
                                                    <span class="badge bg-soft-info ms-2">Company</span>
                                                </div>
                                                <small class="text-muted">Jan 15, 2:45 PM</small>
                                            </div>
                                            <div class="message-content bg-soft-info p-3 rounded">
                                                <p class="mb-0">Our records show the package was delivered and signed for. We've attached the delivery confirmation and photo.</p>
                                            </div>
                                        </div>

                                        <!-- Mediator Message -->
                                        <div class="message mediator-message mb-4">
                                            <div class="message-header d-flex justify-content-between align-items-center mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-xs avatar-circle me-2">
                                                        <img src="https://via.placeholder.com/150" alt="Mediator">
                                                    </div>
                                                    <h5 class="mb-0">Sarah Wilson</h5>
                                                    <span class="badge bg-soft-warning ms-2">Mediator</span>
                                                </div>
                                                <small class="text-muted">Jan 16, 11:15 AM</small>
                                            </div>
                                            <div class="message-content bg-soft-warning p-3 rounded">
                                                <p class="mb-0">I'll be mediating this dispute. Could both parties please provide any additional evidence to support their claims?</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message Input -->
                                    <div class="message-input">
                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label">Send Message</label>
                                                <textarea class="form-control" rows="3" placeholder="Type your message..."></textarea>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon">
                                                    <i class="bi-paperclip"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary">Send Message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <!-- Actions Sidebar -->
                                    <div class="border-start h-100 ps-4">
                                        <h4 class="card-header-title mb-4">Actions</h4>
                                        <div class="mb-4">
                                            <label class="form-label">Assign Mediator</label>
                                            <div class="tom-select-custom">
                                                <select class="js-select form-select" autocomplete="off">
                                                    <option value="">Select mediator</option>
                                                    <option value="1" selected>Sarah Wilson</option>
                                                    <option value="2">Michael Brown</option>
                                                    <option value="3">David Clark</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Update Status</label>
                                            <div class="tom-select-custom">
                                                <select class="js-select form-select" autocomplete="off">
                                                    <option value="pending" selected>Pending</option>
                                                    <option value="in_review">In Review</option>
                                                    <option value="resolved">Resolved</option>
                                                    <option value="closed">Closed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary">Update Dispute</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Tab -->
                    <div class="tab-pane fade" id="timeline">
                        <div class="card-body">
                            <ul class="step step-icon-xs mb-0">
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <small class="step-divider">Jan 15, 2024</small>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-primary">
                                            <i class="bi-folder-plus"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Dispute Opened</h5>
                                            <p class="mb-0">Customer filed dispute for lost package</p>
                                            <small class="text-muted">10:30 AM</small>
                                        </div>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-info">
                                            <i class="bi-chat-dots"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Initial Response</h5>
                                            <p class="mb-0">FastTrack Logistics provided delivery confirmation</p>
                                            <small class="text-muted">2:45 PM</small>
                                        </div>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <small class="step-divider">Jan 16, 2024</small>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-warning">
                                            <i class="bi-person-gear"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Mediator Assigned</h5>
                                            <p class="mb-0">Sarah Wilson assigned as dispute mediator</p>
                                            <small class="text-muted">9:00 AM</small>
                                        </div>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-danger">
                                            <i class="bi-file-earmark-text"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Evidence Requested</h5>
                                            <p class="mb-0">Mediator requested additional documentation from both parties</p>
                                            <small class="text-muted">11:15 AM</small>
                                        </div>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <small class="step-divider">Jan 17, 2024</small>
                                    </div>
                                </li>

                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-success">
                                            <i class="bi-file-earmark-check"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Evidence Submitted</h5>
                                            <p class="mb-0">Both parties submitted requested documentation</p>
                                            <small class="text-muted">3:30 PM</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Evidence Tab -->
                    <div class="tab-pane fade" id="evidence">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="bi-file-pdf fs-3 text-danger"></i>
                                                </div>
                                                <div class="col">
                                                    <h5 class="mb-0">Shipping Receipt</h5>
                                                    <small>PDF, 2.3 MB</small>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="btn btn-white btn-sm">
                                                        <i class="bi-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="bi-image fs-3 text-info"></i>
                                                </div>
                                                <div class="col">
                                                    <h5 class="mb-0">Delivery Photo</h5>
                                                    <small>JPG, 1.8 MB</small>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="btn btn-white btn-sm">
                                                        <i class="bi-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <!-- Upload New Evidence -->
                                    <div class="mt-4">
                                        <h5>Upload New Evidence</h5>
                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label">Document Type</label>
                                                <select class="form-select">
                                                    <option>Select document type</option>
                                                    <option>Shipping Document</option>
                                                    <option>Photo Evidence</option>
                                                    <option>Contract/Agreement</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Upload File</label>
                                                <input type="file" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload Document</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
