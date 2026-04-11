<template>
  <ScrollReveal tag="section" id="about" class="about-section">
    <div class="about-container">
      <div class="section-heading app-section-heading about-header">
        <div class="section-number section-number-animated">VOL.05</div>
        <h2 class="section-title section-title-animated">HISTORY</h2>
      </div>

      <div class="about-layout">
        <div class="about-text-wrapper">
          <div class="about-text">
            <p class="about-paragraph">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
            <p class="about-paragraph">
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
            </p>
            <p class="about-paragraph">
              Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.
            </p>
          </div>
        </div>

        <div class="about-gallery-wrapper">
          <div class="about-gallery">
            <div
              v-for="(src, index) in historyImages"
              :key="src"
              class="history-card"
              :class="`history-card--pile-${index % 8}`"
              :style="{ zIndex: 30 + index, '--i': index }"
              role="button"
              tabindex="0"
              :aria-label="'Open history image ' + (index + 1) + ' in gallery'"
              @click="openGallery(index)"
              @keydown.enter.prevent="openGallery(index)"
              @keydown.space.prevent="openGallery(index)"
            >
              <img :src="src" :alt="'History ' + (index + 1)" loading="lazy" decoding="async" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <Teleport to="body">
      <Transition name="history-lightbox">
        <div
          v-if="galleryOpen"
          class="history-lightbox"
          role="dialog"
          aria-modal="true"
          aria-label="History gallery"
          @click="closeGallery"
        >
          <div class="history-lightbox__content" @click.stop>
            <button
              type="button"
              class="history-lightbox__close"
              aria-label="Close gallery"
              @click="closeGallery"
            >
              ×
            </button>
            <button
              type="button"
              class="history-lightbox__nav history-lightbox__nav--prev"
              aria-label="Previous image"
              @click="prevImage"
            >
              ‹
            </button>
            <img
              class="history-lightbox__img"
              :src="historyImages[galleryIndex]"
              :alt="'History ' + (galleryIndex + 1)"
            />
            <button
              type="button"
              class="history-lightbox__nav history-lightbox__nav--next"
              aria-label="Next image"
              @click="nextImage"
            >
              ›
            </button>
            <div class="history-lightbox__counter" aria-live="polite">
              {{ galleryIndex + 1 }} / {{ historyImages.length }}
            </div>
          </div>
        </div>
      </Transition>
    </Teleport>
  </ScrollReveal>
</template>

<script>
import ScrollReveal from './ScrollReveal.vue'

const historyGlob = import.meta.glob('../../images/History/*.webp', {
  eager: true,
  query: '?url',
  import: 'default'
})

function resolveHistoryUrls () {
  return Object.keys(historyGlob)
    .sort((a, b) =>
      a.localeCompare(b, undefined, { numeric: true, sensitivity: 'base' })
    )
    .map((key) => {
      const mod = historyGlob[key]
      return typeof mod === 'string' ? mod : mod?.default ?? mod
    })
}

export default {
  name: 'AboutSection',
  components: { ScrollReveal },
  data () {
    return {
      historyImages: resolveHistoryUrls(),
      galleryOpen: false,
      galleryIndex: 0
    }
  },
  mounted () {
    window.addEventListener('keydown', this.onGalleryKeydown)
  },
  beforeUnmount () {
    window.removeEventListener('keydown', this.onGalleryKeydown)
    document.body.style.overflow = ''
  },
  methods: {
    openGallery (index) {
      this.galleryIndex = index
      this.galleryOpen = true
      document.body.style.overflow = 'hidden'
    },
    closeGallery () {
      this.galleryOpen = false
      document.body.style.overflow = ''
    },
    nextImage () {
      const n = this.historyImages.length
      if (!n) return
      this.galleryIndex = (this.galleryIndex + 1) % n
    },
    prevImage () {
      const n = this.historyImages.length
      if (!n) return
      this.galleryIndex = (this.galleryIndex - 1 + n) % n
    },
    onGalleryKeydown (e) {
      if (!this.galleryOpen) return
      if (e.key === 'Escape') {
        this.closeGallery()
      } else if (e.key === 'ArrowRight') {
        this.nextImage()
      } else if (e.key === 'ArrowLeft') {
        this.prevImage()
      }
    }
  }
}
</script>

