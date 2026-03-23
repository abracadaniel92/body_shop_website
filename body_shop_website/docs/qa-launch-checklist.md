# QA and Launch Checklist

## Functional checks

- Homepage loads with hero, services, and contact sections.
- Primary navigation works on desktop and mobile.
- Gallery archive lists `gallery_item` entries.
- Each gallery item shows both before/after images.
- Blog archive and single post pages render correctly.

## Content checks

- Logo, brand colors, and fonts match approved design.
- Service descriptions are finalized and typo-free.
- Contact details are accurate.
- At least 3 gallery items and 3 blog posts are published.

## Performance and SEO checks

- Install and configure SEO plugin (Yoast or Rank Math).
- Enable caching (host-level cache or plugin).
- Compress large images before upload.
- Verify page titles and meta descriptions for Home/Gallery/Blog.

## Security and reliability checks

- SSL enabled and enforced.
- Backups scheduled daily.
- Admin account uses strong password and MFA if available.
- Unused plugins/themes removed.
- Staging backup available before go-live.

## Go-live runbook

1. Take final backup snapshot.
2. Deploy/point domain to production.
3. Flush cache.
4. Smoke test critical pages.
5. Monitor form submissions and 404 logs for 48 hours.
