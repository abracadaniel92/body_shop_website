<template>
  <div class="bs-page">
    <SiteHeader />

    <!-- Hero (full-bleed dark) -->
    <section class="homeHero">
      <div class="homeHero__overlay" />
      <div class="bs-container homeHero__inner">
        <p class="homeHero__kicker">Дака Драган • Автолимарија и автолакирање</p>
        <h1 class="homeHero__title">Твоето возило во најдобри раце</h1>
        <p class="homeHero__subtitle">
          Лимарија, фарбање, полирање и комплетна реставрација — професионална изработка со гаранција за квалитет.
        </p>
        <div class="homeHero__actions">
          <a class="bs-btn homeHero__cta" href="#services" @click.prevent="scrollToSection('services')">Погледни услуги</a>
          <a class="homeHero__ghost" href="#" @click.prevent="scrollToContact">Контактирај не</a>
        </div>
      </div>
    </section>

    <!-- Stats strip -->
    <section class="statsStrip reveal" :ref="addRevealRef">
      <div class="bs-container statsStrip__inner">
        <div v-for="stat in stats" :key="stat.label" class="statsStrip__item">
          <span class="statsStrip__number" ref="statNumbers" :data-target="stat.value">0</span>
          <span class="statsStrip__suffix">{{ stat.suffix }}</span>
          <span class="statsStrip__label">{{ stat.label }}</span>
        </div>
      </div>
    </section>

    <!-- Why choose us (3 cards only) -->
    <section class="homeSection homeSection--dark whyChooseSection" aria-label="Зошто да избереш">
      <div class="bs-container">
        <h2 class="homeSection__title homeSection__title--light">Зошто клиентите не избираат нас?</h2>
        <div class="whyChooseCards whyChooseCards--three" aria-label="Причини за избор">
          <article class="whyChooseCard reveal" :ref="addRevealRef">
            <span class="whyChooseCard__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" /><path d="m21 21-4.35-4.35" /><path d="M8 11h6" /><path d="M11 8v6" /></svg>
            </span>
            <div>
              <h3 class="whyChooseCard__title">Прецизна дијагностика</h3>
              <p class="whyChooseCard__text">
                Секое возило го прегледуваме детално пред да почнеме. Добиваш јасна проценка, план на работа
                и реален рок за завршување — без изненадувања.
              </p>
            </div>
          </article>
          <article class="whyChooseCard reveal" :ref="addRevealRef">
            <span class="whyChooseCard__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" /></svg>
            </span>
            <div>
              <h3 class="whyChooseCard__title">Квалитетна изработка</h3>
              <p class="whyChooseCard__text">
                Користиме професионални материјали и алатки. Секој чекор — од подготовка до финално лакирање —
                поминува низ контрола за да обезбедиме траен резултат.
              </p>
            </div>
          </article>
          <article class="whyChooseCard reveal" :ref="addRevealRef">
            <span class="whyChooseCard__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M2 17h2.4a1 1 0 0 0 .7-.3l7.2-7.2a1 1 0 0 1 1.4 0l7.2 7.2a1 1 0 0 0 .7.3H22" /><path d="M6 21V17" /><path d="M18 21V17" /><path d="M12 3v6" /></svg>
            </span>
            <div>
              <h3 class="whyChooseCard__title">Фер и транспарентна цена</h3>
              <p class="whyChooseCard__text">
                Добиваш детална понуда пред почеток на работа. Без скриени трошоци — ако се појави
                нешто дополнително, те информираме веднаш.
              </p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- Featured services (alternate image sides) -->
    <section class="homeSection homeSection--edge" id="services" aria-label="Услуги">
      <div class="bs-container homeSection__headingWrap">
        <h2 class="homeSection__title">Што работиме</h2>
      </div>

      <!-- Service 1: media left -->
      <div class="bs-container serviceBlock reveal" :ref="addRevealRef" aria-label="Лимарија и поправка">
        <div class="homeSplit">
        <div class="homeSplit__media" role="img" aria-label="Лимарија и поправка">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s1" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Лимарија и поправка</h2>
          <p class="homeSection__text">
            Исправање на вдлабнатини, замена на делови и целосна реконструкција на каросеријата.
            Го враќаме оригиналниот изглед на возилото.
          </p>
          <div class="homeSplit__actions">
            <button class="serviceExamples__toggle" type="button" @click="toggleExamples('repair')">
              <svg class="serviceExamples__toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="12" y1="3" x2="12" y2="21"/></svg>
              {{ expandedExamples.repair ? 'Затвори' : 'Пред и потоа' }}
            </button>
          </div>
        </div>
        </div>
        <div class="serviceGallery" :class="{ 'serviceGallery--open': expandedExamples.repair }">
          <ul class="serviceGallery__emptyList" aria-label="Листа на примери за лимарија" />
        </div>
      </div>

      <!-- Service 2: media right -->
      <div class="bs-container serviceBlock reveal" :ref="addRevealRef" aria-label="Фарбање и лакирање">
        <div class="homeSplit">
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Фарбање и лакирање</h2>
          <p class="homeSection__text">
            Компјутерско мешање на бои за точна нијанса, темелна подготовка на површината
            и финално лакирање со фабрички квалитет.
          </p>
          <div class="homeSplit__actions">
            <button class="serviceExamples__toggle" type="button" @click="toggleExamples('paint')">
              <svg class="serviceExamples__toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="12" y1="3" x2="12" y2="21"/></svg>
              {{ expandedExamples.paint ? 'Затвори' : 'Пред и потоа' }}
            </button>
          </div>
        </div>
        <div class="homeSplit__media" role="img" aria-label="Фарбање и лакирање">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s2" />
        </div>
        </div>
        <div class="serviceGallery" :class="{ 'serviceGallery--open': expandedExamples.paint }">
          <ul class="serviceGallery__emptyList" aria-label="Листа на примери за фарбање" />
        </div>
      </div>

      <!-- Service 3: media left -->
      <div class="bs-container serviceBlock reveal" :ref="addRevealRef" aria-label="Полирање и деталинг">
        <div class="homeSplit">
        <div class="homeSplit__media" role="img" aria-label="Полирање и деталинг">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s3" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Полирање и деталинг</h2>
          <p class="homeSection__text">
            Машинско полирање, заштита на лак, длабинско чистење на ентериер и екстериер.
            Возилото го враќаме во салонска состојба.
          </p>
          <div class="homeSplit__actions">
            <button class="serviceExamples__toggle" type="button" @click="toggleExamples('detailing')">
              <svg class="serviceExamples__toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="12" y1="3" x2="12" y2="21"/></svg>
              {{ expandedExamples.detailing ? 'Затвори' : 'Пред и потоа' }}
            </button>
          </div>
        </div>
        </div>
        <div class="serviceGallery" :class="{ 'serviceGallery--open': expandedExamples.detailing }">
          <ul class="serviceGallery__emptyList" aria-label="Листа на примери за полирање" />
        </div>
      </div>
    </section>

    <!-- About -->
    <section class="homeSection homeSection--dark homeAbout reveal" :ref="addRevealRef" id="about" aria-label="За нас">
      <div class="bs-container homeAbout__grid">
        <div class="homeAbout__content">
          <h2 class="homeSection__title homeSection__title--light">За нас</h2>
          <p class="homeSection__text homeSection__text--light">
            Со повеќе од 15 години искуство во лимарија и фарбарство, Дака Драган е доверлив избор
            за автомобилска поправка во Скопје. Работиме со современа опрема и проверени материјали.
          </p>
          <p class="homeSection__text homeSection__text--light">
            Кај нас секое возило добива индивидуален пристап — од првичниот преглед, преку
            изработката, до финалната контрола пред предавање.
          </p>
        </div>
        <div class="homeAbout__media" role="img" aria-label="About section placeholder image">
          <div class="homeAbout__placeholder" />
        </div>
      </div>
    </section>

    <!--
      <RepairGalleryStrip :images="repairGalleryImages" />
    -->

    <!-- Compact contact -->
    <section class="homeSection homeSection--dark homeContactCompact reveal" :ref="addRevealRef" id="contact" aria-label="Контакт">
      <div class="bs-container homeContactCompact__inner">
        <div class="homeContactCompact__text">
          <h2 class="homeSection__title homeSection__title--light">Контакт</h2>
          <p class="homeSection__text homeSection__text--light homeContactCompact__info">
            Тел: +389 78306981<br />
            Е-пошта: contact@daka-dragan.mk<br />
            Локација: Скопје
          </p>
          <div class="homeContactCompact__socials" aria-label="Социјални мрежи">
            <a class="bs-social-btn bs-social-btn--facebook" href="https://www.facebook.com/daka.dragan" target="_blank" rel="noopener noreferrer">
              <svg class="bs-social-btn__icon" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" fill="currentColor" stroke="none"/></svg>
              Facebook
            </a>
            <a class="bs-social-btn bs-social-btn--instagram" href="https://www.instagram.com/daka.dragan/" target="_blank" rel="noopener noreferrer">
              <svg class="bs-social-btn__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><path d="M17.5 6.5h.01"/></svg>
              Instagram
            </a>
          </div>
          <p class="homeContactCompact__jobs">
            Сакаш да работиш со нас? Испрати CV на
            <a class="bs-footer-link" href="mailto:contact@daka-dragan.mk">contact@daka-dragan.mk</a>
          </p>
        </div>

        <a
          class="homeContactCompact__mapWrap"
          href="https://maps.app.goo.gl/qQtdREAYwKx45PBk8"
          target="_blank"
          rel="noopener noreferrer"
        >
          <iframe
            class="homeContactCompact__map"
            src="https://www.google.com/maps?q=41.9587211,21.5177607&z=17&output=embed"
            title="Google Maps location"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          />
          <span class="homeContactCompact__mapOverlay">
            <svg class="homeContactCompact__mapIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Google Maps
          </span>
        </a>
      </div>
    </section>

    <Transition name="btt">
      <button
        v-show="showBackToTop"
        class="backToTop"
        type="button"
        aria-label="Врати се на почеток"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
      </button>
    </Transition>

    <SiteFooter />
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import SiteHeader from '../components/SiteHeader.vue'
import SiteFooter from '../components/SiteFooter.vue'
// import RepairGalleryStrip from '../components/RepairGalleryStrip.vue'

