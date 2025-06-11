<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="addRoleForm" action="{{ route('admin.settings.roles.store') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <!-- Role Info -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Role Name</label>
                            <input type="text" class="form-control" name="name" id="add_role_name" required>
                            <small class="form-text text-muted">Display name for this role</small>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Role Type</label>
                            <select class="form-select" name="type" id="add_role_type" required>
                                <option value="admin">Admin (Platform Staff)</option>
                                <option value="store">Store (Shop Staff)</option>
                            </select>
                            <small class="form-text text-muted">Where this role will be used</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="add_role_description" rows="2" required></textarea>
                        <small class="form-text text-muted">Brief explanation of this role's purpose</small>
                    </div>

                    <!-- Permissions -->
                    <div class="mb-4">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions->groupBy('category') as $category => $categoryPermissions)
                            <div class="col-sm-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="text-cap mb-0">{{ $category }}</h6>
                                    <div class="form-check form-check-sm">
                                        <input type="checkbox" class="form-check-input select-all-category" 
                                            data-category="{{ $category }}" id="selectAll_{{ Str::slug($category) }}">
                                        <label class="form-check-label small" for="selectAll_{{ Str::slug($category) }}">All</label>
                                    </div>
                                </div>
                                
                                <div class="border rounded-2 p-3">
                                    @foreach($categoryPermissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" 
                                            class="form-check-input permission-checkbox" 
                                            data-category="{{ $category }}"
                                            id="permission_{{ $permission->id }}" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}">
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->description }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="add_role_status" value="1" name="status" checked>
                        <label class="form-check-label">Active Status</label>
                        <div class="form-text">Inactive roles cannot be assigned to users</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="editRoleForm" action="{{ route('admin.settings.roles.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">               
                    <input type="hidden" name="role_id" id="edit_role_id">
                    
                    <!-- Role Info -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label for="edit_role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" name="name" id="edit_role_name" required>
                            <small class="form-text text-muted">Display name for this role</small>
                        </div>
                        <div class="col-sm-6">
                            <label for="edit_role_type" class="form-label">Role Type</label>
                            <select class="form-select" name="type" id="edit_role_type" required>
                                <option value="admin">Admin (Platform Staff)</option>
                                <option value="store">Store (Shop Owners)</option>
                            </select>
                            <small class="form-text text-muted">Where this role will be used</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_role_description" rows="2" required></textarea>
                        <small class="form-text text-muted">Brief explanation of this role's purpose</small>
                    </div>
                    
                    <!-- Permissions -->
                    <div class="mb-4">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions->groupBy('category') as $category => $categoryPermissions)
                            <div class="col-sm-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="text-cap mb-0">{{ $category }}</h6>
                                    <div class="form-check form-check-sm">
                                        <input type="checkbox" class="form-check-input select-all-category" 
                                            data-category="{{ $category }}" id="editSelectAll_{{ Str::slug($category) }}">
                                        <label class="form-check-label small" for="editSelectAll_{{ Str::slug($category) }}">All</label>
                                    </div>
                                </div>
                                
                                <div class="border rounded-2 p-3">
                                    @foreach($categoryPermissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" 
                                            class="form-check-input permission-checkbox" 
                                            data-category="{{ $category }}"
                                            id="edit_permission_{{ $permission->id }}" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}">
                                        <label class="form-check-label" for="edit_permission_{{ $permission->id }}">
                                            {{ $permission->description }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" value="1" id="edit_role_status" name="status">
                        <label class="form-check-label">Active Status</label>
                        <div class="form-text">Inactive roles cannot be assigned to users</div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="updateRoleBtn">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Role Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="deleteRoleForm" action="{{ route('admin.settings.roles.delete') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                        <input type="hidden" name="role_id" id="deleteRoleId">
                        
                        <div class="text-center mb-4">
                            <div class="avatar avatar-lg avatar-circle avatar-soft-danger mb-3">
                                <span class="avatar-initials" id="deleteRoleInitial"></span>
                            </div>
                            <h4 id="deleteRoleName" class="text-danger"></h4>
                        </div>

                        <div class="alert alert-warning">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi-exclamation-triangle"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h5>Warning</h5>
                                    <p class="mb-0">
                                        This action cannot be undone. This will permanently delete the role and remove it from all assigned users.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Type "DELETE" to confirm</label>
                            <input type="text" 
                                class="form-control" 
                                id="deleteConfirmation" 
                                placeholder="DELETE"
                                required>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>Delete Role</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle select all checkboxes
        $('.select-all-category').on('change', function() {
            const category = $(this).data('category');
            const isChecked = $(this).prop('checked');
            
            $(`.permission-checkbox[data-category="${category}"]`).prop('checked', isChecked);
        });
        
        // Update "select all" based on individual checkboxes
        $('.permission-checkbox').on('change', function() {
            const category = $(this).data('category');
            const totalCheckboxes = $(`.permission-checkbox[data-category="${category}"]`).length;
            const checkedCheckboxes = $(`.permission-checkbox[data-category="${category}"]:checked`).length;
            
            // If all checkboxes in this category are checked, check the "select all"
            $(`.select-all-category[data-category="${category}"]`).prop('checked', totalCheckboxes === checkedCheckboxes);
        });
        
        // Handle delete confirmation input
        $('#deleteConfirmation').on('input', function(e) {
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.disabled = e.target.value !== 'DELETE';
        }); 
    });
</script>
@endpush 