<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Adverts</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adverts</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyAdsetModal">
                        Buy Adset
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Section -->
    <div class="row mb-4">
        <!-- Total Ads -->
        <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0">Total Ads</h5>
                            <small class="text-muted">All-time ads created</small>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-badge-ad fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0">32</h2>
                </div>
            </div>
        </div>
        
        <!-- Running Ads -->
        <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0">Running Ads</h5>
                            <small class="text-muted">Currently active ads</small>
                        </div>
                        <div class="icon-shape icon-md bg-light-success text-success rounded-2">
                            <i class="bi bi-play-circle fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0">18</h2>
                </div>
            </div>
        </div>
        
        <!-- Adsets -->
        <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0">Adsets</h5>
                            <small class="text-muted">Active advertising sets</small>
                        </div>
                        <div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
                            <i class="bi bi-collection fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0">5</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Adsets Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Your Adsets</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-centered text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th>Created Date</th>
                                    <th>Adset</th>
                                    <th>Ad Units</th>
                                    <th>Running</th>
                                    <th>Expired</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10/03/2025</td>
                                    <td>Featured Products</td>
                                    <td>2 of 10</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                        <a href="{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 1]) }}" class="btn btn-sm btn-outline-primary">View Ads</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15/02/2025</td>
                                    <td>Box Slider Ads</td>
                                    <td>5 of 8</td>
                                    <td>3</td>
                                    <td>2</td>
                                    <td>
                                        <a href="{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 2]) }}" class="btn btn-sm btn-outline-primary">View Ads</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>03/01/2025</td>
                                    <td>Full Horizontal Banner</td>
                                    <td>8 of 12</td>
                                    <td>6</td>
                                    <td>2</td>
                                    <td>
                                        <a href="{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 3]) }}" class="btn btn-sm btn-outline-primary">View Ads</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25/12/2024</td>
                                    <td>Card Vertical Size Ads</td>
                                    <td>4 of 6</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>
                                        <a href="{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 4]) }}" class="btn btn-sm btn-outline-primary">View Ads</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10/12/2024</td>
                                    <td>Mini Cards Ads</td>
                                    <td>5 of 5</td>
                                    <td>0</td>
                                    <td>5</td>
                                    <td>
                                        <a href="{{ route('store.marketing.adverts.view', ['store' => 1, 'adset' => 5]) }}" class="btn btn-sm btn-outline-primary">View Ads</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Buy Adset Modal -->
