import { createRouter, createWebHashHistory } from 'vue-router'

import Home from '../pages/Home.vue'
import Gallery from '../pages/Gallery.vue'
import BlogList from '../pages/BlogList.vue'
import BlogPost from '../pages/BlogPost.vue'

export const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    { path: '/', name: 'home', component: Home },
    { path: '/gallery', name: 'gallery', component: Gallery },
    { path: '/blog', name: 'blog', component: BlogList },
    { path: '/blog/:slug', name: 'blogPost', component: BlogPost, props: true }
  ]
})

