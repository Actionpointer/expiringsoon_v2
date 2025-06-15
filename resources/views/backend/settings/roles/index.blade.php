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
                        <li class="breadcrumb-item active" aria-current="page">Roles & Permissions</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Role Management</h1>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    <i class="bi-plus me-1"></i> Add Role
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
                    <h6 class="card-subtitle mb-2">Total Roles</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $roles->count() }}</span>
                            <span class="text-body fs-6 ms-1">roles</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Active Roles</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $roles->where('status', 1)->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi-check-circle-fill"></i> {{ $roles->count() > 0 ? round($roles->where('status', 1)->count() / $roles->count() * 100) : 0 }}% active
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
                    <h6 class="card-subtitle mb-2">Admin Roles</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $roles->where('type', 'admin')->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    for platform staff
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
                    <h6 class="card-subtitle mb-2">Store Roles</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $roles->where('type', 'store')->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">
                                    for shop owners
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
                    <h5 class="card-header-title">System Roles</h5>
                </div>

                <div class="col-auto">
                    <!-- Filters -->
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" id="typeFilter">
                                    <option value="all">All Types</option>
                                    <option value="admin">Admin</option>
                                    <option value="store">Store</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" id="statusFilter">
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
                        <th>Role Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Permissions</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <span class="avatar-initials bg-soft-primary text-primary">
                                            {{ strtoupper(substr($role->name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{ $role->name }}</span>
                                    <span class="d-block fs-6 text-body">{{ $role->slug }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $role->description }}</td>
                        <td>
                            @if($role->type == 'admin')
                                <span class="badge bg-soft-primary">Admin</span>
                            @else
                                <span class="badge bg-soft-info">Store</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $permissionsCount = 0;
                                $permissionCategories = [];
                                
                                if (!empty($role->permissions)) {
                                    $rolePermissions = is_string($role->permissions) ? json_decode($role->permissions) : $role->permissions;
                                    $permissionsCount = count((array)$rolePermissions);
                                    
                                    // Get categories (this is an example, adjust to your actual data structure)
                                    if (isset($allPermissions) && !empty($rolePermissions)) {
                                        foreach($allPermissions as $permission) {
                                            if (in_array($permission->id, (array)$rolePermissions) && !in_array($permission->category, $permissionCategories)) {
                                                $permissionCategories[] = $permission->category;
                                            }
                                        }
                                    }
                                }
                            @endphp
                            
                            <div class="d-flex align-items-center">
                                <span class="badge bg-soft-dark me-2">{{ $permissionsCount }}</span>
                                <div class="progress flex-grow-1" style="height: 8px;" 
                                     data-bs-toggle="tooltip" 
                                     data-bs-placement="top" 
                                     title="{{ $permissionsCount }} permissions granted">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ isset($totalPermissions) && $totalPermissions > 0 ? ($permissionsCount / $totalPermissions) * 100 : 0 }}%" 
                                         aria-valuenow="{{ $permissionsCount }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="{{ $totalPermissions ?? 0 }}"></div>
                                </div>
                            </div>
                            
                            @if(!empty($permissionCategories))
                            <div class="mt-1">
                                @foreach(array_slice($permissionCategories, 0, 3) as $category)
                                    <span class="badge bg-soft-secondary me-1">{{ $category }}</span>
                                @endforeach
                                
                                @if(count($permissionCategories) > 3)
                                    <span class="badge bg-soft-secondary">+{{ count($permissionCategories) - 3 }} more</span>
                                @endif
                            </div>
                            @endif
                        </td>
                        
                        <td>
                            @if($role->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" 
                                        class="btn btn-white btn-sm edit-role" 
                                        data-details="{{ $role }}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                
                                <button type="button" 
                                        class="btn btn-white btn-sm delete-role"
                                        data-details="{{ $role }}" >
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
                            <select class="js-select form-select form-select-borderless w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="text-secondary me-2">of</span>
                        <span>{{ $roles->count() }}</span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('secondary')
@include('backend.settings.roles.partials.modals')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize datatables
        HSCore.components.HSDatatables.init('.js-datatable');

        
        
        // // Initialize tooltips
        // HSCore.components.HSTooltip.init('.progress[data-bs-toggle="tooltip"]');
        
        // Filter roles by type
        $('#typeFilter').on('change', function() {
            const value = $(this).val();
            const table = $('.js-datatable').DataTable();
            
            if (value === 'all') {
                table.column(2).search('').draw();
            } else {
                table.column(2).search(value).draw();
            }
        });
        
        // Filter roles by status
        $('#statusFilter').on('change', function() {
            const value = $(this).val();
            const table = $('.js-datatable').DataTable();
            
            if (value === 'all') {
                table.column(4).search('').draw();
            } else {
                table.column(4).search(value === 'active' ? 'Active' : 'Inactive').draw();
            }
        });
        
        // Handle edit role modal
        $('.edit-role').on('click', function (event) {
            const role = JSON.parse($(this).attr('data-details'))
            $('#edit_role_id').val(role.id);
            $('#edit_role_name').val(role.name);
            $('#edit_role_description').val(role.description);
            $('#edit_role_type').val(role.type);
            $('#edit_role_status').prop('checked', role.status);
            if (role.permissions) {
                // Reset all checkboxes
                $('input[name="permissions[]"]').prop('checked', false);
                // Check the permissions this role has
                role.permissions.forEach(permissionId => {
                    $(`#edit_permission_${permissionId}`).prop('checked', true);
                });
            }
            $('#editRoleModal').modal('show');
        });
        
        // Handle delete role modal
        $('.delete-role').on('click', function (event) {
            const role = JSON.parse($(this).attr('data-details'))
            $('#deleteRoleId').val(role.id);
            $('#deleteRoleName').text(role.name);
            
            // Reset confirmation input
            $('#deleteConfirmation').val('');
            $('#confirmDeleteBtn').prop('disabled', true);
            $('#deleteRoleModal').modal('show');
        });
    });
</script>
@endpush 