@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Disputes Management</h1>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="button">
                    <i class="bi-download me-1"></i> Export Report
                </button>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Active Disputes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">45</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-warning text-warning p-1">
                                Pending Resolution
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Courier Disputes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">28</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-danger text-danger p-1">
                                High Priority
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Vehicle Hire Disputes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">12</span>
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

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Warehouse Disputes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">5</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-info text-info p-1">
                                In Review
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
                        <input type="text" class="form-control" placeholder="Search disputes..." aria-label="Search disputes">
                        <button type="button" class="btn btn-ghost-secondary">
                            <i class="bi-search"></i>
                        </button>
                    </div>
                    <!-- End Search -->
                </form>
            </div>

            <div class="d-grid d-sm-flex gap-2">
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{"placeholder": "Status"}'>
                        <option value="">Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_review">In Review</option>
                        <option value="resolved">Resolved</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>

                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{"placeholder": "Dispute Type"}'>
                        <option value="">Dispute Type</option>
                        <option value="courier">Courier</option>
                        <option value="vehicle">Vehicle Hire</option>
                        <option value="warehouse">Warehouse</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Dispute ID</th>
                        <th>Type</th>
                        <th>Parties Involved</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <a href="{{ route('admin.support.disputes.view', ['id' => 'DSP-1234']) }}">
                                <span class="text-primary">DSP-1234</span>
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-soft-danger text-danger">Courier</span>
                            <small class="d-block">Lost Package</small>
                        </td>
                        <td>
                            <div class="text-wrap" style="width: 200px;">
                                <span class="d-block">FastTrack Logistics vs John Doe</span>
                                <small class="text-muted">Package ID: PKG-78901</small>
                            </div>
                        </td>
                        <td>$1,500.00</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Jan 15, 2024</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="disputeDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="disputeDropdown1">
                                    <a class="dropdown-item" href="{{ route('admin.support.disputes.view', ['id' => 'DSP-1234']) }}">View Details</a>
                                    <a class="dropdown-item" href="#">Assign to Staff</a>
                                    <a class="dropdown-item" href="#">Mark as Priority</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Close Dispute</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="{{ route('admin.support.disputes.view', ['id' => 'DSP-1235']) }}">
                                <span class="text-primary">DSP-1235</span>
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-soft-primary text-primary">Vehicle</span>
                            <small class="d-block">Contract Breach</small>
                        </td>
                        <td>
                            <div class="text-wrap" style="width: 200px;">
                                <span class="d-block">City Movers vs Smith Corp</span>
                                <small class="text-muted">Contract ID: CNT-45678</small>
                            </div>
                        </td>
                        <td>$3,200.00</td>
                        <td><span class="badge bg-info">In Review</span></td>
                        <td>Jan 14, 2024</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="disputeDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="disputeDropdown2">
                                    <a class="dropdown-item" href="{{ route('admin.support.disputes.view', ['id' => 'DSP-1235']) }}">View Details</a>
                                    <a class="dropdown-item" href="#">Assign to Staff</a>
                                    <a class="dropdown-item" href="#">Mark as Priority</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Close Dispute</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="{{ route('admin.support.disputes.view', ['id' => 'DSP-1236']) }}">
                                <span class="text-primary">DSP-1236</span>
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-soft-info text-info">Warehouse</span>
                            <small class="d-block">Storage Damage</small>
                        </td>
                        <td>
                            <div class="text-wrap" style="width: 200px;">
                                <span class="d-block">SafeStore Warehouse vs Tech Solutions</span>
                                <small class="text-muted">Storage ID: STR-34567</small>
                            </div>
                        </td>
                        <td>$5,800.00</td>
                        <td><span class="badge bg-success">Resolved</span></td>
                        <td>Jan 12, 2024</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="disputeDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="disputeDropdown3">
                                    <a class="dropdown-item" href="{{ route('admin.support.disputes.view', ['id' => 'DSP-1236']) }}">View Details</a>
                                    <a class="dropdown-item" href="#">View Resolution</a>
                                    <a class="dropdown-item" href="#">Download Report</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span id="datatableWithPaginationInfoTotalQty">45</span>
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
@endsection 