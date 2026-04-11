<template>
  <ScrollReveal tag="section" id="tours" class="tours-section">
    <div class="tours-container">
      <div class="section-heading app-section-heading">
        <div class="section-number section-number-animated">VOL.02</div>
        <h2 class="section-title section-title-animated">UPCOMING TOURS</h2>
      </div>

      <div class="tours-layout">
        <div class="tours-description">
          <p class="tours-description-text">
            Join us on the road as we bring our sound to cities across the region.
            Each show is a unique experience, blending raw energy with authentic hip-hop culture.
          </p>
          <div class="tours-meta">
            <div class="tours-meta-item">
              <span class="tours-meta-label">STATUS</span>
              <span class="tours-meta-value tours-meta-value--accent">ON TOUR</span>
            </div>
            <div class="tours-meta-item">
              <span class="tours-meta-label">BOOKING</span>
              <span class="tours-meta-value">OPEN</span>
            </div>
          </div>
        </div>

        <div class="tours-content-wrapper">
          <div class="tours-content">
            <template v-if="loading">
              <div v-for="n in 4" :key="n" class="tour-skeleton">
                <div class="skeleton-block tour-skeleton-line tour-skeleton-line--sm" />
                <div class="skeleton-block tour-skeleton-line tour-skeleton-line--lg" />
                <div class="skeleton-block tour-skeleton-line tour-skeleton-line--md" />
              </div>
            </template>
            <template v-else-if="errorMessage">
              <div class="tours-error">{{ errorMessage }}</div>
            </template>
            <template v-else>
              <div
                v-for="(tour, index) in tours"
                :key="`${tour.date}-${tour.venue}-${index}`"
                class="tour-item"
                :class="{ 'tour-item-past': tour.isPast }"
                :style="{ animationDelay: `${index * 50}ms` }"
              >
                <div class="tour-date">{{ tour.dateLabel }}</div>
                <div class="tour-venue-row">
                  <div class="tour-venue">{{ tour.venue }}</div>
                  <div v-if="tour.description" class="tour-description">
                    {{ tour.description }}
                  </div>
                </div>
                <div class="tour-location">{{ tour.location }}</div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </ScrollReveal>
</template>

<script>
import { ref, onMounted } from 'vue'
import { fetchToursData } from '../utils/tours'
import ScrollReveal from './ScrollReveal.vue'

export default {
  name: 'ToursSection',
  components: { ScrollReveal },
  setup () {
    const loading = ref(true)
    const tours = ref([])
    const errorMessage = ref('')

    onMounted(async () => {
      const { tours: data, error } = await fetchToursData()
      loading.value = false
      if (error === 'configure') {
        errorMessage.value = 'Please configure your Tours Google Sheets CSV URL in CONFIG.'
        return
      }
      if (error === 'fetch') {
        errorMessage.value = 'Error loading tour dates. Please check your Google Sheets URL.'
        return
      }
      if (error === 'empty') {
        errorMessage.value = 'No tours found. Check your Google Sheets format.'
        return
      }
      if (error === 'none') {
        errorMessage.value = 'No tours scheduled.'
        return
      }
      tours.value = data
    })

    return {
      loading,
      tours,
      errorMessage
    }
  }
}
</script>

<style scoped>
.tours-section {
  min-height: auto;
  width: 100%;
  max-width: 100vw;
  background: #1a1a1a;
  padding: 4rem 4rem 5rem;
  position: relative;
  margin: 0;
  box-sizing: border-box;
}

@media (min-width: 1920px) {
  .tours-section {
    padding: 8rem 8rem;
  }
}

.tours-container {
  max-width: 100%;
  margin: 0 auto;
  width: 100%;
  display: flex;
  flex-direction: column;
}

@media (min-width: 1600px) {
  .tours-section {
    padding: 8rem 1rem;
  }
}

@media (min-width: 1920px) {
  .tours-section {
    padding: 8rem 1rem;
  }
}

