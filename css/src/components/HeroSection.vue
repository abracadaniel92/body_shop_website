<template>
  <section class="hero" id="home" :class="{ 'hero--ready': heroReady }">
    <div class="hero-container">
      <div class="hero-left">
        <div class="hero-left-image-wrapper image-reveal-wrap">
          <img
            src="../../images/hero/4.webp"
            alt="Centar Srbija Stil — hero"
            class="hero-left-main-image"
            width="1920"
            height="1080"
            sizes="(max-width: 968px) 100vw, 50vw"
            decoding="async"
            fetchpriority="high"
            loading="eager"
          />
          <div class="hero-image-overlay" />
        </div>
        <div class="hero-text-overlay">
          <div class="hero-main-title">
            <span class="hero-title-line-1">CENTAR</span>
            <span class="hero-title-line-2">SRBIJA STIL</span>
          </div>
        </div>
        <button
          type="button"
          class="hero-scroll-cue"
          aria-label="Scroll to latest news"
          @click="scrollToNews"
        >
          <span class="hero-scroll-label">SCROLL</span>
          <span class="hero-scroll-line" />
        </button>
      </div>

      <div class="hero-right">
        <div class="hero-right-stack">
          <div class="hero-image-wrapper image-reveal-wrap image-reveal-wrap--delay">
            <img
              src="../../images/hero/2.webp"
              alt=""
              class="hero-landscape-image"
              width="1600"
              height="900"
              sizes="(max-width: 968px) 100vw, 50vw"
              decoding="async"
              loading="eager"
              fetchpriority="low"
            />
          </div>
          <div class="hero-image-wrapper image-reveal-wrap image-reveal-wrap--delay2">
            <img
              src="../../images/hero/3.webp"
              alt=""
              class="hero-landscape-image"
              width="1600"
              height="900"
              sizes="(max-width: 968px) 100vw, 50vw"
              decoding="async"
              loading="eager"
              fetchpriority="low"
            />
          </div>
        </div>
        <div class="hero-right-overlay" />
        <div class="hero-right-text hero-fade-in">
          <div class="hero-date">10.01.06</div>
          <div class="hero-location">44°49'12"N 20°27'44"E</div>
        </div>
        <p class="hero-vertical-text-right hero-fade-opacity hero-fade-opacity--late hero-goldie" aria-label="Goldie">
          <span class="hero-goldie-text">GOLDIE</span>
        </p>
        <div class="hero-bottom-meta hero-fade-in hero-fade-in--later">
          <div class="hero-meta-line">ACCESS CODE: 8813-A</div>
          <div class="hero-meta-line">ID: 13.07.44</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { ref, onMounted } from 'vue'

export default {
  name: 'HeroSection',
  setup () {
    const heroReady = ref(false)

    function scrollToNews () {
      const el = document.querySelector('#news')
      if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'start' })
      }
    }

    onMounted(() => {
      requestAnimationFrame(() => {
        heroReady.value = true
      })
    })

    return {
      heroReady,
      scrollToNews
    }
  }
}
</script>

<style scoped>
.hero {
  min-height: 100vh;
  width: 100%;
  max-width: 100vw;
  position: relative;
  padding: 0;
  padding-top: 0;
  background: #0a0a0a;
  overflow: hidden;
  margin: 0;
  box-sizing: border-box;
}

.hero-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 100vh;
  width: 100%;
  position: relative;
}

.hero-left {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: #1a1a1a;
}

.hero-left-image-wrapper {
  position: absolute;
  inset: 0;
  overflow: hidden;
  background: #1a1a1a;
}

/* Background photos: long, soft fades — run before type takes focus */
.image-reveal-wrap {
  opacity: 0;
  transition: opacity 1.16s cubic-bezier(0.22, 0.94, 0.38, 1);
}

.hero--ready .image-reveal-wrap {
  opacity: 1;
}

.hero--ready .image-reveal-wrap--delay {
  transition-delay: 0.22s;
}

.hero--ready .image-reveal-wrap--delay2 {
  transition-delay: 0.42s;
}

.hero-left-main-image {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 100%;
  height: 100%;
  transform: translate(-50%, -50%) scale(1.12);
  transform-origin: center center;
  object-fit: cover;
  object-position: center center;
  filter: grayscale(55%) contrast(1.12) brightness(1.12);
  opacity: 0.78;
  z-index: 0;
}

