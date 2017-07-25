import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


const SummaryProfile = () => import('member/components/me/SummaryProfile.vue')
const FormChangePassword = () => import('member/components/change_password/FormChangePassword')
const TableTransaction = () => import('member/components/transactions/TableTransaction.vue')
const DetailTransaction = () => import('member/components/show_transaction/ShowTransaction.vue')
const FormEditProfile = () => import('member/components/edit-profile/FormEditProfile.vue')
const ProductFavorite = () => import('member/components/product_favorite/ProductFavorite.vue')
const TableSaldo = () => import('member/components/Saldo/Saldo.vue')
const SaldoDetail = () => import('member/components/Saldo/SaldoDetail.vue')

const router = new Router({
  base: '/me',
  mode: 'history',
  routes: [
    { name: 'summaryProfile', path: '/', component: SummaryProfile },
    { name: 'formChangePassword', path: '/change_password', component: FormChangePassword },
    { name: 'detailTransaction', path: '/transactions/:id', component: DetailTransaction },
    { name: 'tableTransaction', path: '/transactions', component: TableTransaction },
    { name: 'formEditProfile', path: '/edit', component: FormEditProfile },
    { name: 'productFavorite', path: '/wishlist', component: ProductFavorite },
    { name: 'detailSaldo', path: '/saldo/:id', component: SaldoDetail },
    { name: 'tableSaldo', path: '/saldo', component: TableSaldo }
  ]
})

export default router
