<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Interactive post-create-project setup wizard
|--------------------------------------------------------------------------
|
| Run automatically by `composer create-project marrow/skeleton` (see
| composer.json -> post-create-project-cmd) right after .env is copied and
| APP_KEY is generated. Re-runnable any time with `composer run install`.
|
| Skips every question outright when STDIN isn't a real terminal (CI, a
| scripted `composer create-project --no-interaction`, or any other
| non-interactive invocation) — .env.example's own defaults already work
| fine unattended, so there's nothing to block on.
*/

$root = dirname(__DIR__);
$envPath = "{$root}/.env";

if (!stream_isatty(STDIN)) {
    exit(0);
}

function ask(string $question, string $default = ''): string
{
    $suffix = $default !== '' ? " [{$default}]" : '';
    fwrite(STDOUT, "  {$question}{$suffix}: ");
    $line = trim((string) fgets(STDIN));
    return $line === '' ? $default : $line;
}

function confirm(string $question, bool $default = true): bool
{
    $suffix = $default ? '[Y/n]' : '[y/N]';
    fwrite(STDOUT, "  {$question} {$suffix}: ");
    $line = strtolower(trim((string) fgets(STDIN)));
    if ($line === '') {
        return $default;
    }
    return in_array($line, ['y', 'yes'], true);
}

function setEnv(string $path, string $key, string $value): void
{
    $contents = (string) file_get_contents($path);
    $escaped = str_contains($value, ' ') ? '"' . str_replace('"', '\\"', $value) . '"' : $value;
    $pattern = '/^' . preg_quote($key, '/') . '=.*$/m';

    $contents = preg_match($pattern, $contents)
        ? (string) preg_replace($pattern, "{$key}={$escaped}", $contents, 1)
        : rtrim($contents) . "\n{$key}={$escaped}\n";

    file_put_contents($path, $contents);
}

function run(string $command): void
{
    fwrite(STDOUT, "\n");
    passthru($command);
}

if (!is_file($envPath)) {
    fwrite(STDERR, ".env not found — nothing to configure.\n");
    exit(0);
}

fwrite(STDOUT, "\n\033[1;32mLet's set up your app.\033[0m (press Enter to accept each default)\n\n");

$name = ask('App name', 'Marrow');
setEnv($envPath, 'APP_NAME', $name);

$env = ask('Environment (local/production)', 'local');
setEnv($envPath, 'APP_ENV', $env);
setEnv($envPath, 'APP_DEBUG', $env === 'local' ? 'true' : 'false');

if (confirm('Run database migrations now?', true)) {
    $seed = confirm('...and seed the database too?', true);
    run('php ' . escapeshellarg("{$root}/forge") . ' migrate' . ($seed ? ' --seed' : ''));
}

$suggestions = [
    'marrow/ui' => ['ui:install', 'marrow/ui is installed — wire Alpine.js + Tailwind for its components now?'],
    'marrow/anvil' => ['anvil:install', 'marrow/anvil is installed — scaffold a Docker dev environment now?'],
    'marrow/warden' => ['warden:install', 'marrow/warden is installed — scaffold login/register/password-reset now?'],
];

foreach ($suggestions as $package => [$command, $question]) {
    if (!is_dir("{$root}/vendor/{$package}")) {
        continue;
    }
    if (confirm($question, false)) {
        run('php ' . escapeshellarg("{$root}/forge") . ' ' . $command);
    }
}

fwrite(STDOUT, "\n\033[1;32mAll set.\033[0m Run `composer run dev` to start developing.\n\n");
