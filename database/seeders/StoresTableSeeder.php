<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get available users, countries, states, and cities
        $users = User::where('id', '>', 1)->get(); // Exclude super admin
        $country = Country::where('iso2','NG')->first();
        
        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UsersTableSeeder first.');
            return;
        }

        // Sample store data
        $stores = [
            [
                'name' => 'Tech Gadgets Pro',
                'legal_business_name' => 'Tech Gadgets Pro LLC',
                'email' => 'contact@techgadgetspro.com',
                'phone' => '+1234567890',
                'contact_person' => 'John Tech',
                'business_type' => 'Electronics',
                'tax_id' => 'TAX123456789',
                'business_registration_number' => 'BRN987654321',
                'year_established' => 2020,
                'description' => 'Premium electronics and gadgets store offering the latest technology products.',
                'address' => '123 Tech Street',
                'zip_code' => '10001',
                'website' => 'https://techgadgetspro.com',
                'facebook' => 'techgadgetspro',
                'instagram' => 'techgadgetspro',
                'twitter' => 'techgadgetspro',
            ],
            [
                'name' => 'Fashion Forward',
                'legal_business_name' => 'Fashion Forward Inc',
                'email' => 'hello@fashionforward.com',
                'phone' => '+1234567891',
                'contact_person' => 'Sarah Style',
                'business_type' => 'Fashion',
                'tax_id' => 'TAX123456790',
                'business_registration_number' => 'BRN987654322',
                'year_established' => 2019,
                'description' => 'Trendy fashion store with the latest styles and accessories.',
                'address' => '456 Fashion Avenue',
                'zip_code' => '10002',
                'website' => 'https://fashionforward.com',
                'facebook' => 'fashionforward',
                'instagram' => 'fashionforward',
                'twitter' => 'fashionforward',
            ],
            [
                'name' => 'Home & Garden Essentials',
                'legal_business_name' => 'Home & Garden Essentials Co',
                'email' => 'info@homegarden.com',
                'phone' => '+1234567892',
                'contact_person' => 'Mike Home',
                'business_type' => 'Home & Garden',
                'tax_id' => 'TAX123456791',
                'business_registration_number' => 'BRN987654323',
                'year_established' => 2018,
                'description' => 'Everything you need for your home and garden.',
                'address' => '789 Garden Road',
                'zip_code' => '10003',
                'website' => 'https://homegarden.com',
                'facebook' => 'homegarden',
                'instagram' => 'homegarden',
                'twitter' => 'homegarden',
            ],
            [
                'name' => 'Sports Equipment Plus',
                'legal_business_name' => 'Sports Equipment Plus Ltd',
                'email' => 'sales@sportsequipment.com',
                'phone' => '+1234567893',
                'contact_person' => 'David Sports',
                'business_type' => 'Sports',
                'tax_id' => 'TAX123456792',
                'business_registration_number' => 'BRN987654324',
                'year_established' => 2021,
                'description' => 'Premium sports equipment and athletic gear.',
                'address' => '321 Sports Lane',
                'zip_code' => '10004',
                'website' => 'https://sportsequipment.com',
                'facebook' => 'sportsequipment',
                'instagram' => 'sportsequipment',
                'twitter' => 'sportsequipment',
            ],
            [
                'name' => 'Beauty & Wellness',
                'legal_business_name' => 'Beauty & Wellness Spa',
                'email' => 'hello@beautywellness.com',
                'phone' => '+1234567894',
                'contact_person' => 'Emily Beauty',
                'business_type' => 'Beauty',
                'tax_id' => 'TAX123456793',
                'business_registration_number' => 'BRN987654325',
                'year_established' => 2017,
                'description' => 'Premium beauty and wellness products for your self-care routine.',
                'address' => '654 Beauty Boulevard',
                'zip_code' => '10005',
                'website' => 'https://beautywellness.com',
                'facebook' => 'beautywellness',
                'instagram' => 'beautywellness',
                'twitter' => 'beautywellness',
            ],
            [
                'name' => 'Books & More',
                'legal_business_name' => 'Books & More Bookstore',
                'email' => 'info@booksandmore.com',
                'phone' => '+1234567895',
                'contact_person' => 'Lisa Reader',
                'business_type' => 'Books',
                'tax_id' => 'TAX123456794',
                'business_registration_number' => 'BRN987654326',
                'year_established' => 2016,
                'description' => 'Your one-stop shop for books, stationery, and educational materials.',
                'address' => '987 Book Street',
                'zip_code' => '10006',
                'website' => 'https://booksandmore.com',
                'facebook' => 'booksandmore',
                'instagram' => 'booksandmore',
                'twitter' => 'booksandmore',
            ],
            [
                'name' => 'Auto Parts Express',
                'legal_business_name' => 'Auto Parts Express Inc',
                'email' => 'sales@autopartsexpress.com',
                'phone' => '+1234567896',
                'contact_person' => 'Robert Mechanic',
                'business_type' => 'Automotive',
                'tax_id' => 'TAX123456795',
                'business_registration_number' => 'BRN987654327',
                'year_established' => 2015,
                'description' => 'Quality auto parts and accessories for all vehicle types.',
                'address' => '147 Auto Drive',
                'zip_code' => '10007',
                'website' => 'https://autopartsexpress.com',
                'facebook' => 'autopartsexpress',
                'instagram' => 'autopartsexpress',
                'twitter' => 'autopartsexpress',
            ],
            [
                'name' => 'Pet Supplies Plus',
                'legal_business_name' => 'Pet Supplies Plus Co',
                'email' => 'hello@petsupplies.com',
                'phone' => '+1234567897',
                'contact_person' => 'Jennifer Pet',
                'business_type' => 'Pet Supplies',
                'tax_id' => 'TAX123456796',
                'business_registration_number' => 'BRN987654328',
                'year_established' => 2022,
                'description' => 'Everything your pets need for a happy and healthy life.',
                'address' => '258 Pet Lane',
                'zip_code' => '10008',
                'website' => 'https://petsupplies.com',
                'facebook' => 'petsupplies',
                'instagram' => 'petsupplies',
                'twitter' => 'petsupplies',
            ],
            [
                'name' => 'Kitchen & Dining',
                'legal_business_name' => 'Kitchen & Dining Essentials',
                'email' => 'info@kitchendining.com',
                'phone' => '+1234567898',
                'contact_person' => 'Michael Chef',
                'business_type' => 'Kitchen',
                'tax_id' => 'TAX123456797',
                'business_registration_number' => 'BRN987654329',
                'year_established' => 2019,
                'description' => 'Premium kitchen and dining equipment for culinary enthusiasts.',
                'address' => '369 Kitchen Road',
                'zip_code' => '10009',
                'website' => 'https://kitchendining.com',
                'facebook' => 'kitchendining',
                'instagram' => 'kitchendining',
                'twitter' => 'kitchendining',
            ],
            [
                'name' => 'Outdoor Adventures',
                'legal_business_name' => 'Outdoor Adventures Gear',
                'email' => 'sales@outdooradventures.com',
                'phone' => '+1234567899',
                'contact_person' => 'David Explorer',
                'business_type' => 'Outdoor',
                'tax_id' => 'TAX123456798',
                'business_registration_number' => 'BRN987654330',
                'year_established' => 2020,
                'description' => 'Adventure gear and outdoor equipment for nature enthusiasts.',
                'address' => '741 Adventure Trail',
                'zip_code' => '10010',
                'website' => 'https://outdooradventures.com',
                'facebook' => 'outdooradventures',
                'instagram' => 'outdooradventures',
                'twitter' => 'outdooradventures',
            ],
        ];

        foreach ($stores as $index => $storeData) {
            $user = $users[$index % $users->count()];
            
            // Get or create state and city for the country
            $state = State::where('country_id', $country->id)->get()->random();
            
            $city = City::where('state_id', $state->id)->get()->random();

            Store::create([
                'user_id' => $user->id,
                'slug' => Str::slug($storeData['name']),
                'name' => $storeData['name'],
                'legal_business_name' => $storeData['legal_business_name'],
                'email' => $storeData['email'],
                'phone' => $storeData['phone'],
                'contact_person' => $storeData['contact_person'],
                'business_type' => $storeData['business_type'],
                'tax_id' => $storeData['tax_id'],
                'business_registration_number' => $storeData['business_registration_number'],
                'year_established' => $storeData['year_established'],
                'description' => $storeData['description'],
                'address' => $storeData['address'],
                'country_id' => $country->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
                'zip_code' => $storeData['zip_code'],
                'website' => $storeData['website'],
                'facebook' => $storeData['facebook'],
                'instagram' => $storeData['instagram'],
                'twitter' => $storeData['twitter'],
                'published' => true,
                'approved_at' => now(),
            ]);
        }

        // Create additional random stores
        // $businessTypes = ['Electronics', 'Fashion', 'Home & Garden', 'Sports', 'Beauty', 'Books', 'Automotive', 'Pet Supplies', 'Kitchen', 'Outdoor'];
        
        // for ($i = 0; $i < 15; $i++) {
        //     $user = $users->random();
        //     $country = $countries->random();
        //     $state = State::where('country_id', $country->id)->first();
        //     $city = City::where('state_id', $state->id)->first();
            
        //     if (!$state) {
        //         $state = State::create([
        //             'name' => 'Default State',
        //             'country_id' => $country->id,
        //             'status' => true
        //         ]);
        //     }
            
        //     if (!$city) {
        //         $city = City::create([
        //             'name' => 'Default City',
        //             'state_id' => $state->id,
        //             'status' => true
        //         ]);
        //     }

        //     $storeName = fake()->company() . ' ' . fake()->randomElement(['Store', 'Shop', 'Outlet', 'Market', 'Center']);
            
        //     Store::create([
        //         'user_id' => $user->id,
        //         'slug' => Str::slug($storeName),
        //         'name' => $storeName,
        //         'legal_business_name' => $storeName . ' LLC',
        //         'email' => fake()->unique()->companyEmail(),
        //         'phone' => fake()->phoneNumber(),
        //         'contact_person' => fake()->name(),
        //         'business_type' => fake()->randomElement($businessTypes),
        //         'tax_id' => 'TAX' . fake()->numerify('##########'),
        //         'business_registration_number' => 'BRN' . fake()->numerify('##########'),
        //         'year_established' => fake()->numberBetween(2010, 2023),
        //         'description' => fake()->paragraph(),
        //         'address' => fake()->streetAddress(),
        //         'country_id' => $country->id,
        //         'state_id' => $state->id,
        //         'city_id' => $city->id,
        //         'zip_code' => fake()->postcode(),
        //         'website' => 'https://' . fake()->domainName(),
        //         'facebook' => fake()->userName(),
        //         'instagram' => fake()->userName(),
        //         'twitter' => fake()->userName(),
        //         'published' => true,
        //         'approved_at' => now(),
        //     ]);
        // }
    }
} 