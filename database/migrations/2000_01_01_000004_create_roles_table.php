<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('slug');
            $table->string('type')->default('admin'); //admin/store
            $table->json('permissions');
            $table->timestamps();
        });

        $permissions = DB::table('permissions')->pluck('id')->toArray();
        DB::table('roles')->insert([
                ['id' => 1, 'name' => 'Super Admin', 'slug' => 'super-admin', 'type' => 'admin', 'description' => 'Super Admin', 'permissions' => json_encode($permissions)]
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
