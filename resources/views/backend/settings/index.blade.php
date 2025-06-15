@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">General</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">General Settings</h1>
            </div>
        </div>
        @include('backend.settings.partials.menu')
    </div>

    <div class="row">
        <!-- Platform Settings Card -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Platform Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <!-- Maintenance Mode -->
                        <div class="mb-4">
                            <label class="form-label">Maintenance Mode</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="maintenance_mode">
                                <label class="form-check-label">Enable maintenance mode</label>
                            </div>
                            <small class="form-text text-muted">Only administrators can access the platform when enabled</small>
                        </div>

                        <!-- Registration Settings -->
                        <div class="mb-4">
                            <label class="form-label">User Registration</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" name="allow_user_registration">
                                <label class="form-check-label">Allow new user registration</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="require_email_verification">
                                <label class="form-check-label">Require email verification</label>
                            </div>
                        </div>

                        <!-- Default Currency -->
                        <div class="mb-4">
                            <label class="form-label">Default Currency</label>
                            <select class="form-select" name="default_currency">
                                <option value="NGN">Nigerian Naira (₦)</option>
                                <option value="USD">US Dollar ($)</option>
                                <option value="EUR">Euro (€)</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Approval Settings Card -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Approval Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Auto Approve Products</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="auto_approve_product">
                                <label class="form-check-label">Enable automatic product approval</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Auto Approve Product Advert</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="auto_approve_product_advert">
                                <label class="form-check-label">Enable automatic product advert approval</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Auto Approve Shop</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="auto_approve_shop">
                                <label class="form-check-label">Enable automatic shop approval</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Auto Approve Shop Advert</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="auto_approve_shop_advert">
                                <label class="form-check-label">Enable automatic shop advert approval</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Processing Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Processing Stage Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">To User Cancel Period</label>
                            <input type="number" class="form-control" name="order_processing_to_user_cancel_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for user cancellation</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">To Auto-Cancel Period</label>
                            <input type="number" class="form-control" name="order_processing_to_auto_cancel_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours before automatic cancellation</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">To Shipment Period</label>
                            <input type="number" class="form-control" name="order_processing_to_shipment_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for order processing</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delivery Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Delivery Stage Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Processing to Delivery</label>
                            <input type="number" class="form-control" name="order_processing_to_delivery_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for delivery</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Delivery to Acceptance</label>
                            <input type="number" class="form-control" name="order_delivered_to_acceptance_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for delivery acceptance</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Return Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Return & Reversal Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Rejected to Reversal</label>
                            <input type="number" class="form-control" name="order_rejected_to_reversal_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for order reversal</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Reversal to Return</label>
                            <input type="number" class="form-control" name="order_reversed_to_returned_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for return processing</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Return to Acceptance</label>
                            <input type="number" class="form-control" name="order_returned_to_acceptance_period" placeholder="Hours">
                            <small class="form-text text-muted">Hours allowed for return acceptance</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Security Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Password Policy</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" name="require_strong_password">
                                <label class="form-check-label">Require strong passwords</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="force_password_change">
                                <label class="form-check-label">Force password change every 90 days</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Login Attempts</label>
                            <input type="number" class="form-control" name="max_login_attempts" placeholder="Maximum login attempts">
                            <small class="form-text text-muted">Number of failed attempts before account lockout</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Session Timeout</label>
                            <input type="number" class="form-control" name="session_timeout" placeholder="Minutes">
                            <small class="form-text text-muted">Minutes of inactivity before automatic logout</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Notification Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Email Notifications</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" name="notify_new_registration">
                                <label class="form-check-label">New user registrations</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" name="notify_new_shop">
                                <label class="form-check-label">New shop registrations</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="notify_product_reports">
                                <label class="form-check-label">Product reports</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">System Alerts</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" name="alert_low_stock">
                                <label class="form-check-label">Low stock alerts</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="alert_suspicious_activity">
                                <label class="form-check-label">Suspicious activity alerts</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- File Upload Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">File Upload Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Maximum File Sizes (MB)</label>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <input type="number" class="form-control" name="max_product_image_size" placeholder="Product images">
                                    <small class="form-text text-muted">Product images</small>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <input type="number" class="form-control" name="max_shop_logo_size" placeholder="Shop logo">
                                    <small class="form-text text-muted">Shop logo</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Allowed File Types</label>
                            <input type="text" class="form-control" name="allowed_file_types" placeholder="jpg,jpeg,png,gif">
                            <small class="form-text text-muted">Comma-separated list of allowed file extensions</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Analytics Settings -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Analytics Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.settings.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Google Analytics</label>
                            <input type="text" class="form-control" name="google_analytics_id" placeholder="GA-XXXXXXXXXX">
                            <small class="form-text text-muted">Google Analytics tracking ID</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Data Collection</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" name="collect_user_behavior">
                                <label class="form-check-label">Collect user behavior data</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="collect_search_data">
                                <label class="form-check-label">Collect search analytics</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection