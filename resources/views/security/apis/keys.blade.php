@extends('layouts.base.provider')
@section('title', 'API Keys Management')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">API Keys</h1>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-md">
                    <h4 class="card-header-title">Active API Keys</h4>
                </div>

                <div class="col-auto">
                    <!-- Dropdown -->
                    <div class="dropdown me-2">
                        <button type="button" class="btn btn-white btn-sm dropdown-toggle" id="usersFilterDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-filter me-1"></i> Filter
                        </button>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="usersFilterDropdown">
                            <a class="dropdown-item" href="#">All Platforms</a>
                            <a class="dropdown-item" href="#">Mobile App</a>
                            <a class="dropdown-item" href="#">Web Platform</a>
                            <a class="dropdown-item" href="#">Third Party</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Active Keys</a>
                            <a class="dropdown-item" href="#">Inactive Keys</a>
                            <a class="dropdown-item" href="#">Expired Keys</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Organization</th>
                            <th>Platform</th>
                            <th>Environment</th>
                            <th>Permissions</th>
                            <th>Created</th>
                            <th>Last Used</th>
                            <th>Expires</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Logistics Company Example -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-soft-primary avatar-circle">
                                            <span class="avatar-initials">FL</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong>FastLogistics Ltd</strong>
                                        <span class="d-block small text-muted">Logistics Company</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block">Mobile App</span>
                                <span class="small text-muted">Driver Application</span>
                            </td>
                            <td><span class="badge bg-soft-success">Production</span></td>
                            <td><span class="badge bg-soft-primary">Limited Access</span></td>
                            <td>Mar 15, 2024</td>
                            <td>2 mins ago</td>
                            <td>Never</td>
                            <td><span class="badge bg-soft-success">Active</span></td>
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#viewApiKeyModal">
                                    <i class="bi-eye"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Insurance Company Example -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-soft-info avatar-circle">
                                            <span class="avatar-initials">SI</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong>SecureInsure Inc</strong>
                                        <span class="d-block small text-muted">Insurance Provider</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block">Web Platform</span>
                                <span class="small text-muted">Claims Portal</span>
                            </td>
                            <td><span class="badge bg-soft-warning">Staging</span></td>
                            <td><span class="badge bg-soft-success">Full Access</span></td>
                            <td>Feb 28, 2024</td>
                            <td>1 hour ago</td>
                            <td>Dec 31, 2024</td>
                            <td><span class="badge bg-soft-success">Active</span></td>
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#viewApiKeyModal">
                                    <i class="bi-eye"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Third Party Integration -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-soft-danger avatar-circle">
                                            <span class="avatar-initials">TP</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong>TrackPro Solutions</strong>
                                        <span class="d-block small text-muted">Third Party Integration</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block">API Integration</span>
                                <span class="small text-muted">Fleet Tracking</span>
                            </td>
                            <td><span class="badge bg-soft-success">Production</span></td>
                            <td><span class="badge bg-soft-warning">Read Only</span></td>
                            <td>Jan 15, 2024</td>
                            <td>5 mins ago</td>
                            <td>Jan 15, 2025</td>
                            <td><span class="badge bg-soft-success">Active</span></td>
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#viewApiKeyModal">
                                    <i class="bi-eye"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Expired Key Example -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-soft-dark avatar-circle">
                                            <span class="avatar-initials">RC</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong>RapidCargo LLC</strong>
                                        <span class="d-block small text-muted">Logistics Company</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block">Web Platform</span>
                                <span class="small text-muted">Admin Dashboard</span>
                            </td>
                            <td><span class="badge bg-soft-danger">Development</span></td>
                            <td><span class="badge bg-soft-success">Full Access</span></td>
                            <td>Dec 1, 2023</td>
                            <td>30 days ago</td>
                            <td>Mar 1, 2024</td>
                            <td><span class="badge bg-soft-danger">Expired</span></td>
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#viewApiKeyModal">
                                    <i class="bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View API Key Details Modal -->
<div class="modal fade" id="viewApiKeyModal" tabindex="-1" aria-labelledby="viewApiKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApiKeyModalLabel">API Key Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label class="form-label">Organization Details</label>
                    <p class="mb-2"><strong>Name:</strong> FastLogistics Ltd</p>
                    <p class="mb-2"><strong>Type:</strong> Logistics Company</p>
                    <p class="mb-2"><strong>Contact:</strong> tech@fastlogistics.com</p>
                </div>

                <div class="mb-4">
                    <label class="form-label">Platform Information</label>
                    <p class="mb-2"><strong>Platform:</strong> Mobile App (Driver Application)</p>
                    <p class="mb-2"><strong>Environment:</strong> Production</p>
                    <p class="mb-2"><strong>Version:</strong> v2.0</p>
                </div>

                <div class="mb-4">
                    <label class="form-label">Access Details</label>
                    <p class="mb-2"><strong>Permission Level:</strong> Limited Access</p>
                    <p class="mb-2"><strong>IP Restrictions:</strong> None</p>
                    <p class="mb-2"><strong>Rate Limit:</strong> 1000 requests/minute</p>
                </div>

                <div class="mb-4">
                    <label class="form-label">Usage Statistics</label>
                    <p class="mb-2"><strong>Total Requests (30d):</strong> 1.2M</p>
                    <p class="mb-2"><strong>Average Daily Usage:</strong> 40K requests</p>
                    <p class="mb-2"><strong>Last Error:</strong> None</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
@endsection 