@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Insurance Companies</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                    <i class="bi-plus me-1"></i> Add Company
                </a>
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
                        <input type="text" class="form-control" placeholder="Search companies..." aria-label="Search companies">
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
                    <select class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                        "placeholder": "Status"
                    }'>
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <!-- End Dropdown -->

                <!-- Dropdown -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                        "placeholder": "Policy Type"
                    }'>
                        <option value="">All Types</option>
                        <option value="auto">Commercial Auto</option>
                        <option value="cargo">Cargo</option>
                        <option value="liability">Liability</option>
                    </select>
                </div>
                <!-- End Dropdown -->

                <!-- Dropdown -->
                <div class="dropdown">
                    <button type="button" class="btn btn-white w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-download me-2"></i> Export
                    </button>

                    <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown">
                        <span class="dropdown-header">Options</span>
                        <a id="export-copy" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/illustrations/copy-icon.svg" alt="Image Description">
                            Copy
                        </a>
                        <a id="export-print" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/illustrations/print-icon.svg" alt="Image Description">
                            Print
                        </a>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">Download options</span>
                        <a id="export-excel" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/brands/excel-icon.svg" alt="Image Description">
                            Excel
                        </a>
                        <a id="export-csv" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/components/placeholder-csv-format.svg" alt="Image Description">
                            .CSV
                        </a>
                        <a id="export-pdf" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="../assets/svg/brands/pdf-icon.svg" alt="Image Description">
                            PDF
                        </a>
                    </div>
                </div>
                <!-- End Dropdown -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Company</th>
                        <th>Active Policies</th>
                        <th>Premium Revenue</th>
                        <th>Claims Ratio</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="{{ route('admin.insurance.companies.view', ['id' => 'INS-001']) }}">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="https://via.placeholder.com/150" alt="Logo">
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">SafeGuard Insurance</span>
                                    <span class="d-block fs-5 text-body">Commercial Auto, Cargo</span>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="d-block h5 mb-0">324</span>
                            <span class="d-block fs-5 text-body">12% Market Share</span>
                        </td>
                        <td>
                            <span class="d-block h5 mb-0">$648,000</span>
                            <span class="d-block fs-5 text-body">Monthly</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-2">2.8%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar bg-success" style="width: 28%" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-success text-success">Active</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="companiesDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="companiesDropdown1">
                                    <a class="dropdown-item" href="{{ route('admin.insurance.companies.view', ['id' => 'INS-001']) }}">View Details</a>
                                    <a class="dropdown-item" href="#">View Policies</a>
                                    <a class="dropdown-item" href="#">View Claims</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Deactivate</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="{{ route('admin.insurance.companies.view', ['id' => 'INS-002']) }}">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="https://via.placeholder.com/150" alt="Logo">
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">Global Protect</span>
                                    <span class="d-block fs-5 text-body">All Coverage Types</span>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="d-block h5 mb-0">256</span>
                            <span class="d-block fs-5 text-body">9% Market Share</span>
                        </td>
                        <td>
                            <span class="d-block h5 mb-0">$512,000</span>
                            <span class="d-block fs-5 text-body">Monthly</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-2">3.1%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar bg-success" style="width: 31%" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-success text-success">Active</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="companiesDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="companiesDropdown2">
                                    <a class="dropdown-item" href="{{ route('admin.insurance.companies.view', ['id' => 'INS-002']) }}">View Details</a>
                                    <a class="dropdown-item" href="#">View Policies</a>
                                    <a class="dropdown-item" href="#">View Claims</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Deactivate</a>
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
                        <!-- Select -->
                        <div class="tom-select-custom">
                            <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                                "searchInDropdown": false,
                                "hideSearch": true
                              }'>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50" selected>50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <!-- End Select -->
                        <span class="text-secondary me-2">of</span>
                        <span>28</span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
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