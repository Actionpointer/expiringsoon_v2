<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prepurchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->unsignedBigInteger('store_id');
            
            // Price information
            $table->string('current_price');
            $table->string('target_price');
            $table->string('amount_paid');
            $table->string('service_charge');
            $table->string('currency_code');
            
            // Purchase details
            $table->integer('quantity')->default(1);
            $table->timestamp('target_date');
            $table->string('status')->default('pending'); // pending, completed, refunded, failed
            
            // Result tracking
            $table->unsignedBigInteger('order_id')->nullable(); // If purchase successful
            $table->unsignedBigInteger('settlement_id')->nullable(); // If refunded to wallet
            $table->text('failure_reason')->nullable();
            $table->timestamp('processed_at')->nullable();
            
            // Snapshot of product/variant at time of pre-purchase
            $table->json('product_snapshot')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            

            // Indexes
            $table->index(['status', 'target_date']); // For processing due pre-purchases
            $table->index(['user_id', 'status']); // For user's pre-purchase history
            $table->index(['product_id', 'status']); // For product pre-purchase analysis
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_drop_prepurchases');
    }
}; 