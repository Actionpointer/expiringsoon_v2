<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Orders</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form class="d-flex align-items-center gap-2">
                        <input type="search" class="form-control" placeholder="Search orders...">
                        <select class="form-select w-auto">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1001</td>
                                    <td>2024-06-01</td>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>₦ 12,000</td>
                                    <td>Card</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1002</td>
                                    <td>2024-06-02</td>
                                    <td>Jane Smith</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>₦ 8,500</td>
                                    <td>Bank Transfer</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                                <!-- More rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>Showing 1 to 10 of 50 entries</span>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div> 