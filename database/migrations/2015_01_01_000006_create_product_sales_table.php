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
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');    
            $table->string('discount_percentage')->default(1);
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->string('frequency_minutes')->nullable();
            $table->string('duration_minutes')->nullable();
            $table->boolean('status')->default(1);    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
