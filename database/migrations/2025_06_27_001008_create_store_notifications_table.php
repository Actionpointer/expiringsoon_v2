<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            
            // Communication Channels
            $table->boolean('email_enabled')->default(true);
            $table->boolean('sms_enabled')->default(true);
            $table->boolean('push_enabled')->default(true);
            $table->boolean('in_app_enabled')->default(true);
            $table->string('sms_phone_number')->nullable();
            
            // Order Notifications
            $table->json('new_order_notifications')->nullable(); // email, sms, push, in_app
            $table->json('order_cancelled_notifications')->nullable();
            $table->json('order_shipped_notifications')->nullable();
            $table->json('order_delivered_notifications')->nullable();
            $table->json('return_request_notifications')->nullable();
            
            // Payment Notifications
            $table->json('payment_received_notifications')->nullable();
            $table->json('withdrawal_processed_notifications')->nullable();
            $table->json('refund_issued_notifications')->nullable();
            
            // System Notifications
            $table->json('security_alert_notifications')->nullable();
            $table->json('account_update_notifications')->nullable();
            $table->json('maintenance_notifications')->nullable();
            
            // Marketing Notifications
            $table->boolean('marketing_emails_enabled')->default(true);
            $table->boolean('platform_updates_enabled')->default(true);
            $table->boolean('tips_and_tricks_enabled')->default(true);
            
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->unique('store_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_notifications');
    }
};
