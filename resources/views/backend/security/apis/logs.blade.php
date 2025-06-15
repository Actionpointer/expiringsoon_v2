@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">API Request Logs</h1>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" onclick="exportLogs()">
                    <i class="bi-download me-1"></i> Export Logs
                </button>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Requests</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">2.4M</span>
                        </div>
                    </div>
                    <span class="badge bg-soft-primary text-primary">
                        Last 30 days
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Success Rate</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">98.2%</span>
                        </div>
                    </div>
                    <span class="text-success">
                        <i class="bi-graph-up"></i> 1.2% from last week
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Average Response Time</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">245ms</span>
                        </div>
                    </div>
                    <span class="text-danger">
                        <i class="bi-graph-down"></i> 23ms slower than usual
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Error Rate</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1.8%</span>
                        </div>
                    </div>
                    <span class="text-success">
                        <i class="bi-graph-down"></i> 0.3% improvement
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-header-title">Request Logs</h4>
                    </div>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Methods</option>
                                    <option value="get">GET</option>
                                    <option value="post">POST</option>
                                    <option value="put">PUT</option>
                                    <option value="delete">DELETE</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Status</option>
                                    <option value="success">Success</option>
                                    <option value="error">Error</option>
                                    <option value="warning">Warning</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="24h">Last 24 Hours</option>
                                    <option value="7d">Last 7 Days</option>
                                    <option value="30d">Last 30 Days</option>
                                    <option value="custom">Custom Range</option>
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
                        <th>Timestamp</th>
                        <th>Method</th>
                        <th>Endpoint</th>
                        <th>Organization</th>
                        <th>Response Time</th>
                        <th>Status</th>
                        <th>IP Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>2024-03-15 14:23:45</td>
                        <td><span class="badge bg-soft-success">GET</span></td>
                        <td>/api/v1/shipments</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-soft-primary avatar-circle">
                                        <span class="avatar-initials">FL</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">FastLogistics Ltd</div>
                            </div>
                        </td>
                        <td>234ms</td>
                        <td><span class="badge bg-success">200 OK</span></td>
                        <td>192.168.1.1</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewLogModal">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2024-03-15 14:22:30</td>
                        <td><span class="badge bg-soft-info">POST</span></td>
                        <td>/api/v1/orders</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-soft-info avatar-circle">
                                        <span class="avatar-initials">SI</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">SecureInsure Inc</div>
                            </div>
                        </td>
                        <td>456ms</td>
                        <td><span class="badge bg-success">201 Created</span></td>
                        <td>192.168.1.2</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewLogModal">
                                <i class="bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2024-03-15 14:21:15</td>
                        <td><span class="badge bg-soft-warning">PUT</span></td>
                        <td>/api/v1/users/123</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-xs avatar-soft-warning avatar-circle">
                                        <span class="avatar-initials">RC</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">RapidCargo LLC</div>
                            </div>
                        </td>
                        <td>189ms</td>
                        <td><span class="badge bg-danger">403 Forbidden</span></td>
                        <td>192.168.1.3</td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewLogModal">
                                <i class="bi-eye"></i>
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
                        <span>2,458</span>
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

<!-- View Log Modal -->
<div class="modal fade" id="viewLogModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Log Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6>Request Details</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Timestamp:</dt>
                        <dd class="col-sm-9">2024-03-15 14:23:45</dd>

                        <dt class="col-sm-3">Method:</dt>
                        <dd class="col-sm-9"><span class="badge bg-soft-success">GET</span></dd>

                        <dt class="col-sm-3">Endpoint:</dt>
                        <dd class="col-sm-9">/api/v1/shipments</dd>

                        <dt class="col-sm-3">Headers:</dt>
                        <dd class="col-sm-9">
                            <pre class="language-json"><code>{
    "Authorization": "Bearer ****",
    "Content-Type": "application/json",
    "Accept": "application/json"
}</code></pre>
                        </dd>

                        <dt class="col-sm-3">Query Params:</dt>
                        <dd class="col-sm-9">
                            <pre class="language-json"><code>{
    "page": 1,
    "limit": 10,
    "status": "pending"
}</code></pre>
                        </dd>
                    </dl>
                </div>

                <div class="mb-4">
                    <h6>Response Details</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9"><span class="badge bg-success">200 OK</span></dd>

                        <dt class="col-sm-3">Response Time:</dt>
                        <dd class="col-sm-9">234ms</dd>

                        <dt class="col-sm-3">Response Body:</dt>
                        <dd class="col-sm-9">
                            <pre class="language-json"><code>{
    "data": {
        "shipments": [],
        "total": 0
    },
    "meta": {
        "page": 1,
        "limit": 10,
        "total_pages": 0
    }
}</code></pre>
                        </dd>
                    </dl>
                </div>

                <div>
                    <h6>Additional Information</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">IP Address:</dt>
                        <dd class="col-sm-9">192.168.1.1</dd>

                        <dt class="col-sm-3">User Agent:</dt>
                        <dd class="col-sm-9">Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36</dd>

                        <dt class="col-sm-3">API Key:</dt>
                        <dd class="col-sm-9">sk_prod_*************</dd>
                    </dl>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function exportLogs() {
        // Implement export functionality
        console.log('Exporting logs...');
    }
</script>
@endpush
