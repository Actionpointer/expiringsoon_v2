<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm">
                    <!-- Category Image -->
                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <label class="avatar avatar-xl avatar-circle" for="categoryImageInput">
                                <img id="categoryImagePreview" class="avatar-img" src="assets/img/160x160/img1.jpg" alt="Category Image">
                            </label>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-white avatar-uploader-trigger">
                                    Change Photo
                                </button>
                                <button type="button" class="btn btn-ghost-secondary">Delete</button>
                            </div>
                        </div>
                        
                        <input type="file" class="js-file-attach d-none" id="categoryImageInput"
                               data-hs-file-attach-options='{
                                    "textTarget": "#categoryImagePreview",
                                    "mode": "image",
                                    "targetAttr": "src"
                               }'>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Subcategories</label>
                        <select class="js-select form-select" multiple
                            data-hs-tom-select-options='{
                                "placeholder": "Select or add subcategories...",
                                "hideSearch": false,
                                "create": true
                            }'>
                            <option value="phones">Phones</option>
                            <option value="laptops">Laptops</option>
                            <option value="tablets">Tablets</option>
                            <option value="accessories">Accessories</option>
                        </select>
                        <small class="form-text text-muted">Type to add new subcategories</small>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeStatus" checked>
                        <label class="form-check-label">Active Status</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Category</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Same form as Add Category, but pre-populated -->
                <form id="editCategoryForm">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" value="Documents" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category Type</label>
                        <select class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="item" selected>Item</option>
                            <option value="vehicle">Vehicle</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" required>Letters, certificates, legal documents, printed materials</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <select class="js-select form-select" multiple
                            data-hs-tom-select-options='{
                                "placeholder": "Select or add tags..."
                            }'>
                            <option value="legal" selected>Legal</option>
                            <option value="paper" selected>Paper</option>
                            <option value="fragile">Fragile</option>
                            <option value="electronics">Electronics</option>
                        </select>
                        <small class="form-text text-muted">Type to add new tags</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi-file-earmark-text"></i>
                            </span>
                            <select class="form-select" required>
                                <option value="">Select Icon</option>
                                <option value="bi-file-earmark-text" selected>📄 Document</option>
                                <!-- Other icons... -->
                            </select>
                        </div>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="editActiveStatus" checked>
                        <label class="form-check-label">Active Status</label>
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

<!-- Manage Category Subcategories Modal -->
<div class="modal fade" id="manageCategorySubcatsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Subcategories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group input-group-merge mb-2">
                        <input type="text" class="form-control" placeholder="Add new subcategory">
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>Subcategory</th>
                                <th>Items</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Phones</td>
                                <td>85 items</td>
                                <td>
                                    <button type="button" class="btn btn-white btn-sm">
                                        <i class="bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- More subcategories... -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 