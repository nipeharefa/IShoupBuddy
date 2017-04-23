import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'
Vue.use(VueAxios)
Vue.use(VeeValidate)

import App from 'guest/components/register/Register.vue'

new Vue({
  render (h) {
    return (
			<div class=''>
        <App />
        </div>
    )
  }
}).$mount('#app')
