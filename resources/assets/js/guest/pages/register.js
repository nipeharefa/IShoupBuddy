import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate, { Validator } from 'vee-validate'
import store from 'guest/store/search/'
import id from 'vee-validate/dist/locale/id'
import clickOutside from 'lib/click-outside.js'

Vue.use(VueAxios)
Vue.directive('click-outside', clickOutside)

Validator.addLocale(id)
Vue.use(VeeValidate, {
  locale: 'id'
})

import App from 'guest/components/register/Register.vue'

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
