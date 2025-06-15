@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h1 class="page-header-title">Stores <span class="badge bg-soft-dark text-dark ms-2">584</span></h1>
            </div>
            <div class="col-auto">
                <!-- Dropdown -->
                <div class="dropdown me-2">
                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-download me-1"></i> Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                        <li><a class="dropdown-item" href="#">Excel</a></li>
                        <li><a class="dropdown-item" href="#">CSV</a></li>
                        <li><a class="dropdown-item" href="#">PDF</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Filter Form -->
        <div class="row">
            <div class="col-lg-12">
                <form>
                    <div class="row gx-3">
                        <div class="col-sm-6 col-md-3 mb-3">
                            <input type="text" class="form-control" placeholder="Search stores...">
                        </div>
                        <div class="col-sm-6 col-md-2 mb-3">
                            <select class="form-select">
                                <option value="">Category</option>
                                <option value="fashion">Fashion</option>
                                <option value="electronics">Electronics</option>
                                <option value="food">Food & Beverages</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-2 mb-3">
                            <select class="form-select">
                                <option value="">Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-2 mb-3">
                            <button type="button" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Store</th>
                        <th>Owner</th>
                        <th>Performance</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="min-width: 200px;">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg avatar-circle">
                                    <img class="avatar-img" src="{{asset('backend/images/160x160/img1.jpg')}}" alt="Store Logo">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                                <div class="ms-3">
                                    <a href="#" class="d-block h5 mb-0">Fashion Hub</a>
                                    <span class="d-block fs-6 text-body">
                                        <i class="bi-geo-alt me-1"></i> Lagos, Nigeria
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-body">
                                <div>Sarah Johnson</div>
                                <small class="text-muted">sarah@fashionhub.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <div class="mb-1">
                                    <span class="badge bg-soft-success me-2">4.8 <i class="bi-star-fill ms-1"></i></span>
                                    <span class="text-body">(245 reviews)</span>
                                </div>
                                <small class="text-success">
                                    <i class="bi-graph-up"></i> 95% fulfillment rate
                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>156 Products</span>
                                <small class="text-muted">24 out of stock</small>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-success">Active</span>
                            <div class="small text-muted mt-1">Since Mar 15, 2024</div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Products">
                                    <i class="bi-box"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Suspend">
                                    <i class="bi-slash-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="min-width: 200px;">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">TE</span>
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                                <div class="ms-3">
                                    <a href="#" class="d-block h5 mb-0">Tech Empire</a>
                                    <span class="d-block fs-6 text-body">
                                        <i class="bi-geo-alt me-1"></i> Abuja, Nigeria
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-body">
                                <div>Michael Chen</div>
                                <small class="text-muted">mike@techempire.com</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <div class="mb-1">
                                    <span class="badge bg-soft-success me-2">4.6 <i class="bi-star-fill ms-1"></i></span>
                                    <span class="text-body">(189 reviews)</span>
                                </div>
                                <small class="text-success">
                                    <i class="bi-graph-up"></i> 92% fulfillment rate
                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>234 Products</span>
                                <small class="text-muted">12 out of stock</small>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-success">Active</span>
                            <div class="small text-muted mt-1">Since Feb 28, 2024</div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Products">
                                    <i class="bi-box"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Suspend">
                                    <i class="bi-slash-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="card-footer">
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Showing:</span>
                        <select class="form-select form-select-sm" style="width: 5rem;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <nav id="datatablePagination" aria-label="Activity pagination">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
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
</div>
@endsection 