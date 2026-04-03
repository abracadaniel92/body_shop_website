# WordPress Foundation Setup

## Local setup

1. Copy `.env.example` to `.env`.
2. Run `docker compose up -d`.
3. Visit `http://localhost:8080` and complete install wizard.
4. Activate `bodyshop-theme` in `Appearance` -> `Themes`.

## Required core configuration

- Set permalink structure to `Post name`.
- Create pages: `Home`, `Gallery`, `Blog`.
- Set `Home` as static front page in `Settings` -> `Reading`.
- Set posts page to `Blog`.

## Suggested plugins

- Forms: WPForms Lite or Fluent Forms
- SEO: Yoast SEO or Rank Math
- Performance: LiteSpeed Cache (if host supports) or WP Rocket
- Security: Wordfence (optional but useful)
- Backups: UpdraftPlus (if host backups are insufficient)

## Staging and backup baseline

- Use host-provided staging if available.
- Enable daily database + uploads backup.
- Keep 14+ days of backup retention.
