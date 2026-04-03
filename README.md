# Body Shop Website Starter

This repository contains a WordPress-first implementation (Docker) and a **Vue 3 + Vite** frontend in `frontend/` used for the marketing site deploy (e.g. Netlify).

## What is included

- WordPress local environment via Docker.
- A custom theme: `bodyshop-theme`.
- Homepage structure for hero, services, and contact sections.
- Gallery system with before/after image fields.
- Blog listing and single-post templates.
- Admin/editor workflow docs and launch checklist.

## Quick start

1. Copy `.env.example` to `.env` and adjust values if needed.
2. Run `docker compose up -d`.
3. Open `http://localhost:8080` to complete WordPress setup.
4. Activate theme: `bodyshop-theme`.
5. Follow `docs/editor-guide.md` for non-technical content operations.

## Project structure

- `frontend/` - Vue 3 + Vite app (production build published by Netlify)
- `docker-compose.yml` - WordPress + MySQL local stack
- `wordpress/wp-content/themes/bodyshop-theme` - custom theme
- `docs/01-platform-decision.md` - platform confirmation
- `docs/02-design-assets-checklist.md` - assets/content intake
- `docs/03-content-model.md` - content model and fields
- `docs/editor-guide.md` - admin guide for editors
- `docs/qa-launch-checklist.md` - launch readiness checklist