.hero-right-stack {
  position: absolute;
  inset: 0;
  display: grid;
  grid-template-rows: 1fr 1fr;
  width: 100%;
  height: 100%;
}

.hero-right .hero-image-wrapper {
  position: relative;
  width: 100%;
  min-height: 0;
  overflow: hidden;
}

.hero-landscape-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  filter: grayscale(50%) contrast(1.1) brightness(1.1);
  opacity: 0.68;
}

.hero-image-overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    180deg,
    rgba(0, 0, 0, 0.12) 0%,
    rgba(0, 0, 0, 0.42) 100%
  );
  top: 0;
  left: 0;
  z-index: 1;
  pointer-events: none;
}

.hero-text-overlay {
  position: relative;
  z-index: 10;
  width: 100%;
  padding: 4rem;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
}

.hero-main-title {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.hero-title-line-1,
.hero-title-line-2 {
  display: block;
  font-size: clamp(3.6rem, 10.8vw, 9rem);
  font-weight: 900;
  letter-spacing: -6px;
  line-height: 0.9;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.8);
  opacity: 0;
  transform: translate3d(0, 40px, 0) scale(0.97);
  transform-origin: 50% 100%;
}

.hero--ready .hero-title-line-1 {
  animation: heroTitleReveal 2.12s cubic-bezier(0.15, 0.85, 0.22, 1) 0.44s forwards;
}

.hero--ready .hero-title-line-2 {
  animation: heroTitleReveal 2.12s cubic-bezier(0.15, 0.85, 0.22, 1) 0.96s forwards;
}

.hero-fade-in {
  opacity: 0;
}

.hero--ready .hero-fade-in {
  animation: heroFadeUpSoft 1.16s cubic-bezier(0.18, 0.82, 0.26, 1) 1.48s forwards;
}

.hero--ready .hero-fade-in--late {
  animation-delay: 1.96s;
}

.hero--ready .hero-fade-in--later {
  animation-delay: 2.32s;
}

.hero-fade-opacity {
  opacity: 0;
}

.hero--ready .hero-fade-opacity {
  animation: heroFadeOnlySlow 1.2s cubic-bezier(0.18, 0.82, 0.26, 1) 1.48s forwards;
}

.hero--ready .hero-fade-opacity--late {
  animation-delay: 1.96s;
}

@keyframes heroFadeOnlySlow {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* Slow editorial reveal: opacity lags behind motion so it doesn’t snap */
@keyframes heroTitleReveal {
  0% {
    opacity: 0;
    transform: translate3d(0, 44px, 0) scale(0.965);
  }
  38% {
    opacity: 0.22;
    transform: translate3d(0, 18px, 0) scale(0.985);
  }
  72% {
    opacity: 0.82;
    transform: translate3d(0, 4px, 0) scale(0.996);
  }
  100% {
    opacity: 1;
    transform: translate3d(0, 0, 0) scale(1);
  }
}

@keyframes heroFadeUpSoft {
  from {
    opacity: 0;
    transform: translate3d(0, 22px, 0);
  }
  to {
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }
}

.hero-scroll-cue {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  z-index: 12;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  background: none;
  border: none;
  cursor: pointer;
  color: #ffffff;
  padding: 0.5rem;
  opacity: 0;
}

.hero--ready .hero-scroll-cue {
  animation: heroFadeUpSoft 1.08s cubic-bezier(0.18, 0.82, 0.26, 1) 2.52s forwards;
}

.hero-scroll-label {
  font-size: 0.65rem;
  font-weight: 700;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.85;
}

.hero-scroll-line {
  width: 1px;
  height: 48px;
  background: linear-gradient(
    to bottom,
    rgba(255, 255, 255, 0.1),
    rgba(230, 57, 70, 0.95),
    rgba(255, 255, 255, 0.1)
  );
  animation: heroScrollBounce 2.72s ease-in-out 2.68s infinite;
}

@keyframes heroScrollBounce {
  0%,
  100% {
    transform: translateY(0);
    opacity: 0.7;
  }
  50% {
    transform: translateY(7px);
    opacity: 1;
  }
}

.hero-right {
  position: relative;
  min-height: 100vh;
  background: #0a0a0a;
  overflow: hidden;
}

.hero-right-overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.22) 0%,
    rgba(0, 0, 0, 0.52) 100%
  );
  top: 0;
  left: 0;
  z-index: 1;
}

