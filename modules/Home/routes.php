<?php

declare(strict_types=1);

/**
 * Loaded by BaseModule::loadRoutes() with $router already in scope
 * (see ModuleManager::bootModule()) — no `use` import needed for it.
 *
 * @var \Marrow\Routing\Router $router
 */

use Modules\Home\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index'])->name('home');

$router->get('/health', [HomeController::class, 'health'])->name('health');
