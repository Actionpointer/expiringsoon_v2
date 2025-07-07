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
            // Account Settings
            $table->integer('account_length')->default(0);
            $table->decimal('tax_rate', 5, 2)->nullable(); // Changed to decimal for better precision
            $table->decimal('newsletter_cost', 10, 2)->default(0); // Changed to decimal
            // Wallet Settings
            $table->boolean('freeze_wallets')->default(false);
            // Transaction Charges
            $table->json('transaction_charges')->nullable(); // Structure: { "percentage": 10, "fixed": 10000, "cap": 100000 }
            // Withdrawal Settings
            $table->json('withdrawal_charges')->nullable(); // Structure: { "percentage": 10, "fixed": 10000, "cap": 100000 }
            $table->boolean('instant_withdrawal')->default(false);
            $table->boolean('requires_approval')->default(false);
            $table->boolean('weekend_processing')->default(false);
            $table->boolean('holiday_processing')->default(false);
            
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
