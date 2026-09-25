<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled checks
    |--------------------------------------------------------------------------
    | Remove one to stop it from running against /health (e.g. drop 'queue'
    | if the app never uses the queue).
    */
    'enabled' => ['database', 'cache', 'disk', 'queue'],

    /*
    |--------------------------------------------------------------------------
    | Disk space thresholds (percent used)
    |--------------------------------------------------------------------------
    */
    'disk' => [
        'warn_percent' => 85.0,
        'fail_percent' => 95.0,
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue thresholds
    |--------------------------------------------------------------------------
    | backlog_* — number of pending rows in the jobs table.
    | failed_*  — number of rows in failed_jobs.
    */
    'queue' => [
        'backlog_warn' => 100,
        'backlog_fail' => 1000,
        'failed_warn' => 1,
        'failed_fail' => 50,
    ],

];
