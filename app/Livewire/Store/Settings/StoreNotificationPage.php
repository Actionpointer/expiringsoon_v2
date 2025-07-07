<?php

namespace App\Livewire\Store\Settings;

use App\Models\Store;
use App\Models\StoreNotification;
use Livewire\Component;

class StoreNotificationPage extends Component
{
    public Store $store;
    public StoreNotification $storeNotification;
    
    // Communication Channels
    public $email_enabled = true;
    public $sms_enabled = true;
    public $push_enabled = true;
    public $in_app_enabled = true;
    public $sms_phone_number;
    
    // Order Notifications
    public $new_order_notifications = [];
    public $order_cancelled_notifications = [];
    public $order_shipped_notifications = [];
    public $order_delivered_notifications = [];
    public $return_request_notifications = [];
    
    // Payment Notifications
    public $payment_received_notifications = [];
    public $withdrawal_processed_notifications = [];
    public $refund_issued_notifications = [];
    
    // System Notifications
    public $security_alert_notifications = [];
    public $account_update_notifications = [];
    public $maintenance_notifications = [];
    
    // Marketing Notifications
    public $marketing_emails_enabled = true;
    public $platform_updates_enabled = true;
    public $tips_and_tricks_enabled = true;

    public function mount($store)
    {
        $this->store = $store;
        $this->loadNotificationSettings();
    }

    public function loadNotificationSettings()
    {
        // Get or create notification settings for this store
        $this->storeNotification = $this->store->notifications ?? $this->store->notifications()->create(StoreNotification::getDefaultSettings());
        
        // Load communication channels
        $this->email_enabled = $this->storeNotification->email_enabled;
        $this->sms_enabled = $this->storeNotification->sms_enabled;
        $this->push_enabled = $this->storeNotification->push_enabled;
        $this->in_app_enabled = $this->storeNotification->in_app_enabled;
        $this->sms_phone_number = $this->storeNotification->sms_phone_number;
        
        // Load order notifications
        $this->new_order_notifications = $this->storeNotification->new_order_notifications ?? [];
        $this->order_cancelled_notifications = $this->storeNotification->order_cancelled_notifications ?? [];
        $this->order_shipped_notifications = $this->storeNotification->order_shipped_notifications ?? [];
        $this->order_delivered_notifications = $this->storeNotification->order_delivered_notifications ?? [];
        $this->return_request_notifications = $this->storeNotification->return_request_notifications ?? [];
        
        // Load payment notifications
        $this->payment_received_notifications = $this->storeNotification->payment_received_notifications ?? [];
        $this->withdrawal_processed_notifications = $this->storeNotification->withdrawal_processed_notifications ?? [];
        $this->refund_issued_notifications = $this->storeNotification->refund_issued_notifications ?? [];
        
        // Load system notifications
        $this->security_alert_notifications = $this->storeNotification->security_alert_notifications ?? [];
        $this->account_update_notifications = $this->storeNotification->account_update_notifications ?? [];
        $this->maintenance_notifications = $this->storeNotification->maintenance_notifications ?? [];
        
        // Load marketing notifications
        $this->marketing_emails_enabled = $this->storeNotification->marketing_emails_enabled;
        $this->platform_updates_enabled = $this->storeNotification->platform_updates_enabled;
        $this->tips_and_tricks_enabled = $this->storeNotification->tips_and_tricks_enabled;
    }

    public function saveNotificationSettings()
    {
        $this->validate([
            'email_enabled' => 'boolean',
            'sms_enabled' => 'boolean',
            'push_enabled' => 'boolean',
            'in_app_enabled' => 'boolean',
            'sms_phone_number' => 'nullable|string|max:20',
            'new_order_notifications' => 'array',
            'order_cancelled_notifications' => 'array',
            'order_shipped_notifications' => 'array',
            'order_delivered_notifications' => 'array',
            'return_request_notifications' => 'array',
            'payment_received_notifications' => 'array',
            'withdrawal_processed_notifications' => 'array',
            'refund_issued_notifications' => 'array',
            'security_alert_notifications' => 'array',
            'account_update_notifications' => 'array',
            'maintenance_notifications' => 'array',
            'marketing_emails_enabled' => 'boolean',
            'platform_updates_enabled' => 'boolean',
            'tips_and_tricks_enabled' => 'boolean',
        ]);

        $data = [
            'email_enabled' => $this->email_enabled,
            'sms_enabled' => $this->sms_enabled,
            'push_enabled' => $this->push_enabled,
            'in_app_enabled' => $this->in_app_enabled,
            'sms_phone_number' => $this->sms_phone_number,
            'new_order_notifications' => $this->new_order_notifications,
            'order_cancelled_notifications' => $this->order_cancelled_notifications,
            'order_shipped_notifications' => $this->order_shipped_notifications,
            'order_delivered_notifications' => $this->order_delivered_notifications,
            'return_request_notifications' => $this->return_request_notifications,
            'payment_received_notifications' => $this->payment_received_notifications,
            'withdrawal_processed_notifications' => $this->withdrawal_processed_notifications,
            'refund_issued_notifications' => $this->refund_issued_notifications,
            'security_alert_notifications' => $this->security_alert_notifications,
            'account_update_notifications' => $this->account_update_notifications,
            'maintenance_notifications' => $this->maintenance_notifications,
            'marketing_emails_enabled' => $this->marketing_emails_enabled,
            'platform_updates_enabled' => $this->platform_updates_enabled,
            'tips_and_tricks_enabled' => $this->tips_and_tricks_enabled,
        ];

        $this->storeNotification->update($data);

        session()->flash('message', 'Notification settings updated successfully!');
    }

    // Helper methods for array-based notifications
    public function isNotificationChecked($notificationType, $channel)
    {
        $field = $notificationType . '_notifications';
        return in_array($channel, $this->$field ?? []);
    }

    public function toggleNotification($notificationType, $channel)
    {
        $field = $notificationType . '_notifications';
        
        if (!is_array($this->$field)) {
            $this->$field = [];
        }
        
        if (in_array($channel, $this->$field)) {
            $this->$field = array_diff($this->$field, [$channel]);
        } else {
            $this->$field[] = $channel;
        }
    }

    public function render()
    {
        return view('livewire.store.settings.store-notification-page')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
