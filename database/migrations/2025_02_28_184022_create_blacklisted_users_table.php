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
        Schema::create('blacklisted_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reason');
            $table->string('reason_category')->nullable()->comment('security', 'spam', 'tos', 'payment');
            $table->unsignedBigInteger('suspended_by_id')->nullable();
            $table->enum('suspended_by_type', ['system', 'admin'])->default('system');
            $table->enum('suspension_type', ['temporary', 'permanent'])->default('temporary');
            $table->dateTime('expires_at')->nullable();
            $table->text('additional_notes')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('suspension_type');
            $table->index('reason_category');
            $table->index('expires_at');
            $table->index(['active', 'expires_at']);

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('suspended_by_id')->references('id')->on('users')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blacklisted_users');
    }
};