<div class="modal fade" id="buyAdsetModal" tabindex="-1" aria-labelledby="buyAdsetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyAdsetModalLabel">Buy Advertisement Set</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adsetOrderForm">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Select Advertising Plans</h4>
                            <p class="text-muted">Choose the type of advertisement you want to run</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="adset-scrollable-container" style="max-height: 500px; overflow-y: auto; padding-right: 10px;">
                                <div class="row g-3 mb-4">
                                    <!-- Featured Products -->
                                    <div class="col-md-12">
                                        <div class="card adset-card h-100 cursor-pointer" data-adset="featured_products">
                                            <div class="card-body">
                                                <div class="form-check float-end">
                                                    <input class="form-check-input adset-checkbox" type="checkbox" id="featuredProductsCheck" data-price="2800">
                                                </div>
                                                <h5 class="card-title">Featured Products</h5>
                                                <p class="card-text text-muted small">Products Only</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                        <i class="bi bi-award fs-4"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">₦ 2,800</h5>
                                                    </div>
                                                </div>
                                                <a href="#" class="small text-decoration-none info-link" data-bs-toggle="tooltip" title="Highlights your products on the marketplace homepage">
                                                    <i class="bi bi-info-circle"></i> Info
                                                </a>
                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Days:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="featured_products">
                                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Units:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="featured_products">
                                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Box Slider Ads -->
                                    <div class="col-md-12">
                                        <div class="card adset-card h-100 cursor-pointer" data-adset="box_slider">
                                            <div class="card-body">
                                                <div class="form-check float-end">
                                                    <input class="form-check-input adset-checkbox" type="checkbox" id="boxSliderCheck" data-price="3500">
                                                </div>
                                                <h5 class="card-title">Box Slider Ads</h5>
                                                <p class="card-text text-muted small">Shops And Products</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                        <i class="bi bi-box fs-4"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">₦ 3,500</h5>
                                                    </div>
                                                </div>
                                                <a href="#" class="small text-decoration-none info-link" data-bs-toggle="tooltip" title="Animated sliding boxes that showcase your shop or products">
                                                    <i class="bi bi-info-circle"></i> Info
                                                </a>
                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Days:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="box_slider">
                                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Units:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="box_slider">
                                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Full Horizontal Banner -->
                                    <div class="col-md-12">
                                        <div class="card adset-card h-100 cursor-pointer" data-adset="horizontal_banner">
                                            <div class="card-body">
                                                <div class="form-check float-end">
                                                    <input class="form-check-input adset-checkbox" type="checkbox" id="horizontalBannerCheck" data-price="4900">
                                                </div>
                                                <h5 class="card-title">Full Horizontal Banner</h5>
                                                <p class="card-text text-muted small">Shops And Products</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                        <i class="bi bi-display fs-4"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">₦ 4,900</h5>
                                                    </div>
                                                </div>
                                                <a href="#" class="small text-decoration-none info-link" data-bs-toggle="tooltip" title="Full-width banner on top of category pages">
                                                    <i class="bi bi-info-circle"></i> Info
                                                </a>
                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Days:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="horizontal_banner">
                                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Units:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="horizontal_banner">
                                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Vertical Size Ads -->
                                    <div class="col-md-12">
                                        <div class="card adset-card h-100 cursor-pointer" data-adset="vertical_card">
                                            <div class="card-body">
                                                <div class="form-check float-end">
                                                    <input class="form-check-input adset-checkbox" type="checkbox" id="verticalCardCheck" data-price="4200">
                                                </div>
                                                <h5 class="card-title">Card Vertical Size Ads</h5>
                                                <p class="card-text text-muted small">Shops And Products</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                        <i class="bi bi-card-text fs-4"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">₦ 4,200</h5>
                                                    </div>
                                                </div>
                                                <a href="#" class="small text-decoration-none info-link" data-bs-toggle="tooltip" title="Vertical card advertisements in the sidebar">
                                                    <i class="bi bi-info-circle"></i> Info
                                                </a>
                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Days:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="vertical_card">
                                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Units:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="vertical_card">
                                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Mini Cards Ads -->
                                    <div class="col-md-12">
                                        <div class="card adset-card h-100 cursor-pointer" data-adset="mini_cards">
                                            <div class="card-body">
                                                <div class="form-check float-end">
                                                    <input class="form-check-input adset-checkbox" type="checkbox" id="miniCardsCheck" data-price="2450">
                                                </div>
                                                <h5 class="card-title">Mini Cards Ads</h5>
                                                <p class="card-text text-muted small">Shops And Products</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                        <i class="bi bi-card-list fs-4"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">₦ 2,450</h5>
                                                    </div>
                                                </div>
                                                <a href="#" class="small text-decoration-none info-link" data-bs-toggle="tooltip" title="Small card advertisements at the bottom of pages">
                                                    <i class="bi bi-info-circle"></i> Info
                                                </a>
                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Days:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="mini_cards">
                                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">Units:</span>
                                                            <div class="increment-field">
                                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="mini_cards">
                                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="{{ route('store.marketing.adverts.plans', ['store' => 1]) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-grid-3x3-gap me-1"></i> View All Plans In Full Page
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Order Summary -->
                            <div class="card sticky-top" style="top: 20px; z-index: 1">
                                <div class="card-header">
                                    <h5 class="mb-0">Order Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Number of Ad Sets:</span>
                                            <span id="totalAdSets">0</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Amount:</span>
                                            <span id="totalAmount">₦ 0.00</span>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Discount:</span>
                                            <span id="discount">-₦ 0</span>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">Total:</span>
                                            <span class="fw-bold" id="finalTotal">₦ 0.00</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter Coupon Code" id="couponCode">
                                            <button class="btn btn-outline-secondary" type="button" id="applyCoupon">Apply Coupon</button>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary" id="placeOrderBtn">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .adset-card {
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }
    
    .adset-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .adset-card.selected {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .increment-field {
        display: flex;
        align-items: center;
    }
    
    .increment-field .btn {
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .increment-field input {
        width: 60px;
        text-align: center;
        border-left: 0;
        border-right: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Card selection
        $('.adset-card').on('click', function() {
            const checkbox = $(this).find('.adset-checkbox');
            checkbox.prop('checked', !checkbox.prop('checked'));
            $(this).toggleClass('selected', checkbox.prop('checked'));
            updateOrderSummary();
        });
        
        // Checkbox click handler (prevent propagation to card)
        $('.adset-checkbox').on('click', function(e) {
            e.stopPropagation();
            $(this).closest('.adset-card').toggleClass('selected', $(this).prop('checked'));
            updateOrderSummary();
        });
        
        // Days increment/decrement
        $('.increment-days').on('click', function() {
            const input = $(this).siblings('.days-input');
            const currentVal = parseInt(input.val());
            if (currentVal < parseInt(input.attr('max'))) {
                input.val(currentVal + 1);
                updateOrderSummary();
            }
        });
        
        $('.decrement-days').on('click', function() {
            const input = $(this).siblings('.days-input');
            const currentVal = parseInt(input.val());
            if (currentVal > parseInt(input.attr('min'))) {
                input.val(currentVal - 1);
                updateOrderSummary();
            }
        });
        
        // Units increment/decrement
        $('.increment-units').on('click', function() {
            const input = $(this).siblings('.units-input');
            const currentVal = parseInt(input.val());
            if (currentVal < parseInt(input.attr('max'))) {
                input.val(currentVal + 1);
                updateOrderSummary();
            }
        });
        
        $('.decrement-units').on('click', function() {
            const input = $(this).siblings('.units-input');
            const currentVal = parseInt(input.val());
            if (currentVal > parseInt(input.attr('min'))) {
                input.val(currentVal - 1);
                updateOrderSummary();
            }
        });
        
        // Input value change handler
        $('.days-input, .units-input').on('change', function() {
            updateOrderSummary();
        });
        
        // Apply coupon button
        $('#applyCoupon').on('click', function() {
            const couponCode = $('#couponCode').val().trim();
            if (couponCode) {
                // Simulate coupon application (10% discount)
                const currentAmount = parseFloat($('#totalAmount').text().replace('₦ ', '').replace(',', ''));
                const discount = currentAmount * 0.1;
                $('#discount').text('-₦ ' + discount.toFixed(0));
                updateOrderSummary();
                
                // Show success message
                alert('Coupon applied successfully!');
            } else {
                alert('Please enter a valid coupon code');
            }
        });
        
        // Place order button
        $('#placeOrderBtn').on('click', function() {
            const selectedAdsets = $('.adset-checkbox:checked').length;
            if (selectedAdsets === 0) {
                alert('Please select at least one advertising plan');
                return;
            }
            
            // Here you would submit the form or make an AJAX call
            alert('Your order has been placed! You will be redirected to payment.');
        });
        
        // Order summary calculation
        function updateOrderSummary() {
            let totalAmount = 0;
            let adSetCount = 0;
            
            $('.adset-checkbox:checked').each(function() {
                adSetCount++;
                const adsetCard = $(this).closest('.adset-card');
                const basePrice = parseFloat($(this).data('price'));
                const days = parseInt(adsetCard.find('.days-input').val());
                const units = parseInt(adsetCard.find('.units-input').val());
                
                totalAmount += basePrice * days * units;
            });
            
            // Update summary values
            $('#totalAdSets').text(adSetCount);
            $('#totalAmount').text('₦ ' + totalAmount.toFixed(0));
            
            // Calculate final total (amount - discount)
            const discount = parseFloat($('#discount').text().replace('-₦ ', '').replace(',', '') || 0);
            const finalTotal = totalAmount - discount;
            $('#finalTotal').text('₦ ' + finalTotal.toFixed(0));
        }
    });
</script>
@endpush 