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
        Schema::create('country_ad_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->text('description');
            $table->string('instruction', 255);
            $table->string('type');//store, product, coupon, 
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('price')->default(0);
            $table->boolean('is_active')->default(1); //still in use
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_ad_plans');
    }
};
