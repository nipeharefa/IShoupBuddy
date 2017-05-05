import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'

Vue.use(VueAxios)
Vue.use(VeeValidate)

import store from 'guest/store/home/'

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
