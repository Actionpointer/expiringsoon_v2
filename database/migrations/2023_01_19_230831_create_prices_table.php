<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('country_id');
            $table->string('months_1')->default(0);
            $table->string('months_3')->default(0);
            $table->string('months_6')->default(0);
            $table->string('months_12')->default(0);
            $table->string('commission_percentage')->default(0);
            $table->string('commission_fixed')->default(0);
            $table->string('minimum_payout')->default(0);
            $table->string('maximum_payout')->default(0);
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
        Schema::dropIfExists('prices');
    }
}
