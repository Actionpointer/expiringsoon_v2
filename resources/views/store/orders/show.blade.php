@extends('layouts.frontend.store.app')

@section('content')
	<div class="container">
		<!-- row -->
		<div class="row mb-8">
			<div class="col-md-12">
				<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
				<div>
					<!-- page header -->
					<h2>Order Single</h2>
					<!-- breacrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Order Single</li>
						</ol>
					</nav>
				</div>
				<!-- button -->
				<div>
					<a href="#" class="btn btn-primary">Back to all orders</a>
				</div>
				</div>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<div class="col-xl-12 col-12 mb-5">
				<!-- card -->
				<div class="card h-100 card-lg">
				<div class="card-body p-6">
					<div class="d-md-flex justify-content-between">
						<div class="d-flex align-items-center mb-2 mb-md-0">
							<h2 class="mb-0">Order ID: #FC001</h2>
							<span class="badge bg-light-warning text-dark-warning ms-2">Pending</span>
						</div>
						<!-- select option -->
						<div class="d-md-flex">
							<div class="mb-2 mb-md-0">
							<select class="form-select">
								<option selected>Status</option>
								<option value="Success">Success</option>
								<option value="Pending">Pending</option>
								<option value="Cancel">Cancel</option>
							</select>
							</div>
							<!-- button -->
							<div class="ms-md-3">
							<a href="#" class="btn btn-primary">Save</a>
							<a href="#" class="btn btn-secondary">Download Invoice</a>
							</div>
						</div>
					</div>
					<div class="mt-8">
						<div class="row">
							<!-- address -->
							<div class="col-lg-3 col-md-3 col-12">
							<div class="mb-6">
								<h6>Customer Details</h6>
								<p class="mb-1 lh-lg">
									John Alex
									<br />
									anderalex@example.com
									<br />
									+998 99 22123456
								</p>
								<a href="#">View Profile</a>
							</div>
							</div>
							<!-- address -->
							<div class="col-lg-3 col-md-3 col-12">
							<div class="mb-6">
								<h6>Shipping Address</h6>
								<p class="mb-1 lh-lg">
									Gerg Harvell
									<br />
									568, Suite Ave.
									<br />
									Austrlia, 235153
									<br />
									Contact No. +91 99999 12345
								</p>
							</div>
							</div>
							<!-- address -->
							<div class="col-lg-3 col-md-3 col-12">
							<div class="mb-6">
								<h6>Order Details</h6>
								<p class="mb-1 lh-lg">
									Order ID:
									<span class="text-dark">FC001</span>
									<br />
									Order Date:
									<span class="text-dark">October 22, 2023</span>
									<br />
									Order Total:
									<span class="text-dark">$734.28</span>
								</p>
							</div>
							</div>
							<!-- payment details -->
							<div class="col-lg-3 col-md-3 col-12">
							<div class="mb-6">
								<h6>Payment Details</h6>
								<p class="mb-1 lh-lg">
									Method:
									<span class="text-dark">Cash on Delivery</span>
									<br />
									Status:
									<span class="badge bg-light-success text-dark-success">Paid</span>
									<br />
									Transaction ID:
									<span class="text-dark">TXN123456789</span>
								</p>
							</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Tabs Navigation -->
				<ul class="nav nav-tabs justify-content-center" id="orderTabs" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active px-4" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Details</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link px-4" id="timeline-tab" data-bs-toggle="tab" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="false">Timeline</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link px-4" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="message" aria-selected="false">Message</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link px-4" id="dispute-tab" data-bs-toggle="tab" data-bs-target="#dispute" type="button" role="tab" aria-controls="dispute" aria-selected="false">Dispute</button>
					</li>
				</ul>
				
				<!-- Tabs Content -->
				<div class="tab-content" id="orderTabsContent">
					<!-- Details Tab -->
					<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
							<!-- Table -->
							<table class="table mb-0 text-nowrap table-centered">
							<!-- Table Head -->
							<thead class="bg-light">
								<tr>
									<th>Products</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<!-- tbody -->
							<tbody>
								<tr>
									<td>
										<a href="#" class="text-inherit">
										<div class="d-flex align-items-center">
											<div>
												<img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="" class="icon-shape icon-lg" />
											</div>
											<div class="ms-lg-4 mt-2 mt-lg-0">
												<h5 class="mb-0 h6">Haldiram's Sev Bhujia</h5>
											</div>
										</div>
										</a>
									</td>
									<td><span class="text-body">$18.0</span></td>
									<td>1</td>
									<td>$18.00</td>
								</tr>
								<tr>
									<td>
										<a href="#" class="text-inherit">
										<div class="d-flex align-items-center">
											<div>
												<img src="{{asset('frontend/images/products/product-img-2.jpg')}}" alt="" class="icon-shape icon-lg" />
											</div>
											<div class="ms-lg-4 mt-2 mt-lg-0">
												<h5 class="mb-0 h6">NutriChoice Digestive</h5>
											</div>
										</div>
										</a>
									</td>
									<td><span class="text-body">$24.0</span></td>
									<td>1</td>
									<td>$24.00</td>
								</tr>
								<tr>
									<td>
										<a href="#" class="text-inherit">
										<div class="d-flex align-items-center">
											<div>
												<img src="{{asset('frontend/images/products/product-img-3.jpg')}}" alt="" class="icon-shape icon-lg" />
											</div>
											<div class="ms-lg-4 mt-2 mt-lg-0">
												<h5 class="mb-0 h6">Cadbury 5 Star Chocolate</h5>
											</div>
										</div>
										</a>
									</td>
									<td><span class="text-body">$32.0</span></td>
									<td>1</td>
									<td>$32.0</td>
								</tr>
								<tr>
									<td>
										<a href="#" class="text-inherit">
										<div class="d-flex align-items-center">
											<div>
												<img src="{{asset('frontend/images/products/product-img-4.jpg')}}" alt="" class="icon-shape icon-lg" />
											</div>
											<div class="ms-lg-4 mt-2 mt-lg-0">
												<h5 class="mb-0 h6">Onion Flavour Potato</h5>
											</div>
										</div>
										</a>
									</td>
									<td><span class="text-body">$3.0</span></td>
									<td>2</td>
									<td>$6.0</td>
								</tr>
								<tr>
									<td class="border-bottom-0 pb-0"></td>
									<td class="border-bottom-0 pb-0"></td>
									<td colspan="1" class="fw-medium text-dark">
										<!-- text -->
										Sub Total :
									</td>
									<td class="fw-medium text-dark">
										<!-- text -->
										$80.00
									</td>
								</tr>
								<tr>
									<td class="border-bottom-0 pb-0"></td>
									<td class="border-bottom-0 pb-0"></td>
									<td colspan="1" class="fw-medium text-dark">
										<!-- text -->
										Shipping Cost
									</td>
									<td class="fw-medium text-dark">
										<!-- text -->
										$10.00
									</td>
								</tr>

								<tr>
									<td></td>
									<td></td>
									<td colspan="1" class="fw-semibold text-dark">
										<!-- text -->
										Grand Total
									</td>
									<td class="fw-semibold text-dark">
										<!-- text -->
										$90.00
									</td>
								</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
						
				<div class="card-body p-6">
					<div class="row">
								<div class="col-md-12">
									<h5>Order Notes</h5>
									<textarea class="form-control mb-3" rows="3" placeholder="Write note for order"></textarea>
									<a href="#" class="btn btn-primary">Save Notes</a>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Timeline Tab -->
					<div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
						<div class="p-5">
							<div class="d-flex justify-content-between align-items-center mb-4">
								<h5 class="mb-0 text-center">Order Timeline</h5>
								<button class="btn btn-primary btn-sm">Update Status</button>
							</div>
							<div class="timeline-vertical position-relative">
								<!-- Timeline Track -->
								<div class="position-absolute" style="top: 0; bottom: 0; left: 50%; width: 2px; background-color: #e9ecef; transform: translateX(-50%);"></div>
								
								<!-- Timeline Item 1 -->
								<div class="timeline-item d-flex mb-4 position-relative">
									<div class="timeline-date text-end pe-4 pt-1 flex-grow-1">
										<span class="fw-bold">22 Oct 2023</span>
										<p class="text-muted small mb-0">10:30 AM</p>
									</div>
									<div class="timeline-badge position-relative">
										<div class="badge-dot position-absolute bg-success rounded-circle p-2" style="top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;"></div>
									</div>
									<div class="timeline-content ps-4 pt-0 flex-grow-1">
										<div class="card border-0 shadow-sm">
											<div class="card-body py-3">
												<h6 class="mb-1 text-success"><i class="bi bi-check-circle me-2"></i>Order Placed</h6>
												<p class="text-muted mb-0 small">Order has been received and is now being processed.</p>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Timeline Item 2 -->
								<div class="timeline-item d-flex mb-4 position-relative">
									<div class="timeline-date text-end pe-4 pt-1 flex-grow-1">
										<span class="fw-bold">23 Oct 2023</span>
										<p class="text-muted small mb-0">09:15 AM</p>
									</div>
									<div class="timeline-badge position-relative">
										<div class="badge-dot position-absolute bg-primary rounded-circle p-2" style="top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;"></div>
									</div>
									<div class="timeline-content ps-4 pt-0 flex-grow-1">
										<div class="card border-0 shadow-sm">
											<div class="card-body py-3">
												<h6 class="mb-1 text-primary"><i class="bi bi-gear me-2"></i>Processing</h6>
												<p class="text-muted mb-0 small">Order is being processed and prepared for shipment.</p>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Timeline Item 3 -->
								<div class="timeline-item d-flex mb-4 position-relative">
									<div class="timeline-date text-end pe-4 pt-1 flex-grow-1">
										<span class="fw-bold">24 Oct 2023</span>
										<p class="text-muted small mb-0">02:30 PM</p>
									</div>
									<div class="timeline-badge position-relative">
										<div class="badge-dot position-absolute bg-info rounded-circle p-2" style="top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;"></div>
									</div>
									<div class="timeline-content ps-4 pt-0 flex-grow-1">
										<div class="card border-0 shadow-sm">
											<div class="card-body py-3">
												<h6 class="mb-1 text-info"><i class="bi bi-box-seam me-2"></i>Shipped</h6>
												<p class="text-muted mb-0 small">Order has been shipped. Tracking #: TRK78902341</p>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Timeline Item 4 (Current) -->
								<div class="timeline-item d-flex mb-4 position-relative">
									<div class="timeline-date text-end pe-4 pt-1 flex-grow-1">
										<span class="fw-bold">Current</span>
										<p class="text-muted small mb-0">In Progress</p>
									</div>
									<div class="timeline-badge position-relative">
										<div class="badge-dot position-absolute bg-warning rounded-circle p-2" style="top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;"></div>
									</div>
									<div class="timeline-content ps-4 pt-0 flex-grow-1">
										<div class="card border-0 shadow-sm">
											<div class="card-body py-3">
												<h6 class="mb-1 text-warning"><i class="bi bi-truck me-2"></i>Out for Delivery</h6>
												<p class="text-muted mb-0 small">Order is out for delivery and will arrive today.</p>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Pending Timeline Item -->
								<div class="timeline-item d-flex position-relative opacity-50">
									<div class="timeline-date text-end pe-4 pt-1 flex-grow-1">
										<span class="fw-bold">Pending</span>
										<p class="text-muted small mb-0">Upcoming</p>
									</div>
									<div class="timeline-badge position-relative">
										<div class="badge-dot position-absolute bg-secondary rounded-circle p-2" style="top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;"></div>
									</div>
									<div class="timeline-content ps-4 pt-0 flex-grow-1">
										<div class="card border-0 shadow-sm">
											<div class="card-body py-3">
												<h6 class="mb-1 text-secondary"><i class="bi bi-check2-all me-2"></i>Delivered</h6>
												<p class="text-muted mb-0 small">Order will be delivered and marked as completed.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Message Tab -->
					<div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
						<div class="p-5">
							<h5 class="mb-4">Message History</h5>
							<div class="message-container mb-4">
								<div class="alert alert-info">
									<i class="bi bi-info-circle me-2"></i> No messages found with this customer. Send a message to start the conversation.
								</div>
							</div>
							<div class="new-message">
								<h6>Send a Message to Customer</h6>
								<div class="form-group mb-3">
									<textarea class="form-control" rows="3" placeholder="Type your message here..."></textarea>
								</div>
								<button class="btn btn-primary">Send Message</button>
							</div>
						</div>
					</div>
					
					<!-- Dispute Tab -->
					<div class="tab-pane fade" id="dispute" role="tabpanel" aria-labelledby="dispute-tab">
						<div class="p-5">
							<h5 class="mb-4">Dispute History</h5>
							<div class="dispute-container">
								<div class="card mb-4 border-danger">
									<div class="card-header bg-light d-flex justify-content-between align-items-center">
										<span><i class="bi bi-exclamation-triangle text-danger me-2"></i> <strong>Active Dispute</strong> - Created on Oct 25, 2023</span>
										<span class="badge bg-danger">Unresolved</span>
									</div>
									<div class="card-body">
										<h6>Reason: Item received damaged</h6>
										<p class="text-muted">The package arrived with visible damage to the product. Customer has attached photos showing the damage.</p>
										
										<div class="dispute-messages mt-4">
											<h6 class="border-bottom pb-2">Conversation</h6>
											
											<div class="message customer mb-3 mt-3">
												<div class="message-header">
													<strong>Customer</strong> <small class="text-muted">Oct 25, 2023 11:45 AM</small>
												</div>
												<div class="message-body p-3 bg-light rounded">
													I received the package today but the product inside was damaged. I've attached photos showing the crushed corners and broken parts. Please help resolve this issue.
												</div>
												<!-- Attachment thumbnails -->
												<div class="mt-2 d-flex gap-2">
													<a href="#" data-bs-toggle="modal" data-bs-target="#imageGalleryModal" data-image-index="0">
														<img src="{{asset('frontend/images/products/damaged-1-thumb.jpg')}}" alt="Damaged product" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;" />
													</a>
													<a href="#" data-bs-toggle="modal" data-bs-target="#imageGalleryModal" data-image-index="1">
														<img src="{{asset('frontend/images/products/damaged-2-thumb.jpg')}}" alt="Damaged packaging" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;" />
													</a>
												</div>
											</div>
											
											<div class="message vendor mb-3">
												<div class="message-header text-end">
													<strong>You</strong> <small class="text-muted">Oct 25, 2023 01:30 PM</small>
												</div>
												<div class="message-body p-3 bg-primary text-white rounded">
													We're sorry to hear about the damaged product. We'll investigate this immediately and get back to you with a resolution as soon as possible.
												</div>
											</div>
										</div>
										
										<div class="mt-4">
											<h6>Respond to Dispute</h6>
											<div class="form-group mb-3">
												<textarea class="form-control" rows="3" placeholder="Type your response..."></textarea>
											</div>
											<div class="d-flex gap-2">
												<button class="btn btn-primary">Send Response</button>
												<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#offerRefundModal">Offer Refund</button>
												<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#offerReplacementModal">Offer Replacement</button>
												<button class="btn btn-secondary">Mark as Resolved</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Image Gallery Modal -->
	<div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="imageGalleryModalLabel">Dispute Attachments</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body p-0">
					<div id="disputeImageCarousel" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="{{asset('frontend/images/products/damaged-1.jpg')}}" class="d-block w-100" alt="Damaged product">
								<div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
									<h5>Damaged Product</h5>
									<p>Close-up of damaged corners and broken parts</p>
								</div>
							</div>
							<div class="carousel-item">
								<img src="{{asset('frontend/images/products/damaged-2.jpg')}}" class="d-block w-100" alt="Damaged packaging">
								<div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
									<h5>Damaged Packaging</h5>
									<p>Shipping box showing external damage</p>
								</div>
							</div>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#disputeImageCarousel" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#disputeImageCarousel" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<a href="{{asset('frontend/images/products/damaged-1.jpg')}}" class="btn btn-primary" download>Download</a>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Offer Refund Modal -->
	<div class="modal fade" id="offerRefundModal" tabindex="-1" aria-labelledby="offerRefundModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="offerRefundModalLabel">Offer Refund</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="refundType" class="form-label">Refund Type</label>
							<select class="form-select" id="refundType">
								<option value="full">Full Refund</option>
								<option value="partial">Partial Refund</option>
							</select>
						</div>
						
						<div class="mb-3">
							<label for="refundAmount" class="form-label">Refund Amount</label>
							<div class="input-group">
								<span class="input-group-text">$</span>
								<input type="number" class="form-control" id="refundAmount" value="90.00" step="0.01">
							</div>
							<div class="form-text">Original Order Total: $90.00</div>
						</div>
						
						<div class="mb-3">
							<label for="refundMethod" class="form-label">Refund Method</label>
							<select class="form-select" id="refundMethod">
								<option value="original">Original Payment Method</option>
								<option value="store_credit">Store Credit</option>
								<option value="bank_transfer">Bank Transfer</option>
							</select>
						</div>
						
						<div class="mb-3">
							<label for="refundReason" class="form-label">Reason for Refund</label>
							<textarea class="form-control" id="refundReason" rows="3">Product arrived damaged as reported by customer.</textarea>
						</div>
						
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="customerKeepsProduct">
							<label class="form-check-label" for="customerKeepsProduct">Customer keeps the product</label>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-success">Send Refund Offer</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Offer Replacement Modal -->
	<div class="modal fade" id="offerReplacementModal" tabindex="-1" aria-labelledby="offerReplacementModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="offerReplacementModalLabel">Offer Replacement</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<h6 class="mb-3">Select Items to Replace</h6>
						
						<div class="table-responsive mb-4">
							<table class="table table-bordered">
								<thead class="table-light">
									<tr>
										<th width="50px">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="selectAllItems" checked>
												<label class="form-check-label" for="selectAllItems"></label>
											</div>
										</th>
										<th>Product</th>
										<th>Quantity</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="replaceItem1" checked>
												<label class="form-check-label" for="replaceItem1"></label>
											</div>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="" class="icon-shape icon-md me-3">
												<span>Haldiram's Sev Bhujia</span>
											</div>
										</td>
										<td>
											<input type="number" class="form-control form-control-sm" min="1" value="1" style="width: 70px">
										</td>
										<td>$18.00</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="row mb-3">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="replacementShipping" class="form-label">Shipping Method</label>
									<select class="form-select" id="replacementShipping">
										<option value="standard">Standard Shipping</option>
										<option value="expedited" selected>Expedited Shipping (Free)</option>
										<option value="overnight">Overnight Shipping</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="returnRequired" class="form-label">Return Required?</label>
									<select class="form-select" id="returnRequired">
										<option value="yes">Yes - Customer must return damaged item</option>
										<option value="no" selected>No - Customer can dispose of damaged item</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="mb-3">
							<label for="replacementNotes" class="form-label">Additional Instructions</label>
							<textarea class="form-control" id="replacementNotes" rows="3">We'll send a replacement immediately with expedited shipping at no additional cost. No need to return the damaged item.</textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-info">Send Replacement Offer</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script>
	// Script to show specific image when thumbnail is clicked
	document.querySelectorAll('[data-image-index]').forEach(function(element) {
		element.addEventListener('click', function(event) {
			event.preventDefault();
			var index = this.getAttribute('data-image-index');
			var carousel = new bootstrap.Carousel(document.getElementById('disputeImageCarousel'));
			carousel.to(parseInt(index));
		});
	});
</script>
@endsection