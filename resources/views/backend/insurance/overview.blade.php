@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Insurance Overview</h1>
            </div>
            <div class="col-auto">
                <!-- Date Range Picker -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off">
                        <option value="last30">Last 30 Days</option>
                        <option value="last90">Last 90 Days</option>
                        <option value="ytd">Year to Date</option>
                        <option value="last12">Last 12 Months</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Premium Revenue</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$4.8M</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +15%
                            </span>
                        </div>
                    </div>
                    <span class="text-body fs-6">vs. $4.2M last period</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Policies</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1,248</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +8%
                            </span>
                        </div>
                    </div>
                    <span class="text-body fs-6">vs. 1,156 last period</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Open Claims</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">42</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-warning text-warning p-1">
                                Active
                            </span>
                        </div>
                    </div>
                    <span class="text-body fs-6">$520K total value</span>
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
                    <span class="text-body fs-6">vs. 3.7% last period</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-header card-header-content-sm-between">
                    <h4 class="card-header-title mb-2 mb-sm-0">Premium & Claims Trends</h4>
                    <div class="btn-group">
                        <button type="button" class="btn btn-soft-secondary btn-sm active">Monthly</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm">Quarterly</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm">Yearly</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="premiumClaimsChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Policy Distribution</h4>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="policyDistributionChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Insurance Summary -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Top Insurance Providers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Provider</th>
                                    <th>Policies</th>
                                    <th>Premium</th>
                                    <th>Claims Ratio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SafeGuard Insurance</td>
                                    <td>486</td>
                                    <td>$1.2M</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">2.8%</span>
                                            <span class="badge bg-soft-success text-success">
                                                <i class="bi-graph-down"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-white btn-sm" href="#">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SecureFleet Insurance</td>
                                    <td>342</td>
                                    <td>$980K</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">3.1%</span>
                                            <span class="badge bg-soft-warning text-warning">
                                                <i class="bi-graph-up"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-white btn-sm" href="#">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Recent Claims</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Claim ID</th>
                                    <th>Company</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#viewClaimModal">CLM-5678</a></td>
                                    <td>FastTrack Logistics</td>
                                    <td>Vehicle Damage</td>
                                    <td>$12,400</td>
                                    <td>
                                        <span class="badge bg-soft-warning text-warning">Processing</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#viewClaimModal">CLM-5677</a></td>
                                    <td>Global Shipping Co</td>
                                    <td>Cargo Loss</td>
                                    <td>$8,900</td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">Approved</span>
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

@section('scripts')
<script>
    // Premium & Claims Trends Chart
    new Chart(document.getElementById('premiumClaimsChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Premium Revenue',
                data: [800000, 850000, 900000, 880000, 920000, 980000],
                borderColor: 'rgba(55, 125, 255, 0.8)',
                backgroundColor: 'rgba(55, 125, 255, 0.1)',
                fill: true
            }, {
                label: 'Claims Paid',
                data: [25000, 28000, 24000, 26000, 29000, 27000],
                borderColor: 'rgba(255, 100, 100, 0.8)',
                backgroundColor: 'rgba(255, 100, 100, 0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Policy Distribution Chart
    new Chart(document.getElementById('policyDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Commercial Auto', 'Cargo', 'Liability', 'Fleet'],
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: [
                    'rgba(55, 125, 255, 0.8)',
                    'rgba(100, 165, 255, 0.8)',
                    'rgba(145, 205, 255, 0.8)',
                    'rgba(190, 225, 255, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection 