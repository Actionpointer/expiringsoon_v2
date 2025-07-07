@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Team Members</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', 1) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Team Members</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inviteTeamMemberModal">
                        <i class="bi bi-person-plus me-2"></i>Invite Team Member
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            @include('store.settings.sidebar')
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            <!-- Team Overview Card -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4">
                    <h5 class="mb-4">Team Overview</h5>
                    <div class="row">
                        <div class="col-md-3 col-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <h2 class="mb-1">5</h2>
                                <p class="text-muted mb-0">Total Members</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <h2 class="mb-1">1</h2>
                                <p class="text-muted mb-0">Admins</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h2 class="mb-1">3</h2>
                                <p class="text-muted mb-0">Staff</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h2 class="mb-1">1</h2>
                                <p class="text-muted mb-0">Pending Invites</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Members List -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Active Team Members</h4>
                        <div class="d-flex align-items-center">
                            <div class="input-group me-2">
                                <input type="text" class="form-control" placeholder="Search members..." aria-label="Search members">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-funnel me-1"></i>Filter
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="#">All Members</a></li>
                                    <li><a class="dropdown-item" href="#">Admins</a></li>
                                    <li><a class="dropdown-item" href="#">Staff</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Recently Added</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th class="text-nowrap">Joined</th>
                                    <th class="text-nowrap">Last Active</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Owner -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="https://placehold.co/128" alt="User Avatar" class="avatar avatar-md rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">John Doe</h6>
                                                <small class="text-muted">johndoe@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark">Owner</span>
                                    </td>
                                    <td class="text-nowrap">Jan 15, 2023</td>
                                    <td class="text-nowrap">Just now</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewStaffModal" data-id="1">View Profile</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Admin -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="https://placehold.co/128" alt="User Avatar" class="avatar avatar-md rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Sarah Johnson</h6>
                                                <small class="text-muted">sarah@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">Admin</span>
                                    </td>
                                    <td class="text-nowrap">Feb 10, 2023</td>
                                    <td class="text-nowrap">2 hours ago</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewStaffModal" data-id="2">View Profile</a></li>
                                                <li><a class="dropdown-item text-warning" href="#">Disable Access</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Remove</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Staff -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="https://placehold.co/128" alt="User Avatar" class="avatar avatar-md rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Michael Williams</h6>
                                                <small class="text-muted">michael@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Support Staff</span>
                                    </td>
                                    <td class="text-nowrap">Mar 22, 2023</td>
                                    <td class="text-nowrap">Yesterday</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewStaffModal" data-id="3">View Profile</a></li>
                                                <li><a class="dropdown-item text-warning" href="#">Disable Access</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Remove</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="https://placehold.co/128" alt="User Avatar" class="avatar avatar-md rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Emily Chen</h6>
                                                <small class="text-muted">emily@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Inventory Manager</span>
                                    </td>
                                    <td class="text-nowrap">Apr 5, 2023</td>
                                    <td class="text-nowrap">3 days ago</td>
                                    <td>
                                        <span class="badge bg-warning">Away</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton4">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewStaffModal" data-id="4">View Profile</a></li>
                                                <li><a class="dropdown-item text-warning" href="#">Disable Access</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Remove</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending Invites -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Pending Invitations</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-nowrap">Invited By</th>
                                    <th class="text-nowrap">Invited On</th>
                                    <th class="text-nowrap">Expires</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>david.lee@example.com</td>
                                    <td>
                                        <span class="badge bg-info">Marketing Specialist</span>
                                    </td>
                                    <td class="text-nowrap">John Doe</td>
                                    <td class="text-nowrap">May 12, 2023</td>
                                    <td class="text-nowrap">May 19, 2023</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary">Resend</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invite Team Member Modal -->
