@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Withdrawals</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.earnings',1) }}" class="text-inherit">Earnings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Withdrawals</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestWithdrawalModal">
                        <i class="bi bi-cash-coin me-2"></i>Request Withdrawal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-6">
        <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$2,865</h4>
                            <p class="mb-0 fs-6">Available for Withdrawal</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-success text-success rounded-3">
                            <i class="bi bi-currency-dollar fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$980</h4>
                            <p class="mb-0 fs-6">Pending Withdrawals</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-warning text-warning rounded-3">
                            <i class="bi bi-hourglass-split fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$7,900</h4>
                            <p class="mb-0 fs-6">Total Withdrawn</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-info text-info rounded-3">
                            <i class="bi bi-bank fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods Row -->
    <div class="row mb-6">
        <div class="col-md-12">
            <div class="card card-lg">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Payment Methods</h4>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                            <i class="bi bi-plus-circle me-2"></i>Add Payment Method
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded me-3">
                                                <i class="bi bi-bank"></i>
                                            </div>
                                            <h5 class="mb-0">Bank Account</h5>
                                        </div>
                                        <span class="badge bg-success">Default</span>
                                    </div>
                                    <p class="mb-1 text-muted">Account: **** 5678</p>
                                    <p class="mb-1 text-muted">Bank: Chase Bank</p>
                                    <p class="mb-0 text-muted">Name: John Doe</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded me-3">
                                                <i class="bi bi-paypal"></i>
                                            </div>
                                            <h5 class="mb-0">PayPal</h5>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Email: john.doe@example.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border h-100 border-dashed">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="icon-shape icon-md bg-light-secondary text-secondary rounded mb-3">
                                        <i class="bi bi-plus-lg"></i>
                                    </div>
                                    <h6 class="mb-0">Add New Payment Method</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawals Table Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Withdrawal History</h4>
                        <div>
                            <select class="form-select">
                                <option selected>All Status</option>
                                <option>Pending</option>
                                <option>Completed</option>
                                <option>Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Withdrawal ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Processing Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" class="text-inherit">#WD0012</a></td>
                                    <td>Nov 22, 2023</td>
                                    <td>$1,200.00</td>
                                    <td>Bank Account</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>1-3 Business Days</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">Cancel Request</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#WD0011</a></td>
                                    <td>Nov 15, 2023</td>
                                    <td>$800.00</td>
                                    <td>PayPal</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>Processed in 1 day</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">Download Receipt</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#WD0010</a></td>
                                    <td>Nov 01, 2023</td>
                                    <td>$1,500.00</td>
                                    <td>Bank Account</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>Processed in 2 days</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">Download Receipt</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#WD0009</a></td>
                                    <td>Oct 15, 2023</td>
                                    <td>$950.00</td>
                                    <td>PayPal</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>Processed in 1 day</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">Download Receipt</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#WD0008</a></td>
                                    <td>Oct 01, 2023</td>
                                    <td>$1,100.00</td>
                                    <td>Bank Account</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>Processed in 2 days</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">Download Receipt</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#WD0007</a></td>
                                    <td>Sep 15, 2023</td>
                                    <td>$750.00</td>
                                    <td>PayPal</td>
                                    <td><span class="badge bg-danger">Rejected</span></td>
                                    <td>-</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">Contact Support</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-center">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Request Withdrawal Modal -->
<div class="modal fade" id="requestWithdrawalModal" tabindex="-1" aria-labelledby="requestWithdrawalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestWithdrawalModalLabel">Request Withdrawal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="withdrawalAmount" class="form-label">Withdrawal Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="withdrawalAmount" placeholder="Enter amount" min="50" max="2865">
                        </div>
                        <div class="form-text">Available Balance: $2,865.00 (Minimum withdrawal: $50)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="bank" selected>Bank Account (**** 5678)</option>
                            <option value="paypal">PayPal (john.doe@example.com)</option>
                        </select>
                    </div>
                    
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                            <div>
                                <p class="mb-0">Bank transfers typically take 1-3 business days to process. PayPal transfers are usually processed within 24 hours.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="confirmWithdrawal">
                        <label class="form-check-label" for="confirmWithdrawal">I confirm that the payment details are correct</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Submit Withdrawal Request</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Method Modal -->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentMethodModalLabel">Add Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6>Select Payment Method Type</h6>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-check custom-option custom-option-icon">
                                <input name="paymentMethodType" class="form-check-input" type="radio" value="bank" id="bankTransfer" checked>
                                <label class="form-check-label custom-option-content" for="bankTransfer">
                                    <span class="custom-option-body">
                                        <i class="bi bi-bank"></i>
                                        <span class="custom-option-title">Bank Account</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check custom-option custom-option-icon">
                                <input name="paymentMethodType" class="form-check-input" type="radio" value="paypal" id="paypalTransfer">
                                <label class="form-check-label custom-option-content" for="paypalTransfer">
                                    <span class="custom-option-body">
                                        <i class="bi bi-paypal"></i>
                                        <span class="custom-option-title">PayPal</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bank Transfer Form -->
                <div id="bankTransferForm">
                    <div class="mb-3">
                        <label for="accountHolderName" class="form-label">Account Holder Name</label>
                        <input type="text" class="form-control" id="accountHolderName" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label for="bankName" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bankName" placeholder="Enter bank name">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="accountNumber" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="routingNumber" class="form-label">Routing Number</label>
                            <input type="text" class="form-control" id="routingNumber" placeholder="Enter routing number">
                        </div>
                    </div>
                </div>
                
                <!-- PayPal Form (hidden by default) -->
                <div id="paypalForm" style="display: none;">
                    <div class="mb-3">
                        <label for="paypalEmail" class="form-label">PayPal Email</label>
                        <input type="email" class="form-control" id="paypalEmail" placeholder="Enter PayPal email">
                    </div>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="makeDefault">
                    <label class="form-check-label" for="makeDefault">Make this my default payment method</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Payment Method</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle between bank transfer and PayPal forms
    document.addEventListener('DOMContentLoaded', function() {
        const bankTransferRadio = document.getElementById('bankTransfer');
        const paypalTransferRadio = document.getElementById('paypalTransfer');
        const bankTransferForm = document.getElementById('bankTransferForm');
        const paypalForm = document.getElementById('paypalForm');
        
        if (bankTransferRadio && paypalTransferRadio) {
            bankTransferRadio.addEventListener('change', function() {
                if (this.checked) {
                    bankTransferForm.style.display = 'block';
                    paypalForm.style.display = 'none';
                }
            });
            
            paypalTransferRadio.addEventListener('change', function() {
                if (this.checked) {
                    bankTransferForm.style.display = 'none';
                    paypalForm.style.display = 'block';
                }
            });
        }
    });
</script>
@endsection
