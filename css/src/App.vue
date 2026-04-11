<template>
  <div id="app">
    <CustomCursor />
    <div class="app-wrapper">
      <Navigation />
      <HeroSection />
      <PageMarquee />
      <NewsSection />
      <ToursSection />
      <SoundCloudSection />
      <!-- MerchSection: restore when ready -->
      <!-- <MerchSection /> -->
      <AboutSection />
      <ContactSection />
      <Footer />
      <ScrollToTop />
    </div>
  </div>
</template>

<script>
import Navigation from './components/Navigation.vue'
import HeroSection from './components/HeroSection.vue'
import PageMarquee from './components/PageMarquee.vue'
import ToursSection from './components/ToursSection.vue'
import NewsSection from './components/NewsSection.vue'
import SoundCloudSection from './components/SoundCloudSection.vue'
// import MerchSection from './components/MerchSection.vue'
import AboutSection from './components/AboutSection.vue'
import ContactSection from './components/ContactSection.vue'
import Footer from './components/Footer.vue'
import ScrollToTop from './components/ScrollToTop.vue'
import CustomCursor from './components/CustomCursor.vue'

export default {
  name: 'App',
  components: {
    Navigation,
    HeroSection,
    PageMarquee,
    ToursSection,
    NewsSection,
    SoundCloudSection,
    // MerchSection,
    AboutSection,
    ContactSection,
    Footer,
    ScrollToTop,
    CustomCursor
  }
}
</script>
