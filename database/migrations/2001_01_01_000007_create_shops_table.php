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
            $table->bigInteger('user_id');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('banner')->nullable();
            $table->string('address');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('country_id');
            $table->string('discount30')->nullable();
            $table->string('discount60')->nullable();
            $table->string('discount90')->nullable();
            $table->string('discount120')->nullable();
            $table->string('commission')->nullable();
            $table->boolean('status')->default(1); // 1: active, 0: inactive
            $table->boolean('approved')->default(0); // 1: approved, 0: not approved
            $table->string('balance')->default(0);
            $table->timestamps();
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
