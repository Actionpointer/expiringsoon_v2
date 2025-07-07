<div class="py-4 p-md-5 p-lg-6">
    <div class="mb-5 border-bottom pb-3">
        <h2 class="mb-0">Profile Settings</h2>
        <p class="text-muted mt-1">Manage your account information and preferences</p>
    </div>

    <!-- Profile Section -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light">
            <h5 class="mb-0">Personal Information</h5>
        </div>
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-lg-3 col-md-4 text-center mb-4 mb-md-0">
                    <div class="avatar-upload">
                        <div class="avatar-preview rounded-circle mx-auto" style="width: 120px; height: 120px; background-image: url('{{ auth()->user()->profile_photo_url ?? asset('images/avatar-placeholder.jpg') }}'); background-size: cover;">
                        </div>
                        <form id="avatar-form" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="avatar-edit mt-3">
                                <label for="profile-photo" class="btn btn-sm btn-outline-primary">Change Photo</label>
                                <input type="file" id="profile-photo" name="profile_photo" class="d-none" accept="image/*" onchange="document.getElementById('avatar-form').submit()">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <form method="POST" action="">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="firstname">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                    id="firstname" name="firstname" value="{{ auth()->user()->firstname ?? '' }}" required>
                                @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="surname">Surname</label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                    id="surname" name="surname" value="{{ auth()->user()->surname ?? '' }}" required>
                                @error('surname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="birthday">Date of Birth</label>
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                    id="birthday" name="birthday" value="{{ auth()->user()->birthday ?? '' }}">
                                @error('birthday')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

    <!-- Password Section -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light">
            <h5 class="mb-0">Security</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="current_password">Current Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password" required>
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="password">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control"
                            id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">
                        Can't remember your current password?
                        <a href="">Reset your password</a>
                    </p>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Preferences -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light">
            <h5 class="mb-0">Notification Preferences</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">Customize how you receive updates about your orders, products, and account.</p>

            <form method="POST" action="">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="mb-3 border-bottom pb-2">Notification Channels</h6>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="email_notifications" name="channels[email]" checked>
                            <label class="form-check-label fw-medium" for="email_notifications">Email Notifications</label>
                            <p class="text-muted small mb-0">Receive notifications via email</p>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="push_notifications" name="channels[push]" checked>
                            <label class="form-check-label fw-medium" for="push_notifications">Push Notifications</label>
                            <p class="text-muted small mb-0">Receive notifications in your browser</p>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="sms_notifications" name="channels[sms]">
                            <label class="form-check-label fw-medium" for="sms_notifications">SMS Notifications</label>
                            <p class="text-muted small mb-0">Receive text messages for important updates</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="mb-3 border-bottom pb-2">Frequency Settings</h6>

                        <div class="mb-3">
                            <label class="form-label" for="email_frequency">Email Digest Frequency</label>
                            <select class="form-select" id="email_frequency" name="frequency[email]">
                                <option value="instant" {{ (auth()->user()->notification_preferences['email_frequency'] ?? '') == 'instant' ? 'selected' : '' }}>Instant - Send each notification immediately</option>
                                <option value="daily" {{ (auth()->user()->notification_preferences['email_frequency'] ?? '') == 'daily' ? 'selected' : '' }}>Daily - Send a daily digest</option>
                                <option value="weekly" {{ (auth()->user()->notification_preferences['email_frequency'] ?? 'weekly') == 'weekly' ? 'selected' : '' }}>Weekly - Send a weekly summary</option>
                            </select>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="quiet_hours" name="settings[quiet_hours]"
                                {{ (auth()->user()->notification_preferences['quiet_hours'] ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="quiet_hours">Enable quiet hours (no notifications between 10 PM - 8 AM)</label>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 border-bottom pb-2">Order Notifications</h6>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="order_confirmation" class="form-check-label fw-medium mb-1">Order Confirmation</label>
                                <p class="text-muted small mb-0">Receive notifications when you place an order</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="order_confirmation" name="notifications[order_confirmation]"
                                    {{ (auth()->user()->notification_preferences['order_confirmation'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="shipping_updates" class="form-check-label fw-medium mb-1">Shipping Updates</label>
                                <p class="text-muted small mb-0">Get notified when your order ships or delivery status changes</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="shipping_updates" name="notifications[shipping_updates]"
                                    {{ (auth()->user()->notification_preferences['shipping_updates'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="payment_confirmations" class="form-check-label fw-medium mb-1">Payment Confirmations</label>
                                <p class="text-muted small mb-0">Receive notifications about payment processing and receipts</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="payment_confirmations" name="notifications[payment_confirmations]"
                                    {{ (auth()->user()->notification_preferences['payment_confirmations'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="delivery_confirmation" class="form-check-label fw-medium mb-1">Delivery Confirmation</label>
                                <p class="text-muted small mb-0">Get notified when your order has been delivered</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="delivery_confirmation" name="notifications[delivery_confirmation]"
                                    {{ (auth()->user()->notification_preferences['delivery_confirmation'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 border-bottom pb-2">Product & Promotional Notifications</h6>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="price_drops" class="form-check-label fw-medium mb-1">Price Drop Alerts</label>
                                <p class="text-muted small mb-0">Get notified when items in your wishlist drop in price</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="price_drops" name="notifications[price_drops]"
                                    {{ (auth()->user()->notification_preferences['price_drops'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="back_in_stock" class="form-check-label fw-medium mb-1">Back in Stock Alerts</label>
                                <p class="text-muted small mb-0">Get notified when out-of-stock items you want become available</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="back_in_stock" name="notifications[back_in_stock]"
                                    {{ (auth()->user()->notification_preferences['back_in_stock'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="special_offers" class="form-check-label fw-medium mb-1">Special Offers & Promotions</label>
                                <p class="text-muted small mb-0">Receive notifications about discounts and special deals</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="special_offers" name="notifications[special_offers]"
                                    {{ (auth()->user()->notification_preferences['special_offers'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="new_arrivals" class="form-check-label fw-medium mb-1">New Arrivals</label>
                                <p class="text-muted small mb-0">Get updates when new products in your favorite categories arrive</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="new_arrivals" name="notifications[new_arrivals]"
                                    {{ (auth()->user()->notification_preferences['new_arrivals'] ?? false) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 border-bottom pb-2">Account Notifications</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="security_alerts" class="form-check-label fw-medium mb-1">Security Alerts</label>
                                <p class="text-muted small mb-0">Important notifications about your account security</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="security_alerts" name="notifications[security_alerts]"
                                    {{ (auth()->user()->notification_preferences['security_alerts'] ?? true) ? 'checked' : '' }} disabled>
                            </div>
                        </div>

                        <small class="text-muted d-block mb-3">Security alerts cannot be disabled as they are essential for your account's protection.</small>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="review_requests" class="form-check-label fw-medium mb-1">Review Requests</label>
                                <p class="text-muted small mb-0">Reminders to review products you've purchased</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="review_requests" name="notifications[review_requests]"
                                    {{ (auth()->user()->notification_preferences['review_requests'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label for="account_summary" class="form-check-label fw-medium mb-1">Account Summary</label>
                                <p class="text-muted small mb-0">Monthly summary of your purchases and account activity</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="account_summary" name="notifications[account_summary]"
                                    {{ (auth()->user()->notification_preferences['account_summary'] ?? true) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Save Notification Preferences</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account -->
    <div class="card shadow-sm mb-3 border-danger">
        <div class="card-header bg-danger bg-opacity-10 text-danger">
            <h5 class="mb-0">Delete Account</h5>
        </div>
        <div class="card-body">
            <p class="mb-2">Would you like to delete your account?</p>
            <p class="mb-4 text-muted">This action is permanent and cannot be undone. All your data, including order history, saved items, and personal information will be permanently removed.</p>

            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                I want to delete my account
            </button>

            <!-- Delete Account Modal -->
            <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-danger fw-bold">Are you absolutely sure you want to delete your account?</p>
                            <p>This action cannot be undone. All your data will be permanently deleted from our servers.</p>

                            <form id="delete-account-form" method="POST" action="">
                                @csrf
                                @method('DELETE')

                                <div class="mb-3">
                                    <label for="delete-confirmation" class="form-label">Please type "DELETE" to confirm</label>
                                    <input type="text" class="form-control" id="delete-confirmation" required pattern="DELETE">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="delete-account-form" class="btn btn-danger">Delete My Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>