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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('banner')->nullable();
            $table->string('address');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('discount30')->nullable();
            $table->string('discount60')->nullable();
            $table->string('discount90')->nullable();
            $table->string('discount120')->nullable();
            $table->string('commission')->nullable();
            $table->boolean('status')->default(1); // 1: active, 0: inactive
            $table->boolean('approved')->default(0); // 1: approved, 0: not approved
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
