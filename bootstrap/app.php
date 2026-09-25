<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Build the Application instance
|--------------------------------------------------------------------------
|
| Required by both public/index.php (HTTP) and forge (console) so the app
| is constructed in exactly one place. Application::boot() itself stays
| private and fixed (it always registers config/modules.php's modules) —
| this file only exists to avoid duplicating the constructor call, not to
| expose a customization hook the framework doesn't have.
|
| Callers must require vendor/autoload.php before this file.
*/

use Ironflow\Application;

return new Application(dirname(__DIR__));