<div class="modal fade" id="inviteTeamMemberModal" tabindex="-1" aria-labelledby="inviteTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteTeamMemberModalLabel">Invite Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inviteTeamMemberForm">
                    <div class="alert alert-info mb-4">
                        <div class="d-flex">
                            <i class="bi bi-info-circle fs-4 me-2"></i>
                            <div>
                                <p class="mb-0">New team members will receive an email invitation. They'll be asked to create an account or log in if they already have one.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="inviteEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="inviteEmail" name="email" placeholder="colleague@example.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="inviteRole" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="inviteRole" name="role" required>
                            <option value="" selected disabled>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="support_staff">Support Staff</option>
                            <option value="inventory_manager">Inventory Manager</option>
                            <option value="order_manager">Order Manager</option>
                            <option value="marketing_specialist">Marketing Specialist</option>
                        </select>
                        <div class="form-text">This determines what permissions they'll have in your store.</div>
                    </div>

                    <div class="mb-4">
                        <label for="inviteMessage" class="form-label">Personal Message (Optional)</label>
                        <textarea class="form-control" id="inviteMessage" name="message" rows="3" placeholder="Add a personal note to your invitation..."></textarea>
                    </div>

                    <div class="border-top pt-4 mt-4">
                        <h5 class="mb-3">Permissions</h5>
                        <p class="text-muted mb-3">Select the permissions for this team member:</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Products & Inventory</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_view_products" name="permissions[]" value="view_products">
                                        <label class="form-check-label" for="perm_view_products">View products</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_create_products" name="permissions[]" value="create_products">
                                        <label class="form-check-label" for="perm_create_products">Create products</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_edit_products" name="permissions[]" value="edit_products">
                                        <label class="form-check-label" for="perm_edit_products">Edit products</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_delete_products" name="permissions[]" value="delete_products">
                                        <label class="form-check-label" for="perm_delete_products">Delete products</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_manage_inventory" name="permissions[]" value="manage_inventory">
                                        <label class="form-check-label" for="perm_manage_inventory">Manage inventory</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Orders</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_view_orders" name="permissions[]" value="view_orders">
                                        <label class="form-check-label" for="perm_view_orders">View orders</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_process_orders" name="permissions[]" value="process_orders">
                                        <label class="form-check-label" for="perm_process_orders">Process orders</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_refund_orders" name="permissions[]" value="refund_orders">
                                        <label class="form-check-label" for="perm_refund_orders">Issue refunds</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Customers</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_view_customers" name="permissions[]" value="view_customers">
                                        <label class="form-check-label" for="perm_view_customers">View customers</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_edit_customers" name="permissions[]" value="edit_customers">
                                        <label class="form-check-label" for="perm_edit_customers">Edit customers</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Marketing</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_manage_discounts" name="permissions[]" value="manage_discounts">
                                        <label class="form-check-label" for="perm_manage_discounts">Manage discounts</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_send_emails" name="permissions[]" value="send_emails">
                                        <label class="form-check-label" for="perm_send_emails">Send marketing emails</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold">Store Settings</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_view_analytics" name="permissions[]" value="view_analytics">
                                        <label class="form-check-label" for="perm_view_analytics">View analytics</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_manage_team" name="permissions[]" value="manage_team">
                                        <label class="form-check-label" for="perm_manage_team">Manage team members</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-check" type="checkbox" id="perm_edit_settings" name="permissions[]" value="edit_settings">
                                        <label class="form-check-label" for="perm_edit_settings">Edit store settings</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Send Invitation</button>
            </div>
        </div>
    </div>
</div>

