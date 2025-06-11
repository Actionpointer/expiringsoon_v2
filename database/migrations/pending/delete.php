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
        Schema::create('country_newsletter_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('slug');
            $table->string('description', 255);
            $table->integer('credits');
            $table->integer('bonus_credits')->default(0)->comment('Additional free credits included in the package');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0)->comment('Percentage discount off regular pricing');
            $table->integer('validity_days')->default(365)->comment('Number of days credits remain valid after purchase');
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
        Schema::dropIfExists('country_newsletter_plans');
    }
};
