import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueEcho from 'lib/echo-pusher-plugin'
import CartCounter from 'lib/CartCounter'
import VueLazyload from 'vue-lazyload'
import store from 'member/store/home/'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.use(VueEcho)
Vue.use(CartCounter)
const App = r => require.ensure([], () => r(require('member/components/home/Home.vue')), 'mem-home')

new Vue({
  mounted () {
    console.log(this.$getCartCounter())
  },
  store,
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
