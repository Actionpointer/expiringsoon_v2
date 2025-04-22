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
                            <span class="display-4 text-dark">56</span>
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
                            <span class="display-4 text-dark">48</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> 85.7% active
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
                    <h6 class="card-subtitle mb-2">Total Subcategories</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">182</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    3.25 avg per category
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
                    <h6 class="card-subtitle mb-2">Items Using Categories</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">1.2k</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    items categorized
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
                                <select class="js-select form-select form-select-sm">
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
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Category</th>
                        <th>Subcategories</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="avatar avatar-lg me-3" src="assets/img/categories/electronics.jpg" alt="Electronics">
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">Electronics</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-soft-primary">Phones</span>
                                <span class="badge bg-soft-primary">Laptops</span>
                                <span class="badge bg-soft-primary">Tablets</span>
                                <span class="badge bg-soft-primary">+3 more</span>
                            </div>
                        </td>
                        <td>245 items</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#manageCategorySubcatsModal">
                                    <i class="bi-list-task"></i>
                                </button>
                                <button type="button" class="btn btn-white btn-sm">
                                    <i class="bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- More rows... -->
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
                            <select class="js-select form-select form-select-borderless w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>24</span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
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

        // Initialize tom select
        HSCore.components.HSTomSelect.init('.js-select');
    });
</script>
@endpush 