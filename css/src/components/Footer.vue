<template>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-content">
        <span class="footer-text">&copy; {{ year }} CENTAR SRBIJA STIL. All rights reserved.</span>
        <span class="footer-sep" aria-hidden="true">·</span>
        <span class="footer-credit">
          Made by <a href="https://gmojsoski.com/" target="_blank" rel="noopener noreferrer">Goce</a>
        </span>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
  computed: {
    year () {
      return new Date().getFullYear()
    }
  }
}
</script>

<style scoped>
.footer {
  width: 100%;
  max-width: 100vw;
  background: #000000;
  padding: 0.85rem 2rem;
  border-top: 1px solid rgba(255, 255, 255, 0.85);
  position: relative;
  margin: 0;
  box-sizing: border-box;
}

.footer-container {
  max-width: 100%;
  margin: 0 auto;
  width: 100%;
}

.footer-content {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: center;
  gap: 0.5rem 0.75rem;
  min-height: 0;
  line-height: 1.3;
  text-align: center;
}

.footer-text {
  font-size: 0.7rem;
  font-weight: 400;
  letter-spacing: 0.12em;
  color: #ffffff;
  text-transform: uppercase;
  font-family: 'Inter', sans-serif;
  opacity: 0.75;
  white-space: nowrap;
}

.footer-sep {
  color: #ffffff;
  opacity: 0.35;
  font-weight: 300;
  user-select: none;
  flex-shrink: 0;
}

.footer-credit {
  font-size: 0.65rem;
  font-weight: 400;
  letter-spacing: 0.04em;
  color: #ffffff;
  font-family: 'Inter', sans-serif;
  opacity: 0.6;
  text-transform: none;
  white-space: nowrap;
}

.footer-credit a {
  color: #ffffff;
  text-decoration: underline;
  text-underline-offset: 3px;
  transition: opacity 0.2s ease;
}

.footer-credit a:hover {
  opacity: 0.85;
}

@media (max-width: 640px) {
  .footer {
    padding: 0.75rem 0.75rem;
  }

  .footer-text {
    font-size: 0.58rem;
    letter-spacing: 0.08em;
  }

  .footer-credit {
    font-size: 0.55rem;
  }

  .footer-content {
    gap: 0.35rem 0.5rem;
  }
}
</style>