<!-- Staff Profile Modal -->
<div class="modal fade" id="viewStaffModal" tabindex="-1" aria-labelledby="viewStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStaffModalLabel">Staff Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img src="https://placehold.co/200" alt="Staff Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                        <h5 class="staff-name mb-1">Sarah Johnson</h5>
                        <p class="text-muted staff-email mb-2">sarah@example.com</p>
                        <span class="badge bg-primary staff-role mb-3">Admin</span>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-success staff-status me-2">Active</span>
                            <span class="text-muted staff-joined">Joined Feb 10, 2023</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-tabs" id="staffProfileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions-tab-pane" type="button" role="tab" aria-controls="permissions-tab-pane" aria-selected="true">Permissions</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity-tab-pane" type="button" role="tab" aria-controls="activity-tab-pane" aria-selected="false">Recent Activity</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-3" id="staffProfileTabsContent">
                            <div class="tab-pane fade show active" id="permissions-tab-pane" role="tabpanel" aria-labelledby="permissions-tab" tabindex="0">
                                <form id="staffPermissionsForm">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Manage Permissions</h6>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary me-2" id="selectAllPermissions">Select All</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllPermissions">Deselect All</button>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Products & Inventory</h6>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_view_products" name="staff_permissions[]" value="view_products">
                                                    <label class="form-check-label" for="staff_perm_view_products">View products</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_create_products" name="staff_permissions[]" value="create_products">
                                                    <label class="form-check-label" for="staff_perm_create_products">Create products</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_edit_products" name="staff_permissions[]" value="edit_products">
                                                    <label class="form-check-label" for="staff_perm_edit_products">Edit products</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_delete_products" name="staff_permissions[]" value="delete_products">
                                                    <label class="form-check-label" for="staff_perm_delete_products">Delete products</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_manage_inventory" name="staff_permissions[]" value="manage_inventory">
                                                    <label class="form-check-label" for="staff_perm_manage_inventory">Manage inventory</label>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Orders</h6>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_view_orders" name="staff_permissions[]" value="view_orders">
                                                    <label class="form-check-label" for="staff_perm_view_orders">View orders</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_process_orders" name="staff_permissions[]" value="process_orders">
                                                    <label class="form-check-label" for="staff_perm_process_orders">Process orders</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_refund_orders" name="staff_permissions[]" value="refund_orders">
                                                    <label class="form-check-label" for="staff_perm_refund_orders">Issue refunds</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Customers</h6>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_view_customers" name="staff_permissions[]" value="view_customers">
                                                    <label class="form-check-label" for="staff_perm_view_customers">View customers</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_edit_customers" name="staff_permissions[]" value="edit_customers">
                                                    <label class="form-check-label" for="staff_perm_edit_customers">Edit customers</label>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Marketing</h6>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_manage_discounts" name="staff_permissions[]" value="manage_discounts">
                                                    <label class="form-check-label" for="staff_perm_manage_discounts">Manage discounts</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_send_emails" name="staff_permissions[]" value="send_emails">
                                                    <label class="form-check-label" for="staff_perm_send_emails">Send marketing emails</label>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <h6 class="fw-bold">Store Settings</h6>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_view_analytics" name="staff_permissions[]" value="view_analytics">
                                                    <label class="form-check-label" for="staff_perm_view_analytics">View analytics</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_manage_team" name="staff_permissions[]" value="manage_team">
                                                    <label class="form-check-label" for="staff_perm_manage_team">Manage team members</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input staff-permission-check" type="checkbox" id="staff_perm_edit_settings" name="staff_permissions[]" value="edit_settings">
                                                    <label class="form-check-label" for="staff_perm_edit_settings">Edit store settings</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="activity-tab-pane" role="tabpanel" aria-labelledby="activity-tab" tabindex="0">
                                <div class="timeline">
                                    <div class="timeline-item pb-3">
                                        <div class="d-flex">
                                            <div class="timeline-indicator bg-primary me-3 mt-1">
                                                <i class="bi bi-check-circle-fill text-white small"></i>
                                            </div>
                                            <div>
                                                <p class="mb-1 fw-bold">Processed Order #12345</p>
                                                <p class="text-muted small mb-0">Today at 10:30 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item pb-3">
                                        <div class="d-flex">
                                            <div class="timeline-indicator bg-success me-3 mt-1">
                                                <i class="bi bi-plus-circle-fill text-white small"></i>
                                            </div>
                                            <div>
                                                <p class="mb-1 fw-bold">Added 3 new products</p>
                                                <p class="text-muted small mb-0">Yesterday at 2:15 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="d-flex">
                                            <div class="timeline-indicator bg-info me-3 mt-1">
                                                <i class="bi bi-gear-fill text-white small"></i>
                                            </div>
                                            <div>
                                                <p class="mb-1 fw-bold">Updated shipping settings</p>
                                                <p class="text-muted small mb-0">May 15, 2023 at 11:45 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="me-auto">
                    <button type="button" class="btn btn-warning btn-sm" id="toggleStaffStatus">Disable Access</button>
                    <button type="button" class="btn btn-danger btn-sm" id="removeStaffBtn">Remove Staff</button>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveStaffPermissions">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Define permissions by role
    const rolePermissions = {
        admin: [
            'view_products', 'create_products', 'edit_products', 'delete_products', 'manage_inventory',
            'view_orders', 'process_orders', 'refund_orders',
            'view_customers', 'edit_customers',
            'manage_discounts', 'send_emails',
            'view_analytics', 'manage_team', 'edit_settings'
        ],
        support_staff: [
            'view_products', 'view_orders', 'process_orders',
            'view_customers'
        ],
        inventory_manager: [
            'view_products', 'create_products', 'edit_products', 'manage_inventory',
            'view_orders'
        ],
        order_manager: [
            'view_products', 'view_orders', 'process_orders', 'refund_orders',
            'view_customers'
        ],
        marketing_specialist: [
            'view_products',
            'view_customers',
            'manage_discounts', 'send_emails',
            'view_analytics'
        ]
    };

    // Update permissions based on selected role
    document.getElementById('inviteRole').addEventListener('change', function() {
        const selectedRole = this.value;
        
        // Uncheck all permissions first
        document.querySelectorAll('.permission-check').forEach(function(checkbox) {
            checkbox.checked = false;
        });
        
        // Check permissions based on selected role
        if (selectedRole && rolePermissions[selectedRole]) {
            rolePermissions[selectedRole].forEach(function(permission) {
                const checkbox = document.getElementById('perm_' + permission);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        }
    });

    // Initialize staff profile modal
    const viewStaffModal = document.getElementById('viewStaffModal');
    if (viewStaffModal) {
        viewStaffModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const staffId = button.getAttribute('data-id');
            
            // Here you would typically fetch staff data from the server
            // For this example, we'll use mock data based on the staff ID
            let staffData = {};
            
            switch(staffId) {
                case "1":
                    staffData = {
                        name: "John Doe",
                        email: "johndoe@example.com",
                        role: "Owner",
                        roleClass: "bg-dark",
                        status: "Active",
                        statusClass: "bg-success",
                        joined: "Jan 15, 2023",
                        permissions: rolePermissions.admin
                    };
                    break;
                case "2":
                    staffData = {
                        name: "Sarah Johnson",
                        email: "sarah@example.com",
                        role: "Admin",
                        roleClass: "bg-primary",
                        status: "Active",
                        statusClass: "bg-success",
                        joined: "Feb 10, 2023",
                        permissions: rolePermissions.admin
                    };
                    break;
                case "3":
                    staffData = {
                        name: "Michael Williams",
                        email: "michael@example.com",
                        role: "Support Staff",
                        roleClass: "bg-info",
                        status: "Active",
                        statusClass: "bg-success",
                        joined: "Mar 22, 2023",
                        permissions: rolePermissions.support_staff
                    };
                    break;
                case "4":
                    staffData = {
                        name: "Emily Chen",
                        email: "emily@example.com",
                        role: "Inventory Manager",
                        roleClass: "bg-info",
                        status: "Away",
                        statusClass: "bg-warning",
                        joined: "Apr 5, 2023",
                        permissions: rolePermissions.inventory_manager
                    };
                    break;
                default:
                    staffData = {
                        name: "Unknown Staff",
                        email: "unknown@example.com",
                        role: "Staff",
                        roleClass: "bg-secondary",
                        status: "Unknown",
                        statusClass: "bg-secondary",
                        joined: "Unknown",
                        permissions: []
                    };
            }
            
            // Update modal with staff data
            const modal = this;
            modal.querySelector('.staff-name').textContent = staffData.name;
            modal.querySelector('.staff-email').textContent = staffData.email;
            modal.querySelector('.staff-role').textContent = staffData.role;
            modal.querySelector('.staff-role').className = `badge ${staffData.roleClass} staff-role mb-3`;
            modal.querySelector('.staff-status').textContent = staffData.status;
            modal.querySelector('.staff-status').className = `badge ${staffData.statusClass} staff-status me-2`;
            modal.querySelector('.staff-joined').textContent = `Joined ${staffData.joined}`;
            
            // Update toggle status button text based on current status
            const toggleBtn = modal.querySelector('#toggleStaffStatus');
            if (staffData.status === 'Active') {
                toggleBtn.textContent = 'Disable Access';
                toggleBtn.className = 'btn btn-warning btn-sm';
            } else {
                toggleBtn.textContent = 'Enable Access';
                toggleBtn.className = 'btn btn-success btn-sm';
            }
            
            // For owner, disable the remove button
            const removeBtn = modal.querySelector('#removeStaffBtn');
            if (staffData.role === 'Owner') {
                removeBtn.disabled = true;
                removeBtn.title = 'Owner cannot be removed';
                toggleBtn.disabled = true;
                toggleBtn.title = 'Owner status cannot be changed';
            } else {
                removeBtn.disabled = false;
                removeBtn.title = '';
                toggleBtn.disabled = false;
                toggleBtn.title = '';
            }
            
            // Uncheck all permissions first
            modal.querySelectorAll('.staff-permission-check').forEach(function(checkbox) {
                checkbox.checked = false;
                
                // For owner, disable all permission checkboxes
                if (staffData.role === 'Owner') {
                    checkbox.disabled = true;
                } else {
                    checkbox.disabled = false;
                }
            });
            
            // Check permissions based on staff role
            if (staffData.permissions) {
                staffData.permissions.forEach(function(permission) {
                    const checkbox = modal.querySelector(`#staff_perm_${permission}`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }
        });
    }

    // Select/Deselect all permissions in staff modal
    document.getElementById('selectAllPermissions')?.addEventListener('click', function() {
        document.querySelectorAll('.staff-permission-check:not([disabled])').forEach(function(checkbox) {
            checkbox.checked = true;
        });
    });

    document.getElementById('deselectAllPermissions')?.addEventListener('click', function() {
        document.querySelectorAll('.staff-permission-check:not([disabled])').forEach(function(checkbox) {
            checkbox.checked = false;
        });
    });

    // Handle save permissions button
    document.getElementById('saveStaffPermissions')?.addEventListener('click', function() {
        // Get all checked permissions
        const checkedPermissions = [];
        document.querySelectorAll('.staff-permission-check:checked').forEach(function(checkbox) {
            checkedPermissions.push(checkbox.value);
        });
        
        // Here you would send the updated permissions to the server
        console.log('Saving permissions:', checkedPermissions);
        
        // Show success message
        alert('Permissions updated successfully!');
        
        // Close the modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('viewStaffModal'));
        modal.hide();
    });

    // Handle toggle staff status
    document.getElementById('toggleStaffStatus')?.addEventListener('click', function() {
        const currentStatus = document.querySelector('.staff-status').textContent;
        const newStatus = currentStatus === 'Active' ? 'Disabled' : 'Active';
        const confirmMessage = currentStatus === 'Active' 
            ? 'Are you sure you want to disable this staff member? They will no longer be able to access your store.'
            : 'Are you sure you want to enable this staff member? They will regain access to your store.';
            
        if (confirm(confirmMessage)) {
            // Here you would send the status change to the server
            console.log('Changing status to:', newStatus);
            
            // Update UI
            document.querySelector('.staff-status').textContent = newStatus;
            
            if (newStatus === 'Active') {
                document.querySelector('.staff-status').className = 'badge bg-success staff-status me-2';
                this.textContent = 'Disable Access';
                this.className = 'btn btn-warning btn-sm';
            } else {
                document.querySelector('.staff-status').className = 'badge bg-danger staff-status me-2';
                this.textContent = 'Enable Access';
                this.className = 'btn btn-success btn-sm';
            }
        }
    });

    // Handle remove staff
    document.getElementById('removeStaffBtn')?.addEventListener('click', function() {
        const staffName = document.querySelector('.staff-name').textContent;
        
        if (confirm(`Are you sure you want to remove ${staffName} from your team? This action cannot be undone.`)) {
            // Here you would send the remove request to the server
            console.log('Removing staff member');
            
            // Close the modal and refresh the page
            const modal = bootstrap.Modal.getInstance(document.getElementById('viewStaffModal'));
            modal.hide();
            
            // For demo purposes, just show an alert
            alert(`${staffName} has been removed from your team.`);
            // In a real application, you would refresh the page or update the UI
        }
    });
</script>
@endpush 