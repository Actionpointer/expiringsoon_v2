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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('reference');
            $table->string('request_id', 255)->nullable();
            $table->bigInteger('currency_id');
            $table->double('amount', null, 0)->default(0);
            $table->bigInteger('coupon_id')->nullable();
            $table->string('coupon_value')->default('0');
            $table->double('vat', null, 0);
            $table->string('method')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
