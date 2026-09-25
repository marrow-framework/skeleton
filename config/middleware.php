<?php

declare(strict_types=1);

use Ironflow\Middleware\Authenticate;
use Ironflow\Middleware\HandleCors;
use Ironflow\Middleware\MaintenanceMode;
use Ironflow\Middleware\RedirectIfAuthenticated;
use Ironflow\Middleware\RequestLogger;
use Ironflow\Middleware\SanitizeInput;
use Ironflow\Middleware\SecurityHeaders;
use Ironflow\Middleware\ShareErrorsFromSession;
use Ironflow\Middleware\StartSession;
use Ironflow\Middleware\ThrottleRequests;
use Ironflow\Middleware\TrimStrings;
use Ironflow\Middleware\VerifyCsrfToken;

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
    | Ironflow\Middleware\MiddlewareResolver, so aliases work identically in
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
