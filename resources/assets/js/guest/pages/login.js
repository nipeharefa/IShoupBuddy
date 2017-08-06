import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import clickOutside from 'lib/click-outside.js'
import VeeValidate, { Validator } from 'vee-validate'
import id from 'vee-validate/dist/locale/id'
// import VueClickOutSide from 'vue-click-outside-directive'
import store from 'guest/store/search/'

Vue.use(VueAxios)
Validator.addLocale(id)
Vue.use(VeeValidate, {
  locale: 'id'
})

Vue.directive('click-outside', clickOutside)

import App from 'guest/components/login/Login.vue'

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
