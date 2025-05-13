@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('admin.insurance.companies') }}">Insurance Companies</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SafeGuard Insurance</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">SafeGuard Insurance</h1>
            </div>
            <div class="col-sm-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-white">
                        <i class="bi-download me-2"></i> Download Report
                    </button>

                    <!-- Unfold -->
                    <div class="hs-unfold btn-group">
                        <button type="button" class="btn btn-white dropdown-toggle" id="companySettingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-gear"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="companySettingsDropdown">
                            <a class="dropdown-item" href="#">Edit Company</a>
                            <a class="dropdown-item" href="#">Manage Policies</a>
                            <a class="dropdown-item" href="#">Update Contract</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#">Deactivate</a>
                        </div>
                    </div>
                    <!-- End Unfold -->
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Policies</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">324</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +5.3%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Monthly Premium</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$648K</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +8.2%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Claims Ratio</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2.8%</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-down"></i> -0.4%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Customer Rating</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">4.8</span>
                        </div>
                        <div class="col-auto">
                            <div class="text-warning">
                                <i class="bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Nav -->
        <div class="card-header">
            <ul class="nav nav-tabs card-nav" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#overview" id="overview-tab" data-bs-toggle="tab" role="tab">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#policies" id="policies-tab" data-bs-toggle="tab" role="tab">
                        Policies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#claims" id="claims-tab" data-bs-toggle="tab" role="tab">
                        Claims
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#documents" id="documents-tab" data-bs-toggle="tab" role="tab">
                        Documents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#activity" id="activity-tab" data-bs-toggle="tab" role="tab">
                        Activity
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Company Information Card -->
                            <div class="card mb-3 mb-lg-5">
                                <div class="card-header">
                                    <h4 class="card-header-title">Company Information</h4>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled list-py-2 mb-0">
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Company ID:</dt>
                                                <dd class="col-sm-8">INS-001</dd>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Status:</dt>
                                                <dd class="col-sm-8">
                                                    <span class="badge bg-soft-success text-success">Active</span>
                                                </dd>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Type:</dt>
                                                <dd class="col-sm-8">Commercial Insurance</dd>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Founded:</dt>
                                                <dd class="col-sm-8">1995</dd>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Website:</dt>
                                                <dd class="col-sm-8">
                                                    <a href="#">www.safeguard-insurance.com</a>
                                                </dd>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Card -->

                            <!-- Contact Information Card -->
                            <div class="card mb-3 mb-lg-5">
                                <div class="card-header">
                                    <h4 class="card-header-title">Contact Information</h4>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled list-py-2 mb-0">
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Address:</dt>
                                                <dd class="col-sm-8">123 Insurance Ave, Suite 500<br>New York, NY 10001</dd>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Email:</dt>
                                                <dd class="col-sm-8">contact@safeguard-insurance.com</dd>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <dt class="col-sm-4">Phone:</dt>
                                                <dd class="col-sm-8">+1 (555) 123-4567</dd>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>

                        <div class="col-lg-8">
                            <!-- Performance Overview Card -->
                            <div class="card mb-3 mb-lg-5">
                                <div class="card-header">
                                    <h4 class="card-header-title">Performance Overview</h4>
                                </div>

                                <div class="card-body">
                                    <div class="chart">
                                        <div style="height: 300px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                                            [Performance Chart Placeholder]
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->

                            <!-- Recent Activity Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">Recent Activity</h4>
                                </div>

                                <div class="card-body">
                                    <!-- Step -->
                                    <ul class="step step-icon-sm">
                                        <!-- Step Item -->
                                        <li class="step-item">
                                            <div class="step-content-wrapper">
                                                <small class="step-divider">Today</small>
                                            </div>
                                        </li>
                                        <!-- End Step Item -->

                                        <!-- Step Item -->
                                        <li class="step-item">
                                            <div class="step-content-wrapper">
                                                <span class="step-icon step-icon-soft-success">P</span>
                                                <div class="step-content">
                                                    <h5>New policy issued</h5>
                                                    <p class="mb-0">Policy #POL-1234 for FastTrack Logistics</p>
                                                    <small class="text-muted">2 hours ago</small>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- End Step Item -->

                                        <!-- Step Item -->
                                        <li class="step-item">
                                            <div class="step-content-wrapper">
                                                <span class="step-icon step-icon-soft-warning">C</span>
                                                <div class="step-content">
                                                    <h5>Claim processed</h5>
                                                    <p class="mb-0">Claim #CLM-5678 approved for $12,400</p>
                                                    <small class="text-muted">5 hours ago</small>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- End Step Item -->
                                    </ul>
                                    <!-- End Step -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Overview Tab -->

            <!-- Policies Tab -->
            <div class="tab-pane fade" id="policies" role="tabpanel">
                <div class="card-body">
                    <!-- Policies Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Policies</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">324</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                Active
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">New Policies</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">28</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
                                                This Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Renewal Rate</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">94%</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                <i class="bi-graph-up"></i> +2.3%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Expiring Soon</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">12</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning text-warning p-1">
                                                30 Days
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Policies Table -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Active Policies</h4>
                            <div class="d-flex gap-2">
                                <div class="tom-select-custom">
                                    <select class="js-select form-select" autocomplete="off">
                                        <option value="all">All Types</option>
                                        <option value="auto">Commercial Auto</option>
                                        <option value="cargo">Cargo</option>
                                        <option value="liability">Liability</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="button">
                                    <i class="bi-plus me-1"></i> New Policy
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Policy ID</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Premium</th>
                                        <th>Start Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">POL-1234</a></td>
                                        <td>FastTrack Logistics</td>
                                        <td>Commercial Auto</td>
                                        <td>$2,400/mo</td>
                                        <td>Jan 15, 2024</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Active</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="policyDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="policyDropdown1">
                                                    <a class="dropdown-item" href="#">View Details</a>
                                                    <a class="dropdown-item" href="#">Download Policy</a>
                                                    <a class="dropdown-item" href="#">View Claims</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Cancel Policy</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Add more policy rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Claims Tab -->
            <div class="tab-pane fade" id="claims" role="tabpanel">
                <div class="card-body">
                    <!-- Claims Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Claims</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">108</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
                                                YTD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Open Claims</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">24</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning text-warning p-1">
                                                In Process
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Claims Paid</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">$1.2M</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                YTD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Avg Processing Time</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">5.2</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                Days
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Claims Table -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Claims History</h4>
                            <div class="d-flex gap-2">
                                <div class="tom-select-custom">
                                    <select class="js-select form-select" autocomplete="off">
                                        <option value="all">All Status</option>
                                        <option value="open">Open</option>
                                        <option value="processing">Processing</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="button">
                                    <i class="bi-download me-1"></i> Export
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Claim ID</th>
                                        <th>Policy</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Filed Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">CLM-1234</a></td>
                                        <td>POL-5678</td>
                                        <td>Vehicle Damage</td>
                                        <td>$12,400</td>
                                        <td>Mar 15, 2024</td>
                                        <td>
                                            <span class="badge bg-soft-warning text-warning">Processing</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="claimDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="claimDropdown1">
                                                    <a class="dropdown-item" href="#">View Details</a>
                                                    <a class="dropdown-item" href="#">View Documents</a>
                                                    <a class="dropdown-item" href="#">Update Status</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Mark as Fraud</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><a href="#">CLM-1233</a></td>
                                        <td>POL-5679</td>
                                        <td>Cargo Loss</td>
                                        <td>$8,900</td>
                                        <td>Mar 14, 2024</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Approved</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="claimDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="claimDropdown2">
                                                    <a class="dropdown-item" href="#">View Details</a>
                                                    <a class="dropdown-item" href="#">View Documents</a>
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer">
                            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                <div class="col-sm mb-2 mb-sm-0">
                                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                        <span class="me-2">Showing:</span>
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select form-select-borderless w-auto" autocomplete="off">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <span class="text-secondary me-2">of</span>
                                        <span>108</span>
                                    </div>
                                </div>

                                <div class="col-sm-auto">
                                    <div class="d-flex justify-content-center justify-content-sm-end">
                                        <nav id="datatablePagination" aria-label="Activity pagination">
                                            <div class="pagination pagination-sm">
                                                <span class="page-item disabled">
                                                    <span class="page-link">Prev</span>
                                                </span>
                                                <span class="page-item active"><span class="page-link">1</span></span>
                                                <span class="page-item"><span class="page-link">2</span></span>
                                                <span class="page-item"><span class="page-link">3</span></span>
                                                <span class="page-item"><span class="page-link">Next</span></span>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card-body">
                    <!-- Document Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Documents</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">156</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
                                                Files
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Storage Used</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">2.4</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-info text-info p-1">
                                                GB
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Recent Uploads</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">12</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                This Week
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Expiring Soon</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">5</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning text-warning p-1">
                                                30 Days
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Categories -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-header-title">Document Categories</h4>
                            <button class="btn btn-primary btn-sm" type="button">
                                <i class="bi-plus me-1"></i> Add Category
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Category</th>
                                        <th>Files</th>
                                        <th>Size</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-folder2 fs-2 text-warning me-2"></i>
                                                <span>Policy Documents</span>
                                            </div>
                                        </td>
                                        <td>48</td>
                                        <td>856 MB</td>
                                        <td>Mar 15, 2024</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="categoryDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="categoryDropdown1">
                                                    <a class="dropdown-item" href="#">View Files</a>
                                                    <a class="dropdown-item" href="#">Rename</a>
                                                    <a class="dropdown-item" href="#">Move</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-folder2 fs-2 text-warning me-2"></i>
                                                <span>Claims Documentation</span>
                                            </div>
                                        </td>
                                        <td>64</td>
                                        <td>1.2 GB</td>
                                        <td>Mar 14, 2024</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="categoryDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="categoryDropdown2">
                                                    <a class="dropdown-item" href="#">View Files</a>
                                                    <a class="dropdown-item" href="#">Rename</a>
                                                    <a class="dropdown-item" href="#">Move</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Documents -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Recent Documents</h4>
                            <div class="d-flex gap-2">
                                <div class="tom-select-custom">
                                    <select class="js-select form-select" autocomplete="off">
                                        <option value="all">All Types</option>
                                        <option value="pdf">PDF</option>
                                        <option value="doc">Word</option>
                                        <option value="image">Images</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="button">
                                    <i class="bi-upload me-1"></i> Upload
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>File Name</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Uploaded</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-file-pdf fs-2 text-danger me-2"></i>
                                                <span>Policy-Agreement-2024.pdf</span>
                                            </div>
                                        </td>
                                        <td>Policy Documents</td>
                                        <td>2.4 MB</td>
                                        <td>Mar 15, 2024</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-white btn-sm">
                                                    <i class="bi-download"></i>
                                                </button>
                                                <button type="button" class="btn btn-white btn-sm">
                                                    <i class="bi-eye"></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="documentDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                    <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="documentDropdown1">
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <a class="dropdown-item" href="#">Move</a>
                                                        <a class="dropdown-item" href="#">Share</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Tab -->
            <div class="tab-pane fade" id="activity" role="tabpanel">
                <div class="card-body">
                    <!-- Activity Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Today's Activities</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">18</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                Events
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Policy Updates</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">8</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
                                                Today
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Claims Activity</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">6</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning text-warning p-1">
                                                Processing
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Document Activity</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">4</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-info text-info p-1">
                                                Updates
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Activity Timeline</h4>
                            <div class="d-flex gap-2">
                                <div class="tom-select-custom">
                                    <select class="js-select form-select" autocomplete="off">
                                        <option value="all">All Activities</option>
                                        <option value="policies">Policies</option>
                                        <option value="claims">Claims</option>
                                        <option value="documents">Documents</option>
                                    </select>
                                </div>
                                <button class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Report">
                                    <i class="bi-download"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Step -->
                            <ul class="step step-icon-sm">
                                <!-- Step Item -->
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <small class="step-divider">Today</small>
                                    </div>
                                </li>

                                <!-- Step Item -->
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-primary">
                                            <i class="bi-file-text"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>New policy issued</h5>
                                            <p class="mb-0">Policy #POL-1234 for FastTrack Logistics</p>
                                            <small class="text-muted">2 hours ago - by John Smith</small>
                                        </div>
                                    </div>
                                </li>

                                <!-- Step Item -->
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-warning">
                                            <i class="bi-exclamation-triangle"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Claim submitted</h5>
                                            <p class="mb-0">New claim #CLM-5678 for vehicle damage</p>
                                            <small class="text-muted">4 hours ago - by Sarah Johnson</small>
                                        </div>
                                    </div>
                                </li>

                                <!-- Step Item -->
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-success">
                                            <i class="bi-check-lg"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Claim approved</h5>
                                            <p class="mb-0">Claim #CLM-5677 approved for $8,900</p>
                                            <small class="text-muted">Yesterday at 5:30 PM - by Admin Team</small>
                                        </div>
                                    </div>
                                </li>

                                <!-- Step Item -->
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-info">
                                            <i class="bi-upload"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Documents uploaded</h5>
                                            <p class="mb-0">Updated policy documentation for Q2 2024</p>
                                            <small class="text-muted">Yesterday at 2:15 PM - by Mary Wilson</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-ghost-secondary btn-sm">
                                View All Activity <i class="bi-chevron-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 