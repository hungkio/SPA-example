import Vue from 'vue'
import App from './App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.config.productionTip = false

// import vue router
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Login from './components/login'
import Register from './components/register'
import Dashboard from './components/dashboard'
import Home from './components/Home'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
const routes = [
  { path: '/', component: Home, name: 'home' },
  { path: '/login', component: Login, name: 'login' },
  { path: '/register', component: Register },
  { path: '/dashboard', component: Dashboard, name: 'dashboard' },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history'
})

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
