@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Earnings</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Earnings</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.earnings.withdrawals',1) }}" class="btn btn-primary">Withdrawal Management</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-6">
        <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$12,650</h4>
                            <p class="mb-0 fs-6">Total Earnings</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-primary text-primary rounded-3">
                            <i class="bi bi-wallet2 fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$2,865</h4>
                            <p class="mb-0 fs-6">Available for Withdrawal</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-success text-success rounded-3">
                            <i class="bi bi-currency-dollar fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$980</h4>
                            <p class="mb-0 fs-6">Pending Clearance</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-warning text-warning rounded-3">
                            <i class="bi bi-hourglass-split fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$7,900</h4>
                            <p class="mb-0 fs-6">Withdrawn to Date</p>
                        </div>
                        <div class="icon-shape icon-xl bg-light-info text-info rounded-3">
                            <i class="bi bi-bank fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mini Chart Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="card card-lg">
                <div class="card-body p-4">
                    <h4 class="mb-4">Earnings Overview</h4>
                    <div style="height: 200px;">
                        <!-- Placeholder for chart -->
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light rounded">
                            <p class="text-muted mb-0">Earnings Chart - Last 12 Months</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings Table Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="card card-lg">
                <div class="card-header bg-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Earnings History</h4>
                        <div>
                            <select class="form-select">
                                <option selected>Last 30 Days</option>
                                <option>This Month</option>
                                <option>Last 3 Months</option>
                                <option>This Year</option>
                                <option>All Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Products</th>
                                    <th>Order Total</th>
                                    <th>Platform Fee</th>
                                    <th>Net Earnings</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" class="text-inherit">#FC0035</a></td>
                                    <td>Nov 18, 2023</td>
                                    <td>John Alexander</td>
                                    <td>3 items</td>
                                    <td>$180.00</td>
                                    <td>$18.00</td>
                                    <td>$162.00</td>
                                    <td><span class="badge bg-light-success text-dark-success">Available</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Order</a></li>
                                                <li><a class="dropdown-item" href="#">View Invoice</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#FC0034</a></td>
                                    <td>Nov 16, 2023</td>
                                    <td>Michael Johnson</td>
                                    <td>2 items</td>
                                    <td>$120.00</td>
                                    <td>$12.00</td>
                                    <td>$108.00</td>
                                    <td><span class="badge bg-light-success text-dark-success">Available</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Order</a></li>
                                                <li><a class="dropdown-item" href="#">View Invoice</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#FC0033</a></td>
                                    <td>Nov 15, 2023</td>
                                    <td>Sara Williams</td>
                                    <td>5 items</td>
                                    <td>$320.00</td>
                                    <td>$32.00</td>
                                    <td>$288.00</td>
                                    <td><span class="badge bg-light-warning text-dark-warning">Pending</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Order</a></li>
                                                <li><a class="dropdown-item" href="#">View Invoice</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#FC0032</a></td>
                                    <td>Nov 14, 2023</td>
                                    <td>Robert Davis</td>
                                    <td>1 item</td>
                                    <td>$95.00</td>
                                    <td>$9.50</td>
                                    <td>$85.50</td>
                                    <td><span class="badge bg-light-success text-dark-success">Available</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Order</a></li>
                                                <li><a class="dropdown-item" href="#">View Invoice</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#FC0031</a></td>
                                    <td>Nov 12, 2023</td>
                                    <td>Emily Thompson</td>
                                    <td>3 items</td>
                                    <td>$245.00</td>
                                    <td>$24.50</td>
                                    <td>$220.50</td>
                                    <td><span class="badge bg-light-warning text-dark-warning">Pending</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Order</a></li>
                                                <li><a class="dropdown-item" href="#">View Invoice</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-inherit">#FC0030</a></td>
                                    <td>Nov 10, 2023</td>
                                    <td>David Wilson</td>
                                    <td>2 items</td>
                                    <td>$115.00</td>
                                    <td>$11.50</td>
                                    <td>$103.50</td>
                                    <td><span class="badge bg-light-success text-dark-success">Available</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">View Order</a></li>
                                                <li><a class="dropdown-item" href="#">View Invoice</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-center">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
