# sevenx_themes_admin_classic v0.2.2

## Release Overview

This is a documentation-focused follow-up release that closes an installation gap for administrators configuring subitems display behavior.

## What Changed

### 1. Installation documentation now explicitly covers CachedViewPreferences customization

Updated installation guidance to include required admin siteaccess configuration for:

- subitems window visibility default
- subitems pagination default limit
- compatibility with the new subitems controls introduced in prior releases

Canonical configuration line documented:

```ini
[ContentSettings]
CachedViewPreferences[full]=admin_navigation_content=1;admin_navigation_subitems=1;admin_subitems_limit=200;admin_children_viewmode=list;admin_list_limit=1
TranslationList=
```

### 2. Main README updated

The primary installation walkthrough now includes the missing siteaccess customization step with deployment example context.

### 3. Detailed documentation updated

The extended documentation now includes the same required setting and clarifies why it is necessary for correct runtime behavior.

## Why This Matters

Without this setting documented and applied, administrators can observe confusing subitems UI behavior or defaults that do not reflect extension capabilities. This release makes the install path explicit and repeatable.

## Scope

- Documentation only
- No runtime PHP logic changed
- No template logic changed

## Versioning

- Previous release: v0.2.1
- Current release: v0.2.2

