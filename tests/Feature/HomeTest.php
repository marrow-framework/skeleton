<?php

declare(strict_types=1);

test('the homepage renders', function () {
    $response = $this->get('/');

    $this->assertOk($response);
    expect($response->getContent())
        ->toContain('is running.')
        ->toContain('Server ready');
});

test('the health endpoint reports a consistent status', function () {
    $response = $this->get('/health');
    $body = json_decode((string) $response->getContent(), true);

    // The HTTP status must match what the report itself says — 200 when
    // healthy, 503 otherwise (see HomeController::health()). Not asserting
    // "ok" outright: a real disk-space check can legitimately fail on a
    // near-full CI runner without that being an application bug.
    $expectedStatus = $body['status'] === 'ok' ? 200 : 503;
    $this->assertStatus($response, $expectedStatus);

    expect($body)->toHaveKeys(['status', 'checks', 'duration_ms']);
    expect($body['checks'])->toHaveKeys(['database', 'cache', 'disk', 'queue']);
    expect($body['checks']['database']['status'])->toBe('ok');
    expect($body['checks']['cache']['status'])->toBe('ok');
    expect($body['checks']['queue']['status'])->toBe('ok');
});
