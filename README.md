# Дака Драган — static website

Marketing site for the body shop, built as a **static** [Vue 3](https://vuejs.org/) + [Vite](https://vitejs.dev/) app and deployed to Netlify.

## Development

```bash
cd frontend
npm install
npm run dev
```

Build for production:

```bash
cd frontend
npm run build
```

Output is written to `frontend/dist/` (Netlify publishes this per `netlify.toml`).

## Repository layout

- `frontend/` — source for the static site (components, styles, assets in `public/`)
- `images/` — optional source images (e.g. originals before WebP conversion)
- `docs/` — checklists and notes for launch and content
- `SECURITY.md` — responsible disclosure for security reports

There is **no** CMS, database, or server-side runtime in this repo.
