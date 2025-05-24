@extends('layouts.base.app')

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
                    @foreach ($countries as $country)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-xss avatar-circle me-2" src="{{ 'https://ipdata.co/flags/'.strtolower($country->code).'.png' }}" alt="Nigeria Flag">
                                <span>{{ $country->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="d-block">{{ $country->states->count() }} States</span>
                            <small class="text-muted">{{ $country->cities->count() }} Cities</small>
                        </td>
                        <td>
                            <span class="d-block">{{ strtoupper($country->currency->code) }}</span>
                            <small class="text-muted">{{ $country->currency->name.' '.$country->currency->symbol }}</small>
                        </td>
                        <td>
                            @if($country->banking_fields || $country->verification_fields || $country->transaction_charges || ($country->payout_type && $country->payout_type != "manual"))
                            <div class="d-flex gap-1">
                                @if($country->verification_fields)
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Verification">
                                    <i class="bi-shield-check"></i>
                                </span>
                                @endif
                                @if($country->banking_fields)
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Banking">
                                    <i class="bi-bank"></i>
                                </span>
                                @endif
                                @if($country->transaction_charges)
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Payments">
                                    <i class="bi-cash-coin"></i>
                                </span>
                                @endif
                                @if($country->payout_type && $country->payout_type != "manual")
                                <span class="badge bg-soft-success" data-bs-toggle="tooltip" title="Payouts">
                                    <i class="bi-box-arrow-in-up-right"></i>
                                </span>
                                @endif

                            </div>
                            @else
                            <span class="badge bg-soft-warning">
                                <i class="bi-exclamation-circle-fill me-1"></i> Pending
                            </span>
                            @endif
                        </td>
                        <td>
                            @if ($country->status == 0)
                                <span class="badge bg-soft-danger">
                                    <i class="bi-x-circle-fill me-1"></i> Inactive
                                </span>
                                
                            @else
                                <span class="badge bg-soft-success">
                                    <i class="bi-check-circle-fill me-1"></i> Active
                                </span>
                            @endif
                           
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{route('admin.settings.places.setup',$country)}}" class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Setup">
                                    <i class="bi-gear-fill"></i>
                                </a>
                                <button type="button" class="btn btn-white btn-sm editCountryModal" data-country="{{ $country }}">
                                    <i class="bi-pencil-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
        <form action="{{ route('admin.settings.places.country') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryModalLabel">Add New Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        <!-- Basic Info -->
                        <div class="mb-4">
                            <h6>Basic Information</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Country Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter country name">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Country Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="2-letter code (e.g. NG)">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Continent</label>
                                    <select class="form-select" name="continent">
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
                                    <input type="text" name="dial" class="form-control" placeholder="e.g. +234">
                                </div>
                            </div>
                        </div>

                        <!-- Currency Settings -->
                        <div class="mb-4">
                            
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Currency</label>
                                    <select class="form-select" name="currency_code">
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->code}}">{{ $currency->name."(".$currency->symbol.")" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Verification Provider</label>
                                    <select class="form-select" name="verification_provider">
                                        <option value="manual">Manual Verification</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>

                        <!-- Gateway -->
                        <div class="mb-4">
                            
                            <h6>Gateway</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Primary Gateway</label>
                                    <select class="form-select" name="primary_gateway">
                                        <option value=""></option>
                                        <option value="paystack">Paystack</option>
                                        <option value="flutterwave">Flutterwave</option>
                                        <option value="paypal">Paypal</option>
                                        <option value="stripe">Stripe</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Secondary Gateway</label>
                                    <select class="form-select" name="secondary_gateway">
                                        <option value="">None</option>
                                        <option value="paystack">Paystack</option>
                                        <option value="flutterwave">Flutterwave</option>
                                        <option value="paypal">Paypal</option>
                                        <option value="stripe">Stripe</option>
                                    </select>
                                </div> 
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" value="1" class="form-check-input" id="countryStatus">
                                <label class="form-check-label">Enable Country</label>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Country</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Country Modal -->
<div class="modal fade" id="editCountryModal" tabindex="-1" aria-labelledby="editCountryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.settings.places.country') }}" method="POST">@csrf
            <input type="hidden" name="country_id" id="edit-country-id">
            <input type="hidden" name="action" value="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCountryModalLabel">Edit Country - Nigeria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">    
                    <div class="mb-4">
                        <h6>Basic Information</h6>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Country Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter country name" id="edit-country-name">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Country Code</label>
                                <input type="text" name="code" class="form-control" placeholder="2-letter code (e.g. NG)" id="edit-country-code">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Continent</label>
                                <select class="form-select" name="continent" id="edit-country-continent">
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
                                <input type="text" name="dial" class="form-control" placeholder="e.g. +234" id="edit-country-dial">
                            </div>
                        </div>
                    </div>

                    <!-- Currency Settings -->
                    <div class="mb-4">
                        
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Currency</label>
                                <select class="form-select" name="currency_code" id="edit-country-currency">
                                    <option value=""></option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->code}}">{{ $currency->name."(".$currency->symbol.")" }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Verification Provider</label>
                                <select class="form-select" name="verification_provider" id="edit-country-verification-provider">
                                    <option value="manual">Manual Verification</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Gateway -->
                    <div class="mb-4">
                        
                        <h6>Gateway</h6>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Primary Gateway</label>
                                <select class="form-select" name="primary_gateway">
                                    <option value=""></option>
                                    <option value="paystack">Paystack</option>
                                    <option value="flutterwave">Flutterwave</option>
                                    <option value="paypal">Paypal</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Secondary Gateway</label>
                                <select class="form-select" name="secondary_gateway">
                                    <option value="">None</option>
                                    <option value="paystack">Paystack</option>
                                    <option value="flutterwave">Flutterwave</option>
                                    <option value="paypal">Paypal</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                            </div> 
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="status" value="1" class="form-check-input" id="edit-country-status">
                            <label class="form-check-label">Enable Country</label>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // Attach click event to all buttons with the class 'editCountryModal'
        $('.editCountryModal').on('click', function () {
            // Get the country data from the data-country attribute
            const country = $(this).data('country');

            // Populate the modal fields with the extracted data
            $('#edit-country-name').val(country.name);
            $('#edit-country-code').val(country.code);
            $('#edit-country-continent').val(country.continent);
            $('#edit-country-dial').val(country.dial);
            $('#edit-country-currency').val(country.currency_code);
            $('#edit-country-verification-provider').val(country.verification_provider);
            $('#edit-country-status').prop('checked', country.status);

            // Show the modal
            $('#editCountryModal').modal('show');
        });
    });
</script>
@endpush