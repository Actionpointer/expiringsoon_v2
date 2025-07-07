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
							<li class="breadcrumb-item active" aria-current="page">Shop Checkout</li>
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
				<!-- col -->
				<div class="col-12">
					<div>
						<div class="mb-8">
							<!-- text -->
							<h1 class="fw-bold mb-0">Checkout</h1>
							<p class="mb-0">
								Already have an account? Click here to
								<a href="#!">Sign in</a>
								.
							</p>
						</div>
					</div>
				</div>
			</div>
			<div>
				<!-- row -->
				<div class="row">
					<div class="col-xl-7 col-lg-6 col-md-12">
						<!-- accordion -->
						<div class="accordion accordion-flush" id="accordionFlushExample">
							<!-- accordion item -->
							<div class="accordion-item py-4">
								<div class="d-flex justify-content-between align-items-center">
									<!-- heading one -->
									<a href="#" class="fs-5 text-inherit collapsed h4" data-bs-toggle="collapse"
										data-bs-target="#flush-collapseOne" aria-expanded="true"
										aria-controls="flush-collapseOne">
										<i class="feather-icon icon-map-pin me-2 text-muted"></i>
										Add delivery address
									</a>
									<!-- btn -->
									<a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
										data-bs-target="#addAddressModal">Add a new address</a>
									<!-- collapse -->
								</div>
								<div id="flush-collapseOne" class="accordion-collapse collapse show"
									data-bs-parent="#accordionFlushExample">
									<div class="mt-5">
										<div class="row">
											<div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
												<!-- form -->
												<div class="card card-body p-6">
													<div class="form-check mb-4">
														<input class="form-check-input" type="radio"
															name="flexRadioDefault" id="homeRadio" checked />
														<label class="form-check-label text-dark"
															for="homeRadio">Home</label>
													</div>
													<!-- address -->
													<address>
														<strong>Jitu Chauhan</strong>
														<br />

														4450 North Avenue Oakland,
														<br />

														Nebraska, United States,
														<br />

														<abbr title="Phone">P: 402-776-1106</abbr>
													</address>
													<span class="text-danger">Default address</span>
												</div>
											</div>
											<div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
												<!-- input -->
												<div class="card card-body p-6">
													<div class="form-check mb-4">
														<input class="form-check-input" type="radio"
															name="flexRadioDefault" id="officeRadio" />
														<label class="form-check-label text-dark"
															for="officeRadio">Office</label>
													</div>
													<address>
														<strong>Nitu Chauhan</strong>
														<br />
														3853 Coal Road,
														<br />
														Tannersville, Pennsylvania, 18372, USA,
														<br />

														<abbr title="Phone">P: 402-776-1106</abbr>
													</address>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- accordion item -->
							<div class="accordion-item py-4">
								<a href="#" class="text-inherit collapsed h5" data-bs-toggle="collapse"
									data-bs-target="#flush-collapseTwo" aria-expanded="false"
									aria-controls="flush-collapseTwo">
									<i class="feather-icon icon-clock me-2 text-muted"></i>
									Delivery
								</a>
								<!-- collapse -->
								<div id="flush-collapseTwo" class="accordion-collapse collapse"
									data-bs-parent="#accordionFlushExample">
									<div class="mt-5">
										<!-- Delivery Options -->
										<div id="deliveryOptions" class="mb-3">
											<h5 class="mb-3">Select Delivery Method</h5>
											<div class="form-check mb-3">
												<input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethodDelivery" value="delivery" checked>
												<label class="form-check-label" for="deliveryMethodDelivery">
													Deliver to my address
												</label>
											</div>
											<div class="form-check mb-3">
												<input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethodPickup" value="pickup">
												<label class="form-check-label" for="deliveryMethodPickup">
													I'll pick it up myself
												</label>
											</div>
										</div>
										
										<!-- Delivery Options Container -->
										<div id="deliveryShippingOptions" class="mb-5">
											<div class="alert alert-success d-none" id="deliveryAvailableAlert">
												<i class="bi bi-check-circle me-2"></i> Delivery is available in your area.
											</div>
											<div class="alert alert-warning d-none" id="deliveryUnavailableAlert">
												<i class="bi bi-exclamation-triangle me-2"></i> Delivery is not available in your area. Please select self-pickup.
											</div>
											
											<!-- Shipping method cards -->
											<h6 class="mb-3">Select Shipping Method</h6>
											<div class="row g-3 mb-3">
												<!-- Express Delivery -->
												<div class="col-md-4">
													<div class="card h-100 shipping-method-card">
														<div class="card-body">
															<div class="form-check">
																<input class="form-check-input" type="radio" name="shippingMethod" id="shippingMethodExpress" value="express" checked>
																<label class="form-check-label w-100" for="shippingMethodExpress">
																	<div class="d-flex justify-content-between align-items-center mb-2">
																		<span class="h6 mb-0">Express Delivery</span>
																		<span class="badge bg-primary">Fastest</span>
																	</div>
																	<p class="text-muted small mb-0">Get it by tomorrow</p>
																	<div class="text-end mt-3">
																		<span class="fw-bold">₦3,500</span>
																	</div>
																</label>
															</div>
														</div>
													</div>
												</div>
												
												<!-- Next Day Delivery -->
												<div class="col-md-4">
													<div class="card h-100 shipping-method-card">
														<div class="card-body">
															<div class="form-check">
																<input class="form-check-input" type="radio" name="shippingMethod" id="shippingMethodNextDay" value="nextday">
																<label class="form-check-label w-100" for="shippingMethodNextDay">
																	<div class="d-flex justify-content-between align-items-center mb-2">
																		<span class="h6 mb-0">Next Day</span>
																		<span class="badge bg-success">Recommended</span>
																	</div>
																	<p class="text-muted small mb-0">Get it within 24 hours</p>
																	<div class="text-end mt-3">
																		<span class="fw-bold">₦2,000</span>
																	</div>
																</label>
															</div>
														</div>
													</div>
												</div>
												
												<!-- Standard Delivery -->
												<div class="col-md-4">
													<div class="card h-100 shipping-method-card">
														<div class="card-body">
															<div class="form-check">
																<input class="form-check-input" type="radio" name="shippingMethod" id="shippingMethodStandard" value="standard">
																<label class="form-check-label w-100" for="shippingMethodStandard">
																	<div class="d-flex justify-content-between align-items-center mb-2">
																		<span class="h6 mb-0">Standard</span>
																		<span class="badge bg-secondary">Economy</span>
																	</div>
																	<p class="text-muted small mb-0">Get it in 2-3 days</p>
																	<div class="text-end mt-3">
																		<span class="fw-bold">₦1,000</span>
																	</div>
																</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<!-- Pickup Options Container -->
										<div id="pickupOptions" class="d-none mb-5">
											<h6 class="mb-3">Select Pickup Location</h6>
											<div class="row g-3">
												<!-- Pickup Location 1 -->
												<div class="col-md-6">
													<div class="card h-100 shipping-method-card">
														<div class="card-body">
															<div class="form-check">
																<input class="form-check-input" type="radio" name="pickupLocation" id="pickupLocation1" value="location1" checked>
																<label class="form-check-label w-100" for="pickupLocation1">
																	<div class="d-flex justify-content-between align-items-center mb-2">
																		<span class="h6 mb-0">Main Store</span>
																		<span class="badge bg-success">Nearest</span>
																	</div>
																	<p class="text-muted small mb-0">
																		123 Main Street, Lagos<br>
																		Open: 9AM - 9PM
																	</p>
																	<div class="text-end mt-3">
																		<small class="text-muted">2.5 km away</small>
																	</div>
																</label>
															</div>
														</div>
													</div>
												</div>
												
												<!-- Pickup Location 2 -->
												<div class="col-md-6">
													<div class="card h-100 shipping-method-card">
														<div class="card-body">
															<div class="form-check">
																<input class="form-check-input" type="radio" name="pickupLocation" id="pickupLocation2" value="location2">
																<label class="form-check-label w-100" for="pickupLocation2">
																	<div class="d-flex justify-content-between align-items-center mb-2">
																		<span class="h6 mb-0">Downtown Branch</span>
																	</div>
																	<p class="text-muted small mb-0">
																		456 Central Avenue, Lagos<br>
																		Open: 10AM - 8PM
																	</p>
																	<div class="text-end mt-3">
																		<small class="text-muted">5.7 km away</small>
																	</div>
																</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="mt-5 d-flex justify-content-end">
											<a href="#" class="btn btn-outline-gray-400 text-muted"
												data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
												aria-expanded="false" aria-controls="flush-collapseOne">
												Prev
											</a>
											<a href="#" class="btn btn-primary ms-2" data-bs-toggle="collapse"
												data-bs-target="#flush-collapseThree" aria-expanded="false"
												aria-controls="flush-collapseThree">Next</a>
										</div>
									</div>
								</div>
							</div>
							<!-- accordion item -->
							<div class="accordion-item py-4">
								<a href="#" class="text-inherit h5" data-bs-toggle="collapse"
									data-bs-target="#flush-collapseThree" aria-expanded="false"
									aria-controls="flush-collapseThree">
									<i class="feather-icon icon-shopping-bag me-2 text-muted"></i>
									Delivery instructions
									<!-- collapse -->
								</a>
								<div id="flush-collapseThree" class="accordion-collapse collapse"
									data-bs-parent="#accordionFlushExample">
									<div class="mt-5">
										<label for="DeliveryInstructions" class="form-label sr-only">Delivery
											instructions</label>
										<textarea class="form-control" id="DeliveryInstructions" rows="3"
											placeholder="Write delivery instructions "></textarea>
										<p class="form-text">Add instructions for how you want your order shopped
											and/or delivered</p>
										<div class="mt-5 d-flex justify-content-end">
											<a href="#" class="btn btn-outline-gray-400 text-muted"
												data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
												aria-expanded="false" aria-controls="flush-collapseTwo">
												Prev
											</a>
											<a href="#" class="btn btn-primary ms-2" data-bs-toggle="collapse"
												data-bs-target="#flush-collapseFour" aria-expanded="false"
												aria-controls="flush-collapseFour">Next</a>
										</div>
									</div>
								</div>
							</div>
							<!-- accordion item -->
							<div class="accordion-item py-4">
								<a href="#" class="text-inherit h5" data-bs-toggle="collapse"
									data-bs-target="#flush-collapseFour" aria-expanded="false"
									aria-controls="flush-collapseFour">
									<i class="feather-icon icon-credit-card me-2 text-muted"></i>
									Payment Method
									<!-- collapse -->
								</a>
								<div id="flush-collapseFour" class="accordion-collapse collapse"
									data-bs-parent="#accordionFlushExample">
									<div class="mt-5">
										<div>
											<div class="card card-bordered shadow-none mb-2">
												<!-- card body -->
												<div class="card-body p-6">
													<div class="d-flex">
														<div class="form-check">
															<!-- checkbox -->
															<input class="form-check-input" type="radio"
																name="flexRadioDefault" id="paypal" />
															<label class="form-check-label ms-2"
																for="paypal"></label>
														</div>
														<div>
															<!-- title -->
															<h5 class="mb-1 h6">Payment with Paypal</h5>
															<p class="mb-0 small">You will be redirected to PayPal
																website to complete your purchase securely.</p>
														</div>
													</div>
												</div>
											</div>
											<!-- card -->
											<div class="card card-bordered shadow-none mb-2">
												<!-- card body -->
												<div class="card-body p-6">
													<div class="d-flex mb-4">
														<div class="form-check">
															<!-- input -->
															<input class="form-check-input" type="radio"
																name="flexRadioDefault" id="creditdebitcard" />
															<label class="form-check-label ms-2"
																for="creditdebitcard"></label>
														</div>
														<div>
															<h5 class="mb-1 h6">Credit / Debit Card</h5>
															<p class="mb-0 small">Safe money transfer using your
																bank accou k account. We support Mastercard tercard,
																Visa, Discover and Stripe.</p>
														</div>
													</div>
													<div class="row g-2">
														<div class="col-12">
															<!-- input -->
															<div class="mb-3">
																<label for="card-mask" class="form-label">Card
																	Number</label>
																<input type="text" class="form-control"
																	id="card-mask" placeholder="xxxx-xxxx-xxxx-xxxx"
																	required />
															</div>
														</div>
														<div class="col-md-6 col-12">
															<!-- input -->
															<div class="mb-3 mb-lg-0">
																<label class="form-label" for="nameoncard">Name on
																	card</label>
																<input type="text" class="form-control"
																	placeholder="Enter name" id="nameoncard" />
															</div>
														</div>
														<div class="col-md-3 col-12">
															<!-- input -->
															<div class="mb-3 mb-lg-0 position-relative">
																<label class="form-label" for="expirydate">Expiry
																	date</label>
																<input type="text" class="form-control"
																	id="expirydate" placeholder="MM/YY" />
															</div>
														</div>
														<div class="col-md-3 col-12">
															<!-- input -->
															<div class="mb-3 mb-lg-0">
																<label for="digit-mask" class="form-label">
																	CVV Code
																	<i class="fe fe-help-circle ms-1"
																		data-bs-toggle="tooltip"
																		data-placement="top"
																		title="A 3 - digit number, typically printed on the back of a card."></i>
																</label>
																<input type="password" class="form-control"
																	name="digit-mask" id="digit-mask"
																	placeholder="xxx" maxlength="3"
																	inputmode="numeric" required />
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- card -->
											<div class="card card-bordered shadow-none mb-2">
												<!-- card body -->
												<div class="card-body p-6">
													<!-- check input -->
													<div class="d-flex">
														<div class="form-check">
															<input class="form-check-input" type="radio"
																name="flexRadioDefault" id="payoneer" />
															<label class="form-check-label ms-2"
																for="payoneer"></label>
														</div>
														<div>
															<!-- title -->
															<h5 class="mb-1 h6">Pay with Payoneer</h5>
															<p class="mb-0 small">You will be redirected to Payoneer
																website to complete your purchase securely.</p>
														</div>
													</div>
												</div>
											</div>
											<!-- card -->
											<div class="card card-bordered shadow-none">
												<div class="card-body p-6">
													<!-- check input -->
													<div class="d-flex">
														<div class="form-check">
															<input class="form-check-input" type="radio"
																name="flexRadioDefault" id="cashonDelivery" />
															<label class="form-check-label ms-2"
																for="cashonDelivery"></label>
														</div>
														<div>
															<!-- title -->
															<h5 class="mb-1 h6">Cash on Delivery</h5>
															<p class="mb-0 small">Pay with cash when your order is
																delivered.</p>
														</div>
													</div>
												</div>
											</div>
											<!-- Button -->
											<div class="mt-5 d-flex justify-content-end">
												<a href="#" class="btn btn-outline-gray-400 text-muted"
													data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
													aria-expanded="false" aria-controls="flush-collapseThree">
													Prev
												</a>
												<a href="#" class="btn btn-primary ms-2">Place Order</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12 offset-xl-1 col-xl-4 col-lg-6">
						<div class="mt-4 mt-lg-0">
							<div class="card shadow-sm">
								<h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
								<ul class="list-group list-group-flush">
									<!-- list group item -->
									<li class="list-group-item px-4 py-3">
										<div class="row align-items-center">
											<div class="col-2 col-md-2">
												<img src="{{asset('frontend/images/products/product-img-1.jpg')}}"
													alt="Ecommerce" class="img-fluid" />
											</div>
											<div class="col-5 col-md-5">
												<h6 class="mb-0">Haldiram's Sev Bhujia</h6>
												<span><small class="text-muted">.98 / lb</small></span>
											</div>
											<div class="col-2 col-md-2 text-center text-muted">
												<span>1</span>
											</div>
											<div class="col-3 text-lg-end text-start text-md-end col-md-3">
												<span class="fw-bold">$5.00</span>
											</div>
										</div>
									</li>
									<!-- list group item -->
									<li class="list-group-item px-4 py-3">
										<div class="row align-items-center">
											<div class="col-2 col-md-2">
												<img src="{{asset('frontend/images/products/product-img-2.jpg')}}"
													alt="Ecommerce" class="img-fluid" />
											</div>
											<div class="col-5 col-md-5">
												<h6 class="mb-0">NutriChoice Digestive</h6>
												<span><small class="text-muted">250g</small></span>
											</div>
											<div class="col-2 col-md-2 text-center text-muted">
												<span>1</span>
											</div>
											<div class="col-3 text-lg-end text-start text-md-end col-md-3">
												<span class="fw-bold">$20.00</span>
												<div class="text-decoration-line-through text-muted small">$26.00
												</div>
											</div>
										</div>
									</li>
									<!-- list group item -->
									<li class="list-group-item px-4 py-3">
										<div class="row align-items-center">
											<div class="col-2 col-md-2">
												<img src="{{asset('frontend/images/products/product-img-3.jpg')}}"
													alt="Ecommerce" class="img-fluid" />
											</div>
											<div class="col-5 col-md-5">
												<h6 class="mb-0">Cadbury 5 Star Chocolate</h6>
												<span><small class="text-muted">1 kg</small></span>
											</div>
											<div class="col-2 col-md-2 text-center text-muted">
												<span>1</span>
											</div>
											<div class="col-3 text-lg-end text-start text-md-end col-md-3">
												<span class="fw-bold">$15.00</span>
												<div class="text-decoration-line-through text-muted small">$20.00
												</div>
											</div>
										</div>
									</li>
									<!-- list group item -->
									<li class="list-group-item px-4 py-3">
										<div class="row align-items-center">
											<div class="col-2 col-md-2">
												<img src="{{asset('frontend/images/products/product-img-4.jpg')}}"
													alt="Ecommerce" class="img-fluid" />
											</div>
											<div class="col-5 col-md-5">
												<h6 class="mb-0">Onion Flavour Potato</h6>
												<span><small class="text-muted">250g</small></span>
											</div>
											<div class="col-2 col-md-2 text-center text-muted">
												<span>1</span>
											</div>
											<div class="col-3 text-lg-end text-start text-md-end col-md-3">
												<span class="fw-bold">$15.00</span>
												<div class="text-decoration-line-through text-muted small">$20.00
												</div>
											</div>
										</div>
									</li>

									<!-- list group item -->
									<li class="list-group-item px-4 py-3">
										<div class="d-flex align-items-center justify-content-between mb-2">
											<div>Item Subtotal</div>
											<div class="fw-bold">$70.00</div>
										</div>
										
										<!-- Shipping Fee - dynamically updated by JS -->
										<div class="d-flex align-items-center justify-content-between mb-2">
											<div>
												Shipping Fee
												<i class="feather-icon icon-info text-muted"
													data-bs-toggle="tooltip" title="Shipping fee based on selected delivery method"></i>
											</div>
											<div class="fw-bold" id="shippingFeeDisplay">$3.50</div>
										</div>
										
										<!-- Service Fee -->
										<div class="d-flex align-items-center justify-content-between mb-2">
											<div>
												Service Fee
												<i class="feather-icon icon-info text-muted"
													data-bs-toggle="tooltip" title="Platform service fee"></i>
											</div>
											<div class="fw-bold">$3.00</div>
										</div>
										
										<!-- Coupon Discount - shown only if coupon applied -->
										<div class="d-flex align-items-center justify-content-between mb-2" id="couponDiscountRow" style="display: none !important;">
											<div>
												Coupon Discount
												<i class="feather-icon icon-info text-muted"
													data-bs-toggle="tooltip" title="Discount from applied coupon"></i>
											</div>
											<div class="fw-bold text-success" id="couponDiscountDisplay">-$0.00</div>
										</div>
									</li>
									
									<!-- Apply Coupon -->
									<li class="list-group-item px-4 py-3">
										<div class="mb-2">
											<label for="couponCode" class="form-label">Apply Coupon</label>
											<div class="input-group">
												<input type="text" class="form-control" id="couponCode" placeholder="Enter coupon code">
												<button class="btn btn-outline-primary" type="button" id="applyCouponBtn">Apply</button>
											</div>
										</div>
									</li>
									
									<!-- list group item -->
									<li class="list-group-item px-4 py-3">
										<div class="d-flex align-items-center justify-content-between fw-bold">
											<div>Total</div>
											<div id="orderTotalDisplay">$76.50</div>
										</div>
									</li>
									
									<!-- Payment Button -->
									<li class="list-group-item px-4 py-3">
										<button class="btn btn-primary w-100 py-2 fw-bold" id="makePaymentBtn">
											<i class="bi bi-credit-card me-2"></i>Make Payment
										</button>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- Modal 
	<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteModalLabel">Delete address</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<h6>Are you sure you want to delete this address?</h6>
					<p class="mb-6">
						Jitu Chauhan
						<br />

						4450 North Avenue Oakland,
						<br />

						Nebraska, United States,
						<br />

						402-776-1106
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-gray-400" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger">Delete</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-body p-6">
					<div class="d-flex justify-content-between mb-5">
						
						<div>
							<h5 class="h6 mb-1" id="addAddressModalLabel">New Shipping Address</h5>
							<p class="small mb-0">Add new shipping address for your order delivery.</p>
						</div>
						<div>
							
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
					</div>
					
					<div class="row g-3">
						
						<div class="col-12">
							<input type="text" class="form-control" placeholder="First name" aria-label="First name"
								required="" />
						</div>
						
						<div class="col-12">
							<input type="text" class="form-control" placeholder="Last name" aria-label="Last name"
								required="" />
						</div>
						
						<div class="col-12">
							<input type="text" class="form-control" placeholder="Address Line 1" />
						</div>
						<div class="col-12">
							
							<input type="text" class="form-control" placeholder="Address Line 2" />
						</div>
						<div class="col-12">
							
							<input type="text" class="form-control" placeholder="City" />
						</div>
						<div class="col-12">
							
							<select class="form-select">
								<option selected="">India</option>
								<option value="1">UK</option>
								<option value="2">USA</option>
								<option value="3">UAE</option>
							</select>
						</div>
						<div class="col-12">
							
							<select class="form-select">
								<option selected="">Gujarat</option>
								<option value="1">Northern Ireland</option>
								<option value="2">Alaska</option>
								<option value="3">Abu Dhabi</option>
							</select>
						</div>
						<div class="col-12">
							
							<input type="text" class="form-control" placeholder="Zip Code" />
						</div>
						<div class="col-12">
							
							<input type="text" class="form-control" placeholder="Business Name" />
						</div>
						<div class="col-12">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
								
								<label class="form-check-label" for="flexCheckDefault">Set as Default</label>
							</div>
						</div>
						
						<div class="col-12 text-end">
							<button type="button" class="btn btn-outline-primary"
								data-bs-dismiss="modal">Cancel</button>
							<button class="btn btn-primary" type="button">Save Address</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->
