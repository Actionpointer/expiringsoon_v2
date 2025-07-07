<main>
    <div class="mt-4">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- section -->
    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- card -->
                    <div class="card py-1 border-0 mb-8">
                        <div>
                            <h1 class="fw-bold">Shopping Cart</h1>
                            <p class="mb-0">You have <span class="text-primary fw-bold">5</span> items in your cart from <span class="text-primary fw-bold">3</span> stores</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="py-3">
                        <!-- alert -->
                        <div class="alert alert-danger p-2" role="alert">
                            You've got FREE delivery. Start
                            <a href="#!" class="alert-link">checkout now!</a>
                        </div>

                        <!-- Store 1 -->
                        <div class="card mb-4 border">
                            <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fw-bold">Premium Wines</h5>
                                    <span class="text-muted small">2 items · Estimated delivery: 1-3 days</span>
                                </div>
                                <button class="btn btn-primary btn-sm">
                                    Checkout This Store
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <!-- list group -->
                                    <li class="list-group-item py-3 border-top">
                                        <!-- row -->
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-6 col-lg-7">
                                                <div class="d-flex">
                                                    <img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="Ecommerce"
                                                        class="icon-shape icon-xxl" />
                                                    <div class="ms-3">
                                                        <!-- title -->
                                                        <a href="../pages/shop-single.html" class="text-inherit">
                                                            <h6 class="mb-0">Bardar Divin 5 Yrs VSOP</h6>
                                                        </a>
                                                        <span><small class="text-muted">70cl</small></span>
                                                        <!-- text -->
                                                        <div class="mt-2 small lh-1">
                                                            <a href="#!" class="text-decoration-none text-inherit">
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- input group -->
                                            <div class="col-4 col-md-4 col-lg-3">
                                                <!-- input -->
                                                <!-- input -->
                                                <div class="input-group input-spinner">
                                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                                        data-field="quantity" />
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field form-control-sm form-input" />
                                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                                        data-field="quantity" />
                                                </div>
                                            </div>
                                            <!-- price -->
                                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                <span class="fw-bold">₦10,000</span>
                                                <div class="text-decoration-line-through text-muted small">₦12,500</div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- list group -->
                                    <li class="list-group-item py-3">
                                        <!-- row -->
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-6 col-lg-7">
                                                <div class="d-flex">
                                                    <img src="{{asset('frontend/images/products/product-img-2.jpg')}}" alt="Ecommerce"
                                                        class="icon-shape icon-xxl" />
                                                    <div class="ms-3">
                                                        <a href="../pages/shop-single.html" class="text-inherit">
                                                            <h6 class="mb-0">Hennessy VSOP</h6>
                                                        </a>
                                                        <span><small class="text-muted">70cl</small></span>
                                                        <!-- text -->
                                                        <div class="mt-2 small lh-1">
                                                            <a href="#!" class="text-decoration-none text-inherit">
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- input group -->
                                            <div class="col-4 col-md-4 col-lg-3">
                                                <!-- input -->
                                                <!-- input -->
                                                <div class="input-group input-spinner">
                                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                                        data-field="quantity" />
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field form-control-sm form-input" />
                                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                                        data-field="quantity" />
                                                </div>
                                            </div>
                                            <!-- price -->
                                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                <span class="fw-bold text-danger">₦12,000</span>
                                                <div class="text-decoration-line-through text-muted small">₦14,000</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-0 fw-semibold">Store Subtotal: <span class="fw-bold">₦22,000</span></p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" value="" id="storeSelect1" checked>
                                            <label class="form-check-label" for="storeSelect1">
                                                Select for Checkout
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Store 2 -->
                        <div class="card mb-4 border">
                            <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fw-bold">Global Spirits</h5>
                                    <span class="text-muted small">2 items · Estimated delivery: 2-4 days</span>
                                </div>
                                <button class="btn btn-primary btn-sm">
                                    Checkout This Store
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <!-- list group -->
                                    <li class="list-group-item py-3 border-top">
                                        <!-- row -->
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-6 col-lg-7">
                                                <div class="d-flex">
                                                    <img src="{{asset('frontend/images/products/product-img-3.jpg')}}" alt="Ecommerce"
                                                        class="icon-shape icon-xxl" />
                                                    <div class="ms-3">
                                                        <!-- title -->
                                                        <a href="../pages/shop-single.html" class="text-inherit">
                                                            <h6 class="mb-0">Martell Blue Swift</h6>
                                                        </a>
                                                        <span><small class="text-muted">75cl</small></span>
                                                        <!-- text -->
                                                        <div class="mt-2 small lh-1">
                                                            <a href="#!" class="text-decoration-none text-inherit">
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- input group -->
                                            <div class="col-4 col-md-4 col-lg-3">
                                                <!-- input -->
                                                <!-- input -->
                                                <div class="input-group input-spinner">
                                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                                        data-field="quantity" />
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field form-control-sm form-input" />
                                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                                        data-field="quantity" />
                                                </div>
                                            </div>
                                            <!-- price -->
                                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                <span class="fw-bold">₦11,000</span>
                                                <div class="text-decoration-line-through text-muted small">₦13,000</div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- list group -->
                                    <li class="list-group-item py-3">
                                        <!-- row -->
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-6 col-lg-7">
                                                <div class="d-flex">
                                                    <img src="{{asset('frontend/images/products/product-img-4.jpg')}}" alt="Ecommerce"
                                                        class="icon-shape icon-xxl" />
                                                    <div class="ms-3">
                                                        <!-- title -->
                                                        <!-- title -->
                                                        <a href="../pages/shop-single.html" class="text-inherit">
                                                            <h6 class="mb-0">Jameson Irish Whiskey</h6>
                                                        </a>
                                                        <span><small class="text-muted">70cl</small></span>
                                                        <!-- text -->
                                                        <div class="mt-2 small lh-1">
                                                            <a href="#!" class="text-decoration-none text-inherit">
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- input group -->
                                            <div class="col-4 col-md-4 col-lg-3">
                                                <!-- input -->
                                                <!-- input -->
                                                <div class="input-group input-spinner">
                                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                                        data-field="quantity" />
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field form-control-sm form-input" />
                                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                                        data-field="quantity" />
                                                </div>
                                            </div>
                                            <!-- price -->
                                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                <span class="fw-bold">₦9,500</span>
                                                <div class="text-decoration-line-through text-muted small">₦12,000</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-0 fw-semibold">Store Subtotal: <span class="fw-bold">₦20,500</span></p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" value="" id="storeSelect2" checked>
                                            <label class="form-check-label" for="storeSelect2">
                                                Select for Checkout
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Store 3 -->
                        <div class="card mb-4 border">
                            <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fw-bold">Liquor Express</h5>
                                    <span class="text-muted small">1 item · Estimated delivery: 1-2 days</span>
                                </div>
                                <button class="btn btn-primary btn-sm">
                                    Checkout This Store
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <!-- list group -->
                                    <li class="list-group-item py-3 border-top">
                                        <!-- row -->
                                        <div class="row align-items-center">
                                            <div class="col-6 col-md-6 col-lg-7">
                                                <div class="d-flex">
                                                    <img src="{{asset('frontend/images/products/product-img-5.jpg')}}" alt="Ecommerce"
                                                        class="icon-shape icon-xxl" />
                                                    <div class="ms-3">
                                                        <!-- title -->
                                                        <a href="../pages/shop-single.html" class="text-inherit">
                                                            <h6 class="mb-0">Jack Daniel's Old No. 7</h6>
                                                        </a>
                                                        <span><small class="text-muted">70cl</small></span>
                                                        <!-- text -->
                                                        <div class="mt-2 small lh-1">
                                                            <a href="#!" class="text-decoration-none text-inherit">
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- input group -->
                                            <div class="col-4 col-md-4 col-lg-3">
                                                <!-- input -->
                                                <!-- input -->
                                                <div class="input-group input-spinner">
                                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                                        data-field="quantity" />
                                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                                        class="quantity-field form-control-sm form-input" />
                                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                                        data-field="quantity" />
                                                </div>
                                            </div>
                                            <!-- price -->
                                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                <span class="fw-bold">₦15,000</span>
                                                <div class="text-decoration-line-through text-muted small">₦18,000</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-0 fw-semibold">Store Subtotal: <span class="fw-bold">₦15,000</span></p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" value="" id="storeSelect3" checked>
                                            <label class="form-check-label" for="storeSelect3">
                                                Select for Checkout
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom actions -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="#!" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                            </a>
                            <a href="#!" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-repeat me-2"></i>Update Cart
                            </a>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="col-12 col-lg-4 col-md-5">
                    <!-- card -->
                    <div class="mb-5 card mt-6 position-sticky" style="top: 2rem;">
                        <div class="card-body p-6">
                            <!-- heading -->
                            <h2 class="h5 mb-4">Order Summary</h2>
                            <div class="card mb-2">
                                <!-- list group -->
                                <ul class="list-group list-group-flush">
                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div>Items Subtotal (5)</div>
                                        </div>
                                        <span>₦57,500</span>
                                    </li>

                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div>Total</div>
                                        </div>
                                        <span class="fw-bold">₦57,500</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-grid mb-1 mt-4">
                                <!-- btn -->
                                <button
                                    class="btn btn-primary btn-lg d-flex justify-content-between align-items-center"
                                    type="submit">
                                    Checkout Stores
                                    <span class="fw-bold">₦57,500</span>
                                </button>
                            </div>
                            <!-- text -->
                            <p class="mb-0 mt-3">
                                <small>
                                    By placing your order, you agree to be bound by the
                                    <a href="#!">Terms of Service</a>
                                    and
                                    <a href="#!">Privacy Policy.</a>
                                </small>
                            </p>

                            <!-- saved for later -->
                            <div class="mt-5">
                                <h3 class="h5 mb-3">Saved For Later (2)</h3>
                                <div class="d-flex mb-3 border-bottom pb-3">
                                    <img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="Product"
                                        width="50" height="50" class="rounded me-3">
                                    <div>
                                        <h6 class="mb-0 small">Dom Perignon Vintage</h6>
                                        <div class="d-flex mt-1">
                                            <span class="text-danger me-1">₦85,000</span>
                                            <button class="btn btn-link btn-sm p-0 ms-auto">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="{{asset('frontend/images/products/product-img-2.jpg')}}" alt="Product"
                                        width="50" height="50" class="rounded me-3">
                                    <div>
                                        <h6 class="mb-0 small">Bollinger Special Cuvee</h6>
                                        <div class="d-flex mt-1">
                                            <span class="text-danger me-1">₦78,500</span>
                                            <button class="btn btn-link btn-sm p-0 ms-auto">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@push('scripts')
<script>
	// Handle select/deselect stores for checkout
	document.addEventListener('DOMContentLoaded', function() {
		const storeCheckboxes = document.querySelectorAll('[id^="storeSelect"]');
		const checkoutButton = document.querySelector('.btn-primary.btn-lg');
		
		// Update checkout button based on selections
		function updateCheckoutButton() {
			const selectedStores = Array.from(storeCheckboxes).filter(checkbox => checkbox.checked).length;
			
			if (selectedStores === 0) {
				checkoutButton.disabled = true;
				checkoutButton.innerHTML = 'Select at least one store <span class="fw-bold">₦0</span>';
			} else {
				checkoutButton.disabled = false;
				checkoutButton.innerHTML = `Checkout Stores <span class="fw-bold">₦57,500</span>`;
			}
		}
		
		// Add event listeners to checkboxes
		storeCheckboxes.forEach(checkbox => {
			checkbox.addEventListener('change', updateCheckoutButton);
		});
		
		// Initial state
		updateCheckoutButton();
	});
</script>
@endpush