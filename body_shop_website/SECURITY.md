# Security policy

This document describes how we handle security for the **Дака Драган** body shop website project (Vue 3 + Vite frontend, with optional WordPress-related tooling in this repository).

## Supported versions

| Target | Security updates |
| ------ | ------------------ |
| `main` branch (latest) | Yes — primary line for fixes and production deploys |
| Feature branches | Fixes should land on `main`; backports are best-effort |
| Archived or unmaintained forks | Not supported |

## Dependency maintenance

We reduce risk from third-party packages by:

- Running **`npm audit`** before releases and when upgrading tooling.
- Using **`npm audit fix`** (and, when needed, targeted version bumps) in:
  - `frontend/` — Vue app and Vite build chain.
  - `wordpress/wp-content/themes/twentytwentyfive/` — only if you install that theme’s npm dev dependencies for local builds.
- Reviewing **GitHub Dependabot** alerts on the default branch and applying updates via pull requests.

Verify locally after pulling latest:

```bash
cd frontend && npm audit
cd ../wordpress/wp-content/themes/twentytwentyfive && npm audit
```

A clean report depends on current advisories; re-run after dependency changes.

## Reporting a vulnerability

**Please do not** use public issues to report undisclosed security problems.

1. **Preferred:** On GitHub, open the repository → **Security** → **Report a vulnerability** (if enabled).
2. **Email:** [contact@daka-dragan.mk](mailto:contact@daka-dragan.mk) with a subject line starting with `[SECURITY]`.

Include enough detail to reproduce or assess impact (affected URL or component, steps, and, if applicable, proof-of-concept). We aim to send an initial response within **5 business days**, then work with you on severity, fix timeline, and coordinated disclosure where appropriate.

## What we may ask for

- Version/commit you tested against.
- Whether the issue is reproducible on the latest `main`.
- For frontend issues: browser and environment when relevant.

Thank you for helping keep users and the site safe.
