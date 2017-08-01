import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'
import clickOutside from 'lib/click-outside.js'

Vue.use(VueAxios)
Vue.use(VeeValidate)
Vue.directive('click-outside', clickOutside)

import App from 'vendor/components/product/create/Create.vue'

new Vue({
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
