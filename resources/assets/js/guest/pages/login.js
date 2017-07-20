import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'
import GetCategory from 'lib/GetCategory'
import store from 'guest/store/search/'

Vue.use(VueAxios)
Vue.use(VeeValidate)
Vue.use(GetCategory)

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
