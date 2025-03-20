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
            $table->bigIncrements('id');
            $table->string('advertable_type');
            $table->unsignedBigInteger('advertable_id');
            $table->bigInteger('adset_id');
            $table->bigInteger('state_id');
            $table->string('photo')->nullable();
            $table->string('heading', 255)->nullable();
            $table->string('subheading', 255)->nullable();
            $table->string('offer', 255)->nullable();
            $table->string('text_color');
            $table->string('button_text');
            $table->string('button_color');
            $table->boolean('approved')->default(false);
            $table->bigInteger('views')->default(0);
            $table->bigInteger('clicks')->default(0);
            $table->timestamps();

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
