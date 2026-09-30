<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Extra / override security headers
    |--------------------------------------------------------------------------
    | Merged onto SecurityHeaders' own defaults. Set a value to false to
    | remove a header the middleware would otherwise send.
    |
    | 'headers' => ['X-Powered-By' => false],
    */
    'headers' => [],

    /*
    |--------------------------------------------------------------------------
    | HTTP Strict Transport Security
    |--------------------------------------------------------------------------
    | Set max_age to 0 to disable HSTS entirely (e.g. while developing over
    | plain HTTP).
    */
    'hsts' => [
        'max_age' => 31536000,
        'include_subdomains' => true,
        'preload' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy
    |--------------------------------------------------------------------------
    | 'preset' is 'strict' or 'relaxed'; anything else starts from an empty
    | base policy so only 'directives' below applies. Start with report_only
    | to see violations (via a report endpoint you configure) before enforcing.
    */
    'csp' => [
        'enabled' => false,
        'preset' => 'strict',
        'report_only' => false,
        'directives' => [
            // 'script-src' => ["'self'", 'https://cdn.example.com'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CSRF exemptions
    |--------------------------------------------------------------------------
    | fnmatch patterns (matched against the request path) exempt from
    | VerifyCsrfToken — typically webhook endpoints and stateless API routes
    | that authenticate with a bearer token instead of a session.
    |
    | 'csrf_except' => ['api/*', 'webhooks/*'],
    */
    'csrf_except' => [
        '__marrow/*',
    ],

];
