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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('slug');
            $table->string('name');
            $table->string('legal_business_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('contact_person')->nullable();
            $table->string('alt_contact_phone')->nullable();
            $table->string('business_type');
            $table->string('tax_id')->nullable();
            $table->string('business_registration_number')->nullable();
            $table->year('year_established')->nullable();
            $table->text('description')->nullable();
            $table->string('address');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('zip_code');
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('photo')->nullable();
            $table->string('banner')->nullable();
            $table->string('commission_override')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamp('approved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'published', 'approved_at']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
