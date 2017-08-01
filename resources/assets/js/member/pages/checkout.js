import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueEcho from 'lib/echo-pusher-plugin'
import CartCounter from 'lib/CartCounter'
// import GetCategory from 'lib/GetCategory'
import VueLazyload from 'vue-lazyload'
import store from 'member/store/Checkout/'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.use(VueEcho)
Vue.use(CartCounter)
Vue.directive('click-outside', clickOutside)

const App = r => require.ensure([], () => r(require('member/components/Checkout/Checkout.vue')),
  'mem-checkout')

import { mapActions } from 'vuex'

new Vue({
  store,
  created () {
    this.initActiveUser(window._sharedData.user)
    this.initCarts(window._sharedData.cartData)
  },
  methods: {
    ...mapActions(['initActiveUser', 'initCarts'])
  },
  render: h => h(App)
}).$mount('#app')
