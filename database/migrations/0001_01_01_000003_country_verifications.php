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
        Schema::create('country_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id'); 
            $table->unsignedBigInteger('verification_provider_id'); // manual, smile, veriff, jumio
            $table->boolean('auto_verify_after_pass')->default(false); // Auto-approve if all checks pass
            $table->integer('verification_validity_days')->default(0); // 0 = Never Expires, 180, 365, 730
            $table->string('mode')->default('test'); // live or test
            // Government ID
            $table->string('id_requirement')->default('all');   // all, any, none
            $table->json('id_documents')->nullable(); // nationalId, driverLicense, passport, votersCard
            
            // Business Documents
            $table->string('business_requirement')->default('any');   // all, any, none
            $table->json('business_documents')->nullable(); // regCertificate, taxCertificate, tradingLicense, vatCertificate
            
            // Address Verification
            $table->string('address_requirement')->default('any');   // all, any, none
            $table->json('address_documents')->nullable(); // utilityBill, bankStatement, tenancyAgreement, councilTax
            
            // Additional Requirements
            $table->string('additional_requirement')->default('any'); // all, any, none
            $table->json('additional_documents')->nullable(); // requireSelfie, requireProofOfOwnership, requirePhoneVerification, requireEmailVerification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_verifications');
    }
};
