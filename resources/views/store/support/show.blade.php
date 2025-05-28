@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Ticket #TKT-001</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.support',1) }}" class="text-inherit">Support</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket #TKT-001</li>
                        </ol>
                    </nav>
                </div>
                <!-- back button and close ticket -->
                <div class="d-flex gap-2">
                    <a href="{{ route('store.support',1) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Support
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#closeTicketModal">
                        <i class="bi bi-x-circle me-2"></i>Close Ticket
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticket Details Row -->
    <div class="row mb-6">
        <div class="col-lg-8 mb-6 mb-lg-0">
            <!-- Ticket Information Card -->
            <div class="card card-lg mb-6">
                <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Payment not received for order #1234</h4>
                    <span class="badge bg-light-warning text-dark-warning">In Progress</span>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md me-3">
                                <img src="{{ asset('frontend/images/avatar/avatar-1.jpg') }}" alt="User" class="avatar avatar-md rounded-circle">
                            </div>
                            <div>
                                <h5 class="mb-0">John Vendor</h5>
                                <p class="mb-0 text-muted fs-6">Opened: June 15, 2023 at 10:45 AM</p>
                            </div>
                        </div>
                        <div class="ms-5 ps-3 border-start">
                            <p>I completed an order (#1234) for a customer last week, but I haven't received the payment yet. The order status shows as "Delivered" in my dashboard. When can I expect to receive this payment?</p>
                            <p>Order details:<br>
                            - Order #1234<br>
                            - Amount: $156.78<br>
                            - Delivered on: June 10, 2023</p>
                            <p>Please advise on the payment timeline or if there are any issues with this transaction.</p>
                            
                            <div class="mt-4">
                                <h6 class="mb-2">Attachments:</h6>
                                <div class="d-flex gap-3">
                                    <a href="#" class="d-flex align-items-center text-decoration-none">
                                        <div class="icon-shape icon-sm bg-light-primary text-primary rounded me-2">
                                            <i class="bi bi-file-earmark-image"></i>
                                        </div>
                                        <span class="text-inherit">order-screenshot.jpg</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conversation History -->
            <div class="card card-lg mb-6">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Conversation</h4>
                </div>
                <div class="card-body">
                    <!-- Admin Reply -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md me-3">
                                <img src="{{ asset('frontend/images/avatar/avatar-2.jpg') }}" alt="Admin" class="avatar avatar-md rounded-circle">
                            </div>
                            <div>
                                <h5 class="mb-0">Support Team <span class="badge bg-primary ms-2">Admin</span></h5>
                                <p class="mb-0 text-muted fs-6">June 16, 2023 at 9:30 AM</p>
                            </div>
                        </div>
                        <div class="ms-5 ps-3 border-start">
                            <p>Hello John,</p>
                            <p>Thank you for reaching out about your payment for order #1234.</p>
                            <p>I've checked our payment system and can confirm that the payment is being processed. There is a standard 7-day holding period after delivery confirmation before payments are released to sellers. Since the order was delivered on June 10, you should receive the payment by June 17.</p>
                            <p>You can track the payment status in your Earnings section under "Pending Clearance".</p>
                            <p>Please let me know if you have any other questions!</p>
                            <p>Best regards,<br>Sarah<br>Support Team</p>
                        </div>
                    </div>
                    
                    <!-- User Reply -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md me-3">
                                <img src="{{ asset('frontend/images/avatar/avatar-1.jpg') }}" alt="User" class="avatar avatar-md rounded-circle">
                            </div>
                            <div>
                                <h5 class="mb-0">John Vendor</h5>
                                <p class="mb-0 text-muted fs-6">June 16, 2023 at 11:15 AM</p>
                            </div>
                        </div>
                        <div class="ms-5 ps-3 border-start">
                            <p>Hi Sarah,</p>
                            <p>Thank you for the quick response and explanation. I wasn't aware of the 7-day holding period. I'll check the Earnings section as you suggested.</p>
                            <p>One more question - is this holding period the same for all orders?</p>
                            <p>Thanks,<br>John</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reply Form -->
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Add Reply</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <textarea class="form-control" id="reply" name="reply" rows="5" placeholder="Type your reply here..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="attachments" class="form-label">Attachments (Optional)</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                            <small class="text-muted">You can upload multiple files (max 5MB each)</small>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Send Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Ticket Details -->
            <div class="card card-lg mb-6">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Ticket Details</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Ticket ID:</span>
                            <span class="fw-medium">#TKT-001</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Created:</span>
                            <span class="fw-medium">June 15, 2023</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Last Updated:</span>
                            <span class="fw-medium">June 16, 2023</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Category:</span>
                            <span class="fw-medium">Payment</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Priority:</span>
                            <span class="fw-medium">Medium</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Status:</span>
                            <span class="badge bg-light-warning text-dark-warning">In Progress</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between">
                            <span class="text-muted">Related Order:</span>
                            <a href="#" class="text-primary">#1234</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Similar Issues -->
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Related Articles</h4>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action px-0">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Understanding Payment Processing</h6>
                                    <p class="mb-0 fs-6 text-muted">Learn about payment cycles and holding periods</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-0">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Common Payment Issues</h6>
                                    <p class="mb-0 fs-6 text-muted">Troubleshooting guide for payment problems</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-0">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Tracking Your Earnings</h6>
                                    <p class="mb-0 fs-6 text-muted">How to monitor your store's revenue</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Close Ticket Modal -->
<div class="modal fade" id="closeTicketModal" tabindex="-1" aria-labelledby="closeTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeTicketModalLabel">Close Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to close this ticket? This action will mark the ticket as resolved.</p>
                <form action="#" method="POST" id="closeTicketForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="closeReason" class="form-label">Reason for closing (optional)</label>
                        <textarea class="form-control" id="closeReason" name="close_reason" rows="3" placeholder="Let us know why you're closing this ticket..."></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="satisfiedCheck" name="satisfied" value="1">
                        <label class="form-check-label" for="satisfiedCheck">I'm satisfied with the support I received</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('closeTicketForm').submit()">Close Ticket</button>
            </div>
        </div>
    </div>
</div>
@endsection 