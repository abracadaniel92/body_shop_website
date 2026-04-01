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
          <a class="bs-btn homeHero__cta" href="#services">Наши услуги</a>
          <a class="homeHero__ghost" href="#" @click.prevent="scrollToContact">Контакт</a>
        </div>
      </div>
    </section>

    <!-- Why choose us (3 cards only) -->
    <section class="homeSection homeSection--dark whyChooseSection" aria-label="Зошто да избереш">
      <div class="bs-container">
        <h2 class="homeSection__title homeSection__title--light">Зошто да избереш Дака Драган?</h2>
        <div class="whyChooseCards whyChooseCards--three" aria-label="Причини за избор">
          <article class="whyChooseCard">
            <span class="whyChooseCard__icon" aria-hidden="true">✓</span>
            <h3 class="whyChooseCard__title">Брза проценка</h3>
            <p class="whyChooseCard__text">
              Добиваш брза и прецизна проценка со јасен план на чекори, време за изработка и препорака за
              најдобро решение според состојбата на возилото.
            </p>
          </article>
          <article class="whyChooseCard">
            <span class="whyChooseCard__icon" aria-hidden="true">✓</span>
            <h3 class="whyChooseCard__title">Гарантиран квалитет</h3>
            <p class="whyChooseCard__text">
              Работиме со проверени материјали и контроли на секој чекор - од подготовка и боја, до финален
              преглед за да добиеш стабилен и уреден резултат.
            </p>
          </article>
          <article class="whyChooseCard">
            <span class="whyChooseCard__icon" aria-hidden="true">✓</span>
            <h3 class="whyChooseCard__title">Транспарентна цена</h3>
            <p class="whyChooseCard__text">
              Пред почеток добиваш јасна понуда со објаснети ставки, без скриени трошоци и со редовна
              комуникација ако има дополнителни работи.
            </p>
          </article>
        </div>
      </div>
    </section>

    <!-- Featured services (alternate image sides) -->
    <section class="homeSection homeSection--edge" id="services" aria-label="Услуги">
      <div class="bs-container homeSection__headingWrap">
        <h2 class="homeSection__title">Наши услуги</h2>
      </div>

      <!-- Service 1: media left -->
      <div class="bs-container serviceBlock" aria-label="Поправка на каросерија">
        <div class="homeSplit">
        <div class="homeSplit__media" role="img" aria-label="Поправка на каросерија">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s1" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Поправка на каросерија</h2>
          <p class="homeSection__text">
            Враќаме форма и изглед: од прецизна поправка до козметичко средување.
          </p>
          <div class="homeSplit__actions">
            <button class="serviceExamples__toggle" type="button" @click="toggleExamples('repair')">
              {{ expandedExamples.repair ? 'Сокриј галерија' : 'Види повеќе примери' }}
            </button>
            <a class="homeHero__ghost homeHero__ghost--light" href="#" @click.prevent="scrollToContact">
              Контактирај не
            </a>
          </div>
        </div>
        </div>
        <div class="serviceGallery" :class="{ 'serviceGallery--open': expandedExamples.repair }">
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
        </div>
      </div>

      <!-- Service 2: media right -->
      <div class="bs-container serviceBlock" aria-label="Боја и реновирање">
        <div class="homeSplit">
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Боја и реновирање</h2>
          <p class="homeSection__text">
            Боење со точна нијанса, внимателна подготовка и траен финиш.
          </p>
          <div class="homeSplit__actions">
            <button class="serviceExamples__toggle" type="button" @click="toggleExamples('paint')">
              {{ expandedExamples.paint ? 'Сокриј галерија' : 'Види повеќе примери' }}
            </button>
            <a class="homeHero__ghost homeHero__ghost--light" href="#" @click.prevent="scrollToContact">
              Побарај понуда
            </a>
          </div>
        </div>
        <div class="homeSplit__media" role="img" aria-label="Боја и реновирање">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s2" />
        </div>
        </div>
        <div class="serviceGallery" :class="{ 'serviceGallery--open': expandedExamples.paint }">
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
        </div>
      </div>

      <!-- Service 3: media left -->
      <div class="bs-container serviceBlock" aria-label="Деталинг">
        <div class="homeSplit">
        <div class="homeSplit__media" role="img" aria-label="Деталинг">
          <div class="homeSplit__mediaBg homeSplit__mediaBg--s3" />
        </div>
        <div class="homeSplit__content">
          <h2 class="homeSection__title">Деталинг</h2>
          <p class="homeSection__text">
            Чистење и средување на внатрешноста и надворешноста за „како нов“ изглед.
          </p>
          <div class="homeSplit__actions">
            <button class="serviceExamples__toggle" type="button" @click="toggleExamples('detailing')">
              {{ expandedExamples.detailing ? 'Сокриј галерија' : 'Види повеќе примери' }}
            </button>
            <a class="homeHero__ghost homeHero__ghost--light" href="#" @click.prevent="scrollToContact">
              Закажи термин
            </a>
          </div>
        </div>
        </div>
        <div class="serviceGallery" :class="{ 'serviceGallery--open': expandedExamples.detailing }">
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
          <div class="serviceExample serviceExample--golf" />
          <div class="serviceExample serviceExample--octavia" />
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
            Тел: +389 78306981<br />
            Е-пошта: contact@daka-dragan.mk<br />
            Локација: Скопје
          </p>
          <div class="homeContactCompact__socials" aria-label="Социјални мрежи">
            <a class="bs-social-btn bs-social-btn--facebook" href="https://facebook.com" target="_blank" rel="noopener noreferrer">
              Facebook
            </a>
            <a class="bs-social-btn bs-social-btn--instagram" href="https://instagram.com" target="_blank" rel="noopener noreferrer">
              Instagram
            </a>
          </div>
          <p class="homeContactCompact__jobs">
            Бараш работа? Испрати ни CV на
            <a class="bs-footer-link" href="mailto:contact@daka-dragan.mk">contact@daka-dragan.mk</a>
          </p>
        </div>

        <div class="homeContactCompact__mapWrap">
          <iframe
            class="homeContactCompact__map"
            src="https://www.google.com/maps?q=41.9579548,21.5260566&z=17&output=embed"
            title="Google Maps location"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          />
          <a
            class="homeContactCompact__mapLink"
            href="https://maps.app.goo.gl/HXhQvtusa8jPHecW8"
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
import { ref } from 'vue'
import SiteHeader from '../components/SiteHeader.vue'
import SiteFooter from '../components/SiteFooter.vue'

const expandedExamples = ref({
  repair: false,
  paint: false,
  detailing: false
})

function toggleExamples(section) {
  expandedExamples.value[section] = !expandedExamples.value[section]
}

function scrollToContact() {
  const el = document.getElementById('contact')
  if (!el) return
  el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}
</script>

