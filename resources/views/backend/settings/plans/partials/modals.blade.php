<!-- Add Subscription Plan Modal -->
<div class="modal fade" id="addSubscriptionPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Subscription Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addSubscriptionPlanForm">
                    <!-- Basic Plan Info -->
                    <div class="mb-4">
                        <label class="form-label">Plan Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Number of Shops</label>
                            <input type="number" class="form-control" name="shops" required min="0">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Products per Shop</label>
                            <input type="number" class="form-control" name="products" required min="0">
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="mb-4">
                        <label class="form-label">Pricing & Commission</label>
                        <div id="subscriptionPricing">
                            <div class="pricing-block mb-4">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Currency</label>
                                        <select class="form-select" name="prices[0][currency_code]" required>
                                            @foreach($currencies as $currency)
                                            <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Commission Settings -->
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Minimum Payout</label>
                                        <input type="number" class="form-control" name="prices[0][minimum_payout]" required min="0" step="0.01">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Maximum Payout</label>
                                        <input type="number" class="form-control" name="prices[0][maximum_payout]" required min="0" step="0.01">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Commission Percentage (%)</label>
                                        <input type="number" class="form-control" name="prices[0][commission_percentage]" required min="0" max="100" step="0.01">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Fixed Commission</label>
                                        <input type="number" class="form-control" name="prices[0][commission_fixed]" required min="0" step="0.01">
                                    </div>
                                </div>

                                <!-- Subscription Periods -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-3 mb-3">
                                        <label class="form-label">1 Month</label>
                                        <input type="number" class="form-control" name="prices[0][months_1]" required min="0" step="0.01">
                                    </div>
                                    <div class="col-sm-6 col-md-3 mb-3">
                                        <label class="form-label">3 Months</label>
                                        <input type="number" class="form-control" name="prices[0][months_3]" required min="0" step="0.01">
                                    </div>
                                    <div class="col-sm-6 col-md-3 mb-3">
                                        <label class="form-label">6 Months</label>
                                        <input type="number" class="form-control" name="prices[0][months_6]" required min="0" step="0.01">
                                    </div>
                                    <div class="col-sm-6 col-md-3 mb-3">
                                        <label class="form-label">12 Months</label>
                                        <input type="number" class="form-control" name="prices[0][months_12]" required min="0" step="0.01">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="addSubscriptionPricingBlock()">
                            <i class="bi-plus"></i> Add Currency
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Plan</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Ad Plan Modal -->
<div class="modal fade" id="addAdPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ad Format</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addAdPlanForm">
                    <div class="mb-4">
                        <label class="form-label">Format Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type" required>
                                <option value="banner">Banner</option>
                                <option value="popup">Popup</option>
                                <option value="sidebar">Sidebar</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Width (px)</label>
                            <input type="number" class="form-control" name="width">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Height (px)</label>
                            <input type="number" class="form-control" name="height">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Instructions</label>
                        <textarea class="form-control" name="instruction" rows="3" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Pricing</label>
                        <div id="adPricing">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <select class="form-select" name="prices[0][currency_id]" required>
                                        @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="prices[0][amount]" placeholder="Amount" required step="0.01">
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-select" name="prices[0][duration]" required>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="addPricingRow('ad')">
                            <i class="bi-plus"></i> Add Price
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Format</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Newsletter Plan Modal -->
<div class="modal fade" id="addNewsletterPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Credit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addNewsletterPlanForm">
                    <div class="mb-4">
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Credits</label>
                        <input type="number" class="form-control" name="credits" required min="1">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Pricing</label>
                        <div id="newsletterPricing">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <select class="form-select" name="prices[0][currency_id]" required>
                                        @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="prices[0][amount]" placeholder="Amount" required step="0.01">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="addPricingRow('newsletter')">
                            <i class="bi-plus"></i> Add Price
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Package</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Plan Modal -->
<div class="modal fade" id="deletePlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deletePlanType">
                <input type="hidden" id="deletePlanId">
                
                <p>Are you sure you want to delete <span id="deletePlanName" class="fw-bold"></span>?</p>
                <p class="text-danger mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete Plan</button>
            </div>
        </div>
    </div>
</div>

