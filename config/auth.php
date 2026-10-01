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
    | 'throttle' — (session guard only) lockout after repeated failed
    |              attempts against the *same* login identifier, regardless
    |              of the attacker's IP — defends one account against
    |              credential stuffing distributed across many addresses,
    |              which an IP-keyed `throttle:` route middleware won't
    |              catch. Only failed attempts count; a correct password
    |              never gets throttled. Defaults to 5 attempts / 60s if
    |              omitted.
    */
    'guards' => [
        'session' => [
            'driver' => 'session',
            'table' => 'users',
            'username' => 'email',
            'throttle' => [
                'max_attempts' => (int) env('AUTH_THROTTLE_MAX_ATTEMPTS', 5),
                'decay_seconds' => (int) env('AUTH_THROTTLE_DECAY_SECONDS', 60),
            ],
        ],
        'jwt' => [
            'driver' => 'jwt',
            'table' => 'users',
            'secret' => env('JWT_SECRET', ''),
            'ttl' => (int) env('JWT_TTL', 3600),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirects
    |--------------------------------------------------------------------------
    | 'login' — where the `auth` middleware (Marrow\Middleware\Authenticate)
    |           sends an unauthenticated web request. Only consulted for
    |           non-JSON requests; a JSON/API request gets a 401 instead.
    */
    'redirects' => [
        'login' => '/login',
    ],

];
