<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get available countries
        $country = Country::where('iso2','NG')->first();
        
        // Create sample users
        $users = [
            [
                'firstname' => 'John',
                'surname' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+1234567890',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Jane',
                'surname' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+1234567891',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Michael',
                'surname' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '+1234567892',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Sarah',
                'surname' => 'Williams',
                'email' => 'sarah.williams@example.com',
                'phone' => '+1234567893',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'David',
                'surname' => 'Brown',
                'email' => 'david.brown@example.com',
                'phone' => '+1234567894',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Emily',
                'surname' => 'Davis',
                'email' => 'emily.davis@example.com',
                'phone' => '+1234567895',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Robert',
                'surname' => 'Miller',
                'email' => 'robert.miller@example.com',
                'phone' => '+1234567896',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Lisa',
                'surname' => 'Wilson',
                'email' => 'lisa.wilson@example.com',
                'phone' => '+1234567897',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'James',
                'surname' => 'Taylor',
                'email' => 'james.taylor@example.com',
                'phone' => '+1234567898',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'Jennifer',
                'surname' => 'Anderson',
                'email' => 'jennifer.anderson@example.com',
                'phone' => '+1234567899',
                'country_id' => $country->id,
                'status' => true,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create([
                'firstname' => $userData['firstname'],
                'surname' => $userData['surname'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'country_id' => $userData['country_id'],
                'status' => $userData['status'],
                'email_verified_at' => $userData['email_verified_at'],
                'password' => Hash::make('password123'),
                'settings' => json_encode([
                    'notifications' => true,
                    'marketing_emails' => true,
                    'language' => 'en'
                ])
            ]);
        }

        // Create additional random users using factory
        // User::factory(20)->create([
        //     'country_id' => $country->id,
        //     'password' => Hash::make('password123'),
        // ]);
    }
} 