</main>
@push('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Elements
		const deliveryMethodRadios = document.querySelectorAll('input[name="deliveryMethod"]');
		const shippingMethodRadios = document.querySelectorAll('input[name="shippingMethod"]');
		const deliveryShippingOptions = document.getElementById('deliveryShippingOptions');
		const pickupOptions = document.getElementById('pickupOptions');
		const deliveryAvailableAlert = document.getElementById('deliveryAvailableAlert');
		const deliveryUnavailableAlert = document.getElementById('deliveryUnavailableAlert');
		const shippingFeeDisplay = document.getElementById('shippingFeeDisplay');
		const orderTotalDisplay = document.getElementById('orderTotalDisplay');
		const couponCodeInput = document.getElementById('couponCode');
		const applyCouponBtn = document.getElementById('applyCouponBtn');
		const couponDiscountRow = document.getElementById('couponDiscountRow');
		const couponDiscountDisplay = document.getElementById('couponDiscountDisplay');
		
		// Constants
		const ITEM_SUBTOTAL = 70.00;
		const SERVICE_FEE = 3.00;
		const SHIPPING_FEES = {
			'express': 3.50,
			'nextday': 2.00,
			'standard': 1.00,
			'pickup': 0.00
		};
		
		// Variables
		let shippingFee = SHIPPING_FEES.express; // Default
		let couponDiscount = 0;
		let isDeliveryAvailable = true; // Default assumption
		
		// Initialize
		updateOrderSummary();
		checkDeliveryAvailability();
		
		// Check if delivery is available in the selected location
		function checkDeliveryAvailability() {
			// This would typically be an API call to check if delivery is available
			// For demonstration, we're using a simple check based on the selected address
			
			// Get the selected address (home/office)
			const homeRadio = document.getElementById('homeRadio');
			
			// For demo purposes, let's say delivery is available for the home address but not for the office
			isDeliveryAvailable = homeRadio.checked;
			
			// Update UI based on availability
			if (isDeliveryAvailable) {
				deliveryAvailableAlert.classList.remove('d-none');
				deliveryUnavailableAlert.classList.add('d-none');
				
				// Enable delivery option
				document.getElementById('deliveryMethodDelivery').disabled = false;
			} else {
				deliveryAvailableAlert.classList.add('d-none');
				deliveryUnavailableAlert.classList.remove('d-none');
				
				// Force self-pickup if delivery is not available
				document.getElementById('deliveryMethodPickup').checked = true;
				document.getElementById('deliveryMethodDelivery').disabled = true;
				
				// Show pickup options
				deliveryShippingOptions.classList.add('d-none');
				pickupOptions.classList.remove('d-none');
				
				// Update shipping fee
				shippingFee = SHIPPING_FEES.pickup;
				updateOrderSummary();
			}
		}
		
		// Handle delivery method change
		deliveryMethodRadios.forEach(radio => {
			radio.addEventListener('change', function() {
				if (this.value === 'delivery') {
					deliveryShippingOptions.classList.remove('d-none');
					pickupOptions.classList.add('d-none');
					
					// Set shipping fee based on selected shipping method
					const selectedShippingMethod = document.querySelector('input[name="shippingMethod"]:checked').value;
					shippingFee = SHIPPING_FEES[selectedShippingMethod];
				} else {
					deliveryShippingOptions.classList.add('d-none');
					pickupOptions.classList.remove('d-none');
					
					// Set shipping fee to 0 for pickup
					shippingFee = SHIPPING_FEES.pickup;
				}
				
				updateOrderSummary();
			});
		});
		
		// Handle shipping method change
		shippingMethodRadios.forEach(radio => {
			radio.addEventListener('change', function() {
				shippingFee = SHIPPING_FEES[this.value];
				updateOrderSummary();
			});
		});
		
		// Handle coupon application
		applyCouponBtn.addEventListener('click', function() {
			const couponCode = couponCodeInput.value.trim();
			
			if (!couponCode) {
				alert('Please enter a coupon code');
				return;
			}
			
			// This would typically be an API call to validate the coupon
			// For demonstration, we're using a simple check
			if (couponCode.toUpperCase() === 'SAVE10') {
				couponDiscount = 7.00; // $7 off
				couponDiscountRow.style.display = 'flex';
				couponDiscountDisplay.textContent = `-$${couponDiscount.toFixed(2)}`;
				applyCouponBtn.textContent = 'Applied';
				applyCouponBtn.disabled = true;
				couponCodeInput.disabled = true;
				
				// Show success message
				alert('Coupon applied successfully!');
			} else {
				alert('Invalid coupon code');
				couponDiscount = 0;
			}
			
			updateOrderSummary();
		});
		
		// Listen for address selection changes to check delivery availability
		document.getElementById('homeRadio').addEventListener('change', checkDeliveryAvailability);
		document.getElementById('officeRadio').addEventListener('change', checkDeliveryAvailability);
		
		// Update order summary
		function updateOrderSummary() {
			// Format shipping fee
			shippingFeeDisplay.textContent = `$${shippingFee.toFixed(2)}`;
			
			// Calculate total
			const total = ITEM_SUBTOTAL + SERVICE_FEE + shippingFee - couponDiscount;
			orderTotalDisplay.textContent = `$${total.toFixed(2)}`;
		}

		// Handle payment button click
		const makePaymentBtn = document.getElementById('makePaymentBtn');
		if (makePaymentBtn) {
			makePaymentBtn.addEventListener('click', function() {
				// Show payment confirmation before proceeding
				if (confirm('Proceed to payment gateway?')) {
					// Here you would typically redirect to a payment gateway
					// For demo purposes, we'll show a success alert
					alert('Redirecting to payment gateway...');
					
					// This would be replaced with actual payment gateway redirect
					// window.location.href = '/payment-gateway';
					
					// Simulate successful payment for demo
					setTimeout(() => {
						alert('Payment successful! Your order has been placed.');
						// Redirect to order confirmation page
						// window.location.href = '/order-confirmation';
					}, 2000);
				}
			});
		}
	});
</script>
@endpush
