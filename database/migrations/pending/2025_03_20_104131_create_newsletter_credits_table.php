<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('newsletter_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->integer('credits_available')->default(0);
            $table->integer('credits_used')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_credits');
    }
}; 