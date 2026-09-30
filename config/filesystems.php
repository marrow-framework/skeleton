<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default disk
    |--------------------------------------------------------------------------
    */
    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Disks
    |--------------------------------------------------------------------------
    | Each disk is a league/flysystem adapter behind Marrow\Filesystem\Storage.
    | 'local'  — private files, not web-accessible directly.
    | 'public' — files served back out under APP_URL/storage/...
    | 's3'     — requires: composer require league/flysystem-aws-s3-v3
    */
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL', 'http://localhost:8000') . '/storage',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID', ''),
            'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'bucket' => env('AWS_BUCKET', ''),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style' => (bool) env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],
    ],

];
