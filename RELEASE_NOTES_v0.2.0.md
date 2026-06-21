# sevenx_themes_admin_classic v0.2.0

## Release Summary

This release establishes the first standalone publication of the sevenx_themes_admin_classic extension as a dedicated repository and production-capable package for eZ Publish Legacy / Exponential Platform Legacy environments.

The release focuses on safe administration ergonomics, predictable fallback behavior, cache-aware switching operations, and scalable subitems navigation controls for editors who manage large content trees.

## Scope and Intent

The extension is designed to make admin design switching explicit, reversible, and operationally transparent.

Key implementation choices in this release emphasize:

- Session-oriented runtime behavior instead of destructive global toggles.
- Conservative compatibility with legacy template and kernel expectations.
- Configuration layering that keeps extension defaults portable while preserving deployment-specific overrides.
- Operator-first toolbar placement and quick access to switch and cache controls.

## Major Capabilities Included

### 1. Admin Design Switch Workflow

- Introduces switch module endpoints for mode activation and reset.
- Persists active mode through dedicated session variables.
- Supports deterministic return to default admin mode.
- Integrates into admin toolbar for direct operator access.

### 2. Kernel-Aware Runtime Design Resolution

- Applies session-driven AdditionalSiteDesignList behavior in runtime context.
- Maintains SiteDesign stability while enabling classic layering behavior.
- Includes practical cache lifecycle handling to reduce stale resolver artifacts.

### 3. Toolbar Integration Improvements

- Adds Admin Design tool registration in extension and siteaccess toolbar contexts.
- Repositions Admin Design beneath clear-cache in developer toolbar block for practical operations sequence.

### 4. Classic Subitems Display Controls

- Adds a dedicated window control to enable or disable Sub items display.
- Moves from low fixed limits to user preference driven limits.
- Adds clickable pagination presets at 200, 500, and 1000.
- Adds user-defined limit input with explicit Set action.
- Introduces configurable defaults and maximum bounds in extension ini settings.

### 5. Cache Safety During Switching

- Clears template and template-block cache tags during switch and reset handlers.
- Supports immediate visual/application of updated design mode behavior.

### 6. Packaging and Metadata

- Adds extension-level composer manifest.
- Includes verbose ecosystem metadata and operational notes for maintainers.
- Publishes branch and semantic tag baseline for future release cadence.

## Configuration Notes

- Extension defaults remain generic and transportable.
- Deployment-specific values are expected in settings/override files.
- Siteaccess binding correctness is mandatory for switch behavior to apply.
- Cached view preference defaults include subitems visibility and limit defaults.

## Operational Guidance

After deployment or update:

1. Clear template and template-block caches.
2. Verify toolbar ordering in admin developer block.
3. Confirm switch and reset actions persist and revert session state correctly.
4. Validate subitems browsing presets and custom limit behavior in classic mode.

## Compatibility

Target platform:

- eZ Publish Legacy
- Exponential Platform Legacy

Runtime expectations:

- Session support enabled
- User preference route access available
- Legacy template resolver behavior preserved

## Known Constraints

- Release objects in GitHub require GitHub CLI or API token flow from the execution environment.
- Runtime behavior depends on deployment-level siteaccess correctness and cache hygiene.

## Tag and Baseline

- Version tag: v0.2.0
- Branch baseline: main

## Closing Note

This initial release is intentionally conservative and explicit, favoring predictable behavior under legacy production constraints while still providing meaningful editor and operator quality-of-life improvements.