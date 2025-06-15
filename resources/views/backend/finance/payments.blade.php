@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Payment Transactions</h1>
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
                    <h6 class="card-subtitle mb-2">Total Transactions</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2,847</span>
                            <span class="text-success ms-2">
                                <i class="bi-graph-up"></i> 8.3%
                            </span>
                        </div>
                    </div>
                    <span class="badge bg-soft-success text-success">
                        <i class="bi-arrow-up"></i> Higher than last month
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Volume</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$534K</span>
                        </div>
                    </div>
                    <span class="text-body">Processed this month</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Wallet Deposits</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$128K</span>
                        </div>
                    </div>
                    <span class="text-body">Total deposits this month</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Failed Transactions</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">23</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-danger text-danger">
                        Requires attention
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-md">
                    <h4 class="card-header-title">Payment Transactions</h4>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" data-hs-tom-select-options='{"placeholder": "Payment Type"}'>
                                    <option value="all">All Types</option>
                                    <option value="courier">Courier Service</option>
                                    <option value="warehouse">Warehousing</option>
                                    <option value="vehicle">Vehicle Hire</option>
                                    <option value="deposit">Wallet Deposit</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" data-hs-tom-select-options='{"placeholder": "Status"}'>
                                    <option value="all">All Status</option>
                                    <option value="successful">Successful</option>
                                    <option value="pending">Pending</option>
                                    <option value="failed">Failed</option>
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
                        <th>Type</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Gateway</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="#">PAY-8829</a></td>
                        <td>
                            <span class="badge bg-soft-primary text-primary">Courier</span>
                            <small class="d-block">Express Delivery</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs avatar-circle">
                                    <img src="https://via.placeholder.com/150" alt="User">
                                </div>
                                <div class="ms-2">
                                    <h5 class="mb-0">John Doe</h5>
                                    <small class="text-muted">Consumer</small>
                                </div>
                            </div>
                        </td>
                        <td>$245.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/40" width="40" alt="Stripe">
                                <span class="ms-2">Stripe</span>
                            </div>
                        </td>
                        <td><span class="badge bg-success">Successful</span></td>
                        <td>Jan 15, 2024 10:30 AM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#transactionDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#">PAY-8830</a></td>
                        <td>
                            <span class="badge bg-soft-info text-info">Warehouse</span>
                            <small class="d-block">Monthly Storage</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs avatar-circle">
                                    <img src="https://via.placeholder.com/150" alt="Company">
                                </div>
                                <div class="ms-2">
                                    <h5 class="mb-0">Tech Solutions Inc</h5>
                                    <small class="text-muted">Business</small>
                                </div>
                            </div>
                        </td>
                        <td>$1,200.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/40" width="40" alt="PayPal">
                                <span class="ms-2">PayPal</span>
                            </div>
                        </td>
                        <td><span class="badge bg-success">Successful</span></td>
                        <td>Jan 15, 2024 11:45 AM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#transactionDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#">PAY-8831</a></td>
                        <td>
                            <span class="badge bg-soft-warning text-warning">Deposit</span>
                            <small class="d-block">Wallet Funding</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs avatar-circle">
                                    <img src="https://via.placeholder.com/150" alt="Company">
                                </div>
                                <div class="ms-2">
                                    <h5 class="mb-0">FastTrack Logistics</h5>
                                    <small class="text-muted">Logistics Company</small>
                                </div>
                            </div>
                        </td>
                        <td>$5,000.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/40" width="40" alt="Bank Transfer">
                                <span class="ms-2">Bank Transfer</span>
                            </div>
                        </td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Jan 15, 2024 2:15 PM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#transactionDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#">PAY-8832</a></td>
                        <td>
                            <span class="badge bg-soft-secondary text-secondary">Vehicle</span>
                            <small class="d-block">Truck Rental</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs avatar-circle">
                                    <img src="https://via.placeholder.com/150" alt="User">
                                </div>
                                <div class="ms-2">
                                    <h5 class="mb-0">Sarah Wilson</h5>
                                    <small class="text-muted">Consumer</small>
                                </div>
                            </div>
                        </td>
                        <td>$850.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/40" width="40" alt="Flutterwave">
                                <span class="ms-2">Flutterwave</span>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Failed</span></td>
                        <td>Jan 15, 2024 3:20 PM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#transactionDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
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
                        <span>2,847</span>
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

<!-- Transaction Details Modal -->
<div class="modal fade" id="transactionDetails" tabindex="-1" aria-labelledby="transactionDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionDetailsLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Transaction ID:</dt>
                    <dd class="col-sm-8">PAY-8829</dd>

                    <dt class="col-sm-4">Type:</dt>
                    <dd class="col-sm-8">Courier Service - Express Delivery</dd>

                    <dt class="col-sm-4">Amount:</dt>
                    <dd class="col-sm-8">$245.00</dd>

                    <dt class="col-sm-4">Gateway:</dt>
                    <dd class="col-sm-8">Stripe</dd>

                    <dt class="col-sm-4">Gateway Reference:</dt>
                    <dd class="col-sm-8">ch_3NxYq2EHVXkUT1Lo0</dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8"><span class="badge bg-success">Successful</span></dd>

                    <dt class="col-sm-4">Date:</dt>
                    <dd class="col-sm-8">Jan 15, 2024 10:30 AM</dd>

                    <dt class="col-sm-4">User:</dt>
                    <dd class="col-sm-8">John Doe (Consumer)</dd>

                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">john.doe@example.com</dd>

                    <dt class="col-sm-4">Service Provider:</dt>
                    <dd class="col-sm-8">FastTrack Logistics</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Download Receipt</button>
            </div>
        </div>
    </div>
</div>
@endsection 