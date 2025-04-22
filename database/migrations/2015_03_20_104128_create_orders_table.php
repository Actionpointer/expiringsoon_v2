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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->nullable();
            $table->string('deliveryfee')->default(0);
            $table->string('vat')->default(0);
            $table->string('currency_code')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('delivery_type')->nullable(); //pickup or delivery
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('picked_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->dateTime('expected_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('disputed_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->index('slug');
            $table->index(['user_id', 'shop_id']); // Added index for user_id and shop_id for better query performance
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
