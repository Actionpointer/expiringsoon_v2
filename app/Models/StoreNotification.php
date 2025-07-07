<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'email_enabled',
        'sms_enabled',
        'push_enabled',
        'in_app_enabled',
        'sms_phone_number',
        'new_order_notifications',
        'order_cancelled_notifications',
        'order_shipped_notifications',
        'order_delivered_notifications',
        'return_request_notifications',
        'payment_received_notifications',
        'withdrawal_processed_notifications',
        'refund_issued_notifications',
        'security_alert_notifications',
        'account_update_notifications',
        'maintenance_notifications',
        'marketing_emails_enabled',
        'platform_updates_enabled',
        'tips_and_tricks_enabled',
    ];

    protected $casts = [
        'email_enabled' => 'boolean',
        'sms_enabled' => 'boolean',
        'push_enabled' => 'boolean',
        'in_app_enabled' => 'boolean',
        'marketing_emails_enabled' => 'boolean',
        'platform_updates_enabled' => 'boolean',
        'tips_and_tricks_enabled' => 'boolean',
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
    ];

    /**
     * Get the store that owns the notification settings.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Check if a specific notification type is enabled for a channel
     */
    public function isNotificationEnabled($notificationType, $channel)
    {
        $field = $notificationType . '_notifications';
        
        if (!isset($this->$field) || !is_array($this->$field)) {
            return false;
        }

        return in_array($channel, $this->$field);
    }

    /**
     * Get all enabled channels for a specific notification type
     */
    public function getEnabledChannels($notificationType)
    {
        $field = $notificationType . '_notifications';
        
        if (!isset($this->$field) || !is_array($this->$field)) {
            return [];
        }

        return $this->$field;
    }

    /**
     * Check if a communication channel is enabled
     */
    public function isChannelEnabled($channel)
    {
        $field = $channel . '_enabled';
        return $this->$field ?? false;
    }

    /**
     * Get default notification settings
     */
    public static function getDefaultSettings()
    {
        return [
            'email_enabled' => true,
            'sms_enabled' => true,
            'push_enabled' => true,
            'in_app_enabled' => true,
            'new_order_notifications' => ['email', 'sms', 'push', 'in_app'],
            'order_cancelled_notifications' => ['email', 'sms', 'push', 'in_app'],
            'order_shipped_notifications' => ['email', 'in_app'],
            'order_delivered_notifications' => ['email', 'in_app'],
            'return_request_notifications' => ['email', 'sms', 'push', 'in_app'],
            'payment_received_notifications' => ['email', 'sms', 'push', 'in_app'],
            'withdrawal_processed_notifications' => ['email', 'sms', 'push', 'in_app'],
            'refund_issued_notifications' => ['email', 'sms', 'push', 'in_app'],
            'security_alert_notifications' => ['email', 'sms', 'push', 'in_app'],
            'account_update_notifications' => ['email', 'in_app'],
            'maintenance_notifications' => ['email', 'in_app'],
            'marketing_emails_enabled' => true,
            'platform_updates_enabled' => true,
            'tips_and_tricks_enabled' => true,
        ];
    }
}
