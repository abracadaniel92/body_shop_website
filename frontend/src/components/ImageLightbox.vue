<template>
  <Teleport to="body">
    <Transition name="lightbox">
      <div v-if="visible" class="lightbox" @click.self="$emit('close')">
        <button class="lightbox__close" type="button" aria-label="Затвори" @click="$emit('close')">✕</button>

        <button
          v-if="images.length > 1"
          class="lightbox__nav lightbox__nav--prev"
          type="button"
          aria-label="Претходна"
          @click="prev"
        >‹</button>

        <img
          class="lightbox__img"
          :src="images[currentIndex]"
          alt=""
          draggable="false"
        />

        <button
          v-if="images.length > 1"
          class="lightbox__nav lightbox__nav--next"
          type="button"
          aria-label="Следна"
          @click="next"
        >›</button>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  visible: { type: Boolean, default: false },
  images: { type: Array, default: () => [] },
  startIndex: { type: Number, default: 0 }
})

const emit = defineEmits(['close'])

const currentIndex = ref(0)

watch(() => props.startIndex, (val) => {
  currentIndex.value = val
})

watch(() => props.visible, (val) => {
  document.body.style.overflow = val ? 'hidden' : ''
  if (val) currentIndex.value = props.startIndex
})

function prev() {
  currentIndex.value = (currentIndex.value - 1 + props.images.length) % props.images.length
}

function next() {
  currentIndex.value = (currentIndex.value + 1) % props.images.length
}

function onKeydown(e) {
  if (!props.visible) return
  if (e.key === 'Escape') emit('close')
  if (e.key === 'ArrowLeft') prev()
  if (e.key === 'ArrowRight') next()
}

onMounted(() => {
  window.addEventListener('keydown', onKeydown)
})

onUnmounted(() => {
  window.removeEventListener('keydown', onKeydown)
  document.body.style.overflow = ''
})
</script>

<style scoped>
.lightbox {
  position: fixed;
  inset: 0;
  z-index: 100;
  background: rgba(0, 0, 0, 0.92);
  display: flex;
  align-items: center;
  justify-content: center;
}

.lightbox__img {
  max-width: 90vw;
  max-height: 85vh;
  object-fit: contain;
  border-radius: 8px;
  user-select: none;
}

.lightbox__close {
  position: absolute;
  top: 16px;
  right: 20px;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: none;
  background: rgba(255, 255, 255, 0.12);
  color: #fff;
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s;
}

.lightbox__close:hover {
  background: rgba(255, 255, 255, 0.25);
}

.lightbox__nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 48px;
  height: 48px;
  border-radius: 50%;
  border: none;
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
  font-size: 1.8rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s;
}

.lightbox__nav:hover {
  background: rgba(255, 255, 255, 0.22);
}

.lightbox__nav--prev {
  left: 16px;
}

.lightbox__nav--next {
  right: 16px;
}

/* Transition */
.lightbox-enter-active {
  transition: opacity 0.25s ease;
}

.lightbox-leave-active {
  transition: opacity 0.2s ease;
}

.lightbox-enter-from,
.lightbox-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .lightbox__nav {
    width: 38px;
    height: 38px;
    font-size: 1.4rem;
  }

  .lightbox__close {
    top: 10px;
    right: 10px;
  }
}
</style>
