<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $roles = [
            [
                'name' => 'Admin',
                'description' => 'System administrator with full access',
                'slug' => 'admin',
                'permissions' => json_encode(['*']),
                'type' => 'system',
            ],
            [
                'name' => 'Store Owner',
                'description' => 'User who owns and manages a store',
                'slug' => 'store_owner',
                'permissions' => json_encode(['create_product', 'manage_store', 'view_orders']),
                'type' => 'user',
            ],
            [
                'name' => 'Staff',
                'description' => 'Store staff with limited permissions',
                'slug' => 'staff',
                'permissions' => json_encode(['view_orders', 'update_inventory']),
                'type' => 'user',
            ],
            [
                'name' => 'Customer',
                'description' => 'End user who buys products',
                'slug' => 'customer',
                'permissions' => json_encode([]),
                'type' => 'user',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
