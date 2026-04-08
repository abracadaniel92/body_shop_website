<template>
  <header class="bs-header" :class="{ 'is-scrolled': isScrolled }">
    <div class="bs-container bs-header-inner">
      <div class="bs-logo">
        <router-link class="bs-logo-link" to="/">
          <img class="bs-logo-img" :src="isScrolled ? logoScrolled : logoDefault" alt="Дака Драган" />
        </router-link>
      </div>

      <button
        class="bs-hamburger"
        :class="{ 'is-open': menuOpen }"
        type="button"
        aria-label="Мени"
        @click.stop="menuOpen = !menuOpen"
      >
        <span class="bs-hamburger__bar" />
        <span class="bs-hamburger__bar" />
        <span class="bs-hamburger__bar" />
      </button>

      <Transition name="backdrop">
        <div v-if="menuOpen" class="bs-nav-backdrop" @click="menuOpen = false" />
      </Transition>

      <nav class="bs-nav" :class="{ 'is-open': menuOpen }">
        <a class="bs-nav-link" href="#" @click.prevent="goHome">Почетна</a>
        <a class="bs-nav-link" href="#" @click.prevent="goToSection('services')">Услуги</a>
        <a class="bs-nav-link" href="#" @click.prevent="goToSection('about')">За нас</a>
        <a class="bs-nav-link" href="#" @click.prevent="goToSection('contact')">Контакт</a>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { nextTick, onMounted, onUnmounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import logoDefault from '../../images/logos/logo.png'
import logoScrolled from '../../images/logos/logo2.png'

const isScrolled = ref(false)
const menuOpen = ref(false)
const router = useRouter()
const route = useRoute()

function handleScroll() {
  isScrolled.value = window.scrollY > 20
}

function scrollToSection(sectionId) {
  const el = document.getElementById(sectionId)
  if (!el) return
  el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

async function goToSection(sectionId) {
  menuOpen.value = false
  if (route.path !== '/') {
    await router.push('/')
    await nextTick()
    setTimeout(() => scrollToSection(sectionId), 60)
    return
  }
  scrollToSection(sectionId)
}

async function goHome() {
  menuOpen.value = false
  if (route.path !== '/') {
    await router.push('/')
    return
  }
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => {
  handleScroll()
  window.addEventListener('scroll', handleScroll, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>
