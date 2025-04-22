<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->timestamps();
        });
        
        DB::table('permissions')->insert([
            // System & Settings (1-3)
            ['id' => 1, 'name' => 'settings', 'description' => 'System Settings', 'category' => 'System & Settings'],
            ['id' => 2, 'name' => 'security', 'description' => 'Manage Security System', 'category' => 'System & Settings'],
            ['id' => 3, 'name' => 'api_management', 'description' => 'Api Management', 'category' => 'System & Settings'],
            
            // User Management (4-6)
            ['id' => 4, 'name' => 'admin', 'description' => 'Admin Users', 'category' => 'User Management'],
            ['id' => 5, 'name' => 'customers', 'description' => 'Customers', 'category' => 'User Management'],
            ['id' => 6, 'name' => 'verifications', 'description' => 'Verification', 'category' => 'User Management'],
            
            // Support (7-8)
            ['id' => 7, 'name' => 'support', 'description' => 'Support', 'category' => 'Support'],
            ['id' => 8, 'name' => 'disputes', 'description' => 'Manage Disputes', 'category' => 'Support'],

            // Shop Management (9-10)
            ['id' => 9, 'name' => 'shops', 'description' => 'Shops', 'category' => 'Shop Management'],
            ['id' => 10, 'name' => 'subscriptions', 'description' => 'Shop Subscriptions', 'category' => 'Shop Management'],

            // Product & Reviews (11-12)
            ['id' => 11, 'name' => 'products', 'description' => 'Products', 'category' => 'Product & Reviews'],
            ['id' => 12, 'name' => 'reviews', 'description' => 'Product and Shop Reviews', 'category' => 'Product & Reviews'],

            // Orders & Shipping (13-14)
            ['id' => 13, 'name' => 'orders', 'description' => 'Orders', 'category' => 'Orders & Shipping'],
            ['id' => 14, 'name' => 'shipment', 'description' => 'Shipment', 'category' => 'Orders & Shipping'],

            // Financial (15-19)
            ['id' => 15, 'name' => 'payments', 'description' => 'Payments', 'category' => 'Financial'],
            ['id' => 16, 'name' => 'withdrawals', 'description' => 'Withdrawals', 'category' => 'Financial'],
            ['id' => 17, 'name' => 'settlements', 'description' => 'Settlements', 'category' => 'Financial'],
            ['id' => 18, 'name' => 'revenue', 'description' => 'Revenue', 'category' => 'Financial'],
            ['id' => 19, 'name' => 'bank_accounts', 'description' => 'Bank Account Details', 'category' => 'Financial'],

            // Marketing & Content (20-23)
            ['id' => 20, 'name' => 'adverts', 'description' => 'Adverts', 'category' => 'Marketing & Content'],
            ['id' => 21, 'name' => 'coupons', 'description' => 'Coupons', 'category' => 'Marketing & Content'],
            ['id' => 22, 'name' => 'blog', 'description' => 'Manage Blog Posts', 'category' => 'Marketing & Content'],
            ['id' => 23, 'name' => 'newsletter', 'description' => 'Manage Newsletter', 'category' => 'Marketing & Content'],

            //Reports (24-25)
            ['id' => 24, 'name' => 'reports', 'description' => 'Reports', 'category' => 'Reports'],
            ['id' => 25, 'name' => 'analytics', 'description' => 'Analytics', 'category' => 'Reports'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