.hero-right-text {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 10;
  padding: 3rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  align-items: flex-start;
}

.hero-date {
  font-size: clamp(1.5rem, 3vw, 2.5rem);
  font-weight: 900;
  letter-spacing: 2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
}

.hero-location {
  font-size: clamp(0.9rem, 1.5vw, 1.2rem);
  font-weight: 700;
  letter-spacing: 3px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  opacity: 0.9;
}

.hero-vertical-text-right {
  position: absolute;
  right: 2rem;
  top: 50%;
  transform: translateY(-50%);
  writing-mode: vertical-rl;
  text-orientation: mixed;
  font-size: clamp(1.8rem, 3.5vw, 3rem);
  font-weight: 900;
  letter-spacing: 0.12em;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  z-index: 10;
  text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.8);
  margin: 0;
}

/* Spaced-out “GOLDIE” along the vertical axis */
.hero-goldie .hero-goldie-text {
  display: inline-block;
  letter-spacing: clamp(0.42em, 2.4vw, 0.95em);
  word-spacing: 0;
}

.hero-bottom-meta {
  position: absolute;
  bottom: 2rem;
  left: 2rem;
  z-index: 10;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.hero-meta-line {
  font-size: clamp(0.85rem, 1.2vw, 1rem);
  font-weight: 700;
  letter-spacing: 2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.8);
}

@media (max-width: 968px) {
  .hero-container {
    grid-template-columns: 1fr;
    grid-template-rows: minmax(50vh, 1fr) minmax(50vh, 1fr);
  }

  .hero-right {
    min-height: 50vh;
  }

  .hero-vertical-text-right {
    writing-mode: horizontal-tb;
    position: relative;
    right: auto;
    top: auto;
    transform: none;
    margin-bottom: 1rem;
    letter-spacing: 0.2em;
    width: 100%;
    text-align: center;
    box-sizing: border-box;
    padding-left: 1.25rem;
    padding-right: 1.25rem;
  }

  .hero-goldie .hero-goldie-text {
    letter-spacing: clamp(0.55em, 3.5vw, 1.1em);
  }

  .hero-text-overlay {
    padding: 2rem;
  }

  .hero-right-text {
    padding: 2rem;
    left: 0;
    right: 0;
    width: 100%;
    align-items: center;
    text-align: center;
    box-sizing: border-box;
  }
}

@media (min-width: 1920px) {
  .hero-title-line-1,
  .hero-title-line-2 {
    font-size: clamp(5.4rem, 10.8vw, 10.8rem);
  }

  .hero-date {
    font-size: clamp(2rem, 3vw, 3rem);
  }

  .hero-location {
    font-size: clamp(1.2rem, 1.5vw, 1.5rem);
  }

  .hero-vertical-text-right {
    font-size: clamp(2rem, 3.5vw, 4rem);
  }
}

@media (max-width: 640px) {
  .hero-title-line-1,
  .hero-title-line-2 {
    font-size: clamp(2.5rem, 10vw, 6rem);
    letter-spacing: -3px;
  }

  .hero-vertical-text-right {
    font-size: clamp(1.2rem, 4vw, 2rem);
  }

  .hero-left-main-image {
    opacity: 0.85;
    filter: grayscale(40%) contrast(1.08) brightness(1.18);
  }

  .hero-landscape-image {
    opacity: 0.75;
    filter: grayscale(35%) contrast(1.06) brightness(1.14);
  }

  .hero-image-overlay {
    background: linear-gradient(
      180deg,
      rgba(0, 0, 0, 0.08) 0%,
      rgba(0, 0, 0, 0.38) 100%
    );
  }

  .hero-right-overlay {
    background: linear-gradient(
      135deg,
      rgba(0, 0, 0, 0.18) 0%,
      rgba(0, 0, 0, 0.48) 100%
    );
  }
}

@media (prefers-reduced-motion: reduce) {
  .hero-title-line-1,
  .hero-title-line-2,
  .hero-fade-in,
  .hero-fade-opacity,
  .hero-scroll-cue {
    opacity: 1 !important;
    animation: none !important;
    transform: none !important;
  }

  .image-reveal-wrap {
    opacity: 1 !important;
    transition: none !important;
  }

  .hero-scroll-line {
    animation: none !important;
  }
}
</style>
