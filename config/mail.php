<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer DSN
    |--------------------------------------------------------------------------
    | Passed straight to Symfony\Component\Mailer\Transport::fromDsn().
    | Examples:
    |   null://null                              — discard all mail (default, safe for local)
    |   smtp://user:pass@smtp.mailtrap.io:2525    — SMTP
    |   ses+api://KEY:SECRET@default?region=eu-west-1
    | See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
    */
    'dsn' => env('MAIL_DSN', 'null://null'),

    /*
    |--------------------------------------------------------------------------
    | Default sender
    |--------------------------------------------------------------------------
    | Applied by Mailer::send() to any message that doesn't set its own From.
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Marrow'),
    ],

];
