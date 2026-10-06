# Changelog

All notable changes to this project are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/).

---

## [Unreleased]

## [3.0.0] - 2026-10-06

### Changed (breaking)

- **Requires `marrow/framework` ^3.0** (was ^2.4) — that release makes `RedirectResponse`/`JsonResponse`
  genuine subclasses of `Response` instead of independent siblings of it (see core's own CHANGELOG). Nothing in
  this repository's own code needed a change for it — `tests/TestCase.php`'s `dispatch()` already typed its
  return as `Marrow\Http\Response` as of the previous release, which resolves correctly either way. Verified
  against the real, published `v3.0.0` (not a simulation): `composer update marrow/framework`, full Pest suite,
  PHPStan, and a real `php forge serve` + `curl` pass, all green.

### Added

- **`.gitattributes`** — `export-ignore` on `.github/` and `CHANGELOG.md`. Both are this *template's* own
  maintainer tooling (a PHP 8.2/8.3/8.4 CI matrix targeting `main`/`develop` — this repo's own branches, not a
  new project's; a changelog of the template's own releases) — neither belongs in what
  `composer create-project` actually hands a new project. They stay in the GitHub repository for anyone
  contributing to the skeleton itself; a fresh `my-app` just doesn't receive them anymore.

## [2.5.0] - 2026-10-06

### Added

- **Interactive post-create-project setup wizard** (`bin/install.php`, run automatically by
  `composer create-project` right after `.env` is copied and `APP_KEY` is generated; re-run any time with
  `composer run install-wizard`) — asks for the app name and environment (written straight into `.env`),
  offers to run `migrate --seed` immediately, and — only if the package is actually installed — offers to run
  `ui:install`/`anvil:install`/`warden:install` too, instead of leaving a new user to discover each of those
  commands by reading READMEs one at a time. Skips every question outright when `STDIN` isn't a real terminal
  (CI, `--no-interaction`), so scripted installs are unaffected.
- **`composer run dev`** — runs `php forge serve` and `npm run dev` concurrently (via `concurrently`, labeled
  `server`/`vite`, both logging to the same terminal), the single command now recommended in Getting Started.
  `php forge serve --watch-css` remains as the no-extra-Node-dependency alternative, documented with its one
  real tradeoff: it starts Vite as a silent background process, so a Vite build error never reaches your
  terminal.

## [2.3.0]

First release pinned to `marrow/framework ^2.4`. Earlier versions aren't individually detailed here — see
`marrow/framework`'s own CHANGELOG for what shipped in that range.
