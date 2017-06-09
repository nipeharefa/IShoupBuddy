import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueProgressBar from 'vue-progressbar'
import VeeValidate from 'vee-validate'
import router from 'vendor/routers'
import { sync } from 'vuex-router-sync'
import store from 'vendor/store/product-index'

Vue.use(VueAxios)
Vue.use(VueProgressBar, { color: 'rgb(26, 146, 47)', failedColor: 'red', height: '3px' })
Vue.use(VeeValidate)

sync(store, router)

const App = r => require.ensure([], () => r(require('vendor/views/Main.vue')), 'views-vendor')

import { mapActions } from 'vuex'

const app = new Vue({
  store,
  router,
  render: h => h(App),
  created () {
    this.initActiveUser(window._sharedData.user)
  },
  methods: {
    ...mapActions([
      'initActiveUser'
    ])
  }
})

router.onReady(() => {
  app.$mount('#app')
})
