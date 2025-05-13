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
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Categories Settings</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi-plus me-1"></i> Add Category
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
                    <h6 class="card-subtitle mb-2">Total Categories</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $categories->count() }}</span>
                            <span class="text-body fs-6 ms-1">categories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Categories</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $active_categories }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> {{ number_format(($active_categories / max(1, $categories->count())) * 100, 1) }}% active
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
                    <h6 class="card-subtitle mb-2">Category Groups</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $groups->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    {{ number_format($categories->count() / max(1, $groups->count()), 1) }} avg per group
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
                    <h6 class="card-subtitle mb-2">Products Using Categories</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $categories->sum('products_count') }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    products categorized
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
                        <h5 class="card-header-title">Categories</h5>
                    </div>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" id="group-filter">
                                    <option value="all">All Groups</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" id="categories-table">
                <thead class="thead-light">
                    <tr>
                        <th>Category</th>
                        <th>Group</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr data-group="{{ $category->group }}">
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-lg me-3" src="{{ asset('images/categories/'.$category->photo) }}" alt="{{ $category->name }}">
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">{{ $category->name }}</h5>
                                </div>
                            </div>
                        </td>
                        <td>{{ $category->group_by ?? 'Uncategorized' }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>{{ $category->products->count() }} products</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editCategoryModal"
                                    data-id="{{ $category->id }}"
                                    data-name="{{ $category->name }}"
                                    data-group="{{ $category->group_by }}"
                                    data-description="{{ $category->description }}"
                                    data-photo="{{ asset('images/categories/' . $category->photo) }}"
                                    data-active="{{ $category->is_active }}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm delete-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteCategoryModal"
                                    data-id="{{ $category->id }}"
                                    data-name="{{ $category->name }}">
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
                        <span>{{ $categories->total() }}</span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('secondary')
@include('settings.categories.partials.modals')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize datatables
        HSCore.components.HSDatatables.init('.js-datatable');

        
        // Filter by group
        $('#group-filter').on('change', function() {
            var group = $(this).val();
            
            if (group === 'all') {
                $('#categories-table tbody tr').show();
            } else {
                $('#categories-table tbody tr').hide();
                $('#categories-table tbody tr[data-group="' + group + '"]').show();
            }
        });

        // Edit category
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var group = $(this).data('group');
            var description = $(this).data('description');
            var photo = $(this).data('photo');
            var active = $(this).data('active');
            console.log(group);
            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-description').val(description);
            $('#editCategoryImagePreview').attr('src', photo);
            if (active == 1) {
                $('#editActiveStatus').prop('checked', true);
            } else {
                $('#editActiveStatus').prop('checked', false);
            }
            
            const selectElement = document.querySelector('#edit-group_by');
            if (selectElement) {
                // Get the TomSelect instance from the element
                const tomSelectInstance = selectElement.tomselect;
                if (tomSelectInstance) {
                    // Clear previous selection and set new value
                    tomSelectInstance.clear();
                    tomSelectInstance.setValue(group);
                }
            }   
        });
        
        // Delete category
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            
            $('#delete-category-id').val(id);
            $('#delete-category-name').text(name);
            
            // Update form action
            $('#deleteCategoryForm').attr('action', '{{ route("admin.settings.categories.destroy") }}');
        });
        
        // Handle page size changes
        $('#per-page-select').on('change', function() {
            window.location.href = '{{ route("admin.settings.categories.index") }}?per_page=' + $(this).val();
        });
    });
</script>
@endpush 