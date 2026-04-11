import { createApp } from 'vue'
import App from './App.vue'
import './assets/styles.css'
import heroLcp from '../images/hero/4.webp?url'

/* Hint the browser to fetch the hero image early (large files still need compression). */
const preload = document.createElement('link')
preload.rel = 'preload'
preload.as = 'image'
preload.href = heroLcp
document.head.appendChild(preload)

createApp(App).mount('#app')

