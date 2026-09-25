<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default guard
    |--------------------------------------------------------------------------
    | Used whenever AuthManager::guard() is called without an explicit name
    | (auth()->check(), auth()->user(), the `auth` middleware with no
    | parameter, ...). Typically 'session' for a web app, 'jwt' for a
    | stateless API.
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'session'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards
    |--------------------------------------------------------------------------
    | 'table'    — the users table each guard authenticates against.
    | 'username' — the column checked against the login credential (session
    |              guard only; e.g. change to 'username' for a non-email login).
    */
    'guards' => [
        'session' => [
            'driver' => 'session',
            'table' => 'users',
            'username' => 'email',
        ],
        'jwt' => [
            'driver' => 'jwt',
            'table' => 'users',
            'secret' => env('JWT_SECRET', ''),
            'ttl' => (int) env('JWT_TTL', 3600),
        ],
    ],

];
