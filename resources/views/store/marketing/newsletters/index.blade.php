@extends('layouts.frontend.store.app')

@push('styles')
<style>
    .template-thumbnail {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        transition: transform 0.3s;
    }
    
    .template-card {
        position: relative;
        overflow: hidden;
        margin-bottom: 15px;
    }
    
    .template-card:hover .template-thumbnail {
        transform: scale(1.05);
    }
    
    .template-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .template-card:hover .template-overlay {
        opacity: 1;
    }
    
    .modal-xl {
        max-width: 95%;
    }
    
    #templateGrid {
        max-height: 70vh;
        overflow-y: auto;
    }
    
    .filter-buttons {
        margin-bottom: 20px;
    }
    
    .filter-buttons .btn {
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>
@endpush

@section('content')
<div class="container">
	<!-- row -->
	<div class="row mb-4">
		<div class="col-md-12">
			<!-- page header -->
			<div class="d-md-flex justify-content-between align-items-center">
				<div>
					<h2>Newsletters</h2>
					<!-- breacrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Newsletters</li>
						</ol>
					</nav>
				</div>
				<!-- button -->
				<div>
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#templateSelectionModal">
                        Create Newsletter
                    </button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Stats Section -->
	<div class="row mb-4">
		<!-- Sent -->
		<div class="col-lg-3 col-md-6 col-12 mb-2 mb-lg-0">
			<div class="card h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<div>
							<h5 class="mb-0">Sent</h5>
							<small class="text-muted">Total newsletters sent</small>
						</div>
						<div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
							<i class="bi bi-envelope-check fs-4"></i>
						</div>
					</div>
					<h2 class="fw-bold mb-0">128</h2>
				</div>
			</div>
		</div>
		
		<!-- Scheduled -->
		<div class="col-lg-3 col-md-6 col-12 mb-2 mb-lg-0">
			<div class="card h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<div>
							<h5 class="mb-0">Scheduled</h5>
							<small class="text-muted">Upcoming newsletters</small>
						</div>
						<div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
							<i class="bi bi-calendar-event fs-4"></i>
						</div>
					</div>
					<h2 class="fw-bold mb-0">12</h2>
				</div>
			</div>
		</div>
		
		<!-- Credits Remaining -->
		<div class="col-lg-3 col-md-6 col-12 mb-2 mb-lg-0">
			<div class="card h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<div>
							<h5 class="mb-0">Credits Remaining</h5>
							<small class="text-muted">Available sending credits</small>
						</div>
						<div class="icon-shape icon-md bg-light-info text-info rounded-2">
							<i class="bi bi-stars fs-4"></i>
						</div>
					</div>
					<h2 class="fw-bold mb-0">5,000</h2>
				</div>
			</div>
		</div>
		
		<!-- Buy Credit Button -->
		<div class="col-lg-3 col-md-6 col-12 mb-2 mb-lg-0">
			<div class="card h-100">
				<div class="card-body d-flex flex-column justify-content-center">
					<div class="text-center">
						<p class="mb-3">Need more credits for your campaigns?</p>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyCreditsModal">
							Buy Credits
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- row -->
	<div class="row">
		<div class="col-xl-12 col-12 mb-5">
			<!-- card -->
			<div class="card h-100 card-lg">
				<div class="p-6">
					<div class="row justify-content-between">
						<div class="col-md-4 col-12 mb-2 mb-md-0">
							<!-- form -->
							<form class="d-flex" role="search">
								<input class="form-control" type="search" placeholder="Search newsletters" aria-label="Search" />
							</form>
						</div>
						<div class="col-lg-2 col-md-4 col-12">
							<!-- select -->
							<select class="form-select">
								<option selected>All Status</option>
								<option value="Sent">Sent</option>
								<option value="Pending">Pending</option>
								<option value="Draft">Draft</option>
							</select>
						</div>
					</div>
				</div>
				<!-- card body -->
				<div class="card-body p-0">
					<!-- table responsive -->
					<div class="table-responsive">
						<table class="table table-centered table-hover text-nowrap table-borderless mb-0">
							<thead class="bg-light">
								<tr>
									<th>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="checkAll" />
											<label class="form-check-label" for="checkAll"></label>
										</div>
									</th>
									<th>Created Date</th>
									<th>Subject</th>
									<th>Audience</th>
									<th>Recipients</th>
									<th>Template</th>
									<th>Schedule</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="newsletter1" />
											<label class="form-check-label" for="newsletter1"></label>
										</div>
									</td>
									<td>May 15, 2023</td>
									<td>Summer Collection Launch</td>
									<td>Existing Customers</td>
									<td>1,245</td>
									<td>Coupon</td>
									<td>Sent</td>
									<td>
										<span class="badge bg-success">Sent</span>
									</td>
									<td>
										<div class="dropdown">
											<a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="bi bi-three-dots-vertical"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-eye me-3"></i>
														View
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-pencil-square me-3"></i>
														Edit
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-trash me-3"></i>
														Delete
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="newsletter2" />
											<label class="form-check-label" for="newsletter2"></label>
										</div>
									</td>
									<td>May 10, 2023</td>
									<td>New Product Arrivals</td>
									<td>Existing Customers + Product Viewers</td>
									<td>2,530</td>
									<td>Announcement</td>
									<td>Send at May 20, 2023</td>
									<td>
										<span class="badge bg-warning text-dark">Scheduled</span>
									</td>
									<td>
										<div class="dropdown">
											<a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="bi bi-three-dots-vertical"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-eye me-3"></i>
														View
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-pencil-square me-3"></i>
														Edit
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-trash me-3"></i>
														Delete
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="newsletter3" />
											<label class="form-check-label" for="newsletter3"></label>
										</div>
									</td>
									<td>May 5, 2023</td>
									<td>Special Discount Week</td>
									<td>All Subscribers</td>
									<td>5,280</td>
									<td>Discount</td>
									<td>-</td>
									<td>
										<span class="badge bg-secondary">Draft</span>
									</td>
									<td>
										<div class="dropdown">
											<a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="bi bi-three-dots-vertical"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-eye me-3"></i>
														View
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-pencil-square me-3"></i>
														Edit
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-trash me-3"></i>
														Delete
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="border-top d-md-flex justify-content-between align-items-center p-6">
					<span>Showing 1 to 3 of 25 entries</span>
					<nav class="mt-2 mt-md-0">
						<ul class="pagination mb-0">
							<li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
							<li class="page-item"><a class="page-link active" href="#!">1</a></li>
							<li class="page-item"><a class="page-link" href="#!">2</a></li>
							<li class="page-item"><a class="page-link" href="#!">3</a></li>
							<li class="page-item"><a class="page-link" href="#!">Next</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Template Selection Modal -->
<div class="modal fade" id="templateSelectionModal" tabindex="-1" aria-labelledby="templateSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateSelectionModalLabel">Select Newsletter Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <button class="btn btn-primary filter-btn active" data-filter="all">All Templates</button>
                    <button class="btn btn-outline-primary filter-btn" data-filter="promotional">Promotional</button>
                    <button class="btn btn-outline-primary filter-btn" data-filter="product">Product</button>
                    <button class="btn btn-outline-primary filter-btn" data-filter="announcement">Announcement</button>
                    <button class="btn btn-outline-primary filter-btn" data-filter="sale">Sale</button>
                    <button class="btn btn-outline-primary filter-btn" data-filter="seasonal">Seasonal</button>
                    <button class="btn btn-outline-primary filter-btn" data-filter="welcome">Welcome</button>
                </div>
                
                <!-- Templates Grid -->
                <div id="templateGrid">
                    <div class="row">
                        <!-- Template 1 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="promotional product">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+1" alt="New Product Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">New Product</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'new-product']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'new-product']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 2 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="sale promotional">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+2" alt="Flash Sale Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Flash Sale</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'flash-sale']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'flash-sale']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 3 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="welcome">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+3" alt="Welcome Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Welcome</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'welcome']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'welcome']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 4 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="seasonal promotional">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+4" alt="Holiday Special Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Holiday Special</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'holiday-special']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'holiday-special']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 5 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="announcement">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+5" alt="Announcement Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Announcement</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'announcement']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'announcement']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 6 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="product">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+6" alt="Product Showcase Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Product Showcase</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'product-showcase']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'product-showcase']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 7 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="promotional">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+7" alt="Special Offer Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Special Offer</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'special-offer']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'special-offer']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 8 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="sale">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+8" alt="Clearance Sale Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Clearance Sale</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'clearance-sale']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'clearance-sale']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 9 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="seasonal">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+9" alt="Summer Collection Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Summer Collection</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'summer-collection']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'summer-collection']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 10 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="announcement">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+10" alt="Store News Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Store News</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'store-news']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'store-news']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 11 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="product promotional">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+11" alt="Featured Products Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Featured Products</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'featured-products']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'featured-products']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template 12 -->
                        <div class="col-md-2 col-sm-4 col-6 template-item" data-category="welcome">
                            <div class="template-card">
                                <img src="https://placehold.co/400x600?text=Template+12" alt="Thank You Template" class="template-thumbnail">
                                <div class="template-overlay">
                                    <h6 class="mb-2">Thank You</h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'thank-you']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'thank-you']) }}" class="btn btn-sm btn-primary">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('store.marketing.newsletters.templates', ['store' => 1]) }}" class="btn btn-outline-primary">View in full page</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Buy Credits Modal -->
