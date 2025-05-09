<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'flutter'=>[
        'secret'=> env('FLUTTER_SECRET'),
        'public'=> env('FLUTTER_PUBLIC'),
    ],
    'paystack'=>[
        'secret'=> env('PAYSTACK_SECRET'),
        'public'=> env('PAYSTACK_PUBLIC'),
    ],
    'paypal'=>[
        'secret'=> env('PAYPAL_SECRET'),
        'client'=> env('PAYPAL_CLIENT'),
        'account'=> env('PAYPAL_ACCOUNT'),
        'token'=> env('PAYPAL_ACCESS_TOKEN'),
        'url'=> env('PAYPAL_URL'),
    ],
    'countrystatecity' => env('COUNTRYSTATECITY'),
    'ipdata' => env('IPDATA_API_KEY')

];
