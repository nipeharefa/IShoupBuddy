import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
Vue.use(VueAxios)
Vue.use(VueLazyload)
import { mapActions } from 'vuex'
import store from 'member/store/Cart/'

const App = r => require.ensure([], () => r(require('member/components/Cart/Cart.vue')), 'mem-cart')

new Vue({
  store,
  created () {
    this.initActiveUser(window._sharedData.user)
    this.getCarts()
  },
  methods: {
    ...mapActions([
      'initActiveUser'
    ]),
    getCarts () {
      this.$http.get('api/cart').then(response => {
        console.log(response.data)
      })
    }
  },
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
