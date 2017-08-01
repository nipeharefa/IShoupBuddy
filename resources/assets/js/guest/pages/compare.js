import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(VueLazyload)
import store from 'guest/store/home/'
Vue.directive('click-outside', clickOutside)

const App = r => require.ensure([], () => r(require('guest/components/compare/Compare.vue')), 'g-compare')
new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
