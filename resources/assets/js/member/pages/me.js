import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import CartCounter from 'lib/CartCounter'
import VueProgressBar from 'vue-progressbar'
import router from 'member/routers/me'
import store from 'member/store/me'
import VeeValidate from 'vee-validate'
import { sync } from 'vuex-router-sync'
import { mapActions } from 'vuex'
import VueEcho from 'lib/echo-pusher-plugin'
import ImageUploader from 'lib/imageuploader'
import VueLazyload from 'vue-lazyload'
import clickOutside from 'lib/click-outside.js'

Vue.use(VueProgressBar, { color: 'rgb(26, 146, 47)', failedColor: 'red', height: '3px' })
Vue.use(VueAxios)
Vue.use(VeeValidate)
Vue.use(VueEcho)
Vue.use(ImageUploader)
Vue.use(CartCounter)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)

sync(store, router)

const App = r => require.ensure([], () => r(require('member/views/Me.vue')), 'group-member-me')

const app = new Vue({
  render: h => h(App),
  router,
  store,
  created () {
    this.initAllData()
  },
  methods: {
    ...mapActions([
      'initActiveUser',
      'initTransactions',
      'initWishlists',
      'initCategories',
      'initSaldoTransactions'
    ]),
    initAllData () {
      this.initActiveUser(window._sharedData.user)
      this.getTransactions()
      this.getWishlist()
      this.getCategories()
      this.getSaldoTransactions()
    },
    getWishlist () {
      this.$http.get('api/wishlist').then(response => {
        this.initWishlists(response.data.wishlist)
      }).catch(err => err)
    },
    getCategories () {
      this.$http.get('api/category').then(response => {
        this.initCategories(response.data.categories)
      }).catch(err => err)
    },
    getTransactions () {
      const id = window._sharedData.user.id
      this.$http.get(`api/user/${id}/transactions`).then(response => {
        this.initTransactions(response.data)
      }).catch(err => err)
    },
    getSaldoTransactions () {
      const id = window._sharedData.user.id
      this.$http.get(`api/user/${id}/saldo/transactions`).then(response => {
        this.initSaldoTransactions(response.data)
      }).catch(err => err)
    }
  }
})

router.onReady(() => {
  app.$mount('#app')
})

