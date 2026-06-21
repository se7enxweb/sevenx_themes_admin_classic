# SevenX Themes Admin Classic

## Overview

This extension provides session-based switching between the `admin3` and `admin_classic` designs for eZ Publish Legacy admin siteaccesses. It is modeled after the [bcswitchadminlanguage](https://github.com/se7enxweb/bcswitchadminlanguage) extension pattern.

The primary motivation is to support **SSR (server-side rendered) content tree administration** for non-JavaScript customers, while preserving the modern `admin3` design as the default.

---

## Version

- Current version: `0.1.0`
- Requires: eZ Publish Community Project 2014.11 or later

---

## How It Works

1. A **session variable** (`SevenXThemesAdminClassicDesignEnabled`) is set or cleared by the `switchadmindesign/switch` module view.
2. A **kernel override** of `ezpKernelWeb` reads this session variable on every request and — if enabled — prepends `admin_classic` to `AdditionalSiteDesignList` in memory (no ini files are modified on disk). This gives `admin_classic` templates priority over `admin3` templates for the duration of that request.
3. A **toolbar widget** (`admin_switch_design`) rendered from `design/admin_classic/templates/toolbar/full/admin_switch_design.tpl` lets editors toggle the design from within the admin UI.

---

## Installation

### 1. Activate the extension

Add to `settings/override/site.ini.append.php`:

```ini
[ExtensionSettings]
ActiveExtensions[]=sevenx_themes_admin_classic
```

### 2. Enable kernel class overrides

In your `config.php` ensure:

```php
define( 'EZP_AUTOLOAD_ALLOW_KERNEL_OVERRIDE', true );
```

See `config.php-RECOMMENDED` for reference.

### 3. Regenerate autoloads

```bash
php ./bin/php/ezpgenerateautoloads.php --kernel-override
```

### 4. Copy and customize the extension INI settings

```bash
cp extension/sevenx_themes_admin_classic/settings/sevenxthemesadminclassic.ini.append.php \
   settings/override/sevenxthemesadminclassic.ini.append.php
```

Edit `settings/override/sevenxthemesadminclassic.ini.append.php` to set the correct admin siteaccess name:

```ini
[SevenXThemesAdminClassicSettings]
SharedAdminSiteaccessName=sevenx_site_admin
```

Important:

- Do not hardcode deployment-specific values in `extension/sevenx_themes_admin_classic/settings/sevenxthemesadminclassic.ini.append.php`.
- Keep that extension file as a generic default/example.
- Put real environment values only in `settings/override/sevenxthemesadminclassic.ini.append.php`.

### 5. Clear all caches

```bash
php ./bin/php/ezcache.php --clear-all
```

### 6. Set admin siteaccess content view preferences for subitems controls

Edit your admin siteaccess file, for example:

`settings/siteaccess/korg_edit/site.ini.append.php`

Set:

```ini
[ContentSettings]
CachedViewPreferences[full]=admin_navigation_content=1;admin_navigation_subitems=1;admin_subitems_limit=200;admin_children_viewmode=list;admin_list_limit=1
TranslationList=
```

This ensures Sub items window visibility and default subitems pagination behavior are initialized correctly for admin users.

---

## Configuration

### Admin siteaccess `site.ini.append.php`

Ensure `admin_classic` is listed in `AdditionalSiteDesignList` for your admin siteaccess so the kernel override can resolve its templates:

```ini
[DesignSettings]
SiteDesign=sevenx_site_admin
AdditionalSiteDesignList[]=admin3
AdditionalSiteDesignList[]=admin_classic
AdditionalSiteDesignList[]=admin2
AdditionalSiteDesignList[]=admin
```

> Note: `admin_classic` must appear **before** `admin` and **after** `admin3` in this list when you want it enabled by default, or you can leave the list as-is and rely solely on the session-based kernel hack to prepend it dynamically.

---

## Usage

1. Log in to the admin siteaccess.
2. Locate the **Admin Design** toolbar widget in the right toolbar.
3. Click **Switch to Classic** to enable `admin_classic` templates for your current session.
4. Click **Switch to Admin3** to revert to the default `admin3` design.

The switch takes effect on the very next page load and is scoped to your browser session only — other editors are unaffected.

---

## Kernel Override Details

The following kernel class is overridden:

| Class | Original path |
|---|---|
| `ezpKernelWeb` | `kernel/private/classes/ezpkernelweb.php` |

All modifications are enclosed in clearly marked comment blocks:

```
// BEGIN SevenX : SevenXThemesAdminClassic : Kernel Hack
// END SevenX : SevenXThemesAdminClassic : Kernel Hack
```

The override is intentionally minimal: it reads one session variable and calls `$ini->setVariable()` on `DesignSettings / AdditionalSiteDesignList` — no other logic is altered.

---

## License

GNU General Public License v2.0 — see [LICENSE](../LICENSE) for details.

Copyright (C) 1998 - 2026 7x. All rights reserved.
