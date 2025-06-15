@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Withdrawal Requests</h1>
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
                    <h6 class="card-subtitle mb-2">Total Pending Amount</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$234K</span>
                        </div>
                    </div>
                    <span class="text-body">Across all currencies</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Pending Requests</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">15</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-warning text-warning">
                        Requires attention
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Approved Today</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">8</span>
                        </div>
                    </div>
                    <span class="text-body">$45,250 processed</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Average Processing Time</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2.4h</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-success text-success">
                        Within SLA
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this row after the stats cards to show all possible status types -->
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <span class="badge bg-warning">Pending</span>
                        <span class="badge bg-info">Processing</span>
                        <span class="badge bg-success">Completed</span>
                        <span class="badge bg-danger">Rejected</span>
                        <span class="badge bg-secondary">Cancelled</span>
                        
                        <div class="vr mx-2"></div>
                        
                        <span class="badge bg-soft-success text-success">
                            <i class="bi-lightning-charge-fill me-1"></i>Automatic
                        </span>
                        <span class="badge bg-soft-primary text-primary">
                            <i class="bi-bank me-1"></i>Manual
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Withdrawals Alert -->
    <div class="alert bg-soft-warning mb-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="bi-exclamation-triangle-fill fs-3 text-warning"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="alert-heading">Pending Withdrawal Requests</h5>
                <p class="mb-0">There are 15 withdrawal requests pending approval, totaling:</p>
                <ul class="list-unstyled mt-1 mb-0">
                    <li>USD: $125,450.00</li>
                    <li>EUR: €45,230.00</li>
                    <li>GBP: £28,900.00</li>
                </ul>
            </div>
            <div class="flex-shrink-0">
                <button class="btn btn-warning">Process All</button>
            </div>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-header-title">Withdrawal Requests</h4>
                        
                        <!-- Bulk Actions -->
                        <div class="dropdown" id="bulkActions" style="display: none;">
                            <button class="btn btn-white dropdown-toggle" type="button" id="bulkActionDropdown" data-bs-toggle="dropdown">
                                Bulk Actions <span class="badge bg-soft-dark ms-1">0</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-success" href="#" onclick="bulkApprove()">
                                    <i class="bi-check-circle me-2"></i>Approve Selected
                                </a>
                                <a class="dropdown-item text-danger" href="#" onclick="bulkReject()">
                                    <i class="bi-x-circle me-2"></i>Reject Selected
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Companies</option>
                                    <option value="logistics">Logistics Companies</option>
                                    <option value="insurance">Insurance Companies</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Currencies</option>
                                    <option value="usd">USD</option>
                                    <option value="eur">EUR</option>
                                    <option value="gbp">GBP</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Methods</option>
                                    <option value="automatic">Automatic Payout</option>
                                    <option value="manual">Manual Transfer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Date Range Filter -->
                        <div class="col-auto">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control flatpickr-custom" placeholder="Select dates" data-input>
                                <div class="input-group-append">
                                    <button class="btn btn-white" type="button" data-toggle><i class="bi-calendar"></i></button>
                                </div>
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
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th>Request ID</th>
                        <th>Company</th>
                        <th>Amount</th>
                        <th>Bank Details</th>
                        <th>Status</th>
                        <th>Requested Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="WD-1234">
                            </div>
                        </td>
                        <td><a href="#">WD-1234</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">FastTrack Logistics</h5>
                                    <small class="text-muted">Logistics Company</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">$45,250.00</span>
                            <small class="d-block text-muted">USD</small>
                        </td>
                        <td>
                            <small class="d-block">Bank: Citibank</small>
                            <small class="d-block">Acc: **** 1234</small>
                        </td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Jan 15, 2024 10:30 AM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawalDetails">
                                <i class="bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" onclick="approveWithdrawal('WD-1234')">
                                <i class="bi-check"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <i class="bi-x"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="WD-1235">
                            </div>
                        </td>
                        <td><a href="#">WD-1235</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">SecureShip Insurance</h5>
                                    <small class="text-muted">Insurance Company</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">€28,750.00</span>
                            <small class="d-block text-muted">EUR</small>
                        </td>
                        <td>
                            <small class="d-block">Bank: Deutsche Bank</small>
                            <small class="d-block">IBAN: **** 5678</small>
                        </td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Jan 15, 2024 11:45 AM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawalDetails">
                                <i class="bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" onclick="approveWithdrawal('WD-1235')">
                                <i class="bi-check"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <i class="bi-x"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="WD-1236">
                            </div>
                        </td>
                        <td><a href="#">WD-1236</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">Global Logistics Ltd</h5>
                                    <small class="text-muted">Logistics Company</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">$12,450.00</span>
                            <small class="d-block text-muted">USD</small>
                        </td>
                        <td>
                            <small class="d-block">Method: Stripe Connect</small>
                            <small class="d-block text-success">Automatic Payout</small>
                        </td>
                        <td><span class="badge bg-info">Processing</span></td>
                        <td>Jan 15, 2024 09:15 AM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawalDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="WD-1237">
                            </div>
                        </td>
                        <td><a href="#">WD-1237</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">CargoSafe Insurance</h5>
                                    <small class="text-muted">Insurance Company</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">£18,750.00</span>
                            <small class="d-block text-muted">GBP</small>
                        </td>
                        <td>
                            <small class="d-block">Bank: Barclays</small>
                            <small class="d-block">Sort Code: ******</small>
                        </td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>Jan 14, 2024 03:20 PM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawalDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="WD-1238">
                            </div>
                        </td>
                        <td><a href="#">WD-1238</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">EuroFreight Solutions</h5>
                                    <small class="text-muted">Logistics Company</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">€35,200.00</span>
                            <small class="d-block text-muted">EUR</small>
                        </td>
                        <td>
                            <small class="d-block">Method: PayPal</small>
                            <small class="d-block text-success">Automatic Payout</small>
                        </td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>Jan 14, 2024 11:45 AM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawalDetails">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="WD-1239">
                            </div>
                        </td>
                        <td><a href="#">WD-1239</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-circle">
                                        <img src="https://via.placeholder.com/150" alt="Company">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">SpeedCargo Logistics</h5>
                                    <small class="text-muted">Logistics Company</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold">$8,450.00</span>
                            <small class="d-block text-muted">USD</small>
                        </td>
                        <td>
                            <small class="d-block">Method: Bank Transfer</small>
                            <small class="d-block text-muted">Manual Payout</small>
                        </td>
                        <td>
                            <span class="badge bg-danger">Rejected</span>
                            <small class="d-block text-danger mt-1">Insufficient balance</small>
                        </td>
                        <td>Jan 13, 2024 02:30 PM</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawalDetails">
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
                        <span>15</span>
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
                                <span class="page-item"><span class="page-link">Next</span></span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Withdrawal Details Modal -->
