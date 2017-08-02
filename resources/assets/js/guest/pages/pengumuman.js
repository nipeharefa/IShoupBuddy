import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)

import store from 'guest/store/home/'

const App = r => require.ensure([], () => r(require('guest/components/other/Pengumuman.vue')), 'g-other')

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
