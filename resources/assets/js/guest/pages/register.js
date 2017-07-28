import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate, { Validator } from 'vee-validate'
import GetCategory from 'lib/GetCategory'
import store from 'guest/store/search/'
import id from 'vee-validate/dist/locale/id'

Vue.use(VueAxios)

Validator.addLocale(id)
Vue.use(VeeValidate, {
  locale: 'id'
})
Vue.use(GetCategory)

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
