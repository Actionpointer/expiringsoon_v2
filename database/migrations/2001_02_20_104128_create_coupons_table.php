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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('available')->default(1);
            $table->boolean('is_percentage');
            $table->double('value', 8, 2)->default(0);
            $table->string('minimum_spend')->nullable();
            $table->string('cap')->nullable();
            $table->string('currency_code')->nullable();
            $table->integer('limit_per_user')->nullable();
            $table->json('usabilities')->nullable(); // ['products','plans','adverts','shipping']
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('currency_code')->references('code')->on('currencies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
