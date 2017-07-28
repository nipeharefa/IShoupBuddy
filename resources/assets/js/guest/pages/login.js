import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'
import store from 'guest/store/search/'

Vue.use(VueAxios)
Vue.use(VeeValidate)

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
