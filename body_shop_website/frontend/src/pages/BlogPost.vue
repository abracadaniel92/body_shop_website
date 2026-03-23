<template>
  <div class="bs-page">
    <SiteHeader />

    <main class="bs-container bs-main">
      <div v-if="loading" class="bs-muted">Се вчитува објавата…</div>
      <div v-else-if="error" class="bs-error">{{ error }}</div>
      <article v-else-if="post" class="bs-post">
        <h1 class="bs-page-title">{{ stripHtml(post.title?.rendered || '') }}</h1>
        <p v-if="post.date" class="bs-meta">{{ post.date.slice(0, 10) }}</p>
        <div v-if="post.content?.rendered" class="bs-post-content" v-html="post.content.rendered"></div>
      </article>

      <div v-else class="bs-muted">Објавата не е пронајдена.</div>
    </main>

    <SiteFooter />
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import SiteHeader from '../components/SiteHeader.vue'
import SiteFooter from '../components/SiteFooter.vue'
import { fetchPostBySlug } from '../api/wp'

function stripHtml(html) {
  return html.replace(/<[^>]*>/g, '').trim()
}

const route = useRoute()
const loading = ref(true)
const error = ref('')
const post = ref(null)

onMounted(async () => {
  try {
    loading.value = true
    const slug = route.params.slug
    post.value = await fetchPostBySlug(slug)
  } catch (e) {
    error.value = e?.message || String(e)
  } finally {
    loading.value = false
  }
})
</script>

