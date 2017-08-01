import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)
import clickOutside from 'lib/click-outside.js'
import store from 'guest/store/show-category-product/'
const App = r => require.ensure([], () => r(require('guest/components/Category/ShowCategoryProduct.vue')), 'show-category-product')

import { mapActions } from 'vuex'

new Vue({
  created () {
    this.initProducts(window._sharedData.products)
  },
  store,
  render (h) {
    return (
      <App />
    )
  },
  methods: {
    ...mapActions(['initProducts'])
  }
}).$mount('#app')
