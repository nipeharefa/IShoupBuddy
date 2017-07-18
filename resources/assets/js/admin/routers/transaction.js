import Vue from 'vue'
import Router from 'vue-router'

const TransactionIndex = () => System.import('adminComponents/transactions/index/TableTransactions.vue')
const TransactionDetail = () => System.import('adminComponents/transactions/show/Show.vue')
const TableVendor = () => System.import('adminComponents/vendor/index/TableVendor')
const FormAddProduct = () => System.import('adminProduct/create/FormAddProduct.vue')
const ProductIndex = () => import('adminComponents/product/index/ProductIndex.vue')
const ProductEdit = () => import('adminComponents/product/edit/ProductEdit.vue')
const UserIndex = () => import('adminComponents/users/index/UserIndex.vue')
const UserShow = () => import('adminComponents/users/show/Show.vue')
const Reviewindex = () => import('adminComponents/reviews/index/index.vue')
const Dashboard = () => import('adminComponents/dashboard/index/index.vue')
const CategoryIndex = () => import('adminComponents/category/index/index.vue')
const FormAddCategory = () => import('adminComponents/category/store/store.vue')
const FormEditCategory = () => import('adminComponents/category/edit/FormEditCategory.vue')
const TopupList = () => import('adminComponents/topup/TopUp.vue')

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
    { name: 'showUser', path: '/admin/users/:id', component: UserShow },
    { name: 'listReview', path: '/admin/reviews', component: Reviewindex },
    { name: 'dashboard', path: '/admin/', component: Dashboard },
    { name: 'listCategory', path: '/admin/category', component: CategoryIndex },
    { name: 'formAddCategory', path: '/admin/category/create', component: FormAddCategory },
    { name: 'formEditCategory', path: '/admin/category/:id/edit', component: FormEditCategory },
    { name: 'listTopup', path: '/admin/topup', component: TopupList }
  ]
})

export default router
