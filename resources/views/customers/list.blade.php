@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h1 class="page-header-title">Consumers <span class="badge bg-soft-dark text-dark ms-2">2,458</span></h1>
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
                        <div class="col-sm-6 col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="Search consumers...">
                        </div>
                        <div class="col-sm-6 col-md-2 mb-3">
                            <select class="form-select">
                                <option value="">Type</option>
                                <option value="individual">Individual</option>
                                <option value="corporate">Corporate</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-2 mb-3">
                            <select class="form-select">
                                <option value="">Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
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
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Orders</th>
                        <th>Status</th>
                        <th>Activity</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="min-width: 200px;">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="{{asset('images/160x160/img1.jpg')}}" alt="Profile Image">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                                <div class="ms-3">
                                    <a href="#" class="d-block h5 mb-0">John Smith</a>
                                    <span class="d-block fs-6 text-body">john.smith@example.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-body">
                                <i class="bi-phone me-1"></i> +234 812 345 6789
                                <div class="small text-muted mt-1">
                                    <i class="bi-geo-alt me-1"></i> Lagos, Nigeria
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fs-6">24 Orders</span>
                                <span class="badge bg-soft-success ms-2">₦245,000</span>
                            </div>
                            <span class="small text-muted">Last order 2 days ago</span>
                        </td>
                        <td>
                            <span class="badge bg-soft-success">Active</span>
                            <div class="small text-muted mt-1">Since Mar 15, 2024</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi-clock-history text-muted me-1"></i>
                                <span>2 hours ago</span>
                            </div>
                            <span class="small text-muted">Made a purchase</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Profile">
                                    <i class="bi-person-lines-fill"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Orders">
                                    <i class="bi-cart"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Deactivate">
                                    <i class="bi-slash-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="min-width: 200px;">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">AC</span>
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                                <div class="ms-3">
                                    <a href="#" class="d-block h5 mb-0">ABC Corporation</a>
                                    <span class="d-block fs-6 text-body">contact@abccorp.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-body">
                                <i class="bi-phone me-1"></i> +234 802 123 4567
                                <div class="small text-muted mt-1">
                                    <i class="bi-geo-alt me-1"></i> Abuja, Nigeria
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fs-6">156 Orders</span>
                                <span class="badge bg-soft-success ms-2">₦2.4M</span>
                            </div>
                            <span class="small text-muted">Last order today</span>
                        </td>
                        <td>
                            <span class="badge bg-soft-success">Active</span>
                            <div class="small text-muted mt-1">Since Mar 10, 2024</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi-clock-history text-muted me-1"></i>
                                <span>1 day ago</span>
                            </div>
                            <span class="small text-muted">Updated profile</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Profile">
                                    <i class="bi-person-lines-fill"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="View Orders">
                                    <i class="bi-cart"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Deactivate">
                                    <i class="bi-slash-circle"></i>
                                </button>
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