<!-- Configure Price Modal -->
<div class="modal fade" id="configurePriceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configure Price - <span id="configurePlanName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="configurePriceForm">
                    <input type="hidden" id="configurePlanId" name="plan_id">

                    <div class="mb-4">
                        <label class="form-label">Currency</label>
                        <select class="form-select" name="currency_code" required>
                            @foreach($currencies as $currency)
                            <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Commission Settings -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Minimum Payout</label>
                            <input type="number" class="form-control" name="minimum_payout" required min="0" step="0.01">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Maximum Payout</label>
                            <input type="number" class="form-control" name="maximum_payout" required min="0" step="0.01">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Commission Percentage (%)</label>
                            <input type="number" class="form-control" name="commission_percentage" required min="0" max="100" step="0.01">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Fixed Commission</label>
                            <input type="number" class="form-control" name="commission_fixed" required min="0" step="0.01">
                        </div>
                    </div>

                    <!-- Subscription Periods -->
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">1 Month</label>
                            <input type="number" class="form-control" name="months_1" required min="0" step="0.01">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">3 Months</label>
                            <input type="number" class="form-control" name="months_3" required min="0" step="0.01">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">6 Months</label>
                            <input type="number" class="form-control" name="months_6" required min="0" step="0.01">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">12 Months</label>
                            <input type="number" class="form-control" name="months_12" required min="0" step="0.01">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Configuration</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Updated function to add subscription pricing block
    function addSubscriptionPricingBlock() {
        const container = document.getElementById('subscriptionPricing');
        const blockCount = container.children.length;
        
        const block = document.createElement('div');
        block.className = 'pricing-block mb-4';
        block.innerHTML = `
            <hr class="my-4">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label class="form-label">Currency</label>
                    <select class="form-select" name="prices[${blockCount}][currency_code]" required>
                        @foreach($currencies as $currency)
                        <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Commission Settings -->
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label class="form-label">Minimum Payout</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][minimum_payout]" required min="0" step="0.01">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Maximum Payout</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][maximum_payout]" required min="0" step="0.01">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <label class="form-label">Commission Percentage (%)</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][commission_percentage]" required min="0" max="100" step="0.01">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Fixed Commission</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][commission_fixed]" required min="0" step="0.01">
                </div>
            </div>

            <!-- Subscription Periods -->
            <div class="row">
                <div class="col-sm-6 col-md-3 mb-3">
                    <label class="form-label">1 Month</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][months_1]" required min="0" step="0.01">
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <label class="form-label">3 Months</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][months_3]" required min="0" step="0.01">
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <label class="form-label">6 Months</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][months_6]" required min="0" step="0.01">
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <label class="form-label">12 Months</label>
                    <input type="number" class="form-control" name="prices[${blockCount}][months_12]" required min="0" step="0.01">
                </div>
            </div>
        `;
        
        container.appendChild(block);
    }

    // Function to add pricing row
    function addPricingRow(type) {
        const container = document.getElementById(`${type}Pricing`);
        const rowCount = container.children.length;
        
        const row = document.createElement('div');
        row.className = 'row mb-3';
        
        if (type === 'newsletter') {
            row.innerHTML = `
                <div class="col-sm-6">
                    <select class="form-select" name="prices[${rowCount}][currency_id]" required>
                        @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="prices[${rowCount}][amount]" placeholder="Amount" required step="0.01">
                </div>
            `;
        } else {
            row.innerHTML = `
                <div class="col-sm-4">
                    <select class="form-select" name="prices[${rowCount}][currency_id]" required>
                        @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="prices[${rowCount}][amount]" placeholder="Amount" required step="0.01">
                </div>
                <div class="col-sm-4">
                    <select class="form-select" name="prices[${rowCount}][${type === 'subscription' ? 'interval' : 'duration'}]" required>
                        ${type === 'subscription' ? `
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        ` : `
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        `}
                    </select>
                </div>
            `;
        }
        
        container.appendChild(row);
    }

    // Function to handle plan deletion
    function deletePlan(type, id, name) {
        document.getElementById('deletePlanType').value = type;
        document.getElementById('deletePlanId').value = id;
        document.getElementById('deletePlanName').textContent = name;
    }

    function configurePlanPrice(planId, planName) {
        document.getElementById('configurePlanId').value = planId;
        document.getElementById('configurePlanName').textContent = planName;
    }

    // Function to edit existing price configuration
    function editPriceConfig(planId, planName, priceConfig) {
        document.getElementById('configurePlanId').value = planId;
        document.getElementById('configurePlanName').textContent = planName;
        
        // Populate form with existing values
        const form = document.getElementById('configurePriceForm');
        form.querySelector('[name="currency_code"]').value = priceConfig.currency_code;
        form.querySelector('[name="currency_code"]').disabled = true; // Prevent currency change in edit mode
        form.querySelector('[name="minimum_payout"]').value = priceConfig.minimum_payout;
        form.querySelector('[name="maximum_payout"]').value = priceConfig.maximum_payout;
        form.querySelector('[name="commission_percentage"]').value = priceConfig.commission_percentage;
        form.querySelector('[name="commission_fixed"]').value = priceConfig.commission_fixed;
        form.querySelector('[name="months_1"]').value = priceConfig.months_1;
        form.querySelector('[name="months_3"]').value = priceConfig.months_3;
        form.querySelector('[name="months_6"]').value = priceConfig.months_6;
        form.querySelector('[name="months_12"]').value = priceConfig.months_12;
    }

    // Function to add new price configuration
    function addPriceConfig(planId, planName, existingCurrencies) {
        document.getElementById('configurePlanId').value = planId;
        document.getElementById('configurePlanName').textContent = planName;
        
        // Reset form
        const form = document.getElementById('configurePriceForm');
        form.reset();
        
        // Enable currency selection
        const currencySelect = form.querySelector('[name="currency_code"]');
        currencySelect.disabled = false;
        
        // Remove already configured currencies from options
        Array.from(currencySelect.options).forEach(option => {
            option.disabled = existingCurrencies.includes(option.value);
        });
    }
</script>
@endpush 