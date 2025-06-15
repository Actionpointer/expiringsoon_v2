@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a href="#">Shops</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Profile</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center gap-2">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-lg avatar-circle">
                            <img class="avatar-img" src="{{asset('backend/images/160x160/img1.jpg')}}" alt="Shop Logo">
                            <span class="avatar-status avatar-lg-status avatar-status-success"></span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h1 class="page-header-title">Fashion Hub</h1>
                        <p class="mb-0">
                            <i class="bi-geo-alt me-1"></i> Lagos, Nigeria · 
                            <span class="badge bg-success">Active</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-white btn-sm">
                        <i class="bi-pencil me-1"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        <i class="bi-slash-circle me-1"></i> Suspend Shop
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Card with Tabs -->
    <div class="card">
        <!-- Nav -->
        <div class="card-header border-bottom">
            <ul class="nav nav-tabs card-nav card-nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#basic" data-bs-toggle="tab">
                        <i class="bi-shop me-1"></i> Shop Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#products" data-bs-toggle="tab">
                        <i class="bi-box me-1"></i> Products
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">156</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#orders" data-bs-toggle="tab">
                        <i class="bi-cart me-1"></i> Orders
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">45</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reviews" data-bs-toggle="tab">
                        <i class="bi-star me-1"></i> Reviews
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">245</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#analytics" data-bs-toggle="tab">
                        <i class="bi-graph-up me-1"></i> Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#payouts" data-bs-toggle="tab">
                        <i class="bi-wallet2 me-1"></i> Payouts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#activity" data-bs-toggle="tab">
                        <i class="bi-clock-history me-1"></i> Activity
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Shop Information Tab -->
            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Shop Details -->
                            <div class="mb-4">
                                <h4 class="mb-3">Shop Details</h4>
                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Shop Name</label>
                                        <div class="form-text">Fashion Hub</div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Category</label>
                                        <div class="form-text">Fashion & Apparel</div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Contact Email</label>
                                        <div class="form-text">contact@fashionhub.com</div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Contact Phone</label>
                                        <div class="form-text">+234 812 345 6789</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Shop Owner -->
                            <div class="mb-4">
                                <h4 class="mb-3">Shop Owner</h4>
                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Owner Name</label>
                                        <div class="form-text">Sarah Johnson</div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Owner Email</label>
                                        <div class="form-text">sarah@fashionhub.com</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Business Address -->
                            <div class="mb-4">
                                <h4 class="mb-3">Business Address</h4>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="form-text">
                                            123 Fashion Street<br>
                                            Lekki Phase 1<br>
                                            Lagos, Nigeria
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Shop Summary -->
                            <div class="card card-bordered shadow-none">
                                <div class="card-header">
                                    <h5 class="card-header-title">Shop Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush list-group-no-gutters">
                                        <li class="list-group-item">
                                            <h5 class="card-title">Member Since</h5>
                                            <div class="form-text">Mar 15, 2024</div>
                                        </li>
                                        <li class="list-group-item">
                                            <h5 class="card-title">Rating</h5>
                                            <div class="d-flex align-items-center">
                                                <span class="h4 mb-0 me-2">4.8</span>
                                                <div class="text-warning">
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-fill"></i>
                                                    <i class="bi-star-half"></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h5 class="card-title">Total Sales</h5>
                                            <div class="form-text">₦12.5M</div>
                                        </li>
                                        <li class="list-group-item">
                                            <h5 class="card-title">Fulfillment Rate</h5>
                                            <div class="form-text">95%</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Tab -->
            <div class="tab-pane fade" id="products" role="tabpanel">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Products (156)</h4>
                        <div class="btn-group">
                                        <button type="button" class="btn btn-white btn-sm">
                                <i class="bi-download me-1"></i> Export List
                                        </button>
                    </div>
                </div>

                    <!-- Product Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Active Products</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">132</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success">84%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Out of Stock</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">24</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-danger">16%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Reported Items</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">3</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning">New</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Pending Review</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">5</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-primary">Action needed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="avatar avatar-lg" src="{{asset('backend/images/400x400/img1.jpg')}}" alt="Product">
                                            <div class="ms-3">
                                                <h5 class="mb-0">Designer T-Shirt</h5>
                                                <small class="text-muted">SKU: TSH-001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Clothing</td>
                                    <td>45</td>
                                    <td>₦5,999</td>
                                    <td>234 units</td>
                                    <td><span class="badge bg-soft-success">Active</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Details">
                                                <i class="bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Remove Listing">
                                                <i class="bi-x-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                                </div>

            <!-- Orders Tab -->
            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Orders</h4>
                        <button type="button" class="btn btn-white btn-sm">
                            <i class="bi-download me-1"></i> Export Orders
                        </button>
            </div>

                    <!-- Order Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Total Orders</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">1,234</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success">
                                                <i class="bi-graph-up"></i> 12%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Pending</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">12</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-warning">Action needed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Cancelled</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">23</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-danger">1.8%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Disputed</h6>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-danger">Urgent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>

                    <!-- Orders Table -->
                        <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Products</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td><a href="#">#ORD-1234</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-circle">
                                                <img class="avatar-img" src="{{asset('backend/images/160x160/img1.jpg')}}" alt="Customer">
                        </div>
                                            <div class="ms-3">
                                                <span class="d-block h5 mb-0">John Doe</span>
                                                <span class="d-block fs-6 text-body">john@example.com</span>
                    </div>
                        </div>
                                    </td>
                                    <td>3 items</td>
                                    <td>₦25,000</td>
                                    <td>Mar 15, 2024</td>
                                    <td><span class="badge bg-soft-success">Completed</span></td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm">
                                            <i class="bi-eye"></i>
                                        </button>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Customer Reviews</h4>
                        <div class="btn-group">
                            <button type="button" class="btn btn-white btn-sm">
                                <i class="bi-flag"></i> View Reported
                            </button>
                        </div>
                    </div>

                    <!-- Review Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <div class="card card-bordered h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-subtitle mb-2">Overall Rating</h6>
                                    <div class="display-2 text-dark mb-2">4.8</div>
                                    <div class="d-flex justify-content-center text-warning mb-2">
                                        <i class="bi-star-fill mx-1"></i>
                                        <i class="bi-star-fill mx-1"></i>
                                        <i class="bi-star-fill mx-1"></i>
                                        <i class="bi-star-fill mx-1"></i>
                                        <i class="bi-star-half mx-1"></i>
                                    </div>
                                    <span>Based on 245 reviews</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3">Rating Breakdown</h6>
                                    <!-- 5 stars -->
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-3" style="min-width: 50px;">5 stars</span>
                                        <div class="progress flex-grow-1 me-3" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                        <span>180</span>
                                    </div>
                                    <!-- Continue for 4,3,2,1 stars -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Reviews List -->
                    <div class="card card-bordered">
                                <div class="card-body">
                            <!-- Review Item -->
                            <div class="mb-4 pb-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img" src="{{asset('backend/images/160x160/img1.jpg')}}" alt="Customer">
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="mb-0">John Doe</h5>
                                            <div class="d-flex text-warning mb-1">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                    </div>
                                            <span class="small text-muted">2 days ago</span>
                                </div>
                            </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" data-bs-toggle="dropdown">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="bi-trash dropdown-item-icon"></i> Remove Review
                                            </a>
                        </div>
                                    </div>
                                </div>
                                <p class="mb-0">Great quality products and fast shipping! Very satisfied with my purchase.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            <!-- Analytics Tab -->
            <div class="tab-pane fade" id="analytics" role="tabpanel">
                <div class="card-body">
                    <!-- Revenue Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card card-bordered shadow-none h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Monthly Revenue</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">₦2.8M</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success">
                                                <i class="bi-graph-up"></i> 8.3%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card card-bordered shadow-none h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Average Order Value</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">₦15K</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success">
                                                <i class="bi-graph-up"></i> 2.1%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card card-bordered shadow-none h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Customer Returns</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">2.4%</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success">
                                                <i class="bi-graph-down"></i> -0.8%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                            <div class="card card-bordered shadow-none h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Conversion Rate</h6>
                                    <div class="row align-items-center gx-2">
                                        <div class="col">
                                            <span class="display-4 text-dark">3.8%</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-soft-success">
                                                <i class="bi-graph-up"></i> 1.2%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Metrics -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-header-title">Performance Metrics</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="me-3">Order Fulfillment</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 95%"></div>
                                        </div>
                                        <span class="ms-3">95%</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="me-3">On-time Delivery</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 92%"></div>
                                        </div>
                                        <span class="ms-3">92%</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="me-3">Customer Satisfaction</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 88%"></div>
                                        </div>
                                        <span class="ms-3">88%</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <span class="me-3">Product Quality</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 90%"></div>
                                        </div>
                                        <span class="ms-3">90%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payouts Tab -->
            <div class="tab-pane fade" id="payouts" role="tabpanel">
                                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Payout History</h4>
                        <button type="button" class="btn btn-white btn-sm">
                            <i class="bi-download me-1"></i> Export History
                        </button>
                        </div>

                    <!-- Payout Stats -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-bordered h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2">Available Balance</h6>
                                    <span class="display-4 text-dark">₦458K</span>
                                    </div>
                                </div>
                            </div>
                        <!-- Add more payout stats -->
                    </div>

                    <!-- Payout History Table -->
                        <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                        <th>Status</th>
                                    <th>Date</th>
                                    <th>Bank Account</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td><a href="#">#PAY-1234</a></td>
                                    <td>₦245,000</td>
                                    <td><span class="badge bg-soft-success">Completed</span></td>
                                    <td>Mar 15, 2024</td>
                                    <td>GTBank ****1234</td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm">
                                            <i class="bi-file-text"></i>
                                        </button>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <!-- Activity Tab -->
            <div class="tab-pane fade" id="activity" role="tabpanel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <ul class="step step-icon-xs mb-0">
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <small class="step-divider">Today</small>
                                    </div>
                                </li>
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-primary">
                                            <i class="bi-box"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Added new product</h5>
                                            <p class="fs-6 mb-0">Designer T-Shirt</p>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-success">
                                            <i class="bi-check-circle"></i>
                                        </span>
                                        <div class="step-content">
                                            <h5>Order fulfilled</h5>
                                            <p class="fs-6 mb-0">Order #ORD-1234</p>
                                            <small class="text-muted">5 hours ago</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <!-- Activity Filters -->
                            <div class="card card-bordered shadow-none">
                        <div class="card-header">
                                    <h5 class="card-header-title">Filters</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Activity Type</label>
                                            <select class="form-select form-select-sm">
                                                <option value="">All Activities</option>
                                                <option value="product">Products</option>
                                                <option value="order">Orders</option>
                                                <option value="payout">Payouts</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Date Range</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Select date range">
                                    </div>
                                        <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 