<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->string('type')->nullable(); // e.g. image/jpeg, image/png
            $table->string('size');
            $table->string('path');
            $table->timestamps();
            $table->index('store_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}