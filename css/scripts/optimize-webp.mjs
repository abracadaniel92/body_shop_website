/**
 * Recompresses existing .webp files in images/ (resize down + lower quality).
 * Skips images/logo/ and images/logo.webp so the nav logo stays crisp.
 *
 * Typical result: multi‑MB files drop to a few hundred KB with minimal visible loss.
 *
 * Run: npm run compress-webp
 */
import fs from 'fs'
import path from 'path'
import sharp from 'sharp'
import { fileURLToPath } from 'url'

const __dirname = path.dirname(fileURLToPath(import.meta.url))
const imagesRoot = path.join(__dirname, '..', 'images')

function shouldSkipRel (rel) {
  const n = rel.replace(/\\/g, '/')
  if (n.startsWith('logo/')) return true
  if (n === 'logo.webp') return true
  return false
}

function maxWidthAndQuality (rel) {
  const n = rel.replace(/\\/g, '/')
  /* Paths are like `hero/4.webp` (no leading slash) — match prefix, not only `/hero/` */
  if (n.startsWith('hero/') || n.includes('/hero/')) {
    return { maxW: 1920, q: 78 }
  }
  if (n.startsWith('History/') || n.includes('/History/')) {
    return { maxW: 1200, q: 74 }
  }
  if (/^(1|2|3)\.webp$/i.test(path.basename(n)) && !n.includes('/')) {
    return { maxW: 900, q: 76 }
  }
  return { maxW: 1600, q: 73 }
}

function collectWebp (dir, out) {
  for (const name of fs.readdirSync(dir)) {
    const full = path.join(dir, name)
    const st = fs.statSync(full)
    if (st.isDirectory()) {
      if (path.basename(full) === 'logo') continue
      collectWebp(full, out)
    } else if (name.toLowerCase().endsWith('.webp')) {
      out.push(full)
    }
  }
}

async function optimizeOne (filePath) {
  const rel = path.relative(imagesRoot, filePath).replace(/\\/g, '/')
  if (shouldSkipRel(rel)) {
    console.log('skip:', rel)
    return
  }

  const { maxW, q } = maxWidthAndQuality(rel)
  const before = fs.statSync(filePath).size
  const input = fs.readFileSync(filePath)

  let img = sharp(input).rotate()
  const meta = await img.metadata()
  if (meta.width && meta.width > maxW) {
    img = sharp(input)
      .rotate()
      .resize(maxW, null, { fit: 'inside', withoutEnlargement: true })
  }

  const buf = await img.webp({ quality: q, effort: 6 }).toBuffer()
  const after = buf.length

  fs.writeFileSync(filePath, buf)

  const pct =
    before > 0 ? (((before - after) / before) * 100).toFixed(0) : '0'
  console.log(
    rel,
    `| ${(before / 1024 / 1024).toFixed(2)} MB → ${(after / 1024 / 1024).toFixed(2)} MB`,
    `(${pct}% smaller)`
  )
}

async function main () {
  const files = []
  collectWebp(imagesRoot, files)
  for (const f of files) {
    await optimizeOne(f)
  }
  console.log('Done. Re-run `npm run build` to refresh hashed assets in dist.')
}

main().catch((err) => {
  console.error(err)
  process.exit(1)
})
