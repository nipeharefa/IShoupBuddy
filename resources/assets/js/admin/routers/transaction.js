import Vue from 'vue'
import Router from 'vue-router'

const TransactionIndex = () => System.import('adminComponents/transactions/index/TableTransactions.vue')
const TransactionDetail = () => System.import('adminComponents/transactions/show/Show.vue')
const TableVendor = () => System.import('adminComponents/vendor/index/TableVendor')
const FormAddProduct = () => System.import('adminProduct/create/FormAddProduct.vue')
const ProductIndex = () => import('adminComponents/product/index/ProductIndex.vue')

Vue.use(Router)

const router = new Router({
  base: '/',
  mode: 'history',
  routes: [
    { name: 'listTransaction', path: '/admin/transactions', component: TransactionIndex },
    { name: 'detailTransaction', path: '/admin/transactions/:id', component: TransactionDetail },
    { name: 'listVendor', path: '/admin/vendor/', component: TableVendor },
    { name: 'formAddProduct', path: '/admin/product/create', component: FormAddProduct },
    { name: 'listProducts', path: '/admin/product', component: ProductIndex }
  ]
})

export default router
