/**
 * Copies favicon + social preview from images/ into public/ for index.html static URLs.
 * Run: npm run sync-public-assets
 * Runs automatically before `npm run build` (prebuild).
 */
import { copyFileSync, existsSync } from 'node:fs'
import { dirname, join } from 'node:path'
import { fileURLToPath } from 'node:url'

const __dirname = dirname(fileURLToPath(import.meta.url))
const root = join(__dirname, '..')

const pairs = [
  ['images/logos/logo2.png', 'public/favicon.png'],
  ['images/preview/preview.png', 'public/og-preview.png']
]

for (const [relSrc, relDest] of pairs) {
  const src = join(root, relSrc)
  const dest = join(root, relDest)
  if (!existsSync(src)) {
    console.error(`Missing source file: ${src}`)
    process.exit(1)
  }
  copyFileSync(src, dest)
  console.log(`sync-public-assets: ${relSrc} → ${relDest}`)
}
console.log('sync-public-assets: done.')
