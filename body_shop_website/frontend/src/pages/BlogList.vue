<template>
  <div class="bs-page">
    <SiteHeader />

    <main class="bs-container bs-main">
      <h1 class="bs-page-title">Блог</h1>
      <p class="bs-muted">Најнови вести од работилницата.</p>

      <div v-if="loading" class="bs-muted">Се вчитуваат објавите…</div>
      <div v-else-if="error" class="bs-error">
        {{ error }}
      </div>
      <div v-else class="bs-blog-list">
        <article v-for="post in posts" :key="post.id" class="bs-card bs-blog-card">
          <h2 class="bs-card-title">
            <router-link class="bs-link" :to="`/blog/${post.slug}`">
              {{ stripHtml(post.title?.rendered || 'Објава') }}
            </router-link>
          </h2>
          <p class="bs-meta">{{ post.date ? post.date.slice(0, 10) : '' }}</p>
          <div class="bs-blog-excerpt" v-html="post.excerpt?.rendered || ''"></div>
        </article>
      </div>
    </main>

    <SiteFooter />
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import SiteHeader from '../components/SiteHeader.vue'
import SiteFooter from '../components/SiteFooter.vue'
import { fetchPosts } from '../api/wp'

function stripHtml(html) {
  return html.replace(/<[^>]*>/g, '').trim()
}

const loading = ref(true)
const error = ref('')
const posts = ref([])

onMounted(async () => {
  try {
    const data = await fetchPosts()
    posts.value = data || []
  } catch (e) {
    error.value = e?.message || String(e)
  } finally {
    loading.value = false
  }
})
</script>

