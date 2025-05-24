<!-- Bulk Actions -->
<div class="mb-4">
    <div class="d-flex gap-2 align-items-center">
        <select class="form-select form-select-sm w-auto" id="bulkAction">
            <option value="">Bulk Actions</option>
            <option value="approve">Approve Selected</option>
            <option value="reject">Reject Selected</option>
            <option value="export">Export Selected</option>
        </select>
        <button class="btn btn-sm btn-primary" id="applyBulkAction" disabled>Apply</button>
        <div class="ms-3 text-muted">
            <span id="selectedCount">0</span> items selected
        </div>
    </div>
</div>

<div class="table-responsive datatable-custom">
    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
        <thead class="thead-light">
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAllRows">
                    </div>
                </th>
                <th>Submission ID</th>
                <th>Entity Name</th>
                <th>Type</th>
                <th>Documents</th>
                <th>Submitted Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <!-- Consumer Example - Pending -->
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="1">
                    </div>
                </td>
                <td>#KYC-1001</td>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="avatar avatar-circle avatar-soft-primary">
                            J
                        </span>
                        <div class="ms-3">
                            <span class="d-block h5 text-inherit mb-0">John Smith</span>
                            <span class="d-block fs-5 text-body">john.smith@example.com</span>
                        </div>
                    </div>
                </td>
                <td>Consumer</td>
                <td>
                    <a href="{{ route('admin.compliance.kyc.view', 1) }}" class="btn btn-white btn-sm">
                        <i class="bi-file-earmark-text me-1"></i> View Documents
                    </a>
                </td>
                <td>Mar 15, 2024</td>
                <td>
                    <span class="badge bg-warning">Pending Review</span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.compliance.kyc.view', 1) }}" class="btn btn-white btn-sm">
                            <i class="bi-eye"></i> Review
                        </a>
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="bi-check"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="bi-x"></i> Reject
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Logistics Company Example - Approved -->
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="2">
                    </div>
                </td>
                <td>#KYC-1002</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-circle" src="https://via.placeholder.com/150" alt="Avatar">
                        <div class="ms-3">
                            <span class="d-block h5 text-inherit mb-0">FastTrack Logistics Ltd</span>
                            <span class="d-block fs-5 text-body">contact@fasttrack.com</span>
                        </div>
                    </div>
                </td>
                <td>Logistics</td>
                <td>
                    <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#documentPreviewModal2">
                        <i class="bi-file-earmark-text me-1"></i> View Documents
                    </button>
                </td>
                <td>Mar 10, 2024</td>
                <td>
                    <span class="badge bg-success">Approved</span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#reviewModal2">
                            <i class="bi-eye"></i> Review
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Insurance Company Example - Rejected -->
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="3">
                    </div>
                </td>
                <td>#KYC-1003</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-circle" src="https://via.placeholder.com/150" alt="Avatar">
                        <div class="ms-3">
                            <span class="d-block h5 text-inherit mb-0">SecureLife Insurance Co.</span>
                            <span class="d-block fs-5 text-body">compliance@securelife.com</span>
                        </div>
                    </div>
                </td>
                <td>Insurance</td>
                <td>
                    <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#documentPreviewModal3">
                        <i class="bi-file-earmark-text me-1"></i> View Documents
                    </button>
                </td>
                <td>Mar 8, 2024</td>
                <td>
                    <span class="badge bg-danger">Rejected</span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#reviewModal3">
                            <i class="bi-eye"></i> Review
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Corporate Consumer Example - Pending -->
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="4">
                    </div>
                </td>
                <td>#KYC-1004</td>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="avatar avatar-circle avatar-soft-success">
                            T
                        </span>
                        <div class="ms-3">
                            <span class="d-block h5 text-inherit mb-0">TechCorp Solutions</span>
                            <span class="d-block fs-5 text-body">admin@techcorp.com</span>
                        </div>
                    </div>
                </td>
                <td>Consumer (Corporate)</td>
                <td>
                    <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#documentPreviewModal4">
                        <i class="bi-file-earmark-text me-1"></i> View Documents
                    </button>
                </td>
                <td>Mar 14, 2024</td>
                <td>
                    <span class="badge bg-warning">Pending Review</span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#reviewModal4">
                            <i class="bi-eye"></i> Review
                        </button>
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="bi-check"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="bi-x"></i> Reject
                        </button>
                    </div>
                </td>
            </tr>

            <!-- International Logistics Example - In Progress -->
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="5">
                    </div>
                </td>
                <td>#KYC-1005</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-circle" src="https://via.placeholder.com/150" alt="Avatar">
                        <div class="ms-3">
                            <span class="d-block h5 text-inherit mb-0">Global Freight Masters</span>
                            <span class="d-block fs-5 text-body">operations@globalfreight.com</span>
                        </div>
                    </div>
                </td>
                <td>Logistics (International)</td>
                <td>
                    <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#documentPreviewModal5">
                        <i class="bi-file-earmark-text me-1"></i> View Documents
                    </button>
                </td>
                <td>Mar 13, 2024</td>
                <td>
                    <span class="badge bg-info">In Progress</span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#reviewModal5">
                            <i class="bi-eye"></i> Review
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Example Pagination -->
<div class="card-footer">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

@push('modals')
    <!-- Document Preview Modal Example -->
    <div class="modal fade" id="documentPreviewModal1" tabindex="-1" aria-labelledby="documentPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Document Preview - John Smith</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>ID Document</h6>
                            <img src="https://via.placeholder.com/400x300" class="img-fluid" alt="ID Document">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Proof of Address</h6>
                            <img src="https://via.placeholder.com/400x300" class="img-fluid" alt="Proof of Address">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal Example -->
    <div class="modal fade" id="reviewModal1" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Review Submission - John Smith</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6>Personal Information</h6>
                        <dl class="row">
                            <dt class="col-sm-3">Full Name</dt>
                            <dd class="col-sm-9">John Smith</dd>

                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">john.smith@example.com</dd>

                            <dt class="col-sm-3">Phone</dt>
                            <dd class="col-sm-9">+1 234 567 8900</dd>

                            <dt class="col-sm-3">Address</dt>
                            <dd class="col-sm-9">123 Main St, New York, NY 10001</dd>
                        </dl>
                    </div>

                    <div class="mb-4">
                        <h6>Verification Notes</h6>
                        <textarea class="form-control" rows="3" placeholder="Add review notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Approve</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Select All functionality
        $('#selectAllRows').change(function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
            updateSelectedCount();
        });

        // Individual checkbox change
        $('.row-checkbox').change(function() {
            updateSelectedCount();
            // Update "Select All" checkbox state
            $('#selectAllRows').prop('checked', 
                $('.row-checkbox').length === $('.row-checkbox:checked').length
            );
        });

        // Update selected count and bulk action button state
        function updateSelectedCount() {
            const selectedCount = $('.row-checkbox:checked').length;
            $('#selectedCount').text(selectedCount);
            $('#applyBulkAction').prop('disabled', selectedCount === 0);
        }

        // Bulk action handler
        $('#applyBulkAction').click(function() {
            const action = $('#bulkAction').val();
            const selectedIds = $('.row-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (!action || selectedIds.length === 0) return;

            // Handle different bulk actions
            switch(action) {
                case 'approve':
                    // Add approval logic
                    break;
                case 'reject':
                    // Add rejection logic
                    break;
                case 'export':
                    // Add export logic
                    break;
            }
        });
    });
</script>
@endpush 