@extends('layouts.frontend.store.app')

@section('content')
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
                <a href="{{ route('store.settings.subscription', ['store' => request()->route('store')]) }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Back to Subscription
                </a>
            </div>
        </div>
    </div>

    <!-- Plans Section -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
        <!-- Free Plan -->
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-light text-center py-4">
                    <h5 class="mb-0">Free</h5>
                    <p class="text-muted mb-0">For individuals</p>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="mb-0">$0</h2>
                        <p class="text-muted">forever</p>
                    </div>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Up to 10 Products
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            500 MB Storage
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            1 Staff Account
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            2 Categories
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Basic Analytics
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-x text-danger me-2"></i>
                            Community Support Only
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center opacity-50">
                            <i class="bi bi-x text-danger me-2"></i>
                            Custom Domain
                        </li>
                    </ul>
                    
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-primary" data-plan="free" data-bs-toggle="modal" data-bs-target="#selectPlanModal">Select Plan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Plan -->
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-light text-center py-4">
                    <h5 class="mb-0">Basic</h5>
                    <p class="text-muted mb-0">For small businesses</p>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="monthly-price">
                            <h2 class="mb-0">$29.99</h2>
                            <p class="text-muted">per month</p>
                        </div>
                        <div class="yearly-price d-none">
                            <h2 class="mb-0">$287.90</h2>
                            <p class="text-muted">per year <span class="text-success">(Save $71.98)</span></p>
                        </div>
                    </div>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Up to 100 Products
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            2 GB Storage
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            2 Staff Accounts
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            5 Categories
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Basic Analytics
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Email Support
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-x text-danger me-2"></i>
                            Custom Domain
                        </li>
                    </ul>
                    
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-primary" data-plan="basic" data-bs-toggle="modal" data-bs-target="#selectPlanModal">Select Plan</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Premium Plan -->
        <div class="col">
            <div class="card h-100 shadow-sm border-primary">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h5 class="mb-0">Premium</h5>
                    <p class="mb-0 opacity-75">For growing businesses</p>
                    <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning text-dark">
                        Popular
                    </span>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="monthly-price">
                            <h2 class="mb-0">$49.99</h2>
                            <p class="text-muted">per month</p>
                        </div>
                        <div class="yearly-price d-none">
                            <h2 class="mb-0">$479.90</h2>
                            <p class="text-muted">per year <span class="text-success">(Save $119.98)</span></p>
                        </div>
                    </div>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Up to 500 Products
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            5 GB Storage
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            5 Staff Accounts
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            10 Categories
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Advanced Analytics
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            24/7 Support
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Custom Domain
                        </li>
                    </ul>
                    
                    <div class="d-grid">
                        <button type="button" class="btn btn-primary" data-plan="premium" data-bs-toggle="modal" data-bs-target="#selectPlanModal">Select Plan</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pro Plan -->
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h5 class="mb-0">Pro</h5>
                    <p class="mb-0 opacity-75">For established businesses</p>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="monthly-price">
                            <h2 class="mb-0">$99.99</h2>
                            <p class="text-muted">per month</p>
                        </div>
                        <div class="yearly-price d-none">
                            <h2 class="mb-0">$959.90</h2>
                            <p class="text-muted">per year <span class="text-success">(Save $239.98)</span></p>
                        </div>
                    </div>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Unlimited Products
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            20 GB Storage
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Unlimited Staff Accounts
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Unlimited Categories
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Premium Analytics
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Priority 24/7 Support
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            Custom Domain
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            API Access
                        </li>
                        <li class="list-group-item px-0 d-flex align-items-center">
                            <i class="bi bi-check2 text-success me-2"></i>
                            White-label Option
                        </li>
                    </ul>
                    
                    <div class="d-grid">
                        <button type="button" class="btn btn-dark" data-plan="pro" data-bs-toggle="modal" data-bs-target="#selectPlanModal">Select Plan</button>
                    </div>
                </div>
            </div>
        </div>
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
</div>

