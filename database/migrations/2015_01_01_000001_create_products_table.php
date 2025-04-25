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
            $table->unsignedBigInteger('store_id');
            $table->string('name', 100);
            $table->text('description');
            $table->string('slug')->nullable();
            $table->text('tags')->nullable();
            $table->json('images')->nullable(); 
            $table->dateTime('expire_at')->nullable();
            $table->string('expiry_term')->nullable();
            $table->string('discount30')->nullable();
            $table->string('discount60')->nullable();
            $table->string('discount90')->nullable();
            $table->string('discount120')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('approved')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->index(['store_id', 'published', 'approved']);
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
