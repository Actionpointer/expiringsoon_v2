<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Color',
                'slug' => 'color',
                'options' => 'Red,Blue,Green,Yellow,Purple,Black,White,Orange,Pink,Brown',
                'is_active' => true,
            ],
            [
                'name' => 'Size',
                'slug' => 'size',
                'options' => 'Large,Medium,Small,XL,XXL,XS',
                'is_active' => true,
            ],
            [
                'name' => 'Weight',
                'slug' => 'weight',
                'options' => 'Light,Medium,Heavy',
                'is_active' => true,
            ],
            [
                'name' => 'Material',
                'slug' => 'material',
                'options' => 'Cotton,Polyester,Wool,Leather,Plastic,Metal,Wood,Glass',
                'is_active' => true,
            ],
            [
                'name' => 'Style',
                'slug' => 'style',
                'options' => 'Casual,Formal,Sport,Classic,Modern,Vintage',
                'is_active' => true,
            ],
            [
                'name' => 'Brand',
                'slug' => 'brand',
                'options' => 'Nike,Adidas,Apple,Samsung,Sony,Canon',
                'is_active' => true,
            ],
            [
                'name' => 'Type',
                'slug' => 'type',
                'options' => 'Digital,Analog,Wireless,Wired,Portable,Stationary',
                'is_active' => true,
            ],
            [
                'name' => 'Capacity',
                'slug' => 'capacity',
                'options' => '32GB,64GB,128GB,256GB,512GB,1TB',
                'is_active' => true,
            ],
        ];

        foreach ($attributes as $attribute) {
            ProductAttribute::firstOrCreate(
                ['slug' => $attribute['slug']],
                $attribute
            );
        }

        $this->command->info('Product attributes seeded successfully!');
        $this->command->info('Created ' . ProductAttribute::count() . ' product attributes.');
    }
} 