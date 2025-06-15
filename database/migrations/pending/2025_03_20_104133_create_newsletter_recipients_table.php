<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('newsletter_recipients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('newsletter_id');
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_opened')->default(false);
            $table->boolean('is_clicked')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->string('status')->default('pending'); // pending, sent, failed, bounced
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->foreign('newsletter_id')->references('id')->on('newsletters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->index(['newsletter_id', 'status']);
            $table->index(['user_id', 'is_sent']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_recipients');
    }
}; 