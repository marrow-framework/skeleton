<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Outbound HTTP client defaults
    |--------------------------------------------------------------------------
    | Passed straight to Symfony\Component\HttpClient\HttpClient::create()
    | when the framework builds the shared Marrow\Http\HttpClient service.
    | Per-call overrides (timeout, headers, retries, ...) are still available
    | fluently — see docs/http-client.md.
    */
    'http' => [
        // 'timeout' => 10,
        // 'headers' => ['User-Agent' => 'Marrow-App/1.0'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Third-party service credentials
    |--------------------------------------------------------------------------
    | Conventional home for API keys/secrets used by your own integrations —
    | nothing in the framework core reads this array besides 'http' above.
    |
    | 'stripe' => [
    |     'key'    => env('STRIPE_KEY'),
    |     'secret' => env('STRIPE_SECRET'),
    | ],
    */

];
