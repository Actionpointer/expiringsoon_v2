<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

class VerificationProvidersTableSeeder
{
    public static function getVerificationProviders()
    {
        return [
            [
                'name' => 'manual',
                'slug' => 'manual',
                'display_name' => 'Manual Verification',
                'supported_documents' => null,
                'capabilities' => null,
                'regions' => null,
                'description' => 'Manual Verification',
                'website' => null,
                'status' => true
            ],
            [
                'name' => 'veriff',
                'slug' => 'veriff',
                'display_name' => 'Veriff',
                'supported_documents' => json_encode([
                    'passport',
                    'drivers_license',
                    'national_id',
                    'residence_permit',
                    'voter_id'
                ]),
                'capabilities' => json_encode([
                    'face_match' => true,
                    'liveness_check' => true,
                    'document_authenticity' => true,
                    'proof_of_address' => true,
                    'watchlist_screening' => true
                ]),
                'regions' => json_encode([
                    'europe' => [
                        'coverage' => 'full',
                        'countries' => ['EU', 'UK', 'Switzerland', 'Norway'],
                        'special_capabilities' => ['eu_identity_verification']
                    ],
                    'north_america' => [
                        'coverage' => 'full',
                        'countries' => ['US', 'Canada']
                    ],
                    'asia_pacific' => [
                        'coverage' => 'partial',
                        'countries' => ['Australia', 'Singapore', 'Japan']
                    ]
                ]),
                'description' => 'Global identity verification platform with strong presence in Europe',
                'website' => 'https://www.veriff.com',
                'status' => true
            ],
            [
                'name' => 'onfido',
                'slug' => 'onfido',
                'display_name' => 'Onfido',
                'supported_documents' => json_encode([
                    'passport',
                    'drivers_license',
                    'national_id',
                    'residence_permit',
                    'work_permit',
                    'tax_id'
                ]),
                'capabilities' => json_encode([
                    'face_match' => true,
                    'liveness_check' => true,
                    'document_authenticity' => true,
                    'proof_of_address' => true,
                    'watchlist_screening' => true,
                    'ongoing_monitoring' => true
                ]),
                'regions' => json_encode([
                    'europe' => [
                        'coverage' => 'full',
                        'countries' => ['EU', 'UK', 'Switzerland'],
                        'special_capabilities' => ['uk_right_to_work']
                    ],
                    'north_america' => [
                        'coverage' => 'full',
                        'countries' => ['US', 'Canada'],
                        'special_capabilities' => ['us_ssn_verification']
                    ],
                    'asia_pacific' => [
                        'coverage' => 'full',
                        'countries' => ['Australia', 'Singapore', 'Hong Kong', 'Japan']
                    ],
                    'middle_east' => [
                        'coverage' => 'partial',
                        'countries' => ['UAE', 'Saudi Arabia']
                    ]
                ]),
                'description' => 'AI-powered identity verification platform with global coverage',
                'website' => 'https://onfido.com',
                'status' => true
            ],
            [
                'name' => 'sumsub',
                'slug' => 'sumsub',
                'display_name' => 'Sumsub',
                'supported_documents' => json_encode([
                    'passport',
                    'drivers_license',
                    'national_id',
                    'residence_permit',
                    'utility_bill',
                    'bank_statement',
                    'company_registration'
                ]),
                'capabilities' => json_encode([
                    'face_match' => true,
                    'liveness_check' => true,
                    'document_authenticity' => true,
                    'proof_of_address' => true,
                    'business_verification' => true,
                    'aml_screening' => true,
                    'shareholder_verification' => true
                ]),
                'regions' => json_encode([
                    'europe' => [
                        'coverage' => 'full',
                        'countries' => ['EU', 'UK', 'Switzerland'],
                        'special_capabilities' => ['crypto_compliance']
                    ],
                    'north_america' => [
                        'coverage' => 'full',
                        'countries' => ['US', 'Canada']
                    ],
                    'asia_pacific' => [
                        'coverage' => 'full',
                        'countries' => ['Singapore', 'Hong Kong', 'South Korea', 'Japan']
                    ],
                    'latin_america' => [
                        'coverage' => 'partial',
                        'countries' => ['Brazil', 'Mexico', 'Argentina']
                    ]
                ]),
                'description' => 'Complete verification platform with strong focus on crypto and financial services',
                'website' => 'https://sumsub.com',
                'status' => true
            ],
            [
                'name' => 'jumio',
                'slug' => 'jumio',
                'display_name' => 'Jumio',
                'supported_documents' => json_encode([
                    'passport',
                    'drivers_license',
                    'national_id',
                    'visa',
                    'residence_permit',
                    'credit_card'
                ]),
                'capabilities' => json_encode([
                    'face_match' => true,
                    'liveness_check' => true,
                    'document_authenticity' => true,
                    'proof_of_address' => true,
                    'watchlist_screening' => true,
                    'transaction_monitoring' => true,
                    'credit_card_verification' => true
                ]),
                'regions' => json_encode([
                    'north_america' => [
                        'coverage' => 'full',
                        'countries' => ['US', 'Canada'],
                        'special_capabilities' => ['us_compliance_suite']
                    ],
                    'europe' => [
                        'coverage' => 'full',
                        'countries' => ['EU', 'UK', 'Switzerland']
                    ],
                    'asia_pacific' => [
                        'coverage' => 'full',
                        'countries' => ['Australia', 'Singapore', 'Japan', 'South Korea']
                    ],
                    'latin_america' => [
                        'coverage' => 'partial',
                        'countries' => ['Brazil', 'Mexico']
                    ],
                    'middle_east' => [
                        'coverage' => 'partial',
                        'countries' => ['UAE', 'Saudi Arabia', 'Israel']
                    ]
                ]),
                'description' => 'Enterprise-grade KYC/AML compliance with focus on financial services',
                'website' => 'https://www.jumio.com',
                'status' => true
            ],
            [
                'name' => 'shufti_pro',
                'slug' => 'shufti_pro',
                'display_name' => 'Shufti Pro',
                'supported_documents' => json_encode([
                    'passport',
                    'drivers_license',
                    'national_id',
                    'utility_bill',
                    'bank_statement',
                    'tax_return'
                ]),
                'capabilities' => json_encode([
                    'face_match' => true,
                    'liveness_check' => true,
                    'document_authenticity' => true,
                    'proof_of_address' => true,
                    'business_verification' => true,
                    'age_verification' => true
                ]), 
                'regions' => json_encode([
                    'asia_pacific' => [
                        'coverage' => 'full',
                        'countries' => ['India', 'Pakistan', 'Bangladesh', 'Indonesia', 'Malaysia']
                    ],
                    'middle_east' => [
                        'coverage' => 'full',
                        'countries' => ['UAE', 'Saudi Arabia', 'Kuwait', 'Bahrain', 'Oman']
                    ],
                    'africa' => [
                        'coverage' => 'partial',
                        'countries' => ['Nigeria', 'Kenya', 'South Africa', 'Egypt']
                    ],
                    'europe' => [
                        'coverage' => 'partial',
                        'countries' => ['EU', 'UK']
                    ]
                ]),
                'description' => 'Global KYC/AML service with competitive pricing for emerging markets',
                'website' => 'https://shuftipro.com',
                'status' => true
            ]
        ];
    }
}
