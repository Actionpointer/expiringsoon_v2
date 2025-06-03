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
        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('slug')->nullable();
            $table->string('subject');
            $table->text('description');
            $table->string('amount')->default(0);
            $table->string('currency_code')->nullable();
            $table->morphs('contractable');
            $table->string('priority')->default('normal');
            $table->text('verdict')->nullable();
            $table->string('status')->default('open');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disputes');
    }
};
