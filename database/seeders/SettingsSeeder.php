<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Pages
            ['name' => 'auto_approve_store', 'value' => '1'],
            ['name' => 'auto_approve_products', 'value' => '1'],
            ['name' => 'auto_approve_adverts', 'value' => '1'],
            ['name' => 'order_processing_to_delivery_period', 'value' => '1'],  
        ];

        // Insert all settings
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
