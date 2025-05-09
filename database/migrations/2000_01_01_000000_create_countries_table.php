<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('currency_code')->nullable();
            $table->string('dial', 5)->nullable();
            $table->string('continent');           
            $table->string('primary_gateway')->nullable();           
            $table->string('secondary_gateway')->nullable(); 
            $table->string('verification_provider')->default('manual');  
            $table->json('banking_fields')->nullable();  // Structure: { "fields":, "digits": "VAT" }                   
            $table->json('verification_fields')->nullable();  // Structure: { "fields":, "digits": "VAT" }                   
            $table->json('transaction_charges')->nullable();// Structure:{ "percentage": 10, "fixed": 10000, "cap": 100000 }          
            $table->string('payout_type')->nullable();   //automatic_with_approval or automatic_without_approval or manual
            $table->json('tax_system')->nullable(); // Structure: { "vat_rate": 10, "format": "VAT" }          
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('currency_code')->references('code')->on('currencies')->onDelete('set null');
        });
        DB::table('countries')->insert([
            ['id' => 1,'name'=> 'Nigeria',
             'code' => 'ng',
             'currency_code'=> 'ngn', 
             'dial' => '234', 
             'continent' => 'Africa',
             'status' => true,
             'primary_gateway' => 'paystack',
             'secondary_gateway' => 'flutterwave',
            ],
            
        ]);
  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');

    }
};