/** Thumbnails for the strip below About — add imports from ../../images/repair-gallery/ and list them here. */
// const repairGalleryImages = [/* add future gallery images here */]

const expandedExamples = ref({
  repair: false,
  paint: false,
  detailing: false
})

function toggleExamples(section) {
  expandedExamples.value[section] = !expandedExamples.value[section]
}

function scrollToSection(id) {
  const el = document.getElementById(id)
  if (!el) return
  el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

function scrollToContact() {
  scrollToSection('contact')
}

/* ── Back to top ── */
const showBackToTop = ref(false)

function handleScroll() {
  showBackToTop.value = window.scrollY > 600
}

/* ── Stats data ── */
const stats = [
  { value: 50, suffix: '+', label: 'Години искуство' },
  { value: 10000, suffix: '+', label: 'Поправени возила' },
  { value: 98, suffix: '%', label: 'Задоволни клиенти' },
  { value: 5, suffix: '★', label: 'Google оценка' }
]

const statNumbers = ref([])
let statsObserver = null
let statsCounted = false

function formatStatDigits(n) {
  return String(Math.round(n)).replace(/\B(?=(\d{3})+(?!\d))/g, '.')
}

function countUp(el, target, duration = 1600) {
  const start = performance.now()
  const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3)

  function tick(now) {
    const progress = Math.min((now - start) / duration, 1)
    const value = Math.round(easeOutCubic(progress) * target)
    el.textContent = formatStatDigits(value)
    if (progress < 1) requestAnimationFrame(tick)
  }
  requestAnimationFrame(tick)
}

/* ── Scroll reveal ── */
const revealEls = ref([])
let revealObserver = null

function addRevealRef(el) {
  if (el) revealEls.value.push(el)
}

onMounted(() => {
  revealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('reveal--visible')
          revealObserver.unobserve(e.target)
        }
      })
    },
    { threshold: 0.15 }
  )
  revealEls.value.forEach((el) => revealObserver.observe(el))

  /* Back to top scroll listener */
  handleScroll()
  window.addEventListener('scroll', handleScroll, { passive: true })

  /* Stats count-up observer */
  const statsSection = document.querySelector('.statsStrip')
  if (statsSection) {
    statsObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting && !statsCounted) {
            statsCounted = true
            document.querySelectorAll('.statsStrip__number').forEach((numEl) => {
              const target = parseInt(numEl.dataset.target, 10)
              countUp(numEl, target)
            })
            statsObserver.unobserve(e.target)
          }
        })
      },
      { threshold: 0.3 }
    )
    statsObserver.observe(statsSection)
  }
})

onUnmounted(() => {
  revealObserver?.disconnect()
  statsObserver?.disconnect()
  window.removeEventListener('scroll', handleScroll)
})
</script>

