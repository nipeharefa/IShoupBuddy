import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'

Vue.use(VueAxios)
Vue.use(VeeValidate)

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
