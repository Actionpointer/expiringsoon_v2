@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Suspended Users</h1>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Suspended</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">127</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-danger text-danger">
                        Active Suspensions
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Temporary Suspensions</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">89</span>
                        </div>
                    </div>
                    <span class="text-warning">
                        <i class="bi-clock"></i> Time-limited
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Permanent Suspensions</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">38</span>
                        </div>
                    </div>
                    <span class="text-danger">
                        Indefinite Ban
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Recent Suspensions</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">12</span>
                        </div>
                    </div>
                    <span class="text-body">
                        Last 24 hours
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Suspended Users Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <h4 class="card-header-title">Suspended Users List</h4>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Types</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="permanent">Permanent</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Reasons</option>
                                    <option value="security">Security Violation</option>
                                    <option value="spam">Spam Activity</option>
                                    <option value="tos">TOS Violation</option>
                                    <option value="payment">Payment Issue</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>User</th>
                        <th>Suspension Type</th>
                        <th>Reason</th>
                        <th>Suspended By</th>
                        <th>Suspended Date</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="{{asset('images/160x160/img10.jpg')}}" alt="Image Description">
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">Amanda Harvey</span>
                                    <span class="d-block fs-5 text-body">amanda@site.com</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-soft-warning">Temporary</span></td>
                        <td>Multiple failed login attempts</td>
                        <td>System</td>
                        <td>Mar 15, 2024</td>
                        <td>Mar 22, 2024</td>
                        <td><span class="badge bg-warning">7 days remaining</span></td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewSuspensionModal">
                                <i class="bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="bi-check-circle"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-soft-danger avatar-circle">
                                    <span class="avatar-initials">JW</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">John Wilson</span>
                                    <span class="d-block fs-5 text-body">john@site.com</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-soft-danger">Permanent</span></td>
                        <td>Terms of Service violation</td>
                        <td>Admin</td>
                        <td>Mar 10, 2024</td>
                        <td>Never</td>
                        <td><span class="badge bg-danger">Permanent</span></td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewSuspensionModal">
                                <i class="bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="bi-check-circle"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Showing:</span>
                        <div class="tom-select-custom">
                            <select class="js-select form-select form-select-borderless w-auto" autocomplete="off">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>127</span>
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
    </div>
</div>

<!-- View Suspension Details Modal -->
<div class="modal fade" id="viewSuspensionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suspension Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6>User Information</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Name:</dt>
                        <dd class="col-sm-8">Amanda Harvey</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">amanda@site.com</dd>

                        <dt class="col-sm-4">Account Type:</dt>
                        <dd class="col-sm-8">Individual</dd>
                    </dl>
                </div>

                <div class="mb-4">
                    <h6>Suspension Details</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Type:</dt>
                        <dd class="col-sm-8"><span class="badge bg-soft-warning">Temporary</span></dd>

                        <dt class="col-sm-4">Reason:</dt>
                        <dd class="col-sm-8">Multiple failed login attempts</dd>

                        <dt class="col-sm-4">Start Date:</dt>
                        <dd class="col-sm-8">Mar 15, 2024 14:23:45</dd>

                        <dt class="col-sm-4">End Date:</dt>
                        <dd class="col-sm-8">Mar 22, 2024 14:23:45</dd>
                    </dl>
                </div>

                <div>
                    <h6>Additional Notes</h6>
                    <p class="small text-body mb-0">
                        Account automatically suspended after 5 failed login attempts within 10 minutes. 
                        IP address has been temporarily blocked.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Lift Suspension</button>
            </div>
        </div>
    </div>
</div>

@endsection 