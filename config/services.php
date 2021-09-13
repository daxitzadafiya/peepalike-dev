<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

  'stripe' => [
        'model' => App\User::class,
        'key' => 'pk_test_kDAKKfqc7yUrjxvl9hS7Ycwn',
        'secret' => 'sk_test_iHhnHqjb3AQniGN1DzhhdSdl',
    ],

    'twilio' => [
        'auth_token'  => env('TWILIO_AUTH_TOKEN'),
        'account_sid' => env('TWILIO_ACCOUNT_SID'),
        'number'     => env('TWILIO_NUMBER')
    ],

    'pesapal' => [
        'consumer_key'      => env('PESAPAL_CONSUMER_KEY'),
        'consumer_secret'   => env('PESAPAL_CONSUMER_SECRET'),
        'callback_route'    => env('PESAPAL_CALLBACK_ROUTE'),
        'live'              => env('PESAPAL_LIVE'),
    ],
    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect'      => 'http://localhost/peepalike/public/login/facebook/callback',
    ],
    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => 'http://127.0.0.1:8000/login/google/callback',
    ]



];
