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
            $table->unsignedBigInteger('category_id');
            $table->string('name', 100);
            $table->string('slug')->nullable();
            $table->text('description');
            $table->text('meta_description')->nullable();
            $table->json('photos')->nullable();
            $table->boolean('preorder')->default(false);
            $table->boolean('always_available')->default(false);
            $table->dateTime('expire_at')->nullable();
            $table->string('expiry_term')->nullable();
            $table->string('discount30')->nullable();
            $table->string('discount60')->nullable();
            $table->string('discount90')->nullable();
            $table->string('discount120')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->index(['store_id', 'published', 'approved_at']);
            $table->index('slug');
            $table->index('expire_at');
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
