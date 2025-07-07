<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use App\Models\StoreUser;
use App\Models\Role;
use Illuminate\Database\Seeder;

class StoreUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = Store::where('id', '>', 2)->get();
        // Get the store_owner role
        $storeOwnerRole = Role::where('slug', 'store_owner')->first();
        
        if (!$storeOwnerRole) {
            $this->command->warn('Role with slug "store_owner" not found. Please ensure the role exists.');
            return;
        }

        foreach ($stores as $store) {
            // Create StoreUser for the store owner
            StoreUser::create([
                'store_id' => $store->id,
                'user_id' => $store->user_id,
                'role_id' => $storeOwnerRole->id,
                'permissions' => $storeOwnerRole->permissions,
                'status' => 'active'
            ]);
        }

        $this->command->info('Store team members seeded successfully!');
        $this->command->info('Created ' . StoreUser::count() . ' store team members for stores with ID > 2.');
    }
} 