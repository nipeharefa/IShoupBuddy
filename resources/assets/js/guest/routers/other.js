import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

const About = () => import('global/components/other/About.vue')

const router = new Router({
  base: '/about',
  mode: 'history',
  routes: [
    { name: 'about', path: '/', component: About },
  ]
})

export default router
