@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Dashboard</h1>
            </div>
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="quickActionsDropdown" data-bs-toggle="dropdown">
                        <i class="bi-lightning-charge"></i> Quick Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                            <i class="bi-check-circle dropdown-item-icon"></i> Approve KYC Requests
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-currency-dollar dropdown-item-icon"></i> Process Payouts
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-shield-check dropdown-item-icon"></i> Review Reported Items
                </a>
            </div>
        </div>
    </div>
                        </div>
                            </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="d-flex align-items-center gap-2">
                <span class="display-6 text-primary">₦24.5M</span>
                <span class="badge bg-soft-success">
                        <i class="bi-graph-up"></i> 12.5%
                    </span>
                </div>
            <span class="fs-6 text-body">Today's Transaction Volume</span>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="d-flex align-items-center gap-2">
                <span class="display-6 text-primary">584</span>
                <span class="badge bg-soft-danger">
                    <i class="bi-graph-down"></i> 3.2%
                    </span>
                </div>
            <span class="fs-6 text-body">New Users Today</span>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="d-flex align-items-center gap-2">
                <span class="display-6 text-primary">47</span>
                <span class="badge bg-soft-warning">
                    <i class="bi-exclamation-circle"></i>
                    </span>
                </div>
            <span class="fs-6 text-body">Pending Support Tickets</span>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="d-flex align-items-center gap-2">
                <span class="display-6 text-primary">92%</span>
                <span class="badge bg-soft-success">
                    <i class="bi-check-circle"></i>
                </span>
                        </div>
            <span class="fs-6 text-body">System Uptime</span>
                            </div>
                        </div>

    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            <!-- Revenue Chart -->
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <h4 class="card-header-title">Revenue Overview</h4>
                        </div>
                        <div class="col-auto">
                    <div class="dropdown">
                                <button class="btn btn-ghost-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    This Week
                        </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">This Week</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">This Month</a>
                        </div>
                    </div>
                </div>
                                </div>
                                        </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="revenueChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                                </div>

            <!-- Active Shipments -->
            <div class="card mb-3">
        <div class="card-header">
                    <h4 class="card-header-title">Active Shipments</h4>
                            </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                                    <th>Tracking ID</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th style="min-width: 200px;">Status</th>
                                    <th>ETA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                                    <td>
                                        <span class="badge bg-soft-primary">TRK-7829</span>
                        </td>
                                    <td>Lagos</td>
                                    <td>Abuja</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-soft-warning me-2">In Transit</span>
                                            <div class="progress flex-grow-1" style="height: 5px; width: 100px;">
                                                <div class="progress-bar" role="progressbar" style="width: 65%"></div>
                            </div>
                                    </div>
                        </td>
                                    <td>2 hours</td>
                    </tr>
                            </tbody>
                        </table>
                            </div>
                                    </div>
                                </div>

            <!-- Pending Payouts -->
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <h4 class="card-header-title">Pending Payouts</h4>
                            </div>
                        <div class="col-auto">
                            <button class="btn btn-soft-success btn-sm">
                                <i class="bi-check-all"></i> Approve All
                            </button>
                                    </div>
                                </div>
                                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th style="min-width: 200px;">Shop</th>
                                    <th>Amount</th>
                                    <th>Bank</th>
                                    <th>Status</th>
                                    <th>Action</th>
                    </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xs avatar-soft-primary avatar-circle me-2">
                                                <span class="avatar-initials">F</span>
                            </div>
                                            <span>Fashion Hub</span>
                                    </div>
                        </td>
                                    <td>₦245,000</td>
                                    <td>GTBank</td>
                                    <td><span class="badge bg-soft-warning">Pending</span></td>
                        <td>
                                        <button class="btn btn-soft-primary btn-xs">Review</button>
                        </td>
                    </tr>
                            </tbody>
                        </table>
                            </div>
                                    </div>
                                </div>
                                </div>

        <!-- Sidebar Content -->
        <div class="col-lg-4">
            <!-- KYC Verification Queue -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-header-title">KYC Verification Queue</h4>
                            </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{asset('images/160x160/img1.jpg')}}" alt="User">
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="mb-0">John Doe</h5>
                                    <span class="fs-6 text-body">Business Registration</span>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-soft-primary btn-xs">Review</button>
                            </div>
                                    </div>
                                </div>
                        <!-- Add more items -->
                                </div>
                            </div>
                                    </div>

            <!-- Active Ads -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-header-title">Active Ad Campaigns</h4>
                            </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Summer Sale</h5>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-soft-success">Running</span>
                                        <small>₦45,000 spent</small>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="chart" style="width: 50px;">
                                        <canvas class="js-chart-datalabels" data-chart-lines></canvas>
                                </div>
                            </div>
                                    </div>
                                </div>
                        <!-- Add more items -->
                                </div>
                            </div>
                                    </div>

            <!-- System Health -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-header-title">System Health</h4>
                            </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span>CPU Usage</span>
                        <div class="flex-grow-1 mx-2">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 25%"></div>
                                    </div>
                                </div>
                        <span>25%</span>
                                </div>
                    <div class="d-flex align-items-center mb-3">
                        <span>Memory</span>
                        <div class="flex-grow-1 mx-2">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 65%"></div>
                            </div>
                                    </div>
                        <span>65%</span>
                                </div>
                    <div class="d-flex align-items-center">
                        <span>Storage</span>
                        <div class="flex-grow-1 mx-2">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 45%"></div>
                                </div>
        </div>
                        <span>45%</span>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/chart.js/dist/chart.min.js') }}"></script>
<script>
    // Revenue Chart
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Revenue',
                    data: [1500000, 1800000, 2200000, 1900000, 2700000, 2300000, 2800000],
                    borderColor: '#377dff',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(55, 125, 255, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₦' + (value/1000000).toFixed(1) + 'M';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
