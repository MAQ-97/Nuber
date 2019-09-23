import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.config.productionTip = false


Vue.use(VueRouter)

import Dashboard from './components/Dashboard.vue';
import bookings from './components/bookings.vue';

const routes = [
  { path: '/', component: bookings },
]

const router = new VueRouter({
  mode: 'history',
  routes
})

new Vue({
  router,
  render: h => h(Dashboard)
}).$mount('#app')