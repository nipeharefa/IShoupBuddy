import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'
import store from '../store/changepassword'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(VeeValidate)
Vue.directive('click-outside', clickOutside)

import App from 'member/components/change_password/ChangePassword.vue'

new Vue({
  store,
  render (h) {
    return (
      <div class=''>
        <App />
      </div>
    )
  }
}).$mount('#app')

