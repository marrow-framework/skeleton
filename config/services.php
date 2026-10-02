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
    | Conventional home for API keys/secrets used by your own integrations.
    | Two framework primitives read this block by convention (nothing reads
    | it automatically — you opt in per service):
    |
    |   - Marrow\Support\ServiceIntegration (a base class for wrapping a
    |     service as one container-bound class) reads 'base_uri' and
    |     'secret' (as a bearer token) via its http() helper.
    |   - The 'webhook' middleware alias (Marrow\Middleware\
    |     VerifyWebhookSignature, ->middleware('webhook:stripe')) reads
    |     'webhook_secret'/'webhook_header'/'webhook_timestamped'/
    |     'webhook_tolerance' to verify an inbound webhook's signature.
    |
    | See docs/integrations.md.
    |
    | 'stripe' => [
    |     'base_uri'       => 'https://api.stripe.com/v1/',
    |     'secret'         => env('STRIPE_SECRET'),
    |     'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    |     'webhook_header' => 'Stripe-Signature',
    |     'webhook_timestamped' => true,
    | ],
    */

];
