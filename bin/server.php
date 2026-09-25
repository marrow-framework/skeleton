<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| PHP built-in server router
|--------------------------------------------------------------------------
|
| Used only by `php forge serve` (and optionally `php -S host:port -t public
| bin/server.php` directly). The built-in web server otherwise has no
| rewrite rules, so a request for a real static file under public/ (an
| image, a compiled CSS/JS bundle, favicon.ico, ...) would 404 unless we
| let it through untouched here, and everything else is funneled to the
| front controller exactly like a production Nginx/Apache rewrite would.
|
*/

$publicPath = __DIR__ . '/../public';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');

// Serve the file as-is if it physically exists in public/ (assets, etc.)
if ($uri !== '/' && file_exists($publicPath . $uri) && !is_dir($publicPath . $uri)) {
    return false;
}

require $publicPath . '/index.php';
