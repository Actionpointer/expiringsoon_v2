<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountriesTableSeeder::class,
            UsersTableSeeder::class,
            StoresTableSeeder::class,
            StoreUsersTableSeeder::class,
            ProductAttributesTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}
