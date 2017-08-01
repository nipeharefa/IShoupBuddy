import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'
import clickOutside from 'lib/click-outside.js'

Vue.use(VueAxios)
Vue.use(VeeValidate)
Vue.directive('click-outside', clickOutside)

import App from 'vendor/components/auth/login/Login.vue'

import store from 'guest/store/home/'

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
