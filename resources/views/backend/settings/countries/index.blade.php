@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Countries</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Country Management</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCountryModal">
                    <i class="bi-plus me-1"></i> Add Country
                </button>
            </div>
        </div>
        @include('backend.settings.partials.menu')
    </div>

    <!-- Countries Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-sm">
                    <h4 class="card-header-title">Countries</h4>
                </div>
                <div class="col-sm-auto">
                    <form>
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text">
                                <i class="bi-search"></i>
                            </div>
                            <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search country" aria-label="Search country">
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-auto">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="table-responsive datatable-custom">
            <table class="table table-borderless js-datatable table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableEntriesPagination"
                 }'>
                <thead class="thead-light">
                    <tr>
                        <th>Country</th>
                        <th>Financials</th>
                        <th>Subscription Plans</th>
                        <th>Ad Plans</th>
                        <th>Newsletter Plans</th>
                        <th>Verification</th>
                        <th>Staff</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-xss avatar-circle me-2" src="{{ 'https://ipdata.co/flags/'.strtolower($country->iso2).'.png' }}" alt="Nigeria Flag">
                                <span>{{ $country->name }}</span>
                            </div>
                        </td>
                        <td>
                            @if($country->country_banking)
                            <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Banking">
                                <i class="bi-bank"></i> Exist
                            </span>
                            @else
                            <span class="badge bg-soft-danger" data-bs-toggle="tooltip" title="Banking">
                                <i class="bi-bank"></i> Not Set
                            </span>
                            @endif

                        </td>
                        <td>
                            @if($country->country_subscription_plans->count() > 0)
                            <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Subscription Plans">
                                <i class="bi-box"></i> Exist
                            </span>
                            @else
                            <span class="badge bg-soft-danger" data-bs-toggle="tooltip" title="Subscription Plans">
                                <i class="bi-box"></i> Not Set
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($country->country_ad_plans->count() > 0)
                            <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Ad Plans">
                                <i class="bi-badge-ad"></i> {{ $country->country_ad_plans->count() }} plans
                            </span>
                            @else
                            <span class="badge bg-soft-danger" data-bs-toggle="tooltip" title="Ad Plans">
                                <i class="bi-badge-ad"></i> Not Set
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($country->country_newsletter_plans->count() > 0)
                            <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Newsletter Plans">
                                <i class="bi-envelope-paper"></i> {{ $country->country_newsletter_plans->count() }} plans
                            </span>
                            @else
                            <span class="badge bg-soft-danger" data-bs-toggle="tooltip" title="Newsletter Plans">
                                <i class="bi-envelope-paper"></i> Not Set
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($country->country_verifications->count() > 0)
                            <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Verification">
                                <i class="bi-shield-check"></i> Exist
                            </span>
                            @else
                            <span class="badge bg-soft-danger" data-bs-toggle="tooltip" title="Verification">
                                <i class="bi-shield-check"></i> Not Set
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($country->staff->count() > 0)
                            <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Staff">
                                <i class="bi-person"></i> {{ $country->staff->count() }} staff
                            </span>
                            @else
                            <span class="badge bg-soft-danger" data-bs-toggle="tooltip" title="Staff">
                                <i class="bi-person"></i> Not Set
                            </span>
                            @endif
                        </td>


                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{route('admin.settings.countries.financials',$country->iso2)}}" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Setup">
                                    <i class="bi-gear-fill"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <!-- Pagination -->
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Showing:</span>

                        <!-- Select -->
                        <div class="tom-select-custom">
                            <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off"
                                data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true,
                            "width":100px
                        }'>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20" selected>20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <!-- End Select -->

                        <span class="text-secondary me-2">of</span>

                        <!-- Pagination Quantity -->
                        <span id="datatableEntriesInfoTotalQty"></span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        <nav id="datatableEntriesPagination" aria-label="Activity pagination"></nav>
                    </div>
                </div>
            </div>
            <!-- End Pagination -->
        </div>

        <!-- End Footer -->
    </div>
</div>

<!-- Add/Edit Country Modals -->

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        HSCore.components.HSDatatables.init('.js-datatable')
        HSCore.components.HSTomSelect.init('.js-select')
        document.querySelectorAll('.js-datatable-filter').forEach(function(item) {
            item.addEventListener('change', function(e) {
                const elVal = e.target.value,
                    targetColumnIndex = e.target.getAttribute('data-target-column-index'),
                    targetTable = e.target.getAttribute('data-target-table');

                HSCore.components.HSDatatables.getItem(targetTable).column(targetColumnIndex).search(elVal !== 'null' ? elVal : '').draw()
            })
        })
    });
</script>
@endpush