@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Currencies</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Currencies Settings</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCurrencyModal">
                    <i class="bi-plus me-1"></i> Add Currency
                </button>
            </div>
        </div>
        @include('settings.partials.menu')
    </div>

    <div class="row">
        <!-- Active Currencies Card -->
        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Active Currencies</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Currency</th>
                                    <th>Code</th>
                                    <th>Symbol</th>
                                    <th>Subunit</th>
                                    <th>Decimals</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nigerian Naira</td>
                                    <td>NGN</td>
                                    <td>₦</td>
                                    <td>Kobo</td>
                                    <td>2</td>
                                    <td><span class="badge bg-soft-success">Active</span></td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editCurrencyModal">
                                            <i class="bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>US Dollar</td>
                                    <td>USD</td>
                                    <td>$</td>
                                    <td>Cents</td>
                                    <td>2</td>
                                    <td><span class="badge bg-soft-success">Active</span></td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editCurrencyModal">
                                            <i class="bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>British Pound</td>
                                    <td>GBP</td>
                                    <td>£</td>
                                    <td>Pence</td>
                                    <td>2</td>
                                    <td><span class="badge bg-soft-danger">Inactive</span></td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editCurrencyModal">
                                            <i class="bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Currency Stats Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Currency Statistics</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0">Active Currencies</h5>
                            <span class="badge bg-soft-success ms-2">12</span>
                        </div>
                        <small class="text-muted">Currently enabled for transactions</small>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0">Inactive Currencies</h5>
                            <span class="badge bg-soft-danger ms-2">3</span>
                        </div>
                        <small class="text-muted">Disabled for transactions</small>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0">Default Currency</h5>
                            <span class="badge bg-soft-primary ms-2">NGN</span>
                        </div>
                        <small class="text-muted">Used for system calculations</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Currency Modal -->
    <div class="modal fade" id="addCurrencyModal" tabindex="-1" aria-labelledby="addCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCurrencyModalLabel">Add New Currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Currency Name</label>
                            <input type="text" class="form-control" placeholder="e.g. Nigerian Naira">
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Currency Code</label>
                                <input type="text" class="form-control" placeholder="e.g. NGN">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Symbol</label>
                                <input type="text" class="form-control" placeholder="e.g. ₦">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Subunit Name</label>
                                <input type="text" class="form-control" placeholder="e.g. Kobo">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Decimal Places</label>
                                <input type="number" class="form-control" placeholder="e.g. 2">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="currencyStatus">
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Currency</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Currency Modal -->
    <div class="modal fade" id="editCurrencyModal" tabindex="-1" aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCurrencyModalLabel">Edit Currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Currency Name</label>
                            <input type="text" class="form-control" value="Nigerian Naira">
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Currency Code</label>
                                <input type="text" class="form-control" value="NGN">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Symbol</label>
                                <input type="text" class="form-control" value="₦">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Subunit Name</label>
                                <input type="text" class="form-control" value="Kobo">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Decimal Places</label>
                                <input type="number" class="form-control" value="2">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="editCurrencyStatus" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection