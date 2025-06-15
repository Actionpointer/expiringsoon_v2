@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Consumer Overview</h1>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Consumers</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2,458</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> 12.5%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Consumers</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1,789</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> 8.3%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Corporate Accounts</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">324</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> 15.2%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Individual Accounts</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2,134</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> 11.7%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Stats Row -->

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-6 mb-3 mb-lg-5">
            <!-- Card -->
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-header-title">Consumer Growth</h5>
                </div>
                <div class="card-body">
                    <div class="chartjs-custom" style="height: 18rem;">
                        <!-- Chart would go here -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3 mb-lg-5">
            <!-- Card -->
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-header-title">Consumer Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="chartjs-custom" style="height: 18rem;">
                        <!-- Chart would go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Charts Row -->

    <!-- Recent Activity -->
    <div class="card mb-3 mb-lg-5">
        <div class="card-header">
            <h5 class="card-header-title">Recent Activity</h5>
        </div>
        <div class="card-body">
            <!-- Activity Timeline -->
            <ul class="step step-icon-xs">
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <small class="step-divider">Today</small>
                    </div>
                </li>

                <li class="step-item">
                    <div class="step-content-wrapper">
                        <span class="step-icon step-icon-soft-primary">
                            <i class="bi-person"></i>
                        </span>
                        <div class="step-content">
                            <h5>New consumer registration</h5>
                            <p class="mb-0">John Smith registered as an individual consumer.</p>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                    </div>
                </li>

                <li class="step-item">
                    <div class="step-content-wrapper">
                        <span class="step-icon step-icon-soft-success">
                            <i class="bi-building"></i>
                        </span>
                        <div class="step-content">
                            <h5>Corporate account verified</h5>
                            <p class="mb-0">ABC Corp completed their verification process.</p>
                            <small class="text-muted">5 hours ago</small>
                        </div>
                    </div>
                </li>

                <li class="step-item">
                    <div class="step-content-wrapper">
                        <small class="step-divider">Yesterday</small>
                    </div>
                </li>

                <!-- Add more timeline items as needed -->
            </ul>
        </div>
    </div>
</div>
@endsection 