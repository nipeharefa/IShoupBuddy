import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
Vue.use(VueAxios)
Vue.use(VueLazyload)
const App = r => require.ensure([], () => r(require('member/components/home/Home.vue')), 'mem-home')
import store from 'member/store/home/'

new Vue({
  store,
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
