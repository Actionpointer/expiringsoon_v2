@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a href="#">Customers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer Profile</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center gap-2">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-lg avatar-circle">
                            <img class="avatar-img" src="{{asset('backend/images/160x160/img1.jpg')}}" alt="Profile Image">
                            <span class="avatar-status avatar-lg-status avatar-status-success"></span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h1 class="page-header-title">John Smith</h1>
                        <p class="mb-0">john.smith@example.com · <span class="badge bg-success">Active</span></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-white btn-sm">
                        <i class="bi-pencil me-1"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        <i class="bi-slash-circle me-1"></i> Deactivate Account
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
                        <i class="bi-person me-1"></i> Basic Information
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#orders" data-bs-toggle="tab">
                        <i class="bi-cart me-1"></i> Orders
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">24</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#wishlist" data-bs-toggle="tab">
                        <i class="bi-heart me-1"></i> Wishlist
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reviews" data-bs-toggle="tab">
                        <i class="bi-star me-1"></i> Reviews
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
            <!-- Basic Information Tab -->
            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Personal Details -->
                            <div class="mb-4">
                                <h4 class="mb-3">Personal Details</h4>
                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Full Name</label>
                                        <div class="form-text">John Smith</div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Email</label>
                                        <div class="form-text">john.smith@example.com</div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label">Phone Number</label>
                                        <div class="form-text">+234 812 345 6789</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="mb-4">
                                <h4 class="mb-3">Default Shipping Address</h4>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="form-text">
                                            123 Main Street<br>
                                            Lekki Phase 1<br>
                                            Lagos, Nigeria
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Account Summary -->
                            <div class="card card-bordered shadow-none">
                                <div class="card-header">
                                    <h5 class="card-header-title">Account Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush list-group-no-gutters">
                                        <li class="list-group-item">
                                            <h5 class="card-title">Member Since</h5>
                                            <div class="form-text">Mar 1, 2024</div>
                                        </li>
                                        <li class="list-group-item">
                                            <h5 class="card-title">Total Orders</h5>
                                            <div class="form-text">24 orders</div>
                                        </li>
                                        <li class="list-group-item">
                                            <h5 class="card-title">Total Spent</h5>
                                            <div class="form-text">₦245,000</div>
                                        </li>
                                        <li class="list-group-item">
                                            <h5 class="card-title">Average Order Value</h5>
                                            <div class="form-text">₦10,208</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Tab -->
            <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Order History</h4>
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="bi-download me-1"></i> Export Orders
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#">#ORD-1234</a></td>
                                    <td>Mar 15, 2024</td>
                                    <td>Fashion Hub</td>
                                    <td>3 items</td>
                                    <td>₦25,000</td>
                                    <td><span class="badge bg-soft-success text-success">Completed</span></td>
                                    <td><a href="#" class="btn btn-white btn-sm">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Wishlist Tab -->
            <div class="tab-pane fade" id="wishlist" role="tabpanel">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 mb-3">
                        <!-- Wishlist Item -->
                        <div class="col mb-3">
                            <div class="card card-bordered h-100">
                                <img class="card-img-top" src="{{asset('backend/images/400x400/img1.jpg')}}" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">Product Name</h5>
                                    <p class="card-text text-success">₦15,000</p>
                                    <small class="text-muted">Added 2 days ago</small>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="card card-bordered shadow-none">
                                <div class="card-body text-center">
                                    <h6>Average Rating</h6>
                                    <span class="display-4">4.5</span>
                                    <div class="mb-3">
                                        <i class="bi-star-fill text-warning"></i>
                                        <i class="bi-star-fill text-warning"></i>
                                        <i class="bi-star-fill text-warning"></i>
                                        <i class="bi-star-fill text-warning"></i>
                                        <i class="bi-star-half text-warning"></i>
                                    </div>
                                    <span>Based on 12 reviews</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!-- Review Item -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <img class="avatar avatar-circle" src="{{asset('backend/images/160x160/img1.jpg')}}" alt="Product Image">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Product Name</h5>
                                        <div class="d-flex gap-1 mb-1">
                                            <i class="bi-star-fill text-warning"></i>
                                            <i class="bi-star-fill text-warning"></i>
                                            <i class="bi-star-fill text-warning"></i>
                                            <i class="bi-star-fill text-warning"></i>
                                            <i class="bi-star text-warning"></i>
                                </div>
                                        <span class="small text-muted">Reviewed on Mar 15, 2024</span>
                            </div>
                                </div>
                                <p>Great product, fast delivery!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline Tab -->
            <div class="tab-pane fade" id="activity" role="tabpanel">
                <div class="card-body">
                            <ul class="step step-icon-xs mb-0">
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <small class="step-divider">Today</small>
                                    </div>
                                </li>
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                        <span class="step-icon step-icon-soft-primary">
                                            <i class="bi-cart"></i>
                                        </span>
                                        <div class="step-content">
                                    <h5>Placed order #ORD-1234</h5>
                                    <p class="fs-6 mb-0">3 items · ₦25,000</p>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="step-item">
                                    <div class="step-content-wrapper">
                                <span class="step-icon step-icon-soft-info">
                                    <i class="bi-heart"></i>
                                        </span>
                                        <div class="step-content">
                                    <h5>Added item to wishlist</h5>
                                    <p class="fs-6 mb-0">Product Name</p>
                                            <small class="text-muted">5 hours ago</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 