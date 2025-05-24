@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">IP Blacklist Management</h1>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIpModal">
                    <i class="bi-plus me-1"></i> Add IP Address
                </button>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Blocked IPs</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">234</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-danger text-danger">
                        Active Blocks
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Blocked Attempts</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1.2K</span>
                        </div>
                    </div>
                    <span class="text-danger">
                        <i class="bi-graph-up"></i> Last 24 hours
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Temporary Blocks</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">45</span>
                        </div>
                    </div>
                    <span class="text-warning">
                        Expires in 24h
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Countries Blocked</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">12</span>
                        </div>
                    </div>
                    <span class="text-body">
                        High-risk regions
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- IP Blacklist Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <h4 class="card-header-title">Blocked IP Addresses</h4>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Types</option>
                                    <option value="manual">Manual Block</option>
                                    <option value="auto">Auto Block</option>
                                    <option value="temporary">Temporary Block</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Regions</option>
                                    <option value="na">North America</option>
                                    <option value="eu">Europe</option>
                                    <option value="as">Asia</option>
                                    <option value="af">Africa</option>
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
                        <th>IP Address</th>
                        <th>Location</th>
                        <th>Reason</th>
                        <th>Block Type</th>
                        <th>Added Date</th>
                        <th>Expiry</th>
                        <th>Attempts</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>192.168.1.1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-xss avatar-circle me-2" 
                                     src="{{asset('vendor/flag-icon-css/flags/1x1/us.svg')}}" 
                                     alt="US Flag">
                                United States
                            </div>
                        </td>
                        <td>Multiple failed login attempts</td>
                        <td><span class="badge bg-soft-warning">Temporary</span></td>
                        <td>Mar 15, 2024</td>
                        <td>24 hours</td>
                        <td>25</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewIpDetailsModal">
                                <i class="bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-white btn-sm">
                                <i class="bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>10.0.0.1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-xss avatar-circle me-2" 
                                     src="{{asset('vendor/flag-icon-css/flags/1x1/cn.svg')}}" 
                                     alt="CN Flag">
                                China
                            </div>
                        </td>
                        <td>Suspicious API requests</td>
                        <td><span class="badge bg-soft-danger">Permanent</span></td>
                        <td>Mar 14, 2024</td>
                        <td>Never</td>
                        <td>150</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewIpDetailsModal">
                                <i class="bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-white btn-sm">
                                <i class="bi-trash"></i>
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
                        <span>234</span>
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

<!-- Add IP Modal -->
<div class="modal fade" id="addIpModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add IP to Blacklist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">IP Address</label>
                        <input type="text" class="form-control" placeholder="Enter IP address">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Block Type</label>
                        <select class="form-select">
                            <option value="temporary">Temporary (24 hours)</option>
                            <option value="permanent">Permanent</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason</label>
                        <textarea class="form-control" rows="3" placeholder="Enter reason for blocking"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add to Blacklist</button>
            </div>
        </div>
    </div>
</div>

<!-- View IP Details Modal -->
<div class="modal fade" id="viewIpDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IP Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6>Basic Information</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">IP Address:</dt>
                        <dd class="col-sm-8">192.168.1.1</dd>

                        <dt class="col-sm-4">Location:</dt>
                        <dd class="col-sm-8">United States (US)</dd>

                        <dt class="col-sm-4">ISP:</dt>
                        <dd class="col-sm-8">Comcast Cable Communications</dd>
                    </dl>
                </div>

                <div class="mb-4">
                    <h6>Block Details</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Block Type:</dt>
                        <dd class="col-sm-8"><span class="badge bg-soft-warning">Temporary</span></dd>

                        <dt class="col-sm-4">Added Date:</dt>
                        <dd class="col-sm-8">Mar 15, 2024 14:23:45</dd>

                        <dt class="col-sm-4">Expires:</dt>
                        <dd class="col-sm-8">Mar 16, 2024 14:23:45</dd>

                        <dt class="col-sm-4">Added By:</dt>
                        <dd class="col-sm-8">System (Automatic)</dd>
                    </dl>
                </div>

                <div>
                    <h6>Activity History</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1">Failed Login Attempt</h5>
                                    <p class="text-body small mb-0">Mar 15, 2024 14:20:12</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1">Failed Login Attempt</h5>
                                    <p class="text-body small mb-0">Mar 15, 2024 14:19:45</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Remove from Blacklist</button>
            </div>
        </div>
    </div>
</div>

@endsection 