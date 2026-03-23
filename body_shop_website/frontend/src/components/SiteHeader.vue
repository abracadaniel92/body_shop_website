<template>
  <header class="bs-header" :class="{ 'is-scrolled': isScrolled }">
    <div class="bs-container bs-header-inner">
      <div class="bs-logo">
        <router-link class="bs-logo-link" to="/">
          <img class="bs-logo-img" :src="isScrolled ? '/logo2.png' : '/logo.png'" alt="Дака Драган" />
        </router-link>
      </div>

      <nav class="bs-nav">
        <router-link class="bs-nav-link" to="/">Почетна</router-link>
        <router-link class="bs-nav-link" to="/gallery">Галерија</router-link>
        <router-link class="bs-nav-link" to="/blog">Блог</router-link>
        <a class="bs-nav-link" href="#" @click.prevent="goToSection('about')">За нас</a>
        <a class="bs-nav-link" href="#" @click.prevent="goToSection('contact')">Контакт</a>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { nextTick, onMounted, onUnmounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const isScrolled = ref(false)
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
  if (route.path !== '/') {
    await router.push('/')
    await nextTick()
    setTimeout(() => scrollToSection(sectionId), 60)
    return
  }
  scrollToSection(sectionId)
}

onMounted(() => {
  handleScroll()
  window.addEventListener('scroll', handleScroll, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

