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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_key_id');
            $table->string('method')->comment('HTTP method: GET, POST, PUT, PATCH, DELETE');
            $table->string('endpoint');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->json('headers')->nullable();
            $table->json('request_data')->nullable()->comment('Request payload');
            $table->json('response_data')->nullable()->comment('Response payload');
            $table->integer('response_status')->nullable();
            $table->string('duration', 8, 2)->nullable()->comment('Request duration in seconds');
            $table->text('error')->nullable();
            $table->timestamps();

            $table->foreign('api_key_id')->references('id')->on('api_keys')->onDelete('cascade');
            $table->index(['api_key_id', 'created_at']);
            $table->index(['method', 'endpoint']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
