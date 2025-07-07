<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'United States',
                'code' => 'US',
                'phone_code' => '+1',
                'status' => true,
            ],
            [
                'name' => 'United Kingdom',
                'code' => 'GB',
                'phone_code' => '+44',
                'status' => true,
            ],
            [
                'name' => 'Canada',
                'code' => 'CA',
                'phone_code' => '+1',
                'status' => true,
            ],
            [
                'name' => 'Australia',
                'code' => 'AU',
                'phone_code' => '+61',
                'status' => true,
            ],
            [
                'name' => 'Germany',
                'code' => 'DE',
                'phone_code' => '+49',
                'status' => true,
            ],
            [
                'name' => 'France',
                'code' => 'FR',
                'phone_code' => '+33',
                'status' => true,
            ],
            [
                'name' => 'Italy',
                'code' => 'IT',
                'phone_code' => '+39',
                'status' => true,
            ],
            [
                'name' => 'Spain',
                'code' => 'ES',
                'phone_code' => '+34',
                'status' => true,
            ],
            [
                'name' => 'Netherlands',
                'code' => 'NL',
                'phone_code' => '+31',
                'status' => true,
            ],
            [
                'name' => 'Belgium',
                'code' => 'BE',
                'phone_code' => '+32',
                'status' => true,
            ],
        ];

        foreach ($countries as $countryData) {
            Country::firstOrCreate(
                ['code' => $countryData['code']],
                $countryData
            );
        }

        $this->command->info('Countries seeded successfully!');
        $this->command->info('Created ' . Country::count() . ' countries.');
    }
} 