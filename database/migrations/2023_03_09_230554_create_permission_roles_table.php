<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->boolean('list')->default(1);
            $table->boolean('view')->default(1);
            $table->boolean('edit')->default(1);
            $table->boolean('new')->default(1);
            $table->boolean('remove')->default(1);
            $table->boolean('download')->default(1);
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
        DB::table('permission_roles')->insert(array(
            array('id' => 1, 'role_id'=> 1, 'permission_id'=> 1),
            array('id' => 2, 'role_id'=> 1, 'permission_id'=> 2),
            array('id' => 3, 'role_id'=> 1, 'permission_id'=> 3),
            array('id' => 4, 'role_id'=> 1, 'permission_id'=> 4),
            array('id' => 5, 'role_id'=> 1, 'permission_id'=> 5),
            array('id' => 6, 'role_id'=> 1, 'permission_id'=> 6),
            array('id' => 7, 'role_id'=> 1, 'permission_id'=> 7),
            array('id' => 8, 'role_id'=> 1, 'permission_id'=> 8),
            array('id' => 9, 'role_id'=> 1, 'permission_id'=> 9),
            array('id' => 10, 'role_id'=> 1, 'permission_id'=> 10),
            array('id' => 11, 'role_id'=> 2, 'permission_id'=> 1),
            array('id' => 12, 'role_id'=> 2, 'permission_id'=> 2),
            array('id' => 13, 'role_id'=> 2, 'permission_id'=> 3),
            array('id' => 14, 'role_id'=> 2, 'permission_id'=> 4),
            array('id' => 15, 'role_id'=> 2, 'permission_id'=> 5),
            array('id' => 16, 'role_id'=> 2, 'permission_id'=> 6),
            array('id' => 17, 'role_id'=> 2, 'permission_id'=> 7),
            array('id' => 18, 'role_id'=> 2, 'permission_id'=> 8),
            array('id' => 19, 'role_id'=> 2, 'permission_id'=> 9),
            array('id' => 20, 'role_id'=> 2, 'permission_id'=> 10),
            array('id' => 21, 'role_id'=> 3, 'permission_id'=> 3),
            array('id' => 22, 'role_id'=> 3, 'permission_id'=> 4),
            array('id' => 23, 'role_id'=> 3, 'permission_id'=> 5),
            array('id' => 24, 'role_id'=> 3, 'permission_id'=> 6),
            array('id' => 25, 'role_id'=> 3, 'permission_id'=> 9),
            array('id' => 26, 'role_id'=> 4, 'permission_id'=> 4),
            array('id' => 27, 'role_id'=> 4, 'permission_id'=> 5),
            array('id' => 28, 'role_id'=> 4, 'permission_id'=> 6),
            array('id' => 29, 'role_id'=> 4, 'permission_id'=> 7),
            array('id' => 30, 'role_id'=> 4, 'permission_id'=> 8),
            array('id' => 31, 'role_id'=> 4, 'permission_id'=> 9),
            array('id' => 32, 'role_id'=> 5, 'permission_id'=> 9),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_roles');
    }
}