<div class="modal fade" id="withdrawalDetails" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdrawal Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Request ID:</dt>
                    <dd class="col-sm-8">WD-1234</dd>

                    <dt class="col-sm-4">Company:</dt>
                    <dd class="col-sm-8">FastTrack Logistics</dd>

                    <dt class="col-sm-4">Amount:</dt>
                    <dd class="col-sm-8">$45,250.00 USD</dd>

                    <dt class="col-sm-4">Payment Method:</dt>
                    <dd class="col-sm-8">
                        Manual Bank Transfer
                        <small class="d-block text-muted">Processing Time: 1-2 business days</small>
                    </dd>

                    <dt class="col-sm-4">Bank Details:</dt>
                    <dd class="col-sm-8">
                        <small class="d-block">Bank: Citibank</small>
                        <small class="d-block">Account: **** **** **** 1234</small>
                        <small class="d-block">SWIFT/BIC: CITIUS33</small>
                        <small class="d-block">Account Type: Business</small>
                    </dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-warning">Pending</span>
                        <small class="d-block text-muted mt-1">Awaiting approval</small>
                    </dd>

                    <dt class="col-sm-4">Request Date:</dt>
                    <dd class="col-sm-8">Jan 15, 2024 10:30 AM</dd>

                    <dt class="col-sm-4">Available Balance:</dt>
                    <dd class="col-sm-8">$67,890.00 USD</dd>

                    <dt class="col-sm-4">Previous Payout:</dt>
                    <dd class="col-sm-8">
                        $32,150.00 (Jan 01, 2024)
                        <small class="d-block text-muted">Approved by John Smith</small>
                    </dd>

                    <dt class="col-sm-4">Processing Info:</dt>
                    <dd class="col-sm-8">
                        <div class="timeline-step">
                            <small class="text-muted">Jan 15, 2024 10:30 AM</small>
                            <p class="mb-0">Request submitted by company</p>
                        </div>
                        <div class="timeline-step">
                            <small class="text-muted">Jan 15, 2024 10:45 AM</small>
                            <p class="mb-0">Automatic verification passed</p>
                        </div>
                        <div class="timeline-step">
                            <small class="text-muted">Pending</small>
                            <p class="mb-0">Manual approval required</p>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Approve Request</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Withdrawal Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="rejectForm">
                    <div class="mb-3">
                        <label class="form-label">Reason for Rejection</label>
                        <textarea class="form-control" rows="3" required></textarea>
                        <small class="form-text text-muted">
                            Please provide a clear reason for rejecting this withdrawal request.
                        </small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmReject()">Confirm Rejection</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Handle select all checkbox
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('tbody .form-check-input');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        updateBulkActions();
    });

    // Handle individual checkboxes
    document.querySelectorAll('tbody .form-check-input').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    // Update bulk actions visibility and counter
    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('tbody .form-check-input:checked');
        const bulkActions = document.getElementById('bulkActions');
        const counter = bulkActions.querySelector('.badge');
        
        bulkActions.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
        counter.textContent = checkedBoxes.length;
    }

    // Bulk approve function
    function bulkApprove() {
        const selectedIds = getSelectedIds();
        console.log('Approving:', selectedIds);
        // Implement bulk approve logic
    }

    // Bulk reject function
    function bulkReject() {
        const selectedIds = getSelectedIds();
        console.log('Rejecting:', selectedIds);
        // Show reject modal with bulk operation handling
    }

    // Get selected withdrawal IDs
    function getSelectedIds() {
        return Array.from(document.querySelectorAll('tbody .form-check-input:checked'))
            .map(checkbox => checkbox.value);
    }

    // Individual approve function
    function approveWithdrawal(id) {
        console.log('Approving withdrawal:', id);
        // Implement approve logic
    }

    // Confirm rejection
    function confirmReject() {
        const reason = document.querySelector('#rejectForm textarea').value;
        if (!reason) {
            alert('Please provide a reason for rejection');
            return;
        }
        console.log('Rejecting with reason:', reason);
        // Implement reject logic
        $('#rejectModal').modal('hide');
    }
</script>
@endpush 