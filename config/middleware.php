<?php

declare(strict_types=1);

use Marrow\Middleware\Authenticate;
use Marrow\Middleware\HandleCors;
use Marrow\Middleware\MaintenanceMode;
use Marrow\Middleware\RedirectIfAuthenticated;
use Marrow\Middleware\RequestLogger;
use Marrow\Middleware\SanitizeInput;
use Marrow\Middleware\SecurityHeaders;
use Marrow\Middleware\ShareErrorsFromSession;
use Marrow\Middleware\StartSession;
use Marrow\Middleware\ThrottleRequests;
use Marrow\Middleware\TrimStrings;
use Marrow\Middleware\VerifyCsrfToken;

return [

    /*
    |--------------------------------------------------------------------------
    | Global middleware
    |--------------------------------------------------------------------------
    | Runs on every request, before routing. HotReloadMiddleware is prepended
    | automatically by Http\Kernel in local/debug mode — it doesn't need to
    | be listed here.
    */
    'global' => [
        MaintenanceMode::class,
        SecurityHeaders::class,
        RequestLogger::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Route middleware aliases
    |--------------------------------------------------------------------------
    | Short names usable in ->middleware('auth') or a group's 'middleware'
    | attribute. Both the Router and the Kernel resolve through the same
    | Marrow\Middleware\MiddlewareResolver, so aliases work identically in
    | 'global', a route group, or a single route.
    */
    'aliases' => [
        'auth' => Authenticate::class,
        'guest' => RedirectIfAuthenticated::class,
        'throttle' => ThrottleRequests::class,
        'csrf' => VerifyCsrfToken::class,
        'cors' => HandleCors::class,
        'sanitize' => SanitizeInput::class,
        'session' => StartSession::class,
        'trim' => TrimStrings::class,
        'flash-errors' => ShareErrorsFromSession::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware groups
    |--------------------------------------------------------------------------
    | Apply to a route group with ['middleware' => 'web'] (or 'api').
    | Members can be aliases, raw class names, or 'alias:params'.
    */
    'groups' => [
        'web' => [
            'session',
            'flash-errors',
            'trim',
            'sanitize',
            'csrf',
        ],
        'api' => [
            'sanitize',
            'cors',
            'throttle:60,1',
        ],
    ],

];
