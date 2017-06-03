import Vue from 'vue'
import Router from 'vue-router'

const TransactionIndex = () => System.import('adminComponents/transactions/index/TableTransactions.vue')
const TransactionDetail = () => System.import('adminComponents/transactions/show/Show.vue')

Vue.use(Router)

const router = new Router({
  base: '/',
  mode: 'history',
  routes: [
    { name: 'listTransaction', path: '/admin/transactions', component: TransactionIndex },
    { name: 'detailTransaction', path: '/admin/transactions/:id', component: TransactionDetail }
  ]
})

export default router
