# sevenx_themes_admin_classic v0.2.4

## Release Overview

This release addresses real-world admin switch issues around toolbar visibility, policy expectations, and redirect stability, with a focus on preserving the current working URI when toggling design mode.

## What Changed

### 1. Redirect behavior hardened for switch button

Updated switch flow to avoid intermittent host-authorization failures and wrong-path redirects:

- sanitizes redirect targets to local-safe URI form
- strips scheme/host when absolute URLs are posted
- prevents protocol-relative redirect abuse

### 2. Redirect fallback strategy corrected

Switch actions no longer hardcode dashboard as a primary fallback path.

Current redirect preference order:

1. posted `RedirectURI`
2. session `LastAccessesURI`
3. `HTTP_REFERER`
4. `/` (final safe fallback)

### 3. Current-page redirect source improved in toolbar

Toolbar templates now provide stable current-page redirection inputs and include stronger fallback handling so users return to their working context after toggling design mode.

### 4. Toolbar visibility guidance improved in docs

README and detailed doc README now explicitly document required toolbar registration and role policy expectations, with copy/paste INI examples.

## Impact

- prevents random redirects to unrelated pages while switching design mode
- reduces "non-authorized host" redirect failures
- improves admin UX continuity when switching on pages like role/module views
- clarifies installation and permission setup to avoid missing-button incidents

## Scope

- module redirect handling updates
- toolbar template updates
- documentation clarity updates

## Versioning

- Previous release: v0.2.3
- Current release: v0.2.4

