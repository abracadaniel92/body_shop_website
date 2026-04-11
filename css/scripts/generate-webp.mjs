/**
 * Converts .jpg / .jpeg / .png under images/ to WebP (skips images/logo/).
 * Resizes wide images down before encode to keep files small for web.
 * After a successful write, the original raster file is deleted.
 *
 * Run: npm run optimize-images
 */
import fs from 'fs'
import path from 'path'
import sharp from 'sharp'
import { fileURLToPath } from 'url'

const __dirname = path.dirname(fileURLToPath(import.meta.url))
const imagesRoot = path.join(__dirname, '..', 'images')

function shouldSkipFile (fullPath) {
  const rel = path.relative(imagesRoot, fullPath).replace(/\\/g, '/')
  if (rel.startsWith('logo/')) return true
  if (rel.toLowerCase() === 'logo.jpg' || rel.toLowerCase() === 'logo.png') return true
  return false
}

function maxWidthForRel (rel) {
  const lower = rel.replace(/\\/g, '/')
  if (lower.startsWith('hero/') || lower.includes('/hero/')) return 1920
  if (lower.startsWith('History/') || lower.includes('/History/')) return 1920
  if (/^(1|2|3)\.(jpe?g|png)$/i.test(path.basename(lower))) return 1200
  return 1600
}

function collectFiles (dir, out) {
  const base = path.basename(dir)
  if (base === 'logo') return
  for (const name of fs.readdirSync(dir)) {
    const full = path.join(dir, name)
    const st = fs.statSync(full)
    if (st.isDirectory()) collectFiles(full, out)
    else if (!shouldSkipFile(full)) out.push(full)
  }
}

async function toWebp (filePath) {
  const ext = path.extname(filePath).toLowerCase()
  if (!['.jpg', '.jpeg', '.png'].includes(ext)) return
  if (shouldSkipFile(filePath)) return

  const rel = path.relative(imagesRoot, filePath).replace(/\\/g, '/')
  const outPath = filePath.replace(/\.(jpg|jpeg|png)$/i, '.webp')
  const maxW = maxWidthForRel(rel)

  const meta = await sharp(filePath).metadata()
  let pipeline = sharp(filePath).rotate()

  if (meta.width && meta.width > maxW) {
    pipeline = pipeline.resize(maxW, null, {
      fit: 'inside',
      withoutEnlargement: true
    })
  }

  await pipeline
    .webp({ quality: 78, effort: 5 })
    .toFile(outPath)

  fs.unlinkSync(filePath)
  console.log(
    'webp:',
    path.relative(imagesRoot, outPath),
    '| maxW:',
    maxW,
    '| removed:',
    path.relative(imagesRoot, filePath)
  )
}

async function main () {
  const files = []
  collectFiles(imagesRoot, files)
  for (const f of files) {
    await toWebp(f)
  }
}

main().catch((err) => {
  console.error(err)
  process.exit(1)
})
