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
            @include('livewire.store.settings.sidebar',['store'=> $store])
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
                        
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-8">                        
                            <div class="input-group me-2">
                                <input type="text" class="form-control" placeholder="Search members..." aria-label="Search members">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown col-md-4 d-flex justify-content-end">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-funnel me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item" href="#">All Members</a></li>
                                <li><a class="dropdown-item" href="#">Admins</a></li>
                                <li><a class="dropdown-item" href="#">Staff</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Recently Added</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th class="text-nowrap">Joined</th>
                                    <th class="text-nowrap">Last Active</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <img src="{{ $member->user->profile_photo_url ?? 'https://placehold.co/128' }}" alt="User Avatar" class="avatar avatar-md rounded-circle">
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $member->user->name }}</h6>
                                                    <small class="text-muted">{{ $member->user->email }}</small>
                                                    <small class="text-muted">
                                                        {{ 'Role: ' . ($memberRoleNames[$member->user_id] ?? 'N/A') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">{{ $member->created_at ? $member->created_at->format('M d, Y') : '-' }}</td>
                                        <td class="text-nowrap">-</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $member->user_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $member->user_id }}">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewStaffModal" data-id="{{ $member->user_id }}" wire:click.prevent="showProfile({{ $member->user_id }})">View Profile</a></li>
                                                    <li><a class="dropdown-item text-warning" href="#">Disable Access</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#">Remove</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">No active team members found.</td></tr>
                                @endforelse
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
                                @forelse($invitees as $invitee)
                                    <tr>
                                        <td>{{ $invitee->user->email }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $memberRoleNames[$invitee->user_id] ?? 'Staff' }}</span>
                                        </td>
                                        <td class="text-nowrap">-</td>
                                        <td class="text-nowrap">{{ $invitee->created_at ? $invitee->created_at->format('M d, Y') : '-' }}</td>
                                        <td class="text-nowrap">-</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">Resend</button>
                                                <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">No pending invitations found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invite Team Member Modal -->
    <div wire:ignore.self class="modal fade" id="inviteTeamMemberModal" tabindex="-1" aria-labelledby="inviteTeamMemberModalLabel" aria-hidden="true">
        <div wire:ignore.self class="modal-dialog modal-lg">
            <form id="inviteTeamMemberForm" wire:submit.prevent="inviteTeamMember">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inviteTeamMemberModalLabel">Invite Team Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                            <div class="alert {{$modal_error ? 'alert-danger':'alert-info'}} mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-light-circle fs-4 me-2"></i>
                                    <div>
                                        <p class="mb-0">
                                            {{ $modal_error ?? "New team members will receive an email invitation. They will be asked to create an account or log in if they already have one"}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="inviteEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="inviteEmail" name="email" placeholder="colleague@example.com" wire:model.defer="inviteEmail" required>
                                @error('inviteEmail') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="inviteRole" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select" id="inviteRole" name="role" wire:model="inviteRole" wire:change="selectedInviteRole($event.target.value)" required>
                                    <option value="" selected disabled>Select role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">This determines what permissions they'll have in your store.</div>
                                @error('inviteRole') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="inviteMessage" class="form-label">Personal Message (Optional)</label>
                                <textarea class="form-control" id="inviteMessage" name="message" rows="3" placeholder="Add a personal note to your invitation..." wire:model.defer="inviteMessage"></textarea>
                            </div>

                            <div class="border-top pt-4 mt-4">
                                <h5 class="mb-3">Permissions</h5>
                                <p class="text-muted mb-3">Select the permissions for this team member:</p>
                                <div class="row">
                                    @foreach($permissionsByCategory as $category => $permissions)
                                        <div class="col-md-6 mb-3">
                                            <h6 class="fw-bold">{{ ucwords(str_replace('_', ' ', $category)) }}</h6>
                                            @foreach($permissions as $permission)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input permission-check" type="checkbox" id="perm_{{ $permission->id }}" value="{{ $permission->id }}" wire:model="invitePermissions">
                                                    <label class="form-check-label" for="perm_{{ $permission->id }}">{{ ucwords($permission->name) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Invitation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Staff Profile Modal -->
    <div class="modal fade" id="viewStaffModal" tabindex="-1" aria-labelledby="viewStaffModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStaffModalLabel">Staff Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($viewProfileUser)
                        <div class="row">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <img src="{{ $viewProfileUser->user->profile_photo_url ?? 'https://placehold.co/200' }}" alt="Staff Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                                <h5 class="staff-name mb-1">{{ $viewProfileUser->user->name }}</h5>
                                <p class="text-muted staff-email mb-2">{{ $viewProfileUser->user->email }}</p>
                                <span class="badge bg-primary staff-role mb-3">
                                    {{ 'Role: ' . ($memberRoleNames[$viewProfileUser->user_id] ?? 'N/A') }}
                                </span>
                                <div class="d-flex justify-content-center">
                                    <span class="badge bg-success staff-status me-2">{{ $viewProfileUser->status ?? 'Active' }}</span>
                                    <span class="text-muted staff-joined">Joined {{ $viewProfileUser->created_at ? $viewProfileUser->created_at->format('M d, Y') : '-' }}</span>
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
                                        <h6>Permissions</h6>
                                        @foreach($permissionsByCategory as $category => $permissions)
                                            <strong>{{ ucwords(str_replace('_', ' ', $category)) }}</strong>
                                            <ul>
                                                @if($viewProfileUser)
                                                    @foreach($permissions as $permission)
                                                        @if(in_array($permission->id, $viewProfileUser->pivot->permissions ?? []))
                                                            <li>{{ $permission->name }}</li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        @endforeach
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
                                            <!-- Add more activity items as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-muted">No profile selected.</div>
                    @endif
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
</div>