<style scoped>
.about-section {
  min-height: 60vh;
  width: 100%;
  max-width: 100vw;
  /* Gray stripe (alternates with Music black; replaces hidden Merch band) */
  background: #1a1a1a;
  padding: 3rem 4rem 6rem;
  position: relative;
  margin: 0;
  box-sizing: border-box;
}

.about-container {
  max-width: 100%;
  margin: 0 auto;
  width: 100%;
}

@media (min-width: 1600px) {
  .about-section {
    padding: 3.25rem 1rem 8rem;
  }
}

@media (min-width: 1920px) {
  .about-section {
    padding: 3.5rem 1rem 8rem;
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

.about-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  margin-top: 3.45rem;
  align-items: start;
  width: 100%;
}

.about-text-wrapper {
  grid-column: 1;
  width: 100%;
}

.about-text {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  padding-left: 10%;
}

.about-paragraph {
  font-size: clamp(0.935rem, 1.1vw, 1.045rem);
  font-weight: 400;
  line-height: 1.8;
  color: #cccccc;
  font-family: 'Inter', sans-serif;
  margin: 0;
  text-align: justify;
}

.about-gallery-wrapper {
  grid-column: 2;
  width: 100%;
  position: relative;
  min-height: 528px;
  padding-right: 8%;
  padding-left: 1rem;
  display: flex;
  justify-content: center;
  align-items: flex-start;
}

/* Thrown pile — overlapping polaroids; positions repeat every 8 with higher z for later cards */
.about-gallery {
  position: relative;
  width: 100%;
  max-width: 400px;
  min-height: 528px;
  margin: 0 auto;
}

.history-card {
  position: absolute;
  overflow: hidden;
  border: 2px solid #ffffff;
  /* Darker than section so polaroids read on gray stripe */
  background: #0a0a0a;
  width: 58%;
  aspect-ratio: 3 / 4;
  box-shadow: 0 10px 28px rgba(0, 0, 0, 0.55);
  transition:
    filter 0.45s ease,
    border-color 0.45s ease,
    box-shadow 0.45s ease;
  cursor: pointer;
  filter: grayscale(100%) contrast(1.15);
  opacity: 0;
  transform-origin: center center;
}

.history-card--pile-0 {
  left: 0;
  top: 0;
  transform: rotate(-11deg);
}

.history-card--pile-1 {
  left: 34%;
  top: 6%;
  width: 54%;
  transform: rotate(10deg);
}

.history-card--pile-2 {
  left: 4%;
  top: 24%;
  width: 56%;
  transform: rotate(-7deg);
}

.history-card--pile-3 {
  left: 40%;
  top: 30%;
  width: 52%;
  transform: rotate(8deg);
}

.history-card--pile-4 {
  left: -2%;
  top: 42%;
  width: 57%;
  transform: rotate(5deg);
}

.history-card--pile-5 {
  left: 36%;
  top: 48%;
  width: 54%;
  transform: rotate(-9deg);
}

.history-card--pile-6 {
  left: 14%;
  top: 56%;
  width: 53%;
  transform: rotate(12deg);
}

.history-card--pile-7 {
  left: 44%;
  top: 2%;
  width: 50%;
  transform: rotate(-5deg);
}

.scroll-reveal--visible .history-card {
  animation: historyPileIn 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
  animation-delay: calc(0.06s * var(--i, 0));
}

@keyframes historyPileIn {
  from {
    opacity: 0;
    filter: grayscale(1) contrast(1.15);
  }
  to {
    opacity: 1;
    filter: grayscale(1) contrast(1.15);
  }
}

.history-card:hover {
  filter: grayscale(100%) contrast(1.08);
  border-color: var(--accent-red, #e63946);
  box-shadow:
    0 16px 36px rgba(0, 0, 0, 0.55),
    0 0 0 1px rgba(230, 57, 70, 0.35);
  z-index: 80 !important;
}

.history-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  transition: filter 0.5s ease;
}

@media (min-width: 1920px) {
  .about-section {
    padding: 3.5rem 1rem 8rem;
    max-width: 100vw;
    margin: 0;
    box-sizing: border-box;
  }

  .about-container {
    max-width: 100%;
    width: 100%;
  }

  .about-layout {
    gap: 4rem;
  }

  .about-text {
    gap: 2rem;
  }

  .about-paragraph {
    font-size: clamp(0.935rem, 1.1vw, 1.045rem);
    line-height: 1.8;
  }

  .about-gallery-wrapper {
    min-height: 580px;
  }

  .about-gallery {
    min-height: 580px;
    max-width: 440px;
  }
}

@media (max-width: 968px) {
  .about-section {
    padding: 4rem 2rem;
  }

  .section-heading {
    flex-direction: column;
    gap: 1rem;
  }

  .about-layout {
    grid-template-columns: 1fr;
    gap: 3rem;
  }

  .about-text-wrapper {
    grid-column: 1;
    padding-left: 0;
  }

  .about-gallery-wrapper {
    grid-column: 1;
    padding-right: 0;
    padding-left: 0;
    min-height: auto;
  }

  .about-gallery {
    max-width: 100%;
    min-height: 440px;
  }

  .history-card {
    width: 62%;
  }

  .about-paragraph {
    text-align: left;
  }
}

@media (prefers-reduced-motion: reduce) {
  .history-card {
    opacity: 1 !important;
    animation: none !important;
  }
}

.history-lightbox {
  position: fixed;
  inset: 0;
  z-index: 10050;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
  background: rgba(0, 0, 0, 0.92);
  box-sizing: border-box;
  cursor: zoom-out;
}

.history-lightbox__content {
  position: relative;
  max-width: min(92vw, 1200px);
  max-height: 88vh;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: default;
}

.history-lightbox__img {
  max-width: 100%;
  max-height: 88vh;
  width: auto;
  height: auto;
  object-fit: contain;
  border: 2px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.65);
  filter: none;
}

