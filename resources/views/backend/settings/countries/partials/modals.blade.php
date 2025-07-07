<!-- Add Subscription Plan Modal -->
<div class="modal fade" id="addSubscriptionPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="addSubscriptionPlanForm" action="{{route('admin.settings.countries.subscription_plan.store')}}" method="post">
            @csrf
            <input type="hidden" name="country_id" value="{{$country->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Subscription Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                    
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
                            <div class="col-sm-4">
                                <label class="form-label">Commission Percentage (%)</label>
                                <input type="number" class="form-control" name="commission" required min="0" max="100" step="0.01">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Number of Products</label>
                                <input type="number" class="form-control" name="products" required min="0">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Number of Staff</label>
                                <input type="number" class="form-control" name="staff" required min="0">
                            </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                                <label class="form-label">Storage Space (MB)</label>
                                <input type="number" class="form-control" name="storage_mb" required min="0">
                        </div>
                        <div class="col-sm-6">
                                <label class="form-label">Newsletter Credits</label>
                                <input type="number" class="form-control" name="newsletter_credits" required min="0">
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="mb-4">
                            <h5>Pricing</h5>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Monthly Price ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="monthly_price" required min="0" step="0.01">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Yearly Price ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="annual_price" required min="0" step="0.01">
                                </div>
                            </div>
                        </div>

                        <!-- Withdrawal Settings -->
                        <div class="mb-4">
                            <h5>Withdrawal Settings</h5>
                                <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Withdrawal Timeframe</label>
                                    <select class="form-select" name="withdrawal_interval" required>
                                        <option value="instant">Instant (0-2 hours)</option>
                                        <option value="same_day">Same Day</option>
                                        <option value="next_day">Next Day</option>
                                        <option value="2-3_days">2-3 Days</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Number of Withdrawals/month</label>
                                    <input type="number" class="form-control" name="withdrawal_count" required min="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Minimum Withdrawal ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="minimum_withdrawal" required min="0" step="0.01">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Maximum Withdrawal ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="maximum_withdrawal" required min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Plan Settings -->
                        <div class="mb-4">
                            <h5>Plan Settings</h5>
                            <div class="row">
                                    <div class="col-sm-4">
                                    <div class="form-check form-switch mb-3">
                                        <input type="checkbox" class="form-check-input" id="is_public" name="is_public" value="1" checked>
                                        <label class="form-check-label">Public Plan</label>
                                        <div class="form-text">Show on pricing page</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-3">
                                        <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1">
                                        <label class="form-check-label">Default Plan</label>
                                        <div class="form-text">Users fall back to this when subscription ends</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-3">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                                        <label class="form-check-label">Active Plan</label>
                                        <div class="form-text">Plan is available for purchase</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Plan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Subscription Plan Modal -->
