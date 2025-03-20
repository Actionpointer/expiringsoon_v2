<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firsname', 50);
            $table->string('surname', 50);
            $table->string('email', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->text('password');
            $table->string('photo', 50)->nullable();
            $table->string('phone', 50);
            $table->boolean('status')->default(true);
            $table->string('remember_token')->nullable();
            $table->boolean('require_password_change')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
