import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'member/components/home/Home.vue'

import store from 'member/store/home/'

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
