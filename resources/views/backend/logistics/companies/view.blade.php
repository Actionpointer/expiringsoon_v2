@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a href="{{ route('admin.logistics.companies') }}">Logistics Companies</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company Profile</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center gap-2">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-lg avatar-circle">
                            <img class="avatar-img" src="https://via.placeholder.com/150" alt="Logo">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h1 class="page-header-title">FastTrack Logistics</h1>
                        <p class="mb-0">ID: LOG-1234 · <span class="badge bg-success">Active</span></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-white btn-sm">
                        <i class="bi-envelope me-1"></i> Message
                    </button>
                    <button type="button" class="btn btn-white btn-sm">
                        <i class="bi-telephone me-1"></i> Call
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Fleet Size</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">42</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                38 Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Drivers</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">28</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                24 On Duty
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Performance Score</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">98%</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> High
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Monthly Deliveries</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1.2K</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +15%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Nav -->
        <div class="card-header border-bottom">
            <ul class="nav nav-tabs card-nav card-nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#info" id="info-tab" data-bs-toggle="tab" role="tab">
                        <i class="bi-building me-1"></i> Company Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#fleet" id="fleet-tab" data-bs-toggle="tab" role="tab">
                        <i class="bi-truck me-1"></i> Fleet
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">42</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#drivers" id="drivers-tab" data-bs-toggle="tab" role="tab">
                        <i class="bi-people me-1"></i> Drivers
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">28</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#performance" id="performance-tab" data-bs-toggle="tab" role="tab">
                        <i class="bi-graph-up me-1"></i> Performance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#documents" id="documents-tab" data-bs-toggle="tab" role="tab">
                        <i class="bi-file-earmark-text me-1"></i> Documents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#activity" id="activity-tab" data-bs-toggle="tab" role="tab">
                        <i class="bi-clock-history me-1"></i> Activity
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Company Info Tab -->
            <div class="tab-pane fade show active" id="info" role="tabpanel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Basic Info -->
                            <div class="mb-4">
                                <h4 class="mb-3">Basic Information</h4>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Company Name</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>FastTrack Logistics</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Registration Number</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>REG123456789</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Operating Since</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>January 2020</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="mb-4">
                                <h4 class="mb-3">Contact Information</h4>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Primary Contact</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>John Smith (Operations Manager)</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Email</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>contact@fasttracklogistics.com</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Phone</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>+1 (555) 123-4567</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <h4 class="mb-3">Address</h4>
                                <div class="row mb-3">
                                    <div class="col-sm-5 mb-2 mb-sm-0">
                                        <div class="text-secondary">Main Office</div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>123 Logistics Way, Suite 100<br>Los Angeles, CA 90001</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Service Areas -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-header-title">Service Areas</h4>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-soft-primary text-primary me-2 mb-2">Los Angeles</span>
                                    <span class="badge bg-soft-primary text-primary me-2 mb-2">San Francisco</span>
                                    <span class="badge bg-soft-primary text-primary me-2 mb-2">San Diego</span>
                                    <span class="badge bg-soft-primary text-primary me-2 mb-2">Las Vegas</span>
                                </div>
                            </div>

                            <!-- Certifications -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">Certifications</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush list-group-no-gutters">
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <i class="bi-check-circle-fill text-success me-2"></i>
                                                <div>DOT Certification</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <i class="bi-check-circle-fill text-success me-2"></i>
                                                <div>ISO 9001:2015</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <i class="bi-check-circle-fill text-success me-2"></i>
                                                <div>FMCSA Registration</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fleet Tab -->
            <div class="tab-pane fade" id="fleet" role="tabpanel">
                <div class="card-body">
                    <!-- Fleet Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Vehicles</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">42</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Active</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">38</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                90.5%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">In Maintenance</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">3</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning text-warning p-1">
                                                Scheduled
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Out of Service</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">1</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-danger text-danger p-1">
                                                Inactive
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fleet List -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between align-items-center flex-grow-1">
                                <div class="col-sm">
                                    <h4 class="card-header-title">Fleet Vehicles</h4>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-2">
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off"
                                                data-hs-tom-select-options='{
                                                    "placeholder": "Status"
                                                }'>
                                                <option value="">All Status</option>
                                                <option value="active">Active</option>
                                                <option value="maintenance">In Maintenance</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off"
                                                data-hs-tom-select-options='{
                                                    "placeholder": "Vehicle Type"
                                                }'>
                                                <option value="">All Types</option>
                                                <option value="truck">Truck</option>
                                                <option value="van">Van</option>
                                                <option value="car">Car</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Vehicle ID</th>
                                        <th>Type</th>
                                        <th>License Plate</th>
                                        <th>Current Driver</th>
                                        <th>Status</th>
                                        <th>Last Maintenance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">VEH-001</a>
                                        </td>
                                        <td>Truck - 10T</td>
                                        <td>ABC 123</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-circle avatar-xs">
                                                    <img class="avatar-img" src="https://via.placeholder.com/150" alt="Driver">
                                                </div>
                                                <div class="ms-2">John Smith</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Active</span>
                                        </td>
                                        <td>Mar 15, 2024</td>
                                        <td>
                                            <button type="button" class="btn btn-white btn-sm">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">VEH-002</a>
                                        </td>
                                        <td>Van - 3T</td>
                                        <td>XYZ 789</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-circle avatar-xs">
                                                    <img class="avatar-img" src="https://via.placeholder.com/150" alt="Driver">
                                                </div>
                                                <div class="ms-2">Mike Johnson</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-warning text-warning">In Maintenance</span>
                                        </td>
                                        <td>Mar 10, 2024</td>
                                        <td>
                                            <button type="button" class="btn btn-white btn-sm">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
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
                                        <span id="datatableWithPaginationInfoTotalQty">42</span>
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

            <!-- Drivers Tab -->
            <div class="tab-pane fade" id="drivers" role="tabpanel">
                <div class="card-body">
                    <!-- Drivers Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Drivers</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">28</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">On Duty</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">24</span>
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

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Off Duty</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">4</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-secondary text-secondary p-1">
                                                Resting
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Avg Rating</h6>
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

                    <!-- Drivers List -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between align-items-center flex-grow-1">
                                <div class="col-sm">
                                    <h4 class="card-header-title">Drivers</h4>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-2">
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off"
                                                data-hs-tom-select-options='{
                                                    "placeholder": "Status"
                                                }'>
                                                <option value="">All Status</option>
                                                <option value="active">On Duty</option>
                                                <option value="off">Off Duty</option>
                                                <option value="leave">On Leave</option>
                                            </select>
                                        </div>
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off"
                                                data-hs-tom-select-options='{
                                                    "placeholder": "Vehicle Type"
                                                }'>
                                                <option value="">All Vehicle Types</option>
                                                <option value="truck">Truck</option>
                                                <option value="van">Van</option>
                                                <option value="car">Car</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Driver</th>
                                        <th>ID</th>
                                        <th>Vehicle Assigned</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                        <th>Deliveries</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-circle">
                                                    <img class="avatar-img" src="https://via.placeholder.com/150" alt="Driver">
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="mb-0">John Smith</h5>
                                                    <small class="text-muted">Since Jan 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>DRV-001</td>
                                        <td>
                                            <span>VEH-001 (Truck)</span>
                                            <small class="d-block text-muted">ABC 123</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">On Duty</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">4.9</span>
                                                <div class="text-warning small">
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>1,248</span>
                                            <small class="d-block text-muted">98% On Time</small>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="driverDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="driverDropdown1">
                                                    <a class="dropdown-item" href="#">View Profile</a>
                                                    <a class="dropdown-item" href="#">View Schedule</a>
                                                    <a class="dropdown-item" href="#">View Performance</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Suspend Driver</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-circle">
                                                    <img class="avatar-img" src="https://via.placeholder.com/150" alt="Driver">
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="mb-0">Mike Johnson</h5>
                                                    <small class="text-muted">Since Mar 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>DRV-002</td>
                                        <td>
                                            <span>VEH-002 (Van)</span>
                                            <small class="d-block text-muted">XYZ 789</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-secondary text-secondary">Off Duty</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">4.7</span>
                                                <div class="text-warning small">
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-half"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>1,086</span>
                                            <small class="d-block text-muted">95% On Time</small>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="driverDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="driverDropdown2">
                                                    <a class="dropdown-item" href="#">View Profile</a>
                                                    <a class="dropdown-item" href="#">View Schedule</a>
                                                    <a class="dropdown-item" href="#">View Performance</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Suspend Driver</a>
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
                                        <span id="datatableWithPaginationInfoTotalQty">28</span>
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

            <!-- Performance Tab -->
            <div class="tab-pane fade" id="performance" role="tabpanel">
                <div class="card-body">
                    <!-- Performance Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">On-Time Delivery</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">98%</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                <i class="bi-graph-up"></i> +2.5%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
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

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Fleet Utilization</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">92%</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
                                                Optimal
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Cost per Delivery</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">$12</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                <i class="bi-graph-down"></i> -8%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Charts -->
                    <div class="row mb-4">
                        <div class="col-lg-8 mb-3 mb-lg-0">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4 class="card-header-title">Delivery Performance Trend</h4>
                                    <div class="dropdown">
                                        <button class="btn btn-ghost-secondary btn-sm" type="button" id="performanceDropdown" data-bs-toggle="dropdown">
                                            Last 30 Days <i class="bi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Last 7 Days</a>
                                            <a class="dropdown-item active" href="#">Last 30 Days</a>
                                            <a class="dropdown-item" href="#">Last 90 Days</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div style="height: 300px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                                            [Performance Chart Placeholder]
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4 class="card-header-title">Delivery Types</h4>
                                </div>
                                <div class="card-body">
                                    <div class="chart mb-4">
                                        <div style="height: 200px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                                            [Pie Chart Placeholder]
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Count</th>
                                                    <th>Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Express</td>
                                                    <td>458</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">45%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar bg-success" style="width: 45%" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Standard</td>
                                                    <td>529</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">55%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar bg-primary" style="width: 55%" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
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
                    </div>

                    <!-- Performance Metrics -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Key Performance Metrics</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Metric</th>
                                        <th>Current</th>
                                        <th>Previous</th>
                                        <th>Change</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Average Delivery Time</td>
                                        <td>45 mins</td>
                                        <td>52 mins</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">
                                                <i class="bi-graph-down"></i> -13%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Good</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Satisfaction</td>
                                        <td>4.8/5.0</td>
                                        <td>4.6/5.0</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">
                                                <i class="bi-graph-up"></i> +4%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Excellent</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vehicle Downtime</td>
                                        <td>2.5%</td>
                                        <td>3.8%</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">
                                                <i class="bi-graph-down"></i> -34%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Good</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                            <span class="display-4 text-dark">24</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
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
                                    <h6 class="card-subtitle mb-2">Expiring Soon</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">3</span>
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

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Pending Review</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">2</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-info text-info p-1">
                                                New
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Storage Used</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">156</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-secondary text-secondary p-1">
                                                MB
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
                            <div class="row justify-content-between align-items-center flex-grow-1">
                                <div class="col-sm">
                                    <h4 class="card-header-title">Document Categories</h4>
                                </div>
                                <div class="col-sm-auto">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi-upload me-1"></i> Upload New
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Category</th>
                                        <th>Documents</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Company Registration -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-folder2 fs-2 text-primary me-2"></i>
                                                <div>
                                                    <h5 class="mb-0">Company Registration</h5>
                                                    <span class="d-block small">Business licenses and permits</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>4 files</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Complete</span>
                                        </td>
                                        <td>Mar 15, 2024</td>
                                        <td>
                                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#folderModal">
                                                <i class="bi-folder2-open me-1"></i> View
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Vehicle Documents -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-folder2 fs-2 text-warning me-2"></i>
                                                <div>
                                                    <h5 class="mb-0">Vehicle Documents</h5>
                                                    <span class="d-block small">Registration and insurance</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12 files</td>
                                        <td>
                                            <span class="badge bg-soft-warning text-warning">2 Expiring</span>
                                        </td>
                                        <td>Mar 10, 2024</td>
                                        <td>
                                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#folderModal">
                                                <i class="bi-folder2-open me-1"></i> View
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Driver Documents -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-folder2 fs-2 text-info me-2"></i>
                                                <div>
                                                    <h5 class="mb-0">Driver Documents</h5>
                                                    <span class="d-block small">Licenses and certifications</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>28 files</td>
                                        <td>
                                            <span class="badge bg-soft-info text-info">1 Pending</span>
                                        </td>
                                        <td>Mar 8, 2024</td>
                                        <td>
                                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#folderModal">
                                                <i class="bi-folder2-open me-1"></i> View
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Insurance -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-folder2 fs-2 text-danger me-2"></i>
                                                <div>
                                                    <h5 class="mb-0">Insurance</h5>
                                                    <span class="d-block small">Company and fleet insurance</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>6 files</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Up to date</span>
                                        </td>
                                        <td>Mar 1, 2024</td>
                                        <td>
                                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#folderModal">
                                                <i class="bi-folder2-open me-1"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Documents -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Recently Updated Documents</h4>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Document</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Updated</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi-file-pdf fs-2 text-danger me-2"></i>
                                                <div>
                                                    <h5 class="mb-0">Vehicle Insurance - VEH001.pdf</h5>
                                                    <span class="d-block small">Expires: Apr 15, 2024</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Vehicle Documents</td>
                                        <td>2.4 MB</td>
                                        <td>2 hours ago</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">Valid</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="documentsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="documentsDropdown1">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-download dropdown-item-icon"></i> Download
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-eye dropdown-item-icon"></i> Preview
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-pencil dropdown-item-icon"></i> Rename
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">
                                                        <i class="bi-trash dropdown-item-icon"></i> Delete
                                                    </a>
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
                                            <span class="display-4 text-dark">24</span>
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
                                    <h6 class="card-subtitle mb-2">Active Deliveries</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">18</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary text-primary p-1">
                                                In Progress
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">System Alerts</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">2</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning text-warning p-1">
                                                Pending
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Completed Today</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">45</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success text-success p-1">
                                                <i class="bi-graph-up"></i> +12%
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
                            <div class="row justify-content-between align-items-center flex-grow-1">
                                <div class="col-sm">
                                    <h4 class="card-header-title">Activity Timeline</h4>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-2">
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off"
                                                data-hs-tom-select-options='{
                                                    "placeholder": "Filter by"
                                                }'>
                                                <option value="">All Activities</option>
                                                <option value="delivery">Deliveries</option>
                                                <option value="system">System</option>
                                                <option value="driver">Driver</option>
                                                <option value="vehicle">Vehicle</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Activity Feed -->
                            <ul class="list-group list-group-flush list-group-no-gutters">
                                <!-- Activity Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="icon icon-soft-success icon-circle">
                                                <i class="bi-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-1">Delivery Completed</h5>
                                                    <span class="d-block small text-muted">Order #12345 delivered successfully by John Smith</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-muted small">2 mins ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Activity Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="icon icon-soft-primary icon-circle">
                                                <i class="bi-truck"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-1">Vehicle Maintenance Completed</h5>
                                                    <span class="d-block small text-muted">Vehicle VEH-002 completed scheduled maintenance</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-muted small">1 hour ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Activity Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="icon icon-soft-warning icon-circle">
                                                <i class="bi-exclamation-triangle"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-1">System Alert</h5>
                                                    <span class="d-block small text-muted">Driver License for Mike Johnson expires in 30 days</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-muted small">2 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Activity Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="icon icon-soft-info icon-circle">
                                                <i class="bi-person"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-1">New Driver Assignment</h5>
                                                    <span class="d-block small text-muted">Sarah Wilson assigned to Vehicle VEH-003</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-muted small">3 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Load More -->
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-ghost-secondary btn-sm">
                                Load More <i class="bi-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 