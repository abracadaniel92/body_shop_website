<template>
  <header class="nav-wrap">
    <nav :class="{ 'nav--scrolled': scrolled, 'nav--open': menuOpen }">
      <a href="#home" class="logo" @click="onNavClick">
        <img src="../../images/logo/centar_srbija_stil_transparent.png" alt="CENTAR SRBIJA STIL" />
      </a>
      <button
        type="button"
        class="nav-toggle"
        :aria-expanded="menuOpen"
        aria-controls="primary-navigation"
        :aria-label="menuOpen ? 'Close menu' : 'Open menu'"
        @click="menuOpen = !menuOpen"
      >
        <span class="nav-toggle-bar" />
        <span class="nav-toggle-bar" />
      </button>
      <ul id="primary-navigation" class="nav-links" :class="{ 'nav-links--open': menuOpen }">
        <li v-for="item in items" :key="item.id">
          <a :href="item.href" @click="onNavClick">{{ item.label }}</a>
        </li>
      </ul>
    </nav>
    <div
      v-if="menuOpen"
      class="nav-backdrop"
      aria-hidden="true"
      @click="closeMenu"
    />
  </header>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'

export default {
  name: 'Navigation',
  setup () {
    const scrolled = ref(false)
    const menuOpen = ref(false)

    const items = [
      { id: 'home', href: '#home', label: 'HOME' },
      { id: 'news', href: '#news', label: 'NEWS' },
      { id: 'tours', href: '#tours', label: 'TOURS' },
      { id: 'music', href: '#music', label: 'MUSIC' },
      // { id: 'merch', href: '#merch', label: 'MERCH' },
      { id: 'about', href: '#about', label: 'ABOUT' },
      { id: 'contact', href: '#contact', label: 'CONTACT' }
    ]

    function onScroll () {
      scrolled.value = window.scrollY > 48
    }

    function closeMenu () {
      menuOpen.value = false
    }

    function onNavClick (e) {
      const href = e.currentTarget.getAttribute('href')
      if (href && href.startsWith('#')) {
        e.preventDefault()
        const target = document.querySelector(href)
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' })
        }
      }
      closeMenu()
    }

    onMounted(() => {
      onScroll()
      window.addEventListener('scroll', onScroll, { passive: true })
    })

    onUnmounted(() => {
      window.removeEventListener('scroll', onScroll)
    })

    return {
      scrolled,
      menuOpen,
      items,
      closeMenu,
      onNavClick
    }
  }
}
</script>

<style scoped>
.nav-wrap {
  position: relative;
  z-index: 1000;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: transparent;
  border: none;
  transition:
    background 0.4s ease,
    backdrop-filter 0.4s ease,
    box-shadow 0.4s ease;
}

.nav--scrolled {
  background: rgba(10, 10, 10, 0.82);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.06);
}

.logo {
  display: flex;
  align-items: center;
  height: 120px;
  z-index: 1002;
}

.logo img {
  height: 100%;
  width: auto;
  object-fit: contain;
  max-width: 600px;
}

.nav-toggle {
  display: none;
  position: relative;
  z-index: 1002;
  width: 44px;
  height: 44px;
  padding: 0;
  border: 2px solid rgba(255, 255, 255, 0.85);
  background: transparent;
  cursor: pointer;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.nav-toggle-bar {
  display: block;
  width: 18px;
  height: 2px;
  background: #ffffff;
  transition: transform 0.25s ease, opacity 0.25s ease;
}

.nav--open .nav-toggle-bar:first-child {
  transform: translateY(4px) rotate(45deg);
}

.nav--open .nav-toggle-bar:last-child {
  transform: translateY(-4px) rotate(-45deg);
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 2rem;
  flex-wrap: wrap;
  align-items: center;
}

.nav-links a {
  color: #ffffff;
  text-decoration: none;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-size: 0.75rem;
  transition:
    color 0.25s ease,
    opacity 0.25s ease;
}

.nav-links a:hover {
  color: var(--accent-red, #e63946);
  opacity: 1;
}

.nav-backdrop {
  display: none;
}

@media (max-width: 968px) {
  nav {
    padding: 1rem 1.25rem;
  }

  .nav-toggle {
    display: flex;
  }

  .logo {
    height: 96px;
    max-width: min(85vw, 480px);
  }

  .logo img {
    max-width: 100%;
  }

  .nav-links {
    position: fixed;
    top: 0;
    right: 0;
    width: min(100%, 320px);
    height: 100vh;
    margin: 0;
    padding: 5.5rem 2rem 2rem;
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
    background: rgba(10, 10, 10, 0.97);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    transform: translateX(100%);
    transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    z-index: 1001;
  }

  .nav-links--open {
    transform: translateX(0);
  }

  .nav-links li {
    width: 100%;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .nav-links a {
    display: block;
    padding: 1rem 0;
    font-size: 0.8rem;
  }

  .nav-backdrop {
    display: block;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    z-index: 999;
  }
}
</style>
