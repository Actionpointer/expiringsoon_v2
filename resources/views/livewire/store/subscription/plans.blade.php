<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1 class="mb-3">Choose the Right Plan for Your Business</h1>
            <p class="lead text-muted mb-4">All plans include a 14-day free trial with no credit card required</p>

            <!-- Billing Toggle -->
            <div class="d-flex justify-content-center align-items-center mb-4">
                <span class="me-3 fw-medium">Monthly</span>
                <div class="form-check form-switch form-switch-lg">
                    <input class="form-check-input" type="checkbox" id="billingToggle">
                </div>
                <span class="ms-3 fw-medium">Yearly <span class="badge bg-success ms-2">Save 20%</span></span>
            </div>

            <!-- Back Button -->
            <div class="mt-3">
                <a href="{{$subscription_url}}" class="text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back to Subscription
                </a>
            </div>
        </div>
    </div>

    <!-- Plans Section -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
        @foreach($plans as $plan)
        <div class="col">
            <div class="card h-100 shadow-sm {{ $plan->is_default ? 'border border-primary' : '' }}">
                @if($plan->is_default)
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <span class="badge bg-primary">Default</span>
                </div>
                @endif
                
                <div class="card-header bg-light text-center py-4">
                    <h5 class="mb-0">{{ $plan->name }}</h5>
                    <p class="text-muted mb-0">{{ $plan->description }}</p>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="mb-0 monthly-price">{{ $plan->monthly_price ? $country->currency_symbol . $plan->monthly_price : 'Free' }}</h2>
                        <h2 class="mb-0 yearly-price d-none">{{ $plan->annual_price ? $country->currency_symbol . $plan->annual_price : 'Free' }}</h2>
                        <p class="text-muted monthly-price">per month</p>
                        <p class="text-muted yearly-price d-none">per year</p>
                    </div>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Up to {{ $plan->products }} Products
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            {{ $plan->storage_mb }} MB Storage
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            {{ $plan->staff }} Staff Account{{ $plan->staff !== 1 ? 's' : '' }}
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            {{ $plan->newsletter_credits }} Newsletter Credits
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            {{ $plan->commission }}% Commission
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Min Withdrawal: {{ $country->currency_symbol }}{{ $plan->minimum_withdrawal }}
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            {{ ucwords(str_replace('_', ' ', $plan->withdrawal_interval)) }} Withdrawals
                        </li>
                    </ul>

                    <div class="d-grid">
                        <button type="button" class="btn {{ $plan->is_default ? 'btn-primary' : 'btn-outline-primary' }}" 
                            data-plan="{{ $plan->id }}"
                            data-name="{{ $plan->name }}"
                            data-monthly="{{ $plan->monthly_price }}"
                            data-annual="{{ $plan->annual_price }}"
                            data-currency="{{ $country->currency_symbol }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#selectPlanModal">
                            Select Plan
                        </button>
                    </div>
                </div>
                
                @if(!$plan->is_active)
                <div class="card-footer text-center text-muted bg-light">
                    <span class="badge bg-danger">Inactive</span>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Can I upgrade or downgrade my plan later?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, you can upgrade or downgrade your plan at any time. When you upgrade, you'll be charged the prorated difference for the remainder of your billing cycle. When you downgrade, the changes will take effect at the start of your next billing cycle.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            What happens when I reach my plan limits?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You'll receive notifications as you approach your plan limits. Once you reach a limit, you'll need to upgrade to a higher plan to add more resources, or remove some existing items to make room for new ones.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Do you offer refunds?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We offer a 14-day money-back guarantee on all paid plans. If you're not satisfied with our service within the first 14 days, you can request a full refund. After this period, we do not offer prorated refunds for unused time.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="faqFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We accept all major credit cards (Visa, Mastercard, American Express, Discover), PayPal, and bank transfers for yearly plans. All payments are processed securely through our payment processor.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Plan Selection Modal -->
    <div wire:ignore class="modal fade" id="selectPlanModal" tabindex="-1" aria-labelledby="selectPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectPlanModalLabel">Complete Your Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="subscriptionForm" wire:submit.prevent="processSubscription">
                        <input type="hidden" name="plan_id" id="selectedPlan" wire:model="selectedPlanId">
                        <input type="hidden" name="billing_cycle" id="billingCycleField" wire:model="billingCycle">
                        <input type="hidden" name="store" value="{{ request()->route('store') }}">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">Order Summary</h4>

                                <!-- Selected Plan -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-shape icon-md bg-primary text-white rounded-3 me-3">
                                                <i class="bi bi-award fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 id="modalPlanName" class="mb-0">Premium Plan</h5>
                                                <p id="modalPlanPrice" class="mb-0 text-muted">$49.99/month</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="billingCycle" class="form-label">Billing Cycle</label>
                                            <select class="form-select" id="billingCycle" wire:model="billingCycle">
                                                <option value="monthly">Monthly</option>
                                                <option value="yearly">Yearly (Save 20%)</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="couponCode" class="form-label">Coupon Code <span class="text-muted">(optional)</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="couponCode" wire:model="couponCode" placeholder="Enter coupon code">
                                                <button class="btn btn-outline-secondary" type="button" wire:click="applyCoupon">Apply</button>
                                            </div>
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="autoRenew" wire:model="autoRenew" value="1" checked>
                                            <label class="form-check-label" for="autoRenew">
                                                Auto-renew subscription
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-between border-top pt-3 mt-3">
                                            <span class="fw-medium">Subtotal</span>
                                            <span id="modalSubtotal">$49.99</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-medium">Tax</span>
                                            <span id="modalTax">$0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-top pt-3 mt-3">
                                            <span class="fw-bold">Total</span>
                                            <span id="modalTotal" class="fw-bold">$49.99</span>
                                    </div>
                                </div>
                            </div>

                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    You will be redirected to our secure payment gateway to complete your purchase.
                                </div>

                                <div class="d-grid gap-2 col-md-6 mx-auto mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-lock-fill me-2"></i>Proceed to Payment
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // Toggle between monthly and yearly pricing
    document.getElementById('billingToggle').addEventListener('change', function() {
        const monthlyPrices = document.querySelectorAll('.monthly-price');
        const yearlyPrices = document.querySelectorAll('.yearly-price');

        if (this.checked) {
            // Show yearly prices
            monthlyPrices.forEach(el => el.classList.add('d-none'));
            yearlyPrices.forEach(el => el.classList.remove('d-none'));
        } else {
            // Show monthly prices
            monthlyPrices.forEach(el => el.classList.remove('d-none'));
            yearlyPrices.forEach(el => el.classList.add('d-none'));
        }
    });

    // Plan selection modal setup
    const planButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-plan]');
    planButtons.forEach(button => {
        button.addEventListener('click', function() {
            const planId = this.dataset.plan;
            const planName = this.dataset.name;
            const monthlyPrice = this.dataset.monthly;
            const annualPrice = this.dataset.annual;
            const currencySymbol = this.dataset.currency;

            // Set the selected plan in the hidden field and update Livewire property
            document.getElementById('selectedPlan').value = planId;
            window.Livewire.dispatch('planSelected', {planId: planId});

            // Update modal content
            document.getElementById('modalPlanName').textContent = planName;
            console.log(planName)
            // Set initial billing cycle based on main toggle
            const isYearly = document.getElementById('billingToggle').checked;
            const billingCycleSelect = document.getElementById('billingCycle');
            billingCycleSelect.value = isYearly ? 'yearly' : 'monthly';
            
            // Trigger change event to update Livewire property
            const event = new Event('change');
            billingCycleSelect.dispatchEvent(event);
            window.Livewire.dispatch('billingCycleChanged', {cycle:billingCycleSelect.value});
            
            // Update hidden field
            document.getElementById('billingCycleField').value = billingCycleSelect.value;

            // Set the current price based on selected billing cycle
            const currentPrice = isYearly ? annualPrice : monthlyPrice;
            const formattedPrice = currentPrice == 0 ? 'Free' : `${currencySymbol}${currentPrice}`;
            const pricePeriod = isYearly ? '/year' : '/month';
            
            document.getElementById('modalPlanPrice').textContent = currentPrice == 0 ? 'Free' : `${formattedPrice}${pricePeriod}`;
            document.getElementById('modalSubtotal').textContent = formattedPrice;
            document.getElementById('modalTotal').textContent = formattedPrice;
        });
    });

    // Update prices when billing cycle changes in modal
    document.getElementById('billingCycle').addEventListener('change', function() {
        // Update the hidden field
        document.getElementById('billingCycleField').value = this.value;
        
        // Get the selected plan button
        const planId = document.getElementById('selectedPlan').value;
        const planButton = document.querySelector(`[data-plan="${planId}"]`);
        
        if (planButton) {
            const monthlyPrice = planButton.dataset.monthly;
            const annualPrice = planButton.dataset.annual;
            const currencySymbol = planButton.dataset.currency;
            
            // Get price based on selected billing cycle
            const isYearly = this.value === 'yearly';
            const currentPrice = isYearly ? annualPrice : monthlyPrice;
            const formattedPrice = currentPrice == 0 ? 'Free' : `${currencySymbol}${currentPrice}`;
            const pricePeriod = isYearly ? '/year' : '/month';

        // Update modal prices
            document.getElementById('modalPlanPrice').textContent = currentPrice == 0 ? 'Free' : `${formattedPrice}${pricePeriod}`;
            document.getElementById('modalSubtotal').textContent = formattedPrice;
            document.getElementById('modalTotal').textContent = formattedPrice;
            
            // Notify Livewire of change
            window.Livewire.dispatch('billingCycleChanged',{cycle:this.value});
        }
    });

    // Apply coupon button functionality now handled by Livewire
</script>
@endpush
