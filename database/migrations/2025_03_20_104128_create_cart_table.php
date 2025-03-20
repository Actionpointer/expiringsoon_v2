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
        Schema::create('cart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 5);
            $table->string('product_id', 10);
            $table->bigInteger('shop_id');
            $table->integer('quantity');
            $table->double('amount', null, 0)->unsigned()->default(0);
            $table->double('total', null, 0)->unsigned()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
