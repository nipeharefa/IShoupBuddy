import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueProgressBar from 'vue-progressbar'
import VeeValidate from 'vee-validate'
import router from 'vendor/routers'
import { sync } from 'vuex-router-sync'
import store from 'vendor/store/product-index'
import ImageUploader from 'lib/imageuploader'

Vue.use(VueAxios)
Vue.use(VueProgressBar, { color: 'rgb(26, 146, 47)', failedColor: 'red', height: '3px' })
Vue.use(VeeValidate)
Vue.use(ImageUploader)

sync(store, router)

const App = r => require.ensure([], () => r(require('vendor/views/Main.vue')), 'views-vendor')

import { mapActions } from 'vuex'

const app = new Vue({
  store,
  router,
  render: h => h(App),
  created () {
    this.initActiveUser(window._sharedData.user)
    this.getOwnProducts()
    this.getProducts()
    this.getReviews()
  },
  methods: {
    ...mapActions([
      'initActiveUser',
      'initProducts',
      'initOwnProducts',
      'initReviews'
    ]),
    getProducts () {
      this.$http.get('api/vendor/product').then(response => {
        this.initProducts(response.data.products)
      })
    },
    getOwnProducts () {
      this.$http.get('api/vendor/product?type=own').then(response => {
        this.initOwnProducts(response.data.products)
      })
    },
    getReviews () {
      this.$http.get('api/vendor/review', []).then(response => {
        this.initReviews(response.data)
      }).catch(err => err)
    }
  }
})

router.onReady(() => {
  app.$mount('#app')
})