.history-lightbox__close {
  position: absolute;
  top: -2.75rem;
  right: 0;
  width: 2.5rem;
  height: 2.5rem;
  border: 1px solid rgba(255, 255, 255, 0.35);
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff;
  font-size: 1.75rem;
  line-height: 1;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition:
    background 0.2s ease,
    border-color 0.2s ease;
}

.history-lightbox__close:hover {
  background: rgba(255, 255, 255, 0.16);
  border-color: var(--accent-red, #e63946);
}

.history-lightbox__nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 2.75rem;
  height: 2.75rem;
  border: 1px solid rgba(255, 255, 255, 0.35);
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff;
  font-size: 2rem;
  line-height: 1;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition:
    background 0.2s ease,
    border-color 0.2s ease;
}

.history-lightbox__nav:hover {
  background: rgba(255, 255, 255, 0.16);
  border-color: rgba(255, 255, 255, 0.55);
}

.history-lightbox__nav--prev {
  left: -3.25rem;
}

.history-lightbox__nav--next {
  right: -3.25rem;
}

.history-lightbox__counter {
  position: absolute;
  bottom: -2.25rem;
  left: 50%;
  transform: translateX(-50%);
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.2em;
  color: rgba(255, 255, 255, 0.65);
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  white-space: nowrap;
}

.history-lightbox-enter-active,
.history-lightbox-leave-active {
  transition: opacity 0.28s ease;
}

.history-lightbox-enter-from,
.history-lightbox-leave-to {
  opacity: 0;
}

@media (max-width: 900px) {
  .history-lightbox__nav--prev {
    left: 0.25rem;
  }

  .history-lightbox__nav--next {
    right: 0.25rem;
  }

  .history-lightbox__close {
    top: -2.25rem;
  }

  .history-lightbox__counter {
    bottom: -1.85rem;
  }
}
</style>
