@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Places</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Places Management</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCountryModal">
                    <i class="bi-plus me-1"></i> Add Country
                </button>
            </div>
        </div>
        @include('settings.partials.menu')
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Countries</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">45</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> 32 Active
                                </span>
                                <span class="text-danger">
                                    <i class="bi-x-circle-fill"></i> 13 Inactive
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">States</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">897</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> 754 Active
                                </span>
                                <span class="text-danger">
                                    <i class="bi-x-circle-fill"></i> 143 Inactive
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Cities</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">12.5K</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> 10.2K Active
                                </span>
                                <span class="text-danger">
                                    <i class="bi-x-circle-fill"></i> 2.3K Inactive
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Full Support</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">15</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> All Features Active
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Countries Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-sm">
                    <h4 class="card-header-title">Countries</h4>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex gap-2">
                        <div class="tom-select-custom">
                            <select class="form-select form-select-sm">
                                <option value="all">All Regions</option>
                                <option value="africa">Africa</option>
                                <option value="asia">Asia</option>
                                <option value="europe">Europe</option>
                                <option value="north_america">North America</option>
                                <option value="south_america">South America</option>
                                <option value="oceania">Oceania</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Country</th>
                        <th>States/Cities</th>
                        <th>Currency</th>
                        <th>Features Status</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/ng.svg" alt="Nigeria Flag">
                                <span>Nigeria</span>
                            </div>
                        </td>
                        <td>
                            <span class="d-block">37 States</span>
                            <small class="text-muted">774 Cities</small>
                        </td>
                        <td>
                            <span class="d-block">NGN</span>
                            <small class="text-muted">₦ Nigerian Naira</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Verification">
                                    <i class="bi-shield-check"></i>
                                </span>
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Banking">
                                    <i class="bi-bank"></i>
                                </span>
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Automatic Payouts">
                                    <i class="bi-cash-coin"></i>
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-success">Active</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{route('admin.settings.places.edit',1)}}" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Setup">
                                    <i class="bi-gear-fill"></i>
                                </a>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editCountryModal">
                                    <i class="bi-pencil-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/gh.svg" alt="Ghana Flag">
                                <span>Ghana</span>
                            </div>
                        </td>
                        <td>
                            <span class="d-block">16 States</span>
                            <small class="text-muted">216 Cities</small>
                        </td>
                        <td>
                            <span class="d-block">GHS</span>
                            <small class="text-muted">₵ Ghana Cedi</small>
                        </td>
                        <td>
                            <span class="badge bg-soft-warning">
                                <i class="bi-exclamation-circle-fill me-1"></i> Pending
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-warning">Partial</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editCountryModal">
                                <i class="bi-pencil-fill"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Add more static country rows here -->

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Country Modals -->
@include('settings.places.partials.modals')
@endsection

@section('secondary')
<div class="modal fade" id="addCountryModal" tabindex="-1" aria-labelledby="addCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryModalLabel">Add New Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Basic Info -->
                        <div class="mb-4">
                            <h6>Basic Information</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Country Name</label>
                                    <input type="text" class="form-control" placeholder="Enter country name">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Country Code</label>
                                    <input type="text" class="form-control" placeholder="2-letter code (e.g. NG)">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Continent</label>
                                    <select class="form-select">
                                        <option>Africa</option>
                                        <option>Asia</option>
                                        <option>Europe</option>
                                        <option>North America</option>
                                        <option>South America</option>
                                        <option>Oceania</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Dial Code</label>
                                    <input type="text" class="form-control" placeholder="e.g. +234">
                                </div>
                            </div>
                        </div>

                        <!-- Currency Settings -->
                        <div class="mb-4">
                            <h6>Currency Settings</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Currency</label>
                                    <select class="form-select">
                                        <option>Nigerian Naira (NGN)</option>
                                        <option>US Dollar (USD)</option>
                                        <option>Euro (EUR)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Verification Requirements -->
                        <div class="mb-4">
                            <h6>Verification Requirements</h6>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="verificationRequired">
                                <label class="form-check-label">Enable Verification</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Verification Type</label>
                                    <select class="form-select">
                                        <option>BVN</option>
                                        <option>National ID</option>
                                        <option>Passport</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Required Fields</label>
                                    <input type="text" class="form-control" placeholder="Comma separated fields">
                                </div>
                            </div>
                        </div>

                        <!-- Banking Settings -->
                        <div class="mb-4">
                            <h6>Banking Settings</h6>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="bankingEnabled">
                                <label class="form-check-label">Enable Banking</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Banking Gateway</label>
                                    <select class="form-select">
                                        <option>Paystack</option>
                                        <option>Flutterwave</option>
                                        <option>Manual Bank Transfer</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Required Fields</label>
                                    <input type="text" class="form-control" placeholder="Account number, Bank code">
                                </div>
                            </div>
                        </div>

                        <!-- Withdrawal Settings -->
                        <div class="mb-4">
                            <h6>Withdrawal Settings</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Withdrawal Type</label>
                                    <select class="form-select">
                                        <option>Automatic</option>
                                        <option>Manual</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Daily Limit</label>
                                    <input type="number" class="form-control" placeholder="Enter amount">
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="countryStatus">
                                <label class="form-check-label">Enable Country</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Country</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Country Modal -->
    <div class="modal fade" id="editCountryModal" tabindex="-1" aria-labelledby="editCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCountryModalLabel">Edit Country - Nigeria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Same form structure as Add Country Modal but with pre-filled values -->
                    <form>
                        <!-- Basic Info -->
                        <div class="mb-4">
                            <h6>Basic Information</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Country Name</label>
                                    <input type="text" class="form-control" value="Nigeria">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Country Code</label>
                                    <input type="text" class="form-control" value="NG">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Continent</label>
                                    <select class="form-select">
                                        <option selected>Africa</option>
                                        <option>Asia</option>
                                        <option>Europe</option>
                                        <option>North America</option>
                                        <option>South America</option>
                                        <option>Oceania</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Dial Code</label>
                                    <input type="text" class="form-control" value="+234">
                                </div>
                            </div>
                        </div>

                        <!-- Pre-filled sections continue with same structure... -->
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger me-2">Disable Country</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush