# sevenx_themes_admin_classic v0.2.3

## Release Overview

This is a small packaging/configuration follow-up release that aligns extension-level `site.ini.append.php` defaults to a safer distribution posture.

## What Changed

### Extension `site.ini` policy-omit line is now commented by default

Updated file:

- `settings/site.ini.append.php`

Current distributed content:

```ini
# [RoleSettings]
# PolicyOmitList[]=switchadmindesign
```

## Why This Matters

Leaving policy omit entries commented in the extension default avoids surprising permission bypass behavior in downstream deployments while still documenting the optional setting for operators who intentionally need it.

## Scope

- Configuration/commentary change only
- No runtime PHP logic changes
- No template behavior changes

## Versioning

- Previous release: v0.2.2
- Current release: v0.2.3

