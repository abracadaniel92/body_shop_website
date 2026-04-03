# QA and launch checklist (static site)

## Functional checks

- Homepage loads with hero, services, about, and contact sections.
- Primary navigation works on desktop and mobile (including smooth scroll to sections).
- Map embed and external links (phone, email, social) open correctly.

## Content checks

- Logo, brand colors, and fonts match approved design.
- Service descriptions are finalized and typo-free.
- Contact details are accurate.

## Performance and SEO checks

- Images are optimized (e.g. WebP in `public/`, reasonable dimensions).
- Page title and meta tags in `frontend/index.html` are correct.
- Run Lighthouse on the production URL (Performance, Accessibility, SEO).

## Security and reliability checks

- HTTPS enforced on the host (Netlify).
- No secrets committed to the repo; use host UI for any future env vars.

## Go-live runbook

1. Run `npm run build` in `frontend/` and fix any errors.
2. Deploy or trigger production build on Netlify.
3. Point DNS / domain as required.
4. Smoke test critical sections and contact actions.
5. Monitor for 404s and broken assets for 48 hours after launch.
