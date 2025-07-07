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
            $table->unsignedBigInteger('verification_provider_id')->default('manual'); // manual, smile, veriff, jumio
            $table->boolean('auto_verify_after_pass')->default(false); // Auto-approve if all checks pass
            $table->integer('verification_validity_days')->default(0); // 0 = Never Expires, 180, 365, 730
            $table->string('mode')->default('test'); // live or test
            // Document requirements as JSON arrays of objects
            $table->json('id_documents')->nullable(); // [{key, require_file, require_issue_date, require_expiry_date, require_document_number}]
            $table->json('business_documents')->nullable();
            $table->json('address_documents')->nullable();
            $table->json('additional_documents')->nullable();
            $table->string('id_requirement')->default('any'); // 'any' or 'all'
            $table->string('business_requirement')->default('any');
            $table->string('address_requirement')->default('any');
            $table->string('additional_requirement')->default('any');
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