<div class="modal fade" id="editSubscriptionPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="editSubscriptionPlanForm" action="{{route('admin.settings.countries.subscription_plan.update')}}" method="post">
            @csrf
            <input type="hidden" name="country_id" value="{{$country->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subscription Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                        <input type="hidden" name="plan_id" id="edit_id">
                        
                        <!-- Basic Plan Info -->
                        <div class="mb-4">
                            <label class="form-label">Plan Name</label>
                            <input type="text" class="form-control" name="name" id="edit_name" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit_description" rows="3" required></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label class="form-label">Commission Percentage (%)</label>
                                <input type="number" class="form-control" name="commission" id="edit_commission" required min="0" max="100" step="0.01">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Number of Products</label>
                                <input type="number" class="form-control" name="products" id="edit_products" required min="0">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Number of Staff</label>
                                <input type="number" class="form-control" name="staff" id="edit_staff" required min="0">
                                    </div>
                                </div>

                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Storage Space (MB)</label>
                                <input type="number" class="form-control" name="storage_mb" id="edit_storage_mb" required min="0">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Newsletter Credits</label>
                                <input type="number" class="form-control" name="newsletter_credits" id="edit_newsletter_credits" required min="0">
                            </div>
                        </div>

                        <!-- Pricing Section -->
                        <div class="mb-4">
                            <h5>Pricing</h5>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Monthly Price ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="monthly_price" id="edit_price_monthly" required min="0" step="0.01">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Yearly Price ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="annual_price" id="edit_price_yearly" required min="0" step="0.01">
                                </div>
                            </div>
                        </div>

                        <!-- Withdrawal Settings -->
                        <div class="mb-4">
                            <h5>Withdrawal Settings</h5>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                    <label class="form-label">Withdrawal Timeframe</label>
                                    <select class="form-select" name="withdrawal_interval" id="edit_withdrawal_interval" required>
                                        <option value="instant">Instant (0-2 hours)</option>
                                        <option value="same_day">Same Day</option>
                                        <option value="next_day">Next Day</option>
                                        <option value="2-3_days">2-3 Days</option>
                                    </select>
                                    </div>
                                    <div class="col-sm-6">
                                    <label class="form-label">Number of Withdrawals/month</label>
                                    <input type="number" class="form-control" name="withdrawal_count" id="edit_withdrawal_count" required min="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Minimum Withdrawal ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="minimum_withdrawal" id="edit_min_withdrawal" required min="0" step="0.01">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Maximum Withdrawal ({{ $country->currency_symbol }})</label>
                                    <input type="number" class="form-control" name="maximum_withdrawal" id="edit_max_withdrawal" required min="0" step="0.01">
                                </div>
                                    </div>
                                </div>

                        <!-- Plan Settings -->
                        <div class="mb-4">
                            <h5>Plan Settings</h5>
                                <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-3">
                                        <input type="checkbox" class="form-check-input" id="edit_is_public" name="is_public" value="1">
                                        <label class="form-check-label">Public Plan</label>
                                        <div class="form-text">Show on pricing page</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-3">
                                        <input type="checkbox" class="form-check-input" id="edit_is_default" name="is_default" value="1">
                                        <label class="form-check-label">Default Plan</label>
                                        <div class="form-text">Users fall back to this when subscription ends</div>
                                    </div>
                                    </div>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-3">
                                        <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active" value="1">
                                        <label class="form-check-label">Active Plan</label>
                                        <div class="form-text">Plan is available for purchase</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" >Save Changes</button>
                </div>
                    </div>
                </form>
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
                <button type="button" class="btn btn-danger" id="confirmDeletePlanBtn">Delete Plan</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Ad Plan Modal -->
