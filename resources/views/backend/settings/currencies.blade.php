@extends('layouts.backend.base.app')

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
        @include('backend.settings.partials.menu')
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
                                @foreach($currencies as $currency)
                                <tr>
                                    <td>{{ $currency->name }}</td>
                                    <td>{{ $currency->code }}</td>
                                    <td>{{ $currency->symbol }}</td>
                                    <td>{{ $currency->decimal_name }}</td>
                                    <td>{{ $currency->decimal_places }}</td>
                                    <td>
                                        @if($currency->status == 1)
                                            <span class="badge bg-soft-success">Active</span>
                                        @else
                                            <span class="badge bg-soft-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm editCurrencyModal" data-currency="{{ $currency }}">
                                            <i class="bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
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
            <form action="{{ route('admin.settings.currencies.store') }}" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCurrencyModalLabel">Add New Currency</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                            <div class="mb-3">
                                <label class="form-label">Currency Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Nigerian Naira">
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Currency Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="e.g. NGN">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Symbol</label>
                                    <input type="text" name="symbol" class="form-control" placeholder="e.g. ₦">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Subunit Name</label>
                                    <input type="text" name="decimal_name" class="form-control" placeholder="e.g. Kobo">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Decimal Places</label>
                                    <input type="number" name="decimal_places" class="form-control" placeholder="e.g. 2">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="status" value="1" class="form-check-input" id="currencyStatus">
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Currency</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Currency Modal -->
    <div class="modal fade" id="editCurrencyModal" tabindex="-1" aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.settings.currencies.update') }}" method="POST">@csrf
                <input type="hidden" name="currency_id" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCurrencyModalLabel">Edit Currency</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                            <div class="mb-3">
                                <label class="form-label">Currency Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Nigerian Naira">
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Currency Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="e.g. NGN">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Symbol</label>
                                    <input type="text" name="symbol" class="form-control" placeholder="e.g. ₦">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Subunit Name</label>
                                    <input type="text" name="decimal_name" class="form-control" placeholder="e.g. Kobo">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Decimal Places</label>
                                    <input type="number" name="decimal_places" class="form-control" placeholder="e.g. 2">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="status" value="1" class="form-check-input" id="currencyStatus">
                                    <label class="form-check-label">Active</label>
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
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // Attach click event to all buttons with the class 'editCurrencyModal'
        $('.editCurrencyModal').on('click', function () {
            // Get the currency data from the data-currency attribute
            const currency = $(this).data('currency');

            // Populate the modal fields with the extracted data
            $('#editCurrencyModal input[name="currency_id"]').val(currency.id);
            $('#editCurrencyModal input[name="name"]').val(currency.name);
            $('#editCurrencyModal input[name="code"]').val(currency.code);
            $('#editCurrencyModal input[name="symbol"]').val(currency.symbol);
            $('#editCurrencyModal input[name="decimal_name"]').val(currency.decimal_name);
            $('#editCurrencyModal input[name="decimal_places"]').val(currency.decimal_places);
            $('#editCurrencyModal input[name="status"]').prop('checked',currency.status);

            // Show the modal
            $('#editCurrencyModal').modal('show');
        });
    });
</script>
@endpush