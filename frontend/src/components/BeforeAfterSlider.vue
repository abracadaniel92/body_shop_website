<template>
  <div
    class="ba-slider"
    ref="sliderRef"
    @mousedown.prevent="startDrag"
    @touchstart.passive="startDrag"
  >
    <!-- After image (full background) -->
    <img
      class="ba-slider__img ba-slider__img--after"
      :src="after"
      :alt="afterLabel"
      draggable="false"
      @click="$emit('image-click', after)"
    />

    <!-- Before image (clipped) -->
    <div
      class="ba-slider__before"
      :style="{ clipPath: `inset(0 ${100 - position}% 0 0)` }"
    >
      <img
        class="ba-slider__img"
        :src="before"
        :alt="beforeLabel"
        draggable="false"
        @click="$emit('image-click', before)"
      />
    </div>

    <!-- Labels -->
    <span class="ba-slider__label ba-slider__label--before">{{ beforeLabel }}</span>
    <span class="ba-slider__label ba-slider__label--after">{{ afterLabel }}</span>

    <!-- Drag handle -->
    <div class="ba-slider__handle" :style="{ left: position + '%' }">
      <div class="ba-slider__line" />
      <div class="ba-slider__knob">
        <span class="ba-slider__arrows">◀ ▶</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onUnmounted } from 'vue'

const props = defineProps({
  before: { type: String, required: true },
  after: { type: String, required: true },
  beforeLabel: { type: String, default: 'Пред' },
  afterLabel: { type: String, default: 'Потоа' }
})

defineEmits(['image-click'])

const sliderRef = ref(null)
const position = ref(50)
let isDragging = false

function getPosition(clientX) {
  const rect = sliderRef.value.getBoundingClientRect()
  const pct = ((clientX - rect.left) / rect.width) * 100
  return Math.min(Math.max(pct, 2), 98)
}

function startDrag(e) {
  isDragging = true
  const clientX = e.touches ? e.touches[0].clientX : e.clientX
  position.value = getPosition(clientX)
  document.addEventListener('mousemove', onDrag)
  document.addEventListener('mouseup', stopDrag)
  document.addEventListener('touchmove', onDrag, { passive: false })
  document.addEventListener('touchend', stopDrag)
}

function onDrag(e) {
  if (!isDragging) return
  if (e.cancelable) e.preventDefault()
  const clientX = e.touches ? e.touches[0].clientX : e.clientX
  position.value = getPosition(clientX)
}

function stopDrag() {
  isDragging = false
  document.removeEventListener('mousemove', onDrag)
  document.removeEventListener('mouseup', stopDrag)
  document.removeEventListener('touchmove', onDrag)
  document.removeEventListener('touchend', stopDrag)
}

onUnmounted(() => {
  stopDrag()
})
</script>

<style scoped>
.ba-slider {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 9;
  overflow: hidden;
  border-radius: 12px;
  cursor: ew-resize;
  user-select: none;
  background: #111;
}

.ba-slider__img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.ba-slider__img--after {
  position: absolute;
  inset: 0;
}

.ba-slider__before {
  position: absolute;
  inset: 0;
  z-index: 2;
}

.ba-slider__before .ba-slider__img {
  position: absolute;
  inset: 0;
}

.ba-slider__label {
  position: absolute;
  bottom: 12px;
  z-index: 4;
  padding: 4px 12px;
  border-radius: 6px;
  background: rgba(0, 0, 0, 0.6);
  color: #fff;
  font-family: 'Rajdhani', 'Segoe UI', Tahoma, sans-serif;
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  pointer-events: none;
}

.ba-slider__label--before {
  left: 12px;
}

.ba-slider__label--after {
  right: 12px;
}

.ba-slider__handle {
  position: absolute;
  top: 0;
  bottom: 0;
  z-index: 5;
  width: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  pointer-events: none;
}

.ba-slider__line {
  position: absolute;
  top: 0;
  bottom: 0;
  width: 2px;
  background: #fff;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.4);
}

.ba-slider__knob {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
}

.ba-slider__arrows {
  font-size: 0.6rem;
  color: #333;
  letter-spacing: 2px;
  line-height: 1;
}

@media (max-width: 768px) {
  .ba-slider {
    aspect-ratio: 4 / 3;
  }

  .ba-slider__knob {
    width: 34px;
    height: 34px;
  }
}
</style>
