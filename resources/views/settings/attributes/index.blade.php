@extends('layouts.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Attributes</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Product Attributes Settings</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAttributeModal">
                    <i class="bi-plus me-1"></i> Add Attribute
                </button>
            </div>
        </div>
        @include('settings.partials.menu')
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Attributes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $attributes->count() }}</span>
                            <span class="text-body fs-6 ms-1">attributes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Attributes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $active_attributes }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> {{ number_format(($active_attributes / max(1, $attributes->count())) * 100, 1) }}% active
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Products Using Attributes</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $product_options_count }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    options created
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header-title">Product Attributes</h5>
                    </div>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" id="status-filter">
                                    <option value="all">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" id="attributes-table">
                <thead class="thead-light">
                    <tr>
                        <th>Attribute</th>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($attributes as $attribute)
                    <tr data-status="{{ $attribute->is_active ? 'active' : 'inactive' }}">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-0">{{ $attribute->name }}</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach(explode(',', $attribute->options) as $option)
                                    @if(trim($option) != '')
                                    <span class="badge bg-soft-info">{{ trim($option) }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $attribute->is_active ? 'success' : 'danger' }}">
                                {{ $attribute->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editAttributeModal"
                                    data-id="{{ $attribute->id }}"
                                    data-name="{{ $attribute->name }}"
                                    data-options="{{ $attribute->options }}"
                                    data-active="{{ $attribute->is_active }}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm delete-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteAttributeModal"
                                    data-id="{{ $attribute->id }}"
                                    data-name="{{ $attribute->name }}">
                                    <i class="bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
                            <select class="js-select form-select form-select-borderless w-auto" id="per-page-select">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>{{ $attributes->total() }}</span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        {{ $attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('secondary')
@include('settings.attributes.partials.modals')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        

        // Filter by status
        $('#status-filter').on('change', function() {
            var status = $(this).val();
            
            if (status === 'all') {
                $('#attributes-table tbody tr').show();
            } else {
                $('#attributes-table tbody tr').hide();
                $('#attributes-table tbody tr[data-status="' + status + '"]').show();
            }
        });

        // Edit attribute
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var options = $(this).data('options');
            var active = $(this).data('active');
            
            $('#edit-id').val(id);
            $('#edit-name').val(name);
            
            // Set options field
            $('#edit-options').val(options);
            
            // Set active status
            if (active == 1) {
                $('#editActiveStatus').prop('checked', true);
            } else {
                $('#editActiveStatus').prop('checked', false);
            }
        });
        
        // Delete attribute
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            
            $('#delete-attribute-id').val(id);
            $('#delete-attribute-name').text(name);
        });
        
        // Handle page size changes
        $('#per-page-select').on('change', function() {
            window.location.href = '{{ route("admin.settings.attributes.index") }}?per_page=' + $(this).val();
        });
    });
</script>
@endpush 