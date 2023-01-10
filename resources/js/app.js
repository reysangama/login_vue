import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './router'
import VueProgressBar from 'vue-progressbar'
import Notifications from '@kyvg/vue3-notification'
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'left',
    inverse: false
  }
const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router,VueProgressBar,options)
app.use(Notifications)
app.mount('#app')