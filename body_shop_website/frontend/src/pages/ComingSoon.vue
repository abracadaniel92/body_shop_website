<template>
  <main class="comingSoon">
    <div class="comingSoon__card">
      <img class="comingSoon__logo" src="/logo.png" alt="Дака Драган" />
      <h1 class="comingSoon__title">Наскоро</h1>
      <p class="comingSoon__text">
        Работиме на новата веб страница. Закажување и информации наскоро.
      </p>
    </div>
  </main>
</template>

<style scoped>
.comingSoon {
  min-height: 100vh;
  display: grid;
  place-items: center;
  background: linear-gradient(180deg, #090d17 0%, #0e1118 100%);
  padding: 24px;
}

.comingSoon__card {
  width: min(680px, 100%);
  border: 1px solid rgba(255, 255, 255, 0.16);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.03);
  padding: 30px 22px;
  text-align: center;
}

.comingSoon__logo {
  max-width: 220px;
  width: 100%;
  height: auto;
  margin-bottom: 16px;
}

.comingSoon__title {
  margin: 0 0 10px;
  font-size: clamp(1.8rem, 4vw, 2.5rem);
  letter-spacing: 0.03em;
  text-transform: uppercase;
  color: #f5f5f7;
}

.comingSoon__text {
  margin: 0;
  color: rgba(245, 245, 247, 0.9);
  line-height: 1.6;
}
</style>
