<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductOption;
use App\Models\ProductAttribute;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = Store::where('id', '>', 2)->get();
        $categories = Category::all();
        $attributes = ProductAttribute::where('is_active', true)->get();
        
        if ($stores->isEmpty()) {
            $this->command->warn('No stores found with ID > 2. Please run StoresTableSeeder first.');
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please run CategoriesTableSeeder first.');
            return;
        }

        if ($attributes->isEmpty()) {
            $this->command->warn('No product attributes found. Please run ProductAttributesTableSeeder first.');
            return;
        }

        // Sample product data
        $products = [
            [
                'name' => 'Premium Wireless Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation and premium sound quality. Perfect for music lovers and professionals.',
                'meta_description' => 'Premium wireless headphones with noise cancellation',
                'photos' => [
                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500',
                    'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=500',
                    'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=500'
                ],
                'attributes' => ['color', 'brand'],
                'variants' => [
                    [
                        'name' => 'Black - Apple',
                        'price' => '299.99',
                        'stock' => 50,
                        'options' => ['color' => 'Black', 'brand' => 'Apple'],
                        'photo' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'White - Apple',
                        'price' => '299.99',
                        'stock' => 30,
                        'options' => ['color' => 'White', 'brand' => 'Apple'],
                        'photo' => 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Smart Fitness Watch',
                'description' => 'Advanced fitness tracking watch with heart rate monitor, GPS, and smartphone connectivity. Track your workouts and stay connected.',
                'meta_description' => 'Smart fitness watch with advanced tracking features',
                'photos' => [
                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500',
                    'https://images.unsplash.com/photo-1544117519-31a4b719223d?w=500',
                    'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=500'
                ],
                'attributes' => ['color', 'size'],
                'variants' => [
                    [
                        'name' => 'Black - Large',
                        'price' => '199.99',
                        'stock' => 25,
                        'options' => ['color' => 'Black', 'size' => 'Large'],
                        'photo' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Blue - Medium',
                        'price' => '199.99',
                        'stock' => 35,
                        'options' => ['color' => 'Blue', 'size' => 'Medium'],
                        'photo' => 'https://images.unsplash.com/photo-1544117519-31a4b719223d?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Professional Camera Lens',
                'description' => 'High-quality camera lens for professional photography. Perfect for portraits, landscapes, and various shooting scenarios.',
                'meta_description' => 'Professional camera lens for photography',
                'photos' => [
                    'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=500',
                    'https://images.unsplash.com/photo-1554048612-b6a482bc67e5?w=500',
                    'https://images.unsplash.com/photo-1510127034890-ba275aee7129?w=500'
                ],
                'attributes' => ['brand', 'capacity'],
                'variants' => [
                    [
                        'name' => 'Canon - 50mm',
                        'price' => '599.99',
                        'stock' => 15,
                        'options' => ['brand' => 'Canon', 'capacity' => '50mm'],
                        'photo' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Sony - 85mm',
                        'price' => '799.99',
                        'stock' => 10,
                        'options' => ['brand' => 'Sony', 'capacity' => '85mm'],
                        'photo' => 'https://images.unsplash.com/photo-1554048612-b6a482bc67e5?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Designer Leather Bag',
                'description' => 'Premium leather handbag with elegant design and spacious interior. Perfect for everyday use and special occasions.',
                'meta_description' => 'Premium leather designer handbag',
                'photos' => [
                    'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=500',
                    'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?w=500',
                    'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=500'
                ],
                'attributes' => ['color', 'material', 'style'],
                'variants' => [
                    [
                        'name' => 'Brown - Leather - Classic',
                        'price' => '399.99',
                        'stock' => 20,
                        'options' => ['color' => 'Brown', 'material' => 'Leather', 'style' => 'Classic'],
                        'photo' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Black - Leather - Modern',
                        'price' => '449.99',
                        'stock' => 18,
                        'options' => ['color' => 'Black', 'material' => 'Leather', 'style' => 'Modern'],
                        'photo' => 'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Wireless Gaming Mouse',
                'description' => 'High-performance wireless gaming mouse with customizable RGB lighting and precision tracking. Perfect for gamers and professionals.',
                'meta_description' => 'Wireless gaming mouse with RGB lighting',
                'photos' => [
                    'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500',
                    'https://images.unsplash.com/photo-1605773527852-c546a8584ea3?w=500',
                    'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500'
                ],
                'attributes' => ['color', 'type'],
                'variants' => [
                    [
                        'name' => 'Red - Wireless',
                        'price' => '89.99',
                        'stock' => 40,
                        'options' => ['color' => 'Red', 'type' => 'Wireless'],
                        'photo' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Blue - Wireless',
                        'price' => '89.99',
                        'stock' => 35,
                        'options' => ['color' => 'Blue', 'type' => 'Wireless'],
                        'photo' => 'https://images.unsplash.com/photo-1605773527852-c546a8584ea3?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Smart Home Speaker',
                'description' => 'Voice-controlled smart speaker with premium audio quality and home automation features. Connect and control your smart home devices.',
                'meta_description' => 'Voice-controlled smart home speaker',
                'photos' => [
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500',
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500',
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500'
                ],
                'attributes' => ['color', 'brand', 'type'],
                'variants' => [
                    [
                        'name' => 'White - Apple - Wireless',
                        'price' => '199.99',
                        'stock' => 30,
                        'options' => ['color' => 'White', 'brand' => 'Apple', 'type' => 'Wireless'],
                        'photo' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Black - Samsung - Wireless',
                        'price' => '179.99',
                        'stock' => 25,
                        'options' => ['color' => 'Black', 'brand' => 'Samsung', 'type' => 'Wireless'],
                        'photo' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Premium Coffee Maker',
                'description' => 'Professional coffee maker with programmable settings and built-in grinder. Brew the perfect cup of coffee every time.',
                'meta_description' => 'Professional coffee maker with grinder',
                'photos' => [
                    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500',
                    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500',
                    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500'
                ],
                'attributes' => ['color', 'brand'],
                'variants' => [
                    [
                        'name' => 'Silver - Apple',
                        'price' => '299.99',
                        'stock' => 15,
                        'options' => ['color' => 'Silver', 'brand' => 'Apple'],
                        'photo' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Black - Samsung',
                        'price' => '279.99',
                        'stock' => 12,
                        'options' => ['color' => 'Black', 'brand' => 'Samsung'],
                        'photo' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'High-quality yoga mat with excellent grip and cushioning. Perfect for yoga, pilates, and fitness activities.',
                'meta_description' => 'Premium yoga mat with excellent grip',
                'photos' => [
                    'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500',
                    'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500',
                    'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500'
                ],
                'attributes' => ['color', 'material', 'style'],
                'variants' => [
                    [
                        'name' => 'Purple - Cotton - Sport',
                        'price' => '49.99',
                        'stock' => 60,
                        'options' => ['color' => 'Purple', 'material' => 'Cotton', 'style' => 'Sport'],
                        'photo' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Green - Polyester - Sport',
                        'price' => '44.99',
                        'stock' => 55,
                        'options' => ['color' => 'Green', 'material' => 'Polyester', 'style' => 'Sport'],
                        'photo' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Digital Drawing Tablet',
                'description' => 'Professional drawing tablet with pressure sensitivity and high resolution. Perfect for digital artists and designers.',
                'meta_description' => 'Professional digital drawing tablet',
                'photos' => [
                    'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500',
                    'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500',
                    'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500'
                ],
                'attributes' => ['brand', 'capacity'],
                'variants' => [
                    [
                        'name' => 'Apple - 256GB',
                        'price' => '899.99',
                        'stock' => 8,
                        'options' => ['brand' => 'Apple', 'capacity' => '256GB'],
                        'photo' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Samsung - 512GB',
                        'price' => '799.99',
                        'stock' => 6,
                        'options' => ['brand' => 'Samsung', 'capacity' => '512GB'],
                        'photo' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500',
                        'is_default' => false
                    ]
                ]
            ],
            [
                'name' => 'Smart LED Light Bulb',
                'description' => 'WiFi-enabled smart LED bulb with color changing capabilities and voice control. Create the perfect ambiance for any room.',
                'meta_description' => 'Smart LED bulb with voice control',
                'photos' => [
                    'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500',
                    'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500',
                    'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500'
                ],
                'attributes' => ['color', 'type'],
                'variants' => [
                    [
                        'name' => 'White - Wireless',
                        'price' => '29.99',
                        'stock' => 100,
                        'options' => ['color' => 'White', 'type' => 'Wireless'],
                        'photo' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500',
                        'is_default' => true
                    ],
                    [
                        'name' => 'Warm White - Wireless',
                        'price' => '34.99',
                        'stock' => 80,
                        'options' => ['color' => 'Yellow', 'type' => 'Wireless'],
                        'photo' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500',
                        'is_default' => false
                    ]
                ]
            ]
        ];

        foreach ($stores as $store) {
            foreach ($products as $productData) {
                $category = $categories->random();
                
                // Create product
                $product = Product::create([
                    'store_id' => $store->id,
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'meta_description' => $productData['meta_description'],
                    'photos' => $productData['photos'],
                    'preorder' => false,
                    'always_available' => true,
                    'published' => true,
                    'approved_at' => now(),
                ]);

                // Create product options
                foreach ($productData['attributes'] as $attributeSlug) {
                    $attribute = $attributes->where('slug', $attributeSlug)->first();
                    if ($attribute) {
                        $values = explode(',', $attribute->options);
                        $selectedValues = array_slice($values, 0, 3); // Take first 3 values
                        
                        ProductOption::create([
                            'product_id' => $product->id,
                            'product_attribute_id' => $attribute->id,
                            'values' => $selectedValues,
                        ]);
                    }
                }

                // Create product variants
                foreach ($productData['variants'] as $variantData) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'name' => $variantData['name'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'options' => $variantData['options'],
                        'photo' => $variantData['photo'],
                        'is_default' => $variantData['is_default'],
                        'is_active' => true,
                        'type' => 'product',
                    ]);
                }
            }
        }

        $this->command->info('Products seeded successfully!');
        $this->command->info('Created ' . Product::count() . ' products with variants and options.');
    }
} 