<div class="modal fade" id="buyCreditsModal" tabindex="-1" aria-labelledby="buyCreditsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="buyCreditsModalLabel">Buy Newsletter Credits</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p class="text-muted mb-4">Select a credit package that fits your email marketing needs</p>
				
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="bg-light">
							<tr>
								<th>Credit Title</th>
								<th>Credit Unit</th>
								<th>Cost</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Basic Package</td>
								<td>5,000 Credits</td>
								<td>$49.99</td>
								<td>
									<button class="btn btn-sm btn-primary">Buy Now</button>
								</td>
							</tr>
							<tr>
								<td>Standard Package</td>
								<td>15,000 Credits</td>
								<td>$129.99</td>
								<td>
									<button class="btn btn-sm btn-primary">Buy Now</button>
								</td>
							</tr>
							<tr>
								<td>Premium Package</td>
								<td>50,000 Credits</td>
								<td>$399.99</td>
								<td>
									<button class="btn btn-sm btn-primary">Buy Now</button>
								</td>
							</tr>
							<tr>
								<td>Enterprise Package</td>
								<td>100,000 Credits</td>
								<td>$699.99</td>
								<td>
									<button class="btn btn-sm btn-primary">Buy Now</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="alert alert-info mt-3">
					<small>
						<i class="bi bi-info-circle me-2"></i>
						1 credit = 1 email. Credits never expire and can be used for any newsletter campaign.
					</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Filter functionality for template modal
        $('.filter-btn').on('click', function() {
            // Update active button
            $('.filter-btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            
            const selectedFilter = $(this).data('filter');
            
            if (selectedFilter === 'all') {
                // Show all templates
                $('.template-item').show();
            } else {
                // Hide all templates
                $('.template-item').hide();
                // Show only templates with the selected category
                $('.template-item').each(function() {
                    const categories = $(this).data('category').split(' ');
                    if (categories.includes(selectedFilter)) {
                        $(this).show();
                    }
                });
            }
        });
    });
</script>
@endpush