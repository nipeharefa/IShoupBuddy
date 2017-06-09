import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const ProductIndex = () => import('vendor/components/product/index/index.vue')

const router = new Router({
  base: '/vendor',
  mode: 'history',
  routes: [
    { name: 'product-index', path: '/product', component: ProductIndex },
  ]
})

export default router
