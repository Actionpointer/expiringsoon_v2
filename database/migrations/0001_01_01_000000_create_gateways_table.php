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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('display_name');
            $table->json('regions')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $gateways = GatewaysTableSeeder::getGateways();
        foreach ($gateways as $gateway) {
            DB::table('gateways')->insert($gateway);
        }

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
