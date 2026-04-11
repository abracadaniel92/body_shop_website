# Security policy

This document describes how we handle security for the **Centar Srbija Stil** website (Vue 3 + Vite, deployed as static files).

## Supported versions

| Target | Security updates |
| ------ | ---------------- |
| `main` branch (latest) | Yes — primary line for fixes and production deploys |
| Feature branches | Fixes should land on `main`; backports are best-effort |
| Archived or unmaintained forks | Not supported |

## Dependency maintenance

We reduce risk from third-party packages by:

- Running **`npm audit`** in this repository root before releases and when upgrading tooling.
- Using **`npm audit fix`** (and, when needed, targeted version bumps) for the Vite/Vue toolchain.
- Reviewing **GitHub Dependabot** alerts on the default branch and applying updates via pull requests.

Verify locally after pulling latest:

```bash
npm audit
```

## Reporting a vulnerability

**Please do not** use public issues to report undisclosed security problems.

1. **Preferred:** On GitHub, open the repository → **Security** → **Report a vulnerability** (if enabled).
2. **Email:** [contact@gmojsoski.com](mailto:contact@gmojsoski.com) with a subject line starting with `[SECURITY]`.

Include enough detail to reproduce or assess impact (affected URL or component, steps, and, if applicable, proof-of-concept). We aim to send an initial response within **5 business days**, then work with you on severity, fix timeline, and coordinated disclosure where appropriate.

## What we may ask for

- Version/commit you tested against.
- Whether the issue is reproducible on the latest `main`.
- For frontend issues: browser and environment when relevant.

Thank you for helping keep users and the site safe.
