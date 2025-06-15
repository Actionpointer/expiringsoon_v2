<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addStaffForm">
                    <!-- Personal Info -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstname" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="surname" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" required>
                        <small class="form-text text-muted">Password will be sent to staff email</small>
                    </div>

                    <!-- Permissions -->
                    <div class="mb-4">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions->groupBy('category') as $category => $categoryPermissions)
                            <div class="col-sm-4 mb-4">
                                <h6 class="text-cap">{{ $category }}</h6>
                                @foreach($categoryPermissions as $permission)
                                <div class="form-check mb-2">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="permission_{{ $permission->id }}" 
                                           name="permissions[]" 
                                           value="{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ $permission->description }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="requirePasswordChange" name="require_password_change" checked>
                        <label class="form-check-label">Require Password Change</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeStatus" name="status" checked>
                        <label class="form-check-label">Active Status</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Staff</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Same form structure as Add Staff, but with pre-populated data -->
                <form id="editStaffForm">
                    <!-- Personal Info fields... -->
                    
                    <!-- Permissions -->
                    <div class="mb-4">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions->groupBy('category') as $category => $categoryPermissions)
                            <div class="col-sm-4 mb-4">
                                <h6 class="text-cap">{{ $category }}</h6>
                                @foreach($categoryPermissions as $permission)
                                <div class="form-check mb-2">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="edit_permission_{{ $permission->id }}" 
                                           name="permissions[]" 
                                           value="{{ $permission->id }}">
                                    <label class="form-check-label" for="edit_permission_{{ $permission->id }}">
                                        {{ $permission->description }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Status switches... -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Staff Modal -->
<div class="modal fade" id="deleteStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="deleteStaffForm">
                    <input type="hidden" name="staff_id" id="deleteStaffId">
                    
                    <div class="text-center mb-4">
                        <span class="avatar avatar-xxl avatar-circle mb-3">
                            <img id="deleteStaffAvatar" class="avatar-img" src="" alt="Staff Avatar">
                        </span>
                        <h4 id="deleteStaffName" class="text-danger"></h4>
                        <p id="deleteStaffEmail" class="text-body"></p>
                    </div>

                    <div class="alert alert-warning">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi-exclamation-triangle"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h5>Warning</h5>
                                <p class="mb-0">
                                    This action cannot be undone. This will permanently remove the staff member's access and all associated data.
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>Delete Staff</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Handle delete confirmation input
    document.getElementById('deleteConfirmation').addEventListener('input', function(e) {
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        confirmBtn.disabled = e.target.value !== 'DELETE';
    });

    // Function to populate delete modal
    function populateDeleteModal(staffId, name, email, avatar) {
        document.getElementById('deleteStaffId').value = staffId;
        document.getElementById('deleteStaffName').textContent = name;
        document.getElementById('deleteStaffEmail').textContent = email;
        document.getElementById('deleteStaffAvatar').src = avatar;
        
        // Reset confirmation
        document.getElementById('deleteConfirmation').value = '';
        document.getElementById('confirmDeleteBtn').disabled = true;
    }
</script>
@endpush 