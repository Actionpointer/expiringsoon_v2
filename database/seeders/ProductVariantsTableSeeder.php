<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This seeder is no longer needed as variants are created in ProductsTableSeeder.
        $this->command->info('Product variants are now created in ProductsTableSeeder.');
    }
} 