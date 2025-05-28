@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Support Center</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Support</li>
                        </ol>
                    </nav>
                </div>
                <!-- create ticket button -->
                <div>
                    <a href="{{ route('store.support.create',1) }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>New Support Ticket
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-6">
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">3</h4>
                            <p class="mb-0 fs-6">Open Tickets</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-warning text-warning rounded-3">
                            <i class="bi bi-ticket-perforated fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">0</h4>
                            <p class="mb-0 fs-6">Pending Tickets</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-info text-info rounded-3">
                            <i class="bi bi-hourglass-split fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">12</h4>
                            <p class="mb-0 fs-6">Closed Tickets</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-success text-success rounded-3">
                            <i class="bi bi-check-circle fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">24h</h4>
                            <p class="mb-0 fs-6">Avg. Response Time</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-primary text-primary rounded-3">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search Row -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card card-lg">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select class="form-select">
                                <option selected>All Status</option>
                                <option>Open</option>
                                <option>In Progress</option>
                                <option>Pending</option>
                                <option>Closed</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select">
                                <option selected>Sort By: Newest First</option>
                                <option>Sort By: Oldest First</option>
                                <option>Sort By: Priority (High-Low)</option>
                                <option>Sort By: Priority (Low-High)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search tickets...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tickets Table Row -->
    <div class="row mb-8">
        <div class="col-lg-12">
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Your Support Tickets</h4>
                </div>
                <div class="card-body p-0">
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fs-6 fw-normal">Ticket ID</th>
                                    <th class="fs-6 fw-normal">Subject</th>
                                    <th class="fs-6 fw-normal">Category</th>
                                    <th class="fs-6 fw-normal">Created</th>
                                    <th class="fs-6 fw-normal">Last Updated</th>
                                    <th class="fs-6 fw-normal">Status</th>
                                    <th class="fs-6 fw-normal">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample tickets -->
                                <tr>
                                    <td>#TKT-001</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-2">
                                                <i class="bi bi-ticket"></i>
                                            </div>
                                            <h5 class="mb-0 fs-6 fw-normal">Payment not received for order #1234</h5>
                                        </div>
                                    </td>
                                    <td>Payment</td>
                                    <td>2023-06-15</td>
                                    <td>2023-06-16</td>
                                    <td><span class="badge bg-light-warning text-dark-warning">In Progress</span></td>
                                    <td>
                                        <a href="{{ route('store.support.show', [1,1]) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#TKT-002</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-2">
                                                <i class="bi bi-ticket"></i>
                                            </div>
                                            <h5 class="mb-0 fs-6 fw-normal">How to set up shipping for international orders?</h5>
                                        </div>
                                    </td>
                                    <td>Shipping</td>
                                    <td>2023-06-10</td>
                                    <td>2023-06-12</td>
                                    <td><span class="badge bg-light-success text-dark-success">Closed</span></td>
                                    <td>
                                        <a href="{{ route('store.support.show', [2,1]) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#TKT-003</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-2">
                                                <i class="bi bi-ticket"></i>
                                            </div>
                                            <h5 class="mb-0 fs-6 fw-normal">Need help with product image upload</h5>
                                        </div>
                                    </td>
                                    <td>Technical</td>
                                    <td>2023-06-18</td>
                                    <td>2023-06-18</td>
                                    <td><span class="badge bg-light-info text-dark-info">Open</span></td>
                                    <td>
                                        <a href="{{ route('store.support.show', [3,1]) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Help & FAQs Section -->
    <div class="row mb-8">
        <div class="col-lg-12">
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Common Questions & Resources</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="mb-4">
                                <h5>Frequently Asked Questions</h5>
                                <div class="accordion" id="faqAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                How do I process refunds?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="fs-6 fw-normal mb-0">To process a refund, go to Orders, select the specific order, and click the Refund button. You can choose between partial or full refunds depending on the situation.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                When will I receive my payments?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="fs-6 fw-normal mb-0">Payments are processed every 14 days for all orders that have been successfully delivered and have passed the return period. You can view your payment schedule in the Earnings section.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                How do I update my store information?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="fs-6 fw-normal mb-0">Go to Store Settings to update your store information, including your store name, description, logo, banner, and contact details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Helpful Resources</h5>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-file-earmark-text me-3 text-primary fs-4"></i>
                                    <div>
                                        <h6 class="mb-1">Seller Guidelines</h6>
                                        <p class="mb-0 fs-6 fw-normal text-muted">Learn about our policies and best practices</p>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-play-circle me-3 text-primary fs-4"></i>
                                    <div>
                                        <h6 class="mb-1">Video Tutorials</h6>
                                        <p class="mb-0 fs-6 fw-normal text-muted">Step-by-step guides on using the platform</p>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-book me-3 text-primary fs-4"></i>
                                    <div>
                                        <h6 class="mb-1">Knowledge Base</h6>
                                        <p class="mb-0 fs-6 fw-normal text-muted">Detailed articles on all platform features</p>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-calendar-event me-3 text-primary fs-4"></i>
                                    <div>
                                        <h6 class="mb-1">Webinars & Events</h6>
                                        <p class="mb-0 fs-6 fw-normal text-muted">Join live sessions with our experts</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
