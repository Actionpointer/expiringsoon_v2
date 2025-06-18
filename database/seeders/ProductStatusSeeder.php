<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Example: randomly assign status to existing products
        $statuses = ['draft', 'active', 'archived'];

        Product::all()->each(function ($product) use ($statuses) {
            $product->update([
                'status' => $statuses[array_rand($statuses)],
            ]);
        });

        // Or create new sample products with status
        // Product::factory()->count(10)->create([
        //     'status' => function () use ($statuses) {
        //         return $statuses[array_rand($statuses)];
        //     },
        // ]);
    }
}
