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
                    <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStateModal">
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
                            
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span>Lagos</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="d-block h5 mb-0">{{ $country->cities->count() }} Cities</span>
                                        <span class="d-block small text-body">18 Active</span>
                                    </div>
                                    
                                    <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#viewCitiesModal" 
                                            data-state="Lagos">
                                        <i class="bi-building"></i> View Cities
                                    </button>
                                </div>
                                
                            </td>
                            
                            <td>
                                <span class="badge bg-soft-primary">Popular</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editStateModal" 
                                        data-state="">
                                    <i class="bi-pen"></i> Edit
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#deleteStateModal" 
                                        data-state="">
                                    <i class="bi-trash "></i> Delete
                                </button>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
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