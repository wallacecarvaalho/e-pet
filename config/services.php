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
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'google' => [
        'client_id' => '43340497482-i9oo1jg9jfr3fn9po20n0bg6j0cpqci8.apps.googleusercontent.com',
        'client_secret' => 'vUWCJHEKZPoBJVLKowDkcQX-',
        'redirect'=>'http://localhost:8000/login/callback'
    ],

    'facebook' => [
    'client_id' => '138131630157162',
    'client_secret' => '9d2a416746217e42033e9878ed16d7cc',
    'redirect'=>'http://localhost:8000/login/callback',
],

];