<!-- Plan Selection Modal -->
<div class="modal fade" id="selectPlanModal" tabindex="-1" aria-labelledby="selectPlanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectPlanModalLabel">Complete Your Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subscriptionForm" action="{{ route('store.subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" id="selectedPlan" value="">
                    <input type="hidden" name="billing_cycle" id="billingCycleField" value="monthly">
                    <input type="hidden" name="store" value="{{ request()->route('store') }}">
                    
                    <div class="row">
                        <!-- Summary Column -->
                        <div class="col-md-7 border-end">
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
                                        <select class="form-select" id="billingCycle" name="billing_cycle">
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly (Save 20%)</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="couponCode" class="form-label">Coupon Code <span class="text-muted">(optional)</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="couponCode" name="coupon_used" placeholder="Enter coupon code">
                                            <button class="btn btn-outline-secondary" type="button" id="applyCoupon">Apply</button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="autoRenew" name="auto_renew" value="1" checked>
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
                        </div>
                        
                        <!-- Payment Column -->
                        <div class="col-md-5">
                            <h4 class="mb-4">Payment Method</h4>
                            
                            <div class="mb-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                    <label class="form-check-label" for="creditCard">
                                        Credit Card
                                    </label>
                                </div>
                                
                                <div id="creditCardForm">
                                    <div class="mb-3">
                                        <label for="cardNumber" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="expiryDate" class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" placeholder="123">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cardName" class="form-label">Name on Card</label>
                                        <input type="text" class="form-control" id="cardName" placeholder="John Doe">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                                    <label class="form-check-label" for="paypal">
                                        PayPal
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="savePaymentMethod" name="save_payment_method" value="1">
                                <label class="form-check-label" for="savePaymentMethod">
                                    Save this payment method for future transactions
                                </label>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Complete Purchase
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

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
            const plan = this.dataset.plan;
            let planName, monthlyPrice, yearlyPrice;
            
            // Set plan details based on selection
            switch(plan) {
                case 'free':
                    planName = 'Free Plan';
                    monthlyPrice = '$0.00';
                    yearlyPrice = '$0.00';
                    break;
                case 'basic':
                    planName = 'Basic Plan';
                    monthlyPrice = '$29.99';
                    yearlyPrice = '$287.90';
                    break;
                case 'premium':
                    planName = 'Premium Plan';
                    monthlyPrice = '$49.99';
                    yearlyPrice = '$479.90';
                    break;
                case 'pro':
                    planName = 'Pro Plan';
                    monthlyPrice = '$99.99';
                    yearlyPrice = '$959.90';
                    break;
            }
            
            // Set the selected plan in the hidden field
            document.getElementById('selectedPlan').value = plan;
            
            // Update modal content
            document.getElementById('modalPlanName').textContent = planName;
            document.getElementById('modalPlanPrice').textContent = `${monthlyPrice}/month`;
            document.getElementById('modalSubtotal').textContent = monthlyPrice;
            document.getElementById('modalTotal').textContent = monthlyPrice;
            
            // Set initial billing cycle based on main toggle
            const isYearly = document.getElementById('billingToggle').checked;
            const billingCycleSelect = document.getElementById('billingCycle');
            billingCycleSelect.value = isYearly ? 'yearly' : 'monthly';
            document.getElementById('billingCycleField').value = billingCycleSelect.value;
            
            updateModalPrices();
        });
    });
    
    // Update prices when billing cycle changes in modal
    document.getElementById('billingCycle').addEventListener('change', function() {
        // Update the hidden field
        document.getElementById('billingCycleField').value = this.value;
        updateModalPrices();
    });
    
    function updateModalPrices() {
        const billingCycle = document.getElementById('billingCycle').value;
        const planName = document.getElementById('modalPlanName').textContent;
        let price;
        
        // Get price based on plan and billing cycle
        switch(planName) {
            case 'Free Plan':
                price = '$0.00';
                break;
            case 'Basic Plan':
                price = billingCycle === 'monthly' ? '$29.99' : '$287.90';
                break;
            case 'Premium Plan':
                price = billingCycle === 'monthly' ? '$49.99' : '$479.90';
                break;
            case 'Pro Plan':
                price = billingCycle === 'monthly' ? '$99.99' : '$959.90';
                break;
        }
        
        // Update modal prices
        document.getElementById('modalPlanPrice').textContent = `${price}/${billingCycle === 'monthly' ? 'month' : 'year'}`;
        document.getElementById('modalSubtotal').textContent = price;
        document.getElementById('modalTotal').textContent = price;
    }
    
    // Apply coupon button
    document.getElementById('applyCoupon').addEventListener('click', function() {
        const couponInput = document.getElementById('couponCode');
        const couponCode = couponInput.value.trim();
        
        if (!couponCode) {
            alert('Please enter a coupon code');
            return;
        }
        
        // Here you would typically validate the coupon code with an API call
        // For now, we'll just show a placeholder success message
        alert('Coupon applied successfully!');
        
        // In a real implementation, you would apply the discount to the total
        // and update the displayed prices
    });
    
    // Form validation before submission
    document.getElementById('subscriptionForm').addEventListener('submit', function(event) {
        const selectedPlan = document.getElementById('selectedPlan').value;
        
        // For the free plan, we may want to skip payment details
        if (selectedPlan === 'free') {
            // Skip validation for payment fields for free plan
            return true;
        }
        
        // For paid plans, validate payment information
        const cardNumber = document.getElementById('cardNumber').value.trim();
        const expiryDate = document.getElementById('expiryDate').value.trim();
        const cvv = document.getElementById('cvv').value.trim();
        const cardName = document.getElementById('cardName').value.trim();
        
        // Check if credit card is selected
        if (document.getElementById('creditCard').checked) {
            if (!cardNumber || !expiryDate || !cvv || !cardName) {
                event.preventDefault();
                alert('Please fill in all credit card details');
                return false;
            }
        }
        
        return true;
    });
</script>
@endpush
