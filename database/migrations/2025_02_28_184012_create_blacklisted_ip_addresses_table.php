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
        Schema::create('blacklisted_ip_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('isp')->nullable();
            $table->string('reason');
            $table->enum('block_type', ['temporary', 'permanent', 'auto'])->default('temporary');
            $table->integer('attempt_count')->default(0);
            $table->dateTime('expires_at')->nullable();
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->enum('added_by_type', ['system', 'manual'])->default('system');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique('ip');
            $table->index('block_type');
            $table->index('expires_at');
            // Foreign 
            $table->index(['active', 'expires_at']);
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blacklisted_ip_addresses');
    }
};
