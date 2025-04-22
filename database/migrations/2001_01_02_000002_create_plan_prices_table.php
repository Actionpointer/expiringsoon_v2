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
        Schema::create('plan_prices', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code');
            $table->unsignedBigInteger('plan_id');
            $table->string('minimum_payout')->default('0');
            $table->string('maximum_payout')->default('0');
            $table->string('commission_percentage')->default('0');
            $table->string('commission_fixed')->default('0');
            $table->string('months_1')->default('0');
            $table->string('months_3')->default('0');
            $table->string('months_6')->default('0');
            $table->string('months_12')->default('0');
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_prices');
    }
};
