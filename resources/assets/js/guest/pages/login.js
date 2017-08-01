import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import clickOutside from 'lib/click-outside.js'
import VeeValidate from 'vee-validate'
// import VueClickOutSide from 'vue-click-outside-directive'
import store from 'guest/store/search/'

Vue.use(VueAxios)
Vue.use(VeeValidate)
// Vue.directive('click-outside', VueClickOutSide)

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
