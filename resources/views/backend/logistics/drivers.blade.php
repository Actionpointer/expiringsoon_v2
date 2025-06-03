@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Drivers Management</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary btn-add">
                    <i class="bi-plus me-1"></i> Add Driver
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Drivers</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">452</span>
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
                    <h6 class="card-subtitle mb-2">On Duty</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">384</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                85%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Average Rating</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">4.7</span>
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

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">License Renewals</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">12</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-warning text-warning p-1">
                                Due Soon
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Distribution -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Driver Distribution by Company</h4>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div style="height: 300px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                            [Distribution Chart Placeholder]
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Performance Overview</h4>
                </div>
                <div class="card-body">
                    <div class="chart mb-4">
                        <div style="height: 200px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                            [Performance Chart Placeholder]
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Rating</th>
                                    <th>Drivers</th>
                                    <th>Distribution</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>5.0 ★</td>
                                    <td>156</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">35%</span>
                                            <div class="progress table-progress">
                                                <div class="progress-bar bg-success" style="width: 35%" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.0-4.9 ★</td>
                                    <td>245</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">54%</span>
                                            <div class="progress table-progress">
                                                <div class="progress-bar bg-primary" style="width: 54%" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Below 4.0 ★</td>
                                    <td>51</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">11%</span>
                                            <div class="progress table-progress">
                                                <div class="progress-bar bg-warning" style="width: 11%" role="progressbar"></div>
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

    <!-- Global Drivers Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-sm">
                    <h4 class="card-header-title">Global Drivers Overview</h4>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex gap-2">
                        <div class="tom-select-custom">
                            <select class="js-select form-select" autocomplete="off">
                                <option value="">All Companies</option>
                                <option value="1">FastTrack Logistics</option>
                                <option value="2">SpeedCargo Express</option>
                                <option value="3">Global Freight Co.</option>
                            </select>
                        </div>
                        <div class="tom-select-custom">
                            <select class="js-select form-select" autocomplete="off">
                                <option value="">All Status</option>
                                <option value="active">On Duty</option>
                                <option value="inactive">Off Duty</option>
                                <option value="leave">On Leave</option>
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
                        <th>Company</th>
                        <th>Status</th>
                        <th>Vehicle Assigned</th>
                        <th>Rating</th>
                        <th>Deliveries</th>
                        <th>License Expiry</th>
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
                                    <small class="text-muted">ID: DRV-001</small>
                                </div>
                            </div>
                        </td>
                        <td>FastTrack Logistics</td>
                        <td><span class="badge bg-soft-success text-success">On Duty</span></td>
                        <td>VEH-001 (Truck)</td>
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
                            <span class="text-success">Valid</span>
                            <small class="d-block text-muted">Until Dec 2024</small>
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
                    <!-- Add more driver rows -->
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
                        <span>452</span>
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