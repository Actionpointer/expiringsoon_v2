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
        Schema::create('shipment_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipper_id');
            $table->unsignedBigInteger('origin_city_id');
            $table->unsignedBigInteger('destination_city_id');
            $table->string('same_day')->nullable();
            $table->string('next_day')->nullable();
            $table->string('express')->nullable();
            $table->string('markup')->default('0');
            $table->string('currency_code');
            $table->timestamps();
            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->foreign('origin_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('destination_city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_rates');
    }
};
