import { createApp } from 'vue'
import { createPinia } from 'pinia'
import './style.css'
import app from './App.vue'

import router from './router'

const pinia = createPinia()

createApp(app)
    .use(pinia)
    .use(router)
    .mount('#app')
