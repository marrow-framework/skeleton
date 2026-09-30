<?php

declare(strict_types=1);

namespace Tests;

use Marrow\Application;
use Marrow\Config\Repository as ConfigRepository;
use Marrow\Database\Connection;
use Marrow\Database\Migrations\Migrator;
use Marrow\Http\Kernel as HttpKernel;
use Marrow\Http\Request;
use Marrow\Module\ModuleManager;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Boots the real Application (config, container, modules) once for the whole
 * test run, then dispatches requests straight through Http\Kernel — no
 * running web server needed.
 *
 * Application::boot() (which registers config/modules.php's modules and
 * calls ModuleManager::boot()) is private and only invoked internally by
 * handleRequest()/runConsole(), so it's replicated here explicitly instead
 * of going through handleRequest() (which would also echo the response body).
 *
 * phpunit.xml points DB_DATABASE at ":memory:" — a fresh, empty SQLite
 * database that only lives as long as this one Connection singleton, so
 * every migration is run against it once here. Without this, any test that
 * touches a real table (RBAC, the queue health check, ...) would either
 * fail outright or silently degrade, which defeats the point of testing
 * through the real Http\Kernel instead of mocking everything.
 */
abstract class TestCase extends BaseTestCase
{
    private static ?Application $app = null;

    protected function setUp(): void
    {
        parent::setUp();

        if (self::$app === null) {
            self::$app = new Application(dirname(__DIR__));

            $container = self::$app->getContainer();
            $config = $container->make(ConfigRepository::class);
            self::$app->configure('modules');

            $manager = $container->make(ModuleManager::class);
            foreach ($config->get('modules.enabled', []) as $moduleClass) {
                $manager->register($moduleClass);
            }
            $manager->boot();

            $migrator = new Migrator($container->make(Connection::class));
            foreach (Migrator::discoverPaths(dirname(__DIR__)) as $path) {
                $migrator->run($path);
            }
        }
    }

    protected function app(): Application
    {
        return self::$app;
    }

    // ── HTTP helpers ─────────────────────────────────────────────────

    protected function get(string $uri): Response
    {
        return $this->dispatch(Request::create($uri, 'GET'));
    }

    protected function post(string $uri, array $data = []): Response
    {
        return $this->dispatch(Request::create($uri, 'POST', $data));
    }

    protected function dispatch(Request $request): Response
    {
        $kernel = self::$app->getContainer()->make(HttpKernel::class);
        return $kernel->handle($request);
    }

    // ── Assertions ───────────────────────────────────────────────────

    protected function assertStatus(Response $response, int $code): void
    {
        $this->assertSame($code, $response->getStatusCode(), (string) $response->getContent());
    }

    protected function assertOk(Response $response): void
    {
        $this->assertStatus($response, 200);
    }
}
