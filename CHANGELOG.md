# Changelog

All notable changes to this project are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/).

---

## [Unreleased]

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
