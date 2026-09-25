<?php

declare(strict_types=1);

namespace Modules\Home\Controllers;

use Ironflow\Health\HealthManager;
use Ironflow\Http\Controller;
use Ironflow\Http\JsonResponse;
use Ironflow\Http\Response;

class HomeController extends Controller
{
    /** GET / — a plain, minimal starter page: app name, version, links. */
    public function index(): Response
    {
        return $this->view('@home/index', [
            'appName' => config('app.name'),
            // Real host:port, not config('app.url') — its default (:8000)
            // doesn't match `php forge serve`'s own default (:8080).
            'host' => $this->request->getHttpHost(),
            'version' => app()->version(),
            'environment' => app()->environment(),
            'debug' => app()->isDebug(),
        ]);
    }

    /** GET /health — aggregated DB / cache / disk / queue status. */
    public function health(HealthManager $health): JsonResponse
    {
        $report = $health->report();
        return $this->json($report, $report['status'] === 'ok' ? 200 : 503);
    }
}
