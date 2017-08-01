import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import store from 'member/store/home/'
import clickOutside from 'lib/click-outside.js'

Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)

import App from 'vendor/components/home/Home.vue'

new Vue({
  store,
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
