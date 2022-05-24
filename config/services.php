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
    'facebook' => [
        'client_id'     => '6900931403314999',
        'client_secret' => '883845ac3ddb3582e348b9c6a189fe40',
        'redirect'      => env('APP_URL').'/login/facebook/callback',
    ], 'twitter' => [
        'client_id'     => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect'      => env('TWITTER_URL'),
    ], 'google' => [
        'client_id'     => '965470510276-uuaqssrfj98tevt0uskmmect33mlppru.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => env('APP_URL').'/login/google/callback',
    ],
        'paytm-wallet' => [
            'env' => 'production', // values : (local | production)
            'merchant_id' => env('PAYTM_MERCHANT_ID'),
            'merchant_key' => env('PAYTM_MERCHANT_KEY'),
            'merchant_website' => env('PAYTM_MERCHANT_WEBSITE'),
            'channel' => env('PAYTM_CHANNEL'),
            'industry_type' => env('PAYTM_INDUSTRY_TYPE'),
    ],
];
