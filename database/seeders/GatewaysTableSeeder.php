<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

class GatewaysTableSeeder
{
    public static function getGateways()
    {
        return [
            // Global Payment Gateways
            [
                'name' => 'stripe',
                'slug' => 'stripe',
                'display_name' => 'Stripe',
                'regions' => json_encode(['north_america', 'europe', 'asia', 'oceania']),
                'description' => 'Global payment processor supporting cards and local payment methods',
                'website' => 'https://stripe.com',
                'status' => true
            ],
            [
                'name' => 'paypal',
                'slug' => 'paypal',
                'display_name' => 'PayPal',
                'regions' => json_encode(['global']),
                'description' => 'Global digital payment platform',
                'website' => 'https://paypal.com',
                'status' => true
            ],
            [
                'name' => 'adyen',
                'slug' => 'adyen',
                'display_name' => 'Adyen',
                'regions' => json_encode(['europe', 'north_america', 'asia', 'south_america']),
                'description' => 'Enterprise payment platform supporting global payment methods',
                'website' => 'https://adyen.com',
                'status' => true
            ],
            [
                'name' => 'square',
                'slug' => 'square',
                'display_name' => 'Square',
                'regions' => json_encode(['north_america', 'europe', 'australia', 'japan']),
                'description' => 'Payment processor with focus on small businesses',
                'website' => 'https://squareup.com',
                'status' => true
            ],
            [
                'name' => 'checkout',
                'slug' => 'checkout',
                'display_name' => 'Checkout.com',
                'regions' => json_encode(['europe', 'middle_east', 'asia']),
                'description' => 'Global payment solution with strong presence in Europe and Middle East',
                'website' => 'https://checkout.com',
                'status' => true
            ],
            [
                'name' => 'mollie',
                'slug' => 'mollie',
                'display_name' => 'Mollie',
                'regions' => json_encode(['europe']),
                'description' => 'European payment processor with focus on local payment methods',
                'website' => 'https://mollie.com',
                'status' => true
            ],
            [
                'name' => 'wise',
                'slug' => 'wise',
                'display_name' => 'Wise',
                'regions' => json_encode(['global']),
                'description' => 'International money transfer and multi-currency accounts',
                'website' => 'https://wise.com',
                'status' => true
            ],
            [
                'name' => 'gocardless',
                'slug' => 'gocardless',
                'display_name' => 'GoCardless',
                'regions' => json_encode(['europe', 'north_america', 'australia']),
                'description' => 'Global bank debit network',
                'website' => 'https://gocardless.com',
                'status' => true
            ],

            // African Payment Gateways
            [
                'name' => 'paystack',
                'slug' => 'paystack',
                'display_name' => 'Paystack',
                'regions' => json_encode(['NG', 'GH', 'ZA', 'KE','EG','RW','CG','CD','CI','SN','CM','MA','TN']),
                'description' => 'Leading payment gateway in Africa, supporting multiple payment methods and currencies.',
                'website' => 'https://paystack.com',
                'status' => true
            ],
            [
                'name' => 'flutterwave',
                'slug' => 'flutterwave',
                'display_name' => 'Flutterwave',
                'regions' => json_encode(['NG', 'GH', 'KE', 'ZA', 'EG', 'MA', 'TN', 'CI', 'SN', 'CM']),
                'description' => 'Pan-African payment gateway supporting multiple currencies and payment methods.',
                'website' => 'https://flutterwave.com',
                'status' => true
            ],
            
            [
                'name' => 'interswitch',
                'slug' => 'interswitch',
                'display_name' => 'Interswitch',
                'regions' => json_encode(['NG', 'GH', 'KE', 'UG', 'ZM']),
                'description' => 'Leading digital payment and commerce company in Africa.',
                'website' => 'https://interswitchgroup.com',
                'status' => true
            ],
            [
                'name' => 'okra',
                'slug' => 'okra',
                'display_name' => 'Okra',
                'regions' => json_encode(['NG', 'GH', 'KE', 'ZA']),
                'description' => 'Open finance infrastructure for Africa, enabling secure access to financial data.',
                'website' => 'https://okra.ng',
                'status' => true
            ],
            [
                'name' => 'paga',
                'slug' => 'paga',
                'display_name' => 'Paga',
                'regions' => json_encode(['NG', 'ET', 'MX']),
                'description' => 'Leading mobile payment company in Nigeria, expanding to other markets.',
                'website' => 'https://mypaga.com',
                'status' => true
            ],
            [
                'name' => 'cellulant',
                'slug' => 'cellulant',
                'display_name' => 'Cellulant',
                'regions' => json_encode(['NG', 'KE', 'GH', 'UG', 'ZM', 'TZ', 'RW']),
                'description' => 'Pan-African payment technology company offering multiple payment solutions.',
                'website' => 'https://cellulant.io',
                'status' => true
            ],
            [
                'name' => 'dpo',
                'slug' => 'dpo',
                'display_name' => 'DPO Group',
                'regions' => json_encode(['ZA', 'KE', 'NG', 'GH', 'MA', 'TN']),
                'description' => 'Leading African payment service provider supporting multiple payment methods.',
                'website' => 'https://dpogroup.com',
                'status' => true
            ],
            
            [
                'name' => 'kuda',
                'slug' => 'kuda',
                'display_name' => 'Kuda',
                'regions' => json_encode(['NG', 'GB']),
                'description' => 'Digital-only bank with payment gateway services in Nigeria.',
                'website' => 'https://kuda.com',
                'status' => true
            ],
            
            [
                'name' => 'chipper',
                'slug' => 'chipper',
                'display_name' => 'Chipper Cash',
                'regions' => json_encode(['NG', 'GH', 'KE', 'ZA', 'UG', 'RW', 'TZ']),
                'description' => 'Cross-border payment platform popular in Africa.',
                'website' => 'https://chippercash.com',
                'status' => true
            ],
            [
                'name' => 'opay',
                'slug' => 'opay',
                'display_name' => 'OPay',
                'regions' => json_encode(['NG', 'EG', 'KE', 'ZA']),
                'description' => 'Digital payment platform offering various financial services.',
                'website' => 'https://opay.ng',
                'status' => true
            ],
            [
                'name' => 'palmpay',
                'slug' => 'palmpay',
                'display_name' => 'PalmPay',
                'regions' => json_encode(['NG', 'GH']),
                'description' => 'Digital payment platform offering mobile money and payment services.',
                'website' => 'https://palmpay.com',
                'status' => true
            ],
            [
                'name' => 'mfs',
                'slug' => 'mfs',
                'display_name' => 'MFS Africa',
                'regions' => json_encode(['NG', 'GH', 'KE', 'ZA', 'UG', 'RW', 'TZ', 'BF', 'ML', 'SN']),
                'description' => 'Leading digital payments hub in Africa, connecting mobile money networks.',
                'website' => 'https://mfsafrica.com',
                'status' => true
            ],
            [
                'name' => 'plaid',
                'slug' => 'plaid',
                'display_name' => 'Plaid',
                'regions' => json_encode(['north_america', 'europe']),
                'description' => 'Leading financial data aggregator in the US market',
                'website' => 'https://plaid.com',
                'status' => true
            ],
            [
                'name' => 'truelayer',
                'slug' => 'truelayer',
                'display_name' => 'TrueLayer',
                'regions' => json_encode(['europe', 'australia']),
                'description' => 'Open banking platform for European and Australian markets',
                'website' => 'https://truelayer.com',
                'status' => true
            ],
            [
                'name' => 'tink',
                'slug' => 'tink',
                'display_name' => 'Tink',
                'regions' => json_encode(['europe']),
                'description' => 'European open banking platform, owned by Visa',
                'website' => 'https://tink.com',
                'status' => true
            ],
            [
                'name' => 'nordigen',
                'slug' => 'nordigen',
                'display_name' => 'Nordigen',
                'regions' => json_encode(['europe']),
                'description' => 'European focused open banking platform, part of GoCardless',
                'website' => 'https://nordigen.com',
                'status' => true
            ],
            [
                'name' => 'belvo',
                'slug' => 'belvo',
                'display_name' => 'Belvo',
                'regions' => json_encode(['south_america']),
                'description' => 'Leading financial data API for Latin America',
                'website' => 'https://belvo.com',
                'status' => true
            ],
            [
                'name' => 'akoya',
                'slug' => 'akoya',
                'display_name' => 'Akoya',
                'regions' => json_encode(['north_america']),
                'description' => 'US-focused data access network',
                'website' => 'https://akoya.com',
                'status' => true
            ],
            [
                'name' => 'mono',
                'slug' => 'mono',
                'display_name' => 'Mono',
                'regions' => json_encode(['NG', 'GH', 'KE']),
                'description' => 'Open banking infrastructure for Africa, enabling secure access to financial data.',
                'website' => 'https://mono.co',
                'status' => true
            ],
            
            [
                'name' => 'mpesa',
                'slug' => 'mpesa',
                'display_name' => 'M-Pesa',
                'regions' => json_encode(['KE', 'TZ', 'UG', 'ZA', 'GH', 'ET']),
                'description' => 'Mobile money transfer service, widely used in East Africa.',
                'website' => 'https://www.mpesa.com',
                'status' => true
            ],
            [
                'name' => 'mtn_mobile_money',
                'slug' => 'mtn',
                'display_name' => 'MTN Mobile Money',
                
                'regions' => json_encode(['ghana', 'uganda', 'cameroon', 'ivory_coast', 'rwanda']),
                'description' => 'MTN Group\'s mobile money service across Africa',
                'website' => 'https://www.mtn.com/what-we-do/mobile-financial-services/',
                'status' => true
            ],
            [
                'name' => 'airtel_money',
                'slug' => 'airtel',
                'display_name' => 'Airtel Money',
                
                'regions' => json_encode(['kenya', 'uganda', 'tanzania', 'rwanda', 'nigeria']),
                'description' => 'Airtel Africa\'s mobile money service',
                'website' => 'https://airtel.africa/money',
                'status' => true
            ],
            [
                'name' => 'orange_money',
                'slug' => 'orange',
                'display_name' => 'Orange Money',
                
                'regions' => json_encode(['senegal', 'mali', 'burkina_faso', 'ivory_coast']),
                'description' => 'Orange\'s mobile money service in West Africa',
                'website' => 'https://orangemoney.com',
                'status' => true
            ],
            [
                'name' => 'gcash',
                'slug' => 'gcash',
                'display_name' => 'GCash',
                
                'regions' => json_encode(['philippines']),
                'description' => 'Leading mobile wallet in the Philippines',
                'website' => 'https://www.gcash.com',
                'status' => true
            ],
            [
                'name' => 'paytm',
                'slug' => 'paytm',
                'display_name' => 'Paytm',
                'regions' => json_encode(['india']),
                'description' => 'India\'s leading digital payments and financial services platform',
                'website' => 'https://paytm.com',
                'status' => true
            ],
            [
                'name' => 'wave',
                'slug' => 'wave',
                'display_name' => 'Wave',
                'regions' => json_encode(['SN', 'CI', 'BF', 'ML', 'UG']),
                'description' => 'Mobile money provider offering instant, free transfers in West Africa.',
                'website' => 'https://wave.com',
                'status' => true
            ],
            
        ];
    }
}
