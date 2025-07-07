<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Notification Settings</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', 1) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notification Settings</li>
                        </ol>
                    </nav>
                </div>
                <!-- Save changes button -->
                <div>
                    <button type="submit" form="notificationSettingsForm" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Changes
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
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Notification Preferences</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveNotificationSettings">
                        <!-- Communication Channels -->
                        <div class="mb-5">
                            <h5>Communication Channels</h5>
                            <p class="text-muted">Select how you'd like to receive notifications</p>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="emailChannel" wire:model="email_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="emailChannel">
                                        <div>
                                            <span class="d-block">Email Notifications</span>
                                            <small class="text-muted">Receive notifications via email</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="smsChannel" wire:model="sms_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="smsChannel">
                                        <div>
                                            <span class="d-block">SMS Notifications</span>
                                            <small class="text-muted">Receive notifications via SMS</small>
                                        </div>
                                    </label>
                                </div>
                                <div class="mt-2 ps-4">
                                    <label for="phoneNumber" class="form-label">Phone Number for SMS</label>
                                    <input type="tel" class="form-control" id="phoneNumber" wire:model="sms_phone_number" placeholder="+1 (234) 567-8901">
                                    @error('sms_phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pushChannel" wire:model="push_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="pushChannel">
                                        <div>
                                            <span class="d-block">Push Notifications</span>
                                            <small class="text-muted">Receive push notifications on your device</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="inAppChannel" wire:model="in_app_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="inAppChannel">
                                        <div>
                                            <span class="d-block">In-App Notifications</span>
                                            <small class="text-muted">Receive notifications in the dashboard</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Order Notifications -->
                        <div class="mb-5">
                            <h5>Order Notifications</h5>
                            <p class="text-muted">Configure notifications for order updates</p>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Notification Type</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">SMS</th>
                                            <th class="text-center">Push</th>
                                            <th class="text-center">In-App</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">New Order</span>
                                                    <small class="text-muted">When a new order is placed</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="newOrderEmail" 
                                                           wire:click="toggleNotification('new_order', 'email')"
                                                           @if($this->isNotificationChecked('new_order', 'email')) checked @endif>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="newOrderSms" 
                                                           wire:click="toggleNotification('new_order', 'sms')"
                                                           @if($this->isNotificationChecked('new_order', 'sms')) checked @endif>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="newOrderPush" 
                                                           wire:click="toggleNotification('new_order', 'push')"
                                                           @if($this->isNotificationChecked('new_order', 'push')) checked @endif>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="newOrderInApp" 
                                                           wire:click="toggleNotification('new_order', 'in_app')"
                                                           @if($this->isNotificationChecked('new_order', 'in_app')) checked @endif>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Order Cancelled</span>
                                                    <small class="text-muted">When an order is cancelled</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderCancelledEmail" name="notifications[order_cancelled][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderCancelledSms" name="notifications[order_cancelled][sms]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderCancelledPush" name="notifications[order_cancelled][push]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderCancelledInApp" name="notifications[order_cancelled][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Order Shipped</span>
                                                    <small class="text-muted">When an order is shipped</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderShippedEmail" name="notifications[order_shipped][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderShippedSms" name="notifications[order_shipped][sms]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderShippedPush" name="notifications[order_shipped][push]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderShippedInApp" name="notifications[order_shipped][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Order Delivered</span>
                                                    <small class="text-muted">When an order is delivered</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderDeliveredEmail" name="notifications[order_delivered][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderDeliveredSms" name="notifications[order_delivered][sms]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderDeliveredPush" name="notifications[order_delivered][push]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="orderDeliveredInApp" name="notifications[order_delivered][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Return Request</span>
                                                    <small class="text-muted">When a customer requests a return</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="returnRequestEmail" name="notifications[return_request][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="returnRequestSms" name="notifications[return_request][sms]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="returnRequestPush" name="notifications[return_request][push]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="returnRequestInApp" name="notifications[return_request][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Payment Notifications -->
                        <div class="mb-5">
                            <h5>Payment Notifications</h5>
                            <p class="text-muted">Configure notifications for payments and transactions</p>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Notification Type</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">SMS</th>
                                            <th class="text-center">Push</th>
                                            <th class="text-center">In-App</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Payment Received</span>
                                                    <small class="text-muted">When you receive a payment</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="paymentReceivedEmail" name="notifications[payment_received][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="paymentReceivedSms" name="notifications[payment_received][sms]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="paymentReceivedPush" name="notifications[payment_received][push]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="paymentReceivedInApp" name="notifications[payment_received][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Withdrawal Request Processed</span>
                                                    <small class="text-muted">When your withdrawal request is processed</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="withdrawalProcessedEmail" name="notifications[withdrawal_processed][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="withdrawalProcessedSms" name="notifications[withdrawal_processed][sms]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="withdrawalProcessedPush" name="notifications[withdrawal_processed][push]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="withdrawalProcessedInApp" name="notifications[withdrawal_processed][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Refund Issued</span>
                                                    <small class="text-muted">When a refund is issued</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="refundIssuedEmail" name="notifications[refund_issued][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="refundIssuedSms" name="notifications[refund_issued][sms]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="refundIssuedPush" name="notifications[refund_issued][push]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="refundIssuedInApp" name="notifications[refund_issued][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- System Notifications -->
                        <div class="mb-5">
                            <h5>System Notifications</h5>
                            <p class="text-muted">Configure notifications for system events</p>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Notification Type</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">SMS</th>
                                            <th class="text-center">Push</th>
                                            <th class="text-center">In-App</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Security Alerts</span>
                                                    <small class="text-muted">Important security notifications</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="securityAlertEmail" name="notifications[security_alert][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="securityAlertSms" name="notifications[security_alert][sms]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="securityAlertPush" name="notifications[security_alert][push]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="securityAlertInApp" name="notifications[security_alert][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">Account Updates</span>
                                                    <small class="text-muted">Updates to your account settings</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="accountUpdateEmail" name="notifications[account_update][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="accountUpdateSms" name="notifications[account_update][sms]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="accountUpdatePush" name="notifications[account_update][push]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="accountUpdateInApp" name="notifications[account_update][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="d-block">System Maintenance</span>
                                                    <small class="text-muted">Notifications about system maintenance</small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="maintenanceEmail" name="notifications[maintenance][email]" checked>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="maintenanceSms" name="notifications[maintenance][sms]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="maintenancePush" name="notifications[maintenance][push]">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="maintenanceInApp" name="notifications[maintenance][in_app]" checked>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="border-bottom mb-5 pb-3"></div>
                        
                        <!-- Marketing Notifications -->
                        <div class="mb-5">
                            <h5>Marketing & Promotions</h5>
                            <p class="text-muted">Configure marketing and promotional notifications</p>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="marketingEmails" wire:model="marketing_emails_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="marketingEmails">
                                        <div>
                                            <span class="d-block">Marketing Emails</span>
                                            <small class="text-muted">Receive promotional emails, offers, and news</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="platformUpdates" wire:model="platform_updates_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="platformUpdates">
                                        <div>
                                            <span class="d-block">Platform Updates</span>
                                            <small class="text-muted">Receive updates about new features and improvements</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="tipsAndTricks" wire:model="tips_and_tricks_enabled">
                                    <label class="form-check-label d-flex justify-content-between" for="tipsAndTricks">
                                        <div>
                                            <span class="d-block">Tips & Best Practices</span>
                                            <small class="text-muted">Receive tips and best practices for your store</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>Save Changes</span>
                                <span wire:loading>Saving...</span>
                            </button>
                            <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>