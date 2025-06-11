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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('advertable_type');
            $table->unsignedBigInteger('advertable_id');
            $table->unsignedBigInteger('adset_id');
            $table->unsignedBigInteger('state_id');
            $table->string('photo')->nullable();
            $table->string('heading', 255)->nullable();
            $table->string('subheading', 255)->nullable();
            $table->string('offer', 255)->nullable();
            $table->string('text_color');
            $table->string('button_text');
            $table->string('button_color');
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('clicks')->default(0);
            $table->unsignedBigInteger('conversions')->default(0);
            $table->decimal('conversion_value', 10, 2)->default(0);
            $table->decimal('ctr', 5, 2)->default(0); // Click-through rate percentage
            $table->timestamps();
            $table->foreign('adset_id')->references('id')->on('adsets')->onDelete('cascade');
            $table->index(['advertable_type', 'advertable_id']);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
