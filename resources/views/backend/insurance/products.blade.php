@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Insurance Products</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi-plus me-1"></i> Add Product
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Products</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">24</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Subscriptions</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1,248</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
                                <i class="bi-graph-up"></i> +12%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Average Premium</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">$1.8K</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                Monthly
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Customer Rating</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">4.8</span>
                        </div>
                        <div class="col-auto">
                            <div class="text-warning">
                                <i class="bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0">
                <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" placeholder="Search products..." aria-label="Search products">
                        <div class="input-group-append input-group-text">
                            <i class="bi-search"></i>
                        </div>
                    </div>
                    <!-- End Search -->
                </form>
            </div>

            <div class="d-grid d-sm-flex gap-2">
                <!-- Dropdown -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off">
                        <option value="all">All Categories</option>
                        <option value="auto">Commercial Auto</option>
                        <option value="cargo">Cargo</option>
                        <option value="liability">Liability</option>
                        <option value="fleet">Fleet</option>
                    </select>
                </div>
                <!-- End Dropdown -->

                <!-- Dropdown -->
                <div class="tom-select-custom">
                    <select class="js-select form-select" autocomplete="off">
                        <option value="all">All Providers</option>
                        <option value="safeguard">SafeGuard Insurance</option>
                        <option value="securefleet">SecureFleet Insurance</option>
                        <option value="globalprotect">Global Protect</option>
                    </select>
                </div>
                <!-- End Dropdown -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Provider</th>
                        <th>Base Premium</th>
                        <th>Coverage</th>
                        <th>Active Policies</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img class="avatar avatar-sm" src="../assets/images/160x160/img1.jpg" alt="Product Image">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a class="d-inline-block link-dark" href="#">
                                        <h5 class="mb-0">Premium Fleet Protection</h5>
                                    </a>
                                    <span class="d-block fs-6 text-body">Comprehensive coverage for large fleets</span>
                                </div>
                            </div>
                        </td>
                        <td>Fleet Insurance</td>
                        <td>SafeGuard Insurance</td>
                        <td>$2,400/mo</td>
                        <td>Up to $5M</td>
                        <td>248</td>
                        <td>
                            <span class="badge bg-soft-success text-success">Active</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="productDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="productDropdown1">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Edit Product</a>
                                    <a class="dropdown-item" href="#">View Policies</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Deactivate</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img class="avatar avatar-sm" src="../assets/images/160x160/img2.jpg" alt="Product Image">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a class="d-inline-block link-dark" href="#">
                                        <h5 class="mb-0">Cargo Secure Plus</h5>
                                    </a>
                                    <span class="d-block fs-6 text-body">Enhanced cargo protection</span>
                                </div>
                            </div>
                        </td>
                        <td>Cargo Insurance</td>
                        <td>SecureFleet Insurance</td>
                        <td>$1,800/mo</td>
                        <td>Up to $2M</td>
                        <td>186</td>
                        <td>
                            <span class="badge bg-soft-success text-success">Active</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="productDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="productDropdown2">
                                    <a class="dropdown-item" href="#">View Details</a>
                                    <a class="dropdown-item" href="#">Edit Product</a>
                                    <a class="dropdown-item" href="#">View Policies</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Deactivate</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Showing:</span>
                        <div class="tom-select-custom">
                            <select class="js-select form-select form-select-borderless w-auto" autocomplete="off">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50" selected>50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>24</span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <nav id="datatablePagination" aria-label="Activity pagination">
                            <div class="pagination pagination-sm">
                                <span class="page-item disabled">
                                    <span class="page-link">Prev</span>
                                </span>
                                <span class="page-item active"><span class="page-link">1</span></span>
                                <span class="page-item"><span class="page-link">2</span></span>
                                <span class="page-item"><span class="page-link">3</span></span>
                                <span class="page-item"><span class="page-link">Next</span></span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer -->
    </div>
</div>
@endsection 