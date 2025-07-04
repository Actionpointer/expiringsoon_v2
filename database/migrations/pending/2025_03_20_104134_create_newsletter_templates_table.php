<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('newsletter_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description', 255);
            $table->string('subject');
            $table->text('content');
            $table->boolean('is_active')->default(1); //still in use
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_templates');
    }
}; 