@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="#">Compliance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">KYC Submissions</li>
                    </ol>
                </nav>

                <h1 class="page-header-title">KYC Submissions</h1>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="bi-download me-1"></i> Export
                </button>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-sm-between">
            <div class="mb-2 mb-sm-0">
                <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge">
                        <input type="text" class="js-form-search form-control" placeholder="Search submissions..." 
                               data-hs-form-search-options='{
                                   "clearIcon": "#clearIcon",
                                   "defaultIcon": "#defaultIcon"
                               }'>
                        <button type="button" class="input-group-append input-group-text">
                            <i id="defaultIcon" class="bi-search"></i>
                            <i id="clearIcon" class="bi-x-circle" style="display: none;"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="d-grid d-sm-flex gap-2">
                <!-- Quick Filter Buttons -->
                <div class="d-flex gap-1">
                    <button type="button" class="btn btn-white active" data-status="all">
                        All
                    </button>
                    <button type="button" class="btn btn-white" data-status="pending">
                        <i class="bi-clock text-warning me-1"></i> Pending
                    </button>
                    <button type="button" class="btn btn-white" data-status="approved">
                        <i class="bi-check text-success me-1"></i> Approved
                    </button>
                    <button type="button" class="btn btn-white" data-status="rejected">
                        <i class="bi-x text-danger me-1"></i> Rejected
                    </button>
                </div>

                <!-- Advanced Filter Dropdown -->
                <div class="dropdown">
                    <button type="button" class="btn btn-white dropdown-toggle" id="filtersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-filter me-1"></i> Filters
                    </button>

                    <div class="dropdown-menu dropdown-menu-end dropdown-card" aria-labelledby="filtersDropdown" style="min-width: 22rem;">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-title">Filter Submissions</h5>
                            </div>

                            <div class="card-body">
                                <form id="filterForm">
                                    <!-- Status Filter -->
                                    <div class="mb-4">
                                        <label class="form-label">Status:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="all" id="statusAll" checked>
                                            <label class="form-check-label" for="statusAll">All</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="pending" id="statusPending">
                                            <label class="form-check-label" for="statusPending">Pending</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="approved" id="statusApproved">
                                            <label class="form-check-label" for="statusApproved">Approved</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="rejected" id="statusRejected">
                                            <label class="form-check-label" for="statusRejected">Rejected</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="in_progress" id="statusInProgress">
                                            <label class="form-check-label" for="statusInProgress">In Progress</label>
                                        </div>
                                    </div>

                                    <!-- Entity Type Filter -->
                                    <div class="mb-4">
                                        <label class="form-label">Entity Type:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="all" id="typeAll" checked>
                                            <label class="form-check-label" for="typeAll">All</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="consumer" id="typeConsumer">
                                            <label class="form-check-label" for="typeConsumer">Consumer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="consumer_corporate" id="typeConsumerCorporate">
                                            <label class="form-check-label" for="typeConsumerCorporate">Consumer (Corporate)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="logistics" id="typeLogistics">
                                            <label class="form-check-label" for="typeLogistics">Logistics</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="insurance" id="typeInsurance">
                                            <label class="form-check-label" for="typeInsurance">Insurance</label>
                                        </div>
                                    </div>

                                    <!-- Date Range Filter -->
                                    <div class="mb-4">
                                        <label class="form-label">Date Range:</label>
                                        <div class="row gx-2">
                                            <div class="col-sm-6">
                                                <input type="date" class="form-control" id="startDate">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="date" class="form-control" id="endDate">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                                        <button type="reset" class="btn btn-white">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.compliance.kyc.partials.submissions-table')
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize datatables
        HSCore.components.HSDatatables.init('.datatable-custom', {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    className: 'd-none'
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]'
            },
            language: {
                zeroRecords: '<div class="text-center p-4">' +
                    '<img class="mb-3" src="{{ asset("svg/illustrations/oc-error.svg") }}" alt="Image Description" style="width: 10rem;">' +
                    '<p class="mb-0">No data to show</p>' +
                    '</div>'
            }
        });

        // Initialize form search
        HSCore.components.HSFormSearch.init('.js-form-search');

        // Quick filter buttons
        $('.btn[data-status]').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            // Add filter logic here
        });

        // Filter form submission
        $('#filterForm').submit(function(e) {
            e.preventDefault();
            // Add filter logic here
        });
    });
</script>
@endpush 