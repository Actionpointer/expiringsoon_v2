@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Fleet Management</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary btn-add">
                    <i class="bi-plus me-1"></i> Add Vehicle
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Fleet Size</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">384</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                Across 45 Companies
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Average Age</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2.4</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                Years
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Maintenance Cost</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$2.1M</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-danger text-danger p-1">
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
                    <h6 class="card-subtitle mb-2">Utilization Rate</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">92%</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +5%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fleet Distribution -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Fleet Distribution by Company</h4>
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
                    <h4 class="card-header-title">Vehicle Types</h4>
                </div>
                <div class="card-body">
                    <div class="chart mb-4">
                        <div style="height: 200px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                            [Vehicle Types Chart Placeholder]
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Type</th>
                                    <th>Count</th>
                                    <th>Distribution</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Heavy Trucks</td>
                                    <td>156</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">40%</span>
                                            <div class="progress table-progress">
                                                <div class="progress-bar" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vans</td>
                                    <td>124</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">32%</span>
                                            <div class="progress table-progress">
                                                <div class="progress-bar" style="width: 32%" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Light Trucks</td>
                                    <td>104</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">28%</span>
                                            <div class="progress table-progress">
                                                <div class="progress-bar" style="width: 28%" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
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

    <!-- Global Fleet Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-sm">
                    <h4 class="card-header-title">Global Fleet Overview</h4>
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
                                <option value="">All Types</option>
                                <option value="heavy">Heavy Trucks</option>
                                <option value="light">Light Trucks</option>
                                <option value="van">Vans</option>
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
                        <th>Company</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Age</th>
                        <th>Last Maintenance</th>
                        <th>Utilization</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#">VEH-001</a></td>
                        <td>FastTrack Logistics</td>
                        <td>Heavy Truck</td>
                        <td><span class="badge bg-soft-success text-success">Active</span></td>
                        <td>1.5 years</td>
                        <td>Mar 15, 2024</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-2">95%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar bg-success" style="width: 95%" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="vehicleDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="vehicleDropdown1">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">View History</a>
                                    <a class="dropdown-item" href="#">Schedule Maintenance</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Mark Inactive</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more vehicle rows -->
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
                        <span>384</span>
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