<div class="modal fade" id="addAdPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="addAdPlanForm" action="{{ route('admin.settings.countries.ad_plans.store') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Ad Format</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                        @csrf
                        <input type="hidden" name="country_id" value="{{ $country->id }}">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Plan Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type" required>
                                    <option value="banner">Banner</option>
                                    <option value="popup">Popup</option>
                                    <option value="sidebar">Sidebar</option>
                                    <option value="product">Product</option>
                                    <option value="coupon">Coupon</option>
                                    <option value="featured">Featured</option>
                                </select>
                            </div>
                        </div>

                        <!-- Placement & Format -->
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Placement</label>
                                <select class="form-select" name="placement" required>
                                    <option value="homepage_banner">Homepage Banner</option>
                                    <option value="product_sidebar">Product Sidebar</option>
                                    <option value="category_top">Category Top</option>
                                    <option value="search_results">Search Results</option>
                                    <option value="checkout_page">Checkout Page</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Format</label>
                                <select class="form-select" name="format" required>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="carousel">Carousel</option>
                                    <option value="text">Text Only</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dimensions -->
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Width (px)</label>
                                <input type="number" class="form-control" name="width" min="1">
                                <small class="form-text text-muted">Leave empty for responsive formats</small>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Height (px)</label>
                                <input type="number" class="form-control" name="height" min="1">
                                <small class="form-text text-muted">Leave empty for responsive formats</small>
                            </div>
                        </div>

                        <!-- Description & Instructions -->
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="2" required></textarea>
                            <small class="form-text text-muted">Explain what this ad format is for</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Instructions</label>
                            <textarea class="form-control" name="instruction" rows="2"></textarea>
                            <small class="form-text text-muted">Guidelines for advertisers creating ads in this format</small>
                        </div>

                        <!-- Device Restrictions -->
                        <div class="mb-4">
                            <label class="form-label">Device Availability</label>
                            <div class="d-flex">
                                <div class="form-check me-4">
                                    <input type="hidden" name="device_desktop" value="0" checked>
                                    <input class="form-check-input" type="checkbox" name="device_desktop" id="deviceDesktop" value="1" checked>
                                    <label class="form-check-label" for="deviceDesktop">Desktop</label>
                                </div>
                                <div class="form-check me-4">
                                    <input type="hidden" name="device_tablet" value="0" checked>
                                    <input class="form-check-input" type="checkbox" name="device_tablet" id="deviceTablet" value="1" checked>
                                    <label class="form-check-label" for="deviceTablet">Tablet</label>
                                </div>
                                <div class="form-check">
                                    <input type="hidden" name="device_mobile" value="0" checked>
                                    <input class="form-check-input" type="checkbox" name="device_mobile" id="deviceMobile" value="1" checked>
                                    <label class="form-check-label" for="deviceMobile">Mobile</label>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="mb-4">
                            <h5>Pricing</h5>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                    <label class="form-label">CPM Price ({{ $country->currency_symbol }})</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_cpm" required min="0" step="0.01" placeholder="0.00">
                                        <span class="input-group-text">per 1000</span>
                                    </div>
                                    <small class="form-text text-muted">Cost per 1000 impressions</small>
                                    </div>
                                    <div class="col-sm-4">
                                    <label class="form-label">CPC Price ({{ $country->currency_symbol }})</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_cpc" required min="0" step="0.01" placeholder="0.00">
                                        <span class="input-group-text">per click</span>
                                    </div>
                                    <small class="form-text text-muted">Cost per click</small>
                                    </div>
                                    <div class="col-sm-4">
                                    <label class="form-label">Fixed Price ({{ $country->currency_symbol }})</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_fixed" required min="0" step="0.01" placeholder="0.00">
                                        <span class="input-group-text">per day</span>
                                    </div>
                                    <small class="form-text text-muted">Fixed daily rate</small>
                                </div>
                            </div>
                            <div id="durationOptions" class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label">Available Durations</label>
                                    <div class="d-flex flex-wrap">
                                        <div class="form-check me-4 mb-2">
                                            <input type="hidden" name="duration_daily" value="0" checked>
                                            <input class="form-check-input" type="checkbox" name="duration_daily" id="durationDaily" value="1" checked>
                                            <label class="form-check-label" for="durationDaily">Daily</label>
                                        </div>
                                        <div class="form-check me-4 mb-2">
                                            <input type="hidden" name="duration_weekly" value="0" checked>
                                            <input class="form-check-input" type="checkbox" name="duration_weekly" id="durationWeekly" value="1" checked>
                                            <label class="form-check-label" for="durationWeekly">Weekly</label>
                                        </div>
                                        <div class="form-check me-4 mb-2">
                                            <input type="hidden" name="duration_monthly" value="0" checked>
                                            <input class="form-check-input" type="checkbox" name="duration_monthly" id="durationMonthly" value="1" checked>
                                            <label class="form-check-label" for="durationMonthly">Monthly</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0" checked>
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>
                            <small class="form-text text-muted">Deactivating will hide this ad format from advertisers</small>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Format</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Ad Plan Modal -->
<div class="modal fade" id="editAdPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="editAdPlanForm" action="{{ route('admin.settings.countries.ad_plans.update') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Ad Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="plan_id" id="edit_plan_id">
                        @csrf
                        <input type="hidden" name="country_id" id="edit_country_id" value="{{ $country->id }}">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Plan Name</label>
                                <input type="text" class="form-control" name="name" id="edit_adplan_name" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type" id="edit_adplan_type" required>
                                    <option value="banner">Banner</option>
                                    <option value="popup">Popup</option>
                                    <option value="sidebar">Sidebar</option>
                                    <option value="product">Product</option>
                                    <option value="coupon">Coupon</option>
                                    <option value="featured">Featured</option>
                                </select>
                            </div>
                        </div>

                        <!-- Placement & Format -->
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Placement</label>
                                <select class="form-select" name="placement" id="edit_adplan_placement" required>
                                    <option value="homepage_banner">Homepage Banner</option>
                                    <option value="product_sidebar">Product Sidebar</option>
                                    <option value="category_top">Category Top</option>
                                    <option value="search_results">Search Results</option>
                                    <option value="checkout_page">Checkout Page</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Format</label>
                                <select class="form-select" name="format" id="edit_adplan_format" required>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="carousel">Carousel</option>
                                    <option value="text">Text Only</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dimensions -->
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Width (px)</label>
                                <input type="number" class="form-control" name="width" id="edit_adplan_width" min="1">
                                <small class="form-text text-muted">Leave empty for responsive formats</small>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Height (px)</label>
                                <input type="number" class="form-control" name="height" id="edit_adlan_height" min="1">
                                <small class="form-text text-muted">Leave empty for responsive formats</small>
                            </div>
                        </div>

                        <!-- Description & Instructions -->
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit_adplan_description" rows="2" required></textarea>
                            <small class="form-text text-muted">Explain what this ad format is for</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Instructions</label>
                            <textarea class="form-control" name="instruction" id="edit_adplan_instruction" rows="2"></textarea>
                            <small class="form-text text-muted">Guidelines for advertisers creating ads in this format</small>
                        </div>

                        <!-- Device Restrictions -->
                        <div class="mb-4">
                            <label class="form-label">Device Availability</label>
                            <div class="d-flex">
                                <div class="form-check me-4">
                                    <input type="hidden" name="device_desktop" id="edit_adplan_device_desktop_hidden" value="0" checked>
                                    <input class="form-check-input" type="checkbox" name="device_desktop" id="edit_adplan_device_desktop" value="1" checked>
                                    <label class="form-check-label" for="edit_device_desktop">Desktop</label>
                                </div>
                                <div class="form-check me-4">
                                    <input type="hidden" name="device_tablet" id="edit_adplan_device_tablet_hidden" value="0" checked>
                                    <input class="form-check-input" type="checkbox" name="device_tablet" id="edit_adplan_device_tablet" value="1" checked>
                                    <label class="form-check-label" for="edit_device_tablet">Tablet</label>
                                </div>
                                <div class="form-check">
                                    <input type="hidden" name="device_mobile" id="edit_adplan_device_mobile_hidden" value="0" checked>
                                    <input class="form-check-input" type="checkbox" name="device_mobile" id="edit_adplan_device_mobile" value="1" checked>
                                    <label class="form-check-label" for="edit_device_mobile">Mobile</label>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="mb-4">
                            <h5>Pricing</h5>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                    <label class="form-label">CPM Price ({{ $country->currency_symbol }})</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_cpm" id="edit_adplan_price_cpm" required min="0" step="0.01" placeholder="0.00">
                                        <span class="input-group-text">per 1000</span>
                                    </div>
                                    <small class="form-text text-muted">Cost per 1000 impressions</small>
                                    </div>
                                    <div class="col-sm-4">
                                    <label class="form-label">CPC Price ({{ $country->currency_symbol }})</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_cpc" id="edit_adplan_price_cpc" required min="0" step="0.01" placeholder="0.00">
                                        <span class="input-group-text">per click</span>
                                    </div>
                                    <small class="form-text text-muted">Cost per click</small>
                                    </div>
                                    <div class="col-sm-4">
                                    <label class="form-label">Fixed Price ({{ $country->currency_symbol }})</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_fixed" id="edit_adplan_price_fixed" required min="0" step="0.01" placeholder="0.00">
                                        <span class="input-group-text">per day</span>
                                    </div>
                                    <small class="form-text text-muted">Fixed daily rate</small>
                                </div>
                            </div>
                            <div id="durationOptions" class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label">Available Durations</label>
                                    <div class="d-flex flex-wrap">
                                        <div class="form-check me-4 mb-2">
                                            <input type="hidden" name="duration_daily" id="edit_adplan_duration_daily_hidden" value="0" checked>
                                            <input class="form-check-input" type="checkbox" name="duration_daily" id="edit_adplan_duration_daily" value="1" checked>
                                            <label class="form-check-label" for="edit_duration_daily">Daily</label>
                                        </div>
                                        <div class="form-check me-4 mb-2">
                                            <input type="hidden" name="duration_weekly" id="edit_adplan_duration_weekly_hidden" value="0" checked>
                                            <input class="form-check-input" type="checkbox" name="duration_weekly" id="edit_adplan_duration_weekly" value="1" checked>
                                            <label class="form-check-label" for="edit_duration_weekly">Weekly</label>
                                        </div>
                                        <div class="form-check me-4 mb-2">
                                            <input type="hidden" name="duration_monthly" id="edit_adplan_duration_monthly_hidden" value="0" checked>
                                            <input class="form-check-input" type="checkbox" name="duration_monthly" id="edit_adplan_duration_monthly" value="1" checked>
                                            <label class="form-check-label" for="edit_duration_monthly">Monthly</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" id="edit_adplan_is_active_hidden" value="0" checked>
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit_adplan_is_active" value="1" checked>
                                <label class="form-check-label" for="edit_is_active">Active</label>
                            </div>
                            <small class="form-text text-muted">Deactivating will hide this ad format from advertisers</small>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Newsletter Plan Modal -->
<div class="modal fade" id="addNewsletterPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Newsletter Credit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addNewsletterPlanForm">
                    <!-- Basic Info -->
                    <div class="mb-4">
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="2" required></textarea>
                        <small class="form-text text-muted">Brief explanation of this credit package</small>
                    </div>

                    <!-- Credits & Pricing -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Number of Credits</label>
                            <input type="number" class="form-control" name="credits" required min="100" step="100">
                            <small class="form-text text-muted">1 credit = 1 email recipient</small>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Price ({{ $country->currency_symbol }})</label>
                            <input type="number" class="form-control" name="price" required min="0" step="0.01">
                        </div>
                    </div>

                    <!-- Additional Settings -->
                    <div class="mb-4">
                        <label class="form-label">Validity Period (days)</label>
                        <input type="number" class="form-control" name="validity_days" min="30" value="365">
                        <small class="form-text text-muted">How long credits remain valid after purchase</small>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Bonus Credits</label>
                            <input type="number" class="form-control" name="bonus_credits" min="0" value="0">
                            <small class="form-text text-muted">Extra credits included in this package</small>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Discount Percentage</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="discount_percentage" min="0" max="100" value="0">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="form-text text-muted">Discount off regular pricing</small>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActiveNewsletter" checked>
                            <label class="form-check-label" for="isActiveNewsletter">Active</label>
                        </div>
                        <small class="form-text text-muted">Deactivating will hide this package from the store</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveNewsletterPlan('add')">Add Package</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Newsletter Plan Modal -->
<div class="modal fade" id="editNewsletterPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Newsletter Credit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editNewsletterPlanForm">
                    <input type="hidden" name="plan_id" id="edit_adplan_newsletter_plan_id">
                    
                    <!-- Basic Info -->
                    <div class="mb-4">
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" id="edit_newsletter_name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_newsletter_description" rows="2" required></textarea>
                        <small class="form-text text-muted">Brief explanation of this credit package</small>
                    </div>

                    <!-- Credits & Pricing -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Number of Credits</label>
                            <input type="number" class="form-control" name="credits" id="edit_newsletter_credits" required min="100" step="100">
                            <small class="form-text text-muted">1 credit = 1 email recipient</small>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Price ({{ $country->currency_symbol }})</label>
                            <input type="number" class="form-control" name="price" id="edit_newsletter_price" required min="0" step="0.01">
                        </div>
                    </div>

                    <!-- Additional Settings -->
                    <div class="mb-4">
                        <label class="form-label">Validity Period (days)</label>
                        <input type="number" class="form-control" name="validity_days" id="edit_newsletter_validity_days" min="30">
                        <small class="form-text text-muted">How long credits remain valid after purchase</small>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Bonus Credits</label>
                            <input type="number" class="form-control" name="bonus_credits" id="edit_newsletter_bonus_credits" min="0">
                            <small class="form-text text-muted">Extra credits included in this package</small>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Discount Percentage</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="discount_percentage" id="edit_newsletter_discount_percentage" min="0" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="form-text text-muted">Discount off regular pricing</small>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="edit_newsletter_is_active">
                            <label class="form-check-label" for="edit_newsletter_is_active">Active</label>
                        </div>
                        <small class="form-text text-muted">Deactivating will hide this package from the store</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveNewsletterPlan('edit')">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    
    
    

    // Function to handle plan deletion
    function deletePlan(type, id, name) {
        document.getElementById('deletePlanType').value = type;
        document.getElementById('deletePlanId').value = id;
        document.getElementById('deletePlanName').textContent = name;
    }

    // Function to handle saving ad plans (add or edit)
    
    
    // Function to populate the edit form with existing ad plan data
    function editAdPlan(button) {
        // Get all data attributes from the clicked button
        const planData = {
            id: button.getAttribute('data-plan-id'),
            name: button.getAttribute('data-plan-name'),
            type: button.getAttribute('data-plan-type'),
            placement: button.getAttribute('data-plan-placement'),
            format: button.getAttribute('data-plan-format'),
            width: button.getAttribute('data-plan-width'),
            height: button.getAttribute('data-plan-height'),
            description: button.getAttribute('data-plan-description'),
            instruction: button.getAttribute('data-plan-instruction'),
            device_desktop: button.getAttribute('data-plan-device-desktop'),
            device_tablet: button.getAttribute('data-plan-device-tablet'),
            device_mobile: button.getAttribute('data-plan-device-mobile'),
            duration_daily: button.getAttribute('data-plan-duration-daily'),
            duration_weekly: button.getAttribute('data-plan-duration-weekly'),
            duration_monthly: button.getAttribute('data-plan-duration-monthly'),
            price_cpm: button.getAttribute('data-plan-price-cpm'),
            price_cpc: button.getAttribute('data-plan-price-cpc'),
            price_fixed: button.getAttribute('data-plan-price-fixed'),
            is_active: button.getAttribute('data-plan-is-active')
        };
        
        // Populate form fields with the data
        document.getElementById('edit_plan_id').value = planData.id;
        document.getElementById('edit_adplan_name').value = planData.name;
        document.getElementById('edit_adplan_type').value = planData.type;
        document.getElementById('edit_adplan_placement').value = planData.placement;
        document.getElementById('edit_adplan_format').value = planData.format;
        document.getElementById('edit_adplan_width').value = planData.width || '';
        document.getElementById('edit_adlan_height').value = planData.height || '';
        document.getElementById('edit_adplan_description').value = planData.description;
        document.getElementById('edit_adplan_instruction').value = planData.instruction || '';
        
        // Set device checkboxes
        document.getElementById('edit_adplan_device_desktop').checked = planData.device_desktop == 1;
        document.getElementById('edit_adplan_device_tablet').checked = planData.device_tablet == 1;
        document.getElementById('edit_adplan_device_mobile').checked = planData.device_mobile == 1;
        
        // Set duration checkboxes
        document.getElementById('edit_adplan_duration_daily').checked = planData.duration_daily == 1;
        document.getElementById('edit_adplan_duration_weekly').checked = planData.duration_weekly == 1;
        document.getElementById('edit_adplan_duration_monthly').checked = planData.duration_monthly == 1;
        
        // Set pricing fields
        document.getElementById('edit_adplan_price_cpm').value = planData.price_cpm || '';
        document.getElementById('edit_adplan_price_cpc').value = planData.price_cpc || '';
        document.getElementById('edit_adplan_price_fixed').value = planData.price_fixed || '';
        
        // Set active status
        document.getElementById('edit_adplan_is_active').checked = planData.is_active == 1;
    }

    // Function to handle saving newsletter plans (add or edit)
    function saveNewsletterPlan(mode) {
        const formId = mode === 'edit' ? 'editNewsletterPlanForm' : 'addNewsletterPlanForm';
        const form = document.getElementById(formId);
        
        // Form validation would go here
        
        
        
        // Submit form via AJAX
        // For demo purposes, just close the modal
        $(`#${mode === 'edit' ? 'edit' : 'add'}NewsletterPlanModal`).modal('hide');
        
        // In a real implementation, you'd send the form data to the server
        // and handle the response accordingly
    }
    
    // Function to populate the edit form with existing newsletter plan data
    function editNewsletterPlan(planId) {
        // In a real implementation, you'd fetch the plan data from the server
        // For now, we'll just simulate this with placeholder data
        
        // Example of populating the form with data
        document.getElementById('edit_newsletter_plan_id').value = planId;
        
        // Fetch plan data via AJAX and populate the form
        // This is placeholder code - in a real app you'd make an AJAX request
        setTimeout(() => {
            // For demo, let's pretend we got this data from the server
            const planData = {
                name: 'Business Plus',
                description: 'Perfect for growing businesses with a larger customer base',
                credits: 5000,
                price: 99.99,
                validity_days: 365,
                bonus_credits: 500,
                discount_percentage: 15,
                is_active: true
            };
            
            // Populate form with data
            document.getElementById('edit_newsletter_name').value = planData.name;
            document.getElementById('edit_newsletter_description').value = planData.description;
            document.getElementById('edit_newsletter_credits').value = planData.credits;
            document.getElementById('edit_newsletter_price').value = planData.price;
            document.getElementById('edit_newsletter_validity_days').value = planData.validity_days;
            document.getElementById('edit_newsletter_bonus_credits').value = planData.bonus_credits;
            document.getElementById('edit_newsletter_discount_percentage').value = planData.discount_percentage;
            
            document.getElementById('edit_newsletter_is_active').checked = planData.is_active;
        }, 100);
    }

    // Add event listener for delete confirmation button
    document.addEventListener('DOMContentLoaded', function() {
        const confirmDeleteBtn = document.getElementById('confirmDeletePlanBtn');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function() {
                const planType = document.getElementById('deletePlanType').value;
                const planId = document.getElementById('deletePlanId').value;
                
                console.log(`Deleting ${planType} plan with ID ${planId}`);
                
                // In a real application, you would make an AJAX call to delete the plan
                // Example:
                // axios.delete(`/api/${planType}-plans/${planId}`)
                //     .then(response => {
                //         // Handle success (e.g., show toast, reload data)
                //     })
                //     .catch(error => {
                //         // Handle error
                //     });
                
                // Close the modal
                $('#deletePlanModal').modal('hide');
                
                // For demo: Show a success message
                // In a real app, you would reload the data or remove the row from the table
            });
        }
    });
</script>
@endpush 