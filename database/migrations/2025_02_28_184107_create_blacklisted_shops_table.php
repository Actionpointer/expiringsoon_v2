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
        Schema::create('blacklisted_shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            
            
            $table->unsignedBigInteger('suspended_by_id')->nullable();
            $table->enum('suspended_by_type', ['system', 'admin'])->default('system');
            $table->enum('suspension_type', ['temporary', 'permanent'])->default('temporary');
            $table->timestamp('expires_at')->nullable();
            $table->string('reason');
            $table->json('restrictions');//e.g., products, orders, wallet, etc.
            $table->json('reinstatement_requirements')->nullable();
            $table->enum('status', ['active','under_investigation','reviewing'])->default('active');
            $table->timestamps();
            // Indexes
            $table->index('status');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('suspended_by_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blacklisted_shops');
    }
};
