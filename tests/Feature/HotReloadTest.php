<?php

declare(strict_types=1);

// HotReloadMiddleware must step fully aside once Vite's dev server is
// running — otherwise its 800ms poll races Vite's own WebSocket-pushed
// refresh/HMR and can force a stale reload on top of it.

beforeEach(function () {
    $this->hotFile = app()->path('public', 'hot');
    $this->cssFile = base_path('resources/css/app.css');
    if (is_file($this->hotFile)) {
        unlink($this->hotFile);
    }
});

afterEach(function () {
    if (is_file($this->hotFile)) {
        unlink($this->hotFile);
    }
});

test('without a running Vite dev server, the poll script is injected and reacts to file changes', function () {
    $body = (string) $this->get('/')->getContent();
    expect($body)->toContain('/__ironflow/ping');

    $hashBefore = json_decode((string) $this->get('/__ironflow/ping')->getContent(), true)['hash'];
    touch($this->cssFile, time() + 1);
    $hashAfter = json_decode((string) $this->get('/__ironflow/ping')->getContent(), true)['hash'];

    expect($hashAfter)->not->toBe($hashBefore);
});

test('while Vite is running, HotReloadMiddleware steps aside entirely', function () {
    file_put_contents($this->hotFile, 'http://localhost:5173');

    $body = (string) $this->get('/')->getContent();
    expect($body)->not->toContain('/__ironflow/ping');

    // The path is no longer intercepted by the middleware, so it falls
    // through to routing — which has no such route registered.
    $response = $this->get('/__ironflow/ping');
    expect($response->getStatusCode())->toBe(404);
});
