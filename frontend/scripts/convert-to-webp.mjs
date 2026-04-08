/**
 * Converts PNG/JPEG under frontend/images/ and frontend/public/ to WebP (same basename).
 * Run: npm run convert-images
 */
import { readdir, stat } from 'node:fs/promises'
import { join, dirname, parse } from 'node:path'
import { fileURLToPath } from 'node:url'
import sharp from 'sharp'

const __dirname = dirname(fileURLToPath(import.meta.url))
const roots = [
  join(__dirname, '..', 'images'),
  join(__dirname, '..', 'public')
]

const EXT = /\.(png|jpe?g)$/i

async function convertFile(absPath) {
  const { dir, name } = parse(absPath)
  const outPath = join(dir, `${name}.webp`)
  const before = (await stat(absPath)).size
  await sharp(absPath)
    .webp({ quality: 82, effort: 6 })
    .toFile(outPath)
  const after = (await stat(outPath)).size
  console.log(`${absPath} → ${(after / 1024).toFixed(1)} KiB (was ${(before / 1024).toFixed(1)} KiB)`)
}

async function walk(dir) {
  let entries
  try {
    entries = await readdir(dir, { withFileTypes: true })
  } catch {
    return
  }
  for (const e of entries) {
    const p = join(dir, e.name)
    if (e.isDirectory()) await walk(p)
    else if (EXT.test(e.name)) await convertFile(p)
  }
}

for (const root of roots) {
  await walk(root)
}
console.log('Done.')
