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
        Schema::create('country_bankings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->integer('account_length')->default(0);
            $table->string('newsletter_cost')->default(0);
            $table->json('banking_fields')->nullable();  // Structure: { "fields":, "digits": "VAT" }             
            $table->boolean('verification_required')->default(true);      
            $table->string('verification_method')->default('manual'); //manual or gateway 
            $table->string('tax_rate')->nullable();
            $table->json('transaction_charges')->nullable();// Structure:{ "percentage": 10, "fixed": 10000, "cap": 100000 }          
            $table->json('withdrawal_charges')->nullable();// Structure:{ "percentage": 10, "fixed": 10000, "cap": 100000 }          
            $table->boolean('instant_withdrawal')->default(0); //now or later
            $table->boolean('requires_approval')->default(0); //requires approval or not
            $table->boolean('weekend_processing')->default(0); //requires approval or not
            $table->boolean('holiday_processing')->default(0); //requires approval or not
            $table->boolean('freeze_wallets')->default(0); // freeze wallets or not 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_bankings');
    }
};
