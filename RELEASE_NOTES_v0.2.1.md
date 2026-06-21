# sevenx_themes_admin_classic v0.2.1

## Release Overview

This release republishes the extension with explicit licensing hardening by including fresh, canonical GNU GPL v2 license texts directly sourced from GNU.org and shipped inside the extension package in both plain text distribution forms.

## Why This Release Exists

The extension repository already contained functional packaging, switching runtime behavior, toolbar controls, and release documentation. This release focuses specifically on legal/distribution clarity and downstream packaging hygiene so every checkout, archive, and deployment artifact carries embedded license documents in expected filenames.

## Included Changes

### 1. Fresh GNU-sourced license files

The following files are now included in the extension root and were sourced from the official GNU endpoint:

- `LICENSE`
- `LICENSE.md`

Source used:

- `https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt`

Both files are intentionally identical in content for broad ecosystem compatibility:

- `LICENSE` for conventional package tooling and scanners
- `LICENSE.md` for repository/browser readability expectations

### 2. Distribution and compliance improvement

By shipping canonical GNU GPL v2 text at extension root:

- repository consumers receive the full license with no external dependency
- package mirrors and export archives preserve licensing context
- compliance checks in automated scanners become more deterministic

## Release Context

This is a documentation-and-packaging focused follow-up release. No runtime business logic or kernel behavior has been changed in this tag.

## Verification Notes

- GNU text was downloaded directly via HTTPS from GNU.org
- Both files were generated from that fresh source in the extension repository
- Tag and GitHub release were created from the updated repository state

## Versioning

- Previous baseline: `v0.2.0`
- Current release: `v0.2.1`

