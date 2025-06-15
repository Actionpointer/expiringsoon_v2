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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('password');
            $table->string('photo', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->unsignedBigInteger('country_id');
            $table->boolean('status')->default(true);
            $table->string('remember_token')->nullable();
            $table->boolean('require_password_change')->default(false);
            $table->json('settings')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('users')->insert([
            ['id' => 1, 'firstname' => 'Super', 'surname' => 'Admin', 'email' => 'reigningkingforever@gmail.com',
            'password'=>'$2y$12$H03UYTKV.ZVaim0QqNZvn.2boOO3iYGrIc6T6LB/J0056fqm.k3yi','country_id'=> '1','require_password_change'=> 1],
            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
