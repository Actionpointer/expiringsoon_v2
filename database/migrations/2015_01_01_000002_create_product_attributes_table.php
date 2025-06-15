<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Color", "Size", "Material", "Weight"
            $table->string('slug')->nullable();
            $table->string('options')->nullable(); // e.g. "Red", "XL"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('is_active');
        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_attribute_id')->constrained()->onDelete('cascade');
            $table->json('values'); // e.g. "Red", "XL"
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('product_options');
    }
}