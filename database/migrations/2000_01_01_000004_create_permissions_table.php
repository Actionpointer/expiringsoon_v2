<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('permissions')->insert(array(
            array('id' => 1, 'name'=> 'adplans', 'description'=>'Advert Plans'),
            array('id' => 2, 'name'=> 'adverts', 'description'=>'Adverts'),
            array('id' => 3, 'name'=> 'coupons', 'description'=>'Coupons'),
            array('id' => 4, 'name'=> 'adsets', 'description'=>'Advert Subscriptions'),
            array('id' => 5, 'name'=> 'orders', 'description'=>'Orders'),
            array('id' => 6, 'name'=> 'orderstatus', 'description'=>'Order Statuses'),
            array('id' => 7, 'name'=> 'dispute', 'description'=>'Order Dispute'),
            array('id' => 8, 'name'=> 'payments', 'description'=>'Payments'),
            array('id' => 9, 'name'=> 'payouts', 'description'=>'Payouts'),
            array('id' => 10, 'name'=> 'plans', 'description'=>'Plans'),
            array('id' => 11, 'name'=> 'products', 'description'=>'Products'),
            array('id' => 12, 'name'=> 'reviews', 'description'=>'Product and Shop Reviews'),
            array('id' => 13, 'name'=> 'shipping', 'description'=>'Logistics'),
            array('id' => 14, 'name'=> 'shops', 'description'=>'Shops'),
            array('id' => 15, 'name'=> 'subscriptions', 'description'=>'Shop Subscriptions'),
            array('id' => 16, 'name'=> 'users', 'description'=>'Users'),
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
