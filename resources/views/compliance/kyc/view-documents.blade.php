@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('admin.compliance.kyc.all') }}">KYC Submissions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Documents</li>
                    </ol>
                </nav>

                <h1 class="page-header-title">KYC Documents - #KYC-1001</h1>
            </div>

            <div class="col-sm-auto">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="bi-printer me-1"></i> Print
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="bi-download me-1"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <span class="avatar avatar-lg avatar-circle">
                                <img class="avatar-img" src="https://via.placeholder.com/150" alt="Profile Image">
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">John Smith</h4>
                            <span class="badge bg-primary">Consumer</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">Email</label>
                            <div class="form-text">john.smith@example.com</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">Phone</label>
                            <div class="form-text">+1 234 567 8900</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">Address</label>
                            <div class="form-text">123 Main St, New York, NY 10001</div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">Submission Date</label>
                            <div class="form-text">Mar 15, 2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Tabs -->
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-nav card-nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#id-document" data-bs-toggle="tab">
                        ID Document
                        <span class="badge bg-warning ms-1">Pending</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#proof-address" data-bs-toggle="tab">
                        Proof of Address
                        <span class="badge bg-success ms-1">Approved</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#business-registration" data-bs-toggle="tab">
                        Business Registration
                        <span class="badge bg-danger ms-1">Rejected</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <!-- ID Document Tab -->
                <div class="tab-pane fade show active" id="id-document">
                    <div class="row">
                        <!-- Document Preview -->
                        <div class="col-lg-8">
                            <div class="document-viewer mb-3">
                                <img src="https://via.placeholder.com/800x1000" class="img-fluid" alt="ID Document">
                            </div>
                            
                            <!-- Document Details -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-header-title">Document Details</h4>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-3">Document Type</dt>
                                        <dd class="col-sm-9">National ID</dd>

                                        <dt class="col-sm-3">Submitted</dt>
                                        <dd class="col-sm-9">Mar 15, 2024 10:30 AM</dd>

                                        <dt class="col-sm-3">Status</dt>
                                        <dd class="col-sm-9">
                                            <span class="badge bg-warning">Pending Review</span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Review Section -->
                        <div class="col-lg-4">
                            <!-- Review Actions -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-header-title">Review Actions</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Review Notes</label>
                                            <textarea class="form-control" rows="4" placeholder="Add your review notes..."></textarea>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-success">
                                                <i class="bi-check-circle me-1"></i> Approve Document
                                            </button>
                                            <button type="button" class="btn btn-danger">
                                                <i class="bi-x-circle me-1"></i> Reject Document
                                            </button>
                                            <button type="button" class="btn btn-white">
                                                <i class="bi-question-circle me-1"></i> Request Additional Info
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Review History -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">Review History</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">Document Submitted</h5>
                                                    <small class="text-muted">Mar 15, 2024 10:30 AM</small>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Add more history items as needed -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proof of Address Tab -->
                <div class="tab-pane fade" id="proof-address">
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <img src="{{ asset('svg/illustrations/oc-empty.svg') }}" alt="No Document" 
                                 class="mb-3" style="width: 10rem;">
                        </div>
                        <h3 class="mb-2">No Proof of Address Submitted</h3>
                        <p class="mb-4">This user hasn't submitted any proof of address documents yet.</p>
                        <button type="button" class="btn btn-primary">
                            <i class="bi-bell me-1"></i> Send Document Request
                        </button>
                    </div>
                </div>

                <!-- Business Registration Tab -->
                <div class="tab-pane fade" id="business-registration">
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <img src="{{ asset('svg/illustrations/oc-file.svg') }}" alt="No Document" 
                                 class="mb-3" style="width: 10rem;">
                        </div>
                        <h3 class="mb-2">Business Registration Not Required</h3>
                        <p class="mb-4">Business registration documents are not required for individual consumer accounts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .document-viewer {
        background: #f8f9fa;
        border: 1px solid #e7eaf3;
        border-radius: 0.5rem;
        padding: 1rem;
        text-align: center;
    }
    
    .document-viewer img {
        max-width: 100%;
        height: auto;
    }

    .card-nav-tabs {
        border-bottom: 0;
    }

    .card-nav-tabs .nav-link {
        border: 0;
        border-radius: 0;
        border-bottom: 2px solid transparent;
    }

    .card-nav-tabs .nav-link.active {
        border-bottom-color: #377dff;
    }
</style>
@endpush 