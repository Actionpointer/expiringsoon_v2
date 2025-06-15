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
            $table->integer('quantity')->default(1);
            $table->text('description')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_percentage');
            $table->integer('available')->default(1);
            $table->double('value', 8, 2)->default(0);
            $table->string('minimum_spend')->nullable();
            $table->string('cap')->nullable();
            $table->string('currency_code')->nullable();
            $table->integer('limit_per_user')->nullable();
            $table->json('usabilities')->nullable(); // ['products','plans','adverts','shipping']
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();
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
