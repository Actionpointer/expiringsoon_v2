@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Insurance Policies</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPolicyModal">
                    <i class="bi-plus me-1"></i> Add Policy
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Policies</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1,248</span>
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
                    <h6 class="card-subtitle mb-2">Total Premium</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$2.4M</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +8%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Expiring Soon</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">42</span>
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

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Claims Ratio</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">3.2%</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-down"></i> -0.5%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0">
                <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" placeholder="Search policies..." aria-label="Search policies">
                        <div class="input-group-append input-group-text">
                            <i class="bi-search"></i>
                        </div>
                    </div>
                    <!-- End Search -->
                </form>
            </div>

            <div class="d-grid d-sm-flex gap-2">
                <!-- Dropdown -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <!-- End Dropdown -->

                <!-- Dropdown -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off">
                        <option value="all">All Types</option>
                        <option value="auto">Commercial Auto</option>
                        <option value="cargo">Cargo</option>
                        <option value="liability">Liability</option>
                    </select>
                </div>
                <!-- End Dropdown -->

                <!-- Export -->
                <div class="dropdown">
                    <button type="button" class="btn btn-white w-100" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-download me-2"></i> Export
                    </button>

                    <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="exportDropdown">
                        <span class="dropdown-header">Options</span>
                        <a class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/illustrations/copy-icon.svg" alt="Image Description">
                            Copy
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/illustrations/print-icon.svg" alt="Image Description">
                            Print
                        </a>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">Download options</span>
                        <a class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/brands/excel-icon.svg" alt="Image Description">
                            Excel
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/components/placeholder-csv-format.svg" alt="Image Description">
                            .CSV
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/brands/pdf-icon.svg" alt="Image Description">
                            PDF
                        </a>
                    </div>
                </div>
                <!-- End Export -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Policy ID</th>
                        <th>Company</th>
                        <th>Insurance Provider</th>
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
                        <td>SafeGuard Insurance</td>
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
                                    <a class="dropdown-item" href="#">Edit Policy</a>
                                    <a class="dropdown-item" href="#">View Claims</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Cancel Policy</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#">POL-1233</a></td>
                        <td>Global Shipping Co</td>
                        <td>SecureFleet Insurance</td>
                        <td>Cargo</td>
                        <td>$1,800/mo</td>
                        <td>Jan 10, 2024</td>
                        <td>
                            <span class="badge bg-soft-success text-success">Active</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="policyDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="policyDropdown2">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Edit Policy</a>
                                    <a class="dropdown-item" href="#">View Claims</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Cancel Policy</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Showing:</span>
                        <div class="tom-select-custom">
                            <select class="js-select form-select form-select-borderless w-auto" autocomplete="off">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50" selected>50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>1,248</span>
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
        <!-- End Footer -->
    </div>
</div>
@endsection 