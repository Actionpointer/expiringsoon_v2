<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('price');
            $table->integer('stock')->default(0);
            $table->json('options')->nullable(); // Stores variant options like color, size, image etc
            $table->string('photo')->nullable(); 
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('type')->default('product'); // product, bundle etc.
            $table->timestamps();
            $table->softDeletes();
            $table->index(['product_id', 'is_active']);
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}