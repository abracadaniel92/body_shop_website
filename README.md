# Дака Драган — static website

Marketing site for the body shop, built as a **static** [Vue 3](https://vuejs.org/) + [Vite](https://vitejs.dev/) app and deployed to Netlify.

## Development

From the repository root:

```bash
cd frontend
npm install
npm run dev
```

If your shell is already in **`frontend/`**:

```bash
npm install
npm run dev
```

Build for production (from **`frontend/`**):

```bash
npm run build
```

Or from the repository root:

```bash
cd frontend
npm run build
```

Output is written to **`frontend/dist/`**. Netlify publishes it per **`netlify.toml`** at the **repository root** (`base = "frontend"`).

## Repository layout

From the **repository root**:

- **`frontend/`** — Vue app: `src/`, `public/`, `package.json`
- **`frontend/images/`** — optional source images (e.g. originals before WebP conversion into `public/`)
- **`docs/`** — checklists and launch notes
- **`SECURITY.md`** — security policy and reporting

There is **no** CMS, database, or server-side runtime in this repo.

Netlify configuration: **`netlify.toml`** (repository root).
