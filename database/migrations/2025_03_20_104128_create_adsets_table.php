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
        Schema::create('adsets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('country_ad_plan_id');
            $table->string('slug')->nullable();
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->integer('units')->default(1);
            $table->double('amount', null, 0);
            $table->boolean('status')->default(false);
            $table->boolean('auto_renew')->default(false);
            
            $table->json('targeting')->nullable(); // Store targeting options as JSON
            $table->decimal('daily_budget', 10, 2)->nullable();
            $table->string('pricing_model')->default('cpm'); // cpm, cpc, cpa
            $table->json('schedule')->nullable(); // For time-of-day scheduling
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_ad_plan_id')->references('id')->on('country_ad_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adsets');
    }
};
