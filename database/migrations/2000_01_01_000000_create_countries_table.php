<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\GatewaysTableSeeder;
use Illuminate\Database\Schema\Blueprint;
use Database\Seeders\CountriesTableSeeder;
use Illuminate\Database\Migrations\Migration;
use Database\Seeders\BankingProvidersTableSeeder;
use Database\Seeders\VerificationProvidersTableSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 2)->unique();  // ISO 2-letter code (e.g., 'US', 'GB')
            $table->integer('currency_id');
            $table->string('dial', 5)->nullable();
            $table->string('continent');           
            $table->string('gateway');           
            $table->json('banking')->nullable();  // Structure: { "fields":, "digits": "VAT" }                   
            $table->json('verification')->nullable();  // Structure: { "fields":, "digits": "VAT" }                   
            $table->json('transaction_charges')->nullable();// Structure:{ "percentage": 10, "fixed": 10000, "cap": 100000 }          
            $table->string('payout_type')->nullable();   //automatic_with_approval or automatic_without_approval or manual
            $table->json('tax')->nullable(); // Structure: { "vat_rate": 10, "format": "VAT" }          
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');

    }
};
