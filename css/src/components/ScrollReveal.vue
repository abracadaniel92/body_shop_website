<template>
  <component
    :is="tag"
    ref="root"
    :class="['scroll-reveal', { 'scroll-reveal--visible': isInView }]"
  >
    <slot />
  </component>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  tag: {
    type: String,
    default: 'div'
  },
  threshold: {
    type: Number,
    default: 0.12
  },
  rootMargin: {
    type: String,
    default: '0px 0px -48px 0px'
  },
  once: {
    type: Boolean,
    default: true
  }
})

const root = ref(null)
const isInView = ref(false)

let observer

onMounted(() => {
  const el = root.value
  if (!el) return
  observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        isInView.value = true
        if (props.once && observer) {
          observer.unobserve(el)
        }
      } else if (!props.once) {
        isInView.value = false
      }
    },
    { threshold: props.threshold, rootMargin: props.rootMargin }
  )
  observer.observe(el)
})

onUnmounted(() => {
  if (observer && root.value) {
    try {
      observer.unobserve(root.value)
    } catch {
      /* ignore */
    }
  }
  observer = null
})

defineExpose({ root, isInView })
</script>

<style scoped>
.scroll-reveal {
  opacity: 0;
  transform: translateY(28px);
  transition:
    opacity 0.72s cubic-bezier(0.22, 1, 0.36, 1),
    transform 0.72s cubic-bezier(0.22, 1, 0.36, 1);
  will-change: opacity, transform;
}

.scroll-reveal--visible {
  opacity: 1;
  transform: translateY(0);
}
</style>
