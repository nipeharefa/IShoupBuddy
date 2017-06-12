import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import store from 'admin/store/home'

Vue.use(VueAxios)
Vue.use(VueLazyload)

const App = r => require.ensure([], () => r(require('adminComponents/home/Home.vue')), 'admin-home')

console.log(App)
new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
