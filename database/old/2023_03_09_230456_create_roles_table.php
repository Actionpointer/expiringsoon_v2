<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('roles')->insert(array(
            array('id' => 1, 'name'=> 'superadmin', 'description'=>'System Super Admin'),
            array('id' => 2, 'name'=> 'admin', 'description'=>'Country Admin'),
            array('id' => 3, 'name'=> 'manager', 'description'=>'Country Manager'),
            array('id' => 4, 'name'=> 'customer_care', 'description'=>'Country Customer Care'),
            array('id' => 5, 'name'=> 'auditor', 'description'=>'Country Financial Auditor'),
            array('id' => 6, 'name'=> 'vendor', 'description'=>'Shop Owner'),
            array('id' => 7, 'name'=> 'staff', 'description'=>'Shop Staff'),
            array('id' => 8, 'name'=> 'shopper', 'description'=>'Buyers'),

        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
