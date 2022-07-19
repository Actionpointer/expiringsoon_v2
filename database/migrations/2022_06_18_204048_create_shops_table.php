<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
        $table->id();
        $table->string('slug');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('banner')->nullable();
        $table->string('address');
        $table->unsignedBigInteger('city_id');
        $table->unsignedBigInteger('state_id');
        $table->unsignedBigInteger('country_id');
        $table->boolean('status')->default(0);
        $table->integer('commission')->default(0);
        $table->double('wallet')->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
