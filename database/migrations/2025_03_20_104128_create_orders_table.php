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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('shop_id', 5);
            $table->bigInteger('user_id');
            $table->string('slug')->nullable();
            $table->string('deliveryfee')->nullable()->default('0');
            $table->string('vat')->default('0');
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->dateTime('expected_at')->nullable();
            $table->bigInteger('arbitrator_id')->nullable();
            $table->string('deliverer')->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
