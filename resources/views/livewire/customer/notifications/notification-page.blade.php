<div class="py-4 p-md-5 p-lg-6">
    <div class="mb-5 border-bottom pb-3">
        <!-- heading -->
        <h2 class="mb-0">Notifications</h2>
        <p class="text-muted mt-1">Keep track of all your account activities and updates</p>
    </div>

    <div class="mb-5">
        <!-- Notification Filters and Actions -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <!-- Notification Filters -->
            <div class="mb-3 mb-md-0">
                <ul class="nav nav-pills" id="notificationTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all-notifications"
                            type="button" role="tab" aria-controls="all-notifications" aria-selected="true">
                            All
                            <span class="badge bg-light text-dark ms-1">24</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="unread-tab" data-bs-toggle="pill" data-bs-target="#unread-notifications"
                            type="button" role="tab" aria-controls="unread-notifications" aria-selected="false">
                            Unread
                            <span class="badge bg-danger ms-1">8</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="important-tab" data-bs-toggle="pill" data-bs-target="#important-notifications"
                            type="button" role="tab" aria-controls="important-notifications" aria-selected="false">
                            Important
                            <span class="badge bg-warning ms-1">3</span>
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Notification Actions -->
            <div class="d-flex">
                <button class="btn btn-outline-primary btn-sm me-2">
                    <i class="bi bi-check2-all me-1"></i>Mark All as Read
                </button>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Clear All Notifications</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-star me-2"></i>Mark All as Important</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-bell-slash me-2"></i>Mute Notifications</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notification List -->
        <div class="tab-content" id="notificationTabContent">
            <!-- All Notifications Tab -->
            <div class="tab-pane fade show active" id="all-notifications" role="tabpanel" aria-labelledby="all-tab">
                <!-- Order Notification -->
                <div class="card shadow-sm mb-3 border-start border-4 border-success">
                    <div class="card-body position-relative">
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-success text-white rounded-circle">
                                    <i class="bi bi-bag-check"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Order #57893 has been shipped</h6>
                                <p class="mb-0 text-dark">Your order has been shipped and is on its way to you. Track your order to see the delivery status.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>2 hours ago
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Track Order</a>
                                </div>
                            </div>
                            <!-- Status and Actions -->
                            <div class="dropdown position-absolute top-0 end-0 mt-3 me-3">
                                <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Mark as Read</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-star me-2"></i>Mark as Important</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Notification - Unread -->
                <div class="card shadow-sm mb-3 border-start border-4 border-primary bg-light">
                    <div class="card-body position-relative">
                        <!-- Unread indicator -->
                        <span class="position-absolute top-0 end-0 mt-3 me-3 badge bg-primary">New</span>
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-primary text-white rounded-circle">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Payment successful for order #56782</h6>
                                <p class="mb-0 text-dark">Your payment of $129.00 has been successfully processed. Your receipt has been sent to your email address.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>Yesterday at 3:42 PM
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">View Receipt</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Notification - Important -->
                <div class="card shadow-sm mb-3 border-start border-4 border-warning">
                    <div class="card-body position-relative">
                        <!-- Important indicator -->
                        <span class="position-absolute top-0 end-0 mt-3 me-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                        </span>
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-warning text-white rounded-circle">
                                    <i class="bi bi-box-seam"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Product from your wishlist is now in stock</h6>
                                <p class="mb-0 text-dark">Good news! The "Organic Fresh Vegetables Box" you've been watching is now back in stock. Act fast before it sells out again.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>2 days ago
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-primary">Add to Cart</a>
                                    <a href="#" class="btn btn-sm btn-outline-secondary ms-2">View Product</a>
                                </div>
                            </div>
                            <!-- Status and Actions -->
                            <div class="dropdown position-absolute top-0 end-0 mt-3 me-3">
                                <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Mark as Read</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-star-fill me-2"></i>Remove from Important</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Notification -->
                <div class="card shadow-sm mb-3 border-start border-4 border-info">
                    <div class="card-body position-relative">
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-info text-white rounded-circle">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Security alert: New login from Windows device</h6>
                                <p class="mb-0 text-dark">We noticed a new login to your account from a Windows device in London, UK. If this was you, you can ignore this message.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>3 days ago
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-danger">Not Me</a>
                                    <a href="#" class="btn btn-sm btn-outline-secondary ms-2">It Was Me</a>
                                </div>
                            </div>
                            <!-- Status and Actions -->
                            <div class="dropdown position-absolute top-0 end-0 mt-3 me-3">
                                <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Mark as Read</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-star me-2"></i>Mark as Important</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Promo Notification -->
                <div class="card shadow-sm mb-3 border-start border-4 border-danger">
                    <div class="card-body position-relative">
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-danger text-white rounded-circle">
                                    <i class="bi bi-gift"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Special offer: 25% off on fresh fruits</h6>
                                <p class="mb-0 text-dark">For a limited time only, enjoy 25% off all fresh fruits. Use code FRESH25 at checkout. Valid until June 30th.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>5 days ago
                                </p>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-outline-primary" onclick="navigator.clipboard.writeText('FRESH25')">
                                        Copy Code: FRESH25
                                    </button>
                                    <a href="#" class="btn btn-sm btn-outline-secondary ms-2">Shop Now</a>
                                </div>
                            </div>
                            <!-- Status and Actions -->
                            <div class="dropdown position-absolute top-0 end-0 mt-3 me-3">
                                <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Mark as Read</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-star me-2"></i>Mark as Important</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Older Notifications Divider -->
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="border-bottom flex-grow-1"></div>
                    <div class="mx-3 text-muted small">Older Notifications</div>
                    <div class="border-bottom flex-grow-1"></div>
                </div>

                <!-- Account Notification -->
                <div class="card shadow-sm mb-3 border-start border-4 border-secondary opacity-75">
                    <div class="card-body position-relative">
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-secondary text-white rounded-circle">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1">Profile information updated</h6>
                                <p class="mb-0 text-dark">Your profile information has been successfully updated.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>1 week ago
                                </p>
                            </div>
                            <!-- Status and Actions -->
                            <div class="dropdown position-absolute top-0 end-0 mt-3 me-3">
                                <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-star me-2"></i>Mark as Important</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Notifications page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Unread Notifications Tab -->
            <div class="tab-pane fade" id="unread-notifications" role="tabpanel" aria-labelledby="unread-tab">
                <!-- Payment Notification - Unread -->
                <div class="card shadow-sm mb-3 border-start border-4 border-primary bg-light">
                    <div class="card-body position-relative">
                        <!-- Unread indicator -->
                        <span class="position-absolute top-0 end-0 mt-3 me-3 badge bg-primary">New</span>
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-primary text-white rounded-circle">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Payment successful for order #56782</h6>
                                <p class="mb-0 text-dark">Your payment of $129.00 has been successfully processed. Your receipt has been sent to your email address.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>Yesterday at 3:42 PM
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">View Receipt</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State for Unread when all read -->
                <div class="text-center p-5 d-none">
                    <div class="mb-4">
                        <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h3>All caught up!</h3>
                    <p class="text-muted">You have no unread notifications at the moment.</p>
                </div>
            </div>

            <!-- Important Notifications Tab -->
            <div class="tab-pane fade" id="important-notifications" role="tabpanel" aria-labelledby="important-tab">
                <!-- Product Notification - Important -->
                <div class="card shadow-sm mb-3 border-start border-4 border-warning">
                    <div class="card-body position-relative">
                        <!-- Important indicator -->
                        <span class="position-absolute top-0 end-0 mt-3 me-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                        </span>
                        <div class="d-flex">
                            <div class="me-3 mt-1">
                                <span class="icon-shape icon-sm bg-warning text-white rounded-circle">
                                    <i class="bi bi-box-seam"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 pe-7">
                                <h6 class="mb-1 fw-bold">Product from your wishlist is now in stock</h6>
                                <p class="mb-0 text-dark">Good news! The "Organic Fresh Vegetables Box" you've been watching is now back in stock. Act fast before it sells out again.</p>
                                <p class="mb-0 small text-muted mt-2">
                                    <i class="bi bi-clock me-1"></i>2 days ago
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-primary">Add to Cart</a>
                                    <a href="#" class="btn btn-sm btn-outline-secondary ms-2">View Product</a>
                                </div>
                            </div>
                            <!-- Status and Actions -->
                            <div class="dropdown position-absolute top-0 end-0 mt-3 me-3">
                                <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Mark as Read</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-star-fill me-2"></i>Remove from Important</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State for Important -->
                <div class="text-center p-5 d-none">
                    <div class="mb-4">
                        <i class="bi bi-star text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h3>No important notifications</h3>
                    <p class="text-muted">You haven't marked any notifications as important yet.</p>
                </div>
            </div>
        </div>
    </div>


</div>