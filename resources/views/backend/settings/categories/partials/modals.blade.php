<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm" action="{{ route('admin.settings.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Category Image -->
                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <label class="avatar avatar-xl avatar-circle" for="categoryImageInput">
                                <img id="categoryImagePreview" class="avatar-img" src="{{ asset('images/160x160/img1.jpg') }}" alt="Category Image">
                            </label>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-ghost-secondary">Delete</button>
                            </div>
                        </div>
                        
                        <input type="file" name="photo" class="js-file-attach d-none" id="categoryImageInput"
                               data-hs-file-attach-options='{
                                    "textTarget": "#categoryImagePreview",
                                    "mode": "image",
                                    "targetAttr": "src"
                               }'>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" required maxlength="50">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Group</label>
                        <select name="group_by" class="js-select form-select"
                            data-hs-tom-select-options='{
                                "placeholder": "Select group...",
                                "hideSearch": false,
                                "create": true
                            }'>
                            <option value="">Select Group</option>
                            <option value="Food & Beverages">Food & Beverages</option>
                            <option value="Health & Wellness Products">Health & Wellness Products</option>
                            <option value="Cosmetics & Beauty Products">Cosmetics & Beauty Products</option>
                            <option value="Cleaning & Household Products">Cleaning & Household Products</option>
                            <option value="Pet Products">Pet Products</option>
                            <option value="Medical Supplies">Medical Supplies</option>
                            <option value="Electronics & Accessories">Electronics & Accessories</option>
                            <option value="Hobby & Craft Supplies">Hobby & Craft Supplies</option>
                            <option value="Tobacco & Vaping Products">Tobacco & Vaping Products</option>
                            <option value="Automotive Products">Automotive Products</option>
                            <option value="Office & School Supplies">Office & School Supplies</option>
                            <option value="Miscellaneous">Miscellaneous</option>
                        </select>
                        <small class="form-text text-muted">Type to add a new group</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeStatus" name="is_active" value="1" checked>
                        <label class="form-check-label">Active Status</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addCategoryForm" class="btn btn-primary">Create Category</button>
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
                <form id="editCategoryForm" action="{{ route('admin.settings.categories.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Category Image -->
                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <label class="avatar avatar-xl avatar-circle" for="editCategoryImageInput">
                                <img id="editCategoryImagePreview" class="avatar-img" src="{{ asset('images/160x160/img1.jpg') }}" alt="Category Image">
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
                        
                        <input type="file" name="photo" class="js-file-attach d-none" id="editCategoryImageInput"
                               data-hs-file-attach-options='{
                                    "textTarget": "#editCategoryImagePreview",
                                    "mode": "image",
                                    "targetAttr": "src"
                               }'>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required maxlength="50">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Group</label>
                        <select name="group_by" id="edit-group_by" class="js-select form-select"
                            data-hs-tom-select-options='{
                                "placeholder": "Select group...",
                                "hideSearch": false,
                                "create": true
                            }'>
                            <option value="">Select Group</option>
                            <option value="Food & Beverages">Food & Beverages</option>
                            <option value="Health & Wellness Products">Health & Wellness Products</option>
                            <option value="Cosmetics & Beauty Products">Cosmetics & Beauty Products</option>
                            <option value="Cleaning & Household Products">Cleaning & Household Products</option>
                            <option value="Pet Products">Pet Products</option>
                            <option value="Medical Supplies">Medical Supplies</option>
                            <option value="Electronics & Accessories">Electronics & Accessories</option>
                            <option value="Hobby & Craft Supplies">Hobby & Craft Supplies</option>
                            <option value="Tobacco & Vaping Products">Tobacco & Vaping Products</option>
                            <option value="Automotive Products">Automotive Products</option>
                            <option value="Office & School Supplies">Office & School Supplies</option>
                            <option value="Miscellaneous">Miscellaneous</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="editActiveStatus" name="is_active" value="1">
                        <label class="form-check-label">Active Status</label>
                    </div>
                    
                    <input type="hidden" name="category_id" id="edit-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editCategoryForm" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5>Are you sure?</h5>
                <p>You're about to delete <span id="delete-category-name" class="fw-bold"></span>. This action cannot be undone.</p>
                <form id="deleteCategoryForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="category_id" id="delete-category-id">
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteCategoryForm" class="btn btn-danger">Yes, Delete</button>
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