import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)
import store from 'member/store/home/'

import App from 'vendor/components/home/Home.vue'
import { mapActions } from 'vuex'

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
