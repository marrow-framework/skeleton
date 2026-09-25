<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Front controller
|--------------------------------------------------------------------------
|
| Every HTTP request is funneled through this single file. It boots the
| Application in HTTP mode (loads config, registers the enabled modules,
| runs the middleware pipeline, dispatches to a route) and sends the
| resulting Response back to the browser.
|
| The document root for the web server (Nginx/Apache/`php forge serve`)
| must point at this `public/` directory, never at the project root.
|
*/

require __DIR__ . '/../vendor/autoload.php';

(require __DIR__ . '/../bootstrap/app.php')->handleRequest();
