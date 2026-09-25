<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled modules
    |--------------------------------------------------------------------------
    | Every HMVC module the application boots, in any order — ModuleManager
    | topologically sorts them by their #[Module(imports: [...])] before
    | registering/booting, so declaration order here doesn't matter.
    |
    | Generate a new one with:
    |   php forge make:module Blog
    |
    | Then add its class here:
    |   \Modules\Blog\BlogModule::class,
    */
    'enabled' => [
        \Modules\Account\AccountModule::class,
        \Modules\Home\HomeModule::class,
    ],

];
