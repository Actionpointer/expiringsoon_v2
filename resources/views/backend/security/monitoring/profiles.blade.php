@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Suspended Organizations</h1>
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
                            <span class="display-4 text-dark">42</span>
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
                    <h6 class="card-subtitle mb-2">Under Investigation</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">15</span>
                        </div>
                    </div>
                    <span class="text-warning">
                        <i class="bi-shield-exclamation"></i> Pending Review
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Payment Related</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">18</span>
                        </div>
                    </div>
                    <span class="text-danger">
                        Financial Issues
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Compliance Issues</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">9</span>
                        </div>
                    </div>
                    <span class="text-primary">
                        Regulatory Concerns
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Suspended Organizations Table -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <h4 class="card-header-title">Suspended Organizations List</h4>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Types</option>
                                    <option value="logistics">Logistics Companies</option>
                                    <option value="insurance">Insurance Providers</option>
                                    <option value="corporate">Corporate Clients</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Reasons</option>
                                    <option value="payment">Payment Issues</option>
                                    <option value="compliance">Compliance Violation</option>
                                    <option value="security">Security Concerns</option>
                                    <option value="fraud">Suspected Fraud</option>
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
                        <th>Organization</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Suspended By</th>
                        <th>Suspended Date</th>
                        <th>Impact Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{asset('backend/images/160x160/img8.jpg')}}" alt="Logo">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="d-block h5 text-inherit mb-0">FastLogistics Ltd</span>
                                    <span class="d-block fs-5 text-body">ID: ORG-12345</span>
                                </div>
                            </div>
                        </td>
                        <td>Logistics Company</td>
                        <td>Multiple compliance violations</td>
                        <td>System Admin</td>
                        <td>Mar 15, 2024</td>
                        <td>
                            <span class="badge bg-soft-danger">High</span>
                        </td>
                        <td>
                            <span class="badge bg-danger">Under Investigation</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewOrgSuspensionModal">
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
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-soft-primary avatar-circle">
                                        <span class="avatar-initials">SI</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="d-block h5 text-inherit mb-0">SecureInsure Inc</span>
                                    <span class="d-block fs-5 text-body">ID: ORG-67890</span>
                                </div>
                            </div>
                        </td>
                        <td>Insurance Provider</td>
                        <td>Payment default</td>
                        <td>Finance Team</td>
                        <td>Mar 14, 2024</td>
                        <td>
                            <span class="badge bg-soft-warning">Medium</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">Payment Pending</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#viewOrgSuspensionModal">
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
                        <span>42</span>
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

<!-- View Organization Suspension Modal -->
<div class="modal fade" id="viewOrgSuspensionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Organization Suspension Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6>Organization Information</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9">FastLogistics Ltd</dd>

                        <dt class="col-sm-3">Type:</dt>
                        <dd class="col-sm-9">Logistics Company</dd>

                        <dt class="col-sm-3">Registration:</dt>
                        <dd class="col-sm-9">LLC123456</dd>

                        <dt class="col-sm-3">Contact:</dt>
                        <dd class="col-sm-9">admin@fastlogistics.com</dd>
                    </dl>
                </div>

                <div class="mb-4">
                    <h6>Suspension Details</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Primary Reason:</dt>
                        <dd class="col-sm-9">Multiple compliance violations</dd>

                        <dt class="col-sm-3">Impact Level:</dt>
                        <dd class="col-sm-9"><span class="badge bg-soft-danger">High</span></dd>

                        <dt class="col-sm-3">Affected Users:</dt>
                        <dd class="col-sm-9">150+ active users</dd>

                        <dt class="col-sm-3">Investigation:</dt>
                        <dd class="col-sm-9">In Progress - Case #INV-2024-123</dd>
                    </dl>
                </div>

                <div class="mb-4">
                    <h6>Violation History</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1">Failed Security Audit</h5>
                                    <p class="text-body small mb-0">Mar 14, 2024 - Critical security protocols breach</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1">Data Policy Violation</h5>
                                    <p class="text-body small mb-0">Mar 13, 2024 - Unauthorized data access attempt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h6>Reinstatement Requirements</h6>
                    <ul class="small text-body">
                        <li>Complete security audit and fix all critical issues</li>
                        <li>Submit updated compliance documentation</li>
                        <li>Provide written explanation of corrective measures</li>
                        <li>Pay outstanding penalties</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger me-2">Extend Suspension</button>
                <button type="button" class="btn btn-success">Lift Suspension</button>
            </div>
        </div>
    </div>
</div>

@endsection 