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
                        <li class="breadcrumb-item active" aria-current="page">Staff</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Staff Management</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                    <i class="bi-plus me-1"></i> Add Staff
                </button>
            </div>
        </div>
        @include('backend.settings.partials.menu')
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Staff</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">12</span>
                            <span class="text-body fs-6 ms-1">members</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Staff</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">10</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> 83.3% active
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
                    <h6 class="card-subtitle mb-2">Super Admins</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">3</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    with full access
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
                    <h6 class="card-subtitle mb-2">Last Activity</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">5m</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    ago by John
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
                    <h5 class="card-header-title">Staff Members</h5>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm">
                                    <option value="all">All Permissions</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="support">Support</option>
                                </select>
                            </div>
                        </div>

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
                        <th>Staff Member</th>
                        <th>Permissions</th>
                        <th>Last Active</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img" src="assets/images/160x160/img10.jpg" alt="Image">
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">John Smith</span>
                                    <span class="d-block fs-5 text-body">john@example.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-soft-primary">Settings</span>
                                <span class="badge bg-soft-primary">Security</span>
                                <span class="badge bg-soft-primary">Analytics</span>
                                <span class="badge bg-soft-primary">+5 more</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi-circle-fill text-success fs-6 me-2"></i> 
                                5 mins ago
                            </div>
                        </td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editStaffModal">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                @if($staff->id !== auth()->id())
                                <button type="button" 
                                        class="btn btn-white btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteStaffModal"
                                        onclick="populateDeleteModal(
                                            {{ $staff->id }}, 
                                            '{{ $staff->firstname }} {{ $staff->surname }}',
                                            '{{ $staff->email }}',
                                            '{{ $staff->photo ? asset($staff->photo) : asset('assets/images/160x160/img1.jpg') }}'
                                        )">
                                    <i class="bi-trash"></i>
                                </button>
                                @endif
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
                            <select class="js-select form-select form-select-borderless w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>12</span>
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
@include('backend.settings.staff.partials.modals')
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