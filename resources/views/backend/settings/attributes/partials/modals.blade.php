<!-- Add Attribute Modal -->
<div class="modal fade" id="addAttributeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Attribute</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addAttributeForm" action="{{ route('admin.settings.attributes.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Attribute Name</label>
                        <input type="text" name="name" class="form-control" required maxlength="50" 
                            placeholder="Color, Size, Material, etc.">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Options (Optional)</label>
                        <input type="text" name="options" id="add-options" class="form-control" 
                            placeholder="Red, Blue, Green, etc. (comma separated)">
                        <small class="form-text text-muted">Enter comma-separated options for this attribute</small>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeStatus" name="is_active" value="1" checked>
                        <label class="form-check-label">Active Status</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addAttributeForm" class="btn btn-primary">Create Attribute</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Attribute Modal -->
<div class="modal fade" id="editAttributeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attribute</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editAttributeForm" action="{{ route('admin.settings.attributes.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="attribute_id" id="edit-id">
                    
                    <div class="mb-4">
                        <label class="form-label">Attribute Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required maxlength="50">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Options (Optional)</label>
                        <input type="text" name="options" id="edit-options" class="form-control" 
                            placeholder="Red, Blue, Green, etc. (comma separated)">
                        <small class="form-text text-muted">Enter comma-separated options for this attribute</small>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="editActiveStatus" name="is_active" value="1">
                        <label class="form-check-label">Active Status</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editAttributeForm" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Attribute Modal -->
<div class="modal fade" id="deleteAttributeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Attribute</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5>Are you sure?</h5>
                <p>You're about to delete <span id="delete-attribute-name" class="fw-bold"></span>.</p>
                <p class="text-danger">This will also remove all product options using this attribute.</p>
                <form id="deleteAttributeForm" action="{{ route('admin.settings.attributes.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="attribute_id" id="delete-attribute-id">
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteAttributeForm" class="btn btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
</div> 