.section-heading {
  display: flex;
  align-items: baseline;
  gap: 2rem;
  margin-bottom: 0;
  border-bottom: 2px solid #ffffff;
  padding-bottom: 1rem;
  width: 100%;
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

.tours-layout {
  display: grid;
  grid-template-columns: minmax(0, 0.85fr) minmax(0, 1fr);
  gap: 2.5rem clamp(2.75rem, 6vw, 6rem);
  margin: 1.25rem auto 0;
  align-items: start;
  width: 80%;
  max-width: 100%;
  box-sizing: border-box;
}

.tours-content-wrapper {
  margin-top: 0;
  margin-bottom: 2rem;
  width: 100%;
  min-width: 0;
}

.tours-description {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  min-width: 0;
  width: 100%;
}

.tours-description-text {
  font-size: clamp(0.9rem, 1.2vw, 1.1rem);
  font-weight: 400;
  line-height: 1.8;
  color: #cccccc;
  font-family: 'Inter', sans-serif;
  margin: 0;
  text-align: justify;
}

.tours-meta {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-top: 0.5rem;
}

.tours-meta-item {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.tours-meta-label {
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 3px;
  color: #666666;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
}

.tours-meta-value {
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
}

.tours-meta-value--accent {
  color: var(--accent-red, #e63946);
}

.tours-content {
  display: flex;
  flex-direction: column;
  gap: 0;
  max-height: min(42vh, 320px);
  overflow-y: auto;
  overflow-x: hidden;
  padding-right: 0.75rem;
  width: 100%;
  scrollbar-width: thin;
  scrollbar-color: #666666 transparent;
  -webkit-overflow-scrolling: touch;
  overscroll-behavior: contain;
}

.tours-content::-webkit-scrollbar {
  width: 4px;
}

.tours-content::-webkit-scrollbar-track {
  background: transparent;
}

.tours-content::-webkit-scrollbar-thumb {
  background: #666666;
  border-radius: 0;
}

.tours-content::-webkit-scrollbar-thumb:hover {
  background: #888888;
}

.tour-skeleton {
  padding: 1.5rem;
  border-bottom: 1px solid #333333;
}

.tour-skeleton-line {
  margin-bottom: 0.75rem;
}

.tour-skeleton-line--sm {
  height: 12px;
  width: 28%;
}

.tour-skeleton-line--lg {
  height: 22px;
  width: 72%;
}

.tour-skeleton-line--md {
  height: 14px;
  width: 45%;
  margin-bottom: 0;
}

.tour-item {
  background: #1a1a1a;
  padding: 0.85rem 1rem 0.85rem 1rem;
  border-bottom: 1px solid #333333;
  transition:
    background 0.5s ease,
    border-color 0.5s ease,
    padding-left 0.5s ease,
    box-shadow 0.5s ease;
  width: 100%;
  flex-shrink: 0;
  box-sizing: border-box;
  position: relative;
  border-left: 3px solid transparent;
  animation: tourStagger 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
}

@keyframes tourStagger {
  from {
    opacity: 0;
    transform: translateX(16px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.tour-item:last-child {
  border-bottom: none;
}

.tour-item:hover {
  background: #252525;
  border-bottom-color: #ffffff;
  padding-left: 2rem;
  border-left-color: var(--accent-red, #e63946);
}

.tour-item-past {
  opacity: 0.5;
}

.tour-item-past .tour-date,
.tour-item-past .tour-venue,
.tour-item-past .tour-description,
.tour-item-past .tour-location {
  text-decoration: line-through;
  text-decoration-color: #ffffff;
  text-decoration-thickness: 2px;
}

.tour-date {
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.6;
  margin-bottom: 0.45rem;
}

.tour-venue-row {
  display: flex;
  align-items: baseline;
  gap: 1rem;
  margin-bottom: 0.45rem;
  flex-wrap: wrap;
}

.tour-venue {
  font-size: 1.05rem;
  font-weight: 700;
  letter-spacing: -0.5px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  line-height: 1.3;
  flex-shrink: 0;
}

.tour-description {
  font-size: 0.8rem;
  font-weight: 400;
  letter-spacing: 0.5px;
  color: #cccccc;
  font-family: 'Inter', sans-serif;
  line-height: 1.5;
  flex: 1;
  min-width: 200px;
}

.tour-location {
  font-size: 0.82rem;
  font-weight: 400;
  line-height: 1.45;
  color: #cccccc;
  font-family: 'Inter', sans-serif;
}

.tours-error {
  color: #ffffff;
  font-size: 0.9rem;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.85;
  padding: 2rem;
  background: #0a0a0a;
  border-left: 3px solid var(--accent-red, #e63946);
}

@media (max-width: 968px) {
  .tours-section {
    padding: 4rem 2rem;
  }

  .section-heading {
    flex-direction: column;
    gap: 1rem;
  }

  .tours-layout {
    grid-template-columns: 1fr;
    gap: 2rem;
    width: 100%;
    margin-top: 1.25rem;
  }

  .tours-description {
    max-width: 100%;
  }

  .tours-content-wrapper {
    margin-bottom: 0;
  }

  .tours-description-text {
    text-align: left;
  }

  .tours-meta {
    align-items: center;
    text-align: center;
  }

  .tours-meta-item {
    align-items: center;
  }
}
</style>
