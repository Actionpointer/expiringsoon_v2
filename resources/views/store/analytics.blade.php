@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Store Analytics</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                        </ol>
                    </nav>
                </div>
                <!-- time period selector -->
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
    </div>

    <!-- Key Metrics Cards Row -->
    <div class="row mb-6">
        <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-4">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0">$8,450</h4>
                            <p class="mb-0 fs-6">Total Revenue</p>
                            <span class="fs-6 text-success"><i class="bi bi-arrow-up"></i> 24.5%</span> <span class="fs-6 text-muted">vs. previous period</span>
                        </div>
                        <div class="icon-shape icon-xl bg-light-primary text-primary rounded-3">
                            <i class="bi bi-graph-up-arrow fs-3"></i>
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
                            <h4 class="mb-0">347</h4>
                            <p class="mb-0 fs-6">Total Orders</p>
                            <span class="fs-6 text-success"><i class="bi bi-arrow-up"></i> 8.2%</span> <span class="fs-6 text-muted">vs. previous period</span>
                        </div>
                        <div class="icon-shape icon-xl bg-light-success text-success rounded-3">
                            <i class="bi bi-cart-check fs-3"></i>
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
                            <h4 class="mb-0">$45.82</h4>
                            <p class="mb-0 fs-6">Average Order Value</p>
                            <span class="fs-6 text-success"><i class="bi bi-arrow-up"></i> 5.3%</span> <span class="fs-6 text-muted">vs. previous period</span>
                        </div>
                        <div class="icon-shape icon-xl bg-light-warning text-warning rounded-3">
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
                            <h4 class="mb-0">128</h4>
                            <p class="mb-0 fs-6">New Customers</p>
                            <span class="fs-6 text-danger"><i class="bi bi-arrow-down"></i> 3.6%</span> <span class="fs-6 text-muted">vs. previous period</span>
                        </div>
                        <div class="icon-shape icon-xl bg-light-info text-info rounded-3">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue & Orders Chart Row -->
    <div class="row mb-6">
        <div class="col-xl-8 col-lg-8 col-md-12 col-12 mb-6 mb-xl-0">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Revenue & Orders</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <!-- chart -->
                    <div id="revenueOrdersChart" class="chart-height-md" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-12">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Sales by Category</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div id="salesByCategoryChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer & Performance Metrics Row -->
    <div class="row mb-6">
        <div class="col-xl-4 col-lg-4 col-12 mb-6 mb-xl-0">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Customer Acquisition</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div id="customerAcquisitionChart" style="height: 250px;"></div>

                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <span class="d-inline-block bg-primary rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span>New Customers (65%)</span>
                            </div>
                            <div>
                                <span>128</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="d-inline-block bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span>Returning Customers (35%)</span>
                            </div>
                            <div>
                                <span>67</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-12 mb-6 mb-xl-0">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Conversion Rates</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Store Visits to Purchase</h5>
                            <span class="fs-6 text-success">3.5%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 3.5%;" aria-valuenow="3.5" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Product Views to Purchase</h5>
                            <span class="fs-6 text-primary">12.8%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 12.8%;" aria-valuenow="12.8" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Cart to Checkout</h5>
                            <span class="fs-6 text-info">68.3%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 68.3%;" aria-valuenow="68.3" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Cart Abandonment Rate</h5>
                            <span class="fs-6 text-danger">31.7%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 31.7%;" aria-valuenow="31.7" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-12">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Operational Performance</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Order Fulfillment Time</h5>
                            <span class="badge bg-success">1.2 days</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted fs-7">Target: 2 days</small>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">On-time Shipping Rate</h5>
                            <span class="badge bg-success">96.5%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 96.5%;" aria-valuenow="96.5" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted fs-7">Target: 95%</small>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Return Rate</h5>
                            <span class="badge bg-warning">3.2%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 32%;" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted fs-7">Target: < 5%</small>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 fs-6 fw-normal">Customer Satisfaction</h5>
                            <span class="badge bg-primary">4.8/5</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 96%;" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted fs-7">Based on 231 reviews</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products & Inventory Row -->
    <div class="row mb-6">
        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6 mb-xl-0">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Top Selling Products</h4>
                        <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
                    </div>
                </div>
                <!-- card body -->
                <div class="card-body p-0">
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fs-6 fw-normal">Product</th>
                                    <th class="fs-6 fw-normal">Sold</th>
                                    <th class="fs-6 fw-normal">Revenue</th>
                                    <th class="fs-6 fw-normal">Conversion</th>
                                    <th class="fs-6 fw-normal">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">Haldiram's Sev Bhujia</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">120 units</td>
                                    <td class="fs-6 fw-normal">$2,160.00</td>
                                    <td class="fs-6 fw-normal">18.6%</td>
                                    <td><span class="badge bg-light-success text-dark-success">In Stock</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-2.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">NutriChoice Digestive</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">95 units</td>
                                    <td class="fs-6 fw-normal">$1,710.00</td>
                                    <td class="fs-6 fw-normal">15.2%</td>
                                    <td><span class="badge bg-light-success text-dark-success">In Stock</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-3.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">Cadbury 5 Star Chocolate</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">82 units</td>
                                    <td class="fs-6 fw-normal">$1,476.00</td>
                                    <td class="fs-6 fw-normal">13.5%</td>
                                    <td><span class="badge bg-light-warning text-dark-warning">Low Stock</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-4.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">Onion Flavour Potato</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">75 units</td>
                                    <td class="fs-6 fw-normal">$1,350.00</td>
                                    <td class="fs-6 fw-normal">12.3%</td>
                                    <td><span class="badge bg-light-danger text-dark-danger">Out of Stock</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Inventory Status</h4>
                        <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
                    </div>
                </div>
                <!-- card body -->
                <div class="card-body p-0">
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fs-6 fw-normal">Product</th>
                                    <th class="fs-6 fw-normal">Current Stock</th>
                                    <th class="fs-6 fw-normal">Turnover Rate</th>
                                    <th class="fs-6 fw-normal">Status</th>
                                    <th class="fs-6 fw-normal">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-1.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">Haldiram's Sev Bhujia</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">250 units</td>
                                    <td class="fs-6 fw-normal">High</td>
                                    <td><span class="badge bg-light-success text-dark-success">In Stock</span></td>
                                    <td>
                                        <a href="#" class="btn btn-outline-secondary btn-sm">Reorder</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-2.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">NutriChoice Digestive</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">180 units</td>
                                    <td class="fs-6 fw-normal">Medium</td>
                                    <td><span class="badge bg-light-success text-dark-success">In Stock</span></td>
                                    <td>
                                        <a href="#" class="btn btn-outline-secondary btn-sm">Reorder</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-3.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">Cadbury 5 Star Chocolate</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">15 units</td>
                                    <td class="fs-6 fw-normal">High</td>
                                    <td><span class="badge bg-light-warning text-dark-warning">Low Stock</span></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Reorder Now</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('frontend/images/products/product-img-4.jpg')}}" alt="" class="icon-shape icon-lg me-3">
                                            <h5 class="mb-0 fs-6 fw-normal">Onion Flavour Potato</h5>
                                        </div>
                                    </td>
                                    <td class="fs-6 fw-normal">0 units</td>
                                    <td class="fs-6 fw-normal">High</td>
                                    <td><span class="badge bg-light-danger text-dark-danger">Out of Stock</span></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm">Reorder Now</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Traffic Sources & Monthly Sales Forecast Row -->
    <div class="row mb-8">
        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6 mb-xl-0">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Traffic Sources</h4>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div id="trafficSourcesChart" style="height: 250px;"></div>

                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <span class="d-inline-block bg-primary rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span>Direct (28%)</span>
                            </div>
                            <div>
                                <span>1,452 sessions</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <span class="d-inline-block bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span>Organic Search (35%)</span>
                            </div>
                            <div>
                                <span>1,812 sessions</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <span class="d-inline-block bg-warning rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span>Social Media (22%)</span>
                            </div>
                            <div>
                                <span>1,140 sessions</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="d-inline-block bg-info rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span>Referrals (15%)</span>
                            </div>
                            <div>
                                <span>778 sessions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card header -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Monthly Sales Forecast</h4>
                </div>
                <!-- card body -->
                <div class="card-body p-0">
                    <!-- Sales Forecast Chart -->
                    <div id="salesForecastChart" style="height: 250px; min-height: 250px; width: 100%; overflow: visible;"></div>

                    <div class="mt-4 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="d-inline-block bg-primary rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span class="fs-6">Projected Revenue</span>
                            </div>
                            <div>
                                <span class="text-dark fs-6">$12,250</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="d-inline-block bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span class="fs-6">Projected Orders</span>
                            </div>
                            <div>
                                <span class="text-dark fs-6">450</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-inline-block bg-info rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                                <span class="fs-6">Projected Growth</span>
                            </div>
                            <div>
                                <span class="text-success fs-6">+18.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sample Data for all charts
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const currentMonth = new Date().getMonth();
        const last6Months = months.slice(currentMonth - 5, currentMonth + 1);
        
        // Revenue & Orders Chart (ApexCharts)
        const revenueData = [4200, 3800, 5100, 6200, 7800, 8450];
        const ordersData = [180, 160, 210, 270, 320, 347];
        
        const revenueOrdersOptions = {
            series: [
                {
                    name: 'Revenue ($)',
                    type: 'area',
                    data: revenueData
                },
                {
                    name: 'Orders',
                    type: 'line',
                    data: ordersData
                }
            ],
            chart: {
                height: 300,
                type: 'line',
                toolbar: {
                    show: false
                }
            },
            stroke: {
                curve: 'smooth',
                width: [2, 2]
            },
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.3,
                    opacityTo: 0.1,
                }
            },
            colors: ['#754ffe', '#19cb98'],
            labels: last6Months,
            markers: {
                size: 4,
                strokeWidth: 0,
                hover: {
                    size: 7
                }
            },
            grid: {
                show: true,
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                position: 'back'
            },
            yaxis: [
                {
                    title: {
                        text: 'Revenue ($)'
                    },
                    min: 0
                },
                {
                    opposite: true,
                    title: {
                        text: 'Orders'
                    },
                    min: 0
                }
            ],
            xaxis: {
                labels: {
                    trim: false
                }
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right'
            }
        };
        
        const revenueOrdersChart = new ApexCharts(document.querySelector("#revenueOrdersChart"), revenueOrdersOptions);
        revenueOrdersChart.render();
        
        // Sales by Category Chart (ApexCharts)
        const salesByCategoryOptions = {
            series: [35, 25, 20, 15, 5],
            chart: {
                type: 'donut',
                height: 300
            },
            labels: ['Snacks', 'Beverages', 'Chocolates', 'Biscuits', 'Other'],
            colors: ['#754ffe', '#19cb98', '#ffaa46', '#fd7e14', '#e53f3c'],
            legend: {
                position: 'right'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%'
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        
        const salesByCategoryChart = new ApexCharts(document.querySelector("#salesByCategoryChart"), salesByCategoryOptions);
        salesByCategoryChart.render();
        
        // Customer Acquisition Chart (ApexCharts)
        const customerAcquisitionOptions = {
            series: [65, 35],
            chart: {
                type: 'pie',
                height: 250
            },
            labels: ['New Customers', 'Returning Customers'],
            colors: ['#754ffe', '#19cb98'],
            legend: {
                show: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 250
                    }
                }
            }]
        };
        
        const customerAcquisitionChart = new ApexCharts(document.querySelector("#customerAcquisitionChart"), customerAcquisitionOptions);
        customerAcquisitionChart.render();
        
        // Traffic Sources Chart (ApexCharts)
        const trafficSourcesOptions = {
            series: [{
                name: 'Sessions',
                data: [1452, 1812, 1140, 778]
            }],
            chart: {
                type: 'bar',
                height: 250,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '50%',
                    distributed: true
                }
            },
            colors: ['#754ffe', '#19cb98', '#ffaa46', '#0dcaf0'],
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: ['Direct', 'Organic Search', 'Social Media', 'Referrals'],
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Number of Sessions'
                }
            },
            grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: false
                    }
                }
            }
        };
        
        const trafficSourcesChart = new ApexCharts(document.querySelector("#trafficSourcesChart"), trafficSourcesOptions);
        trafficSourcesChart.render();
        
        // Monthly Sales Forecast Chart (ApexCharts)
        let forecastMonths = [];
        for (let i = 0; i < 6; i++) {
            let forecastMonthIndex = (currentMonth + i) % 12;
            forecastMonths.push(months[forecastMonthIndex]);
        }
        
        const salesForecastOptions = {
            series: [
                {
                    name: 'Actual Sales',
                    data: [8450, null, null, null, null, null]
                },
                {
                    name: 'Forecast',
                    data: [8450, 9200, 10300, 11200, 11900, 12250]
                }
            ],
            chart: {
                type: 'line',
                height: 250,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                },
                background: '#fff',
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
                parentHeightOffset: 0,  // Important: Remove extra padding
                offsetX: 0,
                offsetY: 0
            },
            colors: ['#754ffe', '#19cb98'],
            stroke: {
                width: [3, 3],
                curve: 'smooth',
                dashArray: [0, 5]
            },
            grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                show: true,
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 5
                }
            },
            markers: {
                size: 5,
                strokeWidth: 0,
                hover: {
                    size: 9
                }
            },
            xaxis: {
                categories: forecastMonths,
                labels: {
                    show: true,
                    style: {
                        fontFamily: 'inherit',
                        cssClass: 'text-dark'
                    }
                },
                axisBorder: {
                    show: true
                },
                axisTicks: {
                    show: true
                }
            },
            yaxis: {
                title: {
                    text: 'Revenue ($)',
                    style: {
                        fontFamily: 'inherit'
                    }
                },
                min: 0,
                labels: {
                    show: true
                }
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(value) {
                        return value !== null ? "$" + value.toLocaleString() : "No data";
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                labels: {
                    useSeriesColors: false
                },
                markers: {
                    width: 10,
                    height: 10
                },
                offsetY: 0,
                offsetX: 0
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center'
                    }
                }
            }]
        };
        
        const salesForecastChart = new ApexCharts(document.querySelector("#salesForecastChart"), salesForecastOptions);
        salesForecastChart.render().then(() => {
            console.log('Sales Forecast chart rendered successfully');
        }).catch(err => {
            console.error('Error rendering Sales Forecast chart:', err);
            // Fallback rendering attempt with simpler options
            const fallbackOptions = {
                series: [{
                    name: 'Forecast',
                    data: [8450, 9200, 10300, 11200, 11900, 12250]
                }],
                chart: {
                    type: 'line',
                    height: 250
                },
                colors: ['#19cb98']
            };
            console.log('Attempting fallback render of Sales Forecast chart');
            new ApexCharts(document.querySelector("#salesForecastChart"), fallbackOptions).render();
        });
        
        // Diagnostic check for chart container
        setTimeout(() => {
            const chartContainer = document.querySelector("#salesForecastChart");
            if (chartContainer) {
                console.log('Sales Forecast Chart container:', {
                    width: chartContainer.offsetWidth,
                    height: chartContainer.offsetHeight,
                    visible: chartContainer.offsetParent !== null,
                    childElements: chartContainer.children.length
                });
                
                // If no children, something went wrong with chart rendering
                if (chartContainer.children.length === 0) {
                    console.log('No chart elements created, attempting manual DOM insertion');
                    chartContainer.innerHTML = '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#754ffe;font-weight:bold;">Generating Sales Forecast Chart...</div>';
                    
                    // Force chart recreation with timeout
                    setTimeout(() => {
                        chartContainer.innerHTML = '';
                        new ApexCharts(chartContainer, {
                            series: [{
                                name: 'Forecast',
                                data: [8450, 9200, 10300, 11200, 11900, 12250]
                            }],
                            chart: {
                                type: 'line',
                                height: 250
                            }
                        }).render();
                    }, 500);
                }
            } else {
                console.error('Could not find Sales Forecast chart container!');
            }
        }, 1000);
    });
</script>
@endpush
