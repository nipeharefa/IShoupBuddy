import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueProgressBar from 'vue-progressbar'
import router from 'admin/routers/transaction'
import store from 'admin/store/transaction-index'
import { sync } from 'vuex-router-sync'
import clickOutside from 'lib/click-outside.js'

sync(store, router)

import { mapActions } from 'vuex'
Vue.directive('click-outside', clickOutside)

import Raven from 'raven-js'
import RavenVue from 'raven-js/plugins/vue'

Raven
  .config('https://6d1ae4151da84747afc17265d8ca9d2b@sentry.io/180639')
  .addPlugin(RavenVue, Vue)
  .install()

const App = r => require.ensure([], () => r(require('adminComponents/transactions/views/Main.vue')), 'group-foo')

Vue.use(VueProgressBar, { color: 'rgb(26, 146, 47)', failedColor: 'red', height: '3px' })
Vue.use(VueAxios)

Vue.config.devtools = true

const app = new Vue({
  render: h => h(App),
  router,
  store,
  created () {
    this.getTransactions()
    this.getProducts()
    this.getVendors()
    this.getUsers()
    this.getCategory()
    this.initActiveUser(window._sharedData.user)
    this.getReview()
    this.getReportReview()
  },
  methods: {
    ...mapActions([
      'initTransactions',
      'initProducts',
      'initVendors',
      'initUsers',
      'initCategories',
      'initActiveUser',
      'initReviews',
      'initReportReviews'
    ]),
    getTransactions () {
      this.$http.get('api/admin/transaction').then(response => {
        this.transaction = response.data.transactions
        this.initTransactions(response.data.transactions)
      }).catch(err => err)
    },
    getProducts () {
      this.$http.get('api/admin/product').then(response => {
        this.initProducts(response.data.products)
      }).catch(err => err)
    },
    getVendors () {
      this.$http.get('api/admin/vendor').then(response => {
        this.initVendors(response.data.vendors)
      }).catch(err => err)
    },
    getUsers () {
      this.$http.get('api/admin/user').then(response => {
        this.initUsers(response.data.users)
      }).catch(err => err)
    },
    getCategory () {
      this.$http.get('api/admin/category').then(response => {
        const category = response.data.categories.sort((a, b) => {
          return a.id - b.id
        })
        this.initCategories(category)
      })
    },
    getReview () {
      this.$http.get('api/admin/review').then(response => {
        this.initReviews(response.data.reviews)
      }).catch(err => err)
    },
    getReportReview () {
      this.$http.get('api/report').then(response => {
        console.log(response.data)
        this.initReportReviews(response.data.reports)
      }).catch(err => err)
    }
  }
})

router.onReady(() => {
  app.$mount('#app')
})
