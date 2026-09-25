<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default cache driver
    |--------------------------------------------------------------------------
    | Supported: "file" (storage/cache/app), "apcu", "redis", "array"
    | (in-memory, resets every request — handy in tests).
    */
    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Redis
    |--------------------------------------------------------------------------
    | Only read when 'default' (or an explicit CacheManager) uses the redis
    | driver.
    */
    'redis' => [
        'dsn' => env('REDIS_DSN', 'redis://127.0.0.1:6379'),
    ],

];
