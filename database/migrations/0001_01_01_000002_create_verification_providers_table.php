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

        Schema::create('verification_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Internal name:Veriff, Onfido, etc.
            $table->string('slug')->unique();
            $table->string('display_name');
            $table->json('supported_documents')->nullable(); // List of documents they can verify
            $table->json('capabilities')->nullable();     // Features: face_match, liveness, etc.
            $table->json('regions')->nullable();  // Add regions field
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $verifiers = VerificationProvidersTableSeeder::getVerificationProviders();
        foreach ($verifiers as $verifier) {
            DB::table('verification_providers')->insert($verifier);
        }

        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_providers');
        

    }
};
