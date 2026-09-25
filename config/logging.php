<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Log level
    |--------------------------------------------------------------------------
    | Any Monolog/PSR-3 level: debug, info, notice, warning, error, critical,
    | alert, emergency. Logs are written to storage/logs/{app.name}-Y-m-d.log.
    */
    'level' => env('LOG_LEVEL', 'debug'),

];
