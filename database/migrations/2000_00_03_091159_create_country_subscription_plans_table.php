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
        Schema::create('country_subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('slug');
            $table->string('description', 255);
            $table->integer('products')->default(0);
            $table->integer('staff')->default(0);
            $table->integer('storage_mb')->default(0);
            $table->string('commission');
            $table->integer('minimum_withdrawal');
            $table->integer('maximum_withdrawal');
            $table->string('withdrawal_interval'); // instant, same_day, next_day, 2_3_bdays
            $table->integer('withdrawal_count');
            $table->integer('newsletter_credits');
            $table->string('monthly_price');
            $table->string('annual_price');
            $table->boolean('is_public')->default(1); //everyone can see it on the pricing list
            $table->boolean('is_default')->default(0); //users will be taken back to this plan after their subscription expires
            $table->boolean('is_active')->default(1); //still in use
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_subscription_plans');
    }
};
