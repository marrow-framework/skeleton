<div align="center">

# IronFlow Skeleton

The starter application skeleton for the [IronFlow](https://github.com/ironflow-framework/framework) HMVC framework.

</div>

---

## Requirements

- PHP >= 8.2
- Composer 2

## Getting started

```bash
composer create-project ironflow-framework/skeleton my-app
cd my-app

cp .env.example .env
php forge key:generate

php forge migrate --seed

npm install
php forge serve --watch-css   # PHP server + Vite dev server together
```

Visit `http://localhost:8080`.

## What's included

| Path | Purpose |
|---|---|
| `bootstrap/app.php` | Builds the `Application` instance — the one place `public/index.php` and `forge` both require |
| `public/index.php` | HTTP front controller — point your web server here |
| `forge` | Console entry point (`php forge list`) |
| `bin/server.php` | Router used by `php forge serve` / `php -S` |
| `config/` | One file per subsystem — see [Configuration](https://github.com/ironflow-framework/framework/blob/main/docs/configuration.md) |
| `modules/Account/` | Owns the `User` model, RBAC/2FA/audit-log migrations, and the roles seeder — no routes of its own |
| `modules/Home/` | A minimal working HMVC module (`/`, `/health`, and `/contact` — a real working example of `ironflow-framework/form-builder`) |
| `database/migrations/` | Queue + notifications tables (framework infrastructure, not owned by any one module) |
| `database/seeders/` | The master `DatabaseSeeder`, which delegates to `Account`'s own seeder |
| `resources/views/` | Twig templates — only `layouts/` ships by default; `errors`/`components`/`partials`/`emails` are auto-registered as Twig namespaces the moment you create them |
| `resources/{css,js}/`, `vite.config.js`, `package.json` | Vite + Tailwind CSS v4 build pipeline — see [Frontend Assets](https://github.com/ironflow-framework/framework/blob/main/docs/frontend.md) |
| `tests/` | Pest, wired to boot the real `Application` and dispatch through `Http\Kernel` |

> **There is no `app/` directory, and that's deliberate.** Authentication
> isn't framework-level glue — it's a domain concern, so `User` and its
> schema live in the `Account` module instead of a generic `app/Models/`.
> Every `make:*` generator still defaults to `app/...` when `--module` is
> omitted and creates that directory itself on demand
> (`@mkdir(..., 0755, true)` before writing) — see
> [The `forge` CLI](https://github.com/ironflow-framework/framework/blob/main/docs/cli.md#default-output-paths)
> for the exact default path each one writes to — but nothing forces you to use it.
> Prefer `--module=Name` for anything that belongs to a specific domain,
> the way `Account` and `Home` do here.
>
> **Controllers always live in a module.** Routing only ever loads
> `modules/*/routes.php` — there is no global route file for `app/`. A
> controller generated with `php forge make:controller` and no `--module`
> lands in `app/Controllers/`, but nothing will ever route to it. Always
> pass `--module=Name`.

## Adding a module

```bash
php forge make:module Blog
```

Then enable it in `config/modules.php`:

```php
'enabled' => [
    \Modules\Account\AccountModule::class,
    \Modules\Home\HomeModule::class,
    \Modules\Blog\BlogModule::class,
],
```

## Documentation

Full framework documentation lives in the
[framework repository's `docs/`](https://github.com/ironflow-framework/framework/tree/main/docs),
starting with [Getting Started](https://github.com/ironflow-framework/framework/blob/main/docs/getting-started.md).

## License

MIT — see [LICENSE](LICENSE).
