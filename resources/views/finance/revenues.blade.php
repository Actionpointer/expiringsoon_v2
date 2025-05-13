@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Revenue Overview</h1>
            </div>
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                        <i class="bi-download me-1"></i> Export
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">PDF Report</a>
                        <a class="dropdown-item" href="#">Excel Spreadsheet</a>
                        <a class="dropdown-item" href="#">CSV File</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Revenue</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$157,492</span>
                            <span class="text-success ms-2">
                                <i class="bi-graph-up"></i> 12.5%
                            </span>
                        </div>
                    </div>
                    <span class="badge bg-soft-success text-success">
                        <i class="bi-arrow-up"></i> Up from last month
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Logistics Commission</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$89,234</span>
                        </div>
                    </div>
                    <span class="text-body">56% of total revenue</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Insurance Premium</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$42,158</span>
                        </div>
                    </div>
                    <span class="text-body">27% of total revenue</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Transaction Fees</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$26,100</span>
                        </div>
                    </div>
                    <span class="text-body">17% of total revenue</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Sources Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-md">
                    <h4 class="card-header-title">Revenue Sources</h4>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" data-hs-tom-select-options='{"placeholder": "Source"}'>
                                    <option value="all">All Sources</option>
                                    <option value="logistics">Logistics</option>
                                    <option value="insurance">Insurance</option>
                                    <option value="transaction">Transaction Fees</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" data-hs-tom-select-options='{"placeholder": "Time Period"}'>
                                    <option value="today">Today</option>
                                    <option value="week">This Week</option>
                                    <option value="month" selected>This Month</option>
                                    <option value="year">This Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Transaction ID</th>
                        <th>Source</th>
                        <th>Company</th>
                        <th>Amount</th>
                        <th>Commission Rate</th>
                        <th>Revenue</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="#">TRX-7829</a></td>
                        <td>
                            <span class="badge bg-soft-primary text-primary">Logistics</span>
                            <small class="d-block">Delivery Service</small>
                        </td>
                        <td>FastTrack Logistics</td>
                        <td>$1,200.00</td>
                        <td>8%</td>
                        <td>$96.00</td>
                        <td>Jan 15, 2024</td>
                    </tr>

                    <tr>
                        <td><a href="#">TRX-7830</a></td>
                        <td>
                            <span class="badge bg-soft-info text-info">Insurance</span>
                            <small class="d-block">Premium Payment</small>
                        </td>
                        <td>SecureShip Insurance</td>
                        <td>$5,000.00</td>
                        <td>5%</td>
                        <td>$250.00</td>
                        <td>Jan 15, 2024</td>
                    </tr>

                    <tr>
                        <td><a href="#">TRX-7831</a></td>
                        <td>
                            <span class="badge bg-soft-success text-success">Transaction</span>
                            <small class="d-block">Payment Processing</small>
                        </td>
                        <td>Consumer Payment</td>
                        <td>$850.00</td>
                        <td>2.5%</td>
                        <td>$21.25</td>
                        <td>Jan 15, 2024</td>
                    </tr>

                    <tr>
                        <td><a href="#">TRX-7832</a></td>
                        <td>
                            <span class="badge bg-soft-primary text-primary">Logistics</span>
                            <small class="d-block">Warehousing</small>
                        </td>
                        <td>StorageMax Solutions</td>
                        <td>$3,500.00</td>
                        <td>7%</td>
                        <td>$245.00</td>
                        <td>Jan 14, 2024</td>
                    </tr>

                    <tr>
                        <td><a href="#">TRX-7833</a></td>
                        <td>
                            <span class="badge bg-soft-info text-info">Insurance</span>
                            <small class="d-block">Cargo Insurance</small>
                        </td>
                        <td>CargoSafe Insurance</td>
                        <td>$7,500.00</td>
                        <td>5%</td>
                        <td>$375.00</td>
                        <td>Jan 14, 2024</td>
                    </tr>
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
                        <span>150</span>
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