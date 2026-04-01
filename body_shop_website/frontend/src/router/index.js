import { createRouter, createWebHashHistory } from 'vue-router'

import ComingSoon from '../pages/ComingSoon.vue'

export const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    { path: '/', name: 'comingSoon', component: ComingSoon },
    { path: '/:pathMatch(.*)*', redirect: '/' }
  ]
})

