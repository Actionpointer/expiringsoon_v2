@extends('layouts.frontend.customer.app')
@section('content')
		<!-- section -->
	<section>
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- col -->
				<div class="col-12">
					<div class="d-flex justify-content-between align-items-center d-md-none py-4">
						<!-- heading -->
						<h3 class="fs-5 mb-0">Menu</h3>
						<!-- button -->
						<button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3"
							type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
							aria-controls="offcanvasAccount">
							<i class="bi bi-text-indent-left fs-3"></i>
						</button>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
					@include('layouts.frontend.customer.dashboard.sidebar')
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="py-6 p-md-6 p-lg-10">
						<!-- heading and greeting -->
						<div class="mb-5">
							<h2 class="mb-2">Welcome back, {{ auth()->user()->name ?? 'User' }}!</h2>
							<p class="text-muted">Here's what's happening with your account today.</p>
						</div>

						<!-- Wallet Card -->
						<div class="card mb-5 border-0 shadow-sm">
							<div class="card-body p-4">
								<div class="d-flex justify-content-between align-items-center mb-3">
									<h4 class="card-title mb-0">Your Wallet</h4>
									<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fundWalletModal">
										<i class="bi bi-plus-circle me-2"></i>Fund Wallet
									</a>
								</div>
								<div class="d-flex align-items-center">
									<div class="display-5 fw-bold text-primary">${{ number_format(auth()->user()->wallet_balance ?? 0, 2) }}</div>
									<div class="ms-3 text-muted">Available Balance</div>
								</div>
								<div class="mt-3">
									<a href="#" class="btn btn-sm btn-outline-secondary me-2">Transaction History</a>
									<a href="#" class="btn btn-sm btn-outline-secondary">Withdraw</a>
								</div>
							</div>
						</div>

						<!-- Recent Updates -->
						<div class="row g-4 mb-5 align-items-start">
							<!-- Orders Updates -->
							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm">
									<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Recent Orders</h5>
										<a href="#" class="btn btn-sm btn-link">View All</a>
									</div>
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">
											<li class="list-group-item p-3 border-0">
												<div class="d-flex align-items-center">
													<div class="rounded-circle bg-light p-2 me-3">
														<i class="bi bi-box-seam text-primary"></i>
													</div>
													<div>
														<p class="mb-0 fw-medium">Order #12345 is being shipped</p>
														<small class="text-muted">2 hours ago</small>
													</div>
												</div>
											</li>
											<li class="list-group-item p-3 border-0">
												<div class="d-flex align-items-center">
													<div class="rounded-circle bg-light p-2 me-3">
														<i class="bi bi-check-circle text-success"></i>
													</div>
													<div>
														<p class="mb-0 fw-medium">Order #12342 has been delivered</p>
														<small class="text-muted">Yesterday</small>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<!-- Wishlist Updates -->
							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm">
									<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Wishlist Updates</h5>
										<a href="#" class="btn btn-sm btn-link">View All</a>
									</div>
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">
											<li class="list-group-item p-3 border-0">
												<div class="d-flex align-items-center">
													<div class="rounded-circle bg-light p-2 me-3">
														<i class="bi bi-tags text-warning"></i>
													</div>
													<div>
														<p class="mb-0 fw-medium">iPhone 14 Pro is back in stock!</p>
														<small class="text-muted">1 day ago</small>
													</div>
												</div>
											</li>
											<li class="list-group-item p-3 border-0">
												<div class="d-flex align-items-center">
													<div class="rounded-circle bg-light p-2 me-3">
														<i class="bi bi-arrow-down-circle text-danger"></i>
													</div>
													<div>
														<p class="mb-0 fw-medium">Samsung TV price dropped by 15%</p>
														<small class="text-muted">3 days ago</small>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm">
									<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Trending Now</h5>
										<a href="#" class="btn btn-sm btn-link">See More</a>
									</div>
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">
											<li class="list-group-item p-3 border-0">
												<div class="d-flex">
													<img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="Product" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
													<div>
														<h6 class="mb-1">Wireless Earbuds Pro</h6>
														<div class="d-flex align-items-center mb-1">
															<div class="text-warning me-2">
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-half"></i>
															</div>
															<span class="small">(120)</span>
														</div>
														<div class="fw-bold">$129.99</div>
													</div>
												</div>
											</li>
											<li class="list-group-item p-3 border-0">
												<div class="d-flex">
													<img src="{{asset('frontend/images/products/product-img-2.jpg')}}" alt="Product" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
													<div>
														<h6 class="mb-1">Smart Watch Series 7</h6>
														<div class="d-flex align-items-center mb-1">
															<div class="text-warning me-2">
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star-fill"></i>
																<i class="bi bi-star"></i>
															</div>
															<span class="small">(85)</span>
														</div>
														<div class="fw-bold">$249.99</div>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<!-- Coupons -->
							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm">
									<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Available Coupons</h5>
										<a href="#" class="btn btn-sm btn-link">All Coupons</a>
									</div>
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">
											<li class="list-group-item p-3 border-0">
												<div class="d-flex justify-content-between align-items-center mb-2">
													<div class="d-flex align-items-center">
														<div class="bg-primary text-white p-2 rounded me-3">
															<i class="bi bi-percent"></i>
														</div>
														<div>
															<h6 class="mb-0">SUMMER25</h6>
															<small class="text-muted">25% off on summer collection</small>
														</div>
													</div>
													<button class="btn btn-sm btn-outline-primary">Copy</button>
												</div>
												<div class="progress" style="height: 5px;">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<small class="text-muted">Expires in 3 days</small>
											</li>
											<li class="list-group-item p-3 border-0">
												<div class="d-flex justify-content-between align-items-center mb-2">
													<div class="d-flex align-items-center">
														<div class="bg-success text-white p-2 rounded me-3">
															<i class="bi bi-percent"></i>
														</div>
														<div>
															<h6 class="mb-0">NEWUSER10</h6>
															<small class="text-muted">10% off on your first order</small>
														</div>
													</div>
													<button class="btn btn-sm btn-outline-success">Copy</button>
												</div>
												<div class="progress" style="height: 5px;">
													<div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<small class="text-muted">Never expires</small>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm">
									<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Recently Viewed Products</h5>
										<a href="#" class="btn btn-sm btn-link">View All</a>
									</div>
									<div class="card-body p-0">
										<div class="row g-0">
											<div class="col-4 p-3 border-end">
												<div class="text-center">
													<img src="{{asset('frontend/images/products/product-img-3.jpg')}}" alt="Product" class="img-fluid rounded mb-2" style="height: 100px; object-fit: cover;">
													<div class="small fw-medium">Wireless Headphones</div>
													<div class="small text-primary">$89.99</div>
												</div>
											</div>
											<div class="col-4 p-3 border-end">
												<div class="text-center">
													<img src="{{asset('frontend/images/products/product-img-4.jpg')}}" alt="Product" class="img-fluid rounded mb-2" style="height: 100px; object-fit: cover;">
													<div class="small fw-medium">Bluetooth Speaker</div>
													<div class="small text-primary">$59.99</div>
												</div>
											</div>
											<div class="col-4 p-3">
												<div class="text-center">
													<img src="{{asset('frontend/images/products/product-img-5.jpg')}}" alt="Product" class="img-fluid rounded mb-2" style="height: 100px; object-fit: cover;">
													<div class="small fw-medium">Power Bank 20000mAh</div>
													<div class="small text-primary">$45.99</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Recently Viewed Articles -->
							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm">
									<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Recent Blog Articles</h5>
										<a href="#" class="btn btn-sm btn-link">View Blog</a>
									</div>
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">
											<li class="list-group-item p-3 border-0">
												<div class="d-flex">
													<img src="{{asset('frontend/images/blog/blog-img-1.jpg')}}" alt="Blog" class="rounded me-3" style="width: 80px; height: 60px; object-fit: cover;">
													<div>
														<h6 class="mb-1">Top 10 Gadgets for Summer 2023</h6>
														<p class="mb-0 text-muted small">
															<i class="bi bi-calendar me-1"></i> May 15, 2023
															<span class="mx-2">•</span>
															<i class="bi bi-eye me-1"></i> 1.2k views
														</p>
													</div>
												</div>
											</li>
											<li class="list-group-item p-3 border-0">
												<div class="d-flex">
													<img src="{{asset('frontend/images/blog/blog-img-2.jpg')}}" alt="Blog" class="rounded me-3" style="width: 80px; height: 60px; object-fit: cover;">
													<div>
														<h6 class="mb-1">How to Choose the Perfect Smartphone</h6>
														<p class="mb-0 text-muted small">
															<i class="bi bi-calendar me-1"></i> May 10, 2023
															<span class="mx-2">•</span>
															<i class="bi bi-eye me-1"></i> 3.5k views
														</p>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>


						<!-- Fund Wallet Modal -->
						<div class="modal fade" id="fundWalletModal" tabindex="-1" aria-labelledby="fundWalletModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="fundWalletModalLabel">Fund Your Wallet</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form>
											<div class="mb-3">
												<label for="amount" class="form-label">Amount</label>
												<div class="input-group">
													<span class="input-group-text">$</span>
													<input type="number" class="form-control" id="amount" placeholder="Enter amount" min="1">
												</div>
											</div>
											<div class="mb-3">
												<label class="form-label">Payment Method</label>
												<div class="form-check mb-2">
													<input class="form-check-input" type="radio" name="paymentMethod" id="card" checked>
													<label class="form-check-label" for="card">
														Credit/Debit Card
													</label>
												</div>
												<div class="form-check mb-2">
													<input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
													<label class="form-check-label" for="paypal">
														PayPal
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer">
													<label class="form-check-label" for="bankTransfer">
														Bank Transfer
													</label>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-primary">Fund Now</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('layouts.frontend.customer.dashboard.mobile-sidebar')
@endsection