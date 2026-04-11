<template>
  <div
    v-show="enabled && visible"
    class="custom-cursor"
    :style="cursorStyle"
    aria-hidden="true"
  />
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const enabled = ref(false)
const visible = ref(false)
const x = ref(0)
const y = ref(0)

const cursorStyle = computed(() => ({
  transform: `translate3d(${x.value}px, ${y.value}px, 0) translate(-50%, -50%)`
}))

function onMove (e) {
  x.value = e.clientX
  y.value = e.clientY
  visible.value = true
}

function onLeave () {
  visible.value = false
}

function mq () {
  return window.matchMedia('(min-width: 1024px) and (pointer: fine)').matches
}

onMounted(() => {
  enabled.value = mq()
  if (!enabled.value) return
  window.addEventListener('pointermove', onMove, { passive: true })
  document.documentElement.addEventListener('mouseleave', onLeave)
})

onUnmounted(() => {
  window.removeEventListener('pointermove', onMove)
  document.documentElement.removeEventListener('mouseleave', onLeave)
})
</script>

<style scoped>
.custom-cursor {
  position: fixed;
  left: 0;
  top: 0;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 1px solid rgba(230, 57, 70, 0.85);
  background: rgba(230, 57, 70, 0.12);
  pointer-events: none;
  z-index: 10001;
  transition: opacity 0.2s ease;
  mix-blend-mode: difference;
}
</style>
