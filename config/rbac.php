<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Super-admin role
    |--------------------------------------------------------------------------
    | Any authenticated user carrying this role slug bypasses every Gate
    | check (Gate::allows/authorize), via a `before` hook registered in
    | Application::bindCoreServices(). Set to null/false/'' to disable the
    | bypass entirely and require every ability to be explicitly granted.
    */
    'super_admin_role' => env('RBAC_SUPER_ADMIN_ROLE', 'admin'),

];
