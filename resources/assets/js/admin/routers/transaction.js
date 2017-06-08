import Vue from 'vue'
import Router from 'vue-router'

const TransactionIndex = () => System.import('adminComponents/transactions/index/TableTransactions.vue')
const TransactionDetail = () => System.import('adminComponents/transactions/show/Show.vue')
const TableVendor = () => System.import('adminComponents/vendor/index/TableVendor')
const FormAddProduct = () => System.import('adminProduct/create/FormAddProduct.vue')
const ProductIndex = () => import('adminComponents/product/index/ProductIndex.vue')
const ProductEdit = () => import('adminComponents/product/edit/ProductEdit.vue')
const UserIndex = () => import('adminComponents/users/index/UserIndex.vue')

Vue.use(Router)

const router = new Router({
  base: '/',
  mode: 'history',
  routes: [
    { name: 'listTransaction', path: '/admin/transactions', component: TransactionIndex },
    { name: 'detailTransaction', path: '/admin/transactions/:id', component: TransactionDetail },
    { name: 'listVendor', path: '/admin/vendor/', component: TableVendor },
    { name: 'formAddProduct', path: '/admin/product/create', component: FormAddProduct },
    { name: 'listProducts', path: '/admin/product', component: ProductIndex, title: 'Vendor' },
    { name: 'formEditProduct', path: '/admin/product/:id/edit', component: ProductEdit },
    { name: 'listUser', path: '/admin/users', component: UserIndex },
  ]
})

export default router
