import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const ProductIndex = () => import('vendor/components/product/index/index.vue')
const ChangeProfile = () => import('vendor/components/profile/change_profile.vue')
const ReviewIndex = () => import('vendor/components/review/index/index.vue')
const TransactionIndex = () => import('vendor/components/transaction/index/index.vue')
const Dashboard = () => import('vendor/components/dashboard/Dashboard.vue')

const router = new Router({
  base: '/vendor',
  mode: 'history',
  routes: [
    { name: 'dashboard', path: '/', component: Dashboard },
    { name: 'product-index', path: '/product', component: ProductIndex },
    { name: 'change-profile', path: '/change_profile', component: ChangeProfile },
    { name: 'review-index', path: '/review', component: ReviewIndex },
    { name: 'transaction-index', path: '/transaction', component: TransactionIndex },
  ]
})

export default router
