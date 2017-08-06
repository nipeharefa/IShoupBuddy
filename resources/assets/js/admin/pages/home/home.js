import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import store from 'admin/store/home'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)

const App = r => require.ensure([], () => r(require('adminComponents/home/Home.vue')), 'admin-home')
Vue.config.devtools = true

console.log(App)
new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
