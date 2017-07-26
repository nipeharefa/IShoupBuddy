import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueEcho from 'lib/echo-pusher-plugin'
import CartCounter from 'lib/CartCounter'
import VueLazyload from 'vue-lazyload'
import { mapActions } from 'vuex'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.use(VueEcho)
Vue.use(CartCounter)
import store from 'member/store/show-category-product/'

const App = r => require.ensure([], () => r(require('vendor/components/Category/ShowCategoryProduct.vue')), 'show-category-product')

new Vue({
  created () {
    this.initActiveUser(window._sharedData.user)
    this.initProducts(window._sharedData.products)
  },
  store,
  render: h => h(App),
  methods: {
    ...mapActions(['initActiveUser', 'initProducts'])
  }
}).$mount('#app')
