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
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('name', 100);
            $table->text('description');
            $table->string('slug')->nullable();
            $table->text('tags')->nullable();
            $table->string('currency_code');
            $table->dateTime('expire_at')->nullable();
            $table->string('discount30')->nullable();
            $table->string('discount60')->nullable();
            $table->string('discount90')->nullable();
            $table->string('discount120')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('show')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->index(['shop_id', 'published', 'approved']);
            $table->index('slug');
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
