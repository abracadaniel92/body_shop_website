<template>
  <ScrollReveal tag="section" id="music" class="soundcloud-section">
    <div class="soundcloud-container">
      <div class="section-heading app-section-heading soundcloud-header">
        <div class="section-number section-number-animated">VOL.03</div>
        <h2 class="section-title section-title-animated">MUSIC</h2>
      </div>

      <div class="music-layout">
        <div class="music-text-wrapper">
          <div class="music-filter-text">
            <p class="filter-paragraph">
              RAW STREET HIP-HOP—UNFILTERED. CENTAR SRBIJA STIL: TRADITION MEETS INNOVATION, NO COMPROMISES.
              STREAM THE SOUND AND FOLLOW US BELOW.
            </p>
          </div>

          <div class="music-find-us">
            <h3 class="music-find-us__title">FIND US</h3>
            <div class="music-find-us__row">
              <a
                href="https://soundcloud.com/centarsrbijastil"
                class="music-find-us__link"
                target="_blank"
                rel="noopener noreferrer"
              >
                <span class="music-find-us__name">SoundCloud</span>
                <span class="music-find-us__icon">
                  <img
                    class="music-find-us__img"
                    src="../../images/socials/SoundCloud-Logo.png"
                    alt=""
                    width="120"
                    height="120"
                    loading="lazy"
                    decoding="async"
                  />
                </span>
              </a>
              <a
                href="https://open.spotify.com/artist/4dur7AB1HikS4beheEbvrx"
                class="music-find-us__link"
                target="_blank"
                rel="noopener noreferrer"
              >
                <span class="music-find-us__name">Spotify</span>
                <span class="music-find-us__icon">
                  <img
                    class="music-find-us__img"
                    src="../../images/socials/Spotify_logo_with_text.svg.png"
                    alt=""
                    width="120"
                    height="120"
                    loading="lazy"
                    decoding="async"
                  />
                </span>
              </a>
              <a
                href="https://www.youtube.com/@centarsrbijastil/featured"
                class="music-find-us__link"
                target="_blank"
                rel="noopener noreferrer"
              >
                <span class="music-find-us__name">YouTube</span>
                <span class="music-find-us__icon">
                  <img
                    class="music-find-us__img"
                    src="../../images/socials/Youtube_logo.png"
                    alt=""
                    width="120"
                    height="120"
                    loading="lazy"
                    decoding="async"
                  />
                </span>
              </a>
            </div>
          </div>
        </div>

        <div class="music-player-wrapper">
          <div class="music-player music-player--youtube">
            <iframe
              class="music-player__iframe"
              title="YouTube video player"
              width="560"
              height="315"
              frameborder="0"
              loading="lazy"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen
              :src="youtubeEmbedSrc"
            />
          </div>
        </div>
      </div>
    </div>
  </ScrollReveal>
</template>

<script>
import { CONFIG } from '../utils/config'
import ScrollReveal from './ScrollReveal.vue'

export default {
  name: 'SoundCloudSection',
  components: { ScrollReveal },
  setup () {
    return {
      youtubeEmbedSrc: CONFIG.youtubeEmbedSrc
    }
  }
}
</script>

<style scoped>
.soundcloud-section {
  min-height: auto;
  width: 100%;
  max-width: 100vw;
  background: #0a0a0a;
  padding: 5rem 4rem 2.5rem;
  position: relative;
  margin: 0;
  box-sizing: border-box;
}

.soundcloud-container {
  max-width: 100%;
  margin: 0 auto;
  width: 100%;
  display: flex;
  flex-direction: column;
}

.soundcloud-header {
  margin-bottom: 1.25rem;
}

.section-heading {
  display: flex;
  align-items: baseline;
  gap: 2rem;
  border-bottom: 2px solid #ffffff;
  padding-bottom: 1rem;
  width: 100%;
}

.section-number {
  font-size: clamp(0.9rem, 1.5vw, 1.2rem);
  font-weight: 700;
  letter-spacing: 4px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  opacity: 0.7;
  transition: color 0.25s ease;
}

.app-section-heading:hover .section-number {
  color: var(--accent-red, #e63946);
}

.section-title {
  font-size: clamp(2.5rem, 6vw, 5rem);
  font-weight: 900;
  letter-spacing: -2px;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  font-stretch: condensed;
  line-height: 1;
  margin: 0;
}

.music-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(3.5rem, 5vw, 7rem);
  margin-top: 0;
  align-items: stretch;
  width: 100%;
}

.music-text-wrapper {
  width: 100%;
  grid-column: 1;
  padding-left: 10%;
  padding-right: clamp(1.5rem, 2.5vw, 3rem);
  display: flex;
  flex-direction: column;
  min-height: 0;
}

.music-filter-text {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  max-width: 90%;
  flex-shrink: 0;
}

.filter-paragraph {
  font-size: clamp(0.9rem, 1.2vw, 1.1rem);
  font-weight: 400;
  line-height: 1.8;
  color: #cccccc;
  font-family: 'Inter', sans-serif;
  margin: 0;
  text-align: justify;
  letter-spacing: 0.5px;
}

