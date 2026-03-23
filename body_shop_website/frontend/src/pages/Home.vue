<template>
  <div class="bs-page">
    <SiteHeader />

    <!-- Hero (full-bleed dark) -->
    <section class="homeHero">
      <div class="homeHero__overlay" />
      <div class="bs-container homeHero__inner">
        <p class="homeHero__kicker">Дака Драган • Авто поправка и боја</p>
        <h1 class="homeHero__title">Додели му нова шанса на живот на твоето возило</h1>
        <p class="homeHero__subtitle">
          Поправка на каросерија, лакирање, деталинг и реставрација со доверлива изработка.
        </p>
        <div class="homeHero__actions">
          <router-link class="bs-btn homeHero__cta" to="/gallery">
            Погледни пред/после
          </router-link>
          <a class="homeHero__ghost" href="#" @click.prevent="scrollToContact">Контакт</a>
        </div>
      </div>
    </section>

    <!-- Split section ("Why choose ...") -->
    <section class="homeSection homeSection--dark homeSection--wide" aria-label="Зошто да избереш">
      <div class="bs-container homeSplit">
        <div class="homeSplit__media" role="img" aria-label="Преглед на нашата работа">
          <div class="homeSplit__mediaBg" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title homeSection__title--light">Зошто да избереш Дака Драган?</h2>
          <p class="homeSection__text homeSection__text--light">
            Основано од љубители на автомобили, Дака Драган е млад тим со фокус на квалитет и посветен процес за секоја нарачка.
          </p>
          <p class="homeSection__text homeSection__text--light">
            Работиме преку целата постапка: подготовка, боја, деталинг и финална контрола—за резултат на кој ќе му се радуваш.
          </p>
          <div class="homeSplit__actions">
            <router-link class="homeHero__ghost homeHero__ghost--light" to="/blog">
              Прочитај го нашиот блог
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured services (alternate image sides) -->
    <section class="homeSection homeSection--edge" id="services" aria-label="Услуги">
      <div class="bs-container homeSection__headingWrap">
        <h2 class="homeSection__title">Наши услуги</h2>
      </div>

      <!-- Service 1: media left -->
      <div class="bs-container homeSplit" aria-label="Поправка на каросерија">
        <div class="homeSplit__media" role="img" aria-label="Поправка на каросерија">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s1" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Поправка на каросерија</h2>
          <p class="homeSection__text">
            Враќаме форма и изглед: од прецизна поправка до козметичко средување.
          </p>
          <div class="homeSplit__actions">
            <router-link class="homeHero__ghost homeHero__ghost--light" to="/gallery">
              Погледни пред/после
            </router-link>
          </div>
        </div>
      </div>

      <!-- Service 2: media right -->
      <div class="bs-container homeSplit" aria-label="Боја и реновирање">
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Боја и реновирање</h2>
          <p class="homeSection__text">
            Боење со точна нијанса, внимателна подготовка и траен финиш.
          </p>
          <div class="homeSplit__actions">
            <router-link class="homeHero__ghost homeHero__ghost--light" to="/gallery">
              Погледни резултати
            </router-link>
          </div>
        </div>
        <div class="homeSplit__media" role="img" aria-label="Боја и реновирање">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s2" />
        </div>
      </div>

      <!-- Service 3: media left -->
      <div class="bs-container homeSplit" aria-label="Деталинг">
        <div class="homeSplit__media" role="img" aria-label="Деталинг">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s3" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Деталинг</h2>
          <p class="homeSection__text">
            Чистење и средување на внатрешноста и надворешноста за „како нов“ изглед.
          </p>
          <div class="homeSplit__actions">
            <router-link class="homeHero__ghost homeHero__ghost--light" to="/blog">
              Прочитај повеќе
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section class="homeSection homeSection--dark homeAbout" id="about" aria-label="За нас">
      <div class="bs-container homeAbout__grid">
        <div class="homeAbout__content">
          <h2 class="homeSection__title homeSection__title--light">За нас</h2>
          <p class="homeSection__text homeSection__text--light">
            Дака Драган е авто-работилница со фокус на чиста изработка, јасен процес и почитување на рокови.
            Комбинираме рачна прецизност со модерни техники за каросерија, боја и деталинг.
          </p>
          <p class="homeSection__text homeSection__text--light">
            Секој проект го третираме како да е наш автомобил - од прва проценка до финална предавачка
            контрола.
          </p>
        </div>
        <div class="homeAbout__media" role="img" aria-label="About section placeholder image">
          <div class="homeAbout__placeholder" />
        </div>
      </div>
    </section>

    <!-- Compact contact -->
    <section class="homeSection homeSection--dark homeContactCompact" id="contact" aria-label="Контакт">
      <div class="bs-container homeContactCompact__inner">
        <div class="homeContactCompact__text">
          <h2 class="homeSection__title homeSection__title--light">Контакт</h2>
          <p class="homeSection__text homeSection__text--light homeContactCompact__info">
            Тел: +389 70 000 000<br />
            Е-пошта: info@dakadragan.mk<br />
            Локација: Скопје
          </p>
        </div>

        <div class="homeContactCompact__mapWrap">
          <iframe
            class="homeContactCompact__map"
            src="https://www.google.com/maps?q=41.958434,21.521560&z=17&output=embed"
            title="Google Maps location"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          />
          <a
            class="homeContactCompact__mapLink"
            href="https://maps.app.goo.gl/185GGsCDFxyaJCSw7"
            target="_blank"
            rel="noopener noreferrer"
          >
            Open in Google Maps
          </a>
        </div>
      </div>
    </section>

    <SiteFooter />
  </div>
</template>

<script setup>
import SiteHeader from '../components/SiteHeader.vue'
import SiteFooter from '../components/SiteFooter.vue'

function scrollToContact() {
  const el = document.getElementById('contact')
  if (!el) return
  el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}
</script>

