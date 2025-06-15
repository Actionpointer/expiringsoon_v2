@extends('layouts.frontend.store.app')

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
    
    .plan-feature-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }
    
    .plan-feature-list li {
        padding: 6px 0;
        display: flex;
        align-items: start;
    }
    
    .plan-feature-list li i {
        color: #198754;
        margin-right: 8px;
        margin-top: 4px;
    }
    
    .sticky-cart {
        position: sticky;
        top: 20px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Advertisement Plans</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.marketing.adverts', 1) }}" class="text-inherit">Adverts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Advert Plans</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Available Advertisement Plans</h5>
                </div>
                <div class="card-body">
                    <form id="adsetOrderForm">
                        <!-- Featured Products -->
                        <div class="card adset-card mb-4" data-adset="featured_products">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input adset-checkbox" type="checkbox" id="featuredProductsCheck" data-price="2800">
                                            <label class="form-check-label h5" for="featuredProductsCheck">
                                                Featured Products
                                            </label>
                                        </div>
                                        <p class="text-muted mb-3">Products Only</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                <i class="bi bi-award fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-0">₦ 2,800</h4>
                                                <small class="text-muted">per unit per day</small>
                                            </div>
                                        </div>
                                        
                                        <ul class="plan-feature-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Display your products in the featured section of the marketplace</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Up to 200% increase in product visibility</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Performance analytics included</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Days:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="featured_products">
                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Units:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="featured_products">
                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block fw-bold mb-1">Subtotal:</span>
                                            <span class="h5 item-total" data-adset="featured_products">₦ 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Box Slider Ads -->
                        <div class="card adset-card mb-4" data-adset="box_slider">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input adset-checkbox" type="checkbox" id="boxSliderCheck" data-price="3500">
                                            <label class="form-check-label h5" for="boxSliderCheck">
                                                Box Slider Ads
                                            </label>
                                        </div>
                                        <p class="text-muted mb-3">Shops And Products</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                <i class="bi bi-box fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-0">₦ 3,500</h4>
                                                <small class="text-muted">per unit per day</small>
                                            </div>
                                        </div>
                                        
                                        <ul class="plan-feature-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Animated slider boxes that attract user attention</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Can promote both shops and specific products</li>
                                            <li><i class="bi bi-check-circle-fill"></i> High engagement rate with interactive elements</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Days:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="box_slider">
                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Units:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="box_slider">
                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block fw-bold mb-1">Subtotal:</span>
                                            <span class="h5 item-total" data-adset="box_slider">₦ 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Full Horizontal Banner -->
                        <div class="card adset-card mb-4" data-adset="horizontal_banner">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input adset-checkbox" type="checkbox" id="horizontalBannerCheck" data-price="4900">
                                            <label class="form-check-label h5" for="horizontalBannerCheck">
                                                Full Horizontal Banner
                                            </label>
                                        </div>
                                        <p class="text-muted mb-3">Shops And Products</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                <i class="bi bi-display fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-0">₦ 4,900</h4>
                                                <small class="text-muted">per unit per day</small>
                                            </div>
                                        </div>
                                        
                                        <ul class="plan-feature-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Premium full-width banner placement on category pages</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Maximum visibility with eye-catching designs</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Perfect for seasonal promotions and major campaigns</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Days:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="horizontal_banner">
                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Units:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="horizontal_banner">
                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block fw-bold mb-1">Subtotal:</span>
                                            <span class="h5 item-total" data-adset="horizontal_banner">₦ 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Vertical Size Ads -->
                        <div class="card adset-card mb-4" data-adset="vertical_card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input adset-checkbox" type="checkbox" id="verticalCardCheck" data-price="4200">
                                            <label class="form-check-label h5" for="verticalCardCheck">
                                                Card Vertical Size Ads
                                            </label>
                                        </div>
                                        <p class="text-muted mb-3">Shops And Products</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                <i class="bi bi-card-text fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-0">₦ 4,200</h4>
                                                <small class="text-muted">per unit per day</small>
                                            </div>
                                        </div>
                                        
                                        <ul class="plan-feature-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Strategic sidebar placement for consistent visibility</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Effective format for detailed product showcases</li>
                                            <li><i class="bi bi-check-circle-fill"></i> High retention rate with users staying longer on the page</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Days:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="vertical_card">
                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Units:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="vertical_card">
                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block fw-bold mb-1">Subtotal:</span>
                                            <span class="h5 item-total" data-adset="vertical_card">₦ 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mini Cards Ads -->
                        <div class="card adset-card mb-4" data-adset="mini_cards">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input adset-checkbox" type="checkbox" id="miniCardsCheck" data-price="2450">
                                            <label class="form-check-label h5" for="miniCardsCheck">
                                                Mini Cards Ads
                                            </label>
                                        </div>
                                        <p class="text-muted mb-3">Shops And Products</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 me-3">
                                                <i class="bi bi-card-list fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-0">₦ 2,450</h4>
                                                <small class="text-muted">per unit per day</small>
                                            </div>
                                        </div>
                                        
                                        <ul class="plan-feature-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Compact format perfect for multiple product promotions</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Cost-effective solution with high ROI</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Strategic placement at the bottom of popular pages</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Days:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-days">-</button>
                                                <input type="number" class="form-control days-input" value="7" min="1" max="30" data-adset="mini_cards">
                                                <button type="button" class="btn btn-outline-secondary increment-days">+</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Units:</label>
                                            <div class="increment-field">
                                                <button type="button" class="btn btn-outline-secondary decrement-units">-</button>
                                                <input type="number" class="form-control units-input" value="1" min="1" max="10" data-adset="mini_cards">
                                                <button type="button" class="btn btn-outline-secondary increment-units">+</button>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block fw-bold mb-1">Subtotal:</span>
                                            <span class="h5 item-total" data-adset="mini_cards">₦ 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Order Summary -->
            <div class="card sticky-cart">
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
                        <button type="button" class="btn btn-primary btn-lg" id="placeOrderBtn">Place Order</button>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-shield-check text-success me-2"></i> Secure Payment</span>
                        <span><i class="bi bi-clock-history text-primary me-2"></i> 24/7 Support</span>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="mb-3">Need Help?</h5>
                    <p class="text-muted mb-0">Contact our advertising team for assistance with your campaign.</p>
                    <hr>
                    <div class="d-grid">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-chat-dots me-2"></i> Chat with Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Card selection
        $('.adset-card').on('click', function(e) {
            if (!$(e.target).is('input, button, .btn, .form-control')) {
                const checkbox = $(this).find('.adset-checkbox');
                checkbox.prop('checked', !checkbox.prop('checked'));
                $(this).toggleClass('selected', checkbox.prop('checked'));
                updateOrderSummary();
                updateItemTotal($(this).data('adset'));
            }
        });
        
        // Checkbox click handler
        $('.adset-checkbox').on('click', function(e) {
            e.stopPropagation();
            const adsetCard = $(this).closest('.adset-card');
            adsetCard.toggleClass('selected', $(this).prop('checked'));
            updateOrderSummary();
            updateItemTotal(adsetCard.data('adset'));
        });
        
        // Days increment/decrement
        $('.increment-days').on('click', function() {
            const input = $(this).siblings('.days-input');
            const currentVal = parseInt(input.val());
            if (currentVal < parseInt(input.attr('max'))) {
                input.val(currentVal + 1);
                const adset = input.data('adset');
                updateItemTotal(adset);
                updateOrderSummary();
            }
        });
        
        $('.decrement-days').on('click', function() {
            const input = $(this).siblings('.days-input');
            const currentVal = parseInt(input.val());
            if (currentVal > parseInt(input.attr('min'))) {
                input.val(currentVal - 1);
                const adset = input.data('adset');
                updateItemTotal(adset);
                updateOrderSummary();
            }
        });
        
        // Units increment/decrement
        $('.increment-units').on('click', function() {
            const input = $(this).siblings('.units-input');
            const currentVal = parseInt(input.val());
            if (currentVal < parseInt(input.attr('max'))) {
                input.val(currentVal + 1);
                const adset = input.data('adset');
                updateItemTotal(adset);
                updateOrderSummary();
            }
        });
        
        $('.decrement-units').on('click', function() {
            const input = $(this).siblings('.units-input');
            const currentVal = parseInt(input.val());
            if (currentVal > parseInt(input.attr('min'))) {
                input.val(currentVal - 1);
                const adset = input.data('adset');
                updateItemTotal(adset);
                updateOrderSummary();
            }
        });
        
        // Input value change handler
        $('.days-input, .units-input').on('change', function() {
            const adset = $(this).data('adset');
            updateItemTotal(adset);
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
        
        // Update item total
        function updateItemTotal(adset) {
            const card = $(`.adset-card[data-adset="${adset}"]`);
            const checkbox = card.find('.adset-checkbox');
            const isChecked = checkbox.prop('checked');
            const basePrice = parseFloat(checkbox.data('price'));
            const days = parseInt(card.find('.days-input').val());
            const units = parseInt(card.find('.units-input').val());
            
            let total = 0;
            if (isChecked) {
                total = basePrice * days * units;
            }
            
            $(`.item-total[data-adset="${adset}"]`).text('₦ ' + total.toFixed(0));
        }
        
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
        
        // Initialize item totals
        $('.adset-card').each(function() {
            updateItemTotal($(this).data('adset'));
        });
    });
</script>
@endpush 