.music-find-us {
  margin-top: 1.75rem;
  padding-top: 1.25rem;
  border-top: 1px solid rgba(255, 255, 255, 0.15);
  max-width: 90%;
  text-align: center;
  align-self: center;
  width: 100%;
  box-sizing: border-box;
}

@media (min-width: 969px) and (max-width: 1199px) {
  .music-find-us {
    margin-top: auto;
  }
}

.music-find-us__title {
  font-size: clamp(0.75rem, 1vw, 0.88rem);
  font-weight: 700;
  letter-spacing: 0.28em;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.75;
  margin: 0 0 1.25rem;
  text-align: center;
}

.music-find-us__row {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-start;
  justify-content: center;
  gap: 1.5rem 2.25rem;
}

.music-find-us__link {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.65rem;
  text-decoration: none;
  color: #ffffff;
  transition: color 0.25s ease;
}

.music-find-us__link:hover {
  color: var(--accent-red, #e63946);
}

.music-find-us__link:hover .music-find-us__icon {
  border-color: var(--accent-red, #e63946);
  background: rgba(230, 57, 70, 0.18);
  box-shadow:
    0 6px 22px rgba(0, 0, 0, 0.35),
    0 0 0 1px rgba(230, 57, 70, 0.3);
}

.music-find-us__name {
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.9;
}

.music-find-us__icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: clamp(5rem, 9vw, 6.75rem);
  height: clamp(5rem, 9vw, 6.75rem);
  padding: 0.65rem;
  border: 1px solid rgba(255, 255, 255, 0.35);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.08);
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
  transition:
    border-color 0.25s ease,
    background 0.25s ease,
    box-shadow 0.25s ease;
}

.music-find-us__img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
  pointer-events: none;
}

.music-player-wrapper {
  width: 100%;
  grid-column: 2;
  padding-right: 10%;
  padding-left: clamp(1.5rem, 2.5vw, 3rem);
}

.music-player--youtube {
  background: #0a0a0a;
  border: 2px solid #ffffff;
  padding: 0;
  width: 100%;
  overflow: hidden;
  transition:
    border-color 0.4s ease,
    box-shadow 0.4s ease;
  aspect-ratio: 16 / 10;
  min-height: 260px;
  max-height: min(52vh, 520px);
}

.music-player--youtube:hover {
  border-color: var(--accent-red, #e63946);
  box-shadow: 0 0 0 1px rgba(230, 57, 70, 0.25);
}

.music-player__iframe {
  display: block;
  width: 100%;
  height: 100%;
  border: none;
  vertical-align: top;
}

/* Large screens: tighter section, text+icons stacked close, smaller video */
@media (min-width: 1200px) {
  .soundcloud-section {
    padding: 3.5rem clamp(1.75rem, 4vw, 3.5rem) 1.75rem;
  }

  .soundcloud-header {
    margin-bottom: 0.75rem;
  }

  .music-layout {
    gap: clamp(2.25rem, 3.5vw, 4rem);
    align-items: start;
  }

  /* Center copy + Find us as one column (same width, shared horizontal center) */
  .music-text-wrapper {
    align-items: center;
  }

  .music-filter-text {
    align-self: center;
    width: 100%;
  }

  .music-find-us {
    margin-top: 0.6rem;
    padding-top: 0.7rem;
    align-self: center;
  }

  .music-find-us__title {
    margin-bottom: 0.6rem;
  }

  .music-find-us__link {
    gap: 0.5rem;
  }

  .music-find-us__icon {
    width: clamp(4rem, 4.8vw, 5.25rem);
    height: clamp(4rem, 4.8vw, 5.25rem);
    padding: 0.5rem;
  }

  .music-find-us__row {
    gap: 1.1rem 1.75rem;
    justify-content: center;
  }

  .music-player-wrapper {
    max-width: min(576px, 100%);
    justify-self: start;
    padding-top: 1rem;
  }

  /* +20% vs prior large-screen caps (480px / 340px / 176px) */
  .music-player--youtube {
    max-height: min(40.8vh, 408px);
    min-height: 211px;
  }
}

@media (min-width: 1600px) {
  .soundcloud-section {
    padding: 4rem clamp(2rem, 5vw, 4rem) 2rem;
  }

  .music-player-wrapper {
    max-width: min(624px, 100%);
    padding-top: 1.125rem;
  }

  .music-player--youtube {
    max-height: min(43.2vh, 456px);
  }
}

@media (max-width: 968px) {
  .soundcloud-section {
    padding: 4rem 2rem 2.5rem;
  }

  .section-heading {
    flex-direction: column;
    gap: 1rem;
  }

  .music-layout {
    grid-template-columns: 1fr;
    gap: 3rem;
  }

  .music-text-wrapper {
    grid-column: 1;
    padding-left: 0;
    padding-right: 0;
  }

  .music-find-us {
    max-width: 100%;
    text-align: center;
  }

  .music-find-us__row {
    justify-content: center;
  }

  .music-player-wrapper {
    grid-column: 1;
    padding-right: 0;
    padding-left: 0;
  }

  .music-player--youtube {
    min-height: 220px;
    max-height: none;
    aspect-ratio: 16 / 9;
  }
}
</style>
