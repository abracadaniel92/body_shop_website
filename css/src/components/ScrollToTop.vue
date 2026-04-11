<template>
  <Transition name="scroll-top">
    <button
      v-if="showButton"
      type="button"
      @click="scrollToTop"
      class="scroll-to-top"
      aria-label="Scroll to top"
    >
      ↑
    </button>
  </Transition>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'

export default {
  name: 'ScrollToTop',
  setup () {
    const showButton = ref(false)

    const handleScroll = () => {
      showButton.value = window.scrollY > 300
    }

    const scrollToTop = () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      })
    }

    onMounted(() => {
      window.addEventListener('scroll', handleScroll, { passive: true })
      handleScroll()
    })

    onUnmounted(() => {
      window.removeEventListener('scroll', handleScroll)
    })

    return {
      showButton,
      scrollToTop
    }
  }
}
</script>

<style scoped>
.scroll-to-top {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  width: 50px;
  height: 50px;
  background: #ffffff;
  color: #0a0a0a;
  border: 2px solid #ffffff;
  border-radius: 50%;
  font-size: 1.5rem;
  font-weight: 900;
  cursor: pointer;
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: center;
  transition:
    background 0.45s ease,
    color 0.45s ease,
    border-color 0.45s ease,
    transform 0.45s ease,
    opacity 0.45s ease;
  opacity: 0.95;
  font-family: 'Inter', sans-serif;
}

.scroll-to-top:hover {
  background: var(--accent-red, #e63946);
  color: #ffffff;
  border-color: var(--accent-red, #e63946);
  transform: translateY(-5px);
  opacity: 1;
}

.scroll-top-enter-active,
.scroll-top-leave-active {
  transition:
    opacity 0.4s cubic-bezier(0.22, 1, 0.36, 1),
    transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
}

.scroll-top-enter-from,
.scroll-top-leave-to {
  opacity: 0;
  transform: scale(0.86) translateY(12px);
}

@media (max-width: 968px) {
  .scroll-to-top {
    width: 45px;
    height: 45px;
    font-size: 1.3rem;
    bottom: 1.5rem;
    right: 1.5rem;
  }
}
</style>
