@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Subscription Plan</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', 1) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscription Plan</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('store.plans',$store) }}" class="btn btn-primary">
                        <i class="bi bi-arrow-up-circle me-2"></i>Upgrade Plan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            @include('store.settings.sidebar')
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            <!-- Current Plan Card -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Current Subscription</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-shape icon-md bg-primary text-white rounded-3 me-3">
                                    <i class="bi bi-award fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">Premium Plan</h4>
                                    <p class="mb-0 text-muted">$49.99/month, billed monthly</p>
                                </div>
                                <span class="badge bg-success ms-auto">Active</span>
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Next billing date</span>
                                    <span class="fw-bold">June 15, 2023</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subscription ID</span>
                                    <span class="fw-bold">SUB-12345678</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Started on</span>
                                    <span class="fw-bold">May 15, 2023</span>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="{{ route('store.plans',$store) }}" class="btn btn-primary">
                                    Upgrade Plan
                                </a>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#renewSubscriptionModal">
                                    Renew Plan
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelSubscriptionModal">
                                    Cancel Subscription
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Plan Usage</h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Products</span>
                                            <span class="text-muted small">450 / 500</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Storage</span>
                                            <span class="text-muted small">3.5 GB / 5 GB</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Staff Accounts</span>
                                            <span class="text-muted small">3 / 5</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Categories</span>
                                            <span class="text-muted small">8 / 10</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Features Card -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Plan Features</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Up to 500 Products</h5>
                                    <p class="mb-0 text-muted">List up to 500 products in your store</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">5 GB Storage</h5>
                                    <p class="mb-0 text-muted">For product images and files</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">5 Staff Accounts</h5>
                                    <p class="mb-0 text-muted">Add up to 5 team members</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">10 Categories</h5>
                                    <p class="mb-0 text-muted">Organize products into up to 10 categories</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Advanced Analytics</h5>
                                    <p class="mb-0 text-muted">Detailed reports and insights</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">24/7 Support</h5>
                                    <p class="mb-0 text-muted">Priority customer support</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Custom Domain</h5>
                                    <p class="mb-0 text-muted">Use your own domain name</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Social Media Integration</h5>
                                    <p class="mb-0 text-muted">Connect to social platforms</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Billing History Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Billing History</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>May 15, 2023</td>
                                    <td>Premium Plan Subscription</td>
                                    <td>$49.99</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i> PDF</a></td>
                                </tr>
                                <tr>
                                    <td>Apr 15, 2023</td>
                                    <td>Premium Plan Subscription</td>
                                    <td>$49.99</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i> PDF</a></td>
                                </tr>
                                <tr>
                                    <td>Mar 15, 2023</td>
                                    <td>Premium Plan Subscription</td>
                                    <td>$49.99</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i> PDF</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Renew Subscription Modal -->
<div class="modal fade" id="renewSubscriptionModal" tabindex="-1" aria-labelledby="renewSubscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renewSubscriptionModalLabel">Renew Your Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <div class="d-flex">
                        <i class="bi bi-info-circle fs-4 me-2"></i>
                        <div>
                            <p class="mb-0">Your Premium Plan subscription is set to expire on <strong>June 15, 2023</strong>. Renew now to ensure uninterrupted service.</p>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">Premium Plan</h5>
                                <p class="mb-0 text-muted">$49.99/month</p>
                            </div>
                            <div>
                                <select class="form-select" id="billingCycle">
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly (Save 10%)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
                    <select class="form-select" id="paymentMethod">
                        <option value="card_1">Visa ending in 4242</option>
                        <option value="card_2">Add New Payment Method</option>
                    </select>
                </div>
                
                <div class="d-flex justify-content-between border-top border-bottom py-3 my-4">
                    <span>Total</span>
                    <span class="fw-bold">$49.99</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Renew Subscription</button>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Subscription Modal -->
<div class="modal fade" id="cancelSubscriptionModal" tabindex="-1" aria-labelledby="cancelSubscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSubscriptionModalLabel">Cancel Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <div class="d-flex">
                        <i class="bi bi-exclamation-triangle fs-4 me-2"></i>
                        <div>
                            <h5 class="alert-heading">Are you sure you want to cancel?</h5>
                            <p class="mb-0">Cancelling your subscription will result in the loss of premium features and limitations on your store capabilities after the current billing period ends on <strong>June 15, 2023</strong>.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="cancellationReason" class="form-label">Please tell us why you're cancelling</label>
                    <select class="form-select mb-3" id="cancellationReason">
                        <option value="" selected disabled>Select a reason</option>
                        <option value="too_expensive">Too expensive</option>
                        <option value="missing_features">Missing features I need</option>
                        <option value="not_using">Not using the service enough</option>
                        <option value="switching">Switching to another service</option>
                        <option value="other">Other reason</option>
                    </select>
                    <textarea class="form-control" id="cancellationFeedback" rows="3" placeholder="Please provide additional feedback (optional)"></textarea>
                </div>
                
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="confirmCancellation" required>
                    <label class="form-check-label" for="confirmCancellation">
                        I understand that I will lose access to premium features after my current billing period ends.
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Subscription</button>
                <button type="button" class="btn btn-danger" disabled id="cancelSubscriptionBtn">Cancel Subscription</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enable/disable cancel button based on checkbox
    document.getElementById('confirmCancellation').addEventListener('change', function() {
        document.getElementById('cancelSubscriptionBtn').disabled = !this.checked;
    });
    
    // Update price based on billing cycle
    document.getElementById('billingCycle').addEventListener('change', function() {
        const totalElement = this.closest('.modal-body').querySelector('.d-flex.justify-content-between.border-top.border-bottom span.fw-bold');
        if (this.value === 'monthly') {
            totalElement.textContent = '$49.99';
        } else {
            totalElement.textContent = '$539.89'; // 10% off yearly price
        }
    });
</script>
@endpush 