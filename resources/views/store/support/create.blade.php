@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Create Support Ticket</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.support',1) }}" class="text-inherit">Support</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Ticket</li>
                        </ol>
                    </nav>
                </div>
                <!-- back button -->
                <div>
                    <a href="{{ route('store.support',1) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticket Form Row -->
    <div class="row mb-8">
        <div class="col-lg-8">
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Ticket Information</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" required placeholder="Brief description of your issue">
                            <small class="text-muted">Keep it short and descriptive</small>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="" selected disabled>Select a category</option>
                                    <option value="technical">Technical Issue</option>
                                    <option value="account">Account Management</option>
                                    <option value="payment">Payment & Finances</option>
                                    <option value="order">Order Management</option>
                                    <option value="product">Product Management</option>
                                    <option value="shipping">Shipping & Delivery</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                <select class="form-select" id="priority" name="priority" required>
                                    <option value="" selected disabled>Select priority</option>
                                    <option value="low">Low - General question</option>
                                    <option value="medium">Medium - Needs attention</option>
                                    <option value="high">High - Affecting business</option>
                                    <option value="urgent">Urgent - Critical issue</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="order_id" class="form-label">Related Order ID</label>
                            <input type="text" class="form-control" id="order_id" name="order_id" placeholder="e.g. #12345 (if applicable)">
                            <small class="text-muted">Leave blank if not related to a specific order</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Detailed Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" required placeholder="Please provide as much detail as possible about your issue..."></textarea>
                            <small class="text-muted">Include steps to reproduce, expected behavior, and any other relevant information</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="attachments" class="form-label">Attachments</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                            <small class="text-muted">You can upload multiple files (max 5MB each). Accepted formats: jpg, png, pdf, doc, docx, xls, xlsx</small>
                        </div>
                        
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary">Submit Ticket</button>
                            <button type="reset" class="btn btn-outline-secondary ms-2">Reset Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Tips Card -->
            <div class="card card-lg mb-4">
                <div class="card-header bg-white py-4">
                    <h5 class="mb-0">Tips for Faster Resolution</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-1-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Be Specific</h6>
                                    <p class="mb-0 fs-6 fw-normal">Clearly describe what you were doing when the issue occurred</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-2-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Include Screenshots</h6>
                                    <p class="mb-0 fs-6 fw-normal">Visual evidence helps us understand the issue faster</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-3-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Mention Steps</h6>
                                    <p class="mb-0 fs-6 fw-normal">List the steps to reproduce the issue</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                    <i class="bi bi-4-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Check FAQs First</h6>
                                    <p class="mb-0 fs-6 fw-normal">Your issue might already have a documented solution</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Response Time Card -->
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <h5 class="mb-0">Expected Response Time</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-danger text-danger rounded-circle me-3">
                                <i class="bi bi-exclamation-circle"></i>
                            </div>
                            <h6 class="mb-0">Urgent: Within 2 hours</h6>
                        </div>
                        <p class="fs-6 fw-normal text-muted ms-5 mb-0">For critical issues affecting your business operations</p>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-warning text-warning rounded-circle me-3">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <h6 class="mb-0">High: Within 8 hours</h6>
                        </div>
                        <p class="fs-6 fw-normal text-muted ms-5 mb-0">For important issues impacting business functionality</p>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-info text-info rounded-circle me-3">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <h6 class="mb-0">Medium: Within 24 hours</h6>
                        </div>
                        <p class="fs-6 fw-normal text-muted ms-5 mb-0">For general issues needing attention</p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-shape icon-sm bg-light-success text-success rounded-circle me-3">
                                <i class="bi bi-chat-left-text"></i>
                            </div>
                            <h6 class="mb-0">Low: Within 48 hours</h6>
                        </div>
                        <p class="fs-6 fw-normal text-muted ms-5 mb-0">For general questions and inquiries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Simple file validation
    document.getElementById('attachments').addEventListener('change', function() {
        const maxFileSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        
        let files = this.files;
        let fileErrors = [];
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            if (file.size > maxFileSize) {
                fileErrors.push(`File "${file.name}" exceeds the maximum file size of 5MB.`);
            }
            
            if (!allowedTypes.includes(file.type)) {
                fileErrors.push(`File "${file.name}" is not an accepted file type.`);
            }
        }
        
        if (fileErrors.length > 0) {
            alert(fileErrors.join('\n'));
            this.value = ''; // Clear the file input
        }
    });
</script>
@endpush
