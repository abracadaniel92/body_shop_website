<template>
  <div class="bs-page">
    <SiteHeader />

    <main class="bs-container bs-main">
      <h1 class="bs-page-title">Галерија пред/после</h1>
      <p class="bs-muted">Погледни завршени поправки и трансформации.</p>

      <div v-if="loading" class="bs-muted">Се вчитува галеријата…</div>
      <div v-else-if="error" class="bs-error">
        {{ error }}
      </div>
      <div v-else class="bs-gallery-grid">
        <article v-for="item in items" :key="item.id" class="bs-card">
          <h2 class="bs-card-title">
            {{ item.title?.rendered ? stripHtml(item.title.rendered) : 'Случај' }}
          </h2>

          <div class="bs-before-after">
            <div class="bs-before-after-col">
              <p class="bs-muted bs-label">Пред</p>
              <img v-if="item.beforeImageUrl" :src="item.beforeImageUrl" alt="Пред фотографија" />
              <p v-else class="bs-muted">Не е поставена фотографија</p>
            </div>

            <div class="bs-before-after-col">
              <p class="bs-muted bs-label">После</p>
              <img v-if="item.afterImageUrl" :src="item.afterImageUrl" alt="После фотографија" />
              <p v-else class="bs-muted">Не е поставена фотографија</p>
            </div>
          </div>

          <p v-if="item.meta?._service_type" class="bs-meta">
            Услуга: {{ item.meta._service_type }}
          </p>
          <p v-if="item.meta?._vehicle_info" class="bs-meta">
            Возило: {{ item.meta._vehicle_info }}
          </p>
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
import { fetchGalleryItems } from '../api/wp'

function stripHtml(html) {
  return html.replace(/<[^>]*>/g, '').trim()
}

const loading = ref(true)
const error = ref('')
const items = ref([])

onMounted(async () => {
  try {
    loading.value = true
    const data = await fetchGalleryItems()
    items.value = data || []
  } catch (e) {
    error.value = e?.message || String(e)
  } finally {
    loading.value = false
  }
})
</script>

