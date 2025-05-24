@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Logistics Overview</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <div class="tom-select-custom">
                        <select class="js-select form-select" autocomplete="off">
                            <option value="30">Last 30 Days</option>
                            <option value="60">Last 60 Days</option>
                            <option value="90">Last 90 Days</option>
                            <option value="365">Last Year</option>
                        </select>
                    </div>
                    <button class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Report">
                        <i class="bi-download"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
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
                    <h6 class="card-subtitle mb-2">Total Fleet</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">384</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                92% Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Drivers</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">452</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                85% On Duty
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Monthly Revenue</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$5.2M</span>
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

    <!-- Performance Metrics -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Performance Trends</h4>
                    <div class="dropdown">
                        <button class="btn btn-ghost-secondary btn-sm" type="button" id="performanceDropdown" data-bs-toggle="dropdown">
                            <i class="bi-graph-up"></i> Metrics <i class="bi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#">On-Time Delivery</a>
                            <a class="dropdown-item" href="#">Customer Satisfaction</a>
                            <a class="dropdown-item" href="#">Revenue</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div style="height: 300px;" class="d-flex align-items-center justify-content-center bg-soft-primary">
                            [Performance Trends Chart Placeholder]
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Top Performing Companies</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Company</th>
                                    <th>Score</th>
                                    <th>Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>FastTrack Logistics</td>
                                    <td>98.5%</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi-graph-up"></i> +2.1%
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SpeedCargo Express</td>
                                    <td>96.8%</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi-graph-up"></i> +1.8%
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Global Freight Co.</td>
                                    <td>95.2%</td>
                                    <td>
                                        <span class="badge bg-soft-danger text-danger">
                                            <i class="bi-graph-down"></i> -0.4%
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="row">
        <div class="col-lg-6 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Delivery Performance</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Metric</th>
                                    <th>Value</th>
                                    <th>Target</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>On-Time Delivery Rate</td>
                                    <td>96.8%</td>
                                    <td>95%</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            Above Target
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Customer Satisfaction</td>
                                    <td>4.8/5.0</td>
                                    <td>4.5/5.0</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            Above Target
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fleet Utilization</td>
                                    <td>92%</td>
                                    <td>85%</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            Above Target
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Cost Analysis</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Metric</th>
                                    <th>Current</th>
                                    <th>Previous</th>
                                    <th>Change</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cost per Delivery</td>
                                    <td>$12.40</td>
                                    <td>$13.50</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi-graph-down"></i> -8.1%
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fuel Efficiency</td>
                                    <td>8.2 km/L</td>
                                    <td>7.8 km/L</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi-graph-up"></i> +5.1%
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maintenance Cost</td>
                                    <td>$2.1M</td>
                                    <td>$1.9M</td>
                                    <td>
                                        <span class="badge bg-soft-danger text-danger">
                                            <i class="bi-graph-up"></i> +10.5%
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 