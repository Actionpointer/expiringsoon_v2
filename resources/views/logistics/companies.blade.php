@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Logistics Companies</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary btn-add">
                    <i class="bi-plus me-1"></i> Add Company
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Companies</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">45</span>
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
                    <h6 class="card-subtitle mb-2">Pending Approval</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">8</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-warning text-warning p-1">
                                New
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Fleet Size</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">384</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                Vehicles
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Drivers</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">256</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                On Duty
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
                        <input type="text" class="form-control" placeholder="Search companies..." aria-label="Search companies">
                        <button type="button" class="btn btn-ghost-secondary">
                            <i class="bi-search"></i>
                        </button>
                    </div>
                    <!-- End Search -->
                </form>
            </div>

            <div class="d-grid d-sm-flex gap-2">
                <button class="btn btn-white" type="button">
                    <i class="bi-funnel me-1"></i> Filters
                </button>

                <button class="btn btn-white" type="button">
                    <i class="bi-download me-1"></i> Export
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Company</th>
                        <th>Fleet Size</th>
                        <th>Active Drivers</th>
                        <th>Performance</th>
                        <th>Status</th>
                        <th>Last Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-sm avatar-4x3 me-3" src="https://via.placeholder.com/150" alt="Logo">
                                <div>
                                    <a class="d-inline-block link-dark" href="{{ route('admin.logistics.companies.view', ['id' => 'LOG-1234']) }}">
                                        <h6 class="text-hover-primary mb-0">FastTrack Logistics</h6>
                                    </a>
                                    <small class="d-block">ID: LOG-1234</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>42 Vehicles</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">38 Active</span>
                                <span class="text-warning">4 Maintenance</span>
                            </div>
                        </td>
                        <td>
                            <span>28 Drivers</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">24 On Duty</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fs-6 me-2">98%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar bg-success" style="width: 98%" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-success text-success">Active</span>
                        </td>
                        <td>2 mins ago</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="companiesDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="companiesDropdown1">
                                    <a class="dropdown-item" href="{{ route('admin.logistics.companies.view', ['id' => 'LOG-1234']) }}">View Details</a>
                                    <a class="dropdown-item" href="#">View Fleet</a>
                                    <a class="dropdown-item" href="#">View Drivers</a>
                                    <a class="dropdown-item" href="#">View Performance</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Suspend</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Add more company rows here -->
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