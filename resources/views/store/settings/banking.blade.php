@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Bank Account Details</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', 1) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bank Account Details</li>
                        </ol>
                    </nav>
                </div>
                <!-- Save changes button -->
                <div>
                    <button type="submit" form="bankingForm" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('store.settings', 1) }}" class="list-group-item list-group-item-action py-3 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shop me-3 fs-5"></i>
                                <div>
                                    <h5 class="mb-0 fs-6">Store Information</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('store.settings.notifications', 1) }}" class="list-group-item list-group-item-action py-3 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bell me-3 fs-5"></i>
                                <div>
                                    <h5 class="mb-0 fs-6">Notification Settings</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('store.settings.subscription', 1) }}" class="list-group-item list-group-item-action py-3 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-star me-3 fs-5"></i>
                                <div>
                                    <h5 class="mb-0 fs-6">Subscription Plan</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('store.settings.banking', 1) }}" class="list-group-item list-group-item-action active py-3 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bank me-3 fs-5"></i>
                                <div>
                                    <h5 class="mb-0 fs-6">Bank Account Details</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('store.settings.compliance', 1) }}" class="list-group-item list-group-item-action py-3 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-check me-3 fs-5"></i>
                                <div>
                                    <h5 class="mb-0 fs-6">KYC Compliance</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('store.settings.team', 1) }}" class="list-group-item list-group-item-action py-3 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people me-3 fs-5"></i>
                                <div>
                                    <h5 class="mb-0 fs-6">Team Members</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            <div class="card border-0 shadow-sm mb-6">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Bank Account Information</h4>
                    <p class="text-muted small mb-0">Your bank account details for receiving payouts</p>
                </div>
                <div class="card-body">
                    <form id="bankingForm" action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="alert alert-info mb-4">
                            <div class="d-flex">
                                <i class="bi bi-info-circle fs-4 me-2"></i>
                                <div>
                                    <h5 class="alert-heading">Important Information</h5>
                                    <p class="mb-0">Please provide accurate banking details. Incorrect information may lead to payment delays or failed transactions. Verify all details before saving.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="accountHolderName" class="form-label">Account Holder Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="accountHolderName" name="account_holder_name" value="John Doe" required>
                                <div class="form-text">Name as it appears on your bank account</div>
                            </div>
                            <div class="col-md-6">
                                <label for="accountType" class="form-label">Account Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="accountType" name="account_type" required>
                                    <option value="checking" selected>Checking Account</option>
                                    <option value="savings">Savings Account</option>
                                    <option value="business">Business Account</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="bankName" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bankName" name="bank_name" value="Example Bank" required>
                            </div>
                            <div class="col-md-6">
                                <label for="branchName" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="branchName" name="branch_name" value="Main Branch">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="accountNumber" class="form-label">Account Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="accountNumber" name="account_number" value="XXXX-XXXX-XXXX-1234" required>
                                <div class="form-text">Your full account number</div>
                            </div>
                            <div class="col-md-6">
                                <label for="routingNumber" class="form-label">Routing/Sort Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="routingNumber" name="routing_number" value="123456789" required>
                                <div class="form-text">9-digit routing number for US banks</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label for="swiftCode" class="form-label">SWIFT/BIC Code</label>
                                <input type="text" class="form-control" id="swiftCode" name="swift_code" value="EXAMPLEXXX">
                                <div class="form-text">Required for international transfers</div>
                            </div>
                            <div class="col-md-6">
                                <label for="ibanNumber" class="form-label">IBAN Number</label>
                                <input type="text" class="form-control" id="ibanNumber" name="iban_number" value="">
                                <div class="form-text">Required for banks in Europe and some other regions</div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-4">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <label for="taxId" class="form-label">Tax ID/SSN</label>
                                    <input type="text" class="form-control" id="taxId" name="tax_id" value="XXX-XX-1234">
                                    <div class="form-text">Required for tax reporting purposes</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="currency" class="form-label">Preferred Payout Currency <span class="text-danger">*</span></label>
                                    <select class="form-select" id="currency" name="currency" required>
                                        <option value="USD" selected>US Dollar (USD)</option>
                                        <option value="EUR">Euro (EUR)</option>
                                        <option value="GBP">British Pound (GBP)</option>
                                        <option value="CAD">Canadian Dollar (CAD)</option>
                                        <option value="AUD">Australian Dollar (AUD)</option>
                                        <option value="JPY">Japanese Yen (JPY)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-4">
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirmDetails" name="confirm_details" required>
                                    <label class="form-check-label" for="confirmDetails">
                                        I confirm that the banking details provided are accurate and complete.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Alternative Payment Methods</h4>
                    <p class="text-muted small mb-0">Set up additional payment methods for receiving funds</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-paypal fs-4 text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">PayPal</h6>
                                                <small class="text-muted">johndoe@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>Jan 15, 2023</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editPayPalModal">Edit</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-wallet2 fs-4 text-success"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Wise (TransferWise)</h6>
                                                <small class="text-muted">johndoe@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>Mar 22, 2023</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                        <i class="bi bi-plus-circle me-2"></i>Add Payment Method
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Method Modal -->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentMethodModalLabel">Add Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPaymentMethodForm">
                    <div class="mb-4">
                        <label for="paymentMethodType" class="form-label">Payment Method Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="paymentMethodType" name="payment_method_type" required>
                            <option value="" selected disabled>Select Payment Method</option>
                            <option value="paypal">PayPal</option>
                            <option value="wise">Wise (TransferWise)</option>
                            <option value="stripe">Stripe</option>
                            <option value="skrill">Skrill</option>
                            <option value="venmo">Venmo</option>
                        </select>
                    </div>

                    <!-- PayPal Fields -->
                    <div id="paypalFields" class="payment-method-fields d-none">
                        <div class="mb-4">
                            <label for="paypalEmail" class="form-label">PayPal Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="paypalEmail" name="paypal_email">
                        </div>
                    </div>

                    <!-- Wise Fields -->
                    <div id="wiseFields" class="payment-method-fields d-none">
                        <div class="mb-4">
                            <label for="wiseEmail" class="form-label">Wise Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="wiseEmail" name="wise_email">
                        </div>
                        <div class="mb-4">
                            <label for="wiseAccountId" class="form-label">Wise Account ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="wiseAccountId" name="wise_account_id">
                        </div>
                    </div>

                    <!-- Stripe Fields -->
                    <div id="stripeFields" class="payment-method-fields d-none">
                        <div class="mb-4">
                            <label for="stripeAccountId" class="form-label">Stripe Account ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="stripeAccountId" name="stripe_account_id">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="makeDefault" name="make_default">
                            <label class="form-check-label" for="makeDefault">
                                Make this my default payment method
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Payment Method</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit PayPal Modal -->
<div class="modal fade" id="editPayPalModal" tabindex="-1" aria-labelledby="editPayPalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPayPalModalLabel">Edit PayPal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPayPalForm">
                    <div class="mb-4">
                        <label for="editPaypalEmail" class="form-label">PayPal Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="editPaypalEmail" name="paypal_email" value="johndoe@example.com">
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editMakeDefault" name="make_default" checked>
                            <label class="form-check-label" for="editMakeDefault">
                                Make this my default payment method
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show/hide payment method fields based on selection
    document.getElementById('paymentMethodType').addEventListener('change', function() {
        // First hide all payment method fields
        document.querySelectorAll('.payment-method-fields').forEach(function(field) {
            field.classList.add('d-none');
        });
        
        // Show the selected payment method fields
        const selectedMethod = this.value;
        if (selectedMethod) {
            document.getElementById(selectedMethod + 'Fields').classList.remove('d-none');
        }
    });
</script>
@endpush 