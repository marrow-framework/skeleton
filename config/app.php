<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Application name
    |--------------------------------------------------------------------------
    */
    'name' => env('APP_NAME', 'Marrow'),

    /*
    |--------------------------------------------------------------------------
    | Application version
    |--------------------------------------------------------------------------
    | Your own app's version, shown by `php forge about` (next to the
    | installed marrow/framework version, shown separately there and in the
    | `php forge` CLI banner — that one is resolved from Composer, not here).
    */
    'version' => '0.1.0',

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    | 'local' enables the dev hot-reload middleware and relaxes the session
    | cookie's Secure flag. Use 'production' (or anything else) everywhere
    | that isn't your own machine.
    */
    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Debug mode
    |--------------------------------------------------------------------------
    | When true: Twig uses strict_variables, the interactive debug page is
    | rendered on uncaught exceptions instead of a styled error page, and
    | JSON error responses include a stack trace. Never enable in production.
    */
    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    | Used as the JWT "iss" claim and anywhere the app needs to generate a
    | fully-qualified URL outside of an HTTP request context.
    */
    'url' => env('APP_URL', 'http://localhost:8000'),

];
