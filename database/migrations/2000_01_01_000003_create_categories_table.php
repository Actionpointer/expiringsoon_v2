<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('photo');
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('group_by')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $categories = CategoriesTableSeeder::getCategories();
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
