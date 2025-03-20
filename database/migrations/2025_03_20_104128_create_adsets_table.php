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
        Schema::create('adsets', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('user_id');
            $table->bigInteger('adplan_id');
            $table->string('slug')->nullable();
            $table->timestamp('start_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('end_at')->default('0000-00-00 00:00:00');
            $table->integer('units')->default(1);
            $table->double('amount', null, 0);
            $table->boolean('status')->default(false);
            $table->boolean('auto_renew')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adsets');
    }
};
