@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Settlements & Payouts</h1>
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
                    <h6 class="card-subtitle mb-2">Total Settlements</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$892K</span>
                        </div>
                    </div>
                    <span class="text-body">This month</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Logistics Payouts</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$645K</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-primary text-primary">
                        72% of settlements
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Insurance Payouts</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$198K</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-info text-info">
                        22% of settlements
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Consumer Refunds</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$49K</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-warning text-warning">
                        6% of settlements
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Settlements Alert -->
    <div class="alert bg-soft-warning mb-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="bi-exclamation-triangle-fill fs-3 text-warning"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="alert-heading">Pending Settlements</h5>
                <p class="mb-0">There are 15 settlements pending approval, totaling $125,450.00</p>
            </div>
            <div class="flex-shrink-0">
                <button class="btn btn-warning">Review Pending</button>
            </div>
        </div>
    </div>

    <!-- Settlements Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-md">
                    <h4 class="card-header-title">Settlement History</h4>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" data-hs-tom-select-options='{"placeholder": "Settlement Type"}'>
                                    <option value="all">All Types</option>
                                    <option value="logistics">Logistics Payout</option>
                                    <option value="insurance">Insurance Payout</option>
                                    <option value="refund">Consumer Refund</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" data-hs-tom-select-options='{"placeholder": "Status"}'>
                                    <option value="all">All Status</option>
                                    <option value="completed">Completed</option>
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
                        <th>Settlement ID</th>
                        <th>Type</th>
                        <th>Recipient</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="#">STL-1234</a></td>
                        <td>
                            <span class="badge bg-soft-primary text-primary">Logistics</span>
                            <small class="d-block">Weekly Settlement</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">FastTrack Logistics</h5>
                                    <small class="text-muted">ID: LOG-789</small>
                                </div>
                            </div>
                        </td>
                        <td>$45,250.00</td>
                        <td>Bank Transfer</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>Jan 15, 2024</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#settlementDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#">STL-1235</a></td>
                        <td>
                            <span class="badge bg-soft-info text-info">Insurance</span>
                            <small class="d-block">Monthly Payout</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">SecureShip Insurance</h5>
                                    <small class="text-muted">ID: INS-456</small>
                                </div>
                            </div>
                        </td>
                        <td>$28,750.00</td>
                        <td>Wire Transfer</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Jan 14, 2024</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#settlementDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><a href="#">STL-1236</a></td>
                        <td>
                            <span class="badge bg-soft-warning text-warning">Refund</span>
                            <small class="d-block">Service Cancellation</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="User">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">John Smith</h5>
                                    <small class="text-muted">ID: USR-123</small>
                                </div>
                            </div>
                        </td>
                        <td>$350.00</td>
                        <td>Card Refund</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>Jan 13, 2024</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#settlementDetails">
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
                        <span>248</span>
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

<!-- Settlement Details Modal -->
<div class="modal fade" id="settlementDetails" tabindex="-1" aria-labelledby="settlementDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settlementDetailsLabel">Settlement Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Settlement ID:</dt>
                    <dd class="col-sm-8">STL-1234</dd>

                    <dt class="col-sm-4">Type:</dt>
                    <dd class="col-sm-8">Logistics Payout - Weekly Settlement</dd>

                    <dt class="col-sm-4">Amount:</dt>
                    <dd class="col-sm-8">$45,250.00</dd>

                    <dt class="col-sm-4">Payment Method:</dt>
                    <dd class="col-sm-8">Bank Transfer</dd>

                    <dt class="col-sm-4">Bank Account:</dt>
                    <dd class="col-sm-8">**** **** **** 1234</dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8"><span class="badge bg-success">Completed</span></dd>

                    <dt class="col-sm-4">Settlement Date:</dt>
                    <dd class="col-sm-8">Jan 15, 2024</dd>

                    <dt class="col-sm-4">Period Covered:</dt>
                    <dd class="col-sm-8">Jan 08 - Jan 14, 2024</dd>

                    <dt class="col-sm-4">Recipient:</dt>
                    <dd class="col-sm-8">FastTrack Logistics</dd>

                    <dt class="col-sm-4">Transaction Count:</dt>
                    <dd class="col-sm-8">234 transactions</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Download Statement</button>
            </div>
        </div>
    </div>
</div>
@endsection 