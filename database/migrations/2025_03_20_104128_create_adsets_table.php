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
        Schema::create('adsets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('adplan_id');
            $table->string('slug')->nullable();
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->integer('units')->default(1);
            $table->double('amount', null, 0);
            $table->boolean('status')->default(false);
            $table->boolean('auto_renew')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('adplan_id')->references('id')->on('adplans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adsets');
    }
};
