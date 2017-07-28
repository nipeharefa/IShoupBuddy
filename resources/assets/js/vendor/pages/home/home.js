import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import store from 'member/store/home/'

Vue.use(VueAxios)
Vue.use(VueLazyload)

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
