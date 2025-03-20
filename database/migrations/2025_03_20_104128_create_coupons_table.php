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
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('available')->default(1);
            $table->boolean('is_percentage');
            $table->double('value', 8, 2)->default(0);
            $table->integer('limit_per_user')->nullable();
            $table->string('role', 16);
            $table->double('minimum_spend', null, 0)->nullable();
            $table->double('maximum_spend', null, 0)->nullable();
            $table->integer('country_id')->nullable();
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
