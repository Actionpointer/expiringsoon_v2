@extends('layouts.frontend.store.app')
@push('styles')
    <style>
        .icon-circle:before{
            content: '' !important;
            
        }
    </style>
@endpush
@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Notifications</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                        </ol>
                    </nav>
                </div>
                <!-- Mark all as read button -->
                <div>
                    <button type="button" class="btn btn-primary" id="markAllAsRead">
                        <i class="bi bi-check-all me-2"></i>Mark All as Read
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Filter Notifications</h5>
                </div>
                <div class="card-body">
                    <form id="notificationFilterForm">
                        <!-- Notification Status -->
                        <div class="mb-4">
                            <h6 class="mb-3">Status</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="status" id="statusAll" value="all" checked>
                                <label class="form-check-label" for="statusAll">
                                    All
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="status" id="statusUnread" value="unread">
                                <label class="form-check-label" for="statusUnread">
                                    Unread
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusRead" value="read">
                                <label class="form-check-label" for="statusRead">
                                    Read
                                </label>
                            </div>
                        </div>

                        <!-- Notification Type -->
                        <div class="mb-4">
                            <h6 class="mb-3">Type</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeAll" value="all" checked>
                                <label class="form-check-label" for="typeAll">
                                    All Types
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeOrders" value="orders">
                                <label class="form-check-label" for="typeOrders">
                                    Orders
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeInventory" value="inventory">
                                <label class="form-check-label" for="typeInventory">
                                    Inventory
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeMessages" value="messages">
                                <label class="form-check-label" for="typeMessages">
                                    Messages
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeReviews" value="reviews">
                                <label class="form-check-label" for="typeReviews">
                                    Reviews
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeDisputes" value="disputes">
                                <label class="form-check-label" for="typeDisputes">
                                    Disputes
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typePayments" value="payments">
                                <label class="form-check-label" for="typePayments">
                                    Payments & Earnings
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeSubscription" value="subscription">
                                <label class="form-check-label" for="typeSubscription">
                                    Subscription
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="type" id="typeTeam" value="team">
                                <label class="form-check-label" for="typeTeam">
                                    Team Activities
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type" id="typeSupport" value="support">
                                <label class="form-check-label" for="typeSupport">
                                    Support
                                </label>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="mb-4">
                            <h6 class="mb-3">Date Range</h6>
                            <div class="mb-3">
                                <label for="dateFrom" class="form-label">From</label>
                                <input type="date" class="form-control" id="dateFrom" name="dateFrom">
                            </div>
                            <div class="mb-3">
                                <label for="dateTo" class="form-label">To</label>
                                <input type="date" class="form-control" id="dateTo" name="dateTo">
                            </div>
                        </div>

                        <!-- Apply / Reset Filters -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notifications Content -->
        <div class="col-lg-9 col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 d-inline-block">Notifications</h5>
                            <span class="badge bg-primary ms-2">24</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <label for="sortNotifications" class="form-label mb-0 me-2">Sort by:</label>
                            <select class="form-select form-select-sm" id="sortNotifications">
                                <option selected value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="priority">Priority</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <!-- Order Status Notification (Unread) -->
                        <div class="list-group-item list-group-item-action px-4 py-3 unread" data-type="orders">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-primary">
                                        <i class="bi bi-bag-check-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0">New Order #12345</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">10 mins ago</small>
                                            <span class="ms-2 badge rounded-pill bg-primary">New</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">You have received a new order for $129.99 from John Doe.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Order</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary mark-as-read">Mark as Read</button>
                            </div>
                        </div>

                        <!-- Order Message Notification (Unread) -->
                        <div class="list-group-item list-group-item-action px-4 py-3 unread" data-type="messages">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-info">
                                        <i class="bi bi-chat-dots-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0">New Message from Order #12340</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">30 mins ago</small>
                                            <span class="ms-2 badge rounded-pill bg-info">Message</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Customer Sarah Johnson has sent you a message regarding their order.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Message</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary mark-as-read">Mark as Read</button>
                            </div>
                        </div>

                        <!-- Subscription Notice (Unread) -->
                        <div class="list-group-item list-group-item-action px-4 py-3 unread" data-type="subscription">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-warning">
                                        <i class="bi bi-credit-card-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0">Subscription Renewal Approaching</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">2 hours ago</small>
                                            <span class="ms-2 badge rounded-pill bg-warning text-dark">Subscription</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Your Pro Plan subscription will renew in 3 days. Please ensure your payment method is up to date.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">Manage Subscription</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary mark-as-read">Mark as Read</button>
                            </div>
                        </div>

                        <!-- Inventory Stock Notification (Read) -->
                        <div class="list-group-item list-group-item-action px-4 py-3" data-type="inventory">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-danger">
                                        <i class="bi bi-exclamation-triangle-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 text-muted">Low Stock Alert</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">Yesterday</small>
                                            <span class="ms-2 badge rounded-pill bg-secondary">Inventory</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">5 products have fallen below the minimum stock threshold. Please review inventory.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Inventory</a>
                            </div>
                        </div>

                        <!-- Dispute Notification (Unread) -->
                        <div class="list-group-item list-group-item-action px-4 py-3 unread" data-type="disputes">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-danger">
                                        <i class="bi bi-emoji-angry-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0">New Dispute Filed</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">Yesterday</small>
                                            <span class="ms-2 badge rounded-pill bg-danger">Urgent</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Customer Michael Brown has filed a dispute for Order #12336 claiming item not as described.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Dispute</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary mark-as-read">Mark as Read</button>
                            </div>
                        </div>

                        <!-- Review Notification (Read) -->
                        <div class="list-group-item list-group-item-action px-4 py-3" data-type="reviews">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-success">
                                        <i class="bi bi-star-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 text-muted">New 5-Star Review</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">2 days ago</small>
                                            <span class="ms-2 badge rounded-pill bg-secondary">Review</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">You received a 5-star review from Emily Chen for Premium Wireless Headphones.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Review</a>
                            </div>
                        </div>

                        <!-- Earnings Notification (Read) -->
                        <div class="list-group-item list-group-item-action px-4 py-3" data-type="payments">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-success">
                                        <i class="bi bi-cash-stack text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 text-muted">Earnings Update</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">3 days ago</small>
                                            <span class="ms-2 badge rounded-pill bg-secondary">Earnings</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Your monthly earnings report for May is ready. You earned $5,482.75 this month, a 12% increase from last month.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Report</a>
                            </div>
                        </div>

                        <!-- Withdrawal Status Notification (Unread) -->
                        <div class="list-group-item list-group-item-action px-4 py-3 unread" data-type="payments">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-info">
                                        <i class="bi bi-bank text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0">Withdrawal Processed</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">3 days ago</small>
                                            <span class="ms-2 badge rounded-pill bg-info">Payment</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Your withdrawal request for $2,500.00 has been processed. Funds should arrive in your bank account within 2-3 business days.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Details</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary mark-as-read">Mark as Read</button>
                            </div>
                        </div>

                        <!-- Team Member Activity Notification (Read) -->
                        <div class="list-group-item list-group-item-action px-4 py-3" data-type="team">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-primary">
                                        <i class="bi bi-people-fill text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 text-muted">Team Member Activity</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">5 days ago</small>
                                            <span class="ms-2 badge rounded-pill bg-secondary">Team</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Sarah Johnson updated 15 product descriptions and added 3 new products to inventory.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Activity</a>
                            </div>
                        </div>

                        <!-- Support Message Notification (Read) -->
                        <div class="list-group-item list-group-item-action px-4 py-3" data-type="support">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input notification-checkbox" type="checkbox" value="">
                                </div>
                                <div class="notification-icon text-center me-3">
                                    <span class="icon-circle bg-info">
                                        <i class="bi bi-headset text-white"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 text-muted">Support Ticket Response</h6>
                                        <div class="text-nowrap">
                                            <small class="text-muted">1 week ago</small>
                                            <span class="ms-2 badge rounded-pill bg-secondary">Support</span>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Support has responded to your ticket #45678 regarding payment gateway integration.</p>
                                </div>
                            </div>
                            <div class="notification-actions mt-2 ms-5 ps-4">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2">View Ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white p-3">
                    <nav aria-label="Notifications pagination">
                        <ul class="pagination justify-content-center mb-0">
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    
    .unread {
        background-color: rgba(13, 110, 253, 0.05);
        border-left: 3px solid #0d6efd;
    }
    
    .notification-actions {
        display: none;
    }
    
    .list-group-item:hover .notification-actions {
        display: block;
    }
    
    .list-group-item {
        transition: all 0.2s ease-in-out;
    }
    
    .list-group-item:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endpush

