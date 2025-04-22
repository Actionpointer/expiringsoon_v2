@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Ticket #12345</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.support.tickets.index') }}" class="btn btn-secondary">
                    <i class="bi-arrow-left me-1"></i> Back to Tickets
                </a>
            </div>
        </div>
    </div>

    <!-- Ticket Details -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Subject: Issue with login</h5>
            <p><strong>Status:</strong> <span class="badge bg-soft-success text-success">Open</span></p>
            <p><strong>Priority:</strong> 
                <select class="form-select d-inline w-auto" id="prioritySelect">
                    <option value="high" selected>High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </p>
            <p><strong>Created At:</strong> 01 Jan 2024, 10:00 AM</p>
            <p><strong>Last Updated:</strong> 02 Jan 2024, 02:00 PM</p>
            <p><strong>Description:</strong> User is unable to log in with their credentials. The issue started after the recent update.</p>
            <button class="btn btn-warning mt-3" id="escalateButton">Escalate to Staff</button>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Message Thread</h5>
        </div>
        <div class="card-body">
            <div class="email-thread">
                <div class="email-item mb-4 border-bottom pb-3">
                    <div class="d-flex justify-content-between">
                        <h6><strong>Admin User</strong> <small class="text-muted">02 Jan 2024, 02:30 PM</small></h6>
                        <span class="badge bg-soft-primary text-primary">Admin</span>
                    </div>
                    <div class="email-content">
                        <p>Dear User,</p>
                        <p>We are looking into this issue and will update you shortly.</p>
                        <p>Best regards,<br>Admin Team</p>
                    </div>
                </div>
                <div class="email-item mb-4 border-bottom pb-3">
                    <div class="d-flex justify-content-between">
                        <h6><strong>Support Agent</strong> <small class="text-muted">02 Jan 2024, 03:00 PM</small></h6>
                        <span class="badge bg-soft-secondary text-secondary">Support</span>
                    </div>
                    <div class="email-content">
                        <p>Hello,</p>
                        <p>Can you please try resetting your password and let us know if the issue persists?</p>
                        <p>Thank you,<br>Support Team</p>
                    </div>
                </div>
                <div class="email-item mb-4 border-bottom pb-3">
                    <div class="d-flex justify-content-between">
                        <h6><strong>User</strong> <small class="text-muted">02 Jan 2024, 03:30 PM</small></h6>
                        <span class="badge bg-soft-info text-info">User</span>
                    </div>
                    <div class="email-content">
                        <p>Hi Support,</p>
                        <p>I have tried resetting the password, but the issue still exists.</p>
                        <p>Regards,<br>User</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Comment Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Compose Message</h5>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="emailContent" class="form-label">Message</label>
                    <textarea class="form-control" id="emailContent" name="content" rows="6" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('prioritySelect').addEventListener('change', function() {
        alert('Priority changed to ' + this.value);
        // Implement AJAX call to update priority in the backend
    });

    document.getElementById('escalateButton').addEventListener('click', function() {
        alert('Ticket escalated to the appropriate staff.');
        // Implement AJAX call to escalate the ticket
    });
</script>
@endsection 