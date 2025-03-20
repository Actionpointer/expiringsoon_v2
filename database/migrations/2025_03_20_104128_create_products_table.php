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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_id', 5);
            $table->string('name', 100);
            $table->text('description');
            $table->string('slug')->nullable();
            $table->text('tags')->nullable();
            $table->string('photo', 100)->nullable();
            $table->string('price');
            $table->string('stock')->default('0');
            $table->dateTime('expire_at')->nullable();
            $table->string('discount30')->nullable();
            $table->string('discount60')->nullable();
            $table->string('discount90')->nullable();
            $table->string('discount120')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('units')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('show')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
