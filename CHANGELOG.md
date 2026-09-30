# Changelog

All notable changes to this project are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/).

---

## [Unreleased]

## [2.0.0] - 2026-09-30

A tooling and supply-chain hardening release — no changes to the application
code the skeleton generates (`bootstrap/`, `modules/`, `config/`), so an
existing project stays compatible after re-syncing these files by hand. Bumped
to a major version to mark it as the new baseline for anything freshly
scaffolded with `composer create-project marrow/skeleton`.

### Added

- **`security-audit` CI job** (`.github/workflows/ci.yml`) — runs
  `composer audit --format=plain` against `composer.lock` on every push/PR,
  matching the job the framework core repository already runs.
- **`frontend` CI job** — runs `npm ci && npm run build` on every push/PR.
  The Vite + Tailwind CSS pipeline (`resources/`, `vite.config.js`) previously
  had no CI coverage at all; a broken build config would only surface at
  deploy time.
- **`.github/dependabot.yml`** — weekly automated dependency updates for the
  three ecosystems this repository actually uses: `composer`, `npm` (Vite/
  Tailwind grouped into one PR), and `github-actions`. Targets `develop`,
  matching the branch strategy already in place.
- **`composer.json` `suggest`** — `marrow/form-builder`, `marrow/anvil`, and
  `marrow/compass` are now declared as suggested packages, so they show up on
  the package's Packagist page and in `composer suggests`, instead of being
  discoverable only by reading the README's "Optional packages" section.
- **Composer dependency caching** in every CI job (`actions/cache` keyed on
  `composer.lock`), cutting `composer install` time on repeat runs.

### Changed

- **Every GitHub Action used in CI is now pinned to a full commit SHA**
  (`actions/checkout`, `shivammathur/setup-php`, `actions/cache`,
  `actions/setup-node`) instead of a mutable version tag (`@v4`, `@v2`) —
  closes the same supply-chain gap the framework core fixed in its own
  `2.2.0` (a rewritten tag on the action's side could otherwise inject code
  into the pipeline undetected). The skeleton's CI had not been updated to
  match core's when that fix originally shipped; this release brings it back
  to parity.

## [1.0.0] - 2026-09-25

Initial stable release of the skeleton (originally scaffolded under the
project's pre-rebrand name, IronFlow, then renamed to Marrow before this
release). Ships the base runtime structure for a Marrow application:
`bootstrap/app.php`, the `forge` console entry point, the `Home` and
`Account` starter modules, the Vite + Tailwind CSS v4 frontend pipeline, and
a Pest test suite wired to boot the real `Application`.
