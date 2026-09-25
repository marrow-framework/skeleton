<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Allowed origins
    |--------------------------------------------------------------------------
    | '*' allows any origin. Otherwise an exact origin ("https://app.example.com")
    | or an fnmatch wildcard pattern ("https://*.example.com").
    */
    'allowed_origins' => array_map('trim', explode(',', (string) env('CORS_ORIGINS', '*'))),

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With', 'Accept', 'X-CSRF-TOKEN'],

    'exposed_headers' => ['X-RateLimit-Limit', 'X-RateLimit-Remaining', 'X-Total-Count'],

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    | Set true to send Access-Control-Allow-Credentials: true — required for
    | cookie-based auth across origins. 'allowed_origins' must then list exact
    | origins ('*' is invalid alongside credentialed requests per the CORS spec).
    */
    'supports_credentials' => false,

    /*
    |--------------------------------------------------------------------------
    | Preflight cache
    |--------------------------------------------------------------------------
    | Seconds the browser may cache an OPTIONS preflight response for.
    */
    'max_age' => 86400,

];
