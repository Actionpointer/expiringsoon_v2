@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Insurance Claims</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClaimModal">
                    <i class="bi-plus me-1"></i> Add Claim
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Claims</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">428</span>
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
                    <h6 class="card-subtitle mb-2">Claims Value</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$1.2M</span>
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

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Processing Time</h6>
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

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Approval Rate</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">94%</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +2%
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
                        <input type="text" class="form-control" placeholder="Search claims..." aria-label="Search claims">
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
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <!-- End Dropdown -->

                <!-- Dropdown -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off">
                        <option value="all">All Types</option>
                        <option value="vehicle">Vehicle Damage</option>
                        <option value="cargo">Cargo Loss</option>
                        <option value="liability">Liability</option>
                        <option value="injury">Personal Injury</option>
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
                        <th>Claim ID</th>
                        <th>Policy</th>
                        <th>Company</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Filed Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#viewClaimModal">CLM-5678</a></td>
                        <td>POL-1234</td>
                        <td>FastTrack Logistics</td>
                        <td>Vehicle Damage</td>
                        <td>$12,400</td>
                        <td>Mar 15, 2024</td>
                        <td>
                            <span class="badge bg-soft-warning text-warning">Processing</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#viewClaimModal">
                                    <i class="bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                    <i class="bi-pencil"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="claimDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-end mt-1">
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-download dropdown-item-icon"></i> Download Documents
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-chat-left-dots dropdown-item-icon"></i> Add Note
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="bi-x-circle dropdown-item-icon"></i> Mark as Fraud
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#viewClaimModal">CLM-5677</a></td>
                        <td>POL-1235</td>
                        <td>Global Shipping Co</td>
                        <td>Cargo Loss</td>
                        <td>$8,900</td>
                        <td>Mar 14, 2024</td>
                        <td>
                            <span class="badge bg-soft-success text-success">Approved</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#viewClaimModal">
                                    <i class="bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                    <i class="bi-pencil"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="claimDropdown2" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-end mt-1">
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-download dropdown-item-icon"></i> Download Documents
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-chat-left-dots dropdown-item-icon"></i> Add Note
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="bi-x-circle dropdown-item-icon"></i> Mark as Fraud
                                        </a>
                                    </div>
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
                        <span>428</span>
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