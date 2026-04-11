<template>
  <div class="page-marquee" aria-hidden="true">
    <div class="page-marquee__track">
      <!-- Four identical strips so total width always exceeds ultra-wide viewports; loop = −25% -->
      <span v-for="n in 4" :key="n" class="page-marquee__segment">
        <span v-for="(chunk, i) in chunks" :key="`${n}-${i}`" class="page-marquee__chunk">
          {{ chunk }}<span class="page-marquee__dot"> • </span>
        </span>
      </span>
    </div>
  </div>
</template>

<script setup>
const chunks = [
  'CENTAR SRBIJA STIL',
  'BELGRADE',
  'RAW HIP-HOP',
  'AUTHENTIC CULTURE',
  'NO COMPROMISES',
  'STREET SOUND'
]
</script>

<style scoped>
.page-marquee {
  width: 100%;
  overflow: hidden;
  background: #000000;
  border-top: 1px solid rgba(255, 255, 255, 0.15);
  border-bottom: 1px solid rgba(255, 255, 255, 0.15);
  padding: 0.65rem 0;
}

.page-marquee__track {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  width: max-content;
  min-width: 100%;
  flex-shrink: 0;
  will-change: transform;
  /* One loop = 25% shift = one segment width */
  animation: marquee-scroll 40s linear infinite;
}

.page-marquee__segment {
  display: flex;
  flex-shrink: 0;
  flex-grow: 0;
  align-items: center;
}

.page-marquee__chunk {
  font-family: 'Inter', sans-serif;
  font-size: clamp(0.65rem, 1.1vw, 0.8rem);
  font-weight: 700;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  color: #ffffff;
  white-space: nowrap;
  padding-right: 0.5rem;
}

.page-marquee__dot {
  color: var(--accent-red, #e63946);
  letter-spacing: 0.2em;
}

@keyframes marquee-scroll {
  0% {
    transform: translate3d(0, 0, 0);
  }
  100% {
    /* One of four identical strips — seamless loop */
    transform: translate3d(-25%, 0, 0);
  }
}

@media (prefers-reduced-motion: reduce) {
  .page-marquee__track {
    animation: none;
    justify-content: center;
    width: 100%;
    flex-wrap: wrap;
    gap: 0.5rem 1rem;
    min-width: 0;
    transform: none;
  }
}
</style>