@push('scripts')
<script>
    // Handle marking individual notifications as read
    document.querySelectorAll('.mark-as-read').forEach(function(button) {
        button.addEventListener('click', function() {
            const notificationItem = this.closest('.list-group-item');
            notificationItem.classList.remove('unread');
            
            // Find the title and update its class
            const title = notificationItem.querySelector('h6');
            if (title) {
                title.classList.add('text-muted');
            }
            
            // Remove the mark as read button
            this.remove();
            
            // Update the badge count (this would be handled by the backend in a real app)
            const badgeCount = document.querySelector('.card-header .badge');
            let count = parseInt(badgeCount.textContent);
            badgeCount.textContent = (count - 1).toString();
            
            // Here you would also send an AJAX request to mark the notification as read on the server
        });
    });
    
    // Handle mark all as read
    document.getElementById('markAllAsRead').addEventListener('click', function() {
        document.querySelectorAll('.list-group-item.unread').forEach(function(item) {
            item.classList.remove('unread');
            
            // Find the title and update its class
            const title = item.querySelector('h6');
            if (title) {
                title.classList.add('text-muted');
            }
            
            // Remove the mark as read buttons
            const markAsReadBtn = item.querySelector('.mark-as-read');
            if (markAsReadBtn) {
                markAsReadBtn.remove();
            }
        });
        
        // Update the badge count to zero
        const badgeCount = document.querySelector('.card-header .badge');
        badgeCount.textContent = '0';
        
        // Here you would also send an AJAX request to mark all notifications as read on the server
    });
    
    // Handle notification filter form
    document.getElementById('notificationFilterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get filter values
        const status = document.querySelector('input[name="status"]:checked').value;
        const selectedTypes = Array.from(document.querySelectorAll('input[name="type"]:checked'))
            .map(checkbox => checkbox.value);
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;
        
        // Filter notifications
        document.querySelectorAll('.list-group-item').forEach(function(item) {
            let show = true;
            
            // Filter by status
            if (status === 'unread' && !item.classList.contains('unread')) {
                show = false;
            } else if (status === 'read' && item.classList.contains('unread')) {
                show = false;
            }
            
            // Filter by type
            const itemType = item.getAttribute('data-type');
            if (!selectedTypes.includes('all') && !selectedTypes.includes(itemType)) {
                show = false;
            }
            
            // Show or hide based on filters
            if (show) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
        
        // Here you would also handle date filtering with a proper date comparison
    });
    
    // Handle sorting
    document.getElementById('sortNotifications').addEventListener('change', function() {
        const sortOption = this.value;
        const notificationsList = document.querySelector('.list-group');
        const notifications = Array.from(notificationsList.querySelectorAll('.list-group-item'));
        
        // Sort notifications based on selected option
        notifications.sort(function(a, b) {
            const timeA = a.querySelector('small.text-muted').textContent;
            const timeB = b.querySelector('small.text-muted').textContent;
            
            if (sortOption === 'oldest') {
                // Simple string comparison for demo purposes
                return timeB.localeCompare(timeA);
            } else if (sortOption === 'priority') {
                // Check if item has urgent badge
                const hasUrgentA = a.querySelector('.badge.bg-danger') !== null;
                const hasUrgentB = b.querySelector('.badge.bg-danger') !== null;
                
                if (hasUrgentA && !hasUrgentB) return -1;
                if (!hasUrgentA && hasUrgentB) return 1;
                return 0;
            } else {
                // Default: newest first
                return timeA.localeCompare(timeB);
            }
        });
        
        // Reattach sorted notifications to the list
        notifications.forEach(function(notification) {
            notificationsList.appendChild(notification);
        });
    });
    
    // Handle checkboxes for bulk actions
    const masterCheckbox = document.querySelector('input[type="checkbox"]');
    const checkboxes = document.querySelectorAll('.notification-checkbox');
    
    // In a real implementation, you would add bulk action functionality here
</script>
@endpush
