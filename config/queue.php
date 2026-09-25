<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Queue tables
    |--------------------------------------------------------------------------
    | QueueManager is database-backed only. Both tables are created by the
    | queue migrations shipped in database/migrations/.
    */
    'table' => 'jobs',
    'failed_table' => 'failed_jobs',

];
