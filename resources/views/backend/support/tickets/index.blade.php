@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Support Tickets</h1>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-primary">
                    <i class="bi-plus me-1"></i> Create Ticket
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Tickets</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">150</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-success text-success p-1">
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
                    <h6 class="card-subtitle mb-2">Open Tickets</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">45</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-warning text-warning p-1">
                                New
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Resolved Tickets</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">90</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-primary text-primary p-1">
                                Resolved
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Pending Tickets</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">15</span>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-soft-danger text-danger p-1">
                                Pending
                            </span>
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
                        <input type="text" class="form-control" placeholder="Search tickets..." aria-label="Search tickets">
                        <button type="button" class="btn btn-ghost-secondary">
                            <i class="bi-search"></i>
                        </button>
                    </div>
                    <!-- End Search -->
                </form>
            </div>

            <div class="d-grid d-sm-flex gap-2">
                <button class="btn btn-white" type="button">
                    <i class="bi-funnel me-1"></i> Filters
                </button>

                <button class="btn btn-white" type="button">
                    <i class="bi-download me-1"></i> Export
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>#12345</td>
                        <td>Issue with login</td>
                        <td><span class="badge bg-soft-success text-success">Open</span></td>
                        <td>High</td>
                        <td>2 hours ago</td>
                        <td>
                            <a href="{{ route('admin.support.tickets.view', ['id' => 12345]) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>#12346</td>
                        <td>Payment not processed</td>
                        <td><span class="badge bg-soft-danger text-danger">Closed</span></td>
                        <td>Medium</td>
                        <td>1 day ago</td>
                        <td>
                            <a href="{{ route('admin.support.tickets.view', ['id' => 12346]) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>#12347</td>
                        <td>Account verification</td>
                        <td><span class="badge bg-soft-warning text-warning">Pending</span></td>
                        <td>Low</td>
                        <td>3 days ago</td>
                        <td>
                            <a href="{{ route('admin.support.tickets.view', ['id' => 12347]) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    <!-- Add more ticket rows here -->
                </tbody>
            </table>
        </div>

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
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span id="datatableWithPaginationInfoTotalQty">150</span>
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
@endsection 