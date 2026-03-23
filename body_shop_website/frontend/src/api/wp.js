async function wpFetch(path) {
  const res = await fetch(`/wp-json${path}`)
  if (!res.ok) {
    const text = await res.text().catch(() => '')
    throw new Error(`WP request failed: ${res.status} ${text}`)
  }
  const contentType = res.headers.get('content-type') || ''
  if (!contentType.includes('application/json')) {
    // During first run, WordPress returns the install wizard HTML.
    throw new Error('WordPress се уште не е целосно инсталиран. Заврши го setup-от на http://localhost:8080/wp-admin/install.php и потоа освежи ја страницата.')
  }
  return res.json()
}

export async function fetchGalleryItems() {
  // beforeImageUrl/afterImageUrl are custom REST fields added by the MU-plugin.
  return wpFetch('/wp/v2/gallery_item?per_page=100')
}

export async function fetchPosts() {
  return wpFetch('/wp/v2/posts?per_page=10&_embed')
}

export async function fetchPostBySlug(slug) {
  const results = await wpFetch(`/wp/v2/posts?slug=${encodeURIComponent(slug)}&per_page=1&_embed`)
  return results?.[0] || null
}

