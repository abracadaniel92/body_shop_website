<template>
  <section
    class="repairGallery"
    aria-label="Галерија од завршени возила"
  >
    <div class="repairGallery__viewport">
      <div
        class="repairGallery__track"
        :style="{ '--repair-marquee-duration': durationSec + 's' }"
      >
        <template v-for="pass in 2" :key="pass">
          <img
            v-for="(src, i) in resolvedImages"
            :key="`${pass}-${i}`"
            class="repairGallery__img"
            :src="src"
            alt=""
            loading="lazy"
            decoding="async"
            draggable="false"
          />
        </template>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import fallback1 from '../../images/cars/Golf.webp'
import fallback2 from '../../images/cars/Octavia.webp'

/**
 * Pass image URL strings from parent, or add files under frontend/images/repair-gallery/
 * and import them in Home.vue, then pass :images="[...]".
 */
const props = defineProps({
  images: { type: Array, default: null },
  /** Full loop duration in seconds (larger = slower). */
  durationSec: { type: Number, default: 38 }
})

const resolvedImages = computed(() =>
  props.images?.length ? props.images : [fallback1, fallback2, fallback1, fallback2]
)
</script>

<style scoped>
.repairGallery {
  --repair-gallery-h: 68px;
  background: #080b12;
  border-top: 1px solid #1e2230;
  border-bottom: 1px solid #1e2230;
  padding: 10px 0;
}

.repairGallery__viewport {
  overflow: hidden;
  mask-image: linear-gradient(
    90deg,
    transparent,
    #000 6%,
    #000 94%,
    transparent
  );
}

.repairGallery__track {
  display: flex;
  width: max-content;
  gap: 10px;
  animation: repairGalleryMarquee var(--repair-marquee-duration, 38s) linear infinite;
  will-change: transform;
}

.repairGallery__img {
  height: var(--repair-gallery-h);
  width: 118px;
  object-fit: cover;
  border-radius: 6px;
  flex-shrink: 0;
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
  pointer-events: none;
  user-select: none;
}

@keyframes repairGalleryMarquee {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}

@media (prefers-reduced-motion: reduce) {
  .repairGallery__track {
    animation: none;
    justify-content: center;
    flex-wrap: wrap;
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
  }
}
</style>
