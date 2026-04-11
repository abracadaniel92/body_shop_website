<template>
  <ScrollReveal tag="section" id="merch" ref="sectionRoot" class="merch-section">
    <div class="merch-container">
      <div class="section-heading app-section-heading merch-header">
        <div class="section-number section-number-animated">VOL.04</div>
        <h2 class="section-title section-title-animated">MERCH</h2>
      </div>

      <div class="merch-carousel">
        <div
          ref="carouselTrack"
          class="carousel-track"
          :style="parallaxStyle"
        >
          <a
            v-for="(item, index) in merchItems"
            :key="index"
            :href="item.link"
            class="merch-item"
            target="_blank"
            rel="noopener noreferrer"
          >
            <img
              :src="item.image"
              :alt="item.alt"
              width="600"
              height="600"
              sizes="(max-width: 968px) 250px, 300px"
              loading="lazy"
              decoding="async"
            />
          </a>
        </div>
        <button type="button" class="carousel-btn carousel-btn-prev" aria-label="Previous" @click="scrollCarousel(-1)">‹</button>
        <button type="button" class="carousel-btn carousel-btn-next" aria-label="Next" @click="scrollCarousel(1)">›</button>
      </div>
    </div>
  </ScrollReveal>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import ScrollReveal from './ScrollReveal.vue'

export default {
  name: 'MerchSection',
  components: { ScrollReveal },
  setup () {
    const carouselTrack = ref(null)
    const sectionRoot = ref(null)
    const parallaxOffset = ref(0)

    const merchItems = ref([
      { image: '../../images/1.webp', alt: 'Merch item 1', link: 'https://example.com/merch' },
      { image: '../../images/2.webp', alt: 'Merch item 2', link: 'https://example.com/merch' },
      { image: '../../images/3.webp', alt: 'Merch item 3', link: 'https://example.com/merch' },
      { image: '../../images/1.webp', alt: 'Merch item 4', link: 'https://example.com/merch' },
      { image: '../../images/2.webp', alt: 'Merch item 5', link: 'https://example.com/merch' },
      { image: '../../images/3.webp', alt: 'Merch item 6', link: 'https://example.com/merch' }
    ])

    function updateParallax () {
      const comp = sectionRoot.value
      if (!comp || !comp.$el) return
      const el = comp.$el
      if (typeof el.getBoundingClientRect !== 'function') return
      const r = el.getBoundingClientRect()
      const vh = window.innerHeight || 1
      const center = r.top + r.height / 2
      const t = (center - vh / 2) / (vh * 0.9)
      parallaxOffset.value = Math.max(-1, Math.min(1, t)) * -18
    }

    const parallaxStyle = computed(() => ({
      transform: `translate3d(0, ${parallaxOffset.value}px, 0)`
    }))

    function scrollCarousel (direction) {
      if (carouselTrack.value) {
        const scrollAmount = carouselTrack.value.offsetWidth * 0.8
        carouselTrack.value.scrollBy({
          left: scrollAmount * direction,
          behavior: 'smooth'
        })
      }
    }

    onMounted(() => {
      updateParallax()
      window.addEventListener('scroll', updateParallax, { passive: true })
      window.addEventListener('resize', updateParallax, { passive: true })
    })

    onUnmounted(() => {
      window.removeEventListener('scroll', updateParallax)
      window.removeEventListener('resize', updateParallax)
    })

    return {
      carouselTrack,
      sectionRoot,
      merchItems,
      scrollCarousel,
      parallaxStyle
    }
  }
}
</script>

<style scoped>
.merch-section {
  min-height: 60vh;
  width: 100%;
  max-width: 100vw;
  background: #1a1a1a;
  padding: 6rem 4rem;
  position: relative;
  margin: 0;
  box-sizing: border-box;
}

@media (min-width: 1920px) {
  .merch-section {
    padding: 8rem 2rem;
  }
}

.merch-container {
  max-width: 100%;
  margin: 0 auto;
  width: 100%;
}

@media (min-width: 1600px) {
  .merch-section {
    padding: 8rem 1rem;
  }
}

.section-heading {
  display: flex;
  align-items: baseline;
  gap: 2rem;
  margin-bottom: 4rem;
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

.merch-carousel {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.carousel-track {
  display: flex;
  gap: 2rem;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: none;
  -ms-overflow-style: none;
  padding: 1rem 0;
  will-change: transform;
  transition: transform 0.28s ease-out;
}

.carousel-track::-webkit-scrollbar {
  display: none;
}

.merch-item {
  flex: 0 0 300px;
  aspect-ratio: 1;
  overflow: hidden;
  border: 2px solid #ffffff;
  background: #0a0a0a;
  transition:
    transform 0.4s ease,
    border-color 0.4s ease;
  cursor: pointer;
  text-decoration: none;
  display: block;
}

.merch-item:hover {
  transform: scale(1.05);
  border-color: var(--accent-red, #e63946);
}

.merch-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  filter: grayscale(100%) contrast(1.2);
  transition: filter 0.22s ease;
}

.merch-item:hover img {
  filter: grayscale(0%) contrast(1.1);
}

.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: #0a0a0a;
  border: 2px solid #ffffff;
  color: #ffffff;
  width: 50px;
  height: 50px;
  font-size: 2rem;
  font-weight: 900;
  cursor: pointer;
  z-index: 10;
  display: flex;
  align-items: center;
  justify-content: center;
  transition:
    background 0.45s ease,
    color 0.45s ease,
    border-color 0.45s ease;
  font-family: 'Inter', sans-serif;
}

.carousel-btn:hover {
  background: var(--accent-red, #e63946);
  color: #ffffff;
  border-color: var(--accent-red, #e63946);
}

.carousel-btn-prev {
  left: 0;
}

.carousel-btn-next {
  right: 0;
}

@media (min-width: 1920px) {
  .merch-item {
    flex: 0 0 400px;
  }

  .carousel-track {
    gap: 3rem;
  }

  .section-title {
    font-size: clamp(3rem, 6vw, 6rem);
  }
}

@media (max-width: 968px) {
  .merch-section {
    padding: 4rem 2rem;
  }

  .section-heading {
    flex-direction: column;
    gap: 1rem;
  }

  .merch-item {
    flex: 0 0 250px;
  }

  .carousel-btn {
    width: 40px;
    height: 40px;
    font-size: 1.5rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  .carousel-track {
    transform: none !important;
    transition: none !important;
  }
}
</style>
