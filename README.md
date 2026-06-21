# sevenx_themes_admin_classic — 7x Admin Classic Session Switch (Stable; Open Source; eZ Publish Legacy Extension)

[![Platform](https://img.shields.io/badge/Exponential%20Platform-Legacy-orange)](https://github.com/se7enxweb/exponential-platform-legacy)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)

> sevenx_themes_admin_classic provides session-driven switching between admin3-first template resolution and admin3+admin_classic fallback resolution for legacy admin workflows requiring classic SSR template behavior.

---

## Table of Contents

1. Project Notice
2. Project Status
3. What Is sevenx_themes_admin_classic?
4. Requirements
5. Installation
6. Configuration
7. kracker.org Deployment Note (Critical)
8. Troubleshooting
9. Issue Tracker
10. License

---

## Project Notice

This project is an independent extension maintained by 7x for Exponential Platform Legacy and eZ Publish Legacy deployments.

---

## Project Status

sevenx_themes_admin_classic is actively maintained and intended for production use where admin3 must remain the primary design while selective classic fallback behavior is required.

---

## What Is sevenx_themes_admin_classic?

The extension adds:

- A toolbar switch button in admin UI
- A module endpoint to toggle design mode in session
- A kernel override to apply session-driven DesignSettings values at runtime

Current runtime behavior:

- Classic enabled: AdditionalSiteDesignList = `admin3, admin_classic, admin`
- Classic disabled: AdditionalSiteDesignList = `admin3, admin`

SiteDesign remains `admin3`.

---

## Requirements

- Exponential Platform Legacy / eZ Publish Legacy
- Kernel overrides enabled in `config.php`
- Extension activated in `settings/override/site.ini.append.php`

---

## Installation

1. Activate extension:

```ini
[ExtensionSettings]
ActiveExtensions[]=sevenx_themes_admin_classic
```

2. Ensure kernel override support is enabled:

```php
define( 'EZP_AUTOLOAD_ALLOW_KERNEL_OVERRIDE', true );
```

3. Regenerate autoloads:

```bash
php ./bin/php/ezpgenerateautoloads.php --kernel-override
```

4. Customize admin siteaccess content view preferences (required for subitems controls):

Edit your admin siteaccess file, for example:

`settings/siteaccess/korg_edit/site.ini.append.php`

Set:

```ini
[ContentSettings]
CachedViewPreferences[full]=admin_navigation_content=1;admin_navigation_subitems=1;admin_subitems_limit=200;admin_children_viewmode=list;admin_list_limit=1
TranslationList=
```

5. Clear caches:

```bash
php ./bin/php/ezcache.php --clear-all
```

---

## Configuration

Configure extension settings file:

`extension/sevenx_themes_admin_classic/settings/sevenxthemesadminclassic.ini.append.php`

Important:

- Keep the extension file value as a generic example/default.
- Put deployment-specific values only in `settings/override/sevenxthemesadminclassic.ini.append.php`.

Required setting:

```ini
[SevenXThemesAdminClassicSettings]
SharedAdminSiteaccessName=<your_admin_siteaccess_name>
SwitchAdminDesignSessionVariableName=SevenXThemesAdminClassicDesignEnabled
```

---

## kracker.org Deployment Note (Critical)

For this deployment, the required value is:

```ini
SharedAdminSiteaccessName=korg_edit
```

Set this value in:

`settings/override/sevenxthemesadminclassic.ini.append.php`

If this value does not match the real admin siteaccess name, switch button text may change while template resolution behavior does not.

---

## Troubleshooting

### Symptom: switch button toggles text but templates loaded do not change

Checklist:

1. Confirm `SharedAdminSiteaccessName` exactly matches active admin siteaccess.
2. Confirm extension is active in `settings/override/site.ini.append.php`.
3. Confirm kernel override autoloads were regenerated.
4. Confirm caches were cleared.
5. Confirm you are testing within the configured admin siteaccess.

### Symptom: switch endpoints work but runtime design order seems stale

Run:

```bash
php ./bin/php/ezcache.php --clear-all --allow-root-user
```

---

## Issue Tracker

Submit issues and improvements at:

https://github.com/se7enxweb/sevenx_themes_admin_classic/issues

---

## License

GNU General Public License v2.0 (or any later version).

Copyright (C) 1998 - 2026 7x.
