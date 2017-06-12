import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
import VueLazyload from 'vue-lazyload'
Vue.use(VueAxios)
Vue.use(VueLazyload)
const App = r => require.ensure([], () => r(require('guest/components/home/Home.vue')), 'hombes')

new Vue({
  store,
  render (h) {
    return (
			<App />
    )
  }
}).$mount('#app')
