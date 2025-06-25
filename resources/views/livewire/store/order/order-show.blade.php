<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Order Details</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order #1001</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="#" class="btn btn-light">Back to Orders</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Summary -->
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="card mb-4">
                <div class="card-header">Order Summary</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Order #:</strong> 1001<br>
                            <strong>Date:</strong> 2024-06-01<br>
                            <strong>Status:</strong> <span class="badge bg-warning">Pending</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Customer:</strong> John Doe<br>
                            <strong>Email:</strong> john@example.com<br>
                            <strong>Phone:</strong> 08012345678
                        </div>
                    </div>
                    <hr>
                    <h5>Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Product A</td>
                                    <td>2</td>
                                    <td>₦ 5,000</td>
                                    <td>₦ 10,000</td>
                                </tr>
                                <tr>
                                    <td>Product B</td>
                                    <td>1</td>
                                    <td>₦ 2,000</td>
                                    <td>₦ 2,000</td>
                                </tr>
                                <!-- More items as needed -->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="text-end">
                            <div><strong>Subtotal:</strong> ₦ 12,000</div>
                            <div><strong>Shipping:</strong> ₦ 500</div>
                            <div><strong>Total:</strong> <span class="fw-bold">₦ 12,500</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Timeline -->
            <div class="card mb-4">
                <div class="card-header">Order Timeline</div>
                <div class="card-body">
                    <ul class="timeline">
                        <li><span class="badge bg-secondary">2024-06-01 10:00</span> Order placed</li>
                        <li><span class="badge bg-info">2024-06-01 12:00</span> Payment received</li>
                        <li><span class="badge bg-warning">2024-06-02 09:00</span> Processing</li>
                        <!-- More timeline events as needed -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <!-- Shipping & Billing -->
            <div class="card mb-4">
                <div class="card-header">Shipping Information</div>
                <div class="card-body">
                    <div><strong>Name:</strong> John Doe</div>
                    <div><strong>Address:</strong> 123 Main St, Lagos</div>
                    <div><strong>City:</strong> Lagos</div>
                    <div><strong>State:</strong> Lagos</div>
                    <div><strong>Country:</strong> Nigeria</div>
                    <div><strong>Phone:</strong> 08012345678</div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Billing Information</div>
                <div class="card-body">
                    <div><strong>Name:</strong> John Doe</div>
                    <div><strong>Address:</strong> 123 Main St, Lagos</div>
                    <div><strong>City:</strong> Lagos</div>
                    <div><strong>State:</strong> Lagos</div>
                    <div><strong>Country:</strong> Nigeria</div>
                    <div><strong>Phone:</strong> 08012345678</div>
                </div>
            </div>
            <!-- Payment Info -->
            <div class="card mb-4">
                <div class="card-header">Payment Information</div>
                <div class="card-body">
                    <div><strong>Method:</strong> Card</div>
                    <div><strong>Status:</strong> Paid</div>
                    <div><strong>Transaction ID:</strong> TXN123456</div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.timeline {
    list-style: none;
    padding-left: 0;
}
.timeline li {
    margin-bottom: 10px;
    position: relative;
    padding-left: 30px;
}
.timeline li:before {
    content: '';
    position: absolute;
    left: 10px;
    top: 6px;
    width: 10px;
    height: 10px;
    background: #0d6efd;
    border-radius: 50%;
}
</style> 