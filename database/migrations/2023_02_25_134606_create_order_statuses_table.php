<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
        /*
        processing - user
        cancelled - user
        
        shipped - shop
        ready - shop
        delivered - shop

        completed - user/system
        rejected - user

        returned - user

        refunded - shop/system
        disputed - shop

        closed - admin
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
