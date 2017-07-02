import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import { mapActions } from 'vuex'
import store from 'member/store/Cart/'
import VueEcho from 'lib/echo-pusher-plugin'
Vue.use(VueEcho)
Vue.use(VueAxios)
Vue.use(VueLazyload)

const App = r => require.ensure([], () => r(require('member/components/Cart/Cart.vue')), 'mem-cart')

new Vue({
  store,
  created () {
    this.initActiveUser(window._sharedData.user)
    this.getCarts()
  },
  methods: {
    ...mapActions([
      'initActiveUser',
      'initCarts'
    ]),
    getCarts () {
      this.$http.get('api/cart').then(response => {
        this.initCarts(response.data)
      })
    }
  },
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
