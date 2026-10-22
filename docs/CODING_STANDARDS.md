# Coding standards

Proposal for new and changed code. The team decides which rules to keep. Deviations in older code are not by themselves a reason to rewrite it. Nothing below is enforced by a linter, formatter, or CI check. There is no `.editorconfig`, PHP_CodeSniffer, PHPStan, ESLint, or Prettier config.

## Language and tooling

- PHP `>=8.0`, as declared in `composer.json`. Observed pattern. The plugin runs on WordPress with Modularity, Municipio, and ACF Pro.
- Module classes live under `ModularityQuickLinks\` and map to `source/php/` (PSR-4). Observed pattern.
- Styles are Sass, built by Vite (`npm run build`) into `assets/dist/`. Observed pattern. Do not edit `assets/dist/` or `vendor/`.
- User-facing strings use the text domain `modularity-quick-links`. Observed pattern.

## Naming and structure

- PHP classes are PascalCase. Methods are camelCase. Observed pattern.
- CSS classes use the `modularity-quick-links` block and `__element` / `--modifier` suffixes. Observed pattern.
- Module slug is `quick-links`. The Modularity view key is `mod-quick-links`. Observed pattern.
- ACF field groups are exported to `source/php/AcfFields/json/` and `source/php/AcfFields/php/`. Change fields there rather than only in the database. Observed pattern.

## Error handling

- Missing built assets are reported only when `WP_DEBUG` is on, as HTML from `CacheBust`. Observed pattern.
- The module returns empty strings and empty arrays for missing link data instead of throwing. Observed pattern.

## Testing

- There is no test runner, test directory, or CI workflow. Do not add a test framework unless the team asks for one.

## Security

- The bootstrap stops direct file access when `WPINC` is not defined. Observed pattern.
- Blade output uses `{{ }}`. Do not print unescaped HTML for editor-entered titles, descriptions, or URLs. Observed pattern.
- Do not commit secrets. This repository does not contain `.env` or credential files.

## Dependencies

- Composer requires only PHP. `vendor/autoload.php` is generated. Observed pattern.
- npm dev dependencies are Vite, Sass, and TypeScript. The build entry is `source/sass/modularity-quick-links.scss`. Observed pattern.
- `AcfExportManager`, `Modularity\Module`, and the Municipio component library come from the host site. Do not add them to `composer.json` unless the team decides to vendor them.

## Git and reviews

- `main` is the default and release branch. `dev` is the long-lived development branch. Observed pattern, confirmed for this setup.
- Pull requests are merged into `dev`. The one existing merge is a merge commit. Observed pattern.
- Commit messages are short sentences. No commit-message tool enforces a format. Observed pattern.
- Version tags have no `v` prefix (`1.0.0`). The release steps are in `AGENTS.md`.

## Proposed improvements

These are not rules. Older code does not need to be rewritten for them.

- `array()` and `[]` are both used. Pick one for new PHP.
- Some methods have parameter and return types, and some do not. New methods can be typed without rewriting old ones.
- `typescript` is a dev dependency and there are no TypeScript sources.
- `CacheBust::name()` accepts `$returnName` and does not use it.
- There is no linter, formatter, or test run to check these conventions.
