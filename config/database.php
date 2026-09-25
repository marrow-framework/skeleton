<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default connection
    |--------------------------------------------------------------------------
    | Ironflow\Database\Connection wraps a single Doctrine DBAL connection —
    | there is no multi-connection manager, so this whole file *is* the
    | connection's parameters.
    |
    | Supported drivers: sqlite, mysql, pgsql
    */
    'driver' => env('DB_DRIVER', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | SQLite
    |--------------------------------------------------------------------------
    | Relative paths are resolved against the application base path.
    */
    'database' => env('DB_DATABASE', 'storage/database.sqlite'),

    /*
    |--------------------------------------------------------------------------
    | MySQL / PostgreSQL
    |--------------------------------------------------------------------------
    | Ignored when 'driver' is sqlite.
    */
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => (int) env('DB_PORT', 3306),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => env('DB_CHARSET', 'utf8mb4'),

];
