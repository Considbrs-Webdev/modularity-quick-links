# AGENTS.md

Instructions for AI tools working in this repository. Read this first.

## Project

Modularity Quick Links is a WordPress plugin that registers a Modularity module. Editors use it to place a responsive grid of link cards on a page. It is PHP 8, Blade, Sass, and Vite. It runs inside WordPress with the Modularity plugin, the Municipio theme (icon component), and ACF Pro. AcfExportManager is provided by that host stack and is not a Composer dependency of this repo.

## Setup and commands

| Task | Command |
| --- | --- |
| Install | `composer install` then `npm install` |
| Run locally | Activate the plugin in a WordPress site that has Modularity, Municipio, and ACF Pro. `npm run dev` starts Vite. `npm run watch` rebuilds assets on change. |
| Build | `npm run build` |

`composer install` only generates `vendor/autoload.php`. There is no `composer.lock` and no Composer package dependency. There is no test or lint command.

## Structure

- `modularity-quick-links.php` — plugin bootstrap, text domain, ACF import, Modularity view path.
- `source/php/App.php` — registers the module and enqueues the stylesheet in the block editor.
- `source/php/Module/QuickLinks.php` — module data and asset enqueue. Blade view: `source/php/Module/views/quick-links.blade.php`.
- `source/php/AcfFields/` — ACF field group `settings` (`group_69445f2589f85`), JSON and PHP export.
- `source/php/Helper/CacheBust.php` — resolves built filenames from `assets/dist/manifest.json`.
- `source/sass/modularity-quick-links.scss` — module styles.
- `languages/` — text domain `modularity-quick-links`. Edit the `.po` / `.pot`. The `.mo` is the compiled catalog and is committed.
- `build.php` — CLI packaging script. Not the version or tag step.
- `vendor/`, `node_modules/`, and `assets/` are generated and gitignored. Do not edit them.

## Conventions

- Follow `docs/CODING_STANDARDS.md` for new and changed code. That file is a proposal until the team adopts it.
- Do not refactor unrelated code. Deviations in older code are not a reason to rewrite it.
- Comments explain why, briefly. Never refer to documents from code comments; restate the relevant information in the comment instead.
- There is no automated test suite. Before saying work is done, run `php -l` on changed PHP files and `npm run build` when Sass, Vite config, or other assets changed.

## Release

- Development branch: `dev`. Release branch: `main` (repository default). Merge `dev` into `main` with `--ff-only`.
- Declared versions: `Version:` in `modularity-quick-links.php` and `version` in `package.json`. Keep `package-lock.json` in sync. `composer.json` has no version field.
- Tag style is `1.0.0` with no `v` prefix. Create an annotated tag on `main` and publish it with `gh release create`.
- Changelog: `CHANGELOG.md`, Keep a Changelog headings (Added / Changed / Fixed).
- There is no test or lint command. `npm run build` must succeed before the release commit.
- `php build.php` runs `composer dump-autoload`, `npm ci`, and `npm run build`. `--cleanup` deletes development files. `--release` keeps `.git`. It does not bump the version or create the tag.
- The release commit message is `Release X.Y.Z`. That commit only touches version files and `CHANGELOG.md`.

## Where to find more

- `README.md` — editor options and CSS custom properties.
- Filter `Modularity/Display/mod-quick-links/viewData` — Municipio passes the module view data through this hook. `quickLinksRootStyle` is printed on the root element when set.
- Field group `settings` in `source/php/AcfFields/`.
- No ADRs or other architecture docs.

## Security and data

- Secrets come from environment variables or the project's secret management. Never read, print or commit their values, and never put them in instructions, code or logs. This repo has no `.env` file.
- Personal, customer and other sensitive data may only be used when approved by the customer and project owner. Use synthetic or anonymized data where possible.
- Project-specific restrictions: none.

## Working with AI

- The developer is responsible for understanding, reviewing and verifying everything AI produces.
- If a guard or permission blocks an action, do not work around it. Report it and let the developer decide.
- If these instructions cause unnecessary steps or unwanted behavior, tell the developer so this file can be improved.
