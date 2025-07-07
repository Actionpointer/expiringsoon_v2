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
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', $store) }}" class="text-inherit">Settings</a></li>
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
            @include('livewire.store.settings.sidebar',['store'=> $store])
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
                                    <h4 class="mb-0">
                                        @if($subscriptionPlan)
                                            {{ $subscriptionPlan->name }}
                                        @else
                                            No Active Plan
                                        @endif
                                    </h4>
                                    <p class="mb-0 text-muted">
                                        @if($subscriptionPlan)
                                            {{ $store->currency_symbol }}{{ $this->getSubscriptionPrice() }}/{{ $this->getBillingCycle() }}, billed {{ $this->getBillingCycle() }}
                                        @else
                                            Free Plan
                                        @endif
                                    </p>
                                </div>
                                <span class="badge bg-{{ $this->getSubscriptionStatus() === 'active' ? 'success' : ($this->getSubscriptionStatus() === 'expired' ? 'danger' : 'warning') }} ms-auto">
                                    {{ ucfirst($this->getSubscriptionStatus()) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                @if($this->getNextBillingDate())
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Next billing date</span>
                                    <span class="fw-bold">{{ $this->getNextBillingDate()->format('M d, Y') }}</span>
                                </div>
                                @endif
                                @if($this->getSubscriptionId())
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subscription ID</span>
                                    <span class="fw-bold">{{ $this->getSubscriptionId() }}</span>
                                </div>
                                @endif
                                @if($currentSubscription)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Started on</span>
                                    <span class="fw-bold">{{ $currentSubscription->start_at->format('M d, Y') }}</span>
                                </div>
                                @endif
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="{{ route('store.plans',$store) }}" class="btn btn-primary">
                                    @if($subscriptionPlan)
                                        Upgrade Plan
                                    @else
                                        Choose Plan
                                    @endif
                                </a>
                                @if($currentSubscription && $this->getSubscriptionStatus() === 'active')
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#renewSubscriptionModal">
                                    Renew Plan
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelSubscriptionModal">
                                    Cancel Subscription
                                </button>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Plan Usage</h5>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Products</span>
                                            <span class="text-muted small">{{ $usageStats['products']['used'] }} / {{ $usageStats['products']['limit'] }}</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $usageStats['products']['percentage'] }}%" aria-valuenow="{{ $usageStats['products']['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Storage</span>
                                            <span class="text-muted small">{{ $usageStats['storage']['used'] }} MB / {{ $usageStats['storage']['limit'] }} MB</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $usageStats['storage']['percentage'] }}%" aria-valuenow="{{ $usageStats['storage']['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Staff Accounts</span>
                                            <span class="text-muted small">{{ $usageStats['staff']['used'] }} / {{ $usageStats['staff']['limit'] }}</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $usageStats['staff']['percentage'] }}%" aria-valuenow="{{ $usageStats['staff']['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Withdrawals (This Month)</span>
                                            <span class="text-muted small">{{ $usageStats['withdrawals']['used'] }} / {{ $usageStats['withdrawals']['limit'] }}</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $usageStats['withdrawals']['percentage'] }}%" aria-valuenow="{{ $usageStats['withdrawals']['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Card -->
            @if($subscriptionPlan)
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Plan Features</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($this->getPlanFeatures() as $feature)
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $feature['title'] }}</h5>
                                    <p class="mb-0 text-muted">{{ $feature['description'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Withdrawal Statistics Card -->
            @if($subscriptionPlan && $this->getWithdrawalStats())
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Withdrawal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-info text-white rounded-3 me-3">
                                    <i class="bi bi-percent fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Commission Rate</h5>
                                    <p class="mb-0 text-muted">{{ $this->getWithdrawalStats()['commission_rate'] }}% on all sales</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-success text-white rounded-3 me-3">
                                    <i class="bi bi-clock fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Processing Time</h5>
                                    <p class="mb-0 text-muted">{{ $this->getWithdrawalIntervalDescription() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-warning text-white rounded-3 me-3">
                                    <i class="bi bi-currency-dollar fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Withdrawal Limits</h5>
                                    <p class="mb-0 text-muted">{{ $store->currency_symbol }}{{ $this->getWithdrawalStats()['min_withdrawal'] }} - {{ $store->currency_symbol }}{{ $this->getWithdrawalStats()['max_withdrawal'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-md bg-primary text-white rounded-3 me-3">
                                    <i class="bi bi-calendar-check fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Monthly Limit</h5>
                                    <p class="mb-0 text-muted">{{ $subscriptionPlan->withdrawal_count }} withdrawals per month</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- This Month Statistics -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">This Month's Activity</h5>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h4 class="mb-1 text-primary">{{ $this->getWithdrawalStats()['this_month_count'] }}</h4>
                                        <p class="mb-0 text-muted small">Withdrawals Made</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h4 class="mb-1 text-success">{{ $store->currency_symbol }}{{ number_format($this->getWithdrawalStats()['this_month_total'], 2) }}</h4>
                                        <p class="mb-0 text-muted small">Total Withdrawn</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h4 class="mb-1 text-info">{{ $store->currency_symbol }}{{ number_format($this->getWithdrawalStats()['average_withdrawal'], 2) }}</h4>
                                        <p class="mb-0 text-muted small">Average Per Withdrawal</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h4 class="mb-1 text-warning">{{ $this->getWithdrawalStats()['remaining_withdrawals'] }}</h4>
                                        <p class="mb-0 text-muted small">Remaining This Month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Billing History Card -->
            @if(count($this->getBillingHistoryData()) > 0)
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
                                @foreach($this->getBillingHistoryData() as $billing)
                                <tr>
                                    <td>{{ $billing['date'] }}</td>
                                    <td>{{ $billing['description'] }}</td>
                                    <td>{{ $store->currency_symbol }}{{ $billing['amount'] }}</td>
                                    <td><span class="badge bg-success">{{ $billing['status'] }}</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i> PDF</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Renew Subscription Modal -->
    @if($this->hasActiveSubscription())
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
                                <p class="mb-0">Your {{ $subscriptionPlan->name }} subscription is set to expire on <strong>{{ $currentSubscription->end_at->format('M d, Y') }}</strong>. Renew now to ensure uninterrupted service.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">{{ $subscriptionPlan->name }}</h5>
                                    <p class="mb-0 text-muted">{{ $store->currency_symbol }}{{ $this->getSubscriptionPrice() }}/{{ $this->getBillingCycle() }}</p>
                                </div>
                                <div>
                                    <select class="form-select" id="billingCycle">
                                        <option value="monthly" {{ $this->getBillingCycle() === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="yearly" {{ $this->getBillingCycle() === 'yearly' ? 'selected' : '' }}>Yearly (Save 10%)</option>
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
                        <span class="fw-bold">{{ $store->currency_symbol }}{{ $this->getSubscriptionPrice() }}</span>
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
                                <p class="mb-0">Cancelling your subscription will result in the loss of premium features and limitations on your store capabilities after the current billing period ends on <strong>{{ $currentSubscription->end_at->format('M d, Y') }}</strong>.</p>
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
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle cancellation confirmation checkbox
    const confirmCancellation = document.getElementById('confirmCancellation');
    const cancelSubscriptionBtn = document.getElementById('cancelSubscriptionBtn');
    
    if (confirmCancellation && cancelSubscriptionBtn) {
        confirmCancellation.addEventListener('change', function() {
            cancelSubscriptionBtn.disabled = !this.checked;
        });
    }

    // Handle billing cycle change in renew modal
    const billingCycleSelect = document.getElementById('billingCycle');
    const totalAmount = document.querySelector('#renewSubscriptionModal .fw-bold');
    
    if (billingCycleSelect && totalAmount) {
        billingCycleSelect.addEventListener('change', function() {
            // This would typically update the total based on the selected billing cycle
            // For now, we'll just show a placeholder
            const cycle = this.value;
            const baseAmount = '{{ $this->getSubscriptionPrice() }}';
            
            if (cycle === 'yearly') {
                // Apply yearly discount (10% off)
                const yearlyAmount = parseFloat(baseAmount) * 12 * 0.9;
                totalAmount.textContent = '{{ $store->currency_symbol }}' + yearlyAmount.toFixed(2);
            } else {
                totalAmount.textContent = '{{ $store->currency_symbol }}{{ $this->getSubscriptionPrice() }}';
            }
        });
    }
});
</script>