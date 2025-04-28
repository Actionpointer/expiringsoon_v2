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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('symbol');
            $table->string('decimal_places');
            $table->string('decimal_name');
            $table->boolean('status');
            $table->timestamps();
        });
        DB::table('currencies')->insert([
            ['id' => 1, 'name' => 'Naira', 'code' => 'ngn', 'symbol' => '₦','decimal_name'=>'Kobo','decimal_places'=> '2','status'=> 1],
            
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
