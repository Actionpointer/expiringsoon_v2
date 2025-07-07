<div class="py-6 p-md-6 p-lg-10">
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

                            <!-- button -->
                            <div class="ms-md-3">
                                <a href="#" class="btn btn-outline-primary">Mark as Delivered</a>
                                <a href="#" class="btn btn-secondary">Download Invoice</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <div class="row">
                            <!-- address -->
                            <div class="col-lg-4 col-md-4 col-12">
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
                            <div class="col-lg-4 col-md-4 col-12">
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
                            <div class="col-lg-4 col-md-4 col-12">
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
                    </div>

                    <!-- Timeline Tab -->
                    <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                        <div class="p-5">
                            <h5 class="mb-4 text-center">Order Timeline</h5>
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
                                                <p class="text-muted mb-0 small">Your order has been received and is now being processed.</p>
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
                                                <p class="text-muted mb-0 small">Your order is being processed and prepared for shipment.</p>
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
                                                <p class="text-muted mb-0 small">Your order has been shipped. Tracking #: TRK78902341</p>
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
                                                <p class="text-muted mb-0 small">Your order is out for delivery and will arrive today.</p>
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
                                <div class="message vendor mb-3">
                                    <div class="message-header">
                                        <strong>Vendor</strong> <small class="text-muted">Oct 22, 2023 10:30 AM</small>
                                    </div>
                                    <div class="message-body p-3 bg-light rounded">
                                        Thank you for your order! We'll process it right away.
                                    </div>
                                </div>
                                <div class="message customer mb-3">
                                    <div class="message-header text-end">
                                        <strong>You</strong> <small class="text-muted">Oct 22, 2023 11:45 AM</small>
                                    </div>
                                    <div class="message-body p-3 bg-primary text-white rounded">
                                        Thank you! When can I expect the delivery?
                                    </div>
                                </div>
                                <div class="message vendor mb-3">
                                    <div class="message-header">
                                        <strong>Vendor</strong> <small class="text-muted">Oct 22, 2023 12:15 PM</small>
                                    </div>
                                    <div class="message-body p-3 bg-light rounded">
                                        Your order should arrive within 3-5 business days. We'll send tracking information soon.
                                    </div>
                                </div>
                            </div>
                            <div class="new-message">
                                <h6>Send a Message</h6>
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
                                <div class="alert alert-info">
                                    No disputes have been filed for this order yet.
                                </div>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        File a New Dispute
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="disputeReason" class="form-label">Reason for Dispute</label>
                                            <select class="form-select" id="disputeReason">
                                                <option selected>Select a reason</option>
                                                <option>Item not as described</option>
                                                <option>Item damaged</option>
                                                <option>Wrong item received</option>
                                                <option>Item not received</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="disputeDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="disputeDescription" rows="3" placeholder="Describe your issue..."></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="disputeAttachment" class="form-label">Attachments (if any)</label>
                                            <input type="file" class="form-control" id="disputeAttachment">
                                            <small class="text-muted">Upload photos or evidence related to your dispute</small>
                                        </div>
                                        <button class="btn btn-danger">Submit Dispute</button>
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