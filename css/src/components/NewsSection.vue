<template>
  <ScrollReveal tag="section" id="news" class="news-section">
    <div class="news-container">
      <div class="section-heading app-section-heading">
        <div class="section-number section-number-animated">VOL.01</div>
        <h2 class="section-title section-title-animated">LATEST NEWS</h2>
      </div>
      <div class="news-grid">
        <template v-if="loading">
          <div v-for="n in 3" :key="n" class="news-skeleton">
            <div class="skeleton-block news-skeleton-img" />
            <div class="skeleton-block news-skeleton-line news-skeleton-line--sm" />
            <div class="skeleton-block news-skeleton-line news-skeleton-line--md" />
            <div class="skeleton-block news-skeleton-line news-skeleton-line--lg" />
          </div>
        </template>
        <template v-else-if="errorMessage">
          <div class="news-error">{{ errorMessage }}</div>
        </template>
        <template v-else>
          <article
            v-for="(item, index) in news.slice(0, 3)"
            :key="`${item.title}-${index}`"
            class="news-item"
            :style="{ animationDelay: `${index * 55}ms` }"
          >
            <img
              v-if="item.image"
              :src="item.image"
              :alt="item.title"
              class="news-image"
              sizes="(max-width: 968px) 100vw, min(75vw, 900px)"
              loading="lazy"
              decoding="async"
            />
            <div class="news-date">{{ item.dateLabel }}</div>
            <h3 class="news-title">{{ item.title }}</h3>
            <p class="news-content">{{ item.content }}</p>
          </article>
        </template>
      </div>
    </div>
  </ScrollReveal>
</template>

<script>
import { ref, onMounted } from 'vue'
import { fetchNewsData } from '../utils/news'
import ScrollReveal from './ScrollReveal.vue'

export default {
  name: 'NewsSection',
  components: { ScrollReveal },
  setup () {
    const loading = ref(true)
    const news = ref([])
    const errorMessage = ref('')

    onMounted(async () => {
      const { news: data, error } = await fetchNewsData()
      loading.value = false
      if (error === 'configure') {
        errorMessage.value = 'Please configure your Google Sheets CSV URL in CONFIG.'
        return
      }
      if (error === 'fetch') {
        errorMessage.value = 'Error loading news. Please check your Google Sheets configuration.'
        return
      }
      if (error === 'empty') {
        errorMessage.value = 'No news items found.'
        return
      }
      news.value = data
    })

    return {
      loading,
      news,
      errorMessage
    }
  }
}
</script>

<style scoped>
.news-section {
  min-height: auto;
  width: 100%;
  max-width: 100vw;
  background: #0a0a0a;
  padding: 4rem 4rem 5rem;
  position: relative;
  margin: 0;
  box-sizing: border-box;
}

@media (min-width: 1920px) {
  .news-section {
    padding: 8rem 8rem;
  }
}

.news-container {
  max-width: 100%;
  margin: 0 auto;
  width: 100%;
}

@media (min-width: 1600px) {
  .news-section {
    padding: 8rem 1rem;
  }
}

.section-heading {
  display: flex;
  align-items: baseline;
  gap: 2rem;
  margin-bottom: 2rem;
  border-bottom: 2px solid #ffffff;
  padding-bottom: 1rem;
}

.section-number {
  font-size: clamp(0.9rem, 1.5vw, 1.2rem);
  font-weight: 700;
  letter-spacing: 4px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  opacity: 0.7;
  transition: color 0.25s ease;
}

.app-section-heading:hover .section-number {
  color: var(--accent-red, #e63946);
}

.section-title {
  font-size: clamp(2.5rem, 6vw, 5rem);
  font-weight: 900;
  letter-spacing: -2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  line-height: 1;
  margin: 0;
}

.news-grid {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-top: 1rem;
  align-items: center;
  overflow: visible;
}

.news-skeleton {
  width: 75%;
  padding: 1.2rem;
  border: 1px solid #333333;
  background: #1a1a1a;
  box-sizing: border-box;
}

.news-skeleton-img {
  height: 100px;
  width: 100%;
  margin-bottom: 0.75rem;
}

.news-skeleton-line {
  margin-bottom: 0.65rem;
}

.news-skeleton-line--sm {
  height: 10px;
  width: 22%;
}

.news-skeleton-line--md {
  height: 18px;
  width: 55%;
}

.news-skeleton-line--lg {
  height: 12px;
  width: 88%;
  margin-bottom: 0;
}

.news-item {
  background: #1a1a1a;
  padding: 1rem 1.1rem;
  border: 1px solid #333333;
  transition:
    border-color 0.5s ease,
    transform 0.5s ease;
  width: 75%;
  max-width: none;
  flex-shrink: 0;
  margin: 0 auto;
  box-sizing: border-box;
  animation: newsStagger 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
}

@keyframes newsStagger {
  from {
    opacity: 0;
    transform: translateY(12px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.news-item:hover {
  border-color: #ffffff;
  transform: translateY(-3px);
}

.news-date {
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.6;
  margin-bottom: 1rem;
}

.news-title {
  font-size: 1.2rem;
  font-weight: 700;
  letter-spacing: -0.5px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  margin-bottom: 1rem;
  line-height: 1.3;
}

.news-content {
  font-size: 0.88rem;
  font-weight: 400;
  line-height: 1.55;
  color: #cccccc;
  font-family: 'Inter', sans-serif;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 4;
  line-clamp: 4;
  overflow: hidden;
}

.news-image {
  width: 100%;
  height: 140px;
  object-fit: cover;
  margin-bottom: 0.85rem;
  opacity: 0.95;
  border: 1px solid rgba(255, 255, 255, 0.12);
}

.news-error {
  color: #ffffff;
  font-size: 0.9rem;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.85;
  padding: 2rem;
  background: #1a1a1a;
  border: 1px solid #333333;
  width: 100%;
  text-align: center;
}

@media (min-width: 1920px) {
  .news-section {
    padding: 8rem 1rem;
  }

  .news-grid {
    gap: 2rem;
  }

  .section-title {
    font-size: clamp(3rem, 6vw, 6rem);
  }
}

@media (max-width: 968px) {
  .news-section {
    padding: 4rem 2rem;
  }

  .section-heading {
    flex-direction: column;
    gap: 1rem;
  }

  .news-grid {
    gap: 1.5rem;
  }

  .news-item {
    width: 100%;
  }

  .news-skeleton {
    width: 100%;
  }
}
</style>
