<div class="tab-pane fade show active" id="locations">
    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                </div>
                <input id="locationSearch" type="text" class="form-control" placeholder="Search locations...">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row justify-content-sm-end">
                <div class="col-sm-auto">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- States Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header-title">States</h5>
                        <span class="badge bg-soft-dark ms-2">Total: 37</span>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatesModal">
                        <i class="bi-gear"></i> Manage States
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- States List -->
            <div class="table-responsive datatable-custom">
                <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                         "order": [],
                         "pageLength": 12,
                         "isResponsive": false,
                         "isShowPaging": true
                       }'>
                    <thead class="thead-light">
                        <tr>
                            <th>State</th>
                            <th>Cities</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span>Lagos</span>
                                    <span class="badge bg-soft-primary ms-2">Popular</span>
                                </div>
                            </td>
                            <td>
                                <span class="d-block h5 mb-0">20 Cities</span>
                                <span class="d-block fs-6 text-body">18 Active</span>
                            </td>
                            <td>
                                <span class="d-block h5 mb-0">2 days ago</span>
                                <span class="d-block fs-6 text-body">via Google Places</span>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="stateStatus1" checked>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#viewCitiesModal" 
                                        data-state="Lagos">
                                    <i class="bi-building"></i> View Cities
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Update States Modal -->
<div class="modal fade" id="updateStatesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage States</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-soft-info">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi-info-circle"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            States and cities are automatically updated from Google Places API when users add addresses.
                            You can manage their visibility and status here.
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="autoUpdateLocations" checked>
                                <label class="form-check-label">Auto-update from Google Places</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="autoActivateLocations" checked>
                                <label class="form-check-label">Auto-activate new locations</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Popular States</label>
                    <select class="form-select" multiple data-tom-select>
                        <option value="lagos" selected>Lagos</option>
                        <option value="abuja">Abuja</option>
                        <option value="rivers">Rivers</option>
                    </select>
                    <small class="form-text">These states will be prioritized in dropdowns and searches</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- View Cities Modal -->
<div class="modal fade" id="viewCitiesModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cities in Lagos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Cities Search -->
                <div class="mb-4">
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend input-group-text">
                            <i class="bi-search"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="Search cities...">
                    </div>
                </div>

                <!-- Cities Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    <div class="col mb-3">
                        <div class="card card-body">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="cityIkeja" checked>
                                <label class="form-check-label">Ikeja</label>
                            </div>
                            <small class="text-muted">Last updated: 2 days ago</small>
                        </div>
                    </div>
                    <!-- More city cards -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize datatables for better performance with large datasets
        $('.js-datatable').each(function () {
            $.HSCore.components.HSDatatables.init($(this));
        });

        // Initialize tom-select for better UX on select boxes
        HSCore.components.HSTomSelect.init('.js-select')
    });
</script